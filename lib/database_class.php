<?php 

	require_once "config_class.php";


	class DataBase{

		private static $db = null;
		private $config;
		private $mysqli;

		private function __construct(){
			$this->config = new Config();
			$this->mysqli = new mysqli($this->config->host,$this->config->user,$this->config->pass,$this->config->db_name);
			$this->mysqli->query("SET NAMES 'utf8'");
		}

		public static function getDB(){
			if(self::$db == null) self::$db = new DataBase();
			return self::$db;
		}

		private function select($table_name, $fields, $where=false, $order=false, $up=true, $limit=false){

			$table_name = $this->config->db_prefix.$table_name;
			$fields = implode(",", $fields);

			if($order){
				$order = "ORDER BY $order";
				if(!$up) $order .= " DESC";
			}

			if($limit) $limit = "LIMIT $limit";

			if($where){
				$query = "SELECT $fields FROM $table_name WHERE $where $order $limit";
			}
			else{
				$query = "SELECT $fields FROM $table_name $order $limit";
			}

			$result = $this->mysqli->query($query);
			if(!$result) return false;

			$i=0;
			while($row=$result->fetch_array()){
				$data[$i] = $row;
				$i++;
			}

			$result->close();
			return $data;
		}

		private function insertIn($table_name, $values){
			$table_name = $this->config->db_prefix.$table_name;
			$query = "INSERT INTO $table_name (";
				foreach ($values as $field => $value) $query .="`".$field."`,";
				$query = substr($query, 0, -1);
			$query .=") VALUES (";
				foreach ($values as $field => $value) $query .="'".addslashes($value)."',";
				$query = substr($query, 0, -1);
				$query .=")";
			return $this->mysqli->query($query);
		}

		public function insert($table_name, $values){
			return $this->insertIn($table_name, $values);
		}
		

		public function filter($data, $type){
			if($type=='string'){
				$result = $this->mysqli->real_escape_string($data);
				$result = trim(htmlentities($result, ENT_QUOTES, 'UTF-8'));
			}
			else{
				if(is_numeric($data)){
					$result = abs((int)$data);
				}
				else{
					$result = false;
				}
			}
			return $result;
		}

		public function selectAll($table_name){
			return $this->select($table_name, array("*"));
		}

		public function selectProduct($table_name, $fields, $section, $order, $up){
			return $this->select($table_name, $fields, $section, $order, $up);
		}

		public function selectLike($table_name, $fields, $words, $section, $order, $up){
				$where = "(`title` LIKE '%$words%' OR `title_ru` LIKE '%$words%' OR `title_en` LIKE '%$words%')";
				if($section) {
					$where .= " AND $section";
				}
			return $this->select($table_name, $fields, $where, $order, $up);
		}

		public function selectAllCount($table_name, $section){  
			return $this->select($table_name, array("COUNT(id)"), $section);
		}

		public function selectAllLike($table_name, $words, $section){ 
			$where = "`title` LIKE '%$words%'";
			if($section) $where .= " AND $section";
			return $this->select($table_name, array("COUNT(id)"), $where);
		}

		public function selectOne($table_name, $whereField, $value){
			return $this->select($table_name, array("*"), $whereField."='".$value."'");
		}

	}

 ?>