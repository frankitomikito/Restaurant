<?php include 'header.php';
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="/login"</script>';
} ?>
<style>
	.print-left {
		display: none !important;
	}

	@media print {
		header,
		#sidebar-left,
		.panel {
			display: none !important;
		}
		
		#myModal {
			display: block !important;
		}

		#myModalContainer {
			display: none !important;
		}

		.print-left {
			display: block !important;
			position: fixed;
			top: 0;
			left: 0;
			width: 50vw;
		}
	}
</style>

<body ng-app="cashierApp">
	<link rel="stylesheet" href="../build/cashier/cashier-bundle.css">
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
								<li class="nav-active">
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
								<li>
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
					<h2>Tables</h2>

					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="/cashier/dashboard">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Tables</span></li>
						</ol>

						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>
 
				<!-- start: page -->
				<section class="panel" style="display: block;">
					<header class="panel-heading">
						<div class="panel-actions">
							<!-- <a id="buttonAdd" class="fa fa-plus datatable-addbtn"></a> -->
							<a href="#" class="fa fa-caret-down"></a>
						</div>

						<h2 class="panel-title">List of tables</h2>
					</header>
					<div class="panel-body">
						<table class="table table-bordered table-striped mb-none" id="table_id" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
							<thead>
								<tr>
									<th>Table Id</th>
									<th>Table Name</th>
									<th>Capacity</th>
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

	<div ng-controller="ModalController" id="myModal" class="mymodal closed" style="display: none;">
		<section class="print-left">
			<div class="receipt-order">
					<div class="receipt-order--header">
						Order Slip
						<div class="receipt-order--header--date">
							<span>Date:</span>
							{{todays_date}}
						</div>
					</div>
					<div class="receipt-order--information">
						<ul>
							<li>
								Ordered By: {{customer_info.fullname}}
							</li>
							<li>
								Address: {{customer_info.address}}
							</li>
							<li>
								<span>Via: </span> Salesman: <span class="salesman">{{waiter_info.fullname}}</span>
							</li>
						</ul>
					</div>
					<table class="receipt-order--orders">
						<thead>
							<th>Qty</th>
							<th>Unit</th>
							<th>Description of articles</th>
							<th>Unit Price</th>
							<th>Amount</th>
						</thead>
						<tbody>
							<tr ng-repeat="order in orders">
								<td>{{order.quantity}}</td>
								<td>Set</td>
								<td>{{order.name}}</td>
								<td>₱{{order.price}}</td>
								<td>₱{{order.quantity * order.price}}</td>
							</tr>
						</tbody>
					</table>
					<div class="receipt-order--footer">
						<ul>
							<li>
								<span class="greetings">Thank You, Come Again!</span>
								<span class="orders-total">Total ☞	₱ {{totalPrice()}}</span>
							</li>
							<li>
								<span>
									<strong>NOTE:</strong> This Order Slip at the same time
									serves as a temporary invoice. Our official invoice will be issued
									upon the return of this receipt and fully signed by the customers.
								</span>
								<span class="customer-signature">
									 Received in good order and condition the above described merchandise.
									 <span>Customer's Signature</span>
								</span>
								<span class="receipt-no">No.{{orders[0].order_id}}</span>
							</li>
						</ul>
					</div>
				</div>
		</section>
		<div id="myModalContainer" class="mymodal-container">
			<div class="mymodal-header">
				<h1>Orders</h1>
			</div>
			<hr>
			<div class="mymodal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="card-order" ng-repeat="order in orders">
							<img src="../admin/item-image/{{order.image_path}}" alt="menu">
							<h4 class="order-title">
								{{order.name}} <br>
								<span>Quantity: {{order.quantity}}</span>
							</h4>
							<h3 class="order-price">₱ {{order.quantity * order.price}}</h3>
						</div>
						<hr>
					</div>
					<div class="col-lg-12" style="text-align: left; margin-top: -1rem;">
						<h4 style="font-weight: 700; color: black; display: inline-block;">Cash: </h4>
						<input type="number" ng-model="cash" class="myInput-control" style="font-weight: 700; width: 20rem; margin-left: 1rem; color: black; font-size: 1.8rem;" min="0" />
						<h4 style="font-weight: 700; color: black; margin-top: -.1rem;">Total Price: ₱ {{totalPrice()}}</h4>
						<h4 style="font-weight: 700; color: black; margin-top: -.1rem;">Change: ₱ {{cashChange(cash)}}</h4>
					</div>
				</div>
			</div>
			<div class="mymodal-footer">
				<button id="buttonCancel" ng-click="closeModal()" class="myBtn">Cancel</button>
				<button class="myBtn" ng-click="onPaid()">Paid</button>
			</div>
		</div>
	</div>

	<?php include 'script-res.php' ?>
	<script src="../js/angular.js"></script>
	<script src="../js/employee/classes/Modal.js"></script>
	<script src="../libraries/moment.js"></script>
	<script src="../js/requestpath.js"></script>
	<script src="../js/cashier/tables.js"></script>

</body>

</html>