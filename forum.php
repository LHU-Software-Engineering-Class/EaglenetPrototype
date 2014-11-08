<?php
//forum.php
/*
Created by: Wesley Chubb
Created Date: 10/29/14
Last Modified: 10/29/2014
Version 1.1
*/

include 'connect.php';
if ($_SESSION['signed_in'] == false | $_SESSION['user_status'] != true)
{
	include 'header2.php';
	include 'sidefiller.php';

	echo '<--Begin Content-->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.';
	include 'footer2.php';
}
else{
	include 'header.php';
	include 'sidebar.php';
	echo '<!--Begin Content -->
	<div id="content">
	<div class="KonaBody">';
	//first select the forum based on $_GET['cat_id']

	$sql = "SELECT forum_id, forum_name, forum_description
			FROM forums
			WHERE forum_id=".mysqli_real_escape_string($con, $_GET['id']);

	$result=mysqli_query($con, $sql);

	if(!$result){
		echo 'The forum could not be displayed, please try again later.';
	}
	else{
		if (mysqli_num_rows($result) == 0){
			echo 'This forum does not exist.';
		}
		else{
			//display forum data
			while($row = mysqli_fetch_assoc($result)){
				echo '<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
				<thead>
					<tr align="center">
						<td class="thead">&nbsp;
						</td>
						<td class="thead" width="100%" align="left">Thread
						</td>
						<td class="thead">Last Post
						</td>
						<td class="thead">Posts
						</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="tcat" colspan="5">
							<a href="forum.php?id='.$row['forum_id'].'"><strong>'.$row['forum_name'].'</strong></a>
						</td>
					</tr>
				</tbody>';
			}
			//do a query for the threads
			$sql = "SELECT thread_id, thread_subject, thread_date, thread_cat
					FROM threads
					WHERE thread_cat = ".mysqli_real_escape_string($con, $_GET['id']);

			$result = mysqli_query($con, $sql);

			if (!$result)
			{
				echo 'The thread could not be displayed, please try again later.';
			}
			else
			{
				if (mysqli_num_rows($result) == 0)
				{
					echo 'There are no threads in this forum yet.';
				}
				else
				{
					while ($row = mysqli_fetch_assoc($result))
					{
						echo '<tbody style="">
							<tr align="center">
								<td class="alt2"><img src="images/forum_old.gif" alt="" border="0" id=forum_statusicon_256">
								</td>
								<td class="alt1Active" align="left" id="f256">
									<div>
										<a href="thread.php?id='.$row['thread_id'].'&page=0"><strong>'.$row['thread_subject'].'</strong></a>
										<a href="thread_edit.php?id='.$row['thread_id'].'"><img src="images/edit.png" alt=""></a>
									</div>
								</td>
								<td class = "alt2">
									<div class="smallfont" align="left">
										<div>
										<span style="white-space:nowrap">
											<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>asdfadsf</strong>
											</a>
										</span>
										</div>
										<div style="white-space:nowrap">
											by <a href="">dkh1058
											</a>
										</div>
										<div align="right" style="white-space:nowrap">';echo date('M-d-Y h:m', strtotime($row['thread_date']));
											echo'<span class="time">
											</span>
											<a href=""><img class="inlineimg" src="images/lastpost.gif" alt="Go to last post" border="0" title="Go to last post">
											</a>
										</div>
									</div>
								</td>
								<td class="alt2"><span style="float:right">
									<a href="thread_create.php"><img src="images/smallnewtopic.gif" alt="" border="0">
									</a>
									</span>14
								</td>
							</tr>
						</tbody>';
					}
				}
			}
		}
	}
	echo '
	</table>
	</div>';
	include 'footer.php';
}
