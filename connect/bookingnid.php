<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$table_id = $_POST['table_id'];	
$booking_id = $_POST['booking_id'];

require_once 'conn.php';

$sql = " INSERT INTO tbl_booked_table (table_id,booking_id)
	VALUES('$table_id','$booking_id')";
	
if(mysqli_query($conn,$sql)){
	$result["success"] = "1";
	$result["message"] = "success";
	echo json_encode($result);
	mysqli_close($conn);	
}	
}
else{
	$result["success"] = "0";
	$result["message"] = "error";
	echo json_encode($result);
	mysqli_close($conn);
	
	
}

?>