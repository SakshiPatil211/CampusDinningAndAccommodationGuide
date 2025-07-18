<?php
session_start();
include("../db.php");
?>
<ul class="team box">
<?php
$ukey=$_POST['ukey'];
$Type=$_POST['Type'];
$Sort=$_POST['Sort'];

$que="";
if(isset($_POST['Sort']) and $Sort=="LH")
{
$que=" order by h.mincharges ASC";
}

if(isset($_POST['Sort']) and $Sort=="HL")
{
$que=" order by h.mincharges DESC";
}

if(isset($_POST['Sort']) and $Sort=="RH")
{
$que=" order by r.Rateval DESC;";
}

if(isset($_POST['Sort']) and $Sort=="RL")
{
$que=" order by r.Rateval ASC;";
}
	
//echo "select * From hostel where concat(Address,city) like '%$ukey%' and Type='$Type'".$que;

//$result = $conn->query("select * From hostel where concat(Address,city) like '%$ukey%' and Type='$Type'".$que);
//echo "SELECT * FROM hostel h LEFT JOIN rating r ON h.HID = r.Rid where concat(Address,city) like '%$ukey%' and Type='$Type'".$que;

$result = $conn->query("SELECT * FROM hostel h LEFT JOIN rating r ON h.HID = r.Rid where concat(Address,city) like '%$ukey%' and Type='$Type'".$que);


	
while($row2 = $result->fetch_assoc())
	{
	echo '<div style="float:left;padding:10px;margin-right:20px;"><img src="upload/'.$row2['Pic'].'" style="border-radius: 60px;border: 2px solid #777777;width:100px;height:100px;" ></div>';
	
	echo "<div ><a href='index.php?page=15&HID=".$row2['HID']."'><b>".$row2['Hname']."</b></a>";
	if($row2['Available']=='Yes')
	{
	echo "<p style='font-size:14px;'><font color=\"#00ff00\">[ Available ]</font>";
	}
	else{
	echo "<font color=\"#ff0000\">[Not Available]</font>";
	}

	echo "<br><b>&#9742; - </b> ".$row2['Mobile'];
	echo "<br><b>Type - </b> ".$row2['Type'];
	echo "<br><b>City - </b> ".$row2['City'];

	
$resultrate1 = $conn->query("select ROUND(avg(Rateval)) as tRate From rating where Rid=".$row2['HID']);
while($rowrate1 = $resultrate1->fetch_assoc())
	{
?>
		<br>
		<font color="#FF6820" size="+4">
		<?php 
		if($rowrate1['tRate']>=0 and $rowrate1['tRate']<=1)
			echo "&#8902;";
		if($rowrate1['tRate']>1 and $rowrate1['tRate']<=2)
			echo "&#8902;&#8902;";
		if($rowrate1['tRate']>2 and $rowrate1['tRate']<=3)
			echo "&#8902;&#8902;&#8902;&#8902;";
		if($rowrate1['tRate']>3 and $rowrate1['tRate']<=4)
			echo "&#8902;&#8902;&#8902;&#8902;";
		if($rowrate1['tRate']>4 )
			echo "&#8902;&#8902;&#8902;&#8902;&#8902;";		
		?></font>
<?php	
	}
	

	echo "</p></div>";
	echo "<hr>";

	}
?>
</ul>