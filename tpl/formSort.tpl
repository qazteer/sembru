<SELECT NAME='navSelect'
	  ONCHANGE='top.location.href =
	    this.options[this.selectedIndex].value'>
	  <OPTION>%title%</OPTION>
	  <optgroup label='%price%'>
		  <OPTION VALUE='?view=catalog%section%&amp;page=%page%&amp;id=1%lang%'>%min%</OPTION>
		  <OPTION VALUE='?view=catalog%section%&amp;page=%page%&amp;id=2%lang%'>%max%</OPTION>
	  </optgroup>
	  <optgroup label='%date%'>
		  <OPTION VALUE='?view=catalog%section%&amp;page=%page%&amp;id=3%lang%'>%first%</OPTION>
		  <OPTION VALUE='?view=catalog%section%&amp;page=%page%&amp;id=4%lang%'>%last%</OPTION>
	  </optgroup>
</SELECT><br>