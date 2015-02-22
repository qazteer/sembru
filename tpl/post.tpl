<div class="name_product_block">
	<div class="text_name"><i>%title%</i></div>
</div>
<div class="check_fon">
	<div class="check_table">
		<div class="cart_tr">
			<div class="post_td">
				<form action="lib/function.php" method="post">
					<p><lable>%name%</lable></p>
					<input type="text" name="name" value="%sendername%" placeholder="%name_r%" required class="check_input">
					<p><lable>%email%</lable></p>
					<input type="text" name="email" value="%login%" placeholder="%email_r%" required class="check_input">
					<p><lable>%subject%</lable></p>
					<input type="text" name="subject" placeholder="%subject_r%" required class="check_input">
					<p><lable>%message%</lable></p>
					<textarea rows="10" cols="45" name="message" required></textarea></br></br>
					<input type="hidden" name="action" value="SendPost">
					<input type="submit" name="submit" value="%send%" class="check_button">
				</form>
			</div>
		</div>
	</div>
</div>