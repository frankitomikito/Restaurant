
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$quantity = $_POST['quantity'];
$menu_id = $_POST['menu_id'];
$order_id = $_POST['order_id'];

require_once 'conn.php';
	
$sql= " insert into tbl_order (quantity,menu_id,order_id) 
values('$quantity','$menu_id','$order_id')";	

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