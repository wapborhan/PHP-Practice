<?php 
session_start();
function errorMessage(){
	if (isset($_SESSION['errorMessage'])) {
		$output = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error: </strong>';
		$output .= $_SESSION['errorMessage'];
		$output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		$_SESSION['errorMessage'] = null;
		return $output;
	}
}

function successMessage(){
	if (isset($_SESSION['successMessage'])) {
		$output = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success: </strong>';
		$output .= $_SESSION['successMessage'];
		$output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		$_SESSION['successMessage'] = null;
		return $output;
	}
}
function redirectTo($location){
	header("location:".$location);
	exit;
}
function sitelink(){
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https"; 
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST'];
return $link;
}
function siteinfo($colname){
	include 'config.php';
	$site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
	$siteinfo = mysqli_fetch_assoc($site_info_result);
	return $siteinfo[$colname];
}
?>