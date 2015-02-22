<?php 

require_once "modules_class.php";

class FrontPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		return $this->lang->getTitleHome();
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
		return file_get_contents($this->config->dir_tpl."index_content.tpl");
	}

	protected function getCircle(){
		return $this->getCircleMenu();
	}

	protected function getHr(){
		return file_get_contents($this->config->dir_tpl."hr.tpl");
	}

	protected function getKarusel(){
		return $this->madeKarusel();
	}
}
?>