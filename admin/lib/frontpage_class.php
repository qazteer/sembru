<?php 

require_once "modules_class.php";

class FrontPage extends ModulesClass{

	public function __construct(){
		parent::__construct();
	}

	protected function getTitle(){
		return "Аккаунт Администратора";
	}

	protected function addClassHover(){
		$arr["frontH"] = " class='hover_page'";
		$arr["catalogH"] = "";
		$arr["aboutH"] = "";
		$arr["sevicesH"] = "";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getMiddle(){
		$fields = array("in_all");
		$result = $this->getStatistics($fields, 7);
		if($result){
			$count = 0;
			$total_price = 0;
			foreach ($result as $key => $value) {
				$total_price += $value[0];
				$count ++;
			}
		}
		else{
			$total_price = 0;
			$count = 0;
		}
		$arr["count"] = $count;
		$arr["total_price"] = $total_price;
		$arr["pay_goods"] = $this->getPayGoods();
		return $this->getTemplate($arr, "index_content");
	}

	public function getStatistics($fields, $days){
		$present = time();
		$past = strtotime("- $days days");
		return $this->orders->getStatistics($fields, $present, $past);
	}

	public function getPayGoods(){
		$present = time();
		$past = strtotime("- 7 days");
		$result = $this->orders->getStatisticsPays(array("*"));
		if(!$result) return $count = 0;
		$count=0;
		foreach ($result as $key => $value) {
			if($value["date_pay"] != 0){
				if($value["date_pay"] < $present && $value["date_pay"] > $past)$count += $value["quantity"];
			}
		}
		
		return $count;
	}

}
?>