<?php
session_start();
if(!(isset($_SESSION['user_id']))){
    $user_name = "there";
    $nav_state = "Login";
    $image_path = "";
    $state =0;
}
else{
    $user_name = $_SESSION["user_name"];
    $user_id = $_SESSION['user_id'];
    $nav_state = "Logout";

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "reeveew";
    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT user_email FROM user_info WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $u_email = $row['user_email'];
    }
    // Get image path
    $sql = "SELECT image_path FROM Image WHERE user_email='$u_email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $image_path = $row['image_path'];

    $state =1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Reeveew</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/starlogo.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.5.0
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    <style>
        /* styles for images */
        .images {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            margin: 20px;
            margin-top: 4%;
        }

        .images img {
            width: 200px;
            height: 300px;
            margin-bottom: 10px;
        }

        /* styles for image titles */
        .images h5 {
            text-align: center;
            font-family: "Arial Rounded MT Bold";
            color: #002A70;
            margin: 0;
        }
    </style>
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="../assets/img/starlogo.png" alt="">
            <span class="d-none d-lg-block">Reeveew</span>
        </a>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">



            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="<?php echo $image_path?>" alt="" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">Hi <?php echo $user_name?></span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <span>What do you want to do?</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" onclick="isLogged()">
                            <i class="bi bi-person"></i>
                            <span><?php echo $nav_state?></span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="user_request.php">
                            <i class="bi bi-buildings"></i>
                            <span>Add Business</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="contact_us_page.php">
                            <i class="bi bi-question-circle"></i>
                            <span>Contact Us</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->



<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

<h4 style="margin-top: 12%;text-align: center;font-family: Arial Rounded MT Bold;color: #002A70;">Categories</h4>
<div class="images">

    <!-- first image -->
    <a href="./all_businesses.php">
        <img src="../assets/img/spa.png" alt="Image 3">
        <h5>Spas</h5>
    </a>

    <!-- second image -->
    <a href="./all_businesses.php">
        <img src="../assets/img/hotels.png" alt="Image 2">
        <h5>Hotels</h5>
    </a>

    <!-- third image -->
    <a href="./all_businesses.php">
        <img src="../assets/img/events.jpg" alt="Image 1">
        <h5>Events</h5>
    </a>


    <!-- fourth image -->
    <a href="./all_businesses.php">
        <img src="../assets/img/restaurant.png" alt="Image 4">
        <h5>Restaurants</h5>
    </a>

    <!-- fifth image -->
    <a href="./all_businesses.php">
        <img src="../assets/img/salon.jpg" alt="Image 5">
        <h5>Salons</h5>
    </a>

</div>
<script>
    function isLogged(){
        <?php if($state==1): ?>
        window.location.href = "process_logout.php";
        <?php else: ?>
        window.location.href = "login_page.php";
        <?php endif; ?>

    }
</script>
</body>

</html>
<?php
//this is the landing page?>

