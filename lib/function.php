<?php 
require_once "handler_class.php";
$handler = new HandlerClass();

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$action = $_POST["action"];

	$arrMethod = array(
		"edit_in_cart" => "edit_in_cart", 
		"checkoutOrder" => "checkoutOrder", 
		"regUser" => "regUser", 
		"autUser" => "autUser",
		"searchMethod" => "searchMethod",
		"SendPost" => "SendPost"
		);

	if(array_key_exists($action, $arrMethod)){
		$result = $handler->$arrMethod[$action]();
	}
	else{
		echo"Неизвестное действие!";
	}

}
elseif($_SERVER['REQUEST_METHOD'] == "GET"){

	$func = $handler->catalog->getGET("func", "int", false);
	if(!$func) $func = $handler->user->getGET("func", "string", false);
	$result = $handler->dellProdSession($func);
}
else{
	echo "Не коректая отправка формы!";
}

?>