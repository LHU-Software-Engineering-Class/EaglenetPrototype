<?php
//thread.php
include 'connect.php';
include 'header.php';
include sidebar.php';
echo '<!--Begin Content-->
<div id="content">
<div class="KonaBody">';

$sql = "SELECT thread_id, thread subject, FROM threads WHERE threads.thread_id=".mysqli_real_escape_string($con,$_GET['id']);

$result=mysqli_query($con,$sql);

if(!result)
{
echo 'The topic could not be displayed, please try again later.';
}
else
{
if(mysqli_num_rows($result)==0)
{
echo 'This topic doesn't exist.';
}
else
{
while($row = mysqli_fetch_assoc($result))
{
//risplay post data
echo '<table class="topic" border="1">
<tr>
<th colspan="2">.$row['thread_subject'].'</th>
</tr>';

//fetch the posts from the database

$posts_sql = "SELECT POSTS.POST_TOPIC, POSTS.POST_CONTENT, POSTS.POST_DATE, POSTS.POST_BY, USERS.USER_ID, USERS.USER_NAME FROM POSTS LEFT JOIN USERS ON POSTS.POST_BY = USERS.USER_ID WHERE POSTS.POST_TOPIC=".mysqli_real_escape_string($con,$_GET['id']);

$posts_result = mysqli_query($con,$posts_sql);

if(!$posts_result){
echo '<tr><td> The posts could not be displayed, please try again later.</tr></td></table>';
}else{
while($posts_row = mysqli_fetch_assoc($posts_result){
echo '<tr class="topic-post">
<td class="user-post">'.$posts_row['user_name'].'<br />'.date('d-m-Y H:i', strtotime($posts_row['post_date'])).
'</td>
<td class="post-content">'.htmlentities(stripslashes($posts_row['post_content'])).'</td>
</tr>';
}
}

if(!$_SESSION['signed_in]){
echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
}else{
//show reply box
echo '<tr><td colspan="2"><h2>Reply:</h2><br />
<form method="post" action="reply.php?id='.$row[thread_id'].'">
<textarea name="reply-content"></textarea><br /><br />
<input type="submit" value="Submit Reply" />
</form></td></tr>';
}

//finish the fucking table
echo '</table>';
}
}
}
echo '</div>';

include 'footer.php';
?>