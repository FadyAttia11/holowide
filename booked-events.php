<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $customer_name = $user_data['user_name'];

    $booked_events_query = "select * from bookings join broadcasts on bookings.broadcast_id = broadcasts.id where customer_name = '$customer_name'";
    $booked_events = mysqli_query($con, $booked_events_query);

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
      <li><a href="all-events.php"><i class="bx bx-user"></i> <span>View Upcoming Events</span></a></li>
      <li class="active"><a href="booked-events.php"><i class="bx bx-book-content"></i> <span>My Booked Events</span></a></li>
      <li><a href="#"><i class="bx bx-envelope"></i> <span>Customer: <?php echo $user_data['user_name'] ?></span></a></li>
      <li><a href="logout.php"><i class="bx bx-file-blank"></i> <span>Logout</span></a></li>
    </ul>
  </nav><!-- .nav-menu -->

</header><!-- End Header -->

<main id="main" style="margin-top: 100px;">

    <div class="container">
        <div class="portfolio-description">
            <h2 class="mb-5">Booked Events</h2>
            <div class="row">
                <?php
                    while($row = mysqli_fetch_array($booked_events)) {
                ?>

                <div class="col-6">
                    <a href=<?php echo "event.php?id=". $row['id'] ?>><img src=<?php echo "./uploads/".$row['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></a>
                    <h5>Name: <?php echo $row['broad_name'] ?></h5>
                </div>

                <?php } ?>
            </div>
        </div>
    </div>

</main>

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