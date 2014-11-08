<?php
/*
File name: forum_create.php
Created by: David Hall
Created Date: 10/25/2014
Last Modified by: David Hall
Last Modified Date: 10/25/2014
Version 3.0
*/
include 'connect.php';
// Access control test. Tests if session variables are set to valid values
if($_SESSION['signed_in'] == false | ($_SESSION['user_status'] != true & $_SESSION['user_level'] < 1 )){
	include 'header2.php';
	include 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.
	</div>';
	include 'footer2.php';
}
//If user is logged in, the user is activated and has access privileges to this page show the page
else {
include 'header.php';
include 'sidebar.php';

echo '<!-- Begin Content -->
	<div id="content">
	<div class="KonaBody">';
echo '<h2>Create a Forum</h2>';

//Display the form do nothing with data until user submits form
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	//select the forum categories and category ids
	$sql = "SELECT
				cat_id,
				cat_desc
			FROM
				forum_categories";
	$result = mysqli_query($con,$sql);
	//Forum name, forum category drop down box, forum description
	echo '<form method="post" action="">
		 Forum name: <input type="text" name="forum_name" />
		 Forum category: <select name="forum_cat">';
		while($row = mysqli_fetch_assoc($result)){
			echo '<option value="'. $row['cat_id'].'">' . $row['cat_desc'] . '</option>';
		}
		echo 'Forum description:<br /> <textarea name="forum_description" /></textarea><br /><br />
		<input type="submit" value="Add forum" />
	</form>';
}
//user has submitted the forum create form
else{
	//set values from form the mysqli_real_escape_strings so they can be put into the database
	$forum_name = mysqli_real_escape_string($con,$_POST['forum_name']);
	$forum_desc = mysqli_real_escape_string($con,$_POST['forum_description']);
	$forum_cat = mysqli_real_escape_string($con,$_POST['forum_cat']);
	
	//the form has been posted, now save it
	$sql = "INSERT INTO forums(forum_name, forum_description, forum_cat)VALUES('$forum_name', '$forum_desc','$forum_cat')";
	
	//error checking if the information was not entered
	$result = mysqli_query($con,$sql);
	if(!$result){
		//something went wrong, display the error
		echo 'Error' . mysql_error();
	}
	else{
		echo 'New category succesfully added.';
	}
}
echo '
</div>';
include 'footer.php';
}
