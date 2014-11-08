<?php
/*
File name: admin.php
Created by: David Hall
Created Date: 10/28/2014
Last Modified by: David Hall
Last Modified Date: 10/28/2014
Version 3.0
*/

/*
Need to to:
activate/ deactivate forum
activate/ deactivate thread
activate/ deactivate post
change user password
edit post by anyone
edit thread by anyone
edit forum
*/

//admin.php
include 'connect.php';
//checks if user is signed in and verified to use the EagleNet if not show dummy page
if ($_SESSION['signed_in'] == false | $_SESSION['user_status'] != true){
	include 'header2.php';
	include 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.<br/>
	</div>';
	include 'footer2.php';
}
//Check if the user has the access rights to view this page show redirect page
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
//user is logged in, verified and has access rights to admin page
else{
	include 'header.php';
	include 'sidebar.php';
echo'<div id="content3">';

//Link to forum_create.php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo '<div id="content">
	<form action="forum_create.php">
		<input type="submit" value="Create a new forum">
	</form>
	<hr>
	</div>';
}
if($_SERVER['REQUEST_METHOD'] != 'POST'){
echo ' <div id="split1">';
$result = mysqli_query($con, "SELECT user_name from users where user_name REGEXP'^[abcdefghijklm]'");
echo'<B>EagleNet Users A-M</B> <BR>
<form method="post" action="">
<SELECT NAME="user" SIZE="10" MULTIPLE>
	<OPTION SELECTED> ----------------------';
	while($row = mysqli_fetch_assoc($result)) {
	echo'<OPTION>';
	echo $row['user_name'];
}
echo'</SELECT>
</form>
</div>';

echo ' <div id="split2">';
$result = mysqli_query($con, "SELECT user_name from users where user_name REGEXP'^[nopqrstuvwxyz]'");
echo'<B>EagleNet Users N-Z</B> <BR>
<form method="post" action="">
	
<SELECT NAME="user" SIZE="10" MULTIPLE>
	<OPTION SELECTED> ----------------------';
	while($row = mysqli_fetch_assoc($result)) {
	echo'<OPTION>';
	echo $row['user_name'];
}
echo'</SELECT>
</form>
</div>';
}

//DONE	
//----------------------------------------------------------------------------
//Change user level
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo " <div id='content'>
	<strong>Change User's Access Level</strong>";
	echo'<form name= "userlev" method="post">
		Username: <input type="text" name="user_name"/><br/>
		User Level: <select name="user_level">
			<option value = 0 >Standard</option>
			<option value = 1 >Moderator</option>
			<option value = 2 >Administrator</option>
		</select>
		<input type="submit" name="update-userlev"value="Change User Level" />
	</form>
	<hr>
	</div>';
}
	//checks if user access level form is filled and updates user_level to what was set
	if (!empty($_POST['update-userlev'])) {
		$username = mysqli_real_escape_string($con, $_POST['user_name']);
		$userlevel = mysqli_real_escape_string($con, $_POST['user_level']);
		$sql = "UPDATE users SET user_level = '$userlevel' WHERE user_name = '$username'";
		$result = mysqli_query($con, $sql);
		if(!$result){
			echo'<h3>Failed to update user access level</h3>';
		}
		else{
			echo "<h3>User $username's access rights have been changed to ";
			if ($userlevel ==0){
				echo'Standard';
			}
			elseif($userlevel ==1){
				echo'Moderator';
			}
			elseif($userlevel ==2){
				echo'Administrator';
			}
			echo'</h3>';
		}
	}
	
//DONE	
//----------------------------------------------------------------------------
//Activate/Deactivate user
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Activate / Deactivate User</strong>
	<form method="post" action="">
		Username: <input type="text" name="user_name"/>
		<input type="submit" value="Activate User" name="activate-user" />
		<input type="submit" value="Deactivate User" name="deactivate-user" />
	</form>
	<hr>
	</div>';
}
	//Updates user_status boolean to true
	if (!empty($_POST['activate-user'])) {
		$username = mysqli_real_escape_string($con, $_POST['user_name']);
		$sql = "UPDATE users SET user_status = true WHERE user_name = '$username'";
		$result = mysqli_query($con, $sql);
		if(!$result){
			echo'<h3>Failed to activate user $username</h3>';
		}
		else{
			echo '<h3>User '.$username.' has been activated </h3>';
		}
	}
	//checks if activate/deactivate user form is filled and updates user_status boolean to false
	if (!empty($_POST['deactivate-user'])) {
		$username = mysqli_real_escape_string($con, $_POST['user_name']);
		$sql = "UPDATE users SET user_status = false WHERE user_name = '$username'";
		$result = mysqli_query($con, $sql);
		if(!$result){
			echo'<h3>Failed to deactivate user $username</h3>';
		}
		else{
			echo '<h3>User '.$username.' has been deactivated </h3>';
		}
	}

