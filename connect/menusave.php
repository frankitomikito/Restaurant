<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

$menu_id = $_POST['menu_id'];	
$status = $_POST['status'];

require_once 'conn.php';

$sql = "UPDATE tbl_menu SET status= '$status' WHERE menu_id = '$menu_id'";

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