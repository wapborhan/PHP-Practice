<?php
include 'db_connect.php';
	
	$qry = $conn->query("SELECT f.*,u.name,u.id as uid,u.username,u.password from faculty f left join users u  on f.user_id = u.id where f.id='".$_GET['id']."' ");
	if($qry){
		echo json_encode($qry->fetch_array());
	}
?>