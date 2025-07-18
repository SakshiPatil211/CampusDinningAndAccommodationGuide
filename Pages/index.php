<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include("../db.php");

if(isset($_GET["loguid"]))
{

$result = $conn->query("select * From userdb where Uid=".$_GET["loguid"]);
while($row = $result->fetch_assoc())
	{	
$_SESSION['userid']= $row['Uid'];
$_SESSION['username']= $row['Fname'].' '.$row['Lname'];
$_SESSION['usertype']= $row['Utype'];
//"Student","Meal","Hostel"
	}			
}

function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    // Earth radius in kilometers
    $earthRadius = 6371;

    // Convert latitude and longitude from degrees to radians
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Difference in coordinates
    $latDiff = $lat2 - $lat1;
    $lonDiff = $lon2 - $lon1;

    // Haversine formula
    $a = sin($latDiff / 2) * sin($latDiff / 2) +
         cos($lat1) * cos($lat2) *
         sin($lonDiff / 2) * sin($lonDiff / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Distance in kilometers
    $distance = $earthRadius * $c;

    return $distance;
}
/*
// Example coordinates
$userlatitude = 16.684815282677638;
$userlongitude = 74.25177984276509;
$homelatitude = 16.694815282677638;
$homelongitude = 74.23177984276509;

// Calculate the distance
$distance = calculateDistance($userlatitude, $userlongitude, $homelatitude, $homelongitude);

echo "Distance: " . $distance . " km";
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<meta http-equiv="content-language" content="en" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	
	<link rel="apple-touch-icon" href="images/icon.png" />
	<link rel="apple-touch-startup-image" href="images/splash.png">
	
	<link rel="stylesheet" media="screen" type="text/css" href="css/reset.css" />	
	<link rel="stylesheet" media="screen" type="text/css" href="css/main.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="css/skin.css" />
	
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.slider.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#nav").hide(); 
			$(".toggle").click(function() {
				$(this).next().slideToggle("fast");
				return false;
			});
		$("#slider").easySlider({
			auto: false,
			continuous: true,
			numeric: true,
			pause: 5000
		});			
	});
	</script>
	
	<title>RoomMeal</title>
</head>

<body onorientationchange="Orientation();">
<div id="wrapper">
	
	<div id="header">
		<h1 id="logo">
		
		

		<a href="index.php" onclick="return link(this)">RoomMeal</a>
		</h1>
				
				<a class="header-button toggle">Menu</a>
		<div id="nav">
			<ul>
				<li><a href="index.php?page=1&userid=<?php echo $_SESSION['userid']; ?>" onclick="return link(this)">Home</a></li>
				
						<?php
		if($_SESSION['usertype']=="Student")
		{
		?>
				<li><a href="index.php?page=13&userid=<?php echo $_SESSION['userid']; ?>" onclick="return link(this)">Nearest Rooms</a></li>
				<li><a href="index.php?page=11&userid=<?php echo $_SESSION['userid']; ?>" onclick="return link(this)">Search Rooms</a></li>

				<li><a href="index.php?page=14&userid=<?php echo $_SESSION['userid']; ?>" onclick="return link(this)">Nearest Meal</a></li>
				<li><a href="index.php?page=12&userid=<?php echo $_SESSION['userid']; ?>" onclick="return link(this)">Search Meal</a></li>
		<?php
		}
		?>
		<?php
		if($_SESSION['usertype']=="Meal")
		{
		?>
		<li><a href="index.php?page=9&userid=<?php echo $_SESSION['userid']; ?>" onclick="return link(this)">Meal Profile</a></li>
		<?php
		}
		?>
		
		<?php
		if($_SESSION['usertype']=="Hostel")
		{
		?>
		<li><a href="index.php?page=10&userid=<?php echo $_SESSION['userid']; ?>" onclick="return link(this)">Hostel Profile</a></li>
		<?php
		}
		?>
				<li><a href="index.php?page=2" onclick="return link(this)">My Profile</a></li>
				<li><a href="index.php?page=3" onclick="return link(this)">Edit Profile</a></li>
				<li><a href="index.php?page=5" onclick="return link(this)">Change Password</a></li>
				<li><a href="index.php?page=4" onclick="return link(this)">About</a></li>	
				
			</ul>
		</div> <!-- /nav -->
	</div> <!-- /header -->
	<div id="content">	

<?php
if(!isset($_GET["page"]) || $_GET["page"]==1 || $_GET["page"]==0)
{
//include("Mymap.php");
include("Main.php");
}
elseif($_GET["page"]==2)
{
include("Myprofile.php");
}
elseif($_GET["page"]==3)
{
include("changeprofile.php");
}
elseif($_GET["page"]==4)
{
include("about.php");
}
elseif($_GET["page"]==5)
{
include("Setting.php");
}
elseif($_GET["page"]==7)
{
include("Serviceprofile.php");
}
elseif($_GET["page"]==8)
{

}
elseif($_GET["page"]==9)
{
include("Mealprofile.php");
}
elseif($_GET["page"]==10)
{
include("Hostelprofile.php");
}
elseif($_GET["page"]==11)
{
include("SearchRoom.php");
}
elseif($_GET["page"]==12)
{
include("SearchMeal.php");
}
elseif($_GET["page"]==13)
{
include("SearchNearRoom.php");
}
elseif($_GET["page"]==14)
{
include("SearchNearMeal.php");	
}
elseif($_GET["page"]==15)
{
include("Hostelpage.php");
}
elseif($_GET["page"]==16)
{
include("Mealpage.php");
}
?>

	</div>
	

	<div id="footer">
		<p id="footer-button">
		<a onclick="jQuery('html,body').animate({scrollTop:0},'slow');" href="javascript:void(0);">Back on top</a>
		</p>
		<p>&nbsp;</p>
	</div>

</div> <!-- /wrapper -->

</body>
</html>