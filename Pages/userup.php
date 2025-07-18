<?php
session_start();

include("../db.php");

$id=$_SESSION['userid'];

$a= $_POST["Fname"];
$a1= $_POST["Lname"];
$b= $_POST["ucity"];
$d= $_POST["uemail"];
$e=$_POST["uaddress"];
$f= date('D-M-Y');


$mess="";
$mess.=namevalid($a,"Enter First Name");
$mess.=namevalid($a1,"Enter Last Name");
$mess.=EmailValid($d,"Enter vaild email");
$mess.=nullvalid($b,"Enter City");
$mess.=nullvalid($e,"Enter your address info");


$fname="";
if(isset($_FILES['Pics']['name']))
{
$fname=time()."_".mysql_real_escape_string($_FILES['Pics']['name']);
move_uploaded_file($_FILES['Pics']['tmp_name'],"upload/".$fname); 
}



//++++++++Email valid+++++++++++++++
	function EmailValid($names,$nametital)
	{
		if(!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $names))
		{
			 return $nametital.",";
		}
	}

	//++++++++Full Name Only+++++++++++++++
	function namevalid($names,$nametital)
	{
         if(!preg_match('/^[_a-z]+$/i',$names))
         {
         return $nametital.",";
         }
	}


	//++++++++Full Name Only+++++++++++++++
	function Fullnamevalid($names,$nametital)
	{
         if(!preg_match('/^[_a-z]+( [_a-z]+)$/i',$names))
         {
         return $nametital.",";
         }
	}


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
$a=$conn->query("UPDATE userdb SET Fname='$a',Lname='$a1',Email='$d',Address='$e',city='$b' WHERE Uid=$id" );
echo "Profile Updated";
}
else
{
echo $mess;
}
?>
