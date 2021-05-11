<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $event_id = $_GET["id"];

    $event_query = "select * from broadcasts where id = '$event_id'";
    $event = mysqli_query($con, $event_query);

    if($event && mysqli_num_rows($event) > 0) {
        $event_data = mysqli_fetch_assoc($event);
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
        <li class="active"><a href="my-requests.php"><i class="bx bx-book-content"></i> <span>My Requests</span></a></li>
        <li><a href="marketing-plans.php"><i class="bx bx-server"></i> <span>Marketing Plans</span></a></li>
        <li><a href="#contact"><i class="bx bx-envelope"></i> <span>Customer: <?php echo $user_data['user_name'] ?></span></a></li>
        <li><a href="logout.php"><i class="bx bx-file-blank"></i> <span>Logout</span></a></li>
        </ul>
    </nav><!-- .nav-menu -->

    </header><!-- End Header -->

  <main id="main">

    <!-- ======= Portfolio Details ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container" data-aos="fade-up">

        <div class="row mb-5">
          <div class="col-lg-8">
            <h2 class="portfolio-title">Broadcast Name: <?php echo $event_data['broad_name'] ?></h2>
            <img src=<?php echo "./uploads/". $event_data['image'] ?> class="img-fluid" alt="">
          </div>

          <div class="col-lg-4 portfolio-info">
            <h3>Event information</h3>
            <ul>
              <li><h6><strong>Planner Name</strong>: <?php echo $event_data['planner_name'] ?></h6></li>
              <li><h6><strong>Location</strong>: <?php echo $event_data['location'] ?></h6></li>
              <li><h6><strong>Broadcast Date</strong>: <?php echo $event_data['broad_date'] ?></h6></li>
              <li><h6><strong>Broadcast Time</strong>: <?php echo $event_data['time'] ?></h6></li>
              <li><h6><strong>Ticket Price</strong>: <?php echo $event_data['ticket_price'] ?> L.E</h6></li>
            </ul>
          </div>
        </div>


        <h3>Book This Event Online</h3>
        <p>(Only Pay 10% of the cost as a deposit)</p>
        <form method="post" class="m-auto">
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
            <div class="text-center">
                <input type="submit" class="btn btn-primary m-auto" value="Book Event">
            </div>
            <?php
                if($_SERVER['REQUEST_METHOD'] == "POST") {

                    $get_money_query = "select * from users where user_role = 'admin'";
                    $get_money = mysqli_query($con, $get_money_query);
            
                    if($get_money && mysqli_num_rows($get_money) > 0) {
                        $current_money = mysqli_fetch_assoc($get_money);
                        $deposit = $event_data['ticket_price'] * 0.1;
                        $updated_money = $current_money['balance'] + $deposit;
            
                        $add_money_query = "update users set balance = '$updated_money' where user_role = 'admin'";
                        $add_money = mysqli_query($con, $add_money_query);
            
                        if($add_money) {
                            $broadcast_id = $event_data['id'];
                            $customer_name = $user_data['user_name'];

                            $query = "insert into bookings (broadcast_id,customer_name) values ('$broadcast_id','$customer_name')";
                            $result = mysqli_query($con, $query);

                            if($result) {
                                header('Location: index.php');
                            }
                        } else {
                            echo "error adding money to our account";
                        }
                    }
                }
            ?>
        </form>

      </div>
    </section><!-- End Portfolio Details -->

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