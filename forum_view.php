<?php
/*
File name: forum_view.php
Created by: Wesley Chubb
Created Date: 10/29/2014
Last Modified by: David Hall
Last Modified Date: 11/11/2014 5:30 PM
Version 3.0
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

	
for($cat = 1; $cat <20; $cat++){
	$sql = "SELECT
			forum_id,
			forum_name,
			forum_description
		FROM
			forums
		WHERE
			forum_cat = $cat";
	$result = mysqli_query($con,$sql);
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
		
		while($row = mysqli_fetch_assoc($result)){
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
					<td> 2 </td>
					<td> 14 </td>
				</tr>
			</tbody>';
		}
	}
	elseif ($cat ==2){
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
		
		while($row = mysqli_fetch_assoc($result)){
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
					<td> 2 </td>
					<td> 14 </td>
				</tr>
			</tbody>';
		}
	}
	elseif ($cat ==3){
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
		
		while($row = mysqli_fetch_assoc($result)){
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
					<td> 2 </td>
					<td> 14 </td>
				</tr>
			</tbody>';
		}
	}
	elseif ($cat ==4){
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
		
		while($row = mysqli_fetch_assoc($result)){
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
					<td> 2 </td>
					<td> 14 </td>
				</tr>
			</tbody>';
		}
	}
	elseif ($cat ==5){
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
		
		while($row = mysqli_fetch_assoc($result)){
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
					<td> 2 </td>
					<td> 14 </td>
				</tr>
			</tbody>';
		}
	}
	elseif ($cat ==6){
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
		
		while($row = mysqli_fetch_assoc($result)){
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
					<td> 2 </td>
					<td> 14 </td>
				</tr>
			</tbody>';
		}
	}
	elseif ($cat ==7){
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
		
		while($row = mysqli_fetch_assoc($result)){
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
					<td> 2 </td>
					<td> 14 </td>
				</tr>
			</tbody>';
		}
	}
	elseif ($cat ==8){
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
		
		while($row = mysqli_fetch_assoc($result)){
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
					<td> 2 </td>
					<td> 14 </td>
				</tr>
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
