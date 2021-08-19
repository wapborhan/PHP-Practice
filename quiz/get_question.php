<?php
include 'db_connect.php';
$data = array();
$qry = $conn->query("SELECT * FROM questions where id =  ".$_GET['id']);

foreach($qry->fetch_array() as $k => $v){
	$data['qdata'][$k] = $v;
}
$qry2 = $conn->query("SELECT * FROM question_opt where question_id =  ".$_GET['id']);
while($row = $qry2->fetch_assoc()){
	$data['odata'][] = $row;
}
echo json_encode($data);

