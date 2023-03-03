<?php

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "reeveew";
$conn = null;
// Set default values for user session
if (!isset($_SESSION['user_id'])) {
    $user_name = "there";
    $nav_state = "Login";
    $state = 0;
} else {
    $user_name = $_SESSION["user_name"];
    $nav_state = "Logout";
    $state = 1;
}

function openConnection() {
    global $servername, $username, $password, $dbname, $conn;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

function closeConnection() {
    global $conn;

    if ($conn != null) {
        mysqli_close($conn);
        $conn = null;
    }
}

function getAllBusinesses() {
    global $conn;

    if ($conn == null) {
        openConnection();
    }

$sql = "SELECT bd.business_name, bd.business_id, bd.category_id, bd.description, bd.location, bd.phone_num, bd.working_time, bd.keywords, bd.average_price, bd.average_rating, 
(SELECT i.image_path FROM Image i WHERE i.business_id = bd.business_id ORDER BY i.image_id LIMIT 1) AS image_path, c.category_name, l.location
FROM business_details bd
JOIN category c ON bd.category_id = c.category_id
JOIN location_details l ON bd.location_id = l.location_id
WHERE EXISTS(SELECT 1 FROM Image WHERE business_id = bd.business_id);";


    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $data;
}

function getAllLocations() {
    global $conn;

    if ($conn == null) {
        openConnection();
    }

    $sql = "SELECT * FROM location_details";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $data;
}

function getAllCategories() {
    global $conn;

    if ($conn == null) {
        openConnection();
    }

    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $data;
}
// Retrieve all submitted business requests from the database
$dataLoc = getAllLocations();
$dataCat = getAllCategories();
// if ($_SESSION['filter']==1) {
//     $businesses = $_SESSION['filteredBusinesses'];
// }
// else{
    $businesses = getAllBusinesses();
// }


//// Close the database connection
closeConnection();
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
    .business-card-image {
        height: 205px;
        width: 205px;
    }

</style>

<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="../assets/img/starlogo.png" alt="">
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
        <div id="locationTemp"></div>
        <form>
        <?php foreach ($dataLoc as $option) { ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="<?php echo $option['location_id']; ?>" id="location-option<?php echo $option['location_id']; ?>">
                <label class="form-check-label" for="location-option<?php echo $option['location_id']; ?>"><?php echo $option['location']; ?></label>
            </div>
        <?php } ?>
        </form>
        <hr>
        <h5 class="card-title">Rating</h5>
        <form>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="4.5" id="rating-option1">
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
                <input class="form-check-input" type="checkbox" value="2.5" id="rating-option2">
                <label class="form-check-label" for="rating-option2">
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-half" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="rating-text">& Up</span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1.5" id="rating-option3">
                <label class="form-check-label" for="rating-option3">
                    <span class="bi bi-star-fill" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star-half" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="bi bi-star" style="color: rgb(210, 157, 0)"></span>
                    <span class="rating-text">& Up</span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="rating-option4">
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
            <?php foreach ($dataCat as $option) { ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="<?php echo $option['category_id']; ?>" id="category-option<?php echo $option['category_id']; ?>">
                    <label class="form-check-label" for="category-option<?php echo $option['category_id']; ?>"><?php echo $option['category_name']; ?></label>
                </div>
            <?php } ?>
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
        <div style="text-align: center;width: 100%">
            <button id="filter-button" type="button" class="btn btn-primary">Filter</button>
            <button id="clear-button" type="button" class="btn btn-secondary">Clear</button>
        </div>
        <div id="FilterStatus"></div>
    </div>
</aside>

<section class="section" style="padding-left: 22.5%; padding-top: 7%">
    <div class="row">
        <?php
        foreach ($businesses as $key => $business) {
            if ($key % 2 == 0) {
                // Create a new row after every second business card
                echo '</div><div class="row">';
            }
            ?>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $business['image_path']; ?>" class="img-fluid rounded-start business-card-image" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title" style="padding-bottom: 2px"><a href="business_details.php?business_id=<?php echo $business['business_id']; ?>"><?php echo $business['business_name']; ?></a></h5>
                                <?php
                                $average_rating = $business['average_rating'];
                                $rounded_rating = round($average_rating, 1);
                                $whole_stars = floor($rounded_rating);
                                $decimal_part = $rounded_rating - $whole_stars;
                                for ($i = 0; $i < $whole_stars; $i++) {
                                    echo '<i class="bi bi-star-fill" style="color:darkgoldenrod"></i>';
                                }
                                if ($decimal_part > 0) {
                                    echo '<i class="bi bi-star-half" style="color:darkgoldenrod"></i>';
                                }
                                for ($i = 0; $i < 5 - ceil($average_rating); $i++) {
                                    echo '<i class="bi bi-star" style="color:darkgoldenrod"></i>';
                                }
                                ?>
                                <span><strong><?php echo $rounded_rating; ?></strong></span>
                                <p class="card-text"><?php echo substr($business['description'], 0, 100); ?>...</p>
                                <h8 class="card-title"><?php echo $business['location'] ; ?><span><?php echo "  -  ". $business['category_name']; ?></span></h8>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


</section>
<script>
    w3.includeHTML();
</script>
<script>
    var minVal=0;
    var maxVal=500;
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 1000,
            values: [ 100, 500 ],
            slide: function( event, ui ) {
                $( "#price-range" ).val( "GH¢" + ui.values[ 0 ] + " - GH¢" + ui.values[ 1 ] );
                minVal = ui.values[0];
                maxVal = ui.values[1];
            }
        });
        $( "#price-range" ).val( "GH¢" + $( "#slider-range" ).slider( "values", 0 ) +
            " - GH¢" + $( "#slider-range" ).slider( "values", 1 ) );
    } );
