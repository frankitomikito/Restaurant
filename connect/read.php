<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	
	$User_ID = $_POST['user_id'];
	
	require_once 'conn.php';
	
	$sql = "SELECT * FROM tbl_user WHERE user_id ='$User_ID' ";
	
	$response = mysqli_query($conn,$sql);
	
	$result = array();
	$result['read'] = array();
	
	if(mysqli_num_rows($response)=== 1){
		
		if($row = mysqli_fetch_assoc($response)){
			$in['user_id'] = $row['user_id'];
			$in['fullname'] = $row['fullname'];
			$in['username'] = $row['username'];
			$in['email'] = $row['email'];
			$in['address'] = $row['address'];
			$in['gender'] = $row['gender'];
			$in['position'] = $row['position'];
			$in['image_path'] = $row['image_path'];
			array_push($result["read"],  $in);
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