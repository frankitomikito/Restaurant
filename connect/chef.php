<?php
$db_name = "id11028263_restaurantfinal";
$mysql_user="id11028263_anvic1998";
$mysql_pass="anvic123";
$server_name="localhost";
$conn = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

	if(mysqli_connect_errno()){
		echo "FAILED TO CONNECT" .mysqli_connect_error();
		die();
	}

	$stmt = $conn->prepare("SELECT tbl_menu.menu_id, tbl_menu.name, tbl_menu.description, tbl_menu.price, tbl_menu.image_path,tbl_category.names AS categname
	,tbl_menu.status FROM tbl_menu INNER JOIN tbl_category ON tbl_menu.category_id = tbl_category.category_id;");
	
	$stmt->execute();

	$stmt->bind_result($menu_id,$name,$description,$price,$image_path,$categoryname,$status);
	
	$menus = array();
	
	while($stmt->fetch()){
		$temp = array();
		$temp['menu_id']    =$menu_id;
		$temp['name']       =$name;
		$temp['description']=$description;
		$temp['price']   =$price;
		$temp['image_path']     =$image_path;
		$temp['categname'] =$categoryname;
		$temp['status'] =$status;
		array_push($menus,$temp);
	}
	echo json_encode($menus);
?>