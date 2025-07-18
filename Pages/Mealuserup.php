<?php
session_start();

include("../db.php");

$id=$_SESSION['userid'];
$Sname= $_POST["Sname"];
$Mobile= $_POST["Mobile"];
$Type=$_POST["Type"];
$Facility=$_POST["Facility"];
$Available=$_POST["Available"];
$Address=$_POST["Address"];
$City=$_POST["City"];
$Locality=$_POST["Locality"];
$Latitude=$_POST["Latitude"];
$Longitude=$_POST["Longitude"];
$Charges=$_POST["Charges"];

$mess="";
$mess.=nullvalid($Sname,"Enter Shop Name");
$mess.=nullvalid($Mobile,"Enter Mobile No.");
$mess.=nullvalid($Address,"Enter Address");
$mess.=nullvalid($City,"Enter City");
$mess.=nullvalid($Locality,"Enter Locality");
$mess.=OnlyNumbervalid($Charges,"Enter Valid Charges");

$fname="";
if(isset($_FILES['Pics']['name']))
{
$fname=time()."_".$conn->real_escape_string($_FILES['Pics']['name']);
move_uploaded_file($_FILES['Pics']['tmp_name'],"upload/".$fname); 
}


	//++++++++Not Empty+++++++++++++++
	function nullvalid($names,$nametital)
	{
		if($names=="")
		{
         return $nametital.",";
		}	
	}

	//++++++++Only Number Valid+++++++++++++++
	function OnlyNumbervalid($names,$nametital)
	{
		if($names!="")
		{
			if(!preg_match('/^[_0-9]+$/i',$names))
			{
				return $nametital;
			}
		}
	}

if($mess=="")
{

if(isset($_POST['MID']))
{
$MID=$_POST['MID'];

$a=$conn->query("UPDATE meal_shops SET UID='$id',Sname='$Sname',Mobile='$Mobile',Address='$Address',city='$City',Locality='$Locality',Type='$Type',Pic='$fname',Facility='$Facility',Available='$Available',latitude='$Latitude',longitude='$Longitude',mincharges='$Charges' WHERE MID=$MID" );
echo "Meal Profile Updated";
}
else
{
$a=$conn->query("INSERT INTO meal_shops(UID,Sname,Mobile,Address,City,Locality,Type,Pic,Facility,Available,latitude,longitude,mincharges) VALUES ('$id','$Sname','$Mobile','$Address','$City','$Locality','$Type','$fname','$Facility','$Available','$Latitude','$Longitude','$Charges')");
echo "Meal Profile Updated";
}

//echo "okk..";
}
else
{
echo $mess;
}
?>
