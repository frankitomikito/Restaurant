<!-- booking-list.php -->
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
								<li><span>Tables</span></li>
								<li><span>Booking List</span></li>
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
						
								<h2 class="panel-title">All Bookings</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Booking ID</th>
											<th>Check in</th>
											<th>User ID</th>
											<th>Status</th>
											<th>Table ID</th>
											
											
											
											<th class="hidden-phone">Approve</th>
											<th class="hidden-phone">Reject</th>
											<th class="hidden-phone">View</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										include 'dbCon.php';
										$con = connect();
										$res_id = $_SESSION['id'];
										$sql = "SELECT *, time(check_in) as booktime FROM `tbl_booking` inner join tbl_booked_table on tbl_booking.booking_id=tbl_booked_table.booking_id;";
										$result = $con->query($sql);
										foreach ($result as $r) {
											$status = $r['status'];
											if ($status == 1){
												$stat = 'CONFIRMED';
											}else{
												$stat = 'REJECTED';
											}
										?>
										<tr class="gradeX">
											<td class="center hidden-phone"><?php echo $r['booking_id']; ?></td>
											<td class="center hidden-phone"><?php echo $r['check_in']; ?></td>
											<td><?php echo $r['user_id']; ?></td>
											<td><?php echo $stat ?></td>
											<td><?php echo $r['table_id']; ?></td>
					
												<td><a href="approve-reject.php?bapprove_id=<?php echo $r['booking_id']; ?>" class="btn btn-success" >Confirm</a>	</td>
												<td><a href="approve-reject.php?breject_id=<?php echo $r['booking_id']; ?>" class="btn btn-danger" >Reject</a>		</td>
											
											<td class="center hidden-phone">
												<a href="invoice.php?booking-number=<?php echo $r['booking_id']; ?>" class="btn btn-primary">View</a>
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

		<?php include 'template/script-res.php'; ?>
	</body>
</html>