<?php include 'header.php' ?>
<body ng-app="employeeApp">
	<section class="body">
		<header class="header">
				<div class="logo-container">
					<a href="index.php" class="logo">
						Tak-Ang Restaurant
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
					
					<span class="separator"></span>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="../dashboard/assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg">
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
								<span class="name">Emmanuel Paul G. Moralde</span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<!-- <li>
									<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li> -->
								<li>
									<a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>

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
										<a href="/dashboard/">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="nav-active">
										<a href="index.php">
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Employee</span>
										</a>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fas fa-tablets" aria-hidden="true"></i>
											<span>Restaurant Table</span>
										</a>
										<ul class="nav nav-children" style="">
											<li>
												<a href="table-add.php">
													<span class="pull-right label label-primary">add</span>
													<i class="fa fa-plus-square" aria-hidden="true"></i>
													<span>Table</span>
												</a>
											</li>
											<li>
												<a href="table-list.php">
													<span class="pull-right label label-info">list</span>
													<i class="fas fa-list-ul" aria-hidden="true"></i>
													<span>Table</span>
												</a>
											</li>
										</ul>
									</li>
																			<li class="nav-parent">
										<a>
											<i class="fas fa-utensils-alt" aria-hidden="true"></i>
											<span>Menu Item</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="menu-add.php">
													<span class="pull-right label label-primary">add</span>
													<i class="fa fa-plus-square" aria-hidden="true"></i>
													<span>Menu</span>
												</a>
											</li>
											<li>
												<a href="menu-list.php">
													<span class="pull-right label label-info">list</span>
													<i class="fas fa-list-ul" aria-hidden="true"></i>
													<span>Menu</span>
												</a>
											</li>
										</ul>
									</li>
																			<li class="nav-parent">
										<a>
											<i class="fas fa-money-check-alt" aria-hidden="true"></i>
											<span>Booking &amp; Payment</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="booking-list.php">
													<span class="pull-right label label-info">list</span>
													<i class="fas fa-list-ul" aria-hidden="true"></i>
													<span>Booking</span>
												</a>
											</li>
										</ul>
									</li>
									 
								</ul>
							</nav>

							<hr class="separator">
						</div>

					<div class="nano-pane" style="display: none; opacity: 1; visibility: visible;"><div class="nano-slider" style="height: 578px; transform: translate(0px, 0px);"></div></div></div>
				</aside>
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
	<?php include 'script-res.php' ?>
	<script type="module" src="../js/employee/classes/Users.js"></script>
	<script type="module" src="../js/employee/employee.js"></script>

</body>
</html>