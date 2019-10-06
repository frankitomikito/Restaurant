<!-- table-list.php -->
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
						<h2>Users</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>User</span></li>
								<li><span>User List</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						
						
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">All Users</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>User ID</th>
											<th>Fullname</th>
											<th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Position</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										$c=0;
										include 'dbCon.php';
										$con = connect();
										$user_id = $_SESSION['id'];
                                        $sql = "SELECT * FROM tbl_user";
                                       // $sql2 = "SELECT * FROM tbl_user where user_id ='$user_id'";
                                        $result = $con->query($sql);
                                        $result2 = $con->query($sql);
										foreach ($result as $r) {
											$status = $r['status'];
											if ($status == 1){
												$stat = 'Active';
											}else{
												$stat = 'Inactive';
											}

											
										?>
										
										<tr class="gradeX">
										    <td><?php echo $r['user_id']; ?></td>	
											<td><?php echo $r['fullname']; ?></td>
                                            <td><?php echo $r['username']; ?></td>
                                           
                                            <td><?php echo $r['email']; ?></td>
                                            <td><?php echo $r['password']; ?></td>
                                            <td><?php echo $r['gender']; ?></td>
                                            <td><?php echo $r['address']; ?></td>
                                            <td><?php echo $r['position']; ?></td>
                                            <td class="center hidden-phone">
												<figure class="image rounded">
													<img style="height: 50px;width: 50px;border-radius: 10px;    border: 1px solid darkgray;" src="item-image/<?php echo $r['image_path']; ?>" alt="No Image" >
												</figure>
											</td>
											<td><?php echo $stat ?></td>
											
                                            <td>
 <!-- Button trigger modal -->
<button type="button" class="btn btn-success editbtn" data-toggle="modal" data-target="#exampleModalLong">Edit</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>

	  <!-- ajhbsjhvukehjnkjqbdkhubqnckmzxbchubefkqnejqlnnjnhsvv -->
	  <form action ="manage-update.php" method="POST">
		<!-- ajhbsjhvukehjnkjqbdkhubqnckmzxbchubefkqnejqlnnjnhsvv -->									

      <div class="modal-body">
		<div class="form-group">
			<label for="user_id">Table_id</label><br>
			<input type="text" class="form-control" id="user_id2" disabled="true">
			<input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $r['user_id']; ?>" placeholder="User ID">
		</div>
		<div class="form-group">
			<label for="fullname">Fullname</label>
			<input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $r['fullname']; ?>" placeholder="Fullname">
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
            <textarea name="address" id="address" cols="30" rows="2" class="form-control" id="address" value="<?php echo $r['address']; ?>" placeholder="Restaurant Address"></textarea>
			<!-- <input type="text" class="form-control" id="address" name="address" value="<?php// echo $r['address']; ?>" placeholder="Address"> -->
		</div>
		<div class="form-group">
			<label for="position">Position</label>
			<input type="text" class="form-control" id="position" name="position" value="<?php echo $r['position']; ?>" placeholder="Position">
        </div>
        <div class="form-group">
	<label class="control-label">Image</label>
	<input type="file" name="image_path" class="form-control"  value="<?php echo $r['image_path']; ?>" required="">
	</div>
		<div class="form-group">
			<label for="status">Status</label>
			<select  name="status"  id="status" value="<?php echo $r['status']; ?>" >
		<option value="1" >Active</option>
		<option value="0"  >Inactive</option>
			</select>
			<!-- <input type="text" class="form-control" id="status" placeholder="Status"> -->
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="submit" name="userupdate" id="updatedata" class="btn btn-primary">Save changes</button>	
	  </div>
	  
    </div>
  </div>
</div>
</form>
</td>
										</tr>
										<?php $count++; } ?>
									</tbody>
								</table>
							</div>
						</section>
						
						
					<!-- end: page -->
				</section>
			</div>

			<?php include 'template/right-bar.php'; ?>
		</section>
		<script type="text/javascript">
	       function Done(){
	         return confirm("Are you sure?");
	       }
   		</script>
		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>

		<script src="js/bootstrap.min.js"></script>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<script>
		$(document).ready(function(){
			$('.editbtn').on('click', function(){
				$('#exampleModalLong').modal('show');
			
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
	</script>
		
	</body>
</html>