<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	$status = 1 ;
	require_once 'conn.php';
		
	$stmt = $conn->prepare("SELECT * FROM tbl_category WHERE status = '$status' ");
	$stmt->execute();
	$stmt->bind_result($category_id,$names,$status);
	
	$menus = array();
	
	while($stmt->fetch()){
		$temp = array();
		$temp['category_id']=$category_id;
		$temp['name']=$names;
		$temp['status']=$status;
		array_push($menus,$temp);
	}
	echo json_encode($menus);
}


?>