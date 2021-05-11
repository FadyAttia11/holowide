<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

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
        <li><a href="#hero"><i class="bx bx-home"></i> <span>Home</span></a></li>
        <li class="active"><a href="new-event.php"><i class="bx bx-user"></i> <span>Add New Event</span></a></li>
        <li><a href="my-requests.php"><i class="bx bx-book-content"></i> <span>My Requests</span></a></li>
        <li><a href="marketing-plans.php"><i class="bx bx-server"></i> <span>Marketing Plans</span></a></li>
        <li><a href="#contact"><i class="bx bx-envelope"></i> <span>Planner: <?php echo $user_data['user_name'] ?></span></a></li>
        <li><a href="logout.php"><i class="bx bx-file-blank"></i> <span>Logout</span></a></li>
        </ul>
    </nav><!-- .nav-menu -->

    </header><!-- End Header -->

  <main id="main">

    <!-- ======= Portfolio Details ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8">
            <h2 class="portfolio-title">This is an example of portfolio detail</h2>
            <div class="owl-carousel portfolio-details-carousel">
              <img src="assets/img/portfolio/portfolio-details-1.jpg" class="img-fluid" alt="">
              <img src="assets/img/portfolio/portfolio-details-2.jpg" class="img-fluid" alt="">
              <img src="assets/img/portfolio/portfolio-details-3.jpg" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-4 portfolio-info">
            <h3>Project information</h3>
            <ul>
              <li><strong>Category</strong>: Web design</li>
              <li><strong>Client</strong>: ASU Company</li>
              <li><strong>Project date</strong>: 01 March, 2020</li>
              <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li>
            </ul>

            <p>
              Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
            </p>
          </div>

        </div>

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