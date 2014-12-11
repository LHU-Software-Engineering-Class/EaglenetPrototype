<?php
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
echo'<div id="content2">
<font size="7">
<p align="center"><b><i>WELCOME TO EAGLENET!</i></b></p>
</font>
<font size="4">
<p align="center"><b><i>99% uptime!</i></b></p>
</font>
<dl>
  <dt><h1>Check out the sidebar!</font></h></dt>
  </ul>
  </dd>
</dl>
</body>';
include 'footer.php';
}
