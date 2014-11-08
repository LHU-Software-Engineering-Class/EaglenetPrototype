<?php
/*
File name: thread_create.php
Created by: AJ Radle
Created Date: 10/29/14
Last Modified by: David Hall
Last Modified: 10/29/2014
Version 1.0
*/

//create_topic.php
include 'connect.php';
include 'header.php';
include 'sidebar.php';
echo '<!-- Begin Content -->
	<div id="content">
	<div class="KonaBody">';

echo '<h2>Create a topic</h2>';
if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		$sql = "SELECT
					forum_id,
					forum_name,
					forum_description
				FROM
					forums";
		
		$result = mysqli_query($con,$sql);
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			if(mysqli_num_rows($result) == 0)
			{
				//there are no categories, so a topic can't be posted
				if($_SESSION['user_level'] == 1)
				{
					echo 'You have not created categories yet.';
				}
				else
				{
					echo 'Before you can post a topic, you must wait for an admin to create some categories.';
				}
			}
			else
			{
		
				echo '<form method="post" action="">
					Subject: <input type="text" name="thread_subject" /><br />
					Forum:'; 
				
				echo '<select name="thread_cat">';
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<option value="' . $row['forum_id'] . '">' . $row['forum_name'] . '</option>';
					}
				echo '</select><br />';	
					
				echo 'Message: <br /><textarea name="post_content" /></textarea><br /><br />
					<input type="submit" value="Create topic" />
				 </form>';
			}
		}
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysqli_query($con,$query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occured while creating your topic. Please try again later.';
		}
		else
		{
	
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
				echo 'An error occured while inserting your data. Please try again later.<br /><br />' . mysqli_error($con);
				$sql = "ROLLBACK;";
				$result = mysqli_query($con,$sql);
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				$topicid = mysqli_insert_id($con);
				$post_content = mysqli_real_escape_string($con,$_POST['post_content']);
				$user = $_SESSION['user_id'];
				
				$sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by, post_type) VALUES ('$post_content', NOW(), '$topicid', '$user', 1 )";
				$result = mysqli_query($con,$sql);
				
				if(!$result)
				{
					//something went wrong, display the error
					echo 'An error occured while inserting your post. Please try again later.<br /><br />' . mysql_error();
					echo 'Post data ' .$post_content.',NOW(),'.$topicid.',' .$user. ',1';
					
					$sql = "ROLLBACK;";
					$result = mysqli_query($con,$sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = mysqli_query($con,$sql);
					
					//after a lot of work, the query succeeded!
					echo 'You have succesfully created <a href="thread.php?id='. $topicid . '">your new topic</a>.';
				}
			}
		}
	}
}
echo '
</div>';

include 'footer.php';
?>
