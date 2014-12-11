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
include_once 'connect.php';
if($_SESSION['signed_in'] == false | $_SESSION['user_status'] != true){
	include_once 'header2.php';
	include_once 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.';
	include_once 'footer2.php';
}
/*
If they enter the else statement then they are taken to the the technology page
and at that point they will have links that they can access for different tech
pages on campus
*/
else {
	include_once 'header.php';
	include_once 'sidebar.php';
	echo '<div id ="content">
	
		<p> 
			<strong>Link to VMware website for either using a virtual client <br/>or 
			downloading the desktop version for your laptop: </strong><br/>
			<a href="url">www.viewconnection.lhup.edu</a>
		</p><br>
		
		<p> 
			<strong>Link to both password resets and registration
			instructions for gaming consols on campus: </strong><br/>
			<a href="url">http://www.lhup.edu/About/finance_administration/information_technology.html</a>
		</p><br>
		
		<p> 
			<strong>On/Off campus job listings. This website is updated freequently: </strong><br/>
			<a href="url">http://community.lhup.edu/careerservices/campuslocalemployment.htm</a>
		</p><br>
		
		<p>
			<strong> Printing to Lab printers from a personal computer: </strong> <br>
			<blockquote>
				1. Open your web browser (ie... Internet Explorer, Firefox, Safari, etc...) <br>
				2. Enter the PaperCut website: https://dove.lhup.edu:9192 <br>
				3. Username: lhu email address minus the &quot;@lhup.edu&quot; <br>
				4. Password: your email password <br>
				5. Click: Web Print (list on left side of window) <br>
				6. Click: Submit a Job <br>
				7. Select the printer of choice <br>
				8. Click: 2. Print Options and Account Selection (lower right corner of window) <br>
				9. Adjust for number of copies needed <br>
				10. Click: 3. Upload Document <br>
				11. Browse for document to print <br>
				12. Select: Upload & Complete <br>
				13. Document is now is the queue and ready to print <br>
				14. Click: Held in a queue <br>
				15. Click: Print <br>
			</blockquote>
		</p><br>
		
		<p>
			<strong> Mapping Network Drive: </strong><br>
			<blockquote>
				At times, you may need to access files on another drive; this is most likely due <br>
				to a class you are taking. To access files on these servers, you must have the name <br>
				of the server and sharename*. For example, to access data for COMP150 on Starling:<br><br>
				1. Right click: &quot;My Computer&quot; or &quot;Computer&quot;<br>
				2. Select: &quot;Map Network Drive&quot;<br>
				3. Select a drive letter (DO NOT use Z:)<br>
				4. Type sharename path*: (ex: \\starling.lhup.edu\studentapps)<br>
				5. Click OK<br>
				*Get the appropriate sharename and path from your instructor before attempting to map a network drive.<br>
			</blockquote>
		</p><br>
		
		<p> 
			<strong> For information visit the new student computer information pdf here: </strong><br/>
			<a href="url">http://www.lhup.edu/admissions/New_Student_Computer_Information.pdf</a>
		</p><br>';

	include_once 'footer.php';
}
