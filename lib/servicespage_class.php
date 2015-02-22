<?php 

require_once "modules_class.php";

class ServicesPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		return $this->lang->getTitleServices();
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["catalogH"] = "";
		$arr["aboutH"] = "";
		$arr["sevicesH"] = " class='hover_page'";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getMiddle(){
		$result = $this->about->selectAll();
		$arr = $this->lang->getServices($result);
		return $this->getTemplate($arr, "services_content");
	}

	protected function getCircle(){
		return $this->getCircleMenu();
	}

	protected function getHr(){
		$hr = file_get_contents($this->config->dir_tpl."hr.tpl");
		return $hr;
	}

	protected function getKarusel(){
		return $this->madeKarusel();
	}
}

?>