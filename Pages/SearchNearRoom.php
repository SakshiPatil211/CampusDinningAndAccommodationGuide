
<h2 class="page-title">Search Nearest Rooms</h2>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<?php
$id=$_SESSION['userid'];
$result= $conn->query("select * From userdb where Uid=$id");
while($row = $result->fetch_assoc())
	{
?>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTdxOIiUh1ehTRUyaSYKBBkHSYPDYB22I&callback=initMap"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="jquery.min.js"></script>

			<hr>
			
			
			<input id="uval" type="hidden" value="<?php echo $id;?>" >
<input id="LAT" type="hidden" value="<?php echo $row['latitude'];?>" >
<input id="LAG" type="hidden" value="<?php echo $row['longitude'];?>" >


<script type="text/javascript">
var geocoder = new google.maps.Geocoder();
var abcd = parseFloat(0.000001);
var latnew="";
var lagnew="";
var spdnew="";

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  //document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
 // document.getElementById('info').innerHTML = [
 //   latLng.lat(),
 //   latLng.lng()
 // ].join(', ');
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}

function initialize() {
var cityCircle=new google.maps.Circle();
  var latLng = new google.maps.LatLng($("#LAT").val(),  $("#LAG").val());
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 15,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: false
  });


  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });


cityCircle.setMap(null);
      cityCircle = new google.maps.Circle({
      strokeColor: '#FF0000',
      strokeOpacity: 0.2,
      strokeWeight: 1,
      fillColor: '#FF0000',
      fillOpacity: 0.12,
      map: map,
      center: latLng,
      radius: 700
    });


$.ajax({
type: "POST",
url: "GPSREADVALROOM.php",
cache: true,
success: function(html){
//alert(html);
var str = html;
var resplace = str.split("@");
var arrayLength = resplace.length;
 
for (var i = 0; i < arrayLength; i++) {
   //alert(resplace[i]);
var res = resplace[i].split("#");
var titler=res[0];
latnew=res[1];
lagnew=res[2];
latLng = new google.maps.LatLng(latnew,lagnew);

marker = new google.maps.Marker({
    position: latLng,
    title: titler,
	icon: 'room.png',
    map: map,
    draggable: false
  });
}




}  
});

}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);

</script>





<style>
  #mapCanvas {
    width: 100%;
    height: 300px;
    float: left;

  }
</style>

  <div id="mapCanvas"></div>
  <hr>

 
<fieldset>
<legend><b>My Location</b></legend>
  <div id="infoPanel">
    <b>Closest matching address:</b>
    <div id="address"></div>
  </div>
</fieldset>
 
<fieldset>
<legend><b>Nearest Rooms</b></legend>
 <div id="NearestParking">
<?php
$lat1=$row['latitude']-0.005;
$lat2=$row['latitude']+0.005;
$log1=$row['longitude']-0.005;
$log2=$row['longitude']+0.005;
					
$result2= $conn->query("select * From hostel where latitude>=$lat1 and latitude<=$lat2 and longitude>=$log1 and longitude<=$log2 ");
while($row2 = $result2->fetch_assoc())
	{
	$distance = calculateDistance($row['latitude'], $row['longitude'], $row2['latitude'], $row2['longitude']);

	echo '<div style="float:left;padding:10px;margin-right:20px;"><img src="upload/'.$row2['Pic'].'" style="border-radius: 60px;border: 2px solid #777777;width:100px;height:100px;" ></div>';
	
	echo "<div ><a href='index.php?page=15&HID=".$row2['HID']."'><b>".$row2['Hname']."</b></a>";
	if($row2['Available']=='Yes')
	{
	echo "<p style='font-size:14px;'><font color=\"#00ff00\">[ Available ]</font>";
	}
	else{
	echo "<font color=\"#ff0000\">[Not Available]</font>";
	}
	
	echo "[".round($distance,2)." Km]";
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

</div>
</fieldset>
 
<?php 
}
?>	