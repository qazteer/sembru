<?php 
	mb_internal_encoding("UTF-8");

	require_once "lib/frontpage_class.php";
	require_once "lib/catalogpage_class.php";
	require_once "lib/aboutpage_class.php";
	require_once "lib/servicespage_class.php";
	require_once "lib/contactpage_class.php";
	require_once "lib/productpage_class.php";
	require_once "lib/cartpage_class.php";
	require_once "lib/regpage_class.php";
	require_once "lib/autpage_class.php";
	require_once "lib/checkoutpage_class.php";
	require_once "lib/postpage_class.php";


	$view = $_GET['view'];
	$lang = $_GET['lang'];
	switch ($view) {
		case "":
			$content = new FrontPage($lang);
			break;
		case "catalog":
			$content = new CatalogPage($lang);
			break;
		case "about":
			$content = new AboutPage($lang);
			break;
		case "services":
			$content = new ServicesPage($lang);
			break;
		case "contact":
			$content = new ContactPage($lang);
			break;
		case "product":
			$content = new ProductPage($lang);
			break;
		case "cart":
			$content = new CartPage($lang);
			break;
		case "reg":
			$content = new RegPage($lang);
			break;
		case "aut":
			$content = new AutPage($lang);
			break;
		case "checkout":
			$content = new CheckoutPage($lang);
			break;
		case "post":
			$content = new PostPage($lang);
			break;
		
		default:exit();
	}

	echo $content->getContent();
 ?>