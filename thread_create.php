<?php
/*
File name: thread_create.php
Created by: AJ Radle
Created Date: 10/29/14
Last Modified by: David Hall
Last Modified: 11/11/2014
Version 3.0
*/

include 'connect.php';

if($_SESSION['signed_in'] == false)
{
	include 'header2.php';
	include 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">//the user is not signed in
	Sorry, you have to be <a href="index.php">signed in</a> to create a topic.';
	include 'footer2.php';
}
else
{ 
	/**
	 * Remove HTML tags, including invisible text such as style and
	 * script code, and embedded objects.  Add line breaks around
	 * block-level tags to prevent word joining after tag removal.
	 */
	function strip_html_tags($text)
	{
		$text = preg_replace(
			array(
			  // Remove invisible content
				'@<head[^>]*?>.*?</head>@siu',
				'@<a[^>]*?>.*?</a>@siu',
				'@<style[^>]*?>.*?</style>@siu',
				'@<script[^>]*?.*?</script>@siu',
				'@<object[^>]*?.*?</object>@siu',
				'@<embed[^>]*?.*?</embed>@siu',
				'@<applet[^>]*?.*?</applet>@siu',
				'@<noframes[^>]*?.*?</noframes>@siu',
				'@<noscript[^>]*?.*?</noscript>@siu',
				'@<noembed[^>]*?.*?</noembed>@siu',
			  // Add line breaks before and after blocks
				'@</?((address)|(blockquote)|(center)|(del))@iu',
				'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
				'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
				'@</?((table)|(th)|(td)|(caption))@iu',
				'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
				'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
				'@</?((frameset)|(frame)|(iframe))@iu',
			),
			array(
				' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
				"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
				"\n\$0", "\n\$0",
			),
			$text );
		return strip_tags( $text );
	}
	include 'header.php';
	include 'sidebar.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	<div>
	<h2>Create a thread</h2><hr>';
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST'){	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		$sql = "SELECT
					forum_id,
					forum_name,
					forum_description
				FROM
					forums";
		
		$result = mysqli_query($con,$sql);
		
		if(!$result){
			echo 'Error while selecting from database. Please try again later.';
		}
		else{
			echo '<form method="post" action="">
				<strong>Thread topic: </strong><input type="text" name="thread_subject" /><br />
				<strong>In forum: </strong>'; 
			echo '<select name="thread_cat">';
				while($row = mysqli_fetch_assoc($result))
				{
					echo '<option value="' . $row['forum_id'] . '">' . $row['forum_name'] . '</option>';
				}
			echo '</select><br /><br />';	
			echo '<h2>First post in this thread</h2>
				<strong>Post title: </strong><input type="text" name="post_title" /><br />
				<strong>Message: </strong><br /><textarea name="post_content" /></textarea><br /><br />
				<input type="hidden" name="post_type" value="1">
				<input type="submit" value="Create thread" />
				</form>';
		}
	}
	else{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysqli_query($con,$query);
		
		if(!$result){
			echo 'An error occured while creating your topic. Please try again later.';
		}
		else{
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			
			$thread_subject = mysqli_real_escape_string($con,$_POST['thread_subject']);
			$thread_cat = mysqli_real_escape_string($con,$_POST['thread_cat']);
			$user = $_SESSION['user_id'];
			
			$sql = "INSERT INTO threads(thread_subject, thread_date,thread_cat, thread_by)VALUES ('$thread_subject', NOW(),'$thread_cat','$user')";
					 
			$result = mysqli_query($con,$sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'An error occured while inserting your data. Please try again later.';
				$sql = "ROLLBACK;";
				$result = mysqli_query($con,$sql);
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				$topicid = mysqli_insert_id($con);
				
				//get post content strip it of tags and convert it to send to SQL
				$content = $_POST['post_content'];
				$content = strip_html_tags($content);
				$content = mysqli_real_escape_string($con,$content);
				
				//userid of current signed in user
				$user = $_SESSION['user_id'];
				
				//post title strip it of tags and convert it to send to SQL
				$title = $_POST['post_title'];
				$title = strip_html_tags($title);
				$title = mysqli_real_escape_string($con,$title);
				
				//since this is the initial post in the thread it is set to
				$type = mysqli_real_escape_string($con,$_POST['post_type']);
				
				$sql = "INSERT INTO posts(post_title, post_content, post_date, post_topic, post_by, post_type) VALUES ('$title','$content', NOW(), '$topicid', '$user', '$type')";
				$result = mysqli_query($con,$sql);
				
				if(!$result)
				{
					echo 'An error occured while inserting your post. Please try again later.<br /><br />' . mysql_error();
					$sql = "ROLLBACK;";
					$result = mysqli_query($con,$sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = mysqli_query($con,$sql);
					echo 'You have succesfully created <a href="thread.php?id='.$topicid .'&page=1">your new thread</a>.';
				}
			}
		}
	}
echo '
</div>';
include 'footer.php';
}