<?php 

require_once "modules_class.php";

class PostPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		return $this->lang->getTitlePost();
	}

	protected function getMiddle(){
		$send = $this->catalog->getGET("send", "string", false);
		if($send == "yes"){
			$arr = $this->lang->IfSendYes();
			return $this->getTemplate($arr, "post_result");
		}
		elseif($send == "no"){
			$arr = $this->lang->IfSendNo();
			return $this->getTemplate($arr, "post_result");		}
		else{
			$arr = $this->lang->getValuePost();
			if(isset($_SESSION["login"])){
				$arr["sendername"] = $_SESSION["name"];
				$arr["login"] = $_SESSION["login"];
				return $this->getTemplate($arr, "post");
			}
			elseif (isset($_COOKIE['login'])) {
				$arr["sendername"] = $_COOKIE['name'];
				$arr["login"] = $_COOKIE['login'];
				return $this->getTemplate($arr, "post");
			}
			$arr["sendername"] = "";
			$arr["login"] = "";
			return $this->getTemplate($arr, "post");
		}
	}

}

?>