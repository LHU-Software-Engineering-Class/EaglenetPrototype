<?php

/*
File name: maps.php
Created By: AJ Radle
Created Date: 11/11/2014
Last Modified By: AJ Radle
Last Modified Date: 11/11/2014
version 1.0
*/

include 'connect.php';

if($_SESSION['signed_in'] == false | $_SESSION['user_status'] != true)
{
	include 'header2.php';
	include 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.';
	include 'footer2.php';
}
else 
{
	include 'header.php';
	include 'sidebar.php';
	echo '<div id ="content">
	<div class ="kona body">';

	/* Place the image here!*/
	

	include 'footer.php';
}
