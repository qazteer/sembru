<?php 

require_once "modules_class.php";
session_start();

class AutPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		return $this->lang->getTitleLogin();
	}

	protected function getMiddle(){
		$arr = $this->lang->getFormAut();
		$arr["login_border"] = "";
		$arr["pass_border"] = "";
		
		if($_SESSION["error_reg"]=="empty_login") {
			$arr["error_reg"] = $arr["empty"];
			$arr["login_border"] = "_border";
			$arr["pass_border"] = "";
			unset($_SESSION["error_reg"]);
		}
		elseif($_SESSION["error_reg"]=="empty_pass") {
			$arr["error_reg"] = $arr["empty"];
			$arr["pass_border"] = "_border";
			$arr["login_border"] = "";
			unset($_SESSION["error_reg"]);
		}
		elseif($_SESSION["error_reg"]==1) {
			$arr["error_reg"] = $arr["error_login"];
			unset($_SESSION["error_reg"]);
		}
		elseif ($_SESSION["error_reg"]==2) {
			$arr["error_reg"] = $arr["error_pass"];
			unset($_SESSION["error_reg"]);
		}
		elseif ($_SESSION["error_reg"]==3) {
			$arr["error_reg"] = $arr["error_admin"];
			unset($_SESSION["error_reg"]);
		}
		else{
			$arr["error_reg"] = "";
		}
		return $this->getTemplate($arr, "aut");
	}
}

?>