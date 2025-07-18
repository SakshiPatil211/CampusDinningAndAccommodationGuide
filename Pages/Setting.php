<?php
$id=$_SESSION['userid'];
$result = $conn->query("select * From userdb where Uid=$id");
while($row = $result->fetch_assoc())
	{
?>
<h2 class="page-title">Change Setting</h2>

				
		<!-- CONTACT FORM -->
		<fieldset>
		
			<legend>Change Password</legend>
			<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
				
				<script type="text/javascript" >
				$(function() {
				$("#submit_button").click(function() {
				$("#create_account").ajaxForm({
						target: '#preview'
					}).submit();
				});
				}); 
				</script>
				<fieldset id="preview"></fieldset>

				<form id="create_account" action="settingup.php" method="post" name="contact">

				<dl>
					
					<dt>Password:</dt>
					<dd><input type="password" name="upass" class="input-text" value="<?php echo $row['Upass'];?>"/></dd>

					<dt>Conform Password:</dt>
					<dd><input type="password" name="upass1" class="input-text" value=""/></dd>


				</dl>
					
			<p class="nomb"><input type="button" id="submit_button"value="Save" class="input-submit" /></p>

			</form>
			
		</fieldset>		
		

<?php 
		}
?>