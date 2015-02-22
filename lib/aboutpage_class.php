<?php 

require_once "modules_class.php";

class AboutPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		return $this->lang->getTitleTechnology();
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["catalogH"] = "";
		$arr["aboutH"] = " class='hover_page'";
		$arr["sevicesH"] = "";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getMiddle(){
		$result = $this->about->selectAll();
		$arr = $this->lang->getAbout($result);
		return $this->getTemplate($arr, "about_content");
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