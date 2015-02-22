<?php 

require_once "modules_class.php";

class UpdateGoodsPage extends ModulesClass{

	public function __construct(){
		parent::__construct();
	}

	protected function getTitle(){
		return "Редактирование заказа";
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["ordersH"] = "";
		$arr["goodsH"] = " class='hover_page'";
		$arr["usersH"] = "";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getMiddle(){
		$id = $this->catalog->getGET("id", "int", false);
		$page = $this->catalog->getGET("page", "int", false);
		$product = $this->catalog->selectOne("id", $id);
		/*$section = $this->section->selectOne("id", $product["section"]);*/
		$sections = $this->section->selectAll();
		foreach ($sections as $key => $value) {
			$sections["selected"] = ($value["id"] == $product["section"]) ? "selected" : "";
			$sections["title"] = $value["title_ru"];
			$sections["id"] = $value["id"];
			$options .= $this->getTemplate($sections, "upgoods_options"); 
		}
		if($product){
			$product["options"] = $options;
			$product["date"] = date("d-m-Y H:i", $product["date"]);
			$product["page"] = $page;
			return $this->getTemplate($product, "upgoods");
		}
		else return "<h1>Не удалось выбрать товар с базы!</h1>";
	}
}
?>