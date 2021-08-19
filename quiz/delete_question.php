<?php 
include 'db_connect.php';
extract($_GET);
$delete = $conn->query("DELETE FROM questions where  id=".$id);
if($delete)
	echo true;
?>