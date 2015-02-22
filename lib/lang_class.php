<?php 

class Lang{

	private $lang;

	public function __construct($lang){
		$this->lang = $lang;
	}

	public function getLang(){
		if($this->lang) return "&lang=".$this->lang;
		return "";
	}

	public function getTitleHome(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "Головна";
		}
		elseif($this->lang=="ru"){
			$title = "Главная";
		}
		elseif($this->lang=="en"){
			$title = "Home";
		}

		return $title;
	}

	public function getTitleCatalog(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "Каталог";
		}
		elseif($this->lang=="ru"){
			$title = "Каталог";
		}
		elseif($this->lang=="en"){
			$title = "Catalog";
		}

		return $title;
	}

	public function getTitleTechnology(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "ТехнологіЇ";
		}
		elseif($this->lang=="ru"){
			$title = "Технологии";
		}
		elseif($this->lang=="en"){
			$title = "Technology";
		}

		return $title;
	}

	public function getTitleServices(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "Послуги";
		}
		elseif($this->lang=="ru"){
			$title = "Услуги";
		}
		elseif($this->lang=="en"){
			$title = "Services";
		}

		return $title;
	}

	public function getTitleContact(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "Контакти";
		}
		elseif($this->lang=="ru"){
			$title = "Контакты";
		}
		elseif($this->lang=="en"){
			$title = "Contacts";
		}

		return $title;
	}

	public function getTitleLogin(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "Вхід";
		}
		elseif($this->lang=="ru"){
			$title = "Вход";
		}
		elseif($this->lang=="en"){
			$title = "Login";
		}

		return $title;
	}

	public function getTitleReg(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "Реєстрація";
		}
		elseif($this->lang=="ru"){
			$title = "Регистрация";
		}
		elseif($this->lang=="en"){
			$title = "Registration";
		}

		return $title;
	}

	public function getTitleBasket(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "Кошик";
		}
		elseif($this->lang=="ru"){
			$title = "Корзина";
		}
		elseif($this->lang=="en"){
			$title = "Shopping cart";
		}

		return $title;
	}

	public function getTitleCheck(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "Оформлення заказу";
		}
		elseif($this->lang=="ru"){
			$title = "Оформление заказа";
		}
		elseif($this->lang=="en"){
			$title = "Checkout";
		}

		return $title;
	}

	public function getTitlePost(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "Надіслати повідомлення";
		}
		elseif($this->lang=="ru"){
			$title = "Отправить сообщение";
		}
		elseif($this->lang=="en"){
			$title = "Send a message";
		}

		return $title;
	}

	public function getAutReg(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["input"] = "Вхід";
			$arr["reg"] = "Реєстрація";
			$arr["output"] = "Вихід";
			$arr["welcome"] = "Привіт, ";
		}
		elseif($this->lang=="ru"){
			$arr["input"] = "Вход";
			$arr["reg"] = "Регистрация";
			$arr["output"] = "Выход";
			$arr["welcome"] = "Привет, ";
		}
		elseif($this->lang=="en"){
			$arr["input"] = "Login";
			$arr["reg"] = "Registration";
			$arr["output"] = "Exit";
			$arr["welcome"] = "Hello, ";
		}

		return $arr;
	}

	public function getFormAut(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["titleAut"] = "ВХІД НА САЙТ";
			$arr["email"] = "Введіть логін";
			$arr["pass"] = "Введіть пароль";
			$arr["login"] = "Вхід";
			$arr["empty"] = "Заповніть всі поля!";
			$arr["error_login"] = "Такий e-mail не існує!";
			$arr["error_pass"] = "Ви ввели невірній пароль!";
			$arr["error_admin"] = "Введіть логін та пароль адміністратора!";
		}
		elseif($this->lang=="ru"){
			$arr["titleAut"] = "ВХОД НА САЙТ";
			$arr["email"] = "Введите логин";
			$arr["pass"] = "Введите пароль";
			$arr["login"] = "Вход";
			$arr["empty"] = "Заполните все поля!";
			$arr["error_login"] = "Такой e-mail не существует!";
			$arr["error_pass"] = "Вы ввели неверный пароль!";
			$arr["error_admin"] = "Введите логин и пароль администратора!";

		}
		elseif($this->lang=="en"){
			$arr["titleAut"] = "LOGIN";
			$arr["email"] = "Enter login";
			$arr["pass"] = "Enter password";
			$arr["login"] = "Login";
			$arr["empty"] = "Fill out all fields!";
			$arr["error_login"] = "This e-mail does not exist!";
			$arr["error_pass"] = "You have entered the wrong password!";
			$arr["error_admin"] = "Enter the administrator login and password!";
		}

		return $arr;
	}

	public function getFormReg(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["titleReg"] = "РЕЄСТРАЦІЯ";
			$arr["name"] = "Ім'я";
			$arr["text_name"] = "Введіть ваше ім'я, щоб ми знали як до вас звертатися";
			$arr["email"] = "E-mail";
			$arr["text_email"] = "Використовуватиметься як логін";
			$arr["pass"] = "Пароль";
			$arr["pass_repeat"] = "Повторіть пароль";
			$arr["signup"] = "Реєстрація";
			$arr["empty"] = "Заповніть всі поля!";
			$arr["error_login"] = "Такий e-mail вже існує!";
			$arr["error_pass"] = "Введені паролі не збігаються!";
		}
		elseif($this->lang=="ru"){
			$arr["titleReg"] = "РЕГИСТРАЦИЯ";
			$arr["name"] = "Имя";
			$arr["text_name"] = "Введите ваше имя, чтобы мы знали как к вам обращаться";
			$arr["email"] = "E-mail";
			$arr["text_email"] = "Будет использоваться в качестве логина";
			$arr["pass"] = "Пароль";
			$arr["pass_repeat"] = "Повторите пароль";
			$arr["signup"] = "Регистрация";
			$arr["empty"] = "Заполните все поля!";
			$arr["error_login"] = "Такой e-mail уже существует!";
			$arr["error_pass"] = "Введённые пароли не совпадают!";
		}
		elseif($this->lang=="en"){
			$arr["titleReg"] = "REGISTRATION";
			$arr["name"] = "Name";
			$arr["text_name"] = "Enter your name so we know how to contact you";
			$arr["email"] = "E-mail";
			$arr["text_email"] = "Will be used as login";
			$arr["pass"] = "Password";
			$arr["pass_repeat"] = "Repeat password";
			$arr["signup"] = "Registration"; 
			$arr["empty"] = "Fill out all fields!";
			$arr["error_login"] = "Such e-mail already exists!";
			$arr["error_pass"] = "The entered passwords do not match!"; 
		}

		return $arr;
	}

	public function getCart($numer){
		if($this->lang=="" or $this->lang=="ua"){
			$words = array("товар","товара","товарів");
			$arr["goods"] = $words[$numer];
			$arr["curr"] = "грн";
		}
		elseif($this->lang=="ru"){
			$words = array("товар","товара","товаров");
			$arr["goods"] = $words[$numer];
			$arr["curr"] = "грн";
		}
		elseif($this->lang=="en"){
			$arr["goods"] = "goods";
			$arr["curr"] = "UAH";
		}

		return $arr;
	}

	public function getSearch(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["search"] = "Пошук...";
		}
		elseif($this->lang=="ru"){
			$arr["search"] = "Поиск...";
		}
		elseif($this->lang=="en"){
			$arr["search"] = "Search...";
		}

		return $arr;
	}

	public function getSearchError(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["not_goods"] = "<p>В заданій категорії товари відсутні!</p>";
			$arr["error_not"] = "<p>За вашим запитом нічого не знайдено!</p>";
			$arr["litle"] = "<p>Занадто короткий пошуковий запит.</p>";
			$arr["big"] = "<p>Занадто довгий пошуковий запит.</p>";
			$arr["null"] = "<p>Заданий порожній пошуковий запит.</p>";


		}
		elseif($this->lang=="ru"){
			$arr["not_goods"] = "<p>В заданной категории товары отсутствуют!</p>";
			$arr["error_not"] = "<p>По вашему запросу ничего не найдено!</p>";
			$arr["litle"] = "<p>Слишком короткий поисковый запрос.</p>";
			$arr["big"] = "<p>Слишком длинный поисковый запрос.</p>";
			$arr["null"] = "<p>Задан пустой поисковый запрос.</p>";
		}
		elseif($this->lang=="en"){
			$arr["not_goods"] = "<p>In a given category not available of goods!</p>";
			$arr["error_not"] = "<p>At your request, nothing found!</p>";
			$arr["litle"] = "<p>Too short search request.</p>";
			$arr["big"] = "<p>Too long search request.</p>";
			$arr["null"] = "<p>Ask an empty search query.</p>";
		}

		return $arr;
	}



	public function getLangMenu(){
		if($this->lang=="" or $this->lang=="ua"){
			$menu["home"] = "ГОЛОВНА СТОРОІНКА";
			$menu["catalog"] = "КАТАЛОГ ТОВАРІВ";
			$menu["about"] = "НАШІ ТЕХНОЛОГІЇ";
			$menu["services"] = "ПОСЛУГИ";
			$menu["contact"] = "КОНТАКТИ";
		}
		elseif($this->lang=="ru"){
			$menu["home"] = "ГЛАВНАЯ СТРАНИЦА";
			$menu["catalog"] = "КАТАЛОГ ТОВАРОВ";
			$menu["about"] = "НАШИ ТЕХНОЛОГИИ";
			$menu["services"] = "УСЛУГИ";
			$menu["contact"] = "КОНТАКТЫ";
		}
		elseif($this->lang=="en"){
			$menu["home"] = "HOME";
			$menu["catalog"] = "CATALOGUE";
			$menu["about"] = "OUR TECHNOLOGY";
			$menu["services"] = "SERVICES";
			$menu["contact"] = "CONTACTS";
		}

		return $menu;
	}

	public function getCircleMenu($result){
		if($this->lang=="" or $this->lang=="ua"){
			$arr[1] = $result[0]["title"];
			$arr[2] = $result[1]["title"];
			$arr[3] = $result[2]["title"];
			$arr[4] = $result[3]["title"];
			$arr[5] = $result[4]["title"];
			$arr[6] = $result[5]["title"];
		}
		elseif($this->lang=="ru"){
			$arr[1] = $result[0]["title_ru"];
			$arr[2] = $result[1]["title_ru"];
			$arr[3] = $result[2]["title_ru"];
			$arr[4] = $result[3]["title_ru"];
			$arr[5] = $result[4]["title_ru"];
			$arr[6] = $result[5]["title_ru"];
		}
		elseif($this->lang=="en"){
			$arr[1] = $result[0]["title_en"];
			$arr[2] = $result[1]["title_en"];
			$arr[3] = $result[2]["title_en"];
			$arr[4] = $result[3]["title_en"];
			$arr[5] = $result[4]["title_en"];
			$arr[6] = $result[5]["title_en"];
		}

		return $arr;
	}

	public function getDefault(){
		if($this->lang=="" or $this->lang=="ua"){
			$title = "ВСІ ДИВАНИ";
		}
		elseif($this->lang=="ru"){
			$title = "ВСЕ ДИВАНЫ";
		}
		elseif($this->lang=="en"){
			$title = "ALL SOFAS";
		}

		return $title;
	}

	public function getTitleProduct($arr){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["title"] = $arr["title"];
			$arr["back"] = "<a href='?view=catalog".$_SESSION["param"]."' class='backtocat'><<&nbsp;ПОВЕРНУТИСЯ В КАТАЛОГ</a>";
			$arr["description"] = $arr["description"];
			$arr["title_f"] = "ХАРАКТЕРИСТИКИ:";
			$arr["features"] = $arr["features"];
			$arr["curr"] = "грн";
			$arr["pr"] = "ЦІНА: ";
			$arr["buy"] = "В кошик";
		}
		elseif($this->lang=="ru"){
			$arr["title"] = $arr["title_ru"];
			$arr["back"] = "<a href='?view=catalog".$_SESSION["param"]."' class='backtocat'><<&nbsp;ВЕРНУТЬСЯ В КАТАЛОГ</a>";
			$arr["description"] = $arr["description_ru"];
			$arr["title_f"] = "ХАРАКТЕРИСТИКИ:";
			$arr["features"] = $arr["features_ru"];
			$arr["curr"] = "грн";
			$arr["pr"] = "ЦЕНА: ";
			$arr["buy"] = "В корзину";
		}
		elseif($this->lang=="en"){
			$arr["title"] = $arr["title_en"];
			$arr["back"] = "<a href='?view=catalog".$_SESSION["param"]."' class='backtocat'><<&nbsp;BACK TO CATALOG</a>";
			$arr["description"] = $arr["description_en"];
			$arr["title_f"] = "FEATURES:";
			$arr["features"] = $arr["features_en"];
			$arr["curr"] = "UAH";
			$arr["pr"] = "PRICE: ";
			$arr["buy"] = "Add to Cart";
		}
		return $arr;

	}

	public function IfProductEmpty($productID){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["back"] = "<a href='?view=catalog".$_SESSION["param"]."' class='backtocat'><<&nbsp;ПОВЕРНУТИСЯ В КАТАЛОГ</a>";
			$arr["text"] = "На жаль, в нашому Інтернет-магазині відсутній товар ".$productID;
		}
		elseif($this->lang=="ru"){
			$arr["back"] = "<a href='?view=catalog".$_SESSION["param"]."' class='backtocat'><<&nbsp;ВЕРНУТЬСЯ В КАТАЛОГ</a>";
			$arr["text"] = "К сожалению, в нашем Интернет-магазине отсутствует товар ".$productID;
		}
		elseif($this->lang=="en"){
			$arr["back"] = "<a href='?view=catalog".$_SESSION["param"]."' class='backtocat'><<&nbsp;BACK TO CATALOG</a>";
			$arr["text"] = "Unfortunately, in our online store no items ".$productID;
		}
		return $arr;

	}

	public function getAbout($result){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["about"] = $result[0]["about"];
		}
		elseif($this->lang=="ru"){
			$arr["about"] = $result[0]["about_ru"];
		}
		elseif($this->lang=="en"){
			$arr["about"] = $result[0]["about_en"];
		}

		return $arr;
	}

	public function getServices($result){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["services"] = $result[0]["services"];
		}
		elseif($this->lang=="ru"){
			$arr["services"] = $result[0]["services_ru"];
		}
		elseif($this->lang=="en"){
			$arr["services"] = $result[0]["services_en"];
		}

		return $arr;
	}

	public function getForm(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["title"] = "Впорядкувати по:";
			$arr["min"] = "від дешевих";
			$arr["max"] = "від дорожчих";
			$arr["first"] = "перші надходження";
			$arr["last"] = "останні надходження";
			$arr["price"] = "Ціні";
			$arr["date"] = "Даті";
		}
		elseif($this->lang=="ru"){
			$arr["title"] = "Сортировать по:";
			$arr["min"] = "от дешевых";
			$arr["max"] = "от дорогих";
			$arr["first"] = "первые поступления";
			$arr["last"] = "последние поступления";
			$arr["price"] = "Цене";
			$arr["date"] = "Дате";
		}
		elseif($this->lang=="en"){
			$arr["title"] = "Sort by:";
			$arr["min"] = "from cheap";
			$arr["max"] = "from expensive";
			$arr["first"] = "first";
			$arr["last"] = "latest";
			$arr["price"] = "Price";
			$arr["date"] = "Date";
		}

		return $arr;
	}

	public function getValueCart($value){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["title"] = $value["title"];
			$arr["curr"] = "грн";
		}
		elseif($this->lang=="ru"){
			$arr["title"] = $value["title_ru"];
			$arr["curr"] = "грн";
		}
		elseif($this->lang=="en"){
			$arr["title"] = $value["title_en"];
			$arr["curr"] = "UAH";
		}
		return $arr;

	}

	public function getTitleCart(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["cart"] = "КОШИК";
			$arr["img"] = "Картинка";
			$arr["title"] = "Найменування";
			$arr["quantity"] = "Кількість";
			$arr["price"] = "Ціна";
			$arr["del"] = "Видалити";
			$arr["curr"] = "грн";
			$arr["allsumm"] = "Загальна сума замовлення: ";
			$arr["ordering"] = "Оформити замовлення";
		}
		elseif($this->lang=="ru"){
			$arr["cart"] = "КОРЗИНА";
			$arr["img"] = "Картинка";
			$arr["title"] = "Наименование";
			$arr["quantity"] = "Количество";
			$arr["price"] = "Цена";
			$arr["del"] = "Удалить";
			$arr["curr"] = "грн";
			$arr["allsumm"] = "Общая сумма заказа: ";
			$arr["ordering"] = "Оформить заказ";
		}
		elseif($this->lang=="en"){
			$arr["cart"] = "SHOPPING CART";
			$arr["img"] = "Image";
			$arr["title"] = "Title";
			$arr["quantity"] = "Quantity";
			$arr["price"] = "Price";
			$arr["del"] = "Remove";
			$arr["curr"] = "UAH";
			$arr["allsumm"] = "Total amount: ";
			$arr["ordering"] = "Proceed to checkout";
		}

		return $arr;
	}

	public function getEmptyCart(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["cart"] = "КОШИК";
			$arr["img"] = "img/korzina.jpg";
			$arr["text"] = "Ваш кошик порожній!";
			$arr["getcatalog"] = "Щоб наповнити його, перейдіть в <a href='?view=catalog&amp;lang=ua' class='ourcat'>наш каталог</a>.";
		}
		elseif($this->lang=="ru"){
			$arr["cart"] = "КОРЗИНА";
			$arr["img"] = "img/korzina.jpg";
			$arr["text"] = "Ваша корзина пуста!";
			$arr["getcatalog"] = "Чтобы наполнить её, перейдите в <a href='?view=catalog&amp;lang=ru' class='ourcat'>наш каталог</a>.";
		}
		elseif($this->lang=="en"){
			$arr["cart"] = "SHOPPING CART";
			$arr["img"] = "img/korzina.jpg";
			$arr["text"] = "Your cart is empty!";
			$arr["getcatalog"] = "To fill it, please go to <a href='?view=catalog&amp;lang=en' class='ourcat'>our catalog</a>.";
		}

		return $arr;
	}

	public function getValueCheck(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["title"] = "ОФОРМЛЕННЯ ЗАМОВЛЕННЯ";
			$arr["delivery"] = "Доставка";
			$arr["your"] = "Самовивіз";
			$arr["our"] = "Наша логістика";
			$arr["national"] = "Логістика \"Делівері\"";
			$arr["name"] = "Ім'я покупця";
			$arr["name_r"] = "Ім'я";
			$arr["phone"] = "Телефон";
			$arr["phone_r"] = "Телефон";
			$arr["email"] = "Email";
			$arr["email_r"] = "Email";
			$arr["checkout"] = "Підтвердити замовлення";
		}
		elseif($this->lang=="ru"){
			$arr["title"] = "ОФОРМЛЕНИЕ ЗАКАЗА";
			$arr["delivery"] = "Доставка";
			$arr["your"] = "Самовывоз";
			$arr["our"] = "Наша логистика";
			$arr["national"] = "Логистика \"Деливери\"";
			$arr["name"] = "Имя покупателя";
			$arr["name_r"] = "Имя";
			$arr["phone"] = "Телефон";
			$arr["phone_r"] = "Телефон";
			$arr["email"] = "Email";
			$arr["email_r"] = "Email";
			$arr["checkout"] = "Подтвердить заказ";
		}
		elseif($this->lang=="en"){
			$arr["title"] = "CHECKOUT";
			$arr["delivery"] = "Delivery";
			$arr["your"] = "Export";
			$arr["our"] = "Our logistics";
			$arr["national"] = "Logistics \"Delivery\"";
			$arr["name"] = "The buyer's name";
			$arr["name_r"] = "Name";
			$arr["phone"] = "Phone";
			$arr["phone_r"] = "Phone";
			$arr["email"] = "Email";
			$arr["email_r"] = "Email";
			$arr["checkout"] = "Confirm order";
		}

		return $arr;
	}

	public function getSuccessful(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["title"] = "ЗАМОВЛЕННЯ ПРИЙНЯТЕ";
			$arr["text"] = "Ваше замовлення успішно прийняте!";
			$arr["text2"] = "Найближчим часом з Вами зв'яжеться оператор";
			$arr["back"] = "Повернутися в каталог";
		}
		elseif($this->lang=="ru"){
			$arr["title"] = "ЗАКАЗ ПРИНЯТ";
			$arr["text"] = "Ваш заказ успешно принят!";
			$arr["text2"] = "В ближайшее время с Вами свяжется оператор";
			$arr["back"] = "Вернуться в каталог";
		}
		elseif($this->lang=="en"){
			$arr["title"] = "ORDER ACCEPTED";
			$arr["text"] = "Your order has been successfully received!";
			$arr["text2"] = "In the near future you will be contacted operator";
			$arr["back"] = "Back to catalog";
		}

		return $arr;
	}

	public function getErrorChack(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["title"] = "ПОМИЛКА!";
			$arr["error_text"] = "Поверніться в кошик і спробуйте ще раз!";
			$arr["lang"] = $this->getLang();
			$arr["back"] = "Повернутися в кошик";
		}
		elseif($this->lang=="ru"){
			$arr["title"] = "ОШИБКА!";
			$arr["error_text"] = "Вернитесь в корзину и попробуйте ещё раз!";
			$arr["lang"] = $this->getLang();
			$arr["back"] = "Вернуться в корзину";
		}
		elseif($this->lang=="en"){
			$arr["title"] = "ERROR!";
			$arr["error_text"] = "Go back to the basket and try again!";
			$arr["lang"] = $this->getLang();
			$arr["back"] = "Back to basket";
		}

		return $arr;
	}

	public function getValuePost(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["title"] = "НАДІСЛАТИ ПОВІДОМЛЕННЯ";
			$arr["name"] = "Ваше ім'я";
			$arr["name_r"] = "Ім'я";
			$arr["email"] = "Ваш Email";
			$arr["email_r"] = "Email";
			$arr["subject"] = "Тема";
			$arr["subject_r"] = "Тема";
			$arr["message"] = "Повідомлення";
			$arr["send"] = "Надіслатм повідомлення";
		}
		elseif($this->lang=="ru"){
			$arr["title"] = "ОТПРАВИТЬ СООБЩЕНИЕ";
			$arr["name"] = "Ваше имя";
			$arr["name_r"] = "Имя";
			$arr["email"] = "Ваш Email";
			$arr["email_r"] = "Email";
			$arr["subject"] = "Тема";
			$arr["subject_r"] = "Тема";
			$arr["message"] = "Сообщение";
			$arr["send"] = "Отправить сообщение";
		}
		elseif($this->lang=="en"){
			$arr["title"] = "SEND MESSAGE";
			$arr["name"] = "Your name";
			$arr["name_r"] = "Name";
			$arr["email"] = "Your Email";
			$arr["email_r"] = "Email";
			$arr["subject"] = "Subject";
			$arr["subject_r"] = "Subject";
			$arr["message"] = "Message";
			$arr["send"] = "Send a message";
		}

		return $arr;
	}

	public function IfSendYes(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["title"] = "НАДІСЛАТИ ПОВІДОМЛЕННЯ";
			$arr["send"] = "Ваше повідомлення успішно відправлено!";
		}
		elseif($this->lang=="ru"){
			$arr["title"] = "ОТПРАВИТЬ СООБЩЕНИЕ";
			$arr["send"] = "Ваше сообщение успешно отправлено!";
		}
		elseif($this->lang=="en"){
			$arr["title"] = "SEND MESSAGE";
			$arr["send"] = "Your message has been successfully sent!";
		}

		return $arr;
	}

	public function IfSendNo(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["title"] = "НАДІСЛАТИ ПОВІДОМЛЕННЯ";
			$arr["send"] = "Помилка! Повідомлення не відправлено!";
		}
		elseif($this->lang=="ru"){
			$arr["title"] = "ОТПРАВИТЬ СООБЩЕНИЕ";
			$arr["send"] = "Ошибка! Сообщение не отправлено!";
		}
		elseif($this->lang=="en"){
			$arr["title"] = "SEND MESSAGE";
			$arr["send"] = "Error! Message has not been sent!";
		}

		return $arr;
	}

	public function getNavigation(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["back"] = "НАЗАД";
			$arr["next"] = "ДАЛІ";
		}
		elseif($this->lang=="ru"){
			$arr["back"] = "НАЗАД";
			$arr["next"] = "ВПЕРЁД";
		}
		elseif($this->lang=="en"){
			$arr["back"] = "BACK";
			$arr["next"] = "NEXT";
		}
		return $arr;

	}

	public function getContact(){
		if($this->lang=="" or $this->lang=="ua"){
			$arr["contact_data"] = "Контактні дані";
			$arr["phone"] = "Тел";
			$arr["schedule"] = "Графік роботи";
			$arr["days"] = "Пн. - Пт.";
			$arr["saturday"] = "Субота";
			$arr["sunday"] = "Неділя";
			$arr["holiday"] = "вихідний";
		}
		elseif($this->lang=="ru"){
			$arr["contact_data"] = "Контактные данные";
			$arr["phone"] = "Тел";
			$arr["schedule"] = "График работы";
			$arr["days"] = "Пн. - Пт.";
			$arr["saturday"] = "Суббота";
			$arr["sunday"] = "Воскресенье";
			$arr["holiday"] = "выходной";
		}
		elseif($this->lang=="en"){
			$arr["contact_data"] = "Contacts";
			$arr["phone"] = "Tel";
			$arr["schedule"] = "Schedule";
			$arr["days"] = "Mon. - Fri.";
			$arr["saturday"] = "Saturday";
			$arr["sunday"] = "Sunday";
			$arr["holiday"] = "holiday";
		}

		return $arr;
	}

	public function getFooter(){
		if($this->lang=="" or $this->lang=="ua"){
			$footer = '<p>Данний інтернет-магазин є офіційним дилером продукції торгової марки "СЕМБРУ"</p>
			<p>&copy; Інтернет магазин брендових меблів "СЕМБРУ", 2014</p>';
		}
		elseif($this->lang=="ru"){
			$footer = '<p>Данный интернет-магазин является официальным дилером продукции торговой марки "СЕМБРУ"</p>
			<p>&copy; Интернет магазин брендовой мебели "СЕМБРУ", 2014</p>';
		}
		elseif($this->lang=="en"){
			$footer = '<p>The given online shop is an authorized dealer of brand name products "SEMBRU"</p>
			<p>&copy; Shop branded furniture "SEMBRU", 2014</p>';
		}

		return $footer;
	}

}
?>