<?php
/*
//created by: Joe Taylor
//Version 1.0
//thread_edit.php
*/
include 'connect.php';
//Access control test. Tests is session variables are set to valid values
if($_SESSION['signed_in'] == false | ($_SESSION['user_status']!= true)){
include 'header2.php';
include 'sidefiller.php';
echo '<!-- Begin Content-->
<div id = "content2">
Sorry, you do not have sufficient rights to access this page.
</div>';
include 'footer2.php';
}
//If user is logged in, the user is activated and has access privileges to this page show the page
else{
include 'header2.php';
include 'sidefiller.php';
echo '<!-- Begin Content-->
<div id = "content2">
<div class = "KonaBody">';
//Display the form do nothing with data until user sunmits form
$threadId = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] != 'POST'){
$sql = "SELECT * FROM threads where threads.thread_id = ".mysqli_real_escape_string($con,$_GET['id'])." and
threads.thread_by = ".$_SESSION['user_id'];
$result = mysqli_query($con,&sql);
$row = mysqli_fetch_array($result);
$tBy = $row['thread_by'];
$tSub = $row['thread_subject'];
$tCat = $row['thread_cat'];
if($tBy != $_SESSION['user_id']){
echo'<h2>Sorry you are not permitted to edit this thread, it was not created by you</h2>';
}
else{
echo'<h2>Edit Thread</h2>
<table border = 1>
<tr>
<td>
<table>
<form method = "post">
<tr>
<td><strong>Current Thread Subject:</strong>'.$tSub.'</td>
</tr>
<tr>
<td><strong>Change subject to:</strong><input type = "text" name = "thread_subject" size = "20"></td>
</tr>
<tr>';
$sql = "SELECT forum_name FROM forums where forum_id = '$tCat'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
echo'<td><strong>Currently in forum:</strong>'.$row['forum_name'].'</td>
</tr>
<tr>';
$sql = "SELECT
forum_id,
forum_name,
forum_description
FROM
forums";
$result = mysqli_query($con,$sql);
echo'<td><strong>Change Forum to:</strong>
<select name = "thread_cat">';
while($row = mysqli_fetch_assoc($result))
{
if($row['forum_id'] == $tCat)
echo'<option selected value="'.$row['forum_id'].'">'.$row['forum_name'].'</option>';
else
echo '<option value = "'.$row['forum_id'].'">'.$row['forum_name'].'</option>';
}
echo'</select><br/>
</td>
</tr>
<tr>
<td align = "right"><input type = "submit"name="submit value"value = "Submit Change"></td>
</tr>
</form>
</table>
</td>
</tr>
</table>
</div>';
}
}
else{
$thread_subject = mysqli_real_escape_string($con, $_POST['thread_subject']);
$thread_cat = mysqli_real_escape_string($con, $_POST['thread_subject']);
$sql = "UPDATE threads set thread_subject = '$thread_subject', thread_cat = '$thread_cat' where thread_id = '$threadId'";
$result = mysql_query($con,$sql);
if(!$result)
{
//something went wrong, display error
echo 'An error occured while inserting your data. Please try again later.<br/><br/>'.mysqli_error($con);
$sql = "ROLLBACK;";
$result = mysqli_query($con,$sql);
}
else{
echo 'Thread name successfully changed to '.$thread_subject.'<br/>';
}
}
include 'footer.php';
}