<!-- table-add.php -->
<?php include 'template/header.php'; 
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="login.php"</script>';
}

?>
<body>
		<section class="body">

			<!-- start: header -->
			<?php include 'template/top-bar.php'; ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include 'template/left-bar.php'; ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Profile</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Profile</span></li>
								<li><span>View</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Profile</h2>

										<p class="panel-subtitle">
											 Check and <code>Update</code> profile.
										</p>
										<tbody>
										<?php
										$count = 1;
										$c=0;
										include 'dbCon.php';
										$con = connect();
										$user_id = $_SESSION['id'];
										$sql = "SELECT * FROM tbl_user where user_id ='$user_id'";
										$result = $con->query($sql);
										foreach ($result as $r) {
											$status = $r['status'];
											if ($status == 1){
												$stat = 'AVAILABLE';
											}else{
												$stat = 'UNAVAILABLE';
											}

											foreach ($result as $p) {
												$position = $r['position'];
												if ($position == 1){
													$pos = 'ADMIN';
												
												}
												else{
													$pos = 'USER';
												}
											}
											

										?>

										
										
											

 <!-- Button trigger modal -->


	  <!-- ajhbsjhvukehjnkjqbdkhubqnckmzxbchubefkqnejqlnnjnhsvv -->
	  <form action ="manage-update.php" method="POST">
		<!-- ajhbsjhvukehjnkjqbdkhubqnckmzxbchubefkqnejqlnnjnhsvv -->									

		<div class="panel-body">
     
		<div class="form-group">
			<label for="user_id">User ID # <td><?php echo $r['user_id']; ?></td></label>
			<input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $r['user_id']; ?>" placeholder="User ID">

			<label for="position">Position #<td><?php echo $r['position']; ?></td></label>
			
			<input type="hidden" class="form-control" id="position" name="position" value="<?php echo $r['position']; ?>" placeholder="Position">
		</div>
		


		<div class="form-group">
			<label for="fullname">Full Name</label>
			<input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $r['fullname']; ?>" placeholder="Full Name">
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" name="username" value="<?php echo $r['username']; ?>" placeholder="Username">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $r['email']; ?>" placeholder="Email">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="text" class="form-control" id="password" name="password" value="<?php echo $r['password']; ?>" placeholder="Password">
		</div>
		<div class="form-group">
			<label for="gender">Gender</label>
			<input type="text" class="form-control" id="gender" name="gender" value="<?php echo $r['gender']; ?>" placeholder="Gender">
		</div>
		<div class="form-group">
			<label for="address">Address</label>
			<input type="text" class="form-control" id="address" name="address" value="<?php echo $r['address']; ?>" placeholder="Address">
		</div>
		
		<div class="form-group">
			<label for="image_path">Image</label>
			<input type="file" class="form-control" id="image_path" name="image_path" value="<?php echo $r['image_path']; ?>" placeholder="Image">
		</div>
		<div class="form-group">
			<label for="status">Status</label>
			<select  name="status" value="<?php echo $r['status']; ?>" >
		<option value="0" id="status" >Available</option>
		<option value="1" id="status" >Unavailable</option>
			</select>
			<!-- <input type="text" class="form-control" id="status" placeholder="Status"> -->
		</div>
      </div>
      <div class="form-group">
		<button type="submit" name="updateuser" id="updateuser" class="btn btn-primary">Save changes</button>	
	  </div>
	  
    </div>
  </div>
</div>
</form>

										
										<?php $count++; } ?>
									</tbody>
								
							</div>
						</section>
						
						
				</section>
			</div>

			<?php include 'template/right-bar.php'; ?>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<!-- <script>
		$(document).ready(function(){
			
			
			$tr = $(this).closest('tr');

			var data = $tr.children("td").map(function(){
				return $(this).text();
			}).get();
			
			console.log(data);

			$('#user_id').val(data[0]);
			$('#user_id2').val(data[0]);
			$('#fullname').val(data[1]);
			$('#username').val(data[2]);
			$('#email').val(data[3]);
			$('#password').val(data[4]);
			$('#gender').val(data[5]);
			$('#address').val(data[6]);
			$('#position').val(data[7]);
			$('#image_path').val(data[8]);
			$('#status').val(data[9]);  
			});
		});
	</script> -->


	</body>
