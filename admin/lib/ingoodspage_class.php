<?php 

require_once "modules_class.php";

class InsertGoodsPage extends ModulesClass{

	public function __construct(){
		parent::__construct();
	}

	protected function getTitle(){
		return "Добавление товара";
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
		$sections = $this->section->selectAll();
		foreach ($sections as $key => $value) {
			$sections["title"] = $value["title_ru"];
			$sections["id"] = $value["id"];
			$options .= $this->getTemplate($sections, "ingoods_options"); 
		}
		$arr["options"] = $options;
		$arr["id"] = $this->catalog->getGET("id", "int", false);
		$arr["page"] = $this->catalog->getGET("page", "int", false);

		return $this->getTemplate($arr, "ingoods");
	}
}
?>