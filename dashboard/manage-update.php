<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'restaurant_v2');

if(isset($_POST['updatedata']))
{
 $id = $_POST['table_id'];

 $table_name = $_POST['table_name'];
 $capacity = $_POST['capacity'];
 $status = $_POST['status'];

 $query ="UPDATE tbl_table SET table_name='$table_name', capacity='$capacity', status='$status' WHERE table_id= '$id' ";
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
?>
