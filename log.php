<?php
session_start(); //starts a session
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include("db.php");

$d= $_GET["email"]; // Gets the 'email' value from the user's input (via URL or form)
$e= $_GET["pass"]; // Gets the 'pass' (password) value from the user's input

$result = $conn->query("select * From userdb where Email='$d' and Upass ='$e'");


while($row = $result->fetch_assoc())
	{	
$_SESSION['userid'] = $row['Uid'];  // Stores the user's unique ID in the session
$_SESSION['username']= $row['Fname']." ".$row['Lname']; // Stores the user's full name (first and last) in the session
	}
		
if($_SESSION['userid']!="" and $_SESSION['username']!="")
	{
	echo "Saved#".$_SESSION['userid']; // If both session variables are set, it confirms the login is successful
	}
	else
	{
	echo "Login Fail Plz Check User Name and Password"; // If the session variables are not set, it means login failed

	}
?>