</script>
<script>
    //     document.getElementById("filter-button").addEventListener("click", function() {
    //     var selectedLocations = [];
    //     var locationOptions = document.querySelectorAll("#sidebar input[type=checkbox][id^='location-option']");
    //     for (var i = 0; i < locationOptions.length; i++) {
    //         if (locationOptions[i].checked) {
    //             selectedLocations.push(locationOptions[i].value);
    //         }
    //     }

    //     var selectedRatings = [];
    //     var ratingOptions = document.querySelectorAll("#sidebar input[type=checkbox][id^='rating-option']");
    //     for (var i = 0; i < ratingOptions.length; i++) {
    //         if (ratingOptions[i].checked) {
    //             selectedRatings.push(ratingOptions[i].value);
    //         }
    //     }

    //     var selectedCategories = [];
    //     var categoryOptions = document.querySelectorAll("#sidebar input[type=checkbox][id^='category-option']");
    //     for (var i = 0; i < categoryOptions.length; i++) {
    //         if (categoryOptions[i].checked) {
    //             selectedCategories.push(categoryOptions[i].value);
    //         }
    //     }


    //     const queryString = `location=${selectedLocations.join(',')}&rating=${selectedRatings.join(',')}&category=${selectedCategories.join(',')}&price_min=${minVal}&price_max=${maxVal}`;
    //     const xhr = new XMLHttpRequest();
    //     xhr.onreadystatechange = function() {
    //         if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
    //             document.getElementById("FilterStatus").innerHTML= "filtered";
    //         }
    //     };
    //         xhr.open("POST", "filter.php", true);
    //         xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //         xhr.send(queryString);

    // });
    //     document.getElementById("clear-button").addEventListener("click", function() {
    //         // Reset the slider values
    //         $( "#slider-range" ).slider({
    //             values: [ 100, 500 ]
    //         });
    //         $( "#price-range" ).val( "GH¢" + $( "#slider-range" ).slider( "values", 0 ) +
    //             " - GH¢" + $( "#slider-range" ).slider( "values", 1 ) );

    //         // Uncheck all checkboxes
    //         var checkboxes = document.querySelectorAll("input[type=checkbox]");
    //         for (var i = 0; i < checkboxes.length; i++) {
    //             checkboxes[i].checked = false;
    //         }
    //         <?php
    //             unset($_SESSION["filter"]);
    //             header("Location: all_businesses.php");
    //         ?>
    //     });
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