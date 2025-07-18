<?php
session_start();
include("../db.php");
$d=$_SESSION['userid'];
$swork=$_SESSION['worktype'];
$lat1="";
$log1="";
$lat2="";
$log2="";

$result= $conn->query("select * From userdb where Uid='$d'");
while($row = $result->fetch_assoc())
	{	
$lat1=$row['latitude']-0.005;
$lat2=$row['latitude']+0.005;
$log1=$row['longitude']-0.005;
$log2=$row['longitude']+0.005;
	}

//echo "select * From places where Latitude>=$lat1 and Latitude<=$lat2 and Longitude>=$log1 and Longitude<=$log2";

$result2= $conn->query("select * From hostel where latitude>=$lat1 and latitude<=$lat2 and longitude>=$log1 and longitude<=$log2 ");

while($row2 = $result2->fetch_assoc())
	{
echo $row2['Hname']."#".$row2['latitude']."#".$row2['longitude']."@";
	}

?>