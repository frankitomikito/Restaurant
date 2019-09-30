<aside id="sidebar-left" class="sidebar-left">

	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
					<li class="nav-active">
						<a href="index.php">
							<i class="fa fa-home" aria-hidden="true"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<?php if ((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)) { ?>
						<li>
							<a href="/admin/employee">
								<i class="fa fa-users" aria-hidden="true"></i>
								<span>Employee</span>
							</a>
						</li>
						<li class="nav-parent">
							<a>
								<i class="fas fa-tablets" aria-hidden="true"></i>
								<span>Restaurant Table</span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a href="table-add.php">
										<span class="pull-right label label-primary">add</span>
										<i class="fa fa-plus-square" aria-hidden="true"></i>
										<span>Table Add</span>
									</a>
								</li>
								<li>
									<a href="table-list.php">
										<span class="pull-right label label-info">list</span>
										<i class="fas fa-list-ul" aria-hidden="true"></i>
										<span>Table List</span>
									</a>
								</li>
							</ul>
						</li>
					<?php } ?>
					<?php if ((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)) { ?>
						<li class="nav-parent">
							<a>
								<i class="fas fa-utensils-alt" aria-hidden="true"></i>
								<span>Category</span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a href="category-add.php">
										<span class="pull-right label label-primary">add</span>
										<i class="fa fa-plus-square" aria-hidden="true"></i>
										<span>Category Add</span>
									</a>
								</li>
								<li>
									<a href="category-list.php">
										<span class="pull-right label label-info">list</span>
										<i class="fas fa-list-ul" aria-hidden="true"></i>
										<span>Category List</span>
									</a>
								</li>
							</ul>
						</li>
					<?php } ?>
					<?php if ((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)) { ?>
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
										<span>Menu Add</span>
									</a>
								</li>
								<li>
									<a href="menu-list.php">
										<span class="pull-right label label-info">list</span>
										<i class="fas fa-list-ul" aria-hidden="true"></i>
										<span>Menu List</span>
									</a>
								</li>
							</ul>
						</li>
					<?php } ?>
					<?php if ((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)) { ?>
						<li class="nav-parent">
							<a>
								<i class="fas fa-money-check-alt" aria-hidden="true"></i>
								<span>Booking</span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a href="booking-list.php">
										<span class="pull-right label label-info">list</span>
										<i class="fas fa-list-ul" aria-hidden="true"></i>
										<span>Booking List</span>
									</a>
								</li>
							</ul>
						</li>
					<?php } ?>

					<?php if ((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)) { ?>
						<!-- <li class="nav-parent">
							<a>
								<i class="fas fa-utensils-alt" aria-hidden="true"></i>
								<span>User</span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a href="user-add.php">
										<span class="pull-right label label-primary">add</span>
										<i class="fa fa-plus-square" aria-hidden="true"></i>
										<span>User Add</span>
									</a>
								</li>
								<li>
									<a href="user-list.php">
										<span class="pull-right label label-info">list</span>
										<i class="fas fa-list-ul" aria-hidden="true"></i>
										<span>User List</span>
									</a>
								</li>
							</ul>
						</li> -->
					<?php } ?>
					<?php if ((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)) { ?>
						<li class="nav-parent">
							<a>
								<i class="fas fa-money-check-alt" aria-hidden="true"></i>
								<span>Profile</span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a href="profile.php">
										<span class="pull-right label label-info">Profile</span>
										<i class="fas fa-list-ul" aria-hidden="true"></i>
										<span>Profile</span>
									</a>
								</li>
							</ul>
						</li>
					<?php } ?>
				</ul>
			</nav>

			<hr class="separator" />
		</div>

	</div>

</aside>