<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	$order_id = $_POST['order_id'];
	require_once 'conn.php';
		
	$stmt = $conn->prepare("SELECT tbl_order.order_item_id,tbl_order.order_id , tbl_order.quantity ,tbl_menu.name ,tbl_menu.price FROM tbl_order INNER JOIN tbl_menu ON tbl_order.menu_id = tbl_menu.menu_id
	WHERE order_id = '$order_id' ");
	$stmt->execute();
	$stmt->bind_result($order_item_id,$order_id,$quantity,$name,$price);
	
	$menus = array();
	
	while($stmt->fetch()){
		$temp = array();
		$temp['order_item_id']=$order_item_id;
		$temp['order_id']=$order_id;
		$temp['quantity']=$quantity;
		$temp['name']=$name;
		$temp['price']=$price;
		array_push($menus,$temp);
	}
	echo json_encode($menus);
}

?>
