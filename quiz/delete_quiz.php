<?php 
include 'db_connect.php';
extract($_GET);
$get = $conn->query("SELECT * FROM questions where qid= ".$id)->fetch_array();
$delete = $conn->query("DELETE FROM quiz_list where id= ".$id);
$delete1 = $conn->query("DELETE FROM questions where qid= ".$id);
$delete2 = $conn->query("DELETE FROM question_opt where question_id=".$get['id']);
if($delete)
	echo true;
?>