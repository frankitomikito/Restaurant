<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$order_id = $_POST['order_id'];
$status = $_POST['status'];

require_once 'conn.php';

$sql = "UPDATE tbl_receipt SET  status= '$status' WHERE order_id = '$order_id'";

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