<?php
/*
File name: mail.php
Created by: David Hall
Created Date: 10/25/2014
Last Modified by: Robert Shelly
Last Modified: 11/11/2014
Version 1.1
*/

//phpMailer auto generated email message
	include ("PHPMailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->Port       = 465; // SMTP Port
	$mail->Username   = "eaglenetlhu@gmail.com"; // SMTP account username
	$mail->Password   = "COMP405-2014";        // SMTP account password
	$mail->SetFrom('eaglenetlhu@gmail.com', 'EagleNet'); // FROM
	$mail->AddAddress($useremail); // recipient email
	$mail->Subject    = "EagleNet Verification"; // email subject
	$mail->AltBody = "Plain text version: You have registered to use the EagleNet discussion forum. 
	Please copy this number ".$uniq_code." and click here to go here to activate your account http://dev.eaglenet.lhup.edu/verification.php
	Thank you for using the EagleNet";
	$image = 'http://91ef69bade70f992a001-b6054e05bb416c4c4b6f3b0ef3e0f71d.r93.cf3.rackcdn.com/eagle-head-100194409.jpg';
	$mail->Body = "<img src=".$image."></br>
        You have requested an account on the <b>EagleNet </b>Discussion forum<br/><br/>
	Please copy this number &nbsp;&nbsp;&nbsp;".$uniq_code."</br> 
        and click here to <a href='http://dev.eaglenet.lhup.edu/verification.php'> activate your account</a></br>
        Disregard this email if you did not request an account from EagleNet";
