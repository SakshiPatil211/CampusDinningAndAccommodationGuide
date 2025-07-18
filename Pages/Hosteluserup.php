<?php
session_start();

include("../db.php");

$id=$_SESSION['userid'];
$Hname= $_POST["Hname"];
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
$mess.=nullvalid($Hname,"Enter Hostel Name");
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

if(isset($_POST['HID']))
{
$HID=$_POST['HID'];

$a=$conn->query("UPDATE hostel SET UID='$id',Hname='$Hname',Mobile='$Mobile',Address='$Address',city='$City',Locality='$Locality',Type='$Type',Pic='$fname',Facility='$Facility',Available='$Available',latitude='$Latitude',longitude='$Longitude',mincharges='$Charges' WHERE HID=$HID" );
echo "Hostel Profile Updated";
}
else
{
$a=$conn->query("INSERT INTO hostel(UID,Hname,Mobile,Address,City,Locality,Type,Pic,Facility,Available,latitude,longitude,mincharges) VALUES ('$id','$Hname','$Mobile','$Address','$City','$Locality','$Type','$fname','$Facility','$Available','$Latitude','$Longitude','$Charges')");
echo "Hostel Profile Updated";
}


}
else
{
echo $mess;
}
?>
