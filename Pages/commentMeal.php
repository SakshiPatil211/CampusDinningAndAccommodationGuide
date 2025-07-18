<?php
session_start();

include("../db.php");

$a=$_POST["Uid"];
$b=$_POST["Rid"];
$c= $_POST["Subject"];
$d= $_POST["Comment"];


$mess="";
$mess.=nullvalid($c,"Enter Subject");
$mess.=nullvalid($d,"Enter Comment");


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
$a=$conn->query("insert into commentmeal(Mid,Uid,subject,Comments) values('$b','$a','$c','$d')");
echo "Comment post successfully";
}
else
{
echo $mess;
}
?>
