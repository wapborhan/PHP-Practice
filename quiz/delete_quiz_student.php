<?php 
include 'db_connect.php';
extract($_GET);
$delete = $conn->query("DELETE FROM quiz_student_list where  id=".$qid);
if($delete)
	echo true;
?>