<?php 

require_once "modules_class.php";

class UsersPage extends ModulesClass{

	private $allusers;

	public function __construct(){
		parent::__construct();
	}

	protected function getTitle(){
		return "Товары";
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["ordersH"] = "";
		$arr["goodsH"] = "";
		$arr["usersH"] = " class='hover_page'";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getMiddle(){
		$result = $this->users->selectAll();
		if($result){
			$page = $this->catalog->getGET("page", "int", false);
			$this->allusers = count($result);
			$count=0;
			foreach ($result as $key => $value) {
				$value["page"] = $page ? "&page=".$page : "";
				$value["admin"] = $value["admin"] == 0 ? "user" : "admin";
				$tr_arr[$count] = $this->getTemplate($value, "users_tr");
				$count++;
			}
			$text["tr"] = $this->sortProduct($tr_arr);
			return $this->getTemplate($text, "users_content");
		}
		
	}

	public function sortProduct($text_array){
		$page = $this->getPage();

		$quan_users = 5;
		$max = count($text_array); 
		$start = ($page * $quan_users) - $quan_users;
		$end = ($start + $quan_users)<$max ? ($start + $quan_users) : $max;

		for($i=$start; $i<$end; $i++){
			$text .= $text_array[$i];
		}

		return $text;

	}

	public function getPage(){
		if($page = $this->users->getGET("page", "int", false)){
			if($page<1){
				$page=1;
			}
			elseif($page>$this->allusers){
				$page=$this->allusers;
			}
		}
		else{
			$page=1;
		}
		return $page;
	}

	public function getPagination(){	
		$page = $this->getPage();
		$quan_page = 5;
		$num_pages = intval(($this->allusers-1)/$quan_page)+1;  /*количество страниц*/

		$style = "class='pointer'";
		$stnum = "class='stnum'";
		$stpage = "class='stylepage'";

		if($page != 1) $backpage = "<a href='".$this->config->address."?view=users&amp;page=".($page-1)."'".$style."><<&nbsp;".$nav["back"]."</a>&nbsp;|&nbsp;";
		if($page != 1) $firstpage = "<a href='".$this->config->address."?view=users&amp;page=1'".$stnum.">1</a>&nbsp;|&nbsp;";

		if($page != $num_pages) $nextpage = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=users&amp;page=".($page+1)."'".$style."> ".$nav["next"].">></a>";
		if($page != $num_pages) $lastpage = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=users&amp;page=".$num_pages."'".$stnum.">".$num_pages."</a>";

		if($page - 3 > 1) $pageleft3 = "...";
		if($page - 2 > 1) $pageleft2 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=users&amp;page=".($page - 2)."'".$stnum.">".($page - 2)."</a>&nbsp;|&nbsp;";
		if($page - 1 > 1) $pageleft1 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=users&amp;page=".($page - 1)."'".$stnum.">".($page - 1)."</a>&nbsp;|&nbsp;";

		if($page + 3 < $num_pages) $pageright3 = "...";
		if($page + 2 < $num_pages) $pageright2 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=users&amp;page=".($page + 2)."'".$stnum.">".($page + 2)."</a>&nbsp;|&nbsp;";
		if($page + 1 < $num_pages) $pageright1 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=users&amp;page=".($page + 1)."'".$stnum.">".($page + 1)."</a>&nbsp;|&nbsp;";

		if($page==1) $page = "<span ".$stpage.">".$page."</span>&nbsp;|&nbsp;";
		elseif($page==$num_pages) $page = "&nbsp;|&nbsp;<span ".$stpage.">".$page."</span>";
		else $page = "&nbsp;|&nbsp;<span ".$stpage.">".$page."</span>&nbsp;|&nbsp;";

		if((!isset($backpage))&&(!isset($pageleft2))&&(!isset($pageleft1))&&(!isset($pageright1))&&(!isset($pageright2))&&(!isset($nextpage))) return ""; 
		$arr["pagination"] = $backpage.$firstpage.$pageleft3.$pageleft2.$pageleft1.$page.$pageright1.$pageright2.$pageright3.$lastpage.$nextpage;
		return $this->getTemplate($arr, "pagination");	
	}
}
?>