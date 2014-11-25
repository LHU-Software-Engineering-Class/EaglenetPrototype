<?php
/*
File name: technology.php
Created By: Erik Suiker
Created Date: 11/15/14
Last Modified By: Erik Suiker
Last Modified Date: 11/18/14 
version 1.1
*/

/* 
Statement checks to see if the user is logged in or not
If they are logged in then they are given the page with the
correct header side bar and footer menues
otherwise they are given a header side bars and footter
that will not take them to anything on the website
*/
	include 'connect.php';
if($_SESSION['signed_in'] == false | $_SESSION['user_status'] != true){
	include 'header2.php';
	include 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.';
	include 'footer2.php';
}
/*
If they enter the else statement then they are taken to the the issues page
and at that point they can enter a issue that will be put into the DB for
admins to review later
*/
else {
	include 'header.php';
	include 'sidebar.php';
	echo '<div id ="content">
	<body style="background-color:White">
	<div class ="kona body">
		
	<p>
    	Comments: <br/>
      <textarea name = "comments" rows = "10" cols = "50" > Enter text here </textarea>
    </p>';

	include 'footer.php';
}

?>
