

<div class="name_product_block">
	<div class="text_name"><i>%titleReg%</i></div>
</div>
	<div class="reg_fon">
		<div class="reg_table">
			<div class="cart_tr">
				<div class="reg_td">
					<form action="lib/function.php" method="post">
						<p align="center" class="error">%error_reg%</p>
						<input type="text" name="name" placeholder="%name%" required class="reg_input%name_border%"><br>
						<p><lable>%text_name%</lable></p>
						<input type="text" name="login" placeholder="%email%" required class="reg_input%login_border%"><br>
						<p><lable>%text_email%</lable></p>
						<p><input type="password" name="password" placeholder="%pass%" required class="password%pass_border%"></p>
						<p><input type="password" name="r_password" placeholder="%pass_repeat%" required class="password%pass_border%"></p>
						<input type="hidden" name="action" value="regUser">
						<p><input type="submit" name="reg" value="%signup%" class="reg_button"></p>
					</form>
				</div>
			</div>
		</div>
	</div>