<?php
/*
File name: sidebar.php
Created by: David Hall
Created Date: 10/11/2014
Last Modified by: David Hall
Last Modified Date: 11/11/2014 5:38PM
Version 2.0
*/
?>

<!-- Begin Sidebar -->
	<div id="sidebar">
		<ul>
			<?php
				$_SESSION['signed_in'];
				if($_SESSION['signed_in'])
				{
					echo '<li class="filler">Hello <b>' . htmlentities($_SESSION['user_name']) . '</b></li>
					<li><a href="signout.php">Sign out</a></li>
					<li class="filler">&nbsp;-------------------------</li>';
				}
				else
				{
					echo '<li><a href="index.php">Sign in</a></li> 
					<li><a href="signup.php">Create an account</a></li>
					<li class="filler">&nbsp;-------------------------</li>';
				}
			?>
			<li><a href="start.php">Home</a></li>
			<li><a href="forum_view.php#cat1">All Students</a></li>
			<li><a href="forum_view.php#cat2">Majors</a></li>
			<li><a href="forum_view.php#cat3">Clubs</a></li>
			<li><a href="forum_view.php#cat4">Campus Events</a></li>
			<li><a href="forum_view.php#cat5">Volunteer</a></li>
			<li><a href="forum_view.php#cat6">Campus Housing</a></li>
			<li><a href="forum_view.php#cat7">Local Attractions</a></li>
			<li><a href="forum_view.php#cat8">Book Finder</a></li>
			<li><a href="maps.php">Campus Maps</a></li>
			<li><a href="advisor.php">Advisors FAQ</a></li>
			<li><a href="technology.php">Technology Help</a></li>
			</ul>
	</div>
<!-- End Sidebar -->