<?php 
include 'db_connect.php';
extract($_POST);
$insert = array();
foreach($user_id as $val){
	$insert[]=$conn->query("INSERT INTO quiz_student_list set quiz_id = $qid, user_id = ".$val);
}
if(count($user_id) == count($insert)){
	echo 1;
}