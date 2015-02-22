<?php 

	require_once "handler_class.php";

	$handler = new HandlerClass();
	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$action = $_POST["action"];

		$arrMethod = array(
			"UpdateOrders" => "UpdateOrders",
			"UpdateGoods" => "UpdateGoods",
			"InsertGoods" => "InsertGoods",
			"UpdateUsers" => "UpdateUsers"
			);

		if(array_key_exists($action, $arrMethod)){
			$result = $handler->$arrMethod[$action]();
		}
		else{
			echo"Неизвестное действие!";
		}

	}
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		if($table = $handler->orders->getGET("table", "string", false)){
			$back = $handler->orders->getGET("back", "string", false);
			$handler->delete($table, $back);
		}
		if(isset($_GET["admin"])){
			if($_GET["admin"] == "exit"){
				$handler->exitAdmin();
			}
		}
			
	}

 ?>