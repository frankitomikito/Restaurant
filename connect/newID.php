<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	
		$User_ID = $_POST['user_id'] ;
	$table_id = $_POST['table_id'];
	require_once 'conn.php';
	
	$stmt = $conn->prepare("SELECT * FROM tbl_receipt WHERE user_id ='22' AND status = '1';");
	
		$stmt->execute();

	$stmt->bind_result($order_id,$date_ordered,$total,$discount,$user_id,$table_id,$status);
	
	$menus = array();
	
		while($stmt->fetch()){
		$temp = array();
		$temp['order_id']    =$order_id;
		$temp['date_ordered']       =$date_ordered;
		$temp['total']=$total;
		$temp['discount']   =$discount;
		$temp['user_id']     =$user_id;
		$temp['table_id'] =$table_id;
		$temp['status'] =$status;
		array_push($menus,$temp);
	}
	echo json_encode($menus);
	
}
?>