<!-- nav-bar.php -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  	<div class="container">
	    <a class="navbar-brand" href="/">Tak-Ang Restaurant</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="oi oi-menu"></span> Menu
	    </button>

	    <div class="collapse navbar-collapse" id="ftco-nav">
	      <ul class="navbar-nav ml-auto">
	        <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
			<?php if(!isset($_SESSION['isLoggedIn'])){ ?>
			
	        <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
			<?php } elseif (isset($_SESSION['isLoggedIn'])) { ?>
			<li class="nav-item"><a href="myreservation.php" class="nav-link" >My Reservation</a></li>
	        <li class="nav-item"><a href="logout.php" class="nav-link"><?php echo $_SESSION['name']; ?>(Logout)</a></li>
	        <?php } ?>
	      </ul>
	    </div>
	  </div>
</nav>



 <!-- <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">My Reservation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div> -->
	  
	  <?php
	 // include 'dbCon.php';
	//   if(isset($_SESSION['id'])){
	// 	//echo '<script>alert("'.$_SESSION['id'].'")</script>';
	// 	$userid=$_SESSION['id'];
	//   }
	//   $count=0;
	 
	//   $con = connect();
	//   $sql = "Select * from tbl_booking inner join tbl_booked_table on tbl_booking.booking_id=tbl_booked_table.booking_id inner join tbl_table on tbl_table.table_id=tbl_booked_table.table_id  where user_id='$userid' and tbl_booking.status = 0 ;";
	//   $result = $con->query($sql);
	//   foreach($result as $re){
	// 	$booking_id = $re['booking_id'];
	// 	$date = $re['check_in'];
	// 	$table = $re['table_name'];
	// 	$capacity = $re['capacity'];
	// 	$status = $re['status'];
	// 	$count++;
	//   } 
	//   if($count > 0){
	?> 
	 <!-- <div class="modal-body">
	  <h4>DateTime:</h4><h5><?php //echo $date; ?></h5><br>
	  <h4>Table Name:</h4><h5><?php  //echo $table; ?></h5><br>
	  <h4>Capacity:</h4><h5><?php //echo $capacity; ?></h5><br>
	  <h4>Status:</h4><h5>Unconfirmed</h5><br> -->
	<?php
	//  }
	//  else{
	  ?>
	 	<!-- <h4>No Reservation</h4> -->
	  <!-- <?php //} ?>
	</div>
      <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<form method="POST">
		<input type="hidden" value="<?php //echo $booking_id;?>" name="booking_id">
		<button type="submit" name="cancel" class="btn btn-primary">Cancel Reservation</button>
		</form>
	  </div>
	  
    </div>
  </div>
</div> -->

<?php

// if(isset($_POST['cancel'])){
// 	//echo "<script>alert(".$_POST['booking_id'].")</script>";
// 	$book_id=$_POST['booking_id'];
// 	$sql ="UPDATE tbl_booking SET status='2' WHERE booking_id= '$book_id' ";
// 	$result = $con->query($sql);

// 	if($result){
// 	echo '<script> alert ("Reservation Cancelled"); </script>';
// 	 header("Location:reservation.php");
// 	}
// 	else{
// 	echo '<script> alert("Error"); </script>';
// 	}

// }

?>