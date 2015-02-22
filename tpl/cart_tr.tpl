<tr>
	<td>
		<div class="img_cart">
		<img src="img/product/%img%" alt="%title%">	
		</div>
	</td>
	<td>
		<div class="title_cart">
			%title%
		</div>
	</td>
	<td>
		<div class="count">
			<div class="inputbox">%count%</div>
			<!--<button name="%id%" class="plus">+</button>
			<button name="%id%" class="minus">-</button>-->
			<form action="?view=cart%lang%" method="post">
				<input type = "hidden" name = "%id%">
				<input type="submit" name="plus" value="+" class="plus">
			</form>
			<form action="?view=cart%lang%" method="post">
				<input type = "hidden" name = "%id%">
				<input type="submit" name="minus" value="-" class="minus">
			</form>

		</div>
	</td>
	<td>
		<div class="price">
			%price%&nbsp;%curr%
		</div>
	</td>
	<td>
		<div class="del">
			<p><a href="lib/function.php?func=%id%">[X]</a></p>
		</div>
	</td>
</tr>