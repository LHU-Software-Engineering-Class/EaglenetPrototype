<?php
/*
//Created by: David Hall
//Created Date: 10/27/2014
//Version 1.0
*/

//admin.php
include 'connect.php';
//checks if user is signed in and verified to use the EagleNet if not show dummy page
if ($_SESSION['signed_in'] == false | $_SESSION['user_status'] != true){
	include 'header2.php';
	include 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.<br/>
	</div>';
	include 'footer2.php';
}
//Check if the user has the access rights to view this page show redirect page
if($_SESSION['user_level'] == 0){
	include 'header.php';
	include 'sidebar.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.<br/>
	<h3>Please go back to the authorized pages. <br/><br/>
	Or <a href="start.php">CLICK HERE</a> to go back to the Start page.</h3>
	</div>';
	include 'footer.php';
}
//user is logged in, verified and has access rights to admin page
else{
	include 'header.php';
	include 'sidebar.php';
echo'<div id="content2">';

//!!!!!!!!!!ToDo!!!!!!!!!!!!!!!
//Link to forum_create.php
echo'<a href="forum_create.php">Create a new forum</a> ';
//Change user level
//Deactivate user
//deactivate Forum
//deactivate Thread
//deactivate post
//change user password
//send new verification code
//edit post by anyone
//edit thread by anyone
//edit Forum by anyone
include 'footer.php';
}