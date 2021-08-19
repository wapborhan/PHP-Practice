<?php
include '../include/functions.php';
include '../include/config.php';
if(isset($_SESSION['loginsuccessuser'])){
	unset($_SESSION['loginsuccessuser']);
	unset($_SESSION['loginsuccessuseremail']);
	session_destroy();
	session_start();
	$_SESSION['errorMessage'] = "You are logged out.";
	redirectTo("../index.php");
}else{
		session_start();
		$_SESSION['errorMessage'] = "You are not logged in.";
		redirectTo("../index.php");
}
