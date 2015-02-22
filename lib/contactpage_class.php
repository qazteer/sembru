<?php 

require_once "modules_class.php";

class ContactPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		return $this->lang->getTitleContact();
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["catalogH"] = "";
		$arr["aboutH"] = "";
		$arr["sevicesH"] = "";
		$arr["contactH"] = " class='hover_page'";
		return $arr;
	}

	protected function getMiddle(){
		$arr = $this->lang->getContact();
		return $this->getTemplate($arr, "contact_content");
	}

}
?>