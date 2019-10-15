<?php include 'template/header.php';
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="../login.php"</script>';
}

?>
<link rel="stylesheet" href="../build/admin/dashboard/bundle.css">

<style>
@media print {
  header, #sidebar-left, .card-hide, .myCard-btns {
    display: none !important;
  }
  canvas {
	  width: 100% !important;
  }
  .panel {
	  margin-top: -100px;
	  margin-left: -40px;
  }
}
</style>
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
					<h2>Sales Report</h2>

					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="index.php">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Dashboard</span></li>
						</ol>

						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>

				<!-- start: page -->

				<section class="panel">
					<div class="myCard card-hide">
						<h2 class="myCard-title" style="margin-top: 0;">Today Sales Chart</h2>
						<div class="myCard-content" style="text-align:center; display: none;">
							<canvas id="todaySalesChart"></canvas>
							<h2 id="totalSales" style="font-weight: 700;"></h1>
						</div>
					</div>
					<div class="myCard card-hide">
						<h2 id="month_title" class="myCard-title" style="margin-top: 0;"></h2>
						<div class="myCard-content" style="display: none;">
							<canvas id="salesChart"></canvas>
						</div>
					</div>
					<div class="myCard card-hide">
						<h2 class="myCard-title" style="margin-top: 0;">Custom Sales Report</h2>
						<div class="myCard-content" style="display: none;">
							<div class="content-center">
								<label style="font-weight: 700; margin: 0 1rem;">From</label>
								<input id="datefrom" class="myInput-control" onclick="onDateFromChange(this)"
								 type="date" style="width: 15rem;">
								<label style="font-weight: 700; margin: 0 1rem;">To</label>
								<input id="dateto" class="myInput-control" onclick="onDateToChange(this)"
								 type="date" style="width: 15rem;">
								 <br>
								 <button id="generateReport" type="button" onclick="generateCustomReport(this)" 
									 class="myBtn" style="margin-left: 1rem;" 
									 disabled>Generate Report</button>
							</div>
							<canvas id="customChart"></canvas>
						</div>
					</div>
					<section class="panel">
					<div class="myCard card-hide">
						<h2 class="myCard-title" style="margin-top: 0;">Tabular Report</h2>
						<div class="myCard-content" style="display: none;">
							<div class="content-center">
								<form action="index.php" method="GET">
									<label style="font-weight: 700; margin: 0 1rem;">From</label>
									<input id="date_from_tab" name="date_from" class="myInput-control" onclick="onDateFromChangeTabular()" type="date" style="width: 15rem;"
									 value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : '' ?>">
									<label style="font-weight: 700; margin: 0 1rem;">To</label>
									<input id="date_to_tab" name="date_to" class="myInput-control" onclick="onDateToChangeTabular()" type="date" style="width: 15rem;"
									 value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : '' ?>">
									<button type="submit" class="myBtn" style="margin-left: 1rem;">Generate Report</button>
								</form>
							</div>
							<hr>
							<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<th>No</th>
										<th>Customer</th>
										<th>Waiter</th>
										<th>DateTime</th>
										<th>Menu</th>
										<th>Quantity</th>
										<th>Total</th>
										<th>Table Name</th>
									</thead>
									<tbody>
										<?php
											require_once('../Models/Receipt.php');
											$receipt = new Receipt;
											$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : false;
											$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : false;
											$result = $receipt->getTabularReportData($date_from, $date_to);
											foreach ($result as $r) {
												echo '<tr>';
												echo '<td>'.$r['order_id'].'</td>';
												echo '<td>'.$r['fullname'].'</td>';
												echo '<td>'.$r['waiter'].'</td>';
												echo '<td>'.date_format(date_create($r['date_ordered']), 'M d, Y h:s A').'</td>';
												echo '<td>'.$r['name'].'</td>';
												echo '<td>'.$r['quantity'].'</td>';
												echo '<td>'.$r['total'].'</td>';
												echo '<td>'.$r['table_name'].'</td>';
												echo '</tr>';
											}
										?>
									</tbody>
							</table>
						</div>
					</div>
				</section>

				<!-- end: page -->
			</section>
		</div>

		<?php include 'template/right-bar.php'; ?>
	</section>
	<script type="text/javascript">
		function Done() {
			return confirm("Are you sure?");
		}
	</script>

	<?php include 'template/script-res.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script src="../libraries/moment.js"></script>
	<script src="../js/employee/myCard.js"></script>
	<script src="../js/requestpath.js"></script>
	<script src="../js/admin/chart.js"></script>
</body>

</html>
