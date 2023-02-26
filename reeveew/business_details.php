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


// Connect to the database
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "reeveew";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    //stop executing the code and echo error
    die("Connection failed: " . $conn->connect_error);
}
$request_id = $_GET['request_id'];
// Retrieve all submitted business requests from the database
$sql = "SELECT * FROM business_details";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$business_name = $row['business_name'];
$keywords = $row['keywords'];
$description = $row['description'];
$work_time = $row['working_time'];
$business_email = $row['business_email'];
$phone_num = $row['phone_num'];
$location = $row['location'];
$category_id = $row['category_id'];
if($category_id==1){
    $category = "Hotel";
}
elseif ($category_id==2){
    $category = "Restaurant";
}
elseif ($category_id==3){
    $category = "Salon";
}
elseif ($category_id==4){
    $category = "Spa";
}
elseif ($category_id==5){
    $category = "Event";
}
$request_id = $row['request_id'];

// Calculate the average rating
$average_rating = 5;

// Define a function to convert a rating to a number of stars
function rating_to_stars($rating) {
    return str_repeat('⭐️', $rating);
}

// Convert the average rating to a number of stars
$average_stars = rating_to_stars(round($average_rating));

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

        #chart {
            max-width: 400px;
            margin: 35px auto;
        }
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .rating {
            display: inline-block;
            font-size: 0;
            cursor: pointer;
        }

        .star {
            display: inline-block;
            width: 25px;
            height: 25px;
            margin-right: 5px;
            font-size: 24px;
            text-align: center;
            vertical-align: middle;
            border-radius: 50%;
            background-color: transparent;
            border: none;
            outline: none;
        }

        .star:hover,
        .star:focus {
            background-color: transparent;
        }

        .star i {
            color: #ccc;
            transition: all 0.2s;
        }

        .star:hover i,
        .star:focus i {
            color: gold;
            /*fill: linear-gradient(to right, gold 0%, gold calc(100% - 80% / 5 * (5 - var(--star-value)))), transparent calc(20% / 5 * (5 - var(--star-value))) 100%;*/
            fill: linear-gradient(to right, gold 0%, gold calc(var(--star-value) / 5 * 100%));

        }



    </style>

    <script>
        window.Promise ||
        document.write(
            '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
        )
        window.Promise ||
        document.write(
            '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
        )
        window.Promise ||
        document.write(
            '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
        )
    </script>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>

<body style="background: white">

<!-- ======= Header ======= -->
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
<div class="row">
<div style="margin-top: 6%; margin-left: 4%" class="col-xl-5">
    <div class="card">
    <div  class="card-body pt-3">
        <h5 class="card-title"><?php echo $business_name?></h5>
        <p> Average rating: <?php echo number_format($average_rating, 1); ?> <span class="stars"><?php echo $average_stars; ?></span></p>
        <a class="nav-link nav-profile d-flex pe-0" href="#" data-bs-toggle="dropdown">
            <span class="dropdown-toggle p-sm-1">Ratings Summary</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu">
            <li style="width: 400px;height: 380px" class="dropdown-header">
                <div id="chart"></div>
            </li>
        </ul>

        <!-- Slides with indicators -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/img/starbites.jpeg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/starbites.jpeg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/starbites.jpeg" class="d-block w-100" alt="...">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div><!-- End Slides with indicators -->
    </div>
        <button onclick="openReviewModal()" style="margin-left:35%;margin-bottom:5%;width: 30%" type="button" class="btn btn-primary"><i class="bi bi-star me-1"></i> Write Review</button>

    </div>

</div>

