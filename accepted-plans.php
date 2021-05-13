<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    $all_plans_query = "select * from plans";
    $all_plans = mysqli_query($con, $all_plans_query);

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
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
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
        <li><a href="cost-determ.php"><i class="bx bx-user"></i> <span>Cost Determination</span></a></li>
        <li><a href="accepted-events.php"><i class="bx bx-book-content"></i> <span>Accepted Events</span></a></li>
        <li class="active"><a href="accepted-plans.php"><i class="bx bx-server"></i> <span>Accepted Marketing Plans</span></a></li>
        <li><a href="#"><i class="bx bx-envelope"></i> <span>Balance: <?php echo $user_data['balance'] ?> L.E</span></a></li>
        <li><a href="logout.php"><i class="bx bx-file-blank"></i> <span>Logout</span></a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </header><!-- End Header -->


    <section style="margin-top: 70px;">
    <div class="container mt-3"><br>
    <h1 class="mb-4">All Accepted Marketing Plans</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Event Planner</th>
            <th>Plan Name</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
            while($row = mysqli_fetch_array($all_plans)) {
        ?>

        <tr>
            <td><?php echo $row['planner_name'] ?></td>
            <td><?php echo $row['plan_name'] ?></td>
            <td><?php echo $row['date'] ?></td>
        </tr>

        <?php } ?>
       
        </tbody>
    </table>
    </div>
    </section>

    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
            }, false);
        })();
    </script>
</body>
</html>