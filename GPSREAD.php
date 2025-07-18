<?php
include("db.php");
//GPSREAD.php?idstr=1&latitudestr=14.5&longitudestr=15

$a= $_GET["idstr"]; // User ID from the URL (via GET method)
$b= $_GET["latitudestr"]; // Latitude from the URL
$c= $_GET["longitudestr"]; // Longitude from the URL
$e= date('d-M-Y'); // Current date in 'Day-Month-Year' format

$conn->query("UPDATE userdb set latitude='$b',longitude='$c' WHERE Uid='$a'");
echo "Saved#";

$result = $conn->query("select * From chatdata where notify != 'Y' and suid='$a'");
while($row = $result->fetch_assoc())
	{
	
	$result1=$conn->query("select * From userdb where Uid=".$row['uid']);
	while($row1 = $result1->fetch_assoc())
	{
		echo $row1['Uid'].'#'.$row1['Fname'].' '.$row1['Lname'].'#'.$row['mess'];
	}


$conn->query("UPDATE chatdata SET notify = 'Y' where cid='".$row['cid']."'");
break;

	}
?>