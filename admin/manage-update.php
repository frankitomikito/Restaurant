<?php
$connection = mysqli_connect("localhost","id11174334_emmasama","emmasama");
$db = mysqli_select_db($connection, 'id11174334_restaurant');

if(isset($_POST['updatedata']))
{
 $table_id = $_POST['table_id'];
 $table_name = $_POST['table_name'];
 $capacity = $_POST['capacity'];
 $status = $_POST['status'];

 $query ="UPDATE tbl_table SET table_name='$table_name', capacity='$capacity', status='$status' WHERE table_id= '$table_id' ";
 $query_run = mysqli_query($connection, $query);

 if($query_run){
echo '<script> alert ("Data Updated"); </script>';
header("Location:table-list.php");
 }
else{
 echo '<script> alert("Data Not Update"); </script>';
}

 }

 if(isset($_POST['updatemenu']))
{
 $menu_id = $_POST['menu_id'];
 $name = $_POST['name'];
 $description = $_POST['description'];
 $servings = $_POST['servings'];
 $price = $_POST['price'];
 $image_path = $_POST['image_path'];
 $category_id = $_POST['category_id'];
 $status = $_POST['status'];

 $query ="UPDATE tbl_menu SET name='$name', description='$description', servings='$servings', price='$price', image_path='$image_path', category_id='$category_id', status='$status' WHERE menu_id= '$menu_id' ";
 $query_run = mysqli_query($connection, $query);

 if($query_run){
echo '<script> alert ("Data Updated"); </script>';
header("Location:menu-list.php");
 }
else{
 echo '<script> alert("Data Not Update"); </script>';
}

 }

 if(isset($_POST['updatecategory']))
{
 $category_id = $_POST['category_id'];
 $category_name = $_POST['name'];
 $status = $_POST['status'];

 $query ="UPDATE tbl_category SET name='$category_name', status='$status' WHERE category_id= '$category_id' ";
 $query_run = mysqli_query($connection, $query);

 if($query_run){
echo '<script> alert ("Data Updated"); </script>';
header("Location:category-list.php");
 }
else{
 echo '<script> alert("Data Not Update"); </script>';
}

 }

 if(isset($_POST['updateuser']))
 {
  $user_id = $_POST['user_id'];
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $position = $_POST['position'];
  $image_path = $_POST['image_path'];
  $status = $_POST['status'];

 
  $query ="UPDATE tbl_user SET fullname='$fullname', username='$username', email='$email', password='$password', gender='$gender', address='$address', position='$position', image_path='$image_path', status='$status' WHERE user_id= '$user_id' ";
  $query_run = mysqli_query($connection, $query);
 
  if($query_run){
 echo '<script> alert ("Data Updated"); </script>';
 header("Location:profile.php");
  }
 else{
  echo '<script> alert("Data Not Update"); </script>';
 }
 
  }

  if(isset($_POST['userupdate']))
 {
  $user_id = $_POST['user_id'];
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $position = $_POST['position'];
  $image_path = $_POST['image_path'];
  $status = $_POST['status'];

 
  $query ="UPDATE tbl_user SET fullname='$fullname', username='$username', email='$email', password='$password', gender='$gender', address='$address', position='$position', image_path='$image_path', status='$status' WHERE user_id= '$user_id' ";
  $query_run = mysqli_query($connection, $query);
 
  if($query_run){
 echo '<script> alert ("Data Updated"); </script>';
 header("Location:../dashboard/user-list.php");
  }
 else{
  echo '<script> alert("Data Not Update"); </script>';
 }
 
  }
