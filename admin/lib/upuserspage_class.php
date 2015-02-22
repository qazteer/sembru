<?php 

require_once "modules_class.php";

class UpdateUsersPage extends ModulesClass{

	public function __construct(){
		parent::__construct();
	}

	protected function getTitle(){
		return "Редактирование пользователя";
	}

	protected function addClassHover(){
		$arr["frontH"] = "";
		$arr["ordersH"] = "";
		$arr["goodsH"] = "";
		$arr["usersH"] = " class='hover_page'";
		$arr["contactH"] = "";
		return $arr;
	}

	protected function getMiddle(){
		$id = $this->users->getGET("id", "int", false);
		$page = $this->users->getGET("page", "int", false);
		$user = $this->users->selectOne("id", $id);
		if($user){
			if(isset($_SESSION["error_privileges"])){
				$user["err_prive"] = $_SESSION["error_privileges"];
				unset($_SESSION["error_privileges"]);
			}
			else $user["err_prive"] = "";
			$user["page"] = $page;
			$user["admin"] = $user["admin"] == 0 ? "user" : "admin";
			return $this->getTemplate($user, "upuser");
		}
		else return "<h1>Не удалось выбрать товар с базы!</h1>";
	}
}
?>