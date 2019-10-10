<?php include 'header.php';
if (!isset($_SESSION['isLoggedIn'])) {
    echo '<script>window.location="login.php"</script>';
} ?>

<body ng-app="chefApp">
    <link rel="stylesheet" type="text/css" href="../build/admin/chef-bundle.css">
    <section class="body">

        <?php include 'top-bar.php' ?>

        <div class="inner-wrapper">
            <?php include 'template/left-bar.php'; ?>
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>Chef</h2>

                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a href="index.php">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span>Chef</span></li>
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

                        <h2 class="panel-title">List of Chef's Dishes Cooked</h2>
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none" id="chef-datatable" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                                <tr>
                                    <th>Receipt Id</th>
                                    <th>Date Ordered</th>
                                    <th>Chef</th>
                                    <th>Table Served</th>
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
        <div id="myModalContainer" class="mymodal-container">
            <div class="mymodal-header">
                <h1>Chef's Infomration Details</h1>
            </div>
            <div class="mymodal-body">
                <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                        <div class="mymodal-avatar">
                            <img id="profileImg" src="../images/person_3.jpg" style="width: 12rem; height: 12rem;">
                        </div>
                        <h3 style="color: black;">{{chef_fullname}}</h3>
                    <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="card-order" ng-repeat="order in orders">
                            <img src="../admin/item-image/{{order.image_path}}" alt="menu">
                            <h4 class="order-title">
                                {{order.name}} <br>
                                <span>Quantity: {{order.quantity}}</span>
                            </h4>
                            <!-- <h3 class="order-price">₱ {{order.quantity * order.price}}</h3> -->
                        </div>
                     <hr>
                    </div>
                </div>
            </div>
            <div class="mymodal-footer">
                <button id="buttonCancel" ng-click="closeModal()" class="myBtn">Cancel</button>
            </div>
        </div>
    </div>
    <?php include 'script-res.php' ?>
    <!-- <script src="../build/admin/bundle.min.js"></script> -->
    <script src="../js/employee/classes/Users.js"></script>
    <script src="../js/employee/classes/Modal.js"></script>
    <script src="../js/angular.js"></script>
    <script src="../libraries/moment.js"></script>
    <script src="../js/admin/chef.js"></script>

</body>

</html>