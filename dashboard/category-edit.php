<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'restaurant_v2');

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
?>
