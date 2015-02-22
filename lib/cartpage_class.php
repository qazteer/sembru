<?php 

require_once "modules_class.php";

class CartPage extends ModulesClass{

	public function __construct($lang){
		parent::__construct($lang);
	}

	protected function getTitle(){
		return $this->lang->getTitleBasket();
	}

	protected function getMiddle(){

		if(!empty($_SESSION['user'])){

			foreach ($_SESSION['user'] as $key => $value) {
				$product = $this->catalog->selectOne("id", $key);
					$prod = $this->lang->getValueCart($product);
				$price = $product["price"] * $value;

				$arr["lang"] = $this->lang->getLang();
				$arr["id"] = $key;
				$arr["img"] = $product["img"];
				$arr["title"] = $prod["title"]; 
				$arr["count"] = $value;

					if(isset($_POST[$arr["id"]])){
						if($_POST["plus"]){
							$arr["count"]++;
							$_SESSION['user'][$arr["id"]] = $arr["count"];
							header("Location:/sembru/?view=cart".$arr["lang"]);
						}
						elseif($_POST["minus"]){
							$arr["count"]--;
							if($arr["count"] <= 0) {
								unset($_SESSION['user'][$arr["id"]]);
							}
							else {
								$_SESSION['user'][$arr["id"]] = $arr["count"];
							}
							header("Location:/sembru/?view=cart".$arr["lang"]);
						}
						else{
							$arr["count"] = $value;
						}
					}

				$arr["price"] = $product["price"];
				$arr["curr"] = $prod["curr"];
				$tr .= $this->getTemplate($arr, "cart_tr");
					
				$allPrice += $price;
			}
			$text = $this->lang->getTitleCart();
			$text["lang"] = $this->lang->getLang();
			$text["tr"] = $tr;
			$text["sum"] = $allPrice;
			return $this->getTemplate($text, "cart_content");
		}
		else{
			$text = $this->lang->getEmptyCart();
			return $this->getTemplate($text, "cart_empty");
		}
	}

}

?>
