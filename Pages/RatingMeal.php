<?php
session_start();

include("../db.php");

$a=$_POST["Uid"];
$b=$_POST["Rid"];
$c=$_POST["Rating"];



$mess="";
$mess.=nullvalid($c,"Select Rating");


		//++++++++Not Empty+++++++++++++++
	function nullvalid($names,$nametital)
	{
		if($names=="")
		{
         return $nametital.",";
		}	
	}


if($mess=="")
{
$conn->query("Delete from ratingmeal where Mid='$b' and Uid='$a'");

$conn->query("insert into ratingmeal(Mid,Uid,Rateval) values('$b','$a','$c')");
echo "Rating post successfully";
}
else
{
echo $mess;
}
?>
