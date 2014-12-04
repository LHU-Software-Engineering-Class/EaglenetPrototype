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
If they enter the else statement then they are taken to the the technology page
and at that point they will have links that they can access for different tech
pages on campus
*/
else {
	include 'header.php';
	include 'sidebar.php';
	echo '<div id ="content">
	
		<p> Link to VMware website for either using a virtual client <br/>or 
			downloading the desktop version for your laptop: <br/>
		<a href="url">www.viewconnection.lhup.edu</a>
		</p>
		
		<p> Link to both password resets and registration
			instructions for gaming consols on campus: <br/>
		<a href="url">http://www.lhup.edu/About/finance_administration/information_technology.html</a>
		</p>
		
		<p> On/Off campus job listings. This website is updated freequently <br/>
		<a href="url">http://community.lhup.edu/careerservices/campuslocalemployment.htm</a>
		</p>';

	include 'footer.php';
}

?>
