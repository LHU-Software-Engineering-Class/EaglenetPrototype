<?php
//thread.php
/*
//Created by: Dan Muthler
//Created Date: 10/29/2014
//Last Modified: 10/29/2014
//Version 1.0
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
else {
	include 'header.php';
	include 'sidebar.php';
	echo '<!-- Begin Content -->
		<div id="content">
		<div class="KonaBody">';
		
	$sql = "SELECT
				thread_id,
				thread_subject
			FROM
				threads
			WHERE
				threads.thread_id = " . mysqli_real_escape_string($con,$_GET['id']);
				
	$result = mysqli_query($con,$sql);

	if(!$result){
		echo 'The topic could not be displayed, please try again later.';
	}
	else{
		if(mysqli_num_rows($result) == 0){
			echo 'This topic doesn&prime;t exist.';
		}
		else{
			while($row = mysqli_fetch_assoc($result))
			{
				//display post data
				echo '<table class="topic" border="1">
						<tr>
							<th colspan="2">' . $row['thread_subject'] . '</th>
						</tr>';
			
				//fetch the posts from the database
				$posts_sql = "SELECT
							posts.post_topic,
							posts.post_content,
							posts.post_date,
							posts.post_by,
							users.user_id,
							users.user_name
						FROM
							posts
						LEFT JOIN
							users
						ON
							posts.post_by = users.user_id
						WHERE
							posts.post_topic = " . mysqli_real_escape_string($con,$_GET['id']);
							
				$posts_result = mysqli_query($con,$posts_sql);
				
				if(!$posts_result){
					echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
				}
				else{
					while($posts_row = mysqli_fetch_assoc($posts_result)){
						echo '<tr class="topic-post">
								<td class="user-post">' . $posts_row['user_name'] . '<br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</td>
								<td class="post-content">' . htmlentities(stripslashes($posts_row['post_content'])) . '</td>
						</tr>';
					}
				}

					//show reply box
					echo '<tr><td colspan="2"><h2>Reply:</h2><br />
						<form method="post" action="reply.php?id=' . $row['thread_id'] . '">
							<textarea name="reply-content"></textarea><br /><br />
							<input type="submit" value="Submit reply" />
						</form></td></tr>';
				
				//finish the table
				echo '</table>';
			}
		}
	}
	echo '</div>';
	include 'footer.php';
}