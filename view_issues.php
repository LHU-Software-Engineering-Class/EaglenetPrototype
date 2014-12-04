<?php
/*
File name: view_issues.php
Created By: Erik Suiker
Created Date: 12/3/14
Last Modified By: Erik Suiker
Last Modified Date: 12/3/14 
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
/*
If they enter the else statement then they are taken to the the issues page
and at that point they can enter a issue that will be put into the DB for
admins to review later
*/
else {
	include 'header.php';
	include 'sidebar.php';
	echo '<div id="content">';
	
	$sql = "SELECT issue_id, issue_type, issue_description, issue_date
			FROM issues";

	$result=mysqli_query($con, $sql);

	if(!$result){
		echo 'The issues could not be displayed, please try again later.';
	}
	else{
		if (mysqli_num_rows($result) == 0){
			echo 'There are no issues... yeah right';
		}
		else{
		
		echo '<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
					<tr align="center">
						<td class="thead">ID</td>
						<td class="thead">TYPE</td>
						<td class="thead">DATE</td>
					</tr>';
					
			//display forum data
			while($row = mysqli_fetch_assoc($result)){
				echo'
					<tr align="center">
						<td class="tcat">'.$row['issue_id'].'</td>
						<td class="tcat">'.$row['issue_type'].'</td>
						<td class="tcat">'.$row['issue_date'].'</td>
					</tr>
					<tr>
						<td>
						<div id = "post">
						'.$row['issue_description'].'
						</div>
						</td>
					</tr>';
			}
			echo '</table>';
		}
	}
	include 'footer.php';
}
?>
