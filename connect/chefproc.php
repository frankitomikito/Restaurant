<?php
require_once('../dbconfig.php');

$db_name = DbConfig::DBNAME;
$mysql_user=DbConfig::USERNAME;
$mysql_pass=DbConfig::PASSWORD;
$server_name=DbConfig::SERVER;
$conn = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

	if(mysqli_connect_errno()){
		echo "FAILED TO CONNECT" .mysqli_connect_error();
		die();
	}


	$stmt = $conn->prepare("SELECT order_id,date_ordered,table_id,status FROM tbl_receipt WHERE status = '1' OR status = '2' OR status = '3';");
	
	$stmt->execute();

	$stmt->bind_result($order_id,$date_ordered,$table_id,$status);
	
	$menus = array();
	
	while($stmt->fetch()){
		$temp = array();
		$temp['order_id']=$order_id;
		$temp['date_ordered']=$date_ordered;
		$temp['table_id']=$table_id;
		$temp['status']=$status;

		array_push($menus,$temp);
	}
	echo json_encode($menus);
	
	
?>