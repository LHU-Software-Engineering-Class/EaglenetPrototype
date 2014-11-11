<?php
/*
File name: post_create.php
Created by: David Hall
Created Date: 11/10/14
Last Modified by: David Hall
Last Modified: 11/11/2014 5:00PM
Version 1.1
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
else
{
	include 'header.php';
	include 'sidebar.php';
	
	echo '<!-- Begin Content -->
	<div id="content">
	<h2>Create a new post</h2>
	<div>';
	
	$sql = "SELECT
				thread_id,
				thread_subject
			FROM
				threads
			WHERE
				thread_id = ".mysqli_real_escape_string($con,$_GET['id']); 
	$result = mysqli_query($con,$sql);
	
	if(!$result){
		echo'Error';
	}
	else{
		while($row = mysqli_fetch_assoc($result)){
			if($_SERVER['REQUEST_METHOD'] != 'POST'){	
				echo '<table class="topic" border="1">
					<tr>
						<td colspan="2"><h2>Post to: '.$row['thread_subject'].'</h2>
							<form method="post" action="reply.php?id='.$row['thread_id'].'">
								<strong>Post Title: </strong><input type="text" name="post_title" size="35"/><br/><br/>
								<strong>Post message:</strong><br/><textarea name="post_content"></textarea><br /><br />
								<input type="hidden" name="post_type" value="2">
								<input type="submit" value="Submit Post to: '.$row['thread_subject'].'" />
							</form>
						</td>
					</tr>';
				echo '</table>';
			}
		}
	}
	echo '
	</div>';
	include 'footer.php';
}
