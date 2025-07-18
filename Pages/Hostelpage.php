<?php

$id=$_SESSION['userid'];
$HID=$_GET['HID'];

$result = $conn->query("select * From hostel where HID=$HID");
while($row = $result->fetch_assoc())
	{
?>

<h2 class="page-title">Hostel Room Profile</h2>
		<fieldset>
			<legend>Profile</legend>
			<form action="#" method="post">
			
				<div style="float:left;padding:10px;margin-right:20px;"><img src="upload/<?php echo $row['Pic']; ?>" style="border-radius: 60px;border: 2px solid #777777;width:100px;height:100px;" ></div>'
				
						<br>
					<B>Name</B> : <?php echo $row['Hname'];?><br>
					<p style='font-size:14px;'>
					<?php
						if($row['Available']=='Yes')
						{
						echo "<font color=\"#00ff00\">[ Available ]</font>";
						}
						else{
						echo "<font color=\"#ff0000\">[Not Available]</font>";
						}
					?>
					
					<br><B>&#9742; </B> : <?php echo $row['Mobile'];?><br>
					<B>Type</B> : <?php echo $row['Type'];?><br>	<br>			
					<B>Address</B> : <?php echo $row['Address'];?><br>
					<B>City</B> : <?php echo $row['City'];?><br>
					<B>Locality</B> : <?php echo $row['Locality'];?><br>
					<B>Charges (Rs):</B> : <?php echo $row['mincharges'];?><br>
				
					<B>Facility</B> : <?php echo $row['Facility'];?><br>
					
<?php
$result1 = $conn->query("select ROUND(avg(Rateval)) as tRate From rating where Rid=$HID");

while($rowrate1 = $result1->fetch_assoc())
	{
?>
		<B>Rating</B> : <br><br>
		<font color="#FF6820" size="+4">
		<?php 
		if($rowrate1['tRate']>=0 and $rowrate1['tRate']<=1)
			echo "&#8902;";
		if($rowrate1['tRate']>1 and $rowrate1['tRate']<=2)
			echo "&#8902;&#8902;";
		if($rowrate1['tRate']>2 and $rowrate1['tRate']<=3)
			echo "&#8902;&#8902;&#8902;&#8902;";
		if($rowrate1['tRate']>3 and $rowrate1['tRate']<=4)
			echo "&#8902;&#8902;&#8902;&#8902;";
		if($rowrate1['tRate']>4 )
			echo "&#8902;&#8902;&#8902;&#8902;&#8902;";		
		?></font>
<?php
	}
?>					
					
	 </p>
				</form>
		</fieldset>
		
		

<ul class="team box" id="show" >
</ul>



<h2 class="page-title">Comments</h2>
		<fieldset>
		<div id="Commentsview" >
		
<?php
$result1 = $conn->query("select * From comment,userdb where comment.Uid=userdb.Uid and comment.Rid=$HID");
while($row1 = $result1->fetch_assoc())
	{
?>
		<b><u><?php echo $row1['Fname'].' '.$row1['Lname'];?> </u>:-</b>
		<p style='font-size:14px;'>
		<legend><?php echo $row1['subject'];?></legend>
		<?php echo $row1['Comments'];?></p>
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
			<input class="form-control" type="hidden" name="Rid" value="<?php echo $HID;?>" id="Rid1">

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
			<input class="form-control" type="hidden" name="Rid" value="<?php echo $HID;?>" id="Rid1">

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