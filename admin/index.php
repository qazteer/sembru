<?php 
	mb_internal_encoding("UTF-8");

	require_once "lib/frontpage_class.php";
	require_once "lib/goodspage_class.php";
	require_once "lib/upgoodspage_class.php";
	require_once "lib/ingoodspage_class.php";
	require_once "lib/orderpage_class.php";
	require_once "lib/updatepage_class.php";
	require_once "lib/statisticspage_class.php";
	require_once "lib/userspage_class.php";
	require_once "lib/upuserspage_class.php";

	$view = $_GET['view'];
	switch ($view) {
		case "":
			$content = new FrontPage();
			break;
		case "goods":
			$content = new GoodsPage();
			break;
		case "upgoods":
			$content = new UpdateGoodsPage();
			break;
		case "ingoods":
			$content = new InsertGoodsPage();
			break;
		case "orders":
			$content = new OrderPage();
			break;
		case "update":
			$content = new UpdatePage();
			break;
		case "statistics":
			$content = new StatisticsPage();
			break;
		case "users":
			$content = new UsersPage();
			break;
		case "upusers":
			$content = new UpdateUsersPage();
			break;
		default:exit();
	}

	echo $content->getContent();
 ?>