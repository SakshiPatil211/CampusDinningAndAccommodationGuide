<?php
session_start();
?>
<h2 class="page-title">Search Rooms</h2>
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
				<form id="create_account" action="SearchRoomResult.php" method="post" name="contact">
				<dt>Search Key:</dt>
				<dl>
					<dd><input type="text" name="ukey" class="input-text" placeholder="Search By location/City" onkeyup="autosearch(1);"/></dd>
				</dl>
				
								<dt>Hostel Type:</dt>
					<dd>
					<select type="text" name="Type" class="input-text" onchange="autosearch(1);" />
					<option value="Girls">Girls</option>
					<option value="Boys">Boys</option>
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
			<hr>
			
			
		<div id="preview"></div>
	