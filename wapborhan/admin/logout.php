<?php
include '../include/functions.php';
include '../include/config.php';
if(isset($_SESSION['loginsuccess'])){
	session_unset();
	session_destroy();
	$_SESSION['errorMessage'] = "You are logged out.";
	redirectTo("index.php");
}else{
		$_SESSION['errorMessage'] = "You are not logged in.";
		redirectTo("index.php");
}
?>