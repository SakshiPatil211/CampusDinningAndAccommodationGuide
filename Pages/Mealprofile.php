<?php
$id=$_SESSION['userid'];

$result1 = $conn->query("select * From userdb where Uid=$id");
while($row1 = $result1->fetch_assoc())
	{	
$LAT=$row1['latitude'];	
$LONG=$row1['longitude'];
	}
	
$result = $conn->query("select * From meal_shops where UID=$id");
$count= $result->num_rows;


if($count>=1)
{
	
while($row = $result->fetch_assoc())
	{
?>

	<h2 class="page-title">Meal Profile</h2>
		<!-- CONTACT FORM -->
		<fieldset>
			<legend>Meal Profile</legend>
			
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
				
				<script type="text/javascript" >
				$(function() {
				$("#submit_button").click(function() {
				$("#create_account").ajaxForm({
						target: '#preview'
					}).submit();
				});
				}); 
				</script>


			<form id="create_account" action="Mealuserup.php" method="post" name="contact" enctype="multipart/form-data">
				<input type="hidden" Name="MID" value="<?php echo $row['MID'];?>" />

				<dl>
					<dt>Shop Name:</dt>
					<dd><input type="text" size="30" name="Sname" class="input-text" value="<?php echo $row['Sname'];?>" /></dd>
					<dt>Mobile No:</dt>
					<dd><input type="text" size="30" name="Mobile" class="input-text" value="<?php echo $row['Mobile'];?>" /></dd>

					<dt>Meal Type:</dt>
					<dd>
					<select type="text" name="Type" class="input-text" />
					<option value="<?php echo $row['Type'];?>"><?php echo $row['Type'];?></option>
					<option value="Veg">Veg</option>
					<option value="NonVeg">NonVeg</option>
					</select>
					</dd>
					
					<dt>Profile Pic:</dt>
					<dd><input type="file" size="30" name="Pics" class="input-text"  /></dd>
					
					<dt>Facility:</dt>
					<dd><textarea cols="80" rows="7" name="Facility" class="input-text"><?php echo $row['Facility'];?></textarea></dd>
					
					<dt>Available :</dt>
					<dd>
					<select type="text" name="Available" class="input-text" />
					<option value="<?php echo $row['Available'];?>"><?php echo $row['Available'];?></option>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
					</select>
					</dd>
					

					<dt>Address:</dt>
					<dd><textarea cols="80" rows="7" name="Address" class="input-text"><?php echo $row['Address'];?></textarea></dd>
					<dt>City:</dt>
					<dd><input type="text" size="30" name="City" class="input-text" value="<?php echo $row['City'];?>" /></dd>
					<dt>Locality:</dt>
					<dd><input type="text" size="30" name="Locality" class="input-text" value="<?php echo $row['Locality'];?>"/></dd>
					
					<dt>Charges (Rs):</dt>
					<dd><input type="number" size="30" name="Charges" class="input-text" value="<?php echo $row['mincharges'];?>"/></dd>

					<dt>Latitude:</dt>
					<dd><input type="text" size="30" name="Latitude" id="content2" class="input-text" value="<?php echo $row['latitude'];?>" /></dd>
					<dt>Longitude:</dt>
					<dd><input type="text" size="30" name="Longitude"  id="content3" class="input-text" value="<?php echo $row['longitude'];?>"/></dd>
					
				</dl>
					
					
					<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTdxOIiUh1ehTRUyaSYKBBkHSYPDYB22I&callback=initMap"></script>

 

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
  //document.getElementById('info').innerHTML = [
  //  latLng.lat(),
  //  latLng.lng()
  //].join(', ');
}

function updateMarkerAddress(str) {
  //document.getElementById('address').innerHTML = str;
  $("#content1").val(str);
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
    draggable: true
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
	var lat = marker.getPosition().lat();
	var lng = marker.getPosition().lng();
	$("#content2").val(lat);
	$("#content3").val(lng);
	
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });




}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);

</script>


<style>
  #mapCanvas {
    width: 100%;
    height: 450px;
  }
</style>

  <div id="mapCanvas"></div>
  <hr>
  
					<fieldset id="preview"></fieldset>
				<p class="nomb"><input type="button" id="submit_button"value="Save" class="input-submit" /></p>

			</form>
			
		</fieldset>		
<?php 
		}
}
else{
?>	
	
	<h2 class="page-title">Meal Profile</h2>
		<!-- CONTACT FORM -->
		<fieldset>
			<legend>Meal Profile</legend>
			
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
				
				<script type="text/javascript" >
				$(function() {
				$("#submit_button").click(function() {
				$("#create_account").ajaxForm({
						target: '#preview'
					}).submit();
				});
				}); 
				</script>


			<form id="create_account" action="Mealuserup.php" method="post" name="contact" enctype="multipart/form-data">

				<dl>
					<dt>Shop Name:</dt>
					<dd><input type="text" size="30" name="Sname" class="input-text" value="" /></dd>
					<dt>Mobile No:</dt>
					<dd><input type="text" size="30" name="Mobile" class="input-text" value="" /></dd>
									
							
					<dt>Meal Type:</dt>
					<dd>
					<select type="text" name="Type" class="input-text" />
					<option value="Veg">Veg</option>
					<option value="NonVeg">NonVeg</option>
					</select>
					</dd>
					
					<dt>Profile Pic:</dt>
					<dd><input type="file" size="30" name="Pics" class="input-text"  /></dd>
					
					<dt>Facility:</dt>
					<dd><textarea cols="80" rows="7" name="Facility" class="input-text"></textarea></dd>
					
					<dt>Available :</dt>
					<dd>
					<select type="text" name="Available" class="input-text" />
					<option value="Yes">Yes</option>
					<option value="No">No</option>
					</select>
					</dd>
					
					<dt>Address:</dt>
					<dd><textarea cols="80" rows="7" name="Address" id="content1" class="input-text"></textarea></dd>
					<dt>City:</dt>
					<dd><input type="text" size="30" name="City" class="input-text" value="" /></dd>
					<dt>Locality:</dt>
					<dd><input type="text" size="30" name="Locality" class="input-text" value=""/></dd>

					<dt>Charges (Rs):</dt>
					<dd><input type="number" size="30" name="Charges" class="input-text" value=""/></dd>
					
					<dt>Latitude:</dt>
					<dd><input type="text" size="30" name="Latitude" id="content2" class="input-text" value="" /></dd>
					<dt>Longitude:</dt>
					<dd><input type="text" size="30" name="Longitude"  id="content3" class="input-text" value=""/></dd>

				</dl>
					

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTdxOIiUh1ehTRUyaSYKBBkHSYPDYB22I&callback=initMap"></script>

 
 

<input id="LAT" type="hidden" value="<?php echo $LAT;?>" >
<input id="LAG" type="hidden" value="<?php echo $LONG;?>" >


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
  //document.getElementById('info').innerHTML = [
  //  latLng.lat(),
  //  latLng.lng()
  //].join(', ');
}

function updateMarkerAddress(str) {
  //document.getElementById('address').innerHTML = str;
  $("#content1").val(str);
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
    draggable: true
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
	var lat = marker.getPosition().lat();
	var lng = marker.getPosition().lng();
	$("#content2").val(lat);
	$("#content3").val(lng);
	
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });




}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);

</script>


<style>
  #mapCanvas {
    width: 100%;
    height: 450px;
  }
</style>

  <div id="mapCanvas"></div>
  <hr>
  
					<fieldset id="preview"></fieldset>
				<p class="nomb"><input type="button" id="submit_button"value="Save" class="input-submit" /></p>

			</form>
			
		</fieldset>
		
	<?php 
}
?>
