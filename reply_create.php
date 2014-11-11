<?php
/*
File name: reply_create.php
Created by: David Hall
Created Date: 11/10/14
Last Modified by: David Hall
Last Modified: 11/11/2014 5:38PM
Version 2.0
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
	<div id="content2">
	<h2>Create a Reply</h2>
	<div>';
	$sql = "SELECT
				threads.thread_id,
				threads.thread_subject,
				posts.post_title
			FROM
				threads
			LEFT JOIN
				posts
			ON
				posts.post_topic = threads.thread_id
			WHERE
				post_id = ".mysqli_real_escape_string($con,$_GET['id']); 
	$result = mysqli_query($con,$sql);
	
	if(!$result){
		
	}
	else{
		$row = mysqli_fetch_array($result);
		if($_SERVER['REQUEST_METHOD'] != 'POST'){	
			echo '<table class="topic" border="1">
				<tr>
					<td colspan="2"><h2>Reply to post: '.$row['post_title'].'</h2>
						<form method="post" action="reply.php?id='.$row['thread_id'].'">
							<strong>Reply Title: </strong><input type="text" name="post_title" size="35"/><br/><br/>
							<strong>Reply message:</strong><br/><textarea name="post_content"></textarea><br /><br />
							<input type="hidden" name="post_type" value="3">
							<input type="submit" value="Submit Reply" />
						</form>
					</td>
				</tr>';
			echo '</table>';
		}
		
	}
	echo '
	</div>';

	include 'footer.php';
}
