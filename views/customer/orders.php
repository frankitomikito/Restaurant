<!-- reservation.php -->
<?php include 'template/header.php';

if (!isset($_SESSION['isLoggedIn'])) {
  echo '<script>alert("You need to login first.")</script>';
  echo '<script>window.location="login.php"</script>';
}

if (isset($_SESSION['id'])) {
  //echo '<script>alert("'.$_SESSION['id'].'")</script>';
  $_SESSION['userid'] = $_SESSION['id'];
}

?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" href="build/customer/bundle.css">

<body ng-app="myApp">
  <?php include 'template/nav-bar.php'; ?>
  <!-- END nav -->

  <section class="home-slider owl-carousel" style="height: 400px;">
    <div class="slider-item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
          <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Orders</span></p>
            <h1 class="mb-3">My Orders</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row no-gutters justify-content-center mb-5 pb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <h2>List of Orders</h2>
        </div>
      </div>
      <div class="col-lg-12">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Receipt Id</th>
              <th>Date Ordered</th>
              <th>Total</th>
              <th>Discount</th>
              <th>Table Name</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <div ng-controller="ModalController" id="myModal" class="mymodal closed" style="display: none;">
    <div id="myModalContainer" class="mymodal-container">
      <div class="mymodal-header">
        <h1 style="font-size: 2rem;">Order List</h1>
      </div>
      <div class="mymodal-body dish-menu">
        <div class="row">
          <div class="col-lg-12" ng-repeat="order in curr_orders">
            <div class="menus d-flex main-dish" style="margin-bottom: 10px; background: white !important;">
              <div class="menu-img" style="background-image: url(dashboard/item-image/{{order.image_path}});"></div>
              <div class="text d-flex">
                <div class="one-half">
                  <h3>{{order.name}}</h3>
                  <p>Quantity: {{order.quantity}}</p>
                </div>
                <div class="one-forth">
                  <span class="price">Php {{order.price * order.quantity}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12" style="text-align: right;">
            <h2>Total: PHP {{totalPrice(curr_orders)}}</h2>
          </div>
        </div>
      </div>
      <div class="mymodal-footer">
        <button id="buttonCancel" ng-click="closeModal()" class="myBtn" style="font-size: .9rem;">Close</button>
      </div>
    </div>
  </div>



  <?php include 'template/footer.php'; ?>

  <?php include 'template/script.php'; ?>

  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="../js/employee/classes/Modal.js"></script>
	<script src="../node_modules/angular/angular.js"></script>
	<script src="../js/customer/ordersctrl.js"></script>

</body>

</html>