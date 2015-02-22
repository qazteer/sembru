<?php 

require_once "modules_class.php";

class ProductPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		$product = $this->lang->getTitleProduct($this->getProduct());
		return $product["title"];
	}

	protected function getMiddle(){
		$productID = $this->catalog->getGET("productID", "int", false);
		$product = $this-> getProduct();
		if($product){
			$arr = $this->lang->getTitleProduct($product);
			$arr["price"] = number_format($product["price"],2);
			$arr["img"] = $product["img"];
			$arr["link"] = "lib/function.php";
			$arr["productID"] = $productID;
			return $this->getTemplate($arr, "product");
		}
		else{
			$arr = $this->lang->IfProductEmpty($productID);
			return $this->getTemplate($arr, "product_empty");
		}
	}

	private function getProduct(){
		$productID = $this->catalog->getGET("productID", "int", false);
		return $this->catalog->selectOne("id", $productID);
	}

	protected function getCircle(){
		return $this->getCircleMenu();
	}

	protected function getHr(){
		return file_get_contents($this->config->dir_tpl."hr.tpl");
	}

	protected function getKarusel(){
		return $this->madeKarusel();
	}
}
?>