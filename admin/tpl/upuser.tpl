<div class="frontpage_admin">
	<h4>Редактирование пользователя</h4>
	<form action="lib/function.php" method="POST">
		<table class="table_frontpage" cellspacing="0" cellpadding="0">
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>id</b></p>
					<input type="text" name="id" value="%id%" readonly>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Имя пользователя</b></p>
					<input type="text" name="name" value="%name%" required>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>E-mail(Логин)</b></p>
					<input type="text" name="login" value="%login%" required>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Привилегии</b></p>
					<input type="text" name="admin" value="%admin%" placeholder="'user' or 'admin'" required>
					<p style="color:#ff0000;">%err_prive%</p>
				</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="UpdateUsers">
		<input type="hidden" name="page" value="%page%">
		<input type="submit" name="submit" value="Редактировать" class="bottom_update">
	</form>
</div>