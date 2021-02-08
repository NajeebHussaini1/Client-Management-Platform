<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	September 23, 2020
*/
include "./includes/header.php";
session_unset();
session_destroy();
//session_start();
$_SESSION['message'] = "You have successfully logged out";
$_SESSION['logoutmessage'] = "You have successfully logged out";
file_put_contents("./DATE_log.txt", $_SESSION['logoutmessage']."\n", FILE_APPEND);
header ("Location: ./sign-in.php");
ob_flush();
?>