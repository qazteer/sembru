<?php 
	
	require_once "database_class.php";
	require_once "config_class.php";

	class GlobalClass {

		private $config;
		private $db;
		private $table_name;

		public function __construct($table_name){
			session_start();
			$this->config = new Config();
			$this->db = DataBase::getDB();
			$this->table_name = $table_name;
		}

		public function getGET($key, $type, $default_value){
			$data = isset($_GET[$key]) ? $_GET[$key] : $default_value;
			return $this->filter($data, $type);
		}

		public function filter($data, $type){
			return $this->db->filter($data, $type);
		}

		public function selectAll(){
			return $this->db->selectAll($this->table_name);
		}

		public function selectProduct($fields){
			if($id = $this->getGET("id", "int", false)){
			   switch ($id) {
			   	case 1:
			   		$order = "price";
			   		$up = true;
			   		break;
			   	case 2:
			   		$order = "price";
			   		$up = false;
			   		break;
			   	case 3:
			   		$order = "date";
			   		$up = true;
			   		break;
			   	case 4:
			   		$order = "date";
			   		$up = false;
			   		break;
			   	default:
			   		$order = "id";
			   		$up = true;
			   		break;
			   }
			}
			$value = $this->getGET("section", "int", false);
			$section = $value ? "`section`='".$value."'" : false;
			$search = $this->getGET("search", "string", false);
			if(!empty($search)) {
				$words = $search;
				return $this->db->selectLike($this->table_name, $fields, $words, $section, $order, $up);
			}
			return $this->db->selectProduct($this->table_name, $fields, $section, $order, $up);
		}

		public function numPage(){
			$num = 6;
			$value = $this->getGET("section", "int", false);
			$section = $value ? "section = '".$value."'" : false;
			$search = $this->getGET("search", "string", false);
			if(isset($search)) {
				$words = $search;
				$count = $this->selectAllLike($words, $section);
			}
			else $count = $this->selectAllCount($section);
			
			$max_num = $count[0][0];
			$num_pages = intval(($max_num-1)/$num)+1;
			return $num_pages;
		}

		public function selectAllCount($section){
			return $this->db->selectAllCount($this->table_name, $section);
		}

		public function selectAllLike($words, $section){
			return $this->db->selectAllLike($this->table_name, $words, $section);
		}

		
		public function selectOne($whereField, $value){
			$result = $this->db->selectOne($this->table_name, $whereField, $value);
			$product = array();
			if($result){
				foreach ($result as $key => $value) {
					foreach ($value as $key => $value) {
						$product[$key] = $value;
					}
				}
			}

			return $product;
		}

		public function getSection(){
			$section = $this->getGET("section", "int", false);
			return $this->db->selectOne("sections", "id", $section);
		}

		public function insert($values){
			return $result = $this->db->insert($this->table_name, $values);
		}

		public function putInCart($id=false, $quantity=1){
			if(!$id){
				if(!isset($_SESSION['user'])) return $count = 0;
				foreach ($_SESSION['user'] as $key => $value) {
				$count += $value;
				}
				if(!$count) return $count = 0;
				return $count;
			}
			
			$_SESSION['user'][$id] = $_SESSION['user'][$id] + $quantity;
			foreach ($_SESSION['user'] as $key => $value) {
				$count += $value;
			}
			return $count;
		}

		public function getSum(){
			if(isset($_SESSION['user'])){
				if(!empty($_SESSION['user'])){
					foreach ($_SESSION['user'] as $key => $value) {
						$product = $this->selectOne("id", $key);
						$price = $product["price"] * $value;
						$allPrice += $price;
					}
					return $allPrice;
				}
				else{
					return "";
				}
			}
			else{
				return "";
			}
		}

	}

 ?>