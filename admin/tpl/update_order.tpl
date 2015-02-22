<div class="frontpage_admin">
	<h4>Редактирование заказа</h4>
	<form action="lib/function.php" method="POST">
		<table class="table_frontpage" cellspacing="0" cellpadding="0">
			<tr>
				<th class="td_frontpage">Товар</th>
				<th class="td_frontpage">Количество</th>
				<th class="td_frontpage">Цена заказа</th>
			</tr>
			%tr%
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Имя заказчика</b></p>
					<input type="text" name="name" value="%name%">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Телефон</b></p>
					<input type="text" name="phone" value="%phone%">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>E-mail</b></p>
					<input type="text" name="email" value="%email%">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Адреc</b></p>
					<textarea name="address" cols="25" rows="5" style="width:170px;">%address%</textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Дата заказа</b></p>
					<input type="text" name="date_order" value="%date_order%" readonly>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Дата отправки</b></p>
					<input type="text" name="date_send" value="%date_send%" placeholder="00-00-0000 00:00">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Дата оплаты</b></p>
					<input type="text" name="date_pay" value="%date_pay%" placeholder="00-00-0000 00:00">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Способ доставки</b></p>
					<select name="delivery" style="width:170px;">
						<option value="0" %null%>Самовывоз</option>
						<option value="1" %one%>Наша логистика</option>
						<option value="2" %two%>Логистика "Деливери"</option>
					</select>
				</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="UpdateOrders">
		<input type="hidden" name="page" value="%page%">
		<input type="submit" name="submit" value="Редактировать" class="bottom_update">
	</form>
</div>