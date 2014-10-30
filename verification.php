<?php

/*
//Created by: Greg Hall
//Created Date: 10/29/2014
//Last Modified: 10/29/2014
//Version 1.0
*/

include 'connect.php';
include 'header2.php';
include 'sidefiller.php';
echo'<!-- Begin Content -->
<div id="content2">';
echo '<h1>Welcome to Eaglenet</h1>';
echo "<h2>This page is for verifying your account.</h2><br />
<h3>If you haven't signed up please go to <a href='signup.php'>SIGN UP</a> page.</h3><br/>";

//Verification form and submit button
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo'<h3>Please enter the verification code sent to your @lhup.edu email address.</h3>';
	echo '<form name="Form1" method="post" action="">
            Verification Code: <input type="text" name="user_verif"/><br/>
            <input type="submit" value="Submit"/><br/>
        </form>';
}

else {
	if($_POST['user_verif'] != ""){
		$result = mysqli_query($con, "SELECT user_name, user_verif, user_status from users");
		while ($row = mysqli_fetch_array($result)){
			if($row['user_verif'] === $_POST && $row['user_status'] == true){
				echo '<h3>You have already activated your account please proceed to the 
				<a href="index.php">SIGN IN</a> page.</h3>';
				break;
			}
			//checks user_verif from users table against the one entered and if the user has not been activated
			elseif($row['user_verif'] === $_POST['user_verif'] && $row['user_status'] == false){
				$username = $row['user_name'];
				//sets the user status boolean to true
				$sql = "UPDATE users SET user_status = true where user_name = '$username'";
				$result = mysqli_query($con,$sql);
				//if user data can not be inserted show error
				if (!$result)
					echo 'Something went wrong while validating. Please try again later.';
			}
			else{
				echo '<h3>You have succesfully validated your account! <br/><br/>
					Proceed to the <a href="index.php">SIGN IN</a> page.<br/><br/>
					This page will refresh in 5 seconds and take you back to the sign-in page.</h3>';
					header("refresh:5; url=index.php");
				break;
			}
		}
	}      
	//error statement if user enters a null in verification box
	else{
		echo 'Please enter your verification code into the box <br/><br/>
		This page will refresh in 5 seconds and take you back to the verification page.';
		header("refresh:5");
	}
}

include 'footer2.php';