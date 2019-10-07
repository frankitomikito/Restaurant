<!-- signin.php -->
<?php include 'template/header.php'; ?>

<body>

  <?php include 'template/nav-bar.php'; ?>
  <!-- END nav -->

  <section class="home-slider owl-carousel" style="height: 400px;">
    <div class="slider-item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
          <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Login</span></p>
            <h1 class="mb-3">Login</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <span class="subheading">Login</span>
          <h2>Log In Our Site</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 dish-menu">

          <div class="nav nav-pills justify-content-center ftco-animate" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link py-3 px-4 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><span class="flaticon-meat"></span> Login</a>

          </div>

          <div class="tab-content py-5" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="menus d-flex ftco-animate" style="background: white;">
                    <div class="row" style="width: 100%">
                      <div class="col-md-12">
                        <form action="login.php" method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                            <input type="text" name="useremail" class="form-control" required="" placeholder="Email or Username">
                          </div>
                          <div class="form-group">
                            <input type="password" name="password" class="form-control" required="" placeholder="Your Password">
                          </div>
                          <div class="form-group">
                            <input type="submit" value="Login" name="login" class="btn btn-primary py-3 px-5">
                          </div>
                        </form>
                        <p class="text-center">For Register <a href="register.php">Click Here.</a> </p>
                        <p class="text-center">Forgot Password? <a href="forgot.php">Click Here.</a> </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- END -->

          </div>
        </div>
      </div>
    </div>
  </section>



  <?php include 'template/footer.php'; ?>

  <?php include 'template/script.php'; ?>



</body>

</html>



<?php
if (isset($_POST['login'])) {

  
  include_once 'dbCon.php';

  $user_details;

  function getPositionText($num) {
		switch ($num) {
			case 1:
				return 'Administrator';
			case 2:
				return 'Customer';
			case 3:
				return 'Chef';
			case 4:
				return 'Waiter';
			case 5:
				return 'Cashier';
		}
	}

  $con = connect();
  if (!empty(strpos($_POST['useremail'], '@') !== false)){
    $user_details = $con->query('select * from tbl_user where email = "' . $_POST['useremail'] . '"');
  }
  else{
    $user_details = $con->query('select * from tbl_user where username = "' . $_POST['useremail'] . '"');
  }


  if ($user_details->num_rows > 0) {
    $user_details = $user_details->fetch_assoc();
    if ((bool) password_verify($_POST['password'], $user_details['password'])) {
      $_SESSION['isLoggedIn'] = true;
      $_SESSION['id'] = $user_details['user_id'];
      $_SESSION['name'] = $user_details['fullname'];
      $_SESSION['email'] = $user_details['email'];
      $_SESSION['image_path'] = $user_details['image_path'];
      $_SESSION['role'] = $user_details['position'];
      $_SESSION['position'] = getPositionText($user_details['position']);

      switch ($user_details['position']) {
        case 1:
          echo '<script>alert("Logged-in Successfully!"); window.location.href="admin/index.php"</script>';
          break;
        case 3:
          echo '<script>alert("Logged-in Successfully!"); window.location.href="chef/orders.php"</script>';
          break;
        case 5:
          echo '<script>alert("Logged-in Successfully!"); window.location.href="cashier/tables.php"</script>';
          break;
        default:
          echo '<script>alert("Logged-in Successfully!"); window.location="index.php"</script>';
          break;
      }
    } else {
      echo '<script>alert("Invalid email or password."); window.location="login.php"</script>';
    }
  } else {
  }
}
?>