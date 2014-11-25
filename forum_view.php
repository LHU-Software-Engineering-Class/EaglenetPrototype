<?php
/*
File name: forum_view.php
Created by: Wesley Chubb
Created Date: 10/29/2014
Last Modified by: Wesley Chubb
Last Modified Date: 11/25/2014 2:51 AM
Version 3.1
*/

include 'connect.php';

/*checks to see if user is signed in*/
if($_SESSION['signed_in'] == false | $_SESSION['user_status'] != true){
	include 'header2.php';
	include 'sidefiller.php';
	echo '<!-- Begin Content -->
	<div id="content2">
	Sorry, you do not have sufficient rights to access this page.';
	include 'footer2.php';
}

/* This else statement displays accordingly if the user is logged in*/
else {
include 'header.php';
include 'sidebar.php';
echo '<!-- Begin Content -->
<div id="content">
<div>
<table class="tborder" cellpadding="6" cellspacing="0" border="0" width="100%" align="center">
	<tr align ="right">
		<td class="thead" colspan="5">
			Welcome '.$_SESSION['user_name'].' Not you? <a href="signout.php">Sign out</a>
		</td>
	</tr>
	<tr align ="right">
		<td colspan="5">
			Last Login: '.date('m-d-Y h:i A', strtotime($_SESSION['user_last_login'])).'
		</td>
	</tr>';
	
/*for loop queries from database to display information appropriately based on the thread's category*/
for($cat = 1; $cat <20; $cat++){
	$sql = "SELECT
			forum_id,
			forum_name,
			forum_description,
			thread_counter
		FROM
			forums
		WHERE
			forum_cat = $cat";
	$result = mysqli_query($con,$sql);
	
	/*checks if the category is set to 1*/
	if ($cat == 1){
		$inner_sql ="SELECT cat_desc FROM forum_categories WHERE cat_id = $cat";
		$inner_result = mysqli_query($con,$inner_sql);
		while($row = mysqli_fetch_assoc($inner_result)){
			echo'<tbody>
				<tr>
					<td class="tcat" colspan="5">
						Forum Category: '.$row['cat_desc'].'
					</td>
				</tr>
			</tbody>';
		}
		echo'<tr align="center">
			<td class="thead">&nbsp;</td>
			<td class="thead" width="100%" align="left">Forum Name</td>
			<td class="thead">Last Post</td>
			<td class="thead">Threads</td>
			<td class="thead">Posts</td>  
		</tr>';
		
		/*queries the database for post count*/
		while($row = mysqli_fetch_assoc($result)){
				$sql_count = "SELECT IFNULL (SUM(post_counter),0) as total
				FROM
					threads
				WHERE
					".$row['forum_id']." = thread_cat";
				$post_count = mysqli_query($con,$sql_count);
				
			/*displays page formatting and information including total post and thread counts*/
			echo '<tbody>
				<tr class="border_bottom" align="center">
					<td><img src="images/forum_old.gif" alt=""></td>
					<td align="left">
						<div>
							<a href="forum.php?id='.$row['forum_id'].'&page=1"><strong>'. $row['forum_name'] .'</strong></a>
						</div>
					</td>
					<td>
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>TODO Last post title TODO</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								By: TODO
							</div>
							<div align="right" style="white-space:nowrap">
								<span>Date: TODO</span>
							</div>
						</div>
					</td>
					<td> '.$row['thread_counter'].'  </td>';
					
					/*gets and shows the total post count*/
					while ($row_count = mysqli_fetch_assoc($post_count)){
						echo '<td> '.$row_count['total'].' </td>';
					}
				echo '</tr>
			</tbody>';
		}
	}
	/*checks if the category is set to 2*/
	elseif ($cat == 2){
		$inner_sql ="SELECT cat_desc FROM forum_categories WHERE cat_id = $cat";
		$inner_result = mysqli_query($con,$inner_sql);
		while($row = mysqli_fetch_assoc($inner_result)){
			echo'<tbody>
				<tr>
					<td class="tcat" colspan="5">
						Forum Category: '.$row['cat_desc'].'
					</td>
				</tr>
			</tbody>';
		}
		echo'<tr align="center">
			<td class="thead">&nbsp;</td>
			<td class="thead" width="100%" align="left">Forum Name</td>
			<td class="thead">Last Post</td>
			<td class="thead">Threads</td>
			<td class="thead">Posts</td>  
		</tr>';
		
		/*queries the database for post count*/
		while($row = mysqli_fetch_assoc($result)){
				$sql_count = "SELECT IFNULL (SUM(post_counter),0) as total
				FROM
					threads
				WHERE
					".$row['forum_id']." = thread_cat";
				$post_count = mysqli_query($con,$sql_count);
			
			/*displays page formatting and information including total post and thread counts*/
			echo '<tbody>
				<tr class="border_bottom" align="center">
					<td><img src="images/forum_old.gif" alt=""></td>
					<td align="left">
						<div>
							<a href="forum.php?id='.$row['forum_id'].'&page=1"><strong>'. $row['forum_name'] .'</strong></a>
						</div>
					</td>
					<td>
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>TODO Last post title TODO</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								By: TODO
							</div>
							<div align="right" style="white-space:nowrap">
								<span>Date: TODO</span>
							</div>
						</div>
					</td>
					<td> '.$row['thread_counter'].'  </td>';
					
					/*gets and shows the total post count*/
					while ($row_count = mysqli_fetch_assoc($post_count)){
						echo '<td> '.$row_count['total'].' </td>';
					}
				echo '</tr>
			</tbody>';
		}
	}
	
	/*checks if the category is set to 3*/
	elseif ($cat == 3){
		$inner_sql ="SELECT cat_desc FROM forum_categories WHERE cat_id = $cat";
		$inner_result = mysqli_query($con,$inner_sql);
		while($row = mysqli_fetch_assoc($inner_result)){
			echo'<tbody>
				<tr>
					<td class="tcat" colspan="5">
						Forum Category: '.$row['cat_desc'].'
					</td>
				</tr>
			</tbody>';
		}
		echo'<tr align="center">
			<td class="thead">&nbsp;</td>
			<td class="thead" width="100%" align="left">Forum Name</td>
			<td class="thead">Last Post</td>
			<td class="thead">Threads</td>
			<td class="thead">Posts</td>  
		</tr>';
		
		/*queries the database for post count*/
		while($row = mysqli_fetch_assoc($result)){
				$sql_count = "SELECT IFNULL (SUM(post_counter),0) as total
				FROM
					threads
				WHERE
					".$row['forum_id']." = thread_cat";
				$post_count = mysqli_query($con,$sql_count);
			
			/*displays page formatting and information including total post and thread counts*/
			echo '<tbody>
				<tr class="border_bottom" align="center">
					<td><img src="images/forum_old.gif" alt=""></td>
					<td align="left">
						<div>
							<a href="forum.php?id='.$row['forum_id'].'&page=1"><strong>'. $row['forum_name'] .'</strong></a>
						</div>
					</td>
					<td>
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>TODO Last post title TODO</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								By: TODO
							</div>
							<div align="right" style="white-space:nowrap">
								<span>Date: TODO</span>
							</div>
						</div>
					</td>
					<td> '.$row['thread_counter'].'  </td>';
					
					/*gets and shows the total post count*/
					while ($row_count = mysqli_fetch_assoc($post_count)){
						echo '<td> '.$row_count['total'].' </td>';
					}
				echo '</tr>
			</tbody>';
		}
	}
	
	/*checks if the category is set to 4*/
	elseif ($cat == 4){
		$inner_sql ="SELECT cat_desc FROM forum_categories WHERE cat_id = $cat";
		$inner_result = mysqli_query($con,$inner_sql);
		while($row = mysqli_fetch_assoc($inner_result)){
			echo'<tbody>
				<tr>
					<td class="tcat" colspan="5">
						Forum Category: '.$row['cat_desc'].'
					</td>
				</tr>
			</tbody>';
		}
		echo'<tr align="center">
			<td class="thead">&nbsp;</td>
			<td class="thead" width="100%" align="left">Forum Name</td>
			<td class="thead">Last Post</td>
			<td class="thead">Threads</td>
			<td class="thead">Posts</td>  
		</tr>';
		
		/*queries the database for post count*/
		while($row = mysqli_fetch_assoc($result)){
				$sql_count = "SELECT IFNULL (SUM(post_counter),0) as total
				FROM
					threads
				WHERE
					".$row['forum_id']." = thread_cat";
				$post_count = mysqli_query($con,$sql_count);
			
			/*displays page formatting and information including total post and thread counts*/
			echo '<tbody>
				<tr class="border_bottom" align="center">
					<td><img src="images/forum_old.gif" alt=""></td>
					<td align="left">
						<div>
							<a href="forum.php?id='.$row['forum_id'].'&page=1"><strong>'. $row['forum_name'] .'</strong></a>
						</div>
					</td>
					<td>
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>TODO Last post title TODO</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								By: TODO
							</div>
							<div align="right" style="white-space:nowrap">
								<span>Date: TODO</span>
							</div>
						</div>
					</td>
					<td> '.$row['thread_counter'].'  </td>';
					
					/*gets and shows the total post count*/
					while ($row_count = mysqli_fetch_assoc($post_count)){
						echo '<td> '.$row_count['total'].' </td>';
					}
				echo '</tr>
			</tbody>';
		}
	}
	
	/*checks if the category is set to 5*/
	elseif ($cat == 5){
		$inner_sql ="SELECT cat_desc FROM forum_categories WHERE cat_id = $cat";
		$inner_result = mysqli_query($con,$inner_sql);
		while($row = mysqli_fetch_assoc($inner_result)){
			echo'<tbody>
				<tr>
					<td class="tcat" colspan="5">
						Forum Category: '.$row['cat_desc'].'
					</td>
				</tr>
			</tbody>';
		}
		echo'<tr align="center">
			<td class="thead">&nbsp;</td>
			<td class="thead" width="100%" align="left">Forum Name</td>
			<td class="thead">Last Post</td>
			<td class="thead">Threads</td>
			<td class="thead">Posts</td>  
		</tr>';
		
		/*queries the database for post count*/
		while($row = mysqli_fetch_assoc($result)){
				$sql_count = "SELECT IFNULL (SUM(post_counter),0) as total
				FROM
					threads
				WHERE
					".$row['forum_id']." = thread_cat";
				$post_count = mysqli_query($con,$sql_count);
			
			/*displays page formatting and information including total post and thread counts*/
			echo '<tbody>
				<tr class="border_bottom" align="center">
					<td><img src="images/forum_old.gif" alt=""></td>
					<td align="left">
						<div>
							<a href="forum.php?id='.$row['forum_id'].'&page=1"><strong>'. $row['forum_name'] .'</strong></a>
						</div>
					</td>
					<td>
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>TODO Last post title TODO</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								By: TODO
							</div>
							<div align="right" style="white-space:nowrap">
								<span>Date: TODO</span>
							</div>
						</div>
					</td>
					<td> '.$row['thread_counter'].'  </td>';
					
					/*gets and shows the total post count*/
					while ($row_count = mysqli_fetch_assoc($post_count)){
						echo '<td> '.$row_count['total'].' </td>';
					}
				echo '</tr>
			</tbody>';
		}
	}
	
	/*checks if the category is set to 6*/
	elseif ($cat == 6){
		$inner_sql ="SELECT cat_desc FROM forum_categories WHERE cat_id = $cat";
		$inner_result = mysqli_query($con,$inner_sql);
		while($row = mysqli_fetch_assoc($inner_result)){
			echo'<tbody>
				<tr>
					<td class="tcat" colspan="5">
						Forum Category: '.$row['cat_desc'].'
					</td>
				</tr>
			</tbody>';
		}
		echo'<tr align="center">
			<td class="thead">&nbsp;</td>
			<td class="thead" width="100%" align="left">Forum Name</td>
			<td class="thead">Last Post</td>
			<td class="thead">Threads</td>
			<td class="thead">Posts</td>  
		</tr>';
		
		/*queries the database for post count*/
		while($row = mysqli_fetch_assoc($result)){
				$sql_count = "SELECT IFNULL (SUM(post_counter),0) as total
				FROM
					threads
				WHERE
					".$row['forum_id']." = thread_cat";
				$post_count = mysqli_query($con,$sql_count);
			
			/*displays page formatting and information including total post and thread counts*/	
			echo '<tbody>
				<tr class="border_bottom" align="center">
					<td><img src="images/forum_old.gif" alt=""></td>
					<td align="left">
						<div>
							<a href="forum.php?id='.$row['forum_id'].'&page=1"><strong>'. $row['forum_name'] .'</strong></a>
						</div>
					</td>
					<td>
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>TODO Last post title TODO</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								By: TODO
							</div>
							<div align="right" style="white-space:nowrap">
								<span>Date: TODO</span>
							</div>
						</div>
					</td>
					<td> '.$row['thread_counter'].'  </td>';
					
					/*gets and shows the total post count*/
					while ($row_count = mysqli_fetch_assoc($post_count)){
						echo '<td> '.$row_count['total'].' </td>';
					}
				echo '</tr>
			</tbody>';
		}
	}
	
	/*checks if the category is set to 7*/
	elseif ($cat == 7){
		$inner_sql ="SELECT cat_desc FROM forum_categories WHERE cat_id = $cat";
		$inner_result = mysqli_query($con,$inner_sql);
		while($row = mysqli_fetch_assoc($inner_result)){
			echo'<tbody>
				<tr>
					<td class="tcat" colspan="5">
						Forum Category: '.$row['cat_desc'].'
					</td>
				</tr>
			</tbody>';
		}
		echo'<tr align="center">
			<td class="thead">&nbsp;</td>
			<td class="thead" width="100%" align="left">Forum Name</td>
			<td class="thead">Last Post</td>
			<td class="thead">Threads</td>
			<td class="thead">Posts</td>  
		</tr>';
		
		/*queries the database for post count*/
		while($row = mysqli_fetch_assoc($result)){
				$sql_count = "SELECT IFNULL (SUM(post_counter),0) as total
				FROM
					threads
				WHERE
					".$row['forum_id']." = thread_cat";
				$post_count = mysqli_query($con,$sql_count);
			
			/*displays page formatting and information including total post and thread counts*/
			echo '<tbody>
				<tr class="border_bottom" align="center">
					<td><img src="images/forum_old.gif" alt=""></td>
					<td align="left">
						<div>
							<a href="forum.php?id='.$row['forum_id'].'&page=1"><strong>'. $row['forum_name'] .'</strong></a>
						</div>
					</td>
					<td>
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>TODO Last post title TODO</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								By: TODO
							</div>
							<div align="right" style="white-space:nowrap">
								<span>Date: TODO</span>
							</div>
						</div>
					</td>
					<td> '.$row['thread_counter'].'  </td>';
					
					/*gets and shows the total post count*/
					while ($row_count = mysqli_fetch_assoc($post_count)){
						echo '<td> '.$row_count['total'].' </td>';
					}
				echo '</tr>
			</tbody>';
		}
	}
	
	/*checks if the category is set to 8*/
	elseif ($cat == 8){
		$inner_sql ="SELECT cat_desc FROM forum_categories WHERE cat_id = $cat";
		$inner_result = mysqli_query($con,$inner_sql);
		while($row = mysqli_fetch_assoc($inner_result)){
			echo'<tbody>
				<tr>
					<td class="tcat" colspan="5">
						Forum Category: '.$row['cat_desc'].'
					</td>
				</tr>
			</tbody>';
		}
		echo'<tr align="center">
			<td class="thead">&nbsp;</td>
			<td class="thead" width="100%" align="left">Forum Name</td>
			<td class="thead">Last Post</td>
			<td class="thead">Threads</td>
			<td class="thead">Posts</td>  
		</tr>';
		
		/*queries the database for post count*/
		while($row = mysqli_fetch_assoc($result)){
				$sql_count = "SELECT IFNULL (SUM(post_counter),0) as total
				FROM
					threads
				WHERE
					".$row['forum_id']." = thread_cat";
				$post_count = mysqli_query($con,$sql_count);
			
			/*displays page formatting and information including total post and thread counts*/
			echo '<tbody>
				<tr class="border_bottom" align="center">
					<td><img src="images/forum_old.gif" alt=""></td>
					<td align="left">
						<div>
							<a href="forum.php?id='.$row['forum_id'].'&page=1"><strong>'. $row['forum_name'] .'</strong></a>
						</div>
					</td>
					<td>
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>TODO Last post title TODO</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								By: TODO
							</div>
							<div align="right" style="white-space:nowrap">
								<span>Date: TODO</span>
							</div>
						</div>
					</td>
					<td> '.$row['thread_counter'].'  </td>';
					
					/*gets and shows the total post count*/
					while ($row_count = mysqli_fetch_assoc($post_count)){
						echo '<td> '.$row_count['total'].' </td>';
					}
				echo '</tr>
			</tbody>';
		}
	}
}

echo '<tbody>
	<tr>
		<td class="tcat" colspan="5"></td>
	</tr>
</tbody>
</table>
</div>';

include 'footer.php';
}
