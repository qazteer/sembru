<?php 

require_once "modules_class.php";

class GoodsPage extends ModulesClass{

	private $goods;

	public function __construct(){
		parent::__construct();
	}

	protected function getTitle(){
		return "Товары";
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["ordersH"] = "";
		$arr["goodsH"] = " class='hover_page'";
		$arr["sevicesH"] = "";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getMiddle(){
		$result = $this->catalog->selectAll();
		if($result){
			$page = $this->catalog->getGET("page", "int", false);
			$this->goods = count($result);
			$count=0;
			foreach ($result as $key => $value) {
				$section = $this->section->selectOne("id", $value["section"]);
				$value["address"] = substr($this->config->address, 0, strpos($this->config->address, "admin"));
				$value["section"] = mb_strtolower($section["title_ru"]);
				$value["date"] = date("d-m-Y H:i", $value["date"]);
				$value["page"] = $page ? "&page=".$page : "";
				$tr_arr[$count] = $this->getTemplate($value, "goods_tr");
				$count++;
			}
			$text["tr"] = $this->sortProduct($tr_arr);
			return $this->getTemplate($text, "goods_content");
		}
		
	}

	public function sortProduct($text_array){
		$page = $this->getPage();

		$quan_orders = 5;
		$max = count($text_array); 
		$start = ($page * $quan_orders) - $quan_orders;
		$end = ($start + $quan_orders)<$max ? ($start + $quan_orders) : $max;

		for($i=$start; $i<$end; $i++){
			$text .= $text_array[$i];
		}

		return $text;

	}

	public function getPage(){
		if($page = $this->orders->getGET("page", "int", false)){
			if($page<1){
				$page=1;
			}
			elseif($page>$this->goods){
				$page=$this->goods;
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
		$num_pages = intval(($this->goods-1)/$quan_page)+1;  /*количество страниц*/

		$style = "class='pointer'";
		$stnum = "class='stnum'";
		$stpage = "class='stylepage'";

		if($page != 1) $backpage = "<a href='".$this->config->address."?view=goods&amp;page=".($page-1)."'".$style."><<&nbsp;".$nav["back"]."</a>&nbsp;|&nbsp;";
		if($page != 1) $firstpage = "<a href='".$this->config->address."?view=goods&amp;page=1'".$stnum.">1</a>&nbsp;|&nbsp;";

		if($page != $num_pages) $nextpage = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=goods&amp;page=".($page+1)."'".$style."> ".$nav["next"].">></a>";
		if($page != $num_pages) $lastpage = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=goods&amp;page=".$num_pages."'".$stnum.">".$num_pages."</a>";

		if($page - 3 > 1) $pageleft3 = "...";
		if($page - 2 > 1) $pageleft2 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=goods&amp;page=".($page - 2)."'".$stnum.">".($page - 2)."</a>&nbsp;|&nbsp;";
		if($page - 1 > 1) $pageleft1 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=goods&amp;page=".($page - 1)."'".$stnum.">".($page - 1)."</a>&nbsp;|&nbsp;";

		if($page + 3 < $num_pages) $pageright3 = "...";
		if($page + 2 < $num_pages) $pageright2 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=goods&amp;page=".($page + 2)."'".$stnum.">".($page + 2)."</a>&nbsp;|&nbsp;";
		if($page + 1 < $num_pages) $pageright1 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=goods&amp;page=".($page + 1)."'".$stnum.">".($page + 1)."</a>&nbsp;|&nbsp;";

		if($page==1) $page = "<span ".$stpage.">".$page."</span>&nbsp;|&nbsp;";
		elseif($page==$num_pages) $page = "&nbsp;|&nbsp;<span ".$stpage.">".$page."</span>";
		else $page = "&nbsp;|&nbsp;<span ".$stpage.">".$page."</span>&nbsp;|&nbsp;";

		if((!isset($backpage))&&(!isset($pageleft2))&&(!isset($pageleft1))&&(!isset($pageright1))&&(!isset($pageright2))&&(!isset($nextpage))) return ""; 
		$arr["pagination"] = $backpage.$firstpage.$pageleft3.$pageleft2.$pageleft1.$page.$pageright1.$pageright2.$pageright3.$lastpage.$nextpage;
		return $this->getTemplate($arr, "pagination");	
	}
}
?>