//----------------------------------------------------------------------------
//find forum like form input forum_name
//activate/ deactivate Forum
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Deactivate Forum</strong>
	<form method="post" action="">
		Forum ID: <input type="text" name="forum_ID"/>
		<input type="submit" value="Activate Forum" name="activate-forum" />
		<input type="submit" value="Deactivate Forum" name="deactivate-forum"/>
	</form>
	<hr>
	</div>';
}
	if (!empty($_POST['activate-forum'])) {

	}
	if (!empty($_POST['deactivate-forum'])) {

	}

//----------------------------------------------------------------------------
//find thread like form input thread_name
//activate/ deactivate Thread
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Deactivate Thread</strong>
	<form method="post" action="">
		Thread ID: <input type="text" name="thread_ID"/>
		<input type="submit" value="Activate Thread" name="activate-thread"/>
		<input type="submit" value="Deactivate Thread" name="deactivate-thread"/>
	</form>
	<hr>
	</div>';
}
	if (!empty($_POST['activate-thread'])) {

	}
	if (!empty($_POST['deactivate-thread'])) {

	}

//----------------------------------------------------------------------------
//find post like form input post_name
//activate/ deactivate post
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Deactivate Post</strong>
	<form method="post" action="">
		Post ID: <input type="text" name="post_ID"/>
		<input type="submit" value="Activate Post" name="activate-post"/>
		<input type="submit" value="Deactivate Post" name="deactivate-post"/>
	</form>
	<hr>
	</div>';
}
	if (!empty($_POST['activate-post'])) {

	}
	if (!empty($_POST['deactivate-post'])) {

	}

//----------------------------------------------------------------------------
//change user password
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	echo ' <div id="content">
	<strong>Change User Password</strong>
	<form method="post" action="">
		Username: <input type="text" name="user_name"/><br/>
		Password: <input type="password" name="user_pass"><br/>
		Password again: <input type="password" name="user_pass_check">
		<input type="submit" value="Change User Password" name="change-pass"/>
	</form>
	<hr>
	</div>';
}
	if (!empty($_POST['change-pass'])) {

	}
	
//DONE	
//----------------------------------------------------------------------------
//send new verification code email to user with new code, update DB with code and set user_status to false
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Send new verification code</strong>
	<form method="post" action="">
		Username: <input type="text" name="user_name"/>
		<input type="submit" value="Send new verification code" name="new-verif"/>
	</form>
	<hr>
	</div>';
}
	if (!empty($_POST['new-verif'])) {
		$username = mysqli_real_escape_string($con, $_POST['user_name']);
		$useremail = mysqli_real_escape_string ($con,$_POST['user_name']. "@lhup.edu");
		$uniq_code = uniqid();
		
		//Email with verification code sent to email generated
		include 'mail.php';
		//if email cannot be sent 
		if(!$mail->Send()) {
			echo 'Failed to send a new verification email to '.$username.'';
		} 
		
		$sql = "UPDATE users SET user_verif = '$uniq_code', user_status = false WHERE user_name = '$username'";
		$result = mysqli_query($con, $sql);
		if(!$result){
			echo '<h3>Something went wrong.</h3>';
		}
		else{
			echo '<h3>A new verification E-Mail message has been sent to '.$username.'</h3>';
		}
	}

//----------------------------------------------------------------------------
//edit post by anyone
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	echo ' <div id="content">
	<strong>Edit post by anyone</strong>
	<hr>
	</div>';
}

//----------------------------------------------------------------------------
//Edit thread by anyone
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	echo ' <div id="content">
	<strong>Edit thread by anyone</strong>
	<hr>
	</div>';
}

//----------------------------------------------------------------------------
//edit Forum by anyone
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	echo ' <div id="content">
	<strong>Edit Forum by anyone</strong>
	<hr>
	</div>';
}

include 'footer.php';
}