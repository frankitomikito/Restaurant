<!-- choose-table.php -->
<?php 
 $datetime="";
 $uid;
if (isset($_POST['reservation'])) {
    

  // $res_id = $_POST['res_id'];
  // $reservation_name = $_POST['reservation_name'];
  // $reservation_phone = $_POST['reservation_phone'];
  if (isset($_GET['id'])) {
    //echo '<script>alert("'.$_GET['id'].'")</script>';
    $uid = $_GET['id'];
  }
  $reservation_date = $_POST['reservation_date'];
  $reservation_time = $_POST['reservation_time'];

  $datetime = $reservation_date.' '.$reservation_time; 

 
}

include 'template/header.php'; ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <body>
    
   <?php include 'template/nav-bar.php'; ?>
    <!-- END nav -->
    
    <section class="home-slider owl-carousel" style="height: 400px;">
      <div class="slider-item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center">
            <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
              <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Tables</span></p>
              <h1 class="mb-3">Choose Tables</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section" style="background: #ffffff;">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Our Tables</span>
            <h2>Choose Your Table</h2>
            <?php
               include 'dbCon.php';
               $num=0;
               $con = connect();
               $sql = "SELECT * FROM `tbl_table` WHERE status = 1 ;";
               $result = $con->query($sql);
              ?> 
                  <form  action="save_book.php" method="POST">
                      <table class="table table-hover">
                        <th>Table Name</th>
                        <th>Capacity</th>
                        <th></th>
                       
                          <?php foreach ($result as $r) {
                            $table_id = $r['table_id']; ?>
                          <tr>
                          <td><?php echo $r['table_name'];?></td>
                          <td><?php echo $r['capacity'];?></td>
                          <td><input type="checkbox" name="table[]" value="<?php echo $r['table_id'];?>"></td>
                         
                          </tr>
                          <?php }?>
                        <tr>
                        <td><input type="hidden" name="datetime" value="<?php echo $datetime;?>"></td>
                          <td><input type="hidden" name="userid" value="<?php echo $uid;?>"></td>
                        </tr>

                      </table>
                       
                        
                        <input type="submit" value="RESERVE" name="reserve">
                      </form>
          </div>
        </div>
        
        
              </div>
            </div>
          </div>
        </form> 
      </div>
    </section>

    
    

    <?php include 'template/footer.php'; ?>

    <?php include 'template/script.php'; ?>
    
  </body>


</html>


