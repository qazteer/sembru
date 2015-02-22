<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>%title%</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!--[if lt IE 8]>
  <link rel="stylesheet" type="text/css" href="css/ie_style.css" />
<![endif]-->
  	
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="js/carousel.js"></script>
	<script src="js/jquery.html5-placeholder-shim.js"></script>
	
</head>
<body>


	<div id="bg">
		<div id="header">			
			<div id="topheader">
				<div class="leftbox">
					<div class="home">
						<a href="%lang_home%">
							<img src="img/home.png" alt="back to home"> 
						</a>						
					</div>
					<div class="post">
						<a href="?view=post%lang%">
							<img src="img/post.png" alt="post">
						</a>
						
					</div>										
					<div class="box_lenguage"><a href="%link%lang=ua">UA</a> / <a href="%link%lang=ru">RU</a> / <a href="%link%lang=en">EN</a></div>
					<div class="box_reg">%aut_reg%</div>
				</div>					
				<div class="logo">
					<div class="elips">
						<div class="blockimg">
							<img src="img/logo.png" alt="phone">
							<p>(044) 568-01-91, (098) 536-97-97</p>
						</div>
					</div>
					
			    </div>

			    <script>
				var search_normal = 'img/search_img.png';
				var search_hover = 'img/search_img_hover.png';
				var cart_normal = 'img/cart_img.png';
				var cart_hover = 'img/cart_img_hover.png';
				</script>

				<div class="righttbox">	
					%cart%
					<div>
						<form action="lib/function.php" method="post" class="search_form">
							<input type="image" onmouseover="this.src=search_hover;" onmouseout="this.src=search_normal;" src="img/search_img.png" class="search_img">
							<input type="text" name="search" placeholder="%search%" class="search">	
							<input type="hidden" name="section" value="%section%">
							<input type="hidden" name="lang" value="%lang%">
							<input type="hidden" name="action" value="searchMethod">
						</form>
				    </div>
				</div>

		    </div>
	    </div>

		<div class="topmenu">
			<ul>
				%menu%
			</ul>
		</div>
	
	%content%

	%circle_menu%
    
	%hr%

	%pagination%

	%karusel%

	<div class="footer">
		<div class="green_line"></div>
		<div class="block-left">
			%footer%
		</div>
		<div class="block-right">
			<p><img src="img/post.png" alt="post_img">sembru.com.ua</p>
			<p class="phone"><img src="img/phone.png" alt="phone_img">(044) 568-01-91, (098) 536-97-97</p>
		</div>
	</div> 
	</div>
	
</body>
</html>