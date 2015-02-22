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
		
		public function selectOne($whereField, $value){
			$result = $this->db->selectOne($this->table_name, $whereField, $value);
			if(!$result) return false;
			$product = array();
			foreach ($result as $key => $value) {
				foreach ($value as $key => $value) {
					$product[$key] = $value;
				}
			}

			return $product;
		}

		public function insert($values){
			return $result = $this->db->insert($this->table_name, $values);
		}


		public function getStatistics($fields, $present, $past){
			return $this->db->getStatistics($this->table_name, $fields, $present, $past);
		}

		public function getStatisticsPays($fields){
			return $this->db->getStatisticsPays($this->table_name, $fields);
		}

		public function selectOrders(){
			return $this->db->selectOrders($this->table_name);
		}

		public function updateOrders($upd_fields, $where){
			return $this->db->updateOrders($this->table_name, $upd_fields, $where);
		}

		public function dellAdmin($id){
			return $this->db->dellAdmin($this->table_name, $id);
		}

		public function selectField($field){  
			return $this->db->selectField($this->table_name, $field);
		}

		public function updateGoods($upd_fields, $where){
			return $this->db->updateGoods($this->table_name, $upd_fields, $where);
		}

		public function insertGoods($fields){
			return $this->db->insert($this->table_name, $fields);
		}

		public function updateUsers($upd_fields, $where){
			return $this->db->updateUsers($this->table_name, $upd_fields, $where);
		}

	}

 ?>