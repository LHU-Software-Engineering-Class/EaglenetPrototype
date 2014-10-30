<?php
//forum_view.php
/*
Created by: Wesley Chubb
Created Date: 10/29/2014
Last Modified: 10/29/2014
Version 1.1
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
<div class="KonaBody">
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
	<thead>
		<tr>
			<td class="tcat" colspan="5">
				<a href="">EagleNet Forums Navigation</a>
			</td>
		</tr>
	</thead>
	<thead>
		<tr align="center">
			<td class="thead">&nbsp;</td>
			<td class="thead" width="100%" align="left">Forum</td>
			<td class="thead">Last Post</td>
			<td class="thead">Threads</td>
			<td class="thead">Posts</td>  
		</tr>
	</thead>';
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
							<a href="">'.$row['cat_desc'].'</a>
					</td>
				</tr>
			</tbody>';
		}
		while($row = mysqli_fetch_assoc($result)){
			echo '<tbody id="collapseobj_forumbit_12" style="">
				<tr align="center">
					<td class="alt2"><img src="images/forum_old.gif" alt="" border="0" id="forum_statusicon_256"></td>
					<td class="alt1Active" align="left" id="f256">
						<div>
							<a href="forum.php?id=' . $row['forum_id'] . '"><strong>'. $row['forum_name'] .'</strong></a>
						</div></td>
					<td class="alt2">
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>asdfadsf</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								by <a href="">dkh1058</a>
							</div>
							<div align="right" style="white-space:nowrap">
								08-29-2014 <span class="time">03:26 PM</span>
								<a href=""><img class="inlineimg" src="images/lastpost.gif" alt="Go to last post" border="0" title="Go to last post"></a>
							</div>
						</div></td>
					<td class="alt1">2</td>
					<td class="alt2"><span style="float:right"><a href="create_topic.php"><img src="images/smallnewtopic.gif" alt="" border="0"></a></span>14</td>
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
						<a href="">'.$row['cat_desc'].'</a>
					</td>
					</tr>
			</tbody>';
		}
		while($row = mysqli_fetch_assoc($result)){
			echo '<tbody id="collapseobj_forumbit_12" style="">
				<tr align="center">
					<td class="alt2"><img src="images/forum_old.gif" alt="" border="0" id="forum_statusicon_256"></td>
					<td class="alt1Active" align="left" id="f256">
						<div>
							<a href="forum.php?id=' . $row['forum_id'] . '"><strong>'. $row['forum_name'] .'</strong></a>
						</div></td>
					<td class="alt2">
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>asdfadsf</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								by <a href="">dkh1058</a>
							</div>
							<div align="right" style="white-space:nowrap">
								08-29-2014 <span class="time">03:26 PM</span>
								<a href=""><img class="inlineimg" src="images/lastpost.gif" alt="Go to last post" border="0" title="Go to last post"></a>
							</div>
						</div></td>
					<td class="alt1">2</td>
					<td class="alt2"><span style="float:right"><a href="create_topic.php"><img src="images/smallnewtopic.gif" alt="" border="0"></a></span>14</td>
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
						<a href="">'.$row['cat_desc'].'</a>
					</td>
					</tr>
			</tbody>';
		}
		while($row = mysqli_fetch_assoc($result)){
			echo '<tbody id="collapseobj_forumbit_12" style="">
				<tr align="center">
					<td class="alt2"><img src="images/forum_old.gif" alt="" border="0" id="forum_statusicon_256"></td>
					<td class="alt1Active" align="left" id="f256">
						<div>
							<a href="forum.php?id=' . $row['forum_id'] . '"><strong>'. $row['forum_name'] .'</strong></a>
						</div></td>
					<td class="alt2">
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>asdfadsf</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								by <a href="">dkh1058</a>
							</div>
							<div align="right" style="white-space:nowrap">
								08-29-2014 <span class="time">03:26 PM</span>
								<a href=""><img class="inlineimg" src="images/lastpost.gif" alt="Go to last post" border="0" title="Go to last post"></a>
							</div>
						</div></td>
					<td class="alt1">2</td>
					<td class="alt2"><span style="float:right"><a href="create_topic.php"><img src="images/smallnewtopic.gif" alt="" border="0"></a></span>14</td>
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
						<a href="">'.$row['cat_desc'].'</a>
					</td>
					</tr>
			</tbody>';
		}
		while($row = mysqli_fetch_assoc($result)){
			echo '<tbody id="collapseobj_forumbit_12" style="">
				<tr align="center">
					<td class="alt2"><img src="images/forum_old.gif" alt="" border="0" id="forum_statusicon_256"></td>
					<td class="alt1Active" align="left" id="f256">
						<div>
							<a href="forum.php?id=' . $row['forum_id'] . '"><strong>'. $row['forum_name'] .'</strong></a>
						</div></td>
					<td class="alt2">
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>asdfadsf</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								by <a href="">dkh1058</a>
							</div>
							<div align="right" style="white-space:nowrap">
								08-29-2014 <span class="time">03:26 PM</span>
								<a href=""><img class="inlineimg" src="images/lastpost.gif" alt="Go to last post" border="0" title="Go to last post"></a>
							</div>
						</div></td>
					<td class="alt1">2</td>
					<td class="alt2"><span style="float:right"><a href="create_topic.php"><img src="images/smallnewtopic.gif" alt="" border="0"></a></span>14</td>
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
						<a href="">'.$row['cat_desc'].'</a>
					</td>
					</tr>
			</tbody>';
		}
		while($row = mysqli_fetch_assoc($result)){
			echo '<tbody id="collapseobj_forumbit_12" style="">
				<tr align="center">
					<td class="alt2"><img src="images/forum_old.gif" alt="" border="0" id="forum_statusicon_256"></td>
					<td class="alt1Active" align="left" id="f256">
						<div>
							<a href="forum.php?id=' . $row['forum_id'] . '"><strong>'. $row['forum_name'] .'</strong></a>
						</div></td>
					<td class="alt2">
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>asdfadsf</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								by <a href="">dkh1058</a>
							</div>
							<div align="right" style="white-space:nowrap">
								08-29-2014 <span class="time">03:26 PM</span>
								<a href=""><img class="inlineimg" src="images/lastpost.gif" alt="Go to last post" border="0" title="Go to last post"></a>
							</div>
						</div></td>
					<td class="alt1">2</td>
					<td class="alt2"><span style="float:right"><a href="create_topic.php"><img src="images/smallnewtopic.gif" alt="" border="0"></a></span>14</td>
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
						<a href="">'.$row['cat_desc'].'</a>
					</td>
					</tr>
			</tbody>';
		}
		while($row = mysqli_fetch_assoc($result)){
			echo '<tbody id="collapseobj_forumbit_12" style="">
				<tr align="center">
					<td class="alt2"><img src="images/forum_old.gif" alt="" border="0" id="forum_statusicon_256"></td>
					<td class="alt1Active" align="left" id="f256">
						<div>
							<a href="forum.php?id=' . $row['forum_id'] . '"><strong>'. $row['forum_name'] .'</strong></a>
						</div></td>
					<td class="alt2">
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>asdfadsf</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								by <a href="">dkh1058</a>
							</div>
							<div align="right" style="white-space:nowrap">
								08-29-2014 <span class="time">03:26 PM</span>
								<a href=""><img class="inlineimg" src="images/lastpost.gif" alt="Go to last post" border="0" title="Go to last post"></a>
							</div>
						</div></td>
					<td class="alt1">2</td>
					<td class="alt2"><span style="float:right"><a href="create_topic.php"><img src="images/smallnewtopic.gif" alt="" border="0"></a></span>14</td>
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
						<a href="">'.$row['cat_desc'].'</a>
					</td>
					</tr>
			</tbody>';
		}
		while($row = mysqli_fetch_assoc($result)){
			echo '<tbody id="collapseobj_forumbit_12" style="">
				<tr align="center">
					<td class="alt2"><img src="images/forum_old.gif" alt="" border="0" id="forum_statusicon_256"></td>
					<td class="alt1Active" align="left" id="f256">
						<div>
							<a href="forum.php?id=' . $row['forum_id'] . '"><strong>'. $row['forum_name'] .'</strong></a>
						</div></td>
					<td class="alt2">
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>asdfadsf</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								by <a href="">dkh1058</a>
							</div>
							<div align="right" style="white-space:nowrap">
								08-29-2014 <span class="time">03:26 PM</span>
								<a href=""><img class="inlineimg" src="images/lastpost.gif" alt="Go to last post" border="0" title="Go to last post"></a>
							</div>
						</div></td>
					<td class="alt1">2</td>
					<td class="alt2"><span style="float:right"><a href="create_topic.php"><img src="images/smallnewtopic.gif" alt="" border="0"></a></span>14</td>
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
						<a href="">'.$row['cat_desc'].'</a>
					</td>
					</tr>
			</tbody>';
		}
		while($row = mysqli_fetch_assoc($result)){
			echo '<tbody id="collapseobj_forumbit_12" style="">
				<tr align="center">
					<td class="alt2"><img src="images/forum_old.gif" alt="" border="0" id="forum_statusicon_256"></td>
					<td class="alt1Active" align="left" id="f256">
						<div>
							<a href="forum.php?id=' . $row['forum_id'] . '"><strong>'. $row['forum_name'] .'</strong></a>
						</div></td>
					<td class="alt2">
						<div class="smallfont" align="left">
							<div>
								<span style="white-space:nowrap">
								<a href="" style="white-space:nowrap" title="Go to first unread post"><strong>asdfadsf</strong></a></span>
							</div>
							<div style="white-space:nowrap">
								by <a href="">dkh1058</a>
							</div>
							<div align="right" style="white-space:nowrap">
								08-29-2014 <span class="time">03:26 PM</span>
								<a href=""><img class="inlineimg" src="images/lastpost.gif" alt="Go to last post" border="0" title="Go to last post"></a>
							</div>
						</div></td>
					<td class="alt1">2</td>
					<td class="alt2"><span style="float:right"><a href="create_topic.php"><img src="images/smallnewtopic.gif" alt="" border="0"></a></span>14</td>
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