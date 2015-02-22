<div class="frontpage_admin">
	<form action="?view=statistics" method="POST" id="stat"></form>

	<h4>Статистика за %last% <input type="text" name="numer" value="%numer%" form="stat" class="numer"> %days%</h4>
	<table class="table_frontpage" cellspacing="0" cellpadding="0">
		<tr>
			<td class="td_frontpage">
				<b>Количество заказов</b>
			</td>
			<td class="td_frontpage">
				<b>Счетов на сумму</b>
			</td>
			<td class="td_frontpage">
				<b>Купленных товаров</b>
			</td>
		</tr>
		<tr>
			<td class="td_frontpage">
				%count% шт
			</td>
			<td class="td_frontpage">
				%total_price% грн
			</td>
			<td class="td_frontpage">
				%pay_goods% шт
			</td>
		</tr>
	</table>
	<input type="submit" name="submit" value="Посчитать статистику" form="stat" class="bottom_update">		
</div>