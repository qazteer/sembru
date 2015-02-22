<div class="frontpage_admin">
	<h4>Добавление товара</h4>
	<form enctype="multipart/form-data" action="lib/function.php" method="POST">
		<table class="table_frontpage" cellspacing="0" cellpadding="0">
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Секция</b></p>
					<select name="section">
						%options%
					</select>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Добавить аватар</b></p>
					<input type="file" name="img" accept="image/*">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Наименование(UA)</b></p>
					<input type="text" name="title">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Наименование(RU)</b></p>
					<input type="text" name="title_ru">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Наименование(EN)</b></p>
					<input type="text" name="title_en">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Описание(UA)</b></p>
					<textarea name="description" cols="50" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Описание(RU)</b></p>
					<textarea name="description_ru" cols="50" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Описание(EN)</b></p>
					<textarea name="description_en" cols="50" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Характеристики(UA)</b></p>
					<textarea name="features" cols="50" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Характеристики(RU)</b></p>
					<textarea name="features_ru" cols="50" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Характеристики(EN)</b></p>
					<textarea name="features_en" cols="50" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Цена</b></p>
					<input type="text" name="price">
				</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="InsertGoods">
		<input type="hidden" name="page" value="%page%">
		<input type="submit" name="submit" value="Добавить" class="bottom_update">
	</form>
</div>