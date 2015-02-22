<?php 

require_once "modules_class.php";

class CatalogPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		return $this->lang->getTitleCatalog();
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["catalogH"] = " class='hover_page'";
		$arr["aboutH"] = "";
		$arr["sevicesH"] = "";
		$arr["contactH"] = "";
		return $arr;
	}

	public function getForm(){

		$arr = $this->lang->getForm();
		$arr["page"] = $this->getPage();
		$arr["lang"] = $this->lang->getLang();

		$value = $this->catalog->getGET("section", "int", false);
		$arr["section"] = $value ? "&amp;section=".$value : false;

		return $this->getTemplate($arr, "formSort");
	}


	protected function getMiddle(){
		$error = $this->lang->getSearchError();
		if(isset($_SESSION['error'])){
			if($_SESSION['error']=="litle"){
				$text_error = $error["litle"];
			}
			elseif ($_SESSION['error']=="big") {
				$text_error = $error["big"];
			}
			elseif ($_SESSION['error']=="null") {
				$text_error = $error["null"];
			}
			$err["error_text"] = $text_error;
			unset($_SESSION['error']);
			$text = $this->getTemplate($err, "error_search");
		}
		else{
			$field=array("id","title","title_ru","title_en","img","price");
			$arr = $this->catalog->selectProduct($field);
			$products = $this->sortProduct($arr);
				/*проверка на наличиие товара*/
				if(count($products)<1){
					$search = $this->catalog->getGET("search", "string", false);
					if($search){
						$err["error_text"] = $error["error_not"];
						$text = $this->getTemplate($err, "error_search");
					}
					else{
						$err["error_text"] = $error["not_goods"];
						$text = $this->getTemplate($err, "error_search");
					}
				}
				else{
					$i=0;
					foreach ($products as $key => $value) {
						$sr["lang"] = $this->lang->getLang();
						$sr["id"] = $value["id"];
						$sr["img"] = $value["img"];
							$arr = $this->lang->getTitleProduct($value);
						$sr["title"] = $arr["title"];
						$sr["price"] = number_format($value["price"],2);
						$sr["curr"] = $arr["curr"];

						if($key % 3 == 0) $text .= "<tr>";

						$text .= $this->getTemplate($sr, "td");

						if(($i + 1 == 3) or ($i + 1 == count($products))) $text .= "</tr>";
						$i++;
					}
				}
		}
			$section = $this->catalog->getSection();
			$sectionLang = $this->lang->getCircleMenu($this->section->selectAll());
			$section = $section[0]["title"] ? $sectionLang[$section[0]["id"]] : $this->lang->getDefault();

			$arr_form["title"] = $section;
			$arr_form["form"] = $this->getForm();
			$form = $this->getTemplate($arr_form, "form_sort");

			$arr_two["form"] = $form;
			$arr_two["td"] = $text;
			$content = $this->getTemplate($arr_two, "catalog_content");
			
			$char = strpos($_SERVER['QUERY_STRING'], "&");
			$param = $char ? substr($_SERVER['QUERY_STRING'], $char) : "";
			$_SESSION["param"] = $param;
	 		return $content;
	}

	protected function getCircle(){
		return $this->getCircleMenu();
	}

	protected function getHr(){
		$hr = file_get_contents($this->config->dir_tpl."hr_catalog.tpl");
		return $hr;
	}


	public function getPagination(){	
		$lang = $this->lang->getLang();
		$page = $this->getPage();
		$num_pages = $this->catalog->numPage();  /*количество страниц*/

		$getid = $this->catalog->getGET("id", "int", false);
		$id = $getid ? "&amp;id=".$getid : false;

		$value = $this->catalog->getGET("section", "int", false);
		$section = $value ? "&amp;section=".$value : false;

		$nav = $this->lang->getNavigation();

		$style = "class='pointer'";
		$stnum = "class='stnum'";
		$stpage = "class='stylepage'";

		if($page != 1) $backpage = "<a href='".$this->config->address."?view=catalog".$section."&amp;page=".($page-1).$id.$lang."'".$style."><<&nbsp;".$nav["back"]."</a>&nbsp;|&nbsp;";
		if($page != 1) $firstpage = "<a href='".$this->config->address."?view=catalog".$section."&amp;page=1".$id.$lang."'".$stnum.">1</a>&nbsp;|&nbsp;";
		
		if($page != $num_pages) $nextpage = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=catalog".$section."&amp;page=".($page+1).$id.$lang."'".$style."> ".$nav["next"]."&nbsp;>></a>";
		if($page != $num_pages) $lastpage = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=catalog".$section."&amp;page=".$num_pages.$id.$lang."'".$stnum.">".$num_pages."</a>";

		if($page - 3 > 1) $pageleft3 = "...";
		if($page - 2 > 1) $pageleft2 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=catalog".$section."&amp;page=".($page - 2).$id.$lang."'".$stnum.">".($page - 2)."</a>&nbsp;|&nbsp;";
		if($page - 1 > 1) $pageleft1 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=catalog".$section."&amp;page=".($page - 1).$id.$lang."'".$stnum.">".($page - 1)."</a>&nbsp;|&nbsp;";

		if($page + 3 < $num_pages) $pageright3 = "...";
		if($page + 2 < $num_pages) $pageright2 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=catalog".$section."&amp;page=".($page + 2).$id.$lang."'".$stnum.">".($page + 2)."</a>&nbsp;|&nbsp;";
		if($page + 1 < $num_pages) $pageright1 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=catalog".$section."&amp;page=".($page + 1).$id.$lang."'".$stnum.">".($page + 1)."</a>&nbsp;|&nbsp;";

		if($page==1) $page = "<span ".$stpage.">".$page."</span>&nbsp;|&nbsp;";
		elseif($page==$num_pages) $page = "&nbsp;|&nbsp;<span ".$stpage.">".$page."</span>";
		else $page = "&nbsp;|&nbsp;<span ".$stpage.">".$page."</span>&nbsp;|&nbsp;";

		if((!isset($backpage))&&(!isset($pageleft2))&&(!isset($pageleft1))&&(!isset($pageright1))&&(!isset($pageright2))&&(!isset($nextpage))) return ""; 
		$arr["pagination"] = $backpage.$firstpage.$pageleft3.$pageleft2.$pageleft1.$page.$pageright1.$pageright2.$pageright3.$lastpage.$nextpage;
		return $this->getTemplate($arr, "pagination");	
	}
}
?>