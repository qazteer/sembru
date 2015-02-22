<?php 

require_once "modules_class.php";

class UpdatePage extends ModulesClass{

	public function __construct(){
		parent::__construct();
	}

	protected function getTitle(){
		return "Редактирование заказа";
	}

	protected function getMiddle(){
		$catalog = $this->catalog->selectAll();
		
		$string_ids = $this->orders->getGET("id","string",false);
		$ids = explode(",", $string_ids);
		$count=0;
		foreach ($ids as $key => $value) {
			$order = $this->orders->selectOne("id", $value);
			foreach ($catalog as $key => $v) {
				$cat["selected"] = ($v["id"] == $order["product_ids"]) ? "selected" : "";
				$cat["id"] = $v["id"];
				$cat["title"] = $v["title"];
				$option .= $this->getTemplate($cat, "options");
			}
			$order["title"] = $option;
			$tr .= $this->getTemplate($order, "update_order_tr");
		}
		
		$order["tr"] = $tr;
		$order["date_order"] = date("d-m-Y", $order["date_order"]);
		$order["date_send"] = $order["date_send"] == 0 ? "Не отправлено" : date("d-m-Y H:i", $order["date_send"]);
		$order["date_pay"] = $order["date_pay"] == 0 ? "Не оплачено" : date("d-m-Y H:i", $order["date_pay"]);
		if($order["delivery"]==0){
			$order["null"] = "selected";
			$order["one"] = "";
			$order["two"] = "";
		}
		elseif($order["delivery"]==1){
			$order["null"] = "";
			$order["one"] = "selected";
			$order["two"] = "";
		}
		elseif($order["delivery"]==2){
			$order["null"] = "";
			$order["one"] = "";
			$order["two"] = "selected";
		}
		$order["page"] = $this->orders->getGET("page", "int", false) ? "&page=".$this->orders->getGET("page", "int", false) : "";
		return $this->getTemplate($order, "update_order");
	}

}
?>