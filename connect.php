<?php 
/*
//Created by: David Hall
//Created Date: 10/11/2014
//Last Modified: 10/11/2014
//Version 1.0
*/

//connect.php 
//Connection module shared across all pages 

//connection specifics
$server	    = 'localhost';
$username	= 'eagle';
$password	= '';
$database	= 'test';

//connect variable set to the connection specifics
$con = mysqli_connect($server, $username, $password, $database);

//error checking if connection not made
if(mysqli_connect_errno())
{
 	exit('Error: could not establish database connection <br /> Please try again later');
}
//starts a session so that users do not have to sign-in from page to page
session_start();