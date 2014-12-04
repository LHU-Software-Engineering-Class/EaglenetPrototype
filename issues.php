<?php
/*
File name: issues.php
Created By: Erik Suiker
Created Date: 11/15/14
Last Modified By: Erik Suiker
Last Modified Date: 12/04/14 
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
	echo '<div id="content2">';

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		echo '<p>
			Please select where you are having an issue on eaglenet:
			<br/ >
				<form name="Form1" method="post" action"">
				<select name="type" >
					<option value="forum">Forum</option>
					<option value="thread">Thread</option>
					<option value="post">Post</option>
					<option value="other">Other</option>
				</select>
			</p>
				
			<p>
				Comments: <br/>
				<textarea name = "comments" rows = "10" cols = "50" > </textarea>
			</p>
			<input type="submit" value="Submit">
		</form>';
	}
	else{
		$type = mysqli_real_escape_string($con, $_POST['type']);
		$comments = mysqli_real_escape_string($con, $_POST['comments']);
		$sql = "INSERT INTO issues (issue_date,issue_type, issue_description)
			VALUES (NOW(),'$type','$comments')";
			$result = mysqli_query($con, $sql);
		
			//if user data can not be inserted show error
			if(!$result){
				echo 'Something went wrong Please try again later.';
				header( "refresh:7; url= start.php" );
			}
			//successfully registered and email sent to user
			else{
				echo 'You have successfully submitted an issue.
				Please allow 2-3 days for actions to be taken';
			}
	}

	include 'footer.php';

}

?>
