<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$userpass = $_POST['password'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$position = 2 ;
$image_path= $_POST['image_path'];
$status = 1 ;


$userpass = password_hash($userpass,PASSWORD_DEFAULT);

require_once 'conn.php';
	
$sql= " insert into tbl_user (fullname,username,email,password,gender,address,position,image_path,status) 
values('$fullname','$username','$email','$userpass','$gender','$address','$position',
'$image_path','$status')";	

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