<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	$user_id = $_POST['user_id'];
	require_once 'conn.php';
		
	$stmt = $conn->prepare("SELECT tbl_booking.booking_id,tbl_booking.check_in,tbl_booking.user_id,tbl_booking.status,tbl_booked_table.table_id FROM tbl_booking INNER JOIN tbl_booked_table ON tbl_booking.booking_id = tbl_booked_table.booking_id
				WHERE user_id = '$user_id' ");
	$stmt->execute();
	$stmt->bind_result($booking_id,$check_in,$user_id,$status,$table_id);
	
	$menus = array();
	
	while($stmt->fetch()){
		$temp = array();
		$temp['booking_id']=$booking_id;
		$temp['check_in']=$check_in;
		$temp['user_id']=$user_id;
		$temp['status']=$status;
		$temp['table_id']=$table_id;
		array_push($menus,$temp);
	}
	echo json_encode($menus);
}

?>