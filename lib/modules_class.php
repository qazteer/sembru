<?php 

require_once "config_class.php";
require_once "catalog_class.php";
require_once "user_class.php";
require_once "oreder_class.php";
require_once "lang_class.php";
require_once "about_class.php";
require_once "section_class.php";

abstract class ModulesClass{

	protected $config;
	protected $catalog;
	protected $user;
	protected $order;
	protected $about;
	protected $lang;
	protected $section;

	function __construct($lang=false){
		session_start();
		$this->config = new Config();
		$this->catalog = new CatalogClass();
		$this->user = new UserClass();
		$this->order = new OrderClass();
		$this->about = new AboutClass();
		$this->lang = new Lang($lang);
		$this->section = new SectionClass();
	}

	public function getContent(){
		$arr = $this->lang->getSearch();
		$arr["address"] = $this->config->address;
		$arr["lang"] = $this->lang->getLang();
			$arr["lang_home"] = $this->config->address;
		$arr["section"] = $this->catalog->getGET("section", "int", false);
		$arr["link"] = $this->getLink();
		$arr["title"] = $this->getTitle();
		$arr["aut_reg"] = $this->getAutReg();
		$arr["cart"] = $this->getCart();
		$arr["menu"] = $this->getMenu();
		$arr["content"] = $this->getMiddle();
		$arr["circle_menu"] = $this->getCircle();
		$arr["karusel"] = $this->getKarusel();
		$arr["hr"] = $this->getHr();
		$arr["pagination"] = $this->getPagination();
		$arr["footer"] = $this->lang->getFooter();
		return $this->getTemplate($arr, "main");
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

	protected function getAutReg(){
		$arr = $this->lang->getAutReg();
		if(isset($_SESSION["name"])){
			$arr["name"] = $_SESSION["name"];
			return $this->getTemplate($arr, "autYes");
		}
		elseif (isset($_COOKIE['name'])) {
			$arr["name"] = $_COOKIE['name'];
			return $this->getTemplate($arr, "autYes");
		}
		else {
			$arr["lang"] = $this->lang->getLang();
			return $this->getTemplate($arr, "aut_reg");
		}
	}

	protected function getCart(){
		$count = $this->catalog->putInCart();
		$numer = $this->getWords($count);
		$arr = $this->lang->getCart($numer);
		$sum = $this->catalog->getSum();
		$arr["lang"] = $this->lang->getLang();
		$arr["count"] = $count;
		$arr["sum"] = $sum;
		$arr["curr"] = $sum ? $arr["curr"] : "";
		return $this->getTemplate($arr, "cart");
	}

	protected function getWords($count){
		$mod_100 = $count % 100;
		$mod_10 = $mod_100 % 10;
		if($mod_100>10 && $mod_100<20) return 2;
		if($mod_10>1 && $mod_10<5) return 1;
		if($mod_10==1) return 0;
		return 2;
	}

	protected function getMenu(){
		$lang = $this->lang->getLang();
		$lang_home = $lang ? "?".substr($lang, 1) : $lang;

		$menu = $this->lang->getLangMenu();
			/*добавление класса css к меню */
			$arr = $this->addClassHover();
			foreach ($arr as $key => $value) {
				$menu[$key] = $value;
			}
		$menu["linkhome"] = $this->config->address.$lang_home;
		$menu["linkcatalog"] = $this->config->address."?view=catalog".$lang;
		$menu["linkabout"] = $this->config->address."?view=about".$lang;
		$menu["linkservices"] = $this->config->address."?view=services".$lang;
		$menu["linkcontact"] = $this->config->address."?view=contact".$lang;
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

	protected function getHr(){
		return "";
	}

	protected function getCircle(){
		return "";
	}

	protected function getKarusel(){
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

	protected function getCircleMenu(){
		$result = $this->section->selectAll();
		$array = $this->lang->getCircleMenu($result);

		$menu = "<table class='table'><tr>";
			for ($i=1; $i<=6; $i++) { 
				$arr["lang"] = $this->lang->getLang();
				$arr["i"] = $i;
				$menu .= $this->getTemplate($arr, "circle_menu");
			}
		
		$menu .= "</tr><tr>";
			for ($i=1; $i<=count($array); $i++) { 
				$arr["name"] = $array[$i];
				$menu .= $this->getTemplate($arr, "circle_name_menu");
			}
	
		$menu .= "</tr></table>";
		return $menu;
		
	}

	protected function madeKarusel(){
		$Allproducts = $this->catalog->selectAll();
		$sr["lang"] = $this->lang->getLang();
		foreach ($Allproducts as $key => $value) {
			$sr["id"] = $value["id"];
			$sr["img"] = $value["img"];
				$arr = $this->lang->getTitleProduct($value);
			$sr["title"] = $arr["title"];
			$sr["price"] = number_format($value["price"],2);
			$sr["curr"] = $arr["curr"];
			$block .= $this->getTemplate($sr, "karblock");
		}
		$blocks["block"] = $block;
		return $this->getTemplate($blocks, "karusel");
	}

	public function getPage(){
		if($page = $this->catalog->getGET("page", "int", false)){
			if($page<1){
				$page=1;
			}
			elseif($page>$this->catalog->numPage()){
				$page=$this->catalog->numPage();
			}
		}
		else{
			$page=1;
		}
		return $page;
	}

	public function sortProduct($arr){
		$page = $this->getPage();

		$num = 6;
		
		$count = count($arr);
		$max = $count;
		$start = ($page * $num) - $num;
		$end = ($start + $num)<$max ? ($start + $num) : $max;

		$arayProduct = array();
		for($i=$start; $i<$end; $i++){
			$arayProduct[$i] = $arr[$i];
		}

		return $arayProduct;

	}

}

?>