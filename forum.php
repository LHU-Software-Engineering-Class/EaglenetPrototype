<?php
/*
File name: forum.php
Created by: Wesley Chubb
Created Date: 10/29/14
Last Modified By: David Hall
Last Modified Date: 11/11/2014 5:30 PM
Version 3.1
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
	<div>';
	//first select the forum based on $_GET['cat_id']

	$sql = "SELECT a.forum_id, a.forum_name,a.forum_description, b.cat_desc
			FROM forums as a
			LEFT JOIN forum_categories as b 
			ON a.forum_cat = b.cat_id
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
				echo '<table class="tborder" cellpadding="6" cellspacing="0" border="0" width="100%" align="center">
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
					<td class="tcat" colspan="5">
						<strong>Forum: '.$row['forum_name'].'</strong></a>
						<a style="float:right" class="button" href="thread_create.php">CREATE A NEW THREAD</a>
					</td>
				</tr>
				<tbody>
					<tr align="center">
						<td class="thead">&nbsp;
						</td>
						<td class="thead" width="85%" align="left">Thread Topic
						</td>
						<td class="thead" align="left">Latest Post
						</td>
						<td class="thead">Posts
						</td>
					</tr>
				</tbody>';
			}
				// How many adjacent pages should be shown on each side?
				$adjacents = 3;
				/* 
				   First get total number of rows in data table. 
				   If you have a WHERE clause in your query, make sure you mirror it here.
				*/
				$query = "SELECT COUNT(*) as num FROM threads WHERE
					thread_cat = " . mysqli_real_escape_string($con,$_GET['id']);
					
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
				//do a query for the threads
				$sql = "SELECT 
							threads.thread_id,
							threads.thread_subject,
							threads.post_counter,
							posts.post_content,
							posts.post_date,
							posts.post_by,
							posts.post_title,
							users.user_name,
							users.user_avatar
						FROM 
							threads
						LEFT JOIN 
							posts
						ON
							threads.thread_id = posts.post_topic
						JOIN
							users
						ON
							users.user_id = posts.post_by
						WHERE 
							threads.thread_cat = ".mysqli_real_escape_string($con, $_GET['id'])." and posts.post_type = 1 and post_status !=0
						LIMIT 
							$start,$limit";
				$result = mysqli_query($con, $sql);
				
				if (!$result)
				{
					echo 'The thread could not be displayed, please try again later.';
				}
				
				elseif (mysqli_num_rows($result) == 0)
				{
					echo 'There are no threads in this forum yet.';
				}
				
				else{
					while ($row = mysqli_fetch_assoc($result)){
						echo '
							<tbody style="">
							<tr class="border_bottom" align="center">
								<td class="tcat"><img src="images/forum_old.gif" alt="" border="0">
								</td>
								<td class="tcat" align="left">
									<div>
										<a href="thread.php?id='.$row['thread_id'].'&page=1"><strong>'.$row['thread_subject'].'</strong></a>
										<a style="float:right" href="thread_edit.php?id='.$row['thread_id'].'">Edit:<img style="float:right" src="images/edit.png" alt=""></a>
										
									</div>
								</td><td class = "tcat">
									<div align="left">
										<div>
										<span style="white-space:nowrap">
											<a href="" style="white-space:nowrap" title="Go to latest post">
											<strong>TODO</strong>
											</a>
										</span>
										</div>
										<div style="white-space:nowrap">
											By: TODO
										</div>
										<div align="right" style="white-space:nowrap"> Date: TODO
										</div>
									</div>
								</td>
								<td class="tcat" width = "200">
									<span style="float:center"> 
									'.$row['post_counter'].'
									</span>
								</td>
							</tr>
							
							<tr class="border">
								<td class="thead" colspan="5">
									<strong>Created By: '.$row['user_name'].' </strong><br />
									<strong>Title: '.$row['post_title'].'</strong><br />
								</td>
							</tr>
							
							<tr>
								<td colspan="5" style ="padding-left:3em">
									<div id = "post">
									'.htmlentities(stripslashes($row['post_content'])).'
									</div>
								</td>
							</tr>
						</tbody>';
					}
				}
				echo'</table>';

			$pagination = "";
			if($lastpage > 1)
			{	
				$pagination .= "<div class=\"pagination\">";
				//previous button
				if ($page > 1) 
					$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$prev\">previous </a>";
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
							$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$counter\">$counter</a>";					
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
								$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$counter\">$counter</a>";					
						}
						$pagination.= "...";
						$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$lastpage\">$lastpage</a>";		
					}
					//in middle; hide some front and some back
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=1\">1 </a>";
						$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=2\">2 </a>";
						$pagination.= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$counter\">$counter</a>";					
						}
						$pagination.= "...";
						$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$lastpage\">$lastpage</a>";		
					}
					//close to end; only hide early pages
					else
					{
						$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=1\">1 </a>";
						$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=2\">2 </a>";
						$pagination.= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter </span>";
							else
								$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$counter\">$counter</a>";					
						}
					}
				}
				//next button
				if ($page < $counter - 1) 
					$pagination.= "<a href=\"forum.php?id=".$_GET['id']."&page=$next\"> next </a>";
				else
					$pagination.= "<span class=\"disabled\"> next </span>";
				$pagination.= "</div>\n";		
			}
		}
	}

echo '<a style="float:right" class="button" href="thread_create.php">CREATE A NEW THREAD</a>';
}
?>
<?=$pagination; include 'footer.php';?>