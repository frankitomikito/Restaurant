<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	$User_ID = $_POST['user_id'] ;
	$table_id = $_POST['table_id'];
	require_once 'conn.php';
	$sql = "SELECT * FROM tbl_receipt WHERE table_id ='$table_id' AND status = '1' ";

	$response = mysqli_query($conn,$sql);
	$result = array();
	
	$result['Data'] = array();

	if(mysqli_num_rows($response)=== 1){
	    
		if($row = mysqli_fetch_assoc($response)){
			
			$in['order_id'] = $row['order_id'];
			$in['date_ordered'] = $row['date_ordered'];
			$in['total'] = $row['total'];
			$in['discount'] = $row['discount'];	
			$in['user_id'] = $row['user_id'];
			$in['table_id'] = $row['table_id'];
			$in['status'] = $row['status'];
		
			array_push($result["Data"],  $in);
			$result["success"] = "1";
			echo json_encode($result);	
		    
		}
	}	
}else{
	$result["success"] = "0";
	$result["message"] = "Error";
	echo json_encode($result);
	
	mysqli_close($conn);
	
}
?>