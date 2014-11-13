<?php
/*
File name: reply.php
Created by: Rob Shelly
Created Date: 10/29/2014
Last Modified: 11/10/2014
Last Modified by: David Hall
Version 1.1
*/

include 'connect.php';
include 'strip_html_tags.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else{
	$post_content = strip_html_tags($_POST['post_content']);
	$post_title = strip_html_tags($_POST['post_title']);
	$post_type = strip_html_tags($_POST['post_type']);
	
	//a real user posted a real reply
	$sql = "INSERT 
		INTO posts
		(post_content,
		post_title,
		post_type,
		post_date,
		post_topic,
		post_by
		)
		VALUES (
			'".mysqli_real_escape_string($con,$post_content)."',
			'".mysqli_real_escape_string($con,$post_title)."',
			'".mysqli_real_escape_string($con,$post_type)."',
			NOW(),
			".mysqli_real_escape_string($con,$_GET['id']).",
			".$_SESSION['user_id'].")";
	$result = mysqli_query($con,$sql);		
	if(!$result)
	{
		echo 'Your reply has not been saved, please try again later.';
		mysqli_error($con);
	}
	else
	{
		echo 'Your reply has been saved, 
		check out <a href="thread.php?id='.htmlentities($_GET['id']).'&page=1">the topic</a>.';
	}
}
echo '
</div>';