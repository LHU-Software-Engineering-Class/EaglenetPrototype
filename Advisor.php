<?php
/*
File name: advisor.php
Created By: Robert Shelly
Created Date: 11/5/14 6:00 PM
Last Modified By: Robert Shelly
Last Modified Date: 11/11/14 12:01PM
version 1.0
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
	<body bgcolor="#A52A2A">
	<div class ="kona body">
	<table border="1" style="width 100%" align="center">
		<tr>
			<th>Question</th>
			<th>Answer</th>
		</tr>
		<tr>
			<td>Question 1?</td>
			<td>Answer 1!</td>
		</tr>
		<tr>
			<td>Question 2?</td>
			<td>Answer 2!</td>
		</tr>
		<tr>
			<td>Question 3?</td>
			<td>Answer 3!</td>
		</tr>
	</table>';
	include 'footer.php';
}
