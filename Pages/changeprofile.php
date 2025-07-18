<?php
$id=$_SESSION['userid'];
$result = $conn->query("select * From userdb where Uid=$id");
while($row = $result->fetch_assoc())
	{
?>

	<h2 class="page-title">Edit My Profile</h2>
		<!-- CONTACT FORM -->
		<fieldset>
			<legend>Profile</legend>
			
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


			<form id="create_account" action="userup.php" method="post" name="contact" enctype="multipart/form-data">

				<dl>
					<dt>First Name:</dt>
					<dd><input type="text" size="30" name="Fname" class="input-text" value="<?php echo $row['Fname'];?>" /></dd>
					<dt>Last Name:</dt>
					<dd><input type="text" size="30" name="Lname" class="input-text" value="<?php echo $row['Lname'];?>" /></dd>
					
					<dt>E-mail:</dt>
					<dd><input type="email" size="30" name="uemail" class="input-text" value="<?php echo $row['Email'];?>"/></dd>		

					<dt>Mobile No:</dt>
					<dd><?php echo $row['UMob'];?></dd>
					
					<dt>Address:</dt>
					<dd><textarea cols="80" rows="7" name="uaddress" class="input-text"><?php echo $row['Address'];?></textarea></dd>
					<dt>City:</dt>
					<dd><input type="text" size="30" name="ucity" class="input-text" value="<?php echo $row['city'];?>" /></dd>

				</dl>
					
					<fieldset id="preview"></fieldset>
				<p class="nomb"><input type="button" id="submit_button"value="Save" class="input-submit" /></p>

			</form>
			
		</fieldset>		
<?php 
		}
?>
	