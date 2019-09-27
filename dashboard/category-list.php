
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
						<h2>Table</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Category</span></li>
								<li><span>Category List</span></li>
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
						
								<h2 class="panel-title">All Category</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>No</th>
											<th>Catagory Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										include 'dbCon.php';
										$con = connect();
										$category_id = $_SESSION['id'];
										$sql = "SELECT * FROM tbl_category";
										$result = $con->query($sql);
										foreach ($result as $r) {
											$status = $r['status'];
											if ($status == 1){
												$stat = 'AVAILABLE';
											}else{
												$stat = 'UNAVAILABLE';
											}
										?>
										
										<tr class="gradeX">
										    <td><?php echo $r['category_id']; ?></td>	
											<td><?php echo $r['name']; ?></td>
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
  <label for="menu_id">Category ID</label><br>
	<input type="text" class="form-control" id="category_id2" name="category_id2" disabled="true" >
    <input type="hidden" class="form-control" id="category_id" name="category_id" value="<?php echo $r['category_id']; ?>" placeholder="Category ID" >
  </div>
  <div class="form-group">
	<label for="name">Category Name</label>
	<input type="text" class="form-control" id="name" name="name" value="<?php echo $r['name']; ?>" placeholder="Category Name">
  </div>
  <div class="form-group">

  <label for="status">Status</label>
	<select name="status" value="<?php echo $r['status']; ?>" >
	<option value="0" id="status" >Available</option>
		<option value="1" id="status" >Unavailable</option>
	</select>
	<!-- <input type="text" class="form-control" id="status" placeholder="Status"> -->
  </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="updatecategory" class="btn btn-primary">Save changes</button>
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


			$('#category_id').val(data[0]);
			$('#category_id2').val(data[0]);
			$('#name').val(data[1]);
			$('#status').val(data[2]);
			});
		});
	</script>
		
	</body>
</html>