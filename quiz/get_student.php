<?php
include 'db_connect.php';
	
	$qry = $conn->query("SELECT s.*,u.name,u.id as uid,u.username,u.password from students s left join users u  on s.user_id = u.id where s.id='".$_GET['id']."' ");
	if($qry){
		echo json_encode($qry->fetch_array());
	}
?>