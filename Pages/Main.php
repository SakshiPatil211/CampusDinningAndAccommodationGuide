
<style>
#imgdes{
border-radius: 60px;
border: 2px solid #777777;
width:110px;
height:110px;
}
</style>
<h2 class="page-title">Services</h2>

		<ul class="gallery box" style="text-align:center;">
		<?php
		if($_SESSION['usertype']=="Student")
		{
		?>
			<li><a href="index.php?page=11">
			<img src="images/room.png" alt="" id="imgdes" />
			</a>Rooms</li>
			<li><a href="index.php?page=13">
			<img src="images/room1.png" alt="" id="imgdes" />
			</a>Nearest Room</li>
			<li><a href="index.php?page=12">
			<img src="images/meal.png" alt="" id="imgdes" />
			</a>Meal</li>
			<li><a href="index.php?page=14">
			<img src="images/mealNearest.png" alt="" id="imgdes" />
			</a>Nearest Meal</li>
		<?php
		}
		?>
		<?php
		if($_SESSION['usertype']=="Meal")
		{
		?>
			<li><a href="index.php?page=9">
			<img src="images/meal.png" alt="" id="imgdes" />
			</a>Meal Profile</li>
		<?php
		}
		?>
		
		<?php
		if($_SESSION['usertype']=="Hostel")
		{
		?>
			<li><a href="index.php?page=10">
			<img src="images/room.png" alt="" id="imgdes" />
			</a>Hostel Profile</li>
		<?php
		}
		?>
			<li><a href="index.php?page=2">
			<img src="images/team-01.jpg" alt="" id="imgdes" />
			</a>My Profile</li>
			<li><a href="index.php?page=4">
			<img src="images/12099654.png" alt="" id="imgdes" />
			</a>About</li>
		
		</ul>