<div style="margin-top: 6%" class="col-xl-6">
    <div class="card">
        <div class="card-body pt-3">
            <div class="tab-content pt-2">

                    <h5 class="card-title">Business Description</h5>
                    <p class="small fst-italic"> <?php echo $description; ?></p>

                    <h5 class="card-title">Business Details</h5>
                <hr>
                    <div class="row">
                        <div style="color: darkblue" class="col-lg-3 col-md-4 label ">Business Name</div>
                        <div class="col-lg-9 col-md-8"> <?php echo $business_name; ?></div>
                    </div>
                <hr>
                    <div class="row">
                        <div style="color: darkblue" class="col-lg-3 col-md-4 label">Category</div>
                        <div class="col-lg-9 col-md-8"> <?php echo $category; ?></div>
                    </div>
                <hr>
                    <div class="row">
                        <div style="color: darkblue" class="col-lg-3 col-md-4 label">Location</div>
                        <div class="col-lg-9 col-md-8"> <?php echo $location; ?></div>
                    </div>
                <hr>
                    <div class="row">
                        <div style="color: darkblue" class="col-lg-3 col-md-4 label">Phone number</div>
                        <div class="col-lg-9 col-md-8"> <?php echo $phone_num; ?></div>
                    </div>
                <hr>
                    <div class="row">
                        <div style="color: darkblue"  class="col-lg-3 col-md-4 label">Business email</div>
                        <div class="col-lg-9 col-md-8"> <?php echo $business_email; ?></div>
                    </div>
                <hr>
                    <div class="row">
                        <div style="color: darkblue" class="col-lg-3 col-md-4 label">Open/Close</div>
                        <div class="col-lg-9 col-md-8"> <?php echo $work_time; ?></div>
                    </div>
<hr>
                    <div class="row">
                        <div style="color: darkblue" class="col-lg-3 col-md-4 label">Keywords</div>
                        <div class="col-lg-9 col-md-8"> <?php echo $keywords; ?></div>
                    </div>
            </div>
        </div>
    </div>

</div>
</div>

<script>

    var options = {
        series: [{
            data: [65, 34, 20, 15, 5]
        }],
        chart: {
            type: 'bar',
            height: 350,
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Stars'],
        },
        colors: ['#fbbc05'],
        toolbar: {
            show: false
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

</script>
<script>
    // Get all the star elements
    const stars = document.querySelectorAll('.star');

    // Add event listeners to each star element
    stars.forEach((star) => {
        star.addEventListener('click', () => {
            // Get the value of the clicked star
            const value = star.getAttribute('data-value');

            // Set all the stars up to the clicked star as active
            stars.forEach((s, i) => {
                if (i < value) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });

            // Send the rating to the server (replace this with your own code)
            console.log(`User selected rating ${value}`);
        });
    });

</script>

<!-- The Modal -->
<div id="review-modal" class="modal">
    <!-- Modal content -->
    <div class="card card-md" style="width: 32%; margin-top: 20%;margin-left: 32%">
        <div class="card-body">
            <span class="close" onclick="closeReviewModal()">&times;</span>
            <h5 class="card-title">Write a Review</h5>
            <div class="rating">
                <span class="star" data-value="1" style="--star-value: 1;"><i class="bi bi-star-fill"></i></span>
                <span class="star" data-value="2" style="--star-value: 2;"><i class="bi bi-star-fill"></i></span>
                <span class="star" data-value="3" style="--star-value: 3;"><i class="bi bi-star-fill"></i></span>
                <span class="star" data-value="4" style="--star-value: 4;"><i class="bi bi-star-fill"></i></span>
                <span class="star" data-value="5" style="--star-value: 5;"><i class="bi bi-star-fill"></i></span>
            </div>
            <hr>
            <form class="row g-3">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="title" placeholder="Title">
                        <label for="title">Title</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Comment" id="comment" style="height: 100px;"></textarea>
                        <label for="comment">Comment</label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End floating Labels Form -->

        </div>
    </div>

<!--    <div style="background-color: aliceblue" class="modal-content">-->
<!--        <span class="close" onclick="closeReviewModal()">&times;</span>-->
<!--        <form style="text-align: center;">-->
<!--            <label class="card-title" for="rating">Rating:</label>-->
<!--            <input style="background-color: lightcyan" type="number" name="rating" min="1" max="5">-->
<!--            <br>-->
<!--            <textarea style="width: 700px;background-color: lightcyan" name="review" placeholder="Write Review here..." ></textarea>-->
<!--            <br>-->
<!--            <button class="btn btn-primary" type="submit">Submit</button>-->
<!--        </form>-->
<!--    </div>-->
</div>

<!-- JavaScript to handle the Modal -->
<script>
// Get the modal
var modal = document.getElementById("review-modal");

// Get the button that opens the modal
var btn = document.getElementsByTagName("button")[0];

// Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal
  function openReviewModal() {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  function closeReviewModal() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
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
</body>

</html>
<?php
//this is the landing page B8860BFF?>

