<?php
$id=$_SESSION['userid'];
$result = $conn->query("select * From userdb where Uid=$id");
while($row = $result->fetch_assoc())
	{
?>

<h2 class="page-title">My Profile</h2>
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
					}
					?>
				</form>
		</fieldset>
<?php 
		}
?>