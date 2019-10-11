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

    $status = 1 ;

	$stmt = $conn->prepare("SELECT * FROM tbl_table WHERE status = '$status';");
	
	$stmt->execute();

	$stmt->bind_result($table_id,$table_name,$capacity,$status);
	
	$menus = array();
	
	while($stmt->fetch()){
		$temp = array();
		$temp['table_id']=$table_id;
		$temp['table_name']=$table_name;
		$temp['capacity']=$capacity;
		$temp['status']=$status;
		array_push($menus,$temp);
	}
	echo json_encode($menus);
	
	
?>