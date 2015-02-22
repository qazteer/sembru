<?php 
	
	require_once "config_class.php";
	require_once "catalog_class.php";
	require_once "oreder_class.php";
	require_once "user_class.php";

	

	class HandlerClass{

		public $catalog;
		public $user;
		protected $order;
		public $config;

		function __construct(){
			session_start();
			$this->catalog = new CatalogClass();
			$this->user = new UserClass();
			$this->order = new OrderClass();
			$this->config = new Config();
		}
		
		public function edit_in_cart(){ /*Добавление в корзину, результат - количество товара в сессии*/
			$productID = $_POST["productID"];
			$count = $this->catalog->putInCart($productID);
			header("Location:".$_SERVER['HTTP_REFERER']);
		}

		public function checkoutOrder(){
			$delivery = $this->user->filter($_POST['delivery'], "string");
			$name = $this->user->filter($_POST['name'], "string");
			$phone = $this->user->filter($_POST['phone'], "string");
			$email = $this->user->filter($_POST['email'], "string");

			if(isset($_SESSION['user'])){
				foreach ($_SESSION['user'] as $key => $value) {

					$product = $this->catalog->selectOne("id", $key);
					$in_all = $product["price"] * $value;

					$arrProduct['product_ids'] = $product["id"];
					$arrProduct['title'] = $product["title"];
					$arrProduct['quantity'] = $value;
					$arrProduct['price'] = $product["price"];
					$arrProduct['in_all'] = $in_all;
					$arrProduct['delivery'] = $delivery;
					$arrProduct['name'] = $name;
					$arrProduct['phone'] = $phone;
					$arrProduct['email'] = $email;
					$arrProduct['date_order'] = time();

					$result = $this->order->insert($arrProduct);
				}
				if($result) {
					unset($_SESSION['user']);
					return header("Location:".$_SERVER['HTTP_REFERER']."&suc=yes");
				}
				else {
					return header("Location:".$_SERVER['HTTP_REFERER']."&suc=no");
				}
			}
			else{
				return header("Location:".$_SERVER['HTTP_REFERER']."&suc=no");
			}

		}

		public function SendPost(){
			if($_POST['submit']) { 
				$subject = substr($this->user->filter($_POST['subject'], "string"), 0, 1000); 
        		$message =  wordwrap($this->user->filter($_POST['message'], "string"), 70); 
        		$to = 'teer12@yandex.ua'; 
        		$from = "From: ".trim($_POST['email']);
        		if(mail($to, $subject, $message, $from)){
        			return header("Location:".$this->config->address."?view=post&send=yes");
        		}
        		else{
        			return header("Location:".$this->config->address."?view=post&send=no");
        		}
			}
		}

		public function regUser(){
			$login = $this->user->filter($_POST["login"], "string");
			if(empty($login)){
				$_SESSION["error_reg"] = "empty_login";
				return header("Location:".$_SERVER['HTTP_REFERER']);
				exit();
			}
		    $count = $this->user->selectAllCount("`login`='".$login."'");
		    if($count[0][0] > 0) {
		    	$_SESSION["error_reg"] = 1;
		    	return header("Location:".$_SERVER['HTTP_REFERER']);
		    	exit();
		    }
		    $name = $this->user->filter($_POST["name"], "string");
		    if(empty($name)){
				$_SESSION["error_reg"] = "empty_name";
				return header("Location:".$_SERVER['HTTP_REFERER']);
				exit();
			}
			$pass = $this->user->filter($_POST["password"], "string");
			$r_pass = $this->user->filter($_POST["r_password"], "string");
			if(empty($pass) || empty($r_pass)){
				$_SESSION["error_reg"] = "empty_pass";
				return header("Location:".$_SERVER['HTTP_REFERER']);
				exit();
			}
			if($pass == $r_pass){
				$hash = md5(uniqid(rand(), true));
				$pass = md5($pass);
				$pass = $pass.$hash;
				$values = array("name"=>$name,"login"=>"$login", "pass"=>"$pass", "hash"=>"$hash");
				$this->user->insert($values);
				$_SESSION["name"] = $name;
				$_SESSION["login"] = $login; /*если всё прошло успешно создаём сессию логин-пароль*/
				$_SESSION["pass"] = $pass;
				setcookie("name", $name, time()+3600, "/");
				setcookie("login", $login, time()+3600, "/");
				setcookie("pass", $pass, time()+3600, "/");
				return header("Location:".$this->config->address);
			}
			else{
				$_SESSION["error_reg"] = 2;
				return header("Location:".$_SERVER['HTTP_REFERER']);
				exit();
			}
		}

		public function autUser(){
			$login = $this->user->filter($_POST["login"], "string");
			if(empty($login)){
				$_SESSION["error_reg"] = "empty_login";
				return header("Location:".$_SERVER['HTTP_REFERER']);
				exit();
			}
		    $count = $this->user->selectAllCount("`login`='".$login."'");
		    if(!$count[0][0]) {
		    	$_SESSION["error_reg"] = 1;
		    	return header("Location:".$_SERVER['HTTP_REFERER']);
		    	exit();
		    }
			$pass = $this->user->filter($_POST["password"], "string");
			if(empty($pass)){
				$_SESSION["error_reg"] = "empty_pass";
				return header("Location:".$_SERVER['HTTP_REFERER']);
				exit();
			}
			$pass = md5($pass);
			$result = $this->user->selectOne("login", $login);
		    $pass = $pass.$result["hash"];

			if($pass == $result["pass"]){
				$name = $result["name"];
				$_SESSION["name"] = $name;
				$_SESSION["login"] = $login; /*если всё прошло успешно создаём сессию логин-пароль*/
				$_SESSION["pass"] = $pass;
				setcookie("name", $name, time()+3600, "/");
				setcookie("login", $login, time()+3600, "/");
				setcookie("pass", $pass, time()+3600, "/");
				if($result["admin"]==1){
					$_SESSION["admin"] = $result["admin"];
					return header("Location:".$this->config->address."admin/");
				}
				return header("Location:".$this->config->address); 
			}
			else{
				$_SESSION["error_reg"] = 2;
				return header("Location:".$_SERVER['HTTP_REFERER']); 
				exit();
			}
		}

		public function searchMethod(){
			$search = $this->catalog->filter($_POST["search"], "string");
			$section = $this->catalog->filter($_POST["section"], "int");
			$section = $section ? "&section=$section" : "";
			$lang = $_POST["lang"];
			
			if(!empty($search)){
				if ((strlen($search) < 3) && (strlen($search) > 0)) {
					$_SESSION['error'] = "litle";
		            return header("Location:".$this->config->address."?view=catalog$section&search=$search$lang");
		            exit();
		        }
		        elseif (strlen($search) > 30) {
		        	$_SESSION['error'] = "big";
		            return header("Location:".$this->config->address."?view=catalog$section&search=$search$lang");
		            exit();
		        }
		        else{
		        	
		        	return header("Location:".$this->config->address."?view=catalog$section&search=$search$lang");
		        	exit();
		        }
			}
			else{
				$_SESSION['error'] = "null";
				return header("Location:".$this->config->address."?view=catalog$section&search=null$lang");
				exit();
			}
		}

		public function dellProdSession($id){
			$link = $_SERVER['HTTP_REFERER'] != "" ? $_SERVER['HTTP_REFERER'] : $this->config->address;

			if($id == "out"){
				if(isset($_SESSION['name'])){
					unset($_SESSION['name']);
					unset($_SESSION['pass']);
					unset($_SESSION['login']);
					if(isset($_SESSION["admin"])){
						unset($_SESSION["admin"]);
					}
				}
				setcookie("name", $name, 1, "/");
				setcookie("login", $login, 1, "/");
				setcookie("pass", $pass, 1, "/");
				return header("Location:".$link);
			}
				if(array_key_exists($id, $_SESSION['user'])){
				unset($_SESSION['user'][$id]);
				return header("Location:".$link);
				}
				echo "По вашему запросу товара не существует!";	
		}

	}

 ?>