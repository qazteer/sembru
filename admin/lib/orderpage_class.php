<?php 

require_once "modules_class.php";

class OrderPage extends ModulesClass{

	private $num_order;

	public function __construct(){
		parent::__construct();
	}

	protected function getTitle(){
		return "Аккаунт Администратора";
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["ordersH"] = " class='hover_page'";
		$arr["aboutH"] = "";
		$arr["sevicesH"] = "";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getMiddle(){
		$result = $this->orders->selectOrders();
		
		$c = count($result); /*счётчик для второго цыкла*/
		$text_count=0;
		$num_order=0;
		for($i=0;$i<count($result);$i++){
			$num_order++;
			$count=0;
			for($j=$i+1;$j<$c;$j++){ 
				if(($result[$i]["date_order"]==$result[$j]["date_order"])&&($result[$i]["email"]==$result[$j]["email"])){
					$count++;
					/*если есть совпадения создаём массив на нужное количество ячеек*/
					$arr[$j]["id"] = $result[$j]["id"];
					$arr[$j]["title"] = $result[$j]["title"];
					$arr[$j]["quantity"] = $result[$j]["quantity"];
					$arr[$j]["in_all"] = $result[$j]["in_all"];
					unset($result[$j]);
				}
			}
			/* если нет совпадений формируем строку таблицы */
			$count++;
			if($result[$i]["delivery"]==0): $del = "Самовывоз";
			elseif($result[$i]["delivery"]==1): $del = "Наша логистика";
			elseif($result[$i]["delivery"]==2): $del = "Логистика \"Деливери\"";
			endif;
			$tr_long["num_order"] = $num_order;
			$tr_long["title"] = $result[$i]["title"];
			$tr_long["quantity"] = $result[$i]["quantity"];
			$tr_long["price"] = $result[$i]["in_all"];
			$tr_long["name"] = $result[$i]["name"];
			$tr_long["phone"] = $result[$i]["phone"];
			$tr_long["email"] = $result[$i]["email"];
			$tr_long["address"] = $result[$i]["address"];
			$tr_long["date_order"] = date("d-m-Y", $result[$i]["date_order"]);
			$tr_long["date_send"] = $result[$i]["date_send"] == 0 ? "Не отправлено" : date("d-m-Y H:i", $result[$i]["date_send"]);
			$tr_long["date_pay"] = $result[$i]["date_pay"] == 0 ? "Не оплачено" : date("d-m-Y H:i", $result[$i]["date_pay"]);
			$tr_long["delivery"] = $del;
				if(!empty($arr)){
					foreach ($arr as $key => $value) {
						$id .= ",".$value["id"];
					}
				}
				else $id="";
			$tr_long["ids"] = "&id=".$result[$i]["id"].$id;
			$tr_long["page"] = $this->orders->getGET("page", "int", false) ? "&page=".$this->orders->getGET("page", "int", false) : "";
			$tr_long["num"] = $count;
			$text = $this->getTemplate($tr_long, "order_tr");
		
			if(!empty($arr)){
				/*если массив не пустой(найдены совпадения) - формируем строку (конкотенируем)*/
				foreach ($arr as $key => $value) {
					$tr_shot["title"] = $value["title"];
					$tr_shot["quantity"] = $value["quantity"];
					$tr_shot["in_all"] = $value["in_all"];
					$text .= $this->getTemplate($tr_shot, "order_tr_shot");
				}
				unset($arr);
			}
			/*сдвигаем массив*/
			$result = array_values($result);

			/*массив строк (заказов)*/
			$text_array[$text_count] = $text;
			$text_count++;
		}
		$this->num_order = $num_order;
		/*устанавливаем значение общего количестква заказов в ссылку удаления каждого заказа*/
		if($text_array){
			foreach ($text_array as $key => $value) {
			$text_array[$key] = str_replace("%total_num%", $this->num_order, $value);
			}

			$text_arr["tr"] = $this->sortProduct($text_array);
		}
		else $text_arr["tr"] = "";
		
		return $this->getTemplate($text_arr, "order_content");
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
			elseif($page>$this->num_order){
				$page=$this->num_order;
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
		$num_pages = intval(($this->num_order-1)/$quan_page)+1;  /*количество страниц*/

		$style = "class='pointer'";
		$stnum = "class='stnum'";
		$stpage = "class='stylepage'";

		if($page != 1) $backpage = "<a href='".$this->config->address."?view=orders&amp;page=".($page-1)."'".$style."><<&nbsp;".$nav["back"]."</a>&nbsp;|&nbsp;";
		if($page != 1) $firstpage = "<a href='".$this->config->address."?view=orders&amp;page=1'".$stnum.">1</a>&nbsp;|&nbsp;";

		if($page != $num_pages) $nextpage = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=orders&amp;page=".($page+1)."'".$style."> ".$nav["next"].">></a>";
		if($page != $num_pages) $lastpage = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=orders&amp;page=".$num_pages."'".$stnum.">".$num_pages."</a>";

		if($page - 3 > 1) $pageleft3 = "...";
		if($page - 2 > 1) $pageleft2 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=orders&amp;page=".($page - 2)."'".$stnum.">".($page - 2)."</a>&nbsp;|&nbsp;";
		if($page - 1 > 1) $pageleft1 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=orders&amp;page=".($page - 1)."'".$stnum.">".($page - 1)."</a>&nbsp;|&nbsp;";

		if($page + 3 < $num_pages) $pageright3 = "...";
		if($page + 2 < $num_pages) $pageright2 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=orders&amp;page=".($page + 2)."'".$stnum.">".($page + 2)."</a>&nbsp;|&nbsp;";
		if($page + 1 < $num_pages) $pageright1 = "&nbsp;|&nbsp;<a href='".$this->config->address."?view=orders&amp;page=".($page + 1)."'".$stnum.">".($page + 1)."</a>&nbsp;|&nbsp;";

		if($page==1) $page = "<span ".$stpage.">".$page."</span>&nbsp;|&nbsp;";
		elseif($page==$num_pages) $page = "&nbsp;|&nbsp;<span ".$stpage.">".$page."</span>";
		else $page = "&nbsp;|&nbsp;<span ".$stpage.">".$page."</span>&nbsp;|&nbsp;";

		if((!isset($backpage))&&(!isset($pageleft2))&&(!isset($pageleft1))&&(!isset($pageright1))&&(!isset($pageright2))&&(!isset($nextpage))) return ""; 
		$arr["pagination"] = $backpage.$firstpage.$pageleft3.$pageleft2.$pageleft1.$page.$pageright1.$pageright2.$pageright3.$lastpage.$nextpage;
		return $this->getTemplate($arr, "pagination");	
	}
}
?>