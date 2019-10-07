<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$check_in = $_POST['check_in'];	
$user_id = $_POST['user_id'];
$status = 0 ;

require_once 'conn.php';

$sql = " INSERT INTO tbl_booking(check_in,user_id,status)
	VALUES('$check_in','$user_id','$status')";
	
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