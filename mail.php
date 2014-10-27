<?php
/*
//Created by: David Hall
//Created Date: 10/25/2014
//Last Modified: 10/25/2014
//Version 1.0
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
	$mail->AddReplyTo('eaglenetlhu@gmail.com', 'EagleNet'); // Reply TO
	$mail->AddAddress($useremail); // recipient email
	$mail->Subject    = "EagleNet Verification"; // email subject
	$mail->AltBody = "Plain text version: You have registered to use the EagleNet discussion forum. 
	Please copy this number ".$uniq_code." and click here to go here to activate your account http://eaglenet.lhup.edu/verification.php
	Thank you for using the EagleNet";
	$mail->Body = "You have registered to use the <b>EagleNet</b> discussion forum.<br/><br/>
	Please copy this number ".$uniq_code." and click here to <a href='http://eaglenet.lhup.edu/verification.php'> activate your account</a>";