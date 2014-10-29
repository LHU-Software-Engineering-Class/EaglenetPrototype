<?php
/*
//Created by: David Hall
//Created Date: 10/27/2014
//Version 1.0
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

//!!!!!!!!!!ToDo!!!!!!!!!!!!!!!
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
//Change user level
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo " <div id='content'>
	<strong>Change User's Access Level</strong>";
	echo'<form method="post" action="">
		Username: <input type="text" name="user_name"/><br/>
		User Level: <select name="user_level">
			<option value = 0 >Standard</option>
			<option value = 1 >Moderator</option>
			<option value = 2 >Administrator</option>
		</select>
		<input type="submit" value="Change User Level" />
	</form>
	<hr>
	</div>';
}
else{
	$username = mysqli_real_escape_string($con, $_POST['user_name']);
	$userlevel = mysqli_real_escape_string($con, $_POST['user_level']);
	$sql = "UPDATE users SET user_level = '$userlevel' WHERE user_name = '$username'";
	$result = mysqli_query($con, $sql);
	if(!$result){
		echo'Failed to update user access level';
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

//Deactivate user
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Deactivate User</strong>
	<form method="post" action="">
		Username: <input type="text" name="user_name"/>
		<input type="submit" value="Deactivate User" />
	</form>
	<hr>
	</div>';
}
else{

}

//find forum like form input forum_name
//deactivate Forum
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Deactivate Forum</strong>
	<form method="post" action="">
		Forum ID: <input type="text" name="forum_ID"/>
		<input type="submit" value="Deactivate Forum"/>
	</form>
	<hr>
	</div>';
}
else{

}

//find thread like form input thread_name
//deactivate Thread
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Deactivate Thread</strong>
	<form method="post" action="">
		Thread ID: <input type="text" name="thread_ID"/>
		<input type="submit" value="Deactivate Thread"/>
	</form>
	<hr>
	</div>';
}
else{

}

//find post like form input post_name
//deactivate post
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Deactivate Post</strong>
	<form method="post" action="">
		Post ID: <input type="text" name="post_ID"/>
		<input type="submit" value="Deactivate Post"/>
	</form>
	<hr>
	</div>';
}
else{

}

//change user password
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	echo ' <div id="content">
	<strong>Change User Password</strong>
	<form method="post" action="">
		Username: <input type="text" name="user_name"/><br/>
		Password: <input type="password" name="user_pass"><br/>
		Password again: <input type="password" name="user_pass_check">
		<input type="submit" value="Change User Password" />
	</form>
	<hr>
	</div>';
}
else{

}

//send new verification code
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo ' <div id="content">
	<strong>Send new verification code</strong>
	<form method="post" action="">
		Username: <input type="text" name="user_name"/>
		<input type="submit" value="Send new verification code" />
	</form>
	<hr>
	</div>';
}
else{

}

//edit post by anyone
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	echo ' <div id="content">
	<strong>Edit post by anyone</strong>
	<hr>
	</div>';
}
else{

}

//Edit thread by anyone
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	echo ' <div id="content">
	<strong>Edit thread by anyone</strong>
	<hr>
	</div>';
}
else{

}

//edit Forum by anyone
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	echo ' <div id="content">
	<strong>Edit Forum by anyone</strong>
	<hr>
	</div>';
}
else{

}

include 'footer.php';
}