<?php
/*
File name: index.php
Created by: David Hall
Created Date: 10/11/2014
Last Modified by: David Hall
Last Modified: 11/6/2014
Version 4.0
*/

include 'connect.php';
include 'header2.php';
include 'sidefiller.php';

echo'<!-- Begin Content -->
	<div id="content2">';
echo '<h1>Welcome to the Eaglenet</h1>';
echo '<h2>A page for LHU Students designed by LHU students</h2>';

//split the page into two sections Sign in on one side and a link to account creation on the other
echo '<div id ="split2"><h3>Sign in<br/>
******************************************</h3>';

//first, check if the user is already signed in. If that is the case, there is no need to display the sign in prompt
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){
    echo '<h3>You are already signed in. <br/><br/>
	<a href="start.php">CLICK HERE</a> to go back the start page.<br/><br/>
	Or you can <a href="signout.php">SIGN OUT</a> if you want.</h3>';
}
else{
	//only show the form until user submits
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
		/* The form has been posted, we'll process the data in three steps:
			1.  Check the data
			2.  Let the user refill the wrong fields (if necessary)
			3.  Verify if the data is correct and return the correct response
		*/
		$errors = array(); /* declare the array for later use */
		 
		// Check if username field has been set
		if(!isset($_POST['user_name'])){
			$errors[] = 'The username field must not be empty.';
		}
		// Check if password field has been set
		if(!isset($_POST['user_pass'])){
			$errors[] = 'The password field must not be empty.';
		}
		// Display errors
		if(!empty($errors)){ /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
			echo '<br/>Uh-oh.. a couple of fields are not filled in correctly..';
			echo '<ul>';
			foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
			{
				echo '<li>' . $value . '</li>'; /* this generates a nice error list */
			}
			echo '</ul>';
			echo '<br/><br/>This page will refresh in 5 seconds and take you back to the sign-in page.';
			header( "refresh:5; url= index.php" );
		}
		else{
			//the form has been posted without errors, now save it
			$sql = "SELECT 
						user_id,
						user_name,
						user_level,
						user_status,
						user_last_login
					FROM
						users
					WHERE
						user_name = '" . mysqli_real_escape_string($con,$_POST['user_name']) . "'
					AND
						user_pass = '" . hash('sha256',($_POST['user_pass'])) . "'";
			//Submit the select statement
			$result = mysqli_query($con,$sql);
			if(!$result){
				//something went wrong, display the error
				echo '<br/>Something went wrong while signing in. Please try again later.';
				//echo mysql_error(); //debugging purposes, uncomment when needed
				echo '<br/><br/>This page will refresh in 5 seconds and take you back to the sign-in page.';
				header( "refresh:5; url= index.php" );
			}
			else{
				//the query was successfully executed, there are 2 possibilities
				//1. the query returned data, the user can be signed in
				//2. the query returned an empty result set, the credentials were wrong
				if(mysqli_num_rows($result) == 0){
					echo '<br/>You have supplied a wrong user/password combination. Please try again.';
					echo '<br/><br/>This page will refresh in 5 seconds and take you back to the sign-in page.';
					header( "refresh:5; url= index.php" );
				}
				else{
					//check if user is verified
					while($row = mysqli_fetch_assoc($result)){
						if($row['user_status']==false){
							echo'Sorry you must verify your identity before your can sign in<br />
							<h3>Click here to go to the <a href="verification.php">Verification Page</a></h3>';
							break;
						}
						else{
							//put the signed_in, user_id, user_name, user_level, user_status, and last_login values in the $_SESSION, so we can use it at various pages
							$user = $row['user_id'];
							$_SESSION['signed_in'] = true;
							$_SESSION['user_id'] = $row['user_id'];
							$_SESSION['user_name'] = $row['user_name'];
							$_SESSION['user_level'] = $row['user_level'];
							$_SESSION['user_status'] = $row['user_status'];
							$_SESSION['user_last_login'] = $row['user_last_login'];
							//update the user_last_login field of the user
							$sqlx = "UPDATE users SET user_last_login = NOW() where user_id= ".$user."";
							$resultx = mysqli_query($con,$sqlx);
							mysqli_error($con);
							// Display welcome message and auto redirect to start page
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
//second half of the page with create account link
echo '<div id ="split1"><h3>Click here to create a new account<br/>
******************************************</h3>
<a href="signup.php"><h2>CREATE ACCOUNT<h2></a>
</div>';
include 'footer2.php';