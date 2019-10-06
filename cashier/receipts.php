<?php include 'header.php'; 
session_start();
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="/login"</script>';
} ?>

<body ng-app="cashierApp">
	<section class="body">

		<?php include 'top-bar.php' ?>

		<div class="inner-wrapper">
			<aside id="sidebar-left" class="sidebar-left">
				<div class="sidebar-header">
					<div class="sidebar-title">
						Navigation
					</div>
					<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<div class="nano has-scrollbar">
					<div class="nano-content" tabindex="0" style="right: -15px;">
						<nav id="menu" class="nav-main" role="navigation">
							<ul class="nav nav-main">
								<li>
									<a href="tables.php">
										<i class="fa fa-book" aria-hidden="true"></i>
										<span>Tables</span>
									</a>
								</li>
								<li>
									<a href="booking.php">
										<i class="fa fa-book" aria-hidden="true"></i>
										<span>Booking</span>
									</a>
								</li>
								<li class="nav-active">
									<a href="receipts.php">
										<i class="fa fa-book" aria-hidden="true"></i>
										<span>Receipts</span>
									</a>
								</li>
							</ul>
						</li>
							</ul>
						</nav>

						<hr class="separator">
					</div>

					<div class="nano-pane" style="display: none; opacity: 1; visibility: visible;">
						<div class="nano-slider" style="height: 578px; transform: translate(0px, 0px);"></div>
					</div>
				</div>
			</aside>
			<section role="main" class="content-body">
				<header class="page-header">
					<h2>Receipts</h2>

					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="/cashier/dashboard">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Receipts</span></li>
						</ol>

						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>

				<!-- start: page -->
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<!-- <a id="buttonAdd" class="fa fa-plus datatable-addbtn"></a> -->
							<a href="#" class="fa fa-caret-down"></a>
						</div>

						<h2 class="panel-title">List of receipts</h2>
					</header>
					<div class="panel-body">
						<table class="table table-bordered table-striped mb-none" id="table_id" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
							<thead>
								<tr>
									<th>Receipt Id</th>
									<th>Full Name</th>
									<th>DateTime</th>
									<th>Total</th>
									<th>Discount</th>
									<th>Table Name</th>
									<th>Status</th>
								</tr>
							</thead>
							</tbody>
						</table>
					</div>
				</section>
				<!-- end: page -->
			</section>
		</div>
	</section>
	
	<?php include 'script-res.php' ?>
	<script src="../js/cashier/receipts.js"></script>

</body>

</html>