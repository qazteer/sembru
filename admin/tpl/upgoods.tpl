<div class="frontpage_admin">
	<h4>Редактирование товара</h4>
	<form enctype="multipart/form-data" action="lib/function.php" method="POST">
		<table class="table_frontpage" cellspacing="0" cellpadding="0">
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>ID товара</b></p>
					<input type="text" name="id" value="%id%" readonly>
				</td>
			</tr>
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
					<p><b>Аватар</b></p>
					<img src="/sembru_2/img/product/%img%" alt="аватар">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Занрузить новый аватар</b></p>
					<input type="file" name="img" accept="image/*" value="%img%">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Наименование(UA)</b></p>
					<input type="text" name="title" value="%title%">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Наименование(RU)</b></p>
					<input type="text" name="title_ru" value="%title_ru%">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Наименование(EN)</b></p>
					<input type="text" name="title_en" value="%title_en%">
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Описание(UA)</b></p>
					<textarea name="description" cols="50" rows="10">%description%</textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Описание(RU)</b></p>
					<textarea name="description_ru" cols="50" rows="10">%description_ru%</textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Описание(EN)</b></p>
					<textarea name="description_en" cols="50" rows="10">%description_en%</textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Характеристики(UA)</b></p>
					<textarea name="features" cols="50" rows="10">%features%</textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Характеристики(RU)</b></p>
					<textarea name="features_ru" cols="50" rows="10">%features_ru%</textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Характеристики(EN)</b></p>
					<textarea name="features_en" cols="50" rows="10">%features_en%</textarea>
				</td>
			</tr>
			<tr>
				<td class="td_frontpage" colspan="3">
					<p><b>Цена</b></p>
					<input type="text" name="price" value="%price%">
				</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="UpdateGoods">
		<input type="hidden" name="img" value="%img%">
		<input type="hidden" name="page" value="%page%">
		<input type="submit" name="submit" value="Редактировать" class="bottom_update">
	</form>
</div>