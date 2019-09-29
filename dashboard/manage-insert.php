<!-- manage-insert.php -->

<?php 
session_start();
include_once 'dbCon.php';
$con = connect();
	if (isset($_POST['useradd'])){
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $position = $_POST['position'];
        $status = 1;

        

        // existing email chaeck
        $checkSQL = "SELECT * FROM `tbl_user` WHERE email = '$email';";
        $checkresult = $con->query($checkSQL);
        if ($checkresult->num_rows > 0) {
        	echo '<script>alert("User With This Email Is Already Exit.")</script>';
        	echo '<script>window.location="../dashboard/user-add.php"</script>';
        }else{

	        	if (isset($_FILES['image'])) {
				 // files handle
				    $targetDirectory = "../dashboard/user-image/";
				    // get the file name
				    $file_name = $_FILES['image']['name'];
				    // get the mime type
				    $file_mime_type = $_FILES['image']['type'];
				    // get the file size
				    $file_size = $_FILES['image']['size'];
				    // get the file in temporary
				    $file_tmp = $_FILES['image']['tmp_name'];
				    // get the file extension, pathinfo($variable_name,FLAG)
				    $extension = pathinfo($file_name,PATHINFO_EXTENSION);

				    
				    if ($extension =="jpg" || $extension =="png" || $extension =="jpeg"){
				    	move_uploaded_file($file_tmp,$targetDirectory.$file_name);
				    	$iquery="INSERT INTO `tbl_user`(`fullname`, `username`, `email`, `password`, `gender`, `address`, `position`, `image_path`, `status`) 
			        		VALUES ('$fullname','$username','$email','$password','$gender','$address','$position','$file_name','$status');";
			        	if ($con->query($iquery) === TRUE) {
			        		echo '<script>alert("You Created successfully")</script>';
			        		echo '<script>window.location="../dashboard/user-add.php"</script>';
			        	}else {
			                echo "Error: " . $iquery . "<br>" . $con->error;
			            }
				    	
				    }else{
				    	echo '<script>alert("Required JPG,PNG,GIF in Logo Field.")</script>';
		        		echo '<script>window.location="../dashboard/user-add.php"</script>';
				    }
				}else{
					$file_name = "";

					$iquery="INSERT INTO `tbl_user`(`fullname`, `username`, `email`, `password`, `gender`, `address`, `position`, `image_path`, `status`) 
			        		VALUES ('$fullname','$username','$email','$password','$gender','$address','$position','$file_name','$status');";
		        	if ($con->query($iquery) === TRUE) {
		        		echo '<script>alert("New faculty added successfully")</script>';
		        	echo '<script>window.location="../dashboard/user-add.php"</script>';
		        	}else {
		                echo "Error: " . $iquery . "<br>" . $con->error;
		            }
				}
        }
    }
    

include_once 'dbCon.php';
$con = connect();
    
    //add table
    if (isset($_POST['addtable'])){
        $table_name = $_POST['table_name'];
        $capacity = $_POST['capacity'];
        $status = "1";    
        $table_id = $_SESSION['id'];

    	$iquery="INSERT INTO `tbl_table`(`table_name`,`capacity`,`status`) 
            VALUES ('$table_name','$capacity','$status');";
    	if ($con->query($iquery) === TRUE) {
    		echo '<script>alert("New table added successfully")</script>';
    		echo '<script>window.location="table-add.php"</script>';
    	}else {
            echo "Error: " . $iquery . "<br>" . $con->error;
        }
    }

    if (isset($_POST['adduser'])){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $position = $_POST['position'];
        $image_path = $_POST['image_path'];
        $status = "1";    
        $user_id = $_SESSION['user_id'];

    	$iquery="INSERT INTO `tbl_table`(`table_name`,`capacity`,`status`) 
            VALUES ('$table_name','$capacity','$status');";
    	if ($con->query($iquery) === TRUE) {
    		echo '<script>alert("New table added successfully")</script>';
    		echo '<script>window.location="table-add.php"</script>';
    	}else {
            echo "Error: " . $iquery . "<br>" . $con->error;
        }
    }

    if (isset($_POST['addcategory'])){
        $category_name = $_POST['name'];
        $status = "1";    
        $category_id = $_SESSION['id'];

    	$iquery="INSERT INTO `tbl_category`(`name`,`status`) 
            VALUES ('$category_name','$status');";
    	if ($con->query($iquery) === TRUE) {
    		echo '<script>alert("New table added successfully")</script>';
    		echo '<script>window.location="category-add.php"</script>';
    	}else {
            echo "Error: " . $iquery . "<br>" . $con->error;
        }
    }


    if (isset($_POST['addItem'])){
        $menuname = $_POST['menuname'];
        $price = $_POST['price'];
        $servings = $_POST['servings'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $status = 1;
        $menu_id = $_SESSION['menu_id'];
        

        //$ecnpassword= md5($password);

        $checkSQL = "SELECT * FROM `tbl_menu` WHERE menu_id = '$menu_id' and menuname = '$menuname' and description = '$description'and servings = '$servings'and price = '$price' and  category_id = '$category' and status = '$status';";
        $checkresult = $con->query($checkSQL);
        if ($checkresult->num_rows > 0) {
            echo '<script>alert("Item With This information Is Already Exit.")</script>';
            echo '<script>window.location="menu-add.php"</script>';
        }else{

                if (isset($_FILES['image'])) {
                 // files handle
                    $targetDirectory = "item-image/";
                    // get the file name
                    $file_name = $_FILES['image']['name'];
                    // get the mime type
                    $file_mime_type = $_FILES['image']['type'];
                    // get the file size
                    $file_size = $_FILES['image']['size'];
                    // get the file in temporary
                    $file_tmp = $_FILES['image']['tmp_name'];
                    // get the file extension, pathinfo($variable_name,FLAG)
                    $extension = pathinfo($file_name,PATHINFO_EXTENSION);

                    if ($extension =="jpg" || $extension =="png" || $extension =="jpeg"){
                        move_uploaded_file($file_tmp,$targetDirectory.$file_name);
                        $iquery="INSERT INTO `tbl_menu`( `name`, `description`, `servings`, `price`, `image_path`, `category_id`, `status`) 
                            VALUES ('$menuname','$description','$servings','$price','$file_name','$category','$status');";
                        if ($con->query($iquery) === TRUE) {
                            echo '<script>alert("Item added successfully")</script>';
                            echo '<script>window.location="menu-add.php"</script>';
                        }else {
                            echo "Error: " . $iquery . "<br>" . $con->error;
                        }
                        
                    }else{
                        echo '<script>alert("Required JPG,PNG,GIF in Logo Field.")</script>';
                        echo '<script>window.location="menu-add.php"</script>';
                    }
                }
        }
    }
?>