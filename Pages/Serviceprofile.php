<?php

$id=$_SESSION['userid'];
$sid=$_GET['cuid'];

$result = $conn->query("select * From userdb where Uid=$sid");
while($row = $result->fetch_assoc())
	{
?>

<h2 class="page-title">Service User Profile</h2>
		<fieldset>
			<legend>Profile</legend>
			<form action="#" method="post">
						<br>
					<B>Name</B> : <?php echo $row['Fname'].' '.$row['Lname'];?><br>
					<B>Mobile No</B> : <?php echo $row['UMob'];?><br>
					<B>E-mail</B> : <?php echo $row['Email'];?><br>
					<B>Address</B> : <?php echo $row['Address'];?><br>
					<B>City</B> : <?php echo $row['city'];?><br>
					
					<?php
					if($row['Utype']=='Service')
					{
					?>
					<B>User Type</B> : <?php echo $row['Utype'];?><br>
					<B>Service</B> : <?php echo $row['worktype'];?><br>
					
<?php
$result1 = $conn->query("select ROUND(avg(Rateval)) as tRate From rating where Rid=$sid");
while($row1 = $result1->fetch_assoc())
	{
?>
		<B>Rating</B> : <br><br>
		<font color="#FF6820" size="+4">
		<?php 
		if($row1['tRate']>=0 and $row1['tRate']<=1)
			echo "*";
		if($row1['tRate']>1 and $row1['tRate']<=2)
			echo "**";
		if($row1['tRate']>2 and $row1['tRate']<=3)
			echo "***";
		if($row1['tRate']>3 and $row1['tRate']<=4)
			echo "****";
		if($row1['tRate']>4 )
			echo "****";		
		?>
		
		</font>
<?php
	}
?>					
					
					<?php
					}
					?>
				</form>
		</fieldset>
		
		

<ul class="team box" id="show" >
</ul>



<h2 class="page-title">Comments</h2>
		<fieldset>
		<div id="Commentsview" >
		
<?php
$result1 = $conn->query("select * From comment,userdb where comment.Uid=userdb.Uid and comment.Rid=$sid");
while($row1 = $result1->fetch_assoc())
	{
?>
		<b><u><?php echo $row1['Fname'].' '.$row1['Lname'];?> </u>:-</b>
		<legend><?php echo $row1['subject'];?></legend>
		<p><?php echo $row1['Comments'];?></p>
		<hr>
<?php
	}
?>		
		
		</div>
		</fieldset>
		
		<fieldset>
			<legend>Comments</legend>
			
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


			<form id="create_account" action="comment.php" method="post" name="contact" enctype="multipart/form-data">
	

			<input class="form-control" type="hidden" name="Uid" value="<?php echo $id;?>" id="mbuid1">
			<input class="form-control" type="hidden" name="Rid" value="<?php echo $sid;?>" id="Rid1">

				<dt>Subject:</dt>
				<dd><input type="text" size="30" name="Subject" class="input-text" value="" /></dd>
				
				<dt>Comment:</dt>
				<dd><textarea cols="80" rows="7" name="Comment" class="input-text"></textarea></dd>
				
				<fieldset id="preview"></fieldset>
				<p class="nomb"><input type="button" id="submit_button"value="Save" class="input-submit" /></p>
				
			</form>
			
		</fieldset>	
		
		
				<fieldset>
			<legend>Rating</legend>
			
				
				<script type="text/javascript" >
				$(function() {
				$("#submit_buttonRating").click(function() {
				$("#create_accountRating").ajaxForm({
						target: '#previewRating'
					}).submit();
				});
				}); 
				</script>


			<form id="create_accountRating" action="Rating.php" method="post" name="contact" enctype="multipart/form-data">
			
			<input class="form-control" type="hidden" name="Uid" value="<?php echo $id;?>" id="mbuid1">
			<input class="form-control" type="hidden" name="Rid" value="<?php echo $sid;?>" id="Rid1">

			<dt>Rating:</dt>
				<dd><select name="Rating" class="input-text">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				</select>
				</dd>
				
			</form>
			<fieldset id="previewRating"></fieldset>
				<p class="nomb"><input type="button" id="submit_buttonRating"value="Submit" class="input-submit" /></p>
		</fieldset>	
		
<?php 
		}
?>