<?php

/*
File name: maps.php
Created By: AJ Radle
Created Date: 11/11/2014
Last Modified By: AJ Radle
Last Modified Date: 11/18/2014
version 1.0
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
	echo '<IMG SRC="/images/Main_Campus_Map.jpg" ALT="Campus Map" WIDTH=1558 HEIGHT=1186>';	
	echo '<IMG SRC="/images/LHU_Map.PNG" ALT="Parking at LHU" WIDTH=1004 HEIGHT=756>';
	
	
	include 'footer.php';
}
