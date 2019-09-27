    
<?php
 include 'dbCon.php';
 $con = connect();
if(isset($_POST['reserve'])){
    $count=0;
    $table=$_POST['table'];
    $datetime=$_POST['datetime'];
    $userid=$_POST['userid'];

    $sql = "Select * from tbl_booking where user_id='$userid' and status = 0 ;";
    $result = $con->query($sql);
    foreach($result as $re){
        $count++;
    }

    if($count > 0 ){
        echo '<script>alert("You have pending reservation.")</script>';
        echo '<script>window.location="reservation.php"</script>';
    }
    else{
        $bookid=0;

      $num=0;
 
      $sql = "Insert into tbl_booking (check_in,user_id,status) values ('$datetime','$userid','0') ;";
      if ($con->query($sql) === TRUE) {
        //echo '<script>alert("Save")</script>';
      }else{
        echo '<script>alert("ERROR")</script>';
      }
      
      $sql = "Select max(booking_id) as id from tbl_booking ;";
      $result = $con->query($sql);
      foreach($result as $re){
          $bookid=$re['id'];
      }
     
      foreach ($table as $name){ 
        $sql = "Insert into tbl_booked_table (table_id,booking_id) values ('$name','$bookid') ;";
        if ($con->query($sql) === TRUE) {
            echo '<script>alert("Kindly wait for the confirmation.")</script>';
          echo '<script>window.location="reservation.php"</script>';
        }else{
          echo '<script>alert("ERROR")</script>';
        }

        $sql ="UPDATE tbl_table SET status=0 WHERE table_id= '$name' ";
        $result = $con->query($sql);

        if($result){
        // echo '<script> alert ("Data Updated"); </script>';
        // header("Location:category-list.php");
        }
        else{
        echo '<script> alert("Table update failed!"); </script>';
        }
    }
    }


    
    

}
    
   
    
    ?>