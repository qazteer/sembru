<?php 
	
	require_once "config_class.php";
	require_once "orders_class.php";
	require_once "catalog_class.php";
	require_once "section_class.php";
	require_once "user_class.php";

	class HandlerClass{

		public $orders;
		private $config;
		private $catalog;
		private $section;
		private $users;


		function __construct(){
			$this->config = new Config();
			$this->orders = new OrderClass();
			$this->catalog = new CatalogClass();
			$this->section = new SectionClass();
			$this->users = new UsersClass();
		}

		private function FormateDate($data){
			$pattern = '/^([0-9]{2})-([0-9]{2})-([0-9]{4})\s([0-9]{2})\:([0-9]{2})$/';
			return preg_match($pattern, $data);
		}
		
		public function UpdateOrders(){

			foreach ($_POST as $key => $value) {
				if(strpos($key, "id") !== false){
					$id = substr($key, strlen("id"));
					$result = $this->catalog->selectOne("id", $_POST["id".$id]);
					$values["product_ids"] = $result["id"];
					$values["title"] = $result["title"];
					$values["price"] = $result["price"];
					$values["quantity"] = $_POST["quantity".$id];
					$values["in_all"] = $result["price"] * $_POST["quantity".$id];
					$values["name"] = $_POST["name"];
					$values["phone"] = $_POST["phone"];
					$values["email"] = $_POST["email"];
					$values["address"] = $_POST["address"];
					if($this->FormateDate($_POST["date_send"])){
							$arr = explode(" ", $_POST["date_send"]);
							$days = explode("-", $arr[0]);
							$hours = explode(":", $arr[1]);
							$date_send = mktime($hours[0],$hours[1],0,$days[1],$days[0],$days[2]);
						$values["date_send"] = $date_send;
					}elseif(($_POST["date_send"] == "Не отправлено")||(empty($_POST["date_send"]))){
						$values["date_send"] = 0;
					}else{
						echo"<h1>Неверный формат даты отправки!</h1>";
						exit();
					}
					if($this->FormateDate($_POST["date_pay"])){
						$arr = explode(" ", $_POST["date_pay"]);
						$days = explode("-", $arr[0]);
						$hours = explode(":", $arr[1]);
						$date_pay = mktime($hours[0],$hours[1],0,$days[1],$days[0],$days[2]);
						$values["date_pay"] = $date_pay;
					}elseif(($_POST["date_pay"] == "Не оплачено")||(empty($_POST["date_pay"]))){
						$values["date_pay"] = 0;
					}else{
						echo"<h1>Неверный формат даты покупки!</h1>";
						exit();
					}
					$values["delivery"] = $_POST["delivery"];
					$result = $this->orders->updateOrders($values, "id=".$id);
				}
			}
				
			if(!$result) {
				echo "<h1>Ошибка при обнавлении заказа в базе данных!</h1>";
				exit();
			}
			else {
				$page = $_POST["page"] ? $_POST["page"] : "";
				return header("Location:".$this->config->address."?view=orders".$page);
			}
		}

		public function delete($table, $back){
			$string_ids = $this->orders->getGET("id","string",false);
			$ids = explode(",", $string_ids);
			foreach ($ids as $key => $value) {
				$result = $this->$table->dellAdmin($value);
				if(!$result) {
					echo "<h1>Ошибка при удалении!</h1>";
					exit();
				}
			}
			/*нахождение страницы для редиректа после удаления*/
			if($_GET["page"]){
				if($_GET["total_num"]) $count = $_GET["total_num"]-1;
				else $count = count($this->$table->selectAll());

				$previous_page = $_GET["page"] - 1;
				if(($count / 5) > $previous_page) $page = "&page=".$_GET["page"];
				else $page = ($previous_page == 0) ? "" : "&page=".$previous_page;
			}
			else $page="";
			
			return header("Location:".$this->config->address."?view=".$back.$page);
		}

		public function UpdateGoods(){
			if(!empty($_FILES["img"]["tmp_name"])){
				copy($_FILES["img"]["tmp_name"], "../../img/product/".basename($_FILES['img']['name']));
				if($_FILES['img']['name'] != $_POST["img"]){
					unlink("../../img/product/".$_POST["img"]);
				}
			}
			foreach ($_POST as $key => $value) {
				if($key=="action" || $key=="page" || $key=="submit") continue;
				if($key=="img"){
					$fields["img"] = $_FILES['img']['name'] ? $_FILES['img']['name'] : $_POST["img"];
					continue;
				}
				$fields[$key] = $value;
			}
			$result = $this->catalog->updateGoods($fields, "id=".$_POST["id"]);
			if(!$result) {
				echo "<h1>Ошибка при обнавлении товара в базе данных!</h1>";
				exit();
			}
			else {
				$page = $_POST["page"] ? "&page=".$_POST["page"] : "";
				return header("Location:".$this->config->address."?view=goods".$page);
			}
		}

		public function InsertGoods(){
			foreach ($_POST as $key => $value) {
				if($key=="action" || $key=="page" || $key=="submit") continue;
				$fields[$key] = $value;
			}
			if(!empty($_FILES["img"]["tmp_name"])){
				copy($_FILES["img"]["tmp_name"], "../../img/product/".basename($_FILES['img']['name']));
				$fields["img"] = $_FILES['img']['name'];
			}
			$fields["date"] = time();
			$result = $this->catalog->insertGoods($fields);
			if(!$result) {
				echo "<h1>Ошибка при добавлении товара в базу данных!</h1>";
				exit();
			}
			else {
				$page = $_POST["page"] ? "&page=".$_POST["page"] : "";
				return header("Location:".$this->config->address."?view=goods".$page);
			}
		}

		public function UpdateUsers(){
			foreach ($_POST as $key => $value) {
				if($key=="action" || $key=="page" || $key=="submit") continue;
				if($key=="admin"){
					if($value=="user") $fields["admin"] = 0;
					elseif($value=="admin") $fields["admin"] = 1;
					else {
						session_start();
						$_SESSION["error_privileges"] = "Укажите правильны формат привелегий ('user' или 'admin')!";
						header("Location:".$_SERVER["HTTP_REFERER"]);
						exit;
					}
					continue;
				}
				$fields[$key] = $value;
			}
			$result = $this->users->updateUsers($fields, "id=".$_POST["id"]);
			if(!$result) {
				echo "<h1>Ошибка при при редактировании пользователя в базе данных!</h1>";
				exit();
			}
			else {
				$page = $_POST["page"] ? "&page=".$_POST["page"] : "";
				return header("Location:".$this->config->address."?view=users".$page);
			}
		}

		public function exitAdmin(){
			if(isset($_SESSION["admin"])){
				unset($_SESSION["admin"]);
				unset($_SESSION['name']);
				unset($_SESSION['pass']);
				unset($_SESSION['login']);
				setcookie("name", $name, 1, "/");
				setcookie("login", $login, 1, "/");
				setcookie("pass", $pass, 1, "/");
				return header("Location:".$_SERVER["HTTP_REFERER"]);
			}
			return false;
		}

	}

?>