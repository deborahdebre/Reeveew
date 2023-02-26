
<?php
session_start();
if(!(isset($_SESSION['user_id']))){
    $user_name = "there";
    $nav_state = "Login";
    $state =0;
}
else{
    $user_name = $_SESSION["user_name"];
    $nav_state = "Logout";
    $state =1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Reeveew/View Request</title>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="https://www.w3schools.com/lib/w3.js"></script>

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.5.0
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->

</head>

<div w3-include-html="updatedHeader.php"></div>
<style>
    #slider-range {
        height: 10px;
        border-radius: 10px;
        background: #e9ecef;
        margin-top: 20px;
    }
    .ui-slider-handle {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #007bff;
        border: none;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.25);
        cursor: pointer;
        position: absolute;
        top: -5px;
    }
    .ui-slider-handle:first-of-type {
        left: -10px;
    }
    .ui-slider-handle:last-of-type {
        right: -10px;
    }
    .ui-slider-range {
        background: #012970;
    }
</style>
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


<aside id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h5 class="card-title" >FILTER</h5>
    </div>
    <hr>
    <div class="sidebar-body">
        <h5 class="card-title">Location</h5>
        <form>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="location-option1">
                <label class="form-check-label" for="location-option1">
                    East Legon
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="location-option2">
                <label class="form-check-label" for="location-option2">
                     Kwabenya
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="location-option3">
                <label class="form-check-label" for="location-option3">
                    Adenta
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="location-option4">
                <label class="form-check-label" for="location-option4">
                    Labone
                </label>
            </div>
            <!-- Add more location options as needed -->
        </form>
        <hr>
        <h5 class="card-title">Rating</h5>
        <form>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="rating-option1">
                <label class="form-check-label" for="rating-option1">
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-half" style="color: rgb(210, 157, 0)"></span>
                    <span class="rating-text"> & Up</span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="rating-option2">
                <label class="form-check-label" for="rating-option2">
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-half" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="rating-text">& Up</span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="rating-option3">
                <label class="form-check-label" for="rating-option3">
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-half" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="rating-text">& Up</span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="rating-option4">
                <label class="form-check-label" for="rating-option4">
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="rating-text">& Up</span>
                </label>
            </div>
            <!-- Add more rating options as needed -->
        </form>
        <hr>
        <h5 class="card-title">Category</h5>
        <form>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="category-1" name="hotel">
                <label class="form-check-label" for="category-1">
                    Hotel
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="category-2" name="restaurant">
                <label class="form-check-label" for="category-2">
                    Restaurant
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="category-3"name="salon">
                <label class="form-check-label" for="category-3">
                    Salon
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="category-4" name="spa">
                <label class="form-check-label" for="category-4">
                    Spa
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="category-5" name="event">
                <label class="form-check-label" for="category-5">
                    Event
                </label>
            </div>
        </form>
        <hr>
        <h5 class="card-title">Price (GH¢)</h5>
        <form>
        <div class="form-group">
            <label for="price-range">Price Range:</label>
            <input type="text" id="price-range" class="form-control" readonly>
            <br>
            <div id="slider-range"></div>
        </div>
    </form>
    </div>
</aside>

<section class="section" style="padding-left: 30%; padding-top: 7%">
    <div class="row align-items-top">
        <div class="col-lg-10">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row g-1">
                            <div class="col-6">
                                <img src="../assets/img/starbites.jpeg" class="img-fluid rounded-start" alt="..."style="height: 85%;margin: 7.5% 7.5%;">                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 0px"><a href="business_details.php">Starbites</a></h5>
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill"style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-half"style="color:darkgoldenrod"></i>
                                     </span><strong>90</strong>
                                    <p class="card-text">Cozy, family-oriented restaurant with good scenery and excellent food and music.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row g-1">
                            <div class="col-6">
                                <img src="../assets/img/starbites.jpeg" class="img-fluid rounded-start" alt="..."style="height: 85%;margin: 7.5% 7.5%;">                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 0px"><a href="business_details.php">Starbites</a></h5>
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill"style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-half"style="color:darkgoldenrod"></i>
                                     </span><strong>90</strong>
                                    <p class="card-text">Cozy, family-oriented restaurant with good scenery and excellent food and music.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row g-1">
                            <div class="col-6">
                                <img src="../assets/img/starbites.jpeg" class="img-fluid rounded-start" alt="..."style="height: 85%;margin: 7.5% 7.5%;">                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 0px"><a href="business_details.php">Starbites</a></h5>
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill"style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-half"style="color:darkgoldenrod"></i>
                                     </span><strong>90</strong>
                                    <p class="card-text">Cozy, family-oriented restaurant with good scenery and excellent food and music.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row g-1">
                            <div class="col-6">
                                <img src="../assets/img/starbites.jpeg" class="img-fluid rounded-start" alt="..."style="height: 85%;margin: 7.5% 7.5%;">                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 0px"><a href="business_details.php">Starbites</a></h5>
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill"style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-half"style="color:darkgoldenrod"></i>
                                     </span><strong>90</strong>
                                    <p class="card-text">Cozy, family-oriented restaurant with good scenery and excellent food and music.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row g-1">
                            <div class="col-6">
                                <img src="../assets/img/starbites.jpeg" class="img-fluid rounded-start" alt="..."style="height: 85%;margin: 7.5% 7.5%;">                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 0px"><a href="business_details.php">Starbites</a></h5>
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill"style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-half"style="color:darkgoldenrod"></i>
                                     </span><strong>90</strong>
                                    <p class="card-text">Cozy, family-oriented restaurant with good scenery and excellent food and music.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row g-1">
                            <div class="col-6">
                                <img src="../assets/img/starbites.jpeg" class="img-fluid rounded-start" alt="..."style="height: 85%;margin: 7.5% 7.5%;">                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-bottom: 0px"><a href="business_details.php">Starbites</a></h5>
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill" style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-fill"style="color:darkgoldenrod"></i>
                                        <i class="bi bi-star-half"style="color:darkgoldenrod"></i>
                                     </span><strong>90</strong>
                                    <p class="card-text">Cozy, family-oriented restaurant with good scenery and excellent food and music.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 1000,
            values: [ 100, 500 ],
            slide: function( event, ui ) {
                $( "#price-range" ).val( "GH¢" + ui.values[ 0 ] + " - GH¢" + ui.values[ 1 ] );
            }
        });
        $( "#price-range" ).val( "GH¢" + $( "#slider-range" ).slider( "values", 0 ) +
            " - GH¢" + $( "#slider-range" ).slider( "values", 1 ) );
    } );
</script>
<script>
    w3.includeHTML();
</script>

<script>
    function isLogged(){
        <?php if($state==1): ?>
        window.location.href = "process_logout.php";
        <?php else: ?>
        window.location.href = "login_page.php";
        <?php endif; ?>

    }
</script>
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