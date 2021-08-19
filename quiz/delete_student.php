<?php 
include 'db_connect.php';
extract($_GET);
$get = $conn->query("SELECT * FROM students where id=$id ")->fetch_array();
$qry = $conn->query("DELETE FROM students where id = $id ");
$qry2 = $conn->query("DELETE FROM users where id = '".$get['user_id']."' ");
if($qry && $qry2)
	echo true;
?>