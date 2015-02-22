<?php 

require_once "modules_class.php";

class CheckoutPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		return $this->lang->getTitleCheck();
	}

	protected function getMiddle(){
		if($suc = $this->catalog->getGET("suc", "string", false)){
			if($suc=="yes"){
				$arr = $this->lang->getSuccessful();
				$arr["lang"] = $this->lang->getLang();
				return $this->getTemplate($arr, "successful");
			}
			else{
				$arr = $this->lang->getErrorChack();
				return $this->getTemplate($arr, "error_checkout");
			}
		}
		else{
			$arr = $this->lang->getValueCheck();
			if(isset($_SESSION["name"])){
				$arr["name_buyer"] = $_SESSION["name"];
				$arr["login"] = $_SESSION["login"];
				return $this->getTemplate($arr, "checkout");
			}
			elseif (isset($_COOKIE['name'])) {
				$arr["name_buyer"] = $_COOKIE['name'];
				$arr["login"] = $_COOKIE['login'];
				return $this->getTemplate($arr, "checkout");
			}
			$arr["name_buyer"] = "";
			$arr["login"] = "";
			return $this->getTemplate($arr, "checkout");
		}
		
	}

}

?>