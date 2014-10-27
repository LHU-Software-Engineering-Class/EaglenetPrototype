<?php
/*
//Created by: David Hall
//Created Date: 10/11/2014
//Last Modified: 10/11/2014
//Version 1.0
*/
?>

<!-- Begin Sidebar -->
	<div id="sidebar">
		<ul>
			<?php
				$_SESSION['signed_in'];
				if($_SESSION['signed_in'])
				{
					echo '<li class="filler">Hello <b>' . htmlentities($_SESSION['user_name']) . '</b> Not you?</li>
					<li><a href="signout.php">Sign out</a></li>
					<li class="filler">&nbsp;----------------------------</li>';
				}
				else
				{
					echo '<li><a href="home.php">Sign in</a></li> 
					<li><a href="signup.php">Create an account</a></li>
					<li class="filler">&nbsp;----------------------------</li>';
				}
			?>
			<li><a href="start.php">Home</a></li>
			<li><a href="forum_view.php">All Students</a></li>
			<li><a href="forum_view.php">Majors</a></li>
			<li><a href="forum_view.php">Clubs</a></li>
			<li><a href="forum_view.php">Campus Events</a></li>
			<li><a href="forum_view.php">Volunteer</a></li>
			<li><a href="forum_view.php">Campus Housing</a></li>
			<li><a href="forum_view.php">Local Attractions</a></li>
			<li><a href="forum_view.php">Book Finder</a></li>
			</ul>
	</div>
<!-- End Sidebar -->