<?php
/*
File name: signout.php
Created by: David Hall
Created Date: 10/24/2014
Last Modified by: David Hall
Last Modified: 10/24/2014
Version 1.0
*/

//signout.php
include 'connect.php';
//check if user if signed in
if($_SESSION['signed_in'] == true)
{
	//unset all variables
	$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;
	$_SESSION['user_level'] = 0;
}

include 'header2.php';
include 'sidefiller.php';
echo'<!-- Begin Content -->
<div id="content2">';
echo '<h2>Sign out</h2>';
echo 'Succesfully signed out, thank you for visiting.<br /><br />';
echo 'You are not signed in. Would you <a href="index.php">like to</a>?';

include 'footer2.php';