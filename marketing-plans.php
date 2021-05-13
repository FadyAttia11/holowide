<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $planner_name = $user_data['user_name'];

    $msg = '.';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
      $plan_name = $_POST['plan_name'];
      $plan_cost = $_POST['plan_cost'];

      $get_money_query = "select * from users where user_role = 'admin'";
      $get_money = mysqli_query($con, $get_money_query);

      if($get_money && mysqli_num_rows($get_money) > 0) {
          $current_money = mysqli_fetch_assoc($get_money);
          $deposit = $plan_cost * 0.1;
          $updated_money = $current_money['balance'] + $deposit;

          $add_money_query = "update users set balance = '$updated_money' where user_role = 'admin'";
          $add_money = mysqli_query($con, $add_money_query);

          if($add_money) {
            $query = "insert into plans (planner_name,plan_name) values ('$planner_name','$plan_name')";
            $result = mysqli_query($con, $query);
      
            if($result) {
              $msg = "Successfully added your plan";
            } else {
              $msg = "Error adding your plan";
            }
          } else {
              echo "error adding money to our account";
          }
      }
      

      
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Holowide</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Mobile nav toggle button ======= -->
    <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex flex-column justify-content-center">

    <nav class="nav-menu">
        <ul>
        <li><a href="index.php"><i class="bx bx-home"></i> <span>Home</span></a></li>
        <li><a href="new-event.php"><i class="bx bx-user"></i> <span>Add New Event</span></a></li>
        <li><a href="my-requests.php"><i class="bx bx-book-content"></i> <span>My Requests</span></a></li>
        <li class="active"><a href="marketing-plans.php"><i class="bx bx-server"></i> <span>Marketing Plans</span></a></li>
        <li><a href="#contact"><i class="bx bx-envelope"></i> <span>Planner: <?php echo $user_data['user_name'] ?></span></a></li>
        <li><a href="logout.php"><i class="bx bx-file-blank"></i> <span>Logout</span></a></li>
        </ul>
    </nav><!-- .nav-menu -->

    </header><!-- End Header -->

  <main id="main">
  <section class="pricing py-5" style="margin-top: 100px;">

  <div class="container">
  <h1 style="color: white;">Marketing Plans</h1>
  <?php 
    $plans_query = "select * from plans where planner_name = '$planner_name'";
    $plans = mysqli_query($con, $plans_query);

    if($plans && mysqli_num_rows($plans) > 0) {
      $msg = "You Are Already Subscribed on a plan";
    } else {
  ?>
    <div class="row" >
      <!-- Free Tier -->
      <div class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
            <h6 class="card-price text-center">L.E 1000<span class="period">/month</span></h6>
            <hr>
            <ul class="fa-ul">
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Social Media Marketing</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Graphic & Logo Designs</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Consultations</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>4 Marketing Session for your event</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Paid Social Media Ads</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Sponsors on Youtube Videos</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>24/7 Dedicated Team for your event</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>TV advertising</li>
            </ul>
            <form method="post">
              <input type="hidden" name="plan_cost" value=1000>
              <input type="hidden" name="plan_name" value="Plus">

              <!-- Button to Open the Modal -->
              <button type="button" class="btn btn-block btn-primary text-uppercase" data-toggle="modal" data-target="#myModal">
                Get The Plus Plan
              </button>

              <!-- The Modal -->
              <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Get the Plus Plan</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <div class="form-group mt-2">
                    <label>Card holder's name</label>
                    <input type="text" placeholder="Card holder's name" class="form-control">
                    </div>
                    <div class="form-group">
                    <label>Card number</label>
                    <input type="number" placeholder="Card number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Expire Date</label>
                        <input type="date" placeholder="dd/mm/yy" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>CVV</label>
                        <input type="text" placeholder="CVV" class="form-control">
                    </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-primary m-auto" value="Get This Plan">
                    </div>

                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Plus Tier -->
      <div class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
            <h6 class="card-price text-center">L.E 2000<span class="period">/month</span></h6>
            <hr>
            <ul class="fa-ul">
            <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Social Media Marketing</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Graphic & Logo Designs</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Consultations</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>4 Marketing Session for your event</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Paid</strong> Social Media Ads</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Sponsors</strong> on Youtube Videos</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>24/7 Dedicated Team for your event</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>TV advertising</li>
            </ul>
            <form method="post">
              <input type="hidden" name="plan_cost" value=2000>
              <input type="hidden" name="plan_name" value="Pro">
              <!-- Button to Open the Modal -->
              <button type="button" class="btn btn-block btn-primary text-uppercase" data-toggle="modal" data-target="#myModal1">
                Get The Plus Plan
              </button>

              <!-- The Modal -->
              <div class="modal fade" id="myModal1">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Get the Pro Plan</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <div class="form-group mt-2">
                    <label>Card holder's name</label>
                    <input type="text" placeholder="Card holder's name" class="form-control">
                    </div>
                    <div class="form-group">
                    <label>Card number</label>
                    <input type="number" placeholder="Card number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Expire Date</label>
                        <input type="date" placeholder="dd/mm/yy" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>CVV</label>
                        <input type="text" placeholder="CVV" class="form-control">
                    </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-primary m-auto" value="Get This Plan">
                    </div>

                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Pro Tier -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Ultimate</h5>
            <h6 class="card-price text-center">L.E 3000<span class="period">/month</span></h6>
            <hr>
            <ul class="fa-ul">
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Social Media Marketing</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Graphic & Logo Designs</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Consultations</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>4 Marketing Session for your event</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Paid</strong> Social Media Ads</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Sponsors</strong> on Youtube Videos</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>24/7 <strong>Dedicated Team</strong> for the event</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>TV</strong> advertising</li>
            </ul>
            <form method="post">
              <input type="hidden" name="plan_cost" value=3000>
              <input type="hidden" name="plan_name" value="Ultimate">
              <!-- Button to Open the Modal -->
              <button type="button" class="btn btn-block btn-primary text-uppercase" data-toggle="modal" data-target="#myModal2">
                Get The Plus Plan
              </button>

              <!-- The Modal -->
              <div class="modal fade" id="myModal2">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Get the Ultimate Plan</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <div class="form-group mt-2">
                    <label>Card holder's name</label>
                    <input type="text" placeholder="Card holder's name" class="form-control">
                    </div>
                    <div class="form-group">
                    <label>Card number</label>
                    <input type="number" placeholder="Card number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Expire Date</label>
                        <input type="date" placeholder="dd/mm/yy" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>CVV</label>
                        <input type="text" placeholder="CVV" class="form-control">
                    </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-primary m-auto" value="Get This Plan">
                    </div>

                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    <?php } ?>
    <h2 style="color: white;"><?php echo $msg ?></h2>
  </div>
</section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>