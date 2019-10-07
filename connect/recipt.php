<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){


$date_ordered = date_format(date_create(), 'Y-m-d H:s:i');
$total = 0 ;
$discount = 0 ;
$user_id = $_POST['user_id'];
$table_id = $_POST['table_id'];
$status = 1 ;

require_once 'conn.php';
	
$sql= " insert into tbl_receipt (date_ordered,total,discount,user_id,table_id,status) 
values('$date_ordered','$total','$discount','$user_id','$table_id','$status')";	

if(mysqli_query($conn,$sql)){
    
$result["success"]= "1";
$result["message"] = "success";
echo json_encode($result);
mysqli_close($conn);
}else{
	$result["success"]="0";
	$result["message"]="Error";
	echo json_encode($result);
mysqli_close($conn);
}	
}
?>