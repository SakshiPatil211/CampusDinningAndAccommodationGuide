<?php

include("db.php");

$a= $_GET["Firstn"]; // First name from user input (via URL or form)
$b= $_GET["Lastn"]; // Last name from user input
$c= $_GET["pass"];  // Password from user input
$d= $_GET["Mobile"]; // Mobile number from user input
$e= $_GET["email"]; // Email from user input
$f= $_GET["utype"]; // User type (probably specifying the role, like student/mess/hostel)
$g= date('d-m-Y'); // Current date in 'day-month-year' format

$mess=""; // This will store error messages
$mess.=Fullnamevalid($a,"Enter First Name"); // Validates the first name
$mess.=Fullnamevalid($b,"Enter Last Name"); // Validates the last name
$mess.=nullvalid($c,"Enter Password");      // Checks if the password is not empty
$mess.=Phonevalid($d,"Enter Valid Mobile No",10); // Validates the mobile number (must be 10 digits)
$mess.=DatbaseValid($e,"Email All Ready Register"); // Checks if the email is already registered
$mess.=nullvalid($f,"Select Join as");                 // Checks if the user selected a type (role)

	//++++++++Name Only+++++++++++++++
	function Fullnamevalid($names,$nametital)
	{
         if(!preg_match('/^[_a-z]+$/i',$names)) // Only allows alphabetic characters
         {
         return $nametital.","; // Returns the error message if the validation fails
         }
	}


	//++++++++Phone No+++++++++++++++
	function Phonevalid($names,$nametital,$length)
	{
		$x=strlen($names); // Gets the length of the phone number
		if($x!=$length)
		{
				return $nametital."(Min Length $length),"; // Ensures phone number is the correct length (10 digits)

		}
		else if(!preg_match('/[0-9 -()+]+$/', $names)) // Ensures phone number contains only digits or valid symbols
		{
				return $nametital;
		}

	}

		//++++++++Not Empty+++++++++++++++
	function nullvalid($names,$nametital)
	{
		if($names=="")
		{
         return $nametital.","; // Returns an error if the field is empty
		}	
	}

//++++++++Data Base Valid+++++++++++++++

function DatbaseValid($valuechk,$nametital)
	{
	global $conn; // Accesses the global database connection
	$result = $conn->query("select * from  userdb where Email='".$valuechk."'");  // Checks if the email exists in the database
 
	if($result->num_rows>=1)
		{
		 return $nametital.","; // Returns error if email is already registered
		}
	}
	
//++++++++Equal Valid+++++++++++++++
	function EqualValid($names1,$names2,$nametital)
	{
		if($names1!=$names2 || $names1=="")
		{
			 return $nametital.","; // Checks if two fields (like password and confirm password) match
		}
	}

if($mess=="") // If no errors
{

$a=$conn->query("INSERT INTO userdb(Fname,Lname,UMob,Upass,Ujoindate,Email,Utype) VALUES ('$a','$b','$d','$c','$g','$e','$f')"); // Inserts the user data into the database

echo "Saved"; // Shows a success message
}
else
{
echo $mess; // If there are errors, displays the collected error messages
}
?>