<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<input type="text" name="s" id="s" value="Search site" onfocus='if (this.value == "Search site") { this.value = ""; }' onblur='if (this.value == "") { this.value = "Search site"; }' />
	<input type="hidden" id="search-button" />
</form>