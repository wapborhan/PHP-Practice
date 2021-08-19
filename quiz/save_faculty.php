<?php 

include 'db_connect.php';

extract($_POST);

if(empty($id)){
	$data=  " name='".$name."'";
	$data .=  ", username='".$username."'";
	$data .=  ", user_type='".$user_type."'";
	$data .=  ", password='".$password."'";
	$chk = $conn->query("SELECT * FROM users where username = '".$username."' ")->num_rows;
	if($chk > 0){
			echo json_encode(array('status'=>2,'msg'=>'Username already exist'));
			exit;
	}
	$insert_user = $conn->query('INSERT INTO users set  '.$data);

	if($insert_user){
		$id = $conn->insert_id;
		$insert_faculty =$conn->query("INSERT INTO faculty set user_id = '".$id."', subject='".$subject."' ");
		if($insert_faculty){
			echo json_encode(array('status'=>1));
		}
	}
}else{
	$data=  " name='".$name."'";
	$data .=  ", username='".$username."'";
	$data .=  ", user_type='".$user_type."'";
	$data .=  ", password='".$password."'";
	$chk = $conn->query("SELECT * FROM users where username = '".$username."' and id !='".$uid."' ")->num_rows;
	if($chk > 0){
			echo json_encode(array('status'=>2,'msg'=>'Username already exist'));
			exit;
	}
	$update_user = $conn->query('UPDATE users set  '.$data.' where id ='.$uid);

	if($update_user){
		$update_faculty =$conn->query("UPDATE faculty set subject='".$subject."' where id = '".$id."' ");
		if($update_faculty){
			echo json_encode(array('status'=>1));
		}
	}
}