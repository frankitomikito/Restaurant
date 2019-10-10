<?php
$datetime = "";
$uid;
if (isset($_POST['reservation'])) {


    // $res_id = $_POST['res_id'];
    // $reservation_name = $_POST['reservation_name'];
    // $reservation_phone = $_POST['reservation_phone'];
    if (isset($_GET['id'])) {
        //echo '<script>alert("'.$_GET['id'].'")</script>';
        $uid = $_GET['id'];
    }

    $confirm = false;
    $msg = "";

    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];

    $datetime = $reservation_date . ' ' . $reservation_time;
}




include 'header.php'; ?>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css"> -->
<link rel="stylesheet" href="../libraries/datatables/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="../build/customer/reservation-bundle.css"> -->

<body>

    <?php include 'nav-bar.php'; ?>
    <!-- END nav -->

    <section class="home-slider owl-carousel" style="height: 400px;">
        <div class="slider-item" style="background-image: url('../images/bg_1.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center justify-content-center">
                    <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Tables</span></p>
                        <h1 class="mb-3">Reservation</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section" style="background: #ffffff;">
        <div class="container" style="margin-top: -5rem;">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <!-- <span class="subheading">Our Tables</span> -->
                    <h2>My Reservation</h2>
                </div>

                <div class="col-lg-12">
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>Booking Id</th>
                                <th>Date & Time</th>
                                <th>Table Name</th>
                                <th>Capacity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            </form>
        </div>
    </section>




    <?php include '../template/footer.php'; ?>

    <?php include 'script.php'; ?>
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script> -->
    <script src="../libraries/datatables/js/jquery.dataTables.js"></script>
    <script src="../libraries/moment.js"></script>
    <script src="../js/customer/reservation.js"></script>

</body>

</html>