<?php
/*
File name: signup.php
Created by: David Hall
Created Date: 10/11/2014
Last Modified by: David Hall
Last Modified Date: 11/5/2014
Version 6.0
*/

//page elements imported
include 'connect.php';
include 'header2.php';
include 'sidefiller.php';

echo'<!-- Begin Content -->
	<div id="content">';
echo '<h1>Welcome to the Eaglenet</h1>';
echo '<h2>A page for LHU Students designed by LHU students</h2>';
//divide the page into two columns
echo '<div id ="split1"><h3>Create your new account<br/>
***************************************************************************<br/></h3>';
//user sign up form, do nothing until submitted
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo '<form name="Form1" method="post" action"">
	<table>	
	<tr>
		<td><strong>First name: </strong></td>
		<td><input type="text" name="user_fname" size="15"/></td>
	</tr>
	<tr>
		<td><strong>Last name: </strong></td>
		<td><input type="text" name="user_lname" size="15"/></td>
	</tr>
	<tr>
		<td><strong>Username: </strong></td>
		<td><input type="text" name="user_name" size="15"/>@lhup.edu</td>
	</tr>
	<tr>
		<td><strong>Password: </strong></td>
		<td><input type="password" name="user_pass" size="15"></td>
	</tr>
	<tr>	
		<td><strong>Password again: </strong></td>
		<td><input type="password" name="user_pass_check" size="15"></td>
	</tr>
	<tr>	
		<td></td>
		<td><strong>Choose an Avatar:</strong></td>
	</tr>
	</table>';
	
echo"<table>	
		<tr>
			<td><img src='images/avatar1.png' alt='avatar1' style='width:90px;height:90px'></td>
			<td><img src='images/avatar2.png' alt='avatar2' style='width:90px;height:90px'></td>
			<td><img src='images/avatar3.png' alt='avatar3' style='width:90px;height:90px'></td>
		</tr>
		<tr>
			<td><Input type = 'Radio' Name ='avatarchoice' value= 'avatar1'></td>
			<td><Input type = 'Radio' Name ='avatarchoice' value= 'avatar2'></td>
			<td><Input type = 'Radio' Name ='avatarchoice' value= 'avatar3'></td>
		</tr>
		<tr>
			<td><img src='images/avatar4.png' alt='avatar4' style='width:90px;height:90px'></td>
			<td><img src='images/avatar5.png' alt='avatar5' style='width:90px;height:90px'></td>
			<td><img src='images/avatar6.png' alt='avatar6' style='width:90px;height:90px'></td>
		</tr>
		<tr>
			<td><Input type = 'Radio' Name ='avatarchoice' value= 'avatar4'></td>
			<td><Input type = 'Radio' Name ='avatarchoice' value= 'avatar5'></td>
			<td><Input type = 'Radio' Name ='avatarchoice' value= 'avatar6'></td>
		</tr>
		<tr>
			<td>&nbsp</td>
		</tr>
		<tr>
			<td>&nbsp</td>
			<td>&nbsp</td>
			<td><input type='Submit' name = 'Submit1' value='Submit' /></td>
		</tr>
		</table>
	</form>";
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
		//Email address is formed from username + @lhup.edu
		$userlname = mysqli_real_escape_string($con, $_POST['user_lname']);
		$userfname =mysqli_real_escape_string($con, $_POST['user_fname']);
		$username = mysqli_real_escape_string($con, $_POST['user_name']);
		$userpass = hash('sha256',$_POST['user_pass']);
		$useremail = mysqli_real_escape_string ($con,$_POST['user_name']. "@lhup.edu");
		$uniq_code = uniqid();
		//check which image radio button is checked
		$status1 = 'unchecked';
		$status2 = 'unchecked';
		$status3 = 'unchecked';
		$status4 = 'unchecked';
		$status5 = 'unchecked';
		$status6 = 'unchecked';

		if (isset($_POST['avatarchoice'])){
			$selected_radio = $_POST['avatarchoice'];
			if ($selected_radio == 'avatar1') {
				$status1 = 'checked';
				$useravatar = $selected_radio;
			}
			else if ($selected_radio == 'avatar2') {
				$status2 = 'checked';
				$useravatar = $selected_radio;
			}
			else if ($selected_radio == 'avatar3') {
				$status3 = 'checked';
				$useravatar = $selected_radio;
			}
			else if ($selected_radio == 'avatar4') {
				$status4 = 'checked';
				$useravatar = $selected_radio;
			}
			else if ($selected_radio == 'avatar5') {
				$status5 = 'checked';
				$useravatar = $selected_radio;
			}
			else if ($selected_radio == 'avatar6') {
				$status6 = 'checked';
				$useravatar = $selected_radio;
			}
		}
		else 
			$useravatar = 'avatar1';
		
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
			$sql = "INSERT INTO users (user_fname, user_lname, user_name, user_pass, user_email, user_date, user_level, user_verif, user_status, user_avatar)VALUES ('$userfname','$userlname','$username','$userpass','$useremail', NOW(), 0, '$uniq_code', false, '$useravatar')";
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
echo '<br/><br/>All avatar images are public domain images from <a href = "http://pixabay.com">pixabay.com </a> and comply with CC0 public domain rules.
</div>';
echo '<div id ="split2"><h3>Already Signed Up Click Here to Log in<br/>
***********************************************************</h3>
<a href="index.php"><h2>SIGN IN</h2></a>
</div>';
include 'footer2.php';