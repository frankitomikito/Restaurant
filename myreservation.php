<!-- choose-table.php -->
<?php 

if(isset($_SESSION['userid'])){
    echo '<script>alert("'.$_SESSION['userid'].'")</script>';
  }
 $datetime="";
 $uid;
if (isset($_POST['reservation'])) {
    

  // $res_id = $_POST['res_id'];
  // $reservation_name = $_POST['reservation_name'];
  // $reservation_phone = $_POST['reservation_phone'];
  if (isset($_GET['id'])) {
    //echo '<script>alert("'.$_GET['id'].'")</script>';
    $uid = $_GET['id'];
  }

  $confirm = false;
  $msg="";

  $reservation_date = $_POST['reservation_date'];
  $reservation_time = $_POST['reservation_time'];

  $datetime = $reservation_date.' '.$reservation_time; 

}

 


include 'template/header.php'; ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <body>
    
   <?php include 'template/nav-bar.php'; ?>
    <!-- END nav -->
    
    <section class="home-slider owl-carousel" style="height: 400px;">
      <div class="slider-item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center">
            <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
              <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Tables</span></p>
              <h1 class="mb-3">Choose Tables</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section" style="background: #ffffff;">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <!-- <span class="subheading">Our Tables</span> -->
            <h2>My Reservation</h2>
           
            <?php
	 include 'dbCon.php';
	  if(isset($_SESSION['id'])){
		//echo '<script>alert("'.$_SESSION['id'].'")</script>';
		$userid=$_SESSION['id'];
	  }
	  $count=0;
	 
	  $con = connect();
	  $sql = "Select *,tbl_booking.status as newstat from tbl_booking inner join tbl_booked_table on tbl_booking.booking_id=tbl_booked_table.booking_id inner join tbl_table on tbl_table.table_id=tbl_booked_table.table_id  where user_id='$userid'";
	  $result = $con->query($sql);
	  foreach($result as $re){
		$booking_id = $re['booking_id'];
		$date = $re['check_in'];
		$table = $re['table_name'];
		$capacity = $re['capacity'];
		$status = $re['newstat'];
		$count++;
     
      
      ?>
      <h4>DateTime:</h4><h5><?php echo $date; ?></h5><br>
	  <h4>Table Name:</h4><h5><?php  echo $table; ?></h5><br>
	  <h4>Capacity:</h4><h5><?php echo $capacity; ?></h5><br>
      <?php
	  if($status = 0){
	?> 
	  
	  <h4>Status:</h4><h5>Confirmed</h5><br>
	<?php
	 }else if($status = 1){
         ?>
	  <h4>Status:</h4><h5>Unconfirmed</h5><br>
         <?php
     } else if($status = 2){
        ?>
     <h4>Status:</h4><h5>Cancelled</h5><br>
     <?php }
	 else{
	  ?>
	 	<h4>No Reservation</h4> 
       <?php } }  ?>
       
       <form method="POST">
		<input type="hidden" value="<?php echo $booking_id;?>" name="booking_id">
		<button type="submit" name="cancel" class="btn btn-primary">Cancel Reservation</button>
		</form>
        
              </div>
            </div>
          </div>
        </form> 
      </div>
    </section>

    
    

    <?php include 'template/footer.php'; ?>

    <?php include 'template/script.php'; ?>
    
  </body>
<?php
  if(isset($_POST['cancel'])){
	//echo "<script>alert(".$_POST['booking_id'].")</script>";
	$book_id=$_POST['booking_id'];
	$sql ="UPDATE tbl_booking SET status='2' WHERE booking_id= '$book_id' ";
    $result = $con->query($sql);

    $sql ="Select * from tbl_booked_table WHERE booking_id= '$book_id' ";
    $result = $con->query($sql);
    foreach ($result as $r){
        $td = $r['table_id'];
        $sql ="UPDATE tbl_table SET status='1' WHERE table_id= '$td' ";
        $result = $con->query($sql);
        if(!$result){
            echo '<script> alert("Error"); </script>';
        }
    }
    
   


	if($result){
	echo '<script> alert ("Reservation Cancelled"); </script>';
	 header("Location:reservation.php");
	}
	else{
	echo '<script> alert("Error"); </script>';
    }
    


}

?>

</html>


