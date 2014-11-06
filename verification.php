<?php
include 'connect.php';
include 'header2.php';
include 'sidefiller.php';
/*
//Created by: Greg Hall
//Created Date: 10/29/2014
//Version 1.0
*/
include 'connect.php';

include 'header2.php';

include 'sidefiller.php';

echo'<!-- Begin Content -->

<div id="content2">';

echo '<h1>Welcome to the Eaglenet</h1>';

echo "<h2>This page is to activate your account once you received the verification email.</h2><br />

<h3>If you haven't signed up please go to the <a href='signup.php'>SIGN UP</a> page. </h3><br/>";



//form to enter the verification code sent via email to the user

if($_SERVER['REQUEST_METHOD'] != 'POST'){

	echo'<h3>Please enter the verification code sent to your @lhup.edu email address.</h3>';

	echo '<form name="Form1" method="post" action"">

	Verification Code: <input type="text" name="user_verif"/><br/>

	<input type="submit" value="Submit" /><br/>

	</form>';

}

else{

	//tests to make sure the user entered a code

	if($_POST['user_verif'] != ""){

		//select the user_name and user_verif code from the users table

		$result = mysqli_query($con, "SELECT user_name, user_verif, user_status from users"); 

		//go through the returned query row by row

		while($row = mysqli_fetch_array($result)) {

			//checks to see if user is already verified

			if ($row['user_verif'] === $_POST['user_verif'] & $row['user_status'] == true){

				echo '<h3>You have already activated your account please proceed to the 

				<a href="index.php">SIGN IN</a> page.</h3>';

				break;

			}

			//checks user_verif from users table against the one entered and if the user has not been activated

			elseif (($row['user_verif'] === $_POST['user_verif']) & $row['user_status'] == false){

				$username = $row['user_name'];

				//sets the user status boolean to true

				$sql = "UPDATE users SET user_status = true where user_name = '$username'";

				$result = mysqli_query($con, $sql);

				//if user data can not be inserted show error

				if(!$result){

					echo 'Something went wrong while validating. Please try again later.';

				}

				else{

					echo'<h3>You have successfully validated your account! <br /><br />

					Proceed to the <a href="index.php">SIGN IN</a> page.<br /><br />

					This page will refresh in 5 seconds and take you back to the sign-in page.</h3>';

					header( "refresh:5; url= index.php");

					break;

				}

			}

		}

	}

	//error statement if user enters a null in verification box

	else {

		echo 'Please enter your verification code into the box <br /><br />

		This page will refresh in 5 seconds and take you back to the verification page.';

		header( "refresh:5");

	}

}

include 'footer2.php';