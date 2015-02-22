<?php 

require_once "config_class.php";
require_once "orders_class.php";
require_once "catalog_class.php";
require_once "section_class.php";
require_once "user_class.php";


abstract class ModulesClass{

	protected $config;
	protected $orders;
	protected $catalog;
	protected $section;
	protected $users;

	function __construct(){
		session_start();
		$this->config = new Config();
		$this->orders = new OrderClass();
		$this->catalog = new CatalogClass();
		$this->section = new SectionClass();
		$this->users = new UsersClass();
	}

	public function getContent(){
		$this->authAdmin();
		$arr["address"] = $this->config->address;
		$arr["link"] = $this->getLink();
		$arr["title"] = $this->getTitle();
		$arr["menu"] = $this->getMenu();
		$arr["content"] = $this->getMiddle();
		$arr["pagination"] = $this->getPagination();
		return $this->getTemplate($arr, "main");
	}

	protected function authAdmin(){
		if((!isset($_SESSION["admin"])) || ($_SESSION["admin"] != 1)){
			$address = substr($this->config->address, 0, strpos($this->config->address, "admin"));
			$_SESSION["error_reg"] = 3;
			return header("Location:".$address."?view=aut");
			exit();
		}
		return true;
	}

	abstract protected function getTitle();
	abstract protected function getMiddle();

	protected function getLink(){
		$link = $_SERVER['REQUEST_URI'];
		$str = strpos($link, "lang");
		$link = $str ? substr($link, 0, $str-1) : $link;
		$link .= strpos($link, "?") ? "&" : "?";
		return $link;
	}

	protected function getMenu(){
			/*добавление класса css к меню */
			$arr = $this->addClassHover();
			foreach ($arr as $key => $value) {
				$menu[$key] = $value;
			}
		$menu["linkhome"] = $this->config->address;
		$menu["linkgoods"] = $this->config->address."?view=goods";
		$menu["linkorders"] = $this->config->address."?view=orders";
		$menu["linkusers"] = $this->config->address."?view=users";
		$menu["linkstatistics"] = $this->config->address."?view=statistics";
		$menu["linkexit"] = "lib/function.php?admin=exit";
 		return $this->getTemplate($menu, "menu");
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["catalogH"] = "";
		$arr["aboutH"] = "";
		$arr["sevicesH"] = "";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getPagination(){
		return "";
	}

	protected function getTemplate($arr, $name_tpl){
		 $text = file_get_contents($this->config->dir_tpl.$name_tpl.".tpl");
		 $search = array();
		 $replace = array();
		 $i=0;
		 foreach($arr as $key => $value){
		 	$search[$i] = "%$key%";
		 	$replace[$i] = $value;
		 	$i++;
		 }
		 return str_replace($search, $replace, $text);
	}


	/*----------admin------------*/


}

?>