<?php 

require_once "modules_class.php";

class StatisticsPage extends ModulesClass{

	public function __construct(){
		parent::__construct();
	}

	protected function getTitle(){
		return "Аккаунт Администратора";
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["ordersH"] = "";
		$arr["abouH"] = "";
		$arr["statisticsH"] = " class='hover_page'";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getMiddle(){
		$fields = array("in_all");
		$days = $_POST["submit"] ?  $_POST["numer"] : 1;
		$result = $this->getStatistics($days);
		if($result){
			$count = 0;
			$total_price = 0;
			foreach ($result as $key => $value) {
				$total_price += $value[0];
				$count ++;
			}
			$pay = $this->getPayGoods($days);
		}
		else{
			$total_price = 0;
			$count = 0;
			$pay=0;
		}
		$arr["last"] = ($days % 10) == 1 ? "последний" : "последние";
		$arr["numer"] = $days;
		$arr["days"] = $this->getWords($days);
		$arr["count"] = $count;
		$arr["total_price"] = $total_price;
		$arr["pay_goods"] = $pay;

		return $this->getTemplate($arr, "statistics_content");
	}

	public function getStatistics($days){
		if($days==0)return 0;
		$days;
		$present = time();
		$past = strtotime("- $days days");
		return $this->orders->getStatistics(array("in_all"), $present, $past);
	}

	public function getPayGoods($days){
		if($days==0)return 0;
		$days;
		$present = time();
		$past = strtotime("- $days days");
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

	public function getWords($days){
		$arr_words = array("день","дня","дней");
		$mod_100 = $days % 100;
		$mod_10 = $mod_100 % 10;
		if($mod_100>10 && $mod_100<20) return $arr_words[2];
		if($mod_10>1 && $mod_10<5) return $arr_words[1];
		if($mod_10==1) return $arr_words[0];
		return $arr_words[2];
	}

}
?>