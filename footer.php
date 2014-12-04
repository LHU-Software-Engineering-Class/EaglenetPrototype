<?php
/*
File name: footer.php
Created by: David Hall
Created Date: 10/11/2014
Last Modified by: David Hall
Last Modified: 11/11/2014 5:35PM
Version 3.0
*/

echo '
</div><!-- End MastHead -->
</div><!-- End Page content -->
	<div id="footer">
	<p>
			<a href="index.php">Home</a>|
			<a href="forumview.php">All Students</a>|
			<a href="forumview.php">Majors</a>|
			<a href="forumview.php">Clubs</a>|
			<a href="forumview.php">Greek Life</a>|
			<a href="forumview.php">Campus Events</a>|
			<a href="forumview.php">Volunteer</a>|
			<a href="forumview.php">Campus Housing</a>|
			<a href="forumview.php">Local Attractions</a>|
			<a href="forumview.php">Campus Maps</a>|
			<a href="forumview.php">Book Finder</a>|
			<a href="issues.php">Report Issues</a>|';
			if($_SESSION['user_level'] != 0){
				echo '|<a href="admin.php">Admin</a>';
			}
			echo'<br />Designed By Lock Haven University Students COMP405 2014</p>
	</div><!--End Footer-->
</div><!--End Content-->
</body>
</html>';