<!-- signin.php -->
<?php include 'template/header.php'; ?>
<link rel="stylesheet" href="build/customer/bundle.css">
<style>
@media print {
  header {
    display: none !important;
  }
}
</style>
<body ng-app="myApp">
  <?php include 'template/nav-bar.php'; ?>
  <!-- END nav -->

  <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url('images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center text-center">
          <div class="col-md-10 col-sm-12 ftco-animate">
            <h1 class="mb-3">Book a table for yourself at a time convenient for you</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image: url('images/bg_2.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center text-center">
          <div class="col-md-10 col-sm-12 ftco-animate">
            <h1 class="mb-3">Tasty &amp; Delicious Food</h1>
            <p><a href="/reservation" class="btn btn-primary btn-outline-white px-5 py-3">Book a table</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image: url('images/bg_3.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center text-center">
          <div class="col-md-10 col-sm-12 ftco-animate">
            <h1 class="mb-3">Book a table for yourself at a time convenient for you</h1>
            <p><a href="/reservation" class="btn btn-primary btn-outline-white px-5 py-3">Book a table</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END slider -->




  <?php include 'template/font-menu.php'; ?>

  <section class="ftco-section parallax-img" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row justify-content-center mb-5 pb-5">
        <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          <h2>Our Specialties</h2>
        </div>
      </div>
    </div>
  </section>
  <section class="ftco-section bg-light">
    <div class="container special-dish">
      <div class="row d-flex no-gutters">
        <div class="col-lg-6">
          <div class="block-3 d-md-flex ftco-animate">
            <div class="image order-last" style="background-image: url(images/dish-3.jpg);"></div>
            <div class="text text-center order-first">
              <h2 class="heading">Beef Steak</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
              <span class="price">from Php 90.00</span>
            </div>
          </div>
          <div class="block-3 d-md-flex ftco-animate">
            <div class="image order-first" style="background-image: url(images/dish-4.jpg);"></div>
            <div class="text text-center order-first">
              <h2 class="heading">Beef Ribs Steak</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
              <span class="price">from Php 250.00</span>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="block-3 d-md-flex ftco-animate">
            <div class="image order-last" style="background-image: url(images/dish-5.jpg);"></div>
            <div class="text text-center order-first">
              <h2 class="heading">Chopsuey</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
              <span class="price">from Php 150.00</span>
            </div>
          </div>
          <div class="block-3 d-md-flex ftco-animate">
            <div class="image order-first" style="background-image: url(images/dish-6.jpg);"></div>
            <div class="text text-center order-first">
              <h2 class="heading">Roasted Chieken</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
              <span class="price">from Php 90.00</span>
            </div>
          </div>
        </div>
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
          <div class="col-lg-12">
            <label>Table Number</label>
            <select ng-model="table_id">
              <option ng-repeat="reservation in reservations | filter: status:1 track by $index" value="{{reservation.table_id}}">
                {{reservation.table_name}}
              </option>
            </select>
          </div>
          <div class="col-lg-12" ng-repeat="menu in menus">
            <div class="menus d-flex main-dish" style="margin-bottom: 10px; background: white !important; position: relative;">
            <div style="position:absolute; top: .3rem; right: .3rem; border-radius: 50%; background-color: red; color: white; width: 2rem; height: 2rem;
              display: flex; justify-content: center; align-items: center;">
              <a ng-click="removeItem(menu, $index)" style="cursor: pointer;">
                <i class="fas fa-times"></i>
              </a>
            </div>
              <div class="menu-img" style="background-image: url(dashboard/item-image/{{menu.image_path}}); margin-top: .9rem;"></div>
              <div class="text d-flex">
                <div class="one-half">
                  <h3>{{menu.name}}</h3>
                  <div class="myInput-container" style="width: 30%;">
                    <label class="floating-label active">Quantity</label>
                    <input type="number" ng-model="quantity[$index]" class="myInput-control margin" min="1" required>
                  </div>
                </div>
                <div class="one-forth" style="padding-top: .8rem;">
                  <span class="price">Php {{orderPrice(quantity[$index], menu.price, $index)}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12" style="text-align: right;">
            <h2>Total: PHP {{totalPrice(prices)}}</h2>
          </div>
        </div>
      </div>
      <div class="mymodal-footer">
        <button id="buttonCancel" ng-click="onCancel()" class="myBtn" style="font-size: .9rem;">Close</button>
        <button class="myBtn" ng-click="order()" ng-disabled="!canOrder(table_id)" style="font-size: .9rem;">Order</button>
      </div>
    </div>
  </div>
  <?php include 'template/footer.php'; ?>


  <?php include 'template/script.php'; ?>

  <script src="js/angular.js"></script>
  <script src="js/employee/classes/Modal.js"></script>
  <script src="js/customer/customerctrl.js"></script>
  <script src="dashboard/assets/vendor/jquery/jquery.js"></script>
  <script src="dashboard/assets/vendor/select2/select2.js"></script>
  <script src="dashboard/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
  <!-- <script src="build/customer/landingpage/bundle.min.js"></script> -->

</body>

</html>