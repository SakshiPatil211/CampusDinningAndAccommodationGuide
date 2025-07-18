<?php
session_start();
include("../db.php");
$id=$_SESSION['userid'];


$d= $_POST["upass"];
$e= $_POST["upass1"];

$mess="";
$mess.=nullvalid($d,"Enter Password");
$mess.=nullvalid($e,"Enter Conform Password");
$mess.=EqualValid($d,$e,"Password Not Match");


		//++++++++Not Empty+++++++++++++++
	function nullvalid($names,$nametital)
	{
		if($names=="")
		{
         return $nametital.",";
		}	
	}

//++++++++Equal Valid+++++++++++++++
	function EqualValid($names1,$names2,$nametital)
	{
		if($names1!=$names2 || $names1=="")
		{
			 return $nametital.",";
		}
	}

if($mess=="")
{
$a=$conn->query("UPDATE userdb SET Upass='$d' WHERE Uid=$id" );
echo "Password Updated";
}
else
{
echo $mess;
}
?>
