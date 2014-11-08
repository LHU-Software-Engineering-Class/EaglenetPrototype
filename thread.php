<?php
//thread.php
/*
//Created by: Dan Muthler
//Created Date: 10/29/2014
//Last Modified By: David Hall
//Last Modified Date: 11/8/2014 12:14AM
//Version 2.0
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
				threads.thread_id,
				threads.thread_subject,
				threads.thread_cat,
				forums.forum_name
			FROM
				threads
			LEFT JOIN
				forums
			ON
				threads.thread_cat= forums.forum_id
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
			while($row = mysqli_fetch_assoc($result)){
				echo'<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
					<thead>	
					<tr>
						<td class="tcat" colspan="5" >
							Forum: '.$row['forum_name'].'
						</td>
					</tr>
					<tr>
						<td class="tcat" colspan="5" style ="padding-left:1em">
							-Thread: '.$row['thread_subject'].'
						</td>
					</tr>
					</thead>
				</table>';
				
				$posts_sql = "SELECT
									posts.post_topic,
									posts.post_content,
									posts.post_date,
									posts.post_by,
									users.user_id,
									users.user_name,
									users.user_avatar,
									users.user_date,
									users.post_count,
									users.user_level
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
					$post_num = 1;
					while($posts_row = mysqli_fetch_assoc($posts_result)){
						echo'<div style="padding:0px 0px 6px 0px">
						<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" >
						<tr>
							<td class="thead" style ="padding-left:1em">
								<div style="float:left">
									&nbsp;
									<strong>-Post #'.$post_num.'</strong>&nbsp;
								</div>
								<div style="float:right">
										Posted: ' . date('m-d-Y h:i A', strtotime($posts_row['post_date'])) . '
								</div>
							</td>
						</tr>
						<tr>
							<td class="tcat" style="padding:0px">
								<!-- user info -->
								<table cellpadding="0" cellspacing="6" border="0" width="100%">
								<tr>
									<td class="tcat"><img src="images/'.$posts_row['user_avatar'].'.png" width="90" height="90" alt="Users Avatar" border="0" /></td>
									<td nowrap="nowrap">
										<div>
											User:' . $posts_row['user_name'] . ' <br/>';
											if ($posts_row['user_level'] ==0)
												echo 'User Level: Standard User';
											elseif ($posts_row['user_level'] ==1)
												echo 'User Level: Moderator';
											elseif ($posts_row['user_level'] ==2)
												echo 'User Level: Administrator';
										echo'</div>
									</td>
									<td width="100%">&nbsp;</td>
									<td valign="top" nowrap="nowrap">
										<div class="smallfont">
											<div>Join Date: '. date('m-d-Y', strtotime($posts_row['user_date'])) . '</div>
											<div>
												Posts: ' . $posts_row['post_count'] . '
											</div>
											<div>    
											</div>
										</div>
									</td>
								</tr>
								</table>
								<!-- / user info -->
							</td>
						</tr>
						<tr>
							<td>
							<!-- message, attachments, sig -->
								<!-- message -->
								<div id = "post">
									' .htmlentities(stripslashes($posts_row['post_content'])) . '
								</div>
							</td>
						</tr>
						</table>
						</div>';
						$post_num = $post_num+1;
					}
				}
					//show reply box
				echo '<table class="topic" border="1">
					<tr><td colspan="2"><h2>Post to: '.$row['thread_subject'].'</h2><br />
						<form method="post" action="reply.php?id=' . $row['thread_id'] . '">
							<textarea name="reply-content"></textarea><br /><br />
							<input type="submit" value="Submit reply" />
						</form></td></tr>';
				echo '</table>';
			}
		}
	}
	echo '</div>';
	include 'footer.php';
}