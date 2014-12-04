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
	<div class ="kona body">
	<table border="1" style="width 100%" align="center">
		<tr>
			<th>Q: How do I know what time I register for classes?</th>
			<th>A: You can check this on your myHaven page under student/registration</th>
		</tr>
		<tr>
			<th>Q: How do I know if I am on track for an on-time Graduation?</th>
			<th>A: You can ask your advisor for a form of required classes and credits and
			    You can also check in various places on myHaven.</th>
		</tr>
		<tr>
			<th>Q: Who make up the staff working with the registrar?</th>
			<th>A: Registrar - Jill R. Mitchley, Assistant Registrar - Meisha McDermit , 
			Secretarial Supervisor - Tammie Allen, Secretary - Christine Taylor,
			Secretary - Cindy Walker</th>
		</tr>
		<tr>
			<th>Q: Where is the Registrar office located?</th>
			<th>A: the office is located at Ulmer 224 with office hours monday through friday
			8:00 AM to 4:00 PM</th>
		</tr>
		<tr>
			<th>Q: ?</th>
			<th>A: For generalquestions, walk-in registrations, high school student registrations, 
			substitution forms, request to resume studies, transfer credits - 570-484-2006</br>
			
			Transcripts, enrollment verifications, major changes, advisor changes, address changes
			- 570-484-2124</br>
			
			schedule of classes, room assignments (for courses), advisor assignments, Act 48, 
			registration of internships, independant studies, or graduation - 570-484-2008</br>
			
			if you are not sure what your question is or what number to call us this one - 570-484-2006</br>
			Fax -  570-484-2734
			and email - registrar@lhup.edu
			</th>
		</tr>
	</table>';
	include 'footer.php';
}
