<?php

/*
File name: maps.php
Created By: AJ Radle
Created Date: 11/11/2014
Last Modified By: David Hall
Last Modified Date: 12/4/2014
version 2.0
*/

include 'connect.php';

/*This makes sure the person is signed in. If not, rights are denied*/
if($_SESSION['signed_in'] == false | $_SESSION['user_status'] != true)
{
	include 'header2.php';
	include 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.';
	include 'footer2.php';
}
/*Else, load the page*/
else 
{
	include 'header.php';
	include 'sidebar.php';
	echo '<div id ="content">
	<div class ="kona body">';

	/* Place the images here!*/
	echo '
	<h1> LHU Main Campus Map</h1>
	<a href="images/Main_Campus_Map.jpg" target="_blank">
		<IMG SRC="images/main_campus_map_small.jpg" ALT="Campus Map">
	</a>
	
	<br/><h2> Click map for larger view</h2><hr>
	
	<br/>
	<h1> LHU Main Campus Parking Map</h1>
	<a href="images/LHU_Map.png"target="_blank"><IMG SRC="images/lhu_map_small.PNG" ALT="Parking at LHU"></a>
	<br/><h2> Click map for larger view</h2>';
	
	include 'footer.php';
}
