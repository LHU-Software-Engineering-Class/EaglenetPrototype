<?php
/*
File name: thread.php
Created by: Dan Muthler
Created Date: 10/29/2014
Last Modified By: David Hall
Last Modified Date: 11/11/2014 5:36PM
Version 4.0
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
		<div>';
		
	$sql = "SELECT
				threads.thread_id,
				threads.thread_subject,
				threads.thread_cat,
				forums.forum_name,
				forums.forum_id
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
					<tr align ="right">
						<td class="thead" colspan="5">
							Welcome '.$_SESSION['user_name'].' Not you? <a href="signout.php">Sign out</a>
						</td>
					</tr>
					<tr align ="right">
						<td colspan="5">
							Last Login: '.date('m-d-Y h:i A', strtotime($_SESSION['user_last_login'])).'
						</td>
					</tr>
					
					<tr>
						<td class="tcat" colspan="5" >
							Forum: <a href="forum.php?id='.$row['forum_id'].'&page=1">'.$row['forum_name'].'</a>
						</td>
					</tr>
					<tr>
						<td class="tcat" colspan="5" style ="padding-left:1em">
							-Thread: '.$row['thread_subject'] .'
							 <a style="float:right" class="button" href="post_create.php?id='.$_GET['id'].'">CREATE A POST</a>
						</td>
					</tr>
				</table>';
				
				// How many adjacent pages should be shown on each side?
				$adjacents = 3;
				/* 
				   First get total number of rows in data table. 
				   If you have a WHERE clause in your query, make sure you mirror it here.
				*/
				$query = "SELECT COUNT(*) as num FROM posts WHERE
					post_topic = " . mysqli_real_escape_string($con,$_GET['id'])." and post_status !=0 and (post_type = 1 or post_type = 2)";
					
				$num_result = mysqli_query($con,$query);
				$total_pages = mysqli_fetch_array($num_result);
				$total_pages = $total_pages['num'];
				
				/* Setup vars for query. */
				$targetpage = "threadx.php";
				$limit = 5;								 //how many items to show per page
				$page = $_GET['page'];
				if($page) 
					$start = ($page - 1) * $limit; 			//first item to display on this page
				else
					$start = 0;								//if no page var is given, set start to 0
				
				/* Setup page vars for display. */
				if ($page == 0) $page = 1;					//if no page var is given, default to 1.
				$prev = $page - 1;							//previous page is page - 1
				$next = $page + 1;							//next page is page + 1
				$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
				$lpm1 = $lastpage - 1;						//last page minus 1
				
				/* 
					Now we apply our rules and draw the pagination object. 
					We're actually saving the code to a variable in case we want to draw it more than once.
				*/
				
				$posts_sql = "SELECT
									posts.post_id,
									posts.post_topic,
									posts.post_content,
									posts.post_date,
									posts.post_by,
									posts.post_title,
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
									posts.post_topic = " . mysqli_real_escape_string($con,$_GET['id'])." and post_status !=0 and (post_type = 1 or post_type = 2)
								LIMIT 
									$start,$limit";
				$posts_result = mysqli_query($con,$posts_sql);
				if(!$posts_result){
					echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
				}
				else{
					while($posts_row = mysqli_fetch_assoc($posts_result)){
						echo'<div style="padding:0px 0px 6px 0px">
						<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" >
						<tr>
							<td class="thead" style ="padding-left:1em">
								<div style="float:left">
									&nbsp;
									<strong>-Post: </strong><a href="post.php?id= '.$posts_row['post_id'].'&page=1">'.$posts_row['post_title'].'</a>&nbsp;
								</div>
								<div style="float:right">
										Posted: ' . date('m-d-Y h:i A', strtotime($posts_row['post_date'])) . '
								</div>
							</td>
						</tr>
						<tr>
							<td class="tcat" style="padding:0px">
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
											<a style="float:right" class="button" href="reply_create.php?id='.$posts_row['post_id'].'">REPLY</a>
											</div>
										</div>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<div id = "post">
									'.htmlentities(stripslashes($posts_row['post_content'])).'
								</div>
							</td>
						</tr>
						</table>
						</div>';
					}
				}
			}
			
			$pagination = "";
			if($lastpage > 1)
			{	
				$pagination .= "<div class=\"pagination\">";
				//previous button
				if ($page > 1) 
					$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$prev\">previous </a>";
				else
					$pagination.= "<span class=\"disabled\">previous </span>";	
				
				//pages	
				if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
				{	
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$counter\">$counter</a>";					
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
				{
					//close to beginning; only hide later pages
					if($page < 1 + ($adjacents * 2))		
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$counter\">$counter</a>";					
						}
						$pagination.= "...";
						$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$lastpage\">$lastpage</a>";		
					}
					//in middle; hide some front and some back
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=1\">1 </a>";
						$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=2\">2 </a>";
						$pagination.= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$counter\">$counter</a>";					
						}
						$pagination.= "...";
						$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$lastpage\">$lastpage</a>";		
					}
					//close to end; only hide early pages
					else
					{
						$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=1\">1 </a>";
						$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=2\">2 </a>";
						$pagination.= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter </span>";
							else
								$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$counter\">$counter</a>";					
						}
					}
				}
				
				//next button
				if ($page < $counter - 1) 
					$pagination.= "<a href=\"thread.php?id=".$_GET['id']."&page=$next\"> next </a>";
				else
					$pagination.= "<span class=\"disabled\"> next </span>";
				$pagination.= "</div>\n";		
			}
		}
	}
}
echo' <a style="float:right" class="button" href="post_create.php?id='.$_GET['id'].'">CREATE A POST</a>';
?>



<?=$pagination; include 'footer.php';?>

