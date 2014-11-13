<?php
/*
File name: advisor.php
Created By: Robert Shelly
Created Date: 11/5/14 6:00 PM
Last Modified By: Robert Shelly
Last Modified Date: 11/13/14 10:00AM
version 1.1
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
else {
	include 'header.php';
	include 'sidebar.php';
	echo '<div id ="content">
	<body style="background-color:DarkOrange">
	<div class ="kona body">
	<table border="1" style="width 100%" align="center">
		<tr>
			<th>Q: How do I know what time I register for classes?</th>
			<th>A: You can check this on your myHaven page under student/registration,
			    also while on myHaven refrain from using the "back button."</th>
		</tr>
		<tr>
			<th>Q: How do I know if I am on track for an on-time Graduation?</th>
			<th>A: You can ask your advisor for a form of required classes and credits and
			    You can also check in various places on myHaven.</th>
		</tr>
		<tr>
			<th>Q: How do I check and see who my assigned advisor is?</th>
			<th>A: ......Im not your advisor? Why are you here? </th>
		</tr>
	</table>';
	include 'footer.php';
}
