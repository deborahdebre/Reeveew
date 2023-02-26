<?php
session_start();
if(!(isset($_SESSION['user_id']))){
    $user_name = "there";
    $nav_state = "Login";
    $state = 0;
    header("Location: login_page.php");
    exit();
}
else{
    $user_name = $_SESSION["user_name"];
    $nav_state = "Logout";
    $state = 1;
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

<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/starlogo.png" alt="">
            <span class="d-none d-lg-block">Reeveew</span>
        </a>
    </div><!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input style="margin-left: 46px;width: 550px" type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
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
<!-- Table with stripped rows -->
<table style="margin-top: 8%" class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Business Name</th>
        <th scope="col">Category</th>
        <th scope="col">Date requested</th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>Transcorp Hilton</td>
        <td>Hotel</td>
        <td>2016-05-25</td>
        <td>Pending</td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Cold Blues</td>
        <td>Spa</td>
        <td>2014-12-05</td>
        <td style="color: green">Approved</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>Fish Grills</td>
        <td>Restaurant</td>
        <td>2011-08-12</td>
        <td style="color: green">Approved</td>
    </tr>
    <tr>
        <th scope="row">4</th>
        <td>Andy's Massage House</td>
        <td>Spa</td>
        <td>2012-06-11</td>
        <td style="color: red">Denied</td>
    </tr>
    <tr>
        <th scope="row">5</th>
        <td>KFC</td>
        <td>Restaurant</td>
        <td>2011-04-19</td>
        <td style="color: green" >Approved</td>
    </tr>

    <tr>
        <th scope="row">6</th>
        <td>Chicken Republic</td>
        <td>Restaurant</td>
        <td>2011-04-19</td>
        <td style="color: green" >Approved</td>
    </tr>
    <tr>
        <th scope="row">7</th>
        <td>Massage House</td>
        <td>Spa</td>
        <td>2012-06-11</td>
        <td style="color: red">Denied</td>
    </tr>
    <tr>
        <th scope="row">8</th>
        <td>Maame's Salon ltd</td>
        <td>Salon</td>
        <td>2012-06-11</td>
        <td style="color: red">Denied</td>
    </tr>
    <tr>
        <th scope="row">9</th>
        <td>Andy's Massage House</td>
        <td>Spa</td>
        <td>2012-06-11</td>
        <td style="color: red">Denied</td>
    </tr>
    <tr>
        <th scope="row">10</th>
        <td>Hilton and sons</td>
        <td>Hotel</td>
        <td>2016-05-25</td>
        <td>Pending</td>
    </tr>
    </tbody>
</table>
<!-- End Table with stripped rows -->
<button style="margin-left: 45%" class="btn btn-primary"><a style="color: white" href="user_request_form.php">New Request</a></button>
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

