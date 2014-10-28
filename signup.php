<?php
/*
//Created by: David Hall
//Created Date: 10/11/2014
//Last Modified: 10/27/2014
//Version 5.0
*/

//page elements imported
include 'connect.php';
include 'header2.php';
include 'sidefiller.php';

echo'<!-- Begin Content -->
	<div id="content2">';
echo '<h1>Welcome to the Eaglenet</h1>';
echo '<h2>A page for LHU Students designed by LHU students</h2>';
//divide the page into two columns
echo '<div id ="split1"><h3>Create your new account<br/>
***************************************************************************<br/></h3>';
//user sign up form do nothing untild submitted
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo '<form name="Form1" method="post" action"">
		Username: <input type="text" name="user_name"/>@lhup.edu<br/>
		Password: <input type="password" name="user_pass"><br/>
		Password again: <input type="password" name="user_pass_check"><br/>
		<input type="submit" value="Submit" /><br/>
	 </form>';
}
//user has submitted their information. now check to see if it is valid
else{
	//check if username field has been filled correctly and does not violate rules
	if(isset($_POST['user_name'])){
		$errors = array(); // declare the array for later use 
		//check if username has already been used
		$result =mysqli_query($con, "SELECT user_name from users");
		while($row = mysqli_fetch_array($result)) {
			if ($row['user_name'] === $_POST['user_name']){
				$errors[1] = 'The username has been already used';
				break;
			}
		}
		//check to see if username only contains letters and digits
		if(!ctype_alnum($_POST['user_name'])){
			$errors[2] = 'The username can only contain letters and digits.';
		}
	}
	else{
		$errors[4] = 'The username field must not be empty.';
	}
	//checks if password has been set
	if(isset($_POST['user_pass'])){
		//checks if passwords match
		if($_POST['user_pass'] != $_POST['user_pass_check']){
			$errors[5] = 'The two passwords did not match.';
		}
	}
	else{
		$errors[6] = 'The password field cannot be empty.';
	}
	//error reporting method, if a check fails it enters it into the array
	if(!empty($errors)){ //check for an empty array, if there are errors, they're in this array (note the ! operator)
		echo 'Uh-oh.. a couple of fields are not filled in correctly..';
		echo '<ul>';
		//walk through the array so all the errors get displayed 
		foreach($errors as $key => $value) {
			echo '<li><strong>' . $value . '</strong></li>'; // this generates a nice error list 
		}
		echo '</ul>';
		echo 'This page will refresh in 10 seconds and take you back to the signup page.';
			header( "refresh:7; url= signup.php" );
	}
	else{
		//checks done, now insert the user
		//take the form values and put into reusable php variables
		//the md5 function hashes the password
		//Email address is formed from username + @lhup.edu
		$username = mysqli_real_escape_string($con, $_POST['user_name']);
		$userpass = hash('sha256',$_POST['user_pass']);
		$useremail = mysqli_real_escape_string ($con,$_POST['user_name']. "@lhup.edu");
		$uniq_code = uniqid();
		
		//Email with verification code sent to email generated
		include 'mail.php';
		
		//if email cannot be sent 
		if(!$mail->Send()) {
			echo 'Something went wrong while registering.<br/>
			Please check you have entered a valid @lhup.edu email address.<br/>
			You have not been registered to use EagleNet.<br/><br/>
			This page will refresh in 10 seconds and take you back to the signup page.';
			header( "refresh:10; url= signup.php" );
		} 
		//if email was sent successfully submit the data to the database
		else {
			$sql = "INSERT INTO users (user_name, user_pass, user_email, user_date, user_level, user_verif, user_status)VALUES ('$username','$userpass', '$useremail', NOW(), 0, '$uniq_code', false)";
			$result = mysqli_query($con, $sql);
			
			//if user data can not be inserted show error
			if(!$result){
				echo 'Something went wrong while registering. Please try again later.';
				header( "refresh:7; url= signup.php" );
			}
			//successfully registered and email sent to user
			else{
				echo 'You have successfully registered :- <br/>
				A verification E-Mail message has been sent.<br/>
				Please check your email for verification code.<br/><br/>
				<h3>Click here to go to the <a href="verification.php">Verification Page</a></h3>';
			mysqli_close($con);
			}
		}
	}
}
echo '</div>';
echo '<div id ="split2"><h3>Already Signed Up Click Here to Log in<br/>
***********************************************************</h3>
<a href="index.php"><h2>SIGN IN</h2></a>
</div>';
include 'footer2.php';