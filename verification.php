@@ -0,0 +1,58 @@
<?php
include 'connect.php';
include 'header2.php';
include 'sidefiller.php';
/*
//Created by: Greg Hall
//Created Date: 10/29/2014
//Version 1.0



echo'<!-- Begin Content -->
                <div id="content2">';
		echo '<h1>Welcome to Eaglenet</h1>';
		echo "<h2>This page is for verifying your account.</h2><br />
		<h3>If you haven't signed up please go to <a href='signup.php'>SIGN UP</a> page.</h3><br/>"


//Verification form and submit button
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo '<form name="Form1" method="get" action="">
            Verification Code: <input type="text" name="user_verif"/><br/>
            <input type="submit" value="Submit"/><br/>
        </form>';
}

else {
	if($_GET['user_verif'] != ""){
		$result = mysqli_query($con, "SELECT user_name, user_verif, user_status from users");
		while ($row = mysqli_fetch_array($result)){
			if($row['user_verif'] === $_GET && $row['user_status'] == true){
				echo '<h3>You have already activated your account please proceed to the <a href="index.php">SIGN IN</a> page.</h3>';
				break;
			}
			elseif(($row['user_verif'] === $_GET['user_verif'] && $row['user_status'] == false){
				$username = $row['user_name'];
				$sql = "UPDATE users SET user_status = true where user_name = '$username'";
				$result = mysqli_query($con,$sql);
				if (!$result)
					echo 'Something went wrong while validating. Please try again later.';
				}
			}
			else{
				echo '<h3>You have succesfully validated your account! <br/><br/>
					Proceed to the <a href="index.php">SIGN IN</a> page.<br/><br/>
					This page will refresh in 5 seconds and take you back to the sign-in page.</h3>';
					header("refresh:5; url=index.php");
				break;
			}
		}
	}       
	else{
		echo 'Please enter your verification code into the box <br/><br/>This page will refresh in 5 seconds and take you back to the verification page.';
		header("refresh:5");
	}
}

include 'footer.php';
 No newline at end of file
