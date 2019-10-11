<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$table_id = $_POST['table_id'];
require_once 'conn.php';
$sql = "DELETE FROM tbl_receipt WHERE table_id = '$table_id' AND status = '1' ";
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