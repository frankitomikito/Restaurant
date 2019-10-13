<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$chef_id = $_POST['chef_id'];
$order_id = $_POST['order_id'];

require_once 'conn.php';

$sql = "UPDATE tbl_receipt SET chef_id='$chef_id' WHERE order_id = '$order_id'";

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