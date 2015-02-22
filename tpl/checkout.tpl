<div class="name_product_block">
	<div class="text_name"><i>%title%</i></div>
</div>
<div class="check_fon">
	<div class="check_table">
		<div class="cart_tr">
			<div class="check_td">
				<form action="lib/function.php" method="post">
					<p><lable>%delivery%</lable></p>
					<select name="delivery" class="check_input">
						<option value="0" selected>%your%</option>
						<option value="1">%our%</option>
						<option value="2">%national%</option>
					</select>
					<p><lable>%name%</lable></p>
					<input type="text" name="name" value="%name_buyer%" placeholder="%name_r%" required class="check_input"><br>
					<p><lable>%phone%</lable></p>
					<input type="text" name="phone" placeholder="%phone_r%" required class="check_input"><br>
					<p><lable>%email%</lable></p>
					<input type="text" name="email" value="%login%" placeholder="%email_r%" required class="check_input"><br><br>
					<input type="hidden" name="action" value="checkoutOrder">
					<input type="submit" name="order" value="%checkout%" class="check_button">
				</form>
			</div>
		</div>
	</div>
</div>