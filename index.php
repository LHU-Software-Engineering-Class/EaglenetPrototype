<?php
/*
//Created by: David Hall
//Created Date: 10/11/2014
//Last Modified: 11/6/2014
//Version 4.0
*/

include 'connect.php';
include 'header2.php';
include 'sidefiller.php';

echo'<!-- Begin Content -->
	<div id="content2">';
echo '<h1>Welcome to the Eaglenet</h1>';
echo '<h2>A page for LHU Students designed by LHU students</h2>';

echo '<div id ="split2"><h3>Sign in<br/>
***********************************************************</h3>';
//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){
    echo '<h3>You are already signed in. <br/><br/>
	<a href="start.php">CLICK HERE</a> to go back the start page.<br/><br/>
	Or you can <a href="signout.php">SIGN OUT</a> if you want.</h3>';
}
else{
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	/*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on */
	echo '<form method="post" action="">
		Username: <input type="text" name="user_name" />@lhup.edu<br/>
		Password: <input type="password" name="user_pass"><br/>
		<input type="submit" value="Sign in" /><br/>
	 </form>';
}
else{
	/* so, the form has been posted, we'll process the data in three steps:
		1.  Check the data
		2.  Let the user refill the wrong fields (if necessary)
		3.  Verify if the data is correct and return the correct response
	*/
	$errors = array(); /* declare the array for later use */
	 
	if(!isset($_POST['user_name'])){
		$errors[] = 'The username field must not be empty.';
	}
	if(!isset($_POST['user_pass'])){
		$errors[] = 'The password field must not be empty.';
	}
	if(!empty($errors)){ /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
		echo '<br/>Uh-oh.. a couple of fields are not filled in correctly..';
		echo '<ul>';
		foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<li>' . $value . '</li>'; /* this generates a nice error list */
		}
		echo '</ul>';
	}
	else{
		//the form has been posted without errors, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$sql = "SELECT 
					user_id,
					user_name,
					user_level,
					user_status
				FROM
					users
				WHERE
					user_name = '" . mysqli_real_escape_string($con,$_POST['user_name']) . "'
				AND
					user_pass = '" . hash('sha256',($_POST['user_pass'])) . "'";
		$result = mysqli_query($con,$sql);
		if(!$result){
			//something went wrong, display the error
			echo '<br/>Something went wrong while signing in. Please try again later.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else{
			//the query was successfully executed, there are 2 possibilities
			//1. the query returned data, the user can be signed in
			//2. the query returned an empty result set, the credentials were wrong
			if(mysqli_num_rows($result) == 0){
				echo '<br/>You have supplied a wrong user/password combination. Please try again.';
			}
			else{
				while($row = mysqli_fetch_assoc($result)){
					if($row['user_status']==false){
						echo'Sorry you must verify your identity before your can sign in<br />
						<h3>Click here to go to the <a href="verification.php">Verification Page</a></h3>';
						break;
					}
					else{
						//put the signed_in, user_id, user_name and user_level values in the $_SESSION, so we can use it at various pages
						$user = $row['user_id'];
						$_SESSION['signed_in'] = true;
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['user_name'] = $row['user_name'];
						$_SESSION['user_level'] = $row['user_level'];
						$_SESSION['user_status'] = $row['user_status'];
						$sqlx = "UPDATE users SET user_last_login = NOW() where user_id= ".$user."";
						$resultx = mysqli_query($con,$sqlx);
						
						echo ' Welcome, ' . $_SESSION['user_name'] . '. <a href="start.php">Proceed to the start page</a>.<br /><br />
						Or wait 5 seconds and you will be taken to the start page.';
						
						header( "refresh:5; url= start.php" );
					}
				}
			}
		}
	}
}
}
echo '</div>';
echo '<div id ="split1"><h3>Click here to create a new account<br/>
***********************************************************</h3>
<a href="signup.php"><h2>CREATE ACCOUNT<h2></a>
</div>';
include 'footer2.php';