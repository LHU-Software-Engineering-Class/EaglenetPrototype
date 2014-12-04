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
edit post by anyone
edit thread by anyone
edit forum
*/

//admin.php
include_once 'connect.php';
//check if user is signed in and verified to use the EagleNet if not show dummy page
if ($_SESSION['signed_in'] == false | $_SESSION['user_status'] == false){
	include_once 'header2.php';
	include_once 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.<br/>
	</div>';
	include_once 'footer2.php';
}
//Check if the user has the access rights to view this page show redirect page
if($_SESSION['user_level'] == 0){
	include_once 'header.php';
	include_once 'sidebar.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.<br/>
	<h3>Please go back to the authorized pages. <br/><br/>
	Or <a href="start.php">CLICK HERE</a> to go back to the Start page.</h3>
	</div>';
	include_once 'footer.php';
}
//If the user has Moderator or Administrator access allow access to these features
//Forum create
//Find users
//Find threads by username
//find posts by username

if ($_SESSION['user_level'] == 1 or $_SESSION['user_level'] == 2){
	include_once 'strip_html_tags.php';
	include_once 'header.php';
	include_once 'sidebar.php';
	echo'<div id="content3">';
//**********************************************************************
//Link to forum_create.php page
	//Only show form until posted
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		echo'<h3>MODERATOR AND ADMINISTRATOR LEVEL PRIVILEGES</h3>
		<hr/>
		<div id="content">
		<form action="forum_create.php">
			<input type="submit" value="Create a new forum">
		</form>
		</div>';
	}
//Link to forum_create.php page
	//Only show form until posted
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		echo'
		<div id="content">
		<form action="view_issues.php">
			<input type="submit" value="View Issues Page">
		</form>
		<hr>
		</div>';
	}
//**********************************************************************
//Find users by 
	//Only show form until posted
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		echo '<div id="content"><strong>Find a User</strong>
		<form name="Form1" method="post" action"">
			Username: <input type="text" name="user_name"/><br/>
			First Name: <input type="text" name="user_fname"/><br/>
			Last Name: <input type="text" name="user_lname"/><br/>
			<input type="submit" value="Search"name="find-user"/>
		</form>
		<hr/>
		</div>';
	}
		if (!empty($_POST['find-user'])) 
		{
			//Take form values convert to php format and strip tags
			$username = mysqli_real_escape_string($con,$_POST['user_name']);
			$username = strip_html_tags($username);
			$fname = mysqli_real_escape_string($con,$_POST['user_fname']);
			$fname = strip_html_tags($fname);
			$lname = mysqli_real_escape_string($con,$_POST['user_lname']);
			$lname = strip_html_tags($lname);
			
			//SQL query for users based on form input
			$sql = "SELECT * FROM users WHERE user_name = '$username' OR user_fname = '$fname' OR  user_lname = '$lname'";
			$result = mysqli_query($con, $sql);
			if(!$result){
				echo'Error';
			}
			else{
				//Output none no users if there are none
				if(mysqli_num_rows($result) == 0){
					echo'<h3>Sorry No users by that name</h3>';
				}
				else{
					//Output each user in a separate table
					while($row = mysqli_fetch_array($result)){
						echo'<table class="tborder" cellpadding="6" cellspacing="0" border="0" width="100%">
						<tr class="tcat">
							<td>ID </td>
							<td>Username </td>
							<td>Last Name </td>
							<td>First Name </td>
							<td>Level </td>
							<td>Email </td>
							<td>Status </td>
							<td>Post Count </td>
							<td>User date </td>
							<td>Last Login </td>
						</tr>
						<tr>
							<td>'.$row['user_id'].'</td>
							<td>'.$row['user_name'].'</td>
							<td>'.$row['user_lname'].'</td>
							<td>'.$row['user_fname'].'</td>';
							//Convert user level number to text
							if ($row['user_level'] ==0){
								echo'<td>Standard</td>';
							}
							elseif($row['user_level'] ==1){
								echo'<td>Moderator</td>';
							}
							elseif($row['user_level'] ==2){
								echo'<td>Administrator</td>';
							}
							echo'<td>'.$row['user_email'].'</td>';
							//Convert boolean status to text
							if ($row['user_status'] ==0){
								echo'<td>Inactive</td>';
							}
							else{
								echo'<td>Active</td>';
							}
							echo'<td>'.$row['post_count'].'</td>
							<td>'.$row['user_date'].'</td>
							<td>'.$row['user_last_login'].'</td>
						</tr>
						';
					}
				}
			}
		}
//**********************************************************************
//Find Threads by username
	//Only show form until posted
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		echo '<div id="content"><strong>Select all threads by username</strong>
		<form name="Form1" method="post" action"">
			Username: <input type="text" name="user_name"/><br/>
			<input type="submit" value="Search" name="find-threads"/>
		</form>
		<hr/>
		</div>';
	}
	
		if (!empty($_POST['find-threads'])) 
		{	
			echo '<h3>Threads by: '.$username.'</h3>';
			//Take form values convert to php format and strip tags
			$username = mysqli_real_escape_string($con,$_POST['user_name']);
			$username = strip_html_tags($username);
			
			//SQL query for threads based on form input
			$threads = "SELECT * FROM threads WHERE thread_by = (SELECT user_id FROM users WHERE user_name = '$username')";
			$result = mysqli_query($con, $threads);
			if(!$result){
				echo'Error';
			}
			else{
				//Output none no threads if there are none by user
				if(mysqli_num_rows($result) == 0){
					echo 'NO THREADS BY USER';
				}
				else{
					//Output all the threads by the user entered in a table
					echo'<table class="tborder" cellpadding="6" cellspacing="0" border="0" width="100%">
						<tr class="tcat">
							<td>Thread By</td>
							<td>Thread ID</td>
							<td>Thread Category</td>
							<td colspan="2">Thread Date</td>
							<td colspan="2" >Thread Title</td>
							<td>Status</td>
							<td></td>
						</tr>';
					while($row = mysqli_fetch_array($result)){
						echo'<tr>
							<td>'.$row['thread_by'].'</td>
							<td>'.$row['thread_id'].'</td>
							<td>'.$row['thread_cat'].'</td>
							<td colspan="2">'.$row['thread_date'].'</td>
							<td colspan="2">'.$row['thread_subject'].'</td>';
							//Convert boolean status to text
							if ($row['thread_status'] ==0){
								echo'<td>Inactive</td>';
							}
							else{
								echo'<td>Active</td>';
							}
							echo'<td><a href="">Deactivate</a></td>
						</tr>';
					}
					echo'</table>';
				}
			}
		}
		
//**********************************************************************	
//Find posts by username
	//Only show form until posted
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		echo '<div id="content"><strong>Select all posts by username</strong>
		<form name="Form1" method="post" action"">
			Username: <input type="text" name="user_name"/><br/>
			<input type="submit" value="Search"name="find-posts"/>
		</form>
		<hr/>
		</div>';
	}
	
	if (!empty($_POST['find-posts'])) 
	{
		echo '<h3>Posts by: '.$username.'</h3>';
		//Take form values convert to php format and strip tags
		$username = mysqli_real_escape_string($con,$_POST['user_name']);
		$username = strip_html_tags($username);
		
		//SQL query for posts based on form input
		$posts = "SELECT * FROM posts WHERE post_by =(SELECT user_id FROM users WHERE user_name = '$username')";
		$result = mysqli_query($con, $posts);
		if(!$result){
			echo'Error';
		}
		else{
			//Output no posts if there are none by user
			if(mysqli_num_rows($result) == 0){
				echo 'NO POSTS BY USER';
			}
			else{
				//Output all the posts by the user entered in a separate table
				while($row = mysqli_fetch_array($result)){
					echo'
					<div style="padding:0px 0px 6px 0px">
					<table class="tborder" cellpadding="6" cellspacing="0" border="0" width="100%">
					<tr class="tcat">
						<td>Post Topic</td>
						<td>Post ID</td>
						<td colspan="2">Post Date</td>
						<td>Post Type</td>
						<td>Status</td>
						<td></td>
					</tr>
					<tr class="thead">
						<td>'.$row['post_topic'].'</td>
						<td>'.$row['post_id'].'</td>
						<td colspan="2">'.$row['post_date'].'</td>';
						
						//Convert post type number to text
						if ($row['post_type'] == 1){
							echo'<td>First Post</td>';
						}
						if ($row['post_type'] == 2){
							echo'<td>Post to</td>';
						}
						if ($row['post_type'] == 3){
							echo'<td>Reply</td>';
						}

						//Convert boolean status to text
						if ($row['post_status'] ==0){
							echo'<td>Inactive</td>';
						}
						else{
							echo'<td>Active</td>';
						}
						echo'<td><a href="">Deactivate</a></td>
					</tr>
					<tr class="tcat">
						<td>Post Title</td>
						<td colspan="3">'.$row['post_title'].'</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="20">
							<div id = "post">
								'.$row['post_content'].'
							</div>
						</td>
					</tr>
					</table>
					
					</div>';
				}
			}
		}
	}
}
//If the user has ADMINISTRATOR access allow access to these features:
	//Change user level
	//Activate/ Deactivate user
	//Send new verification code to user
if ($_SESSION['user_level'] == 2){

//----------------------------------------------------------------------------
//Change user level
	//Only show form until posted
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		echo'<h3>ADMINISTRATOR LEVEL PRIVILEGES</h3>
		<hr/>';
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
		if (!empty($_POST['update-userlev'])) 
		{
			//Take form values convert to php format and strip tags
			$username = mysqli_real_escape_string($con, $_POST['user_name']);
			$username = strip_html_tags($username);
			$userlevel = mysqli_real_escape_string($con, $_POST['user_level']);
			
			//SQL query for posts based on form input
			$sql = "UPDATE users SET user_level = '$userlevel' WHERE user_name = '$username'";
			$result = mysqli_query($con, $sql);
			if(!$result){
				echo'<h3>Failed to update user access level</h3>';
			}
			else{
				echo "<h3>User $username's access rights have been changed to ";
				//Convert user level number to text
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
		
//----------------------------------------------------------------------------
	//Activate/Deactivate user
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
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
		if (!empty($_POST['activate-user'])) 
		{
			//Take form values convert to php format and strip tags
			$username = mysqli_real_escape_string($con, $_POST['user_name']);
			$username = strip_html_tags($username);
			
			//SQL update user status to true
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
		if (!empty($_POST['deactivate-user'])) 
		{
			//Take form values convert to php format and strip tags
			$username = mysqli_real_escape_string($con, $_POST['user_name']);
			$username = strip_html_tags($username);
			
			//SQL update user status to true
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
			
			//Take form values convert to php format and strip tags
			$username = mysqli_real_escape_string($con, $_POST['user_name']);
			$username = strip_html_tags($username);
			$useremail = $username. "@lhup.edu";
			$uniq_code = uniqid();
			
			//Email with verification code sent to email generated
			include_once 'mail.php';
			//if email cannot be sent 
			if(!$mail->Send()) {
				echo 'Failed to send a new verification email to '.$username.'';
			} 
			
			//SQL update user with new uniq_code and set user status to false
			$sql = "UPDATE users SET user_verif = '$uniq_code', user_status = false WHERE user_name = '$username'";
			$result = mysqli_query($con, $sql);
			if(!$result){
				echo '<h3>Something went wrong.</h3>';
			}
			else{
				echo '<h3>A new verification E-Mail message has been sent to '.$username.'</h3>';
			}
		}
	include_once 'footer.php';
}