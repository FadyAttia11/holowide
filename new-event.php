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
        <li><a href="index.php"><i class="bx bx-home"></i> <span>Home</span></a></li>
        <li class="active"><a href="new-event.php"><i class="bx bx-user"></i> <span>Add New Event</span></a></li>
        <li><a href="my-requests.php"><i class="bx bx-book-content"></i> <span>My Requests</span></a></li>
        <li><a href="marketing-plans.php"><i class="bx bx-server"></i> <span>Marketing Plans</span></a></li>
        <li><a href="#contact"><i class="bx bx-envelope"></i> <span>Planner: <?php echo $user_data['user_name'] ?></span></a></li>
        <li><a href="logout.php"><i class="bx bx-file-blank"></i> <span>Logout</span></a></li>
        </ul>
    </nav><!-- .nav-menu -->

    </header><!-- End Header -->

  <main id="main">

  <section style="margin-top: 100px;">
    <div class="container mt-3" style="max-width: 700px;">
        <h3>Add New Event</h3>
        
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

        <label>Event Name:</label>
        <input type="text" class="form-control mb-3" placeholder="Ex: broadcasting world cup final match" name="broad_name" required>

        <div class="row mb-3">
        <div class="col">
            <label>Event Date:</label>
            <input type="date" class="form-control" placeholder="Ex: 12-7-2021" name="broad_date" required>
        </div>
        <div class="col">
            <label>Event Time:</label>
            <input type="text" class="form-control" placeholder="Ex: 7pm" name="time" required>
        </div>
        </div>

        <div class="row mb-3">
        <div class="col">
            <label>Ticket Price:</label>
            <input type="number" class="form-control" placeholder="Ex: 700" name="ticket_price" required>
        </div>
        <div class="col">
            <label>Event Type:</label>
            <select class="form-control mb-3" name="type" required>
                <option>Public</option>
                <option>Private</option>
            </select> 
        </div>
        </div>

        <label>Event Location:</label>
        <textarea class="form-control mb-3" rows="5" name="location" placeholder="Ex: Cairo Festival Mall" required></textarea>

        <label for="fileToUpload">Event Picture (Required): </label>
        <input type="file" name="fileToUpload" class="mb-3" id="fileToUpload" required> <br>


        <button type="submit" class="btn btn-primary">Add New Event</button>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $image = "";
                $planner_name = $user_data['user_name'];
                $broad_name = $_POST['broad_name'];
                $broad_date = $_POST['broad_date'];
                $time = $_POST['time'];
                $ticket_price = $_POST['ticket_price'];
                $type = $_POST['type'];
                $location = $_POST['location'];

                $target_dir = "uploads/";
                $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $image = time() . basename($_FILES["fileToUpload"]["name"]);
                    $error_msg = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                    $error_msg = "Sorry, there was an error uploading your image.";
                }
        
                $query = "insert into broadcasts (planner_name,broad_name,location,broad_date,time,ticket_price,type,trans_cost,state,image) values ('$planner_name','$broad_name','$location','$broad_date','$time','$ticket_price','$type',0,'','$image')";
                $result = mysqli_query($con, $query);
        
                if($result) {
                    header('Location: my-requests.php');
                    $error_msg = "Successfully added your event!";
                } else {
                    $error_msg =  "Error adding your event!";
                }
            }
        ?>
        </form>
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