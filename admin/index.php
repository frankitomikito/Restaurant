<!-- booking-list.php -->
<?php include 'template/header.php';
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="/login"</script>';
}

?>
<link rel="stylesheet" href="../build/admin/dashboard/bundle.css">

<style>
@media print {
  header, #sidebar-left {
    display: none !important;
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
					<div class="myCard">
						<h2 class="myCard-title" style="margin-top: 0;">Today Sales Chart</h2>
						<div class="myCard-content" style="text-align:center;">
							<canvas id="todaySalesChart"></canvas>
							<h2 id="totalSales" style="font-weight: 700;"></h1>
						</div>
					</div>
					<div class="myCard">
						<h2 id="month_title" class="myCard-title" style="margin-top: 0;"></h2>
						<div class="myCard-content">
							<canvas id="salesChart"></canvas>
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
	<script src="../js/admin/chart.js"></script>
</body>

</html>
