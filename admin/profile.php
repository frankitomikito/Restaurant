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

								<h2 class="panel-title" style="margin-bottom: 1rem;">Profile</h2>
								<tbody>
									<?php
									$count = 1;
									$c = 0;
									include 'dbCon.php';
									$con = connect();
									$user_id = $_SESSION['id'];
									$sql = "SELECT * FROM tbl_user where user_id ='$user_id'";
									$result = $con->query($sql);
									foreach ($result as $r) {
										$status = $r['status'];
										if ($status == 1) {
											$stat = 'AVAILABLE';
										} else {
											$stat = 'UNAVAILABLE';
										}

										foreach ($result as $p) {
											$position = $r['position'];
											if ($position == 1) {
												$pos = 'ADMIN';
											} else {
												$pos = 'USER';
											}
										}


										?>





										<!-- Button trigger modal -->


										<!-- ajhbsjhvukehjnkjqbdkhubqnckmzxbchubefkqnejqlnnjnhsvv -->
										<form action="manage-update.php" method="POST" enctype="multipart/form-data">
											<!-- ajhbsjhvukehjnkjqbdkhubqnckmzxbchubefkqnejqlnnjnhsvv -->


											<div class="panel-body">

											
											<div class="row" style="margin: 1rem;">
												<div class="col-md-12" style="text-align: center;">
													<img id="prof_image" src="../<?php echo $_SESSION['image_path'] ?>" alt="Admin Profile" style="height: 12rem; width: 12rem; border-radius: 50%;">
												</div>
												<div class="col-md-12" style="text-align: center; margin: 1rem 0;">
													<button type="button" class="btn btn-primary" onclick="uploadImage()">Upload</button>
												</div>
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
													<input type="hidden" name="old_password" value="<?php echo $r['password']; ?>">
													<input type="password" class="form-control" id="password" name="password" value="<?php echo $r['password']; ?>" placeholder="Password">
												</div>
												<div class="form-group">
													<label>Gender</label>
													<select name="gender" style="width: 100%;">
														<option value="1" <?php if ($r['gender'] == 1) echo 'selected' ?>>Male</option>
														<option value="0" <?php if ($r['gender'] == 0) echo 'selected' ?>>Female</option>
													</select>
												</div>
												<div class="form-group">
													<label for="address">Address</label>
													<input type="text" class="form-control" id="address" name="address" value="<?php echo $r['address']; ?>" placeholder="Address">
												</div>
												
												<input type="file" onchange="onImageChange(this.files)" class="form-control" id="image_path" name="image_path" placeholder="Image" style="display: none;">
												<input type="hidden" name="status" value="<?php echo $r['status']; ?>">
												<input type="hidden" name="user_id" value="<?php echo $r['user_id']; ?>">
											</div>
											<div class="form-group" style="text-align: center;">
												<button type="submit" name="updateuser" id="updateuser" class="btn btn-primary" style="margin: 1rem;">Save changes</button>
											</div>

					</div>
				</div>
		</div>
		</form>


	<?php $count++;
	} ?>
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

	<script>
		function uploadImage() {
			document.getElementById('image_path').click();
		}
		function onImageChange(file) {
			if (file && file[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					document.getElementById('prof_image').setAttribute('src', e.target.result);
				};
				reader.readAsDataURL(file[0]);
			}
		}
	</script>

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