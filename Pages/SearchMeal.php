<?php
session_start();
include("../db.php");
?>
<h2 class="page-title">Search Meal</h2>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script type="text/javascript">
function autosearch(str)
{
$("#create_account").ajaxForm({
target: '#preview'
}).submit();
}
</script>
				<form id="create_account" action="SearchMealResult.php" method="post" name="contact">
				<dt>Search Key:</dt>
				<dl>
					<dd><input type="text" name="ukey" class="input-text" placeholder="Search By location/City" onkeyup="autosearch(1);"/></dd>
				</dl>
				
				<dt>Meal Type:</dt>
					<dd>
					<select type="text" name="Type" class="input-text" onchange="autosearch(1);" />
					<option value="Veg">Veg</option>
					<option value="NonVeg">NonVeg</option>
					</select>
					</dd>

				<dt>Sort By:</dt>
					<dd>
					<select type="text" name="Sort" class="input-text" onchange="autosearch(1);" />
					<option value=""></option>
					<option value="LH">Low To High</option>
					<option value="HL">High To Low</option>

					<option value="RH">Rating High</option>
					<option value="RL">Rating Low</option>
					</select>
					</dd>
					
				</form>
			
		<div id="preview"></div>
	