<?php
/*
File name: reply.php
Created by: Rob Shelly
Created Date: 10/29/2014
Last Modified: 11/8/2014
Last Modified by: David Hall
Version 1.1
*/
include 'connect.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else{
	//a real user posted a real reply
	$sql = "INSERT INTO 
		posts(post_content,
			post_date,
			post_topic,
			post_by) 
		VALUES ('" . $_POST['reply-content'] . "',
			NOW(),
			" . mysqli_real_escape_string($con,$_GET['id']) . ",
			" . $_SESSION['user_id'] . ")";
	$result = mysqli_query($con,$sql);		
	if(!$result)
	{
		echo 'Your reply has not been saved, please try again later.';
	}
	else
	{
		echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
	}
}
echo '
</div>';