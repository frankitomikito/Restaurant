<?php include 'header.php';
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="/login"</script>';
} ?>

<body ng-app="employeeApp">
	<section class="body">

		<?php include 'top-bar.php' ?>

		<div class="inner-wrapper">
            <?php include 'template/left-bar.php'; ?>
			<section role="main" class="content-body">
				<header class="page-header">
					<h2>Employee</h2>

					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="index.php">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Employee</span></li>
						</ol>

						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>

				<!-- start: page -->
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a id="buttonAdd" class="fa fa-plus datatable-addbtn"></a>
							<a href="#" class="fa fa-caret-down"></a>
						</div>

						<h2 class="panel-title">List of employees</h2>
					</header>
					<div class="panel-body">
						<table class="table table-bordered table-striped mb-none" id="datatable-tabletoolss" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
							<thead>
								<tr>
									<th>User Id</th>
									<th>Fullname</th>
									<th>Email</th>
									<th>Gender</th>
									<th>Address</th>
									<th>Position</th>
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

	<div ng-controller="modalCtrl" id="myModal" class="mymodal closed" style="display: none;">
		<div id="myModalContainer" class="mymodal-container">
			<div class="mymodal-header">
				<h1>Add Employee</h1>
			</div>
			<div class="mymodal-body">
				<form novalidate name="modalForm">
					<div class="row">
						<div class="col-md-12">
							<div class="mymodal-avatar">
								<img id="profileImg" src="../images/person_3.jpg">
								<input name="user_image" id="uploadImg" onchange="angular.element(this).scope().onImageChange(this.files)" type="file" style="display: none;">
								<button type="button" class="myBtn" ng-click="pickImage()" style="margin-top: 1rem;">Upload</button>
							</div>
						</div>
						<div class="col-md-12">
							<div class="myInput-container">
								<label class="floating-label active">Fullname</label>
								<input name="fullname" type="string" ng-model="user.fullname" class="myInput-control margin" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="myInput-container">
								<label class="floating-label active">Email</label>
								<input name="email" type="email" ng-model="user.email" class="myInput-control margin" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="myInput-container">
								<label class="floating-label active">Address</label>
								<input name="address" type="string" ng-model="user.address" class="myInput-control margin" required>
							</div>
						</div>
						<div class="col-md-12">
							<h5>Gender</h5>
							<label>
								<input name="gender" type="radio" ng-model="user.gender" value="1">
								Male
							</label>
							<label>
								<input name="gender" type="radio" ng-model="user.gender" value="0">
								Female
							</label>
						</div>
						<div class="col-md-12">
							<h5>Position</h5>
							<label>
								<input name="position" type="radio" ng-model="user.position" value="3">
								Chef
							</label>
							<label>
								<input name="position" type="radio" ng-model="user.position" value="4">
								Waiter
							</label>
							<label>
								<input name="position" type="radio" ng-model="user.position" value="5">
								Cashier
							</label>
						</div>
						<div class="col-md-12" ng-if="user.status">
							<h5>Status</h5>
							<label>
								<input name="status" type="radio" ng-model="user.status" value="1">
								Active
							</label>
							<label>
								<input name="status" type="radio" ng-model="user.status" value="0">
								InActive
							</label>
						</div>
					</div>
				</form>
			</div>
			<div class="mymodal-footer">
				<button id="buttonCancel" ng-click="onCancel()" class="myBtn">Cancel</button>
				<button class="myBtn" ng-if="!edit" ng-disabled="!modalForm.$valid" ng-click="onSubmit()">{{save_btn_text}}</button>
				<button class="myBtn" ng-if="edit" ng-disabled="!modalForm.$valid" ng-click="onUpdate()">Update</button>
			</div>
		</div>
	</div>
	<?php include 'script-res.php' ?>
	<!-- <script src="../build/admin/bundle.min.js"></script> -->
	<script src="../js/employee/classes/Users.js"></script>
	<script src="../js/employee/classes/Modal.js"></script>
	<script src="../js/requestpath.js"></script>
	<script src="../js/angular.js"></script>
	<script src="../js/employee/AngularJS/module.js"></script>
	<script src="../js/employee/AngularJS/modalctrl.js"></script>

</body>

</html>