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

$business_id = $_GET['business_id'];

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
$sql = "SELECT * FROM business_details WHERE business_id = '$business_id'";
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
$average_rating = $row['average_rating'];

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


// Define a function to convert a rating to a number of stars
function rating_to_stars($rating) {
    return str_repeat('⭐️', $rating);
}

// Convert the average rating to a number of stars
$average_stars = rating_to_stars(round($average_rating));

// Get count for 1 star
$sql = "SELECT COUNT(*) AS count FROM review WHERE business_id = '$business_id' AND rating='1'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$one_star = $row['count'];

// Get count for 2 stars
$sql = "SELECT COUNT(*) AS count FROM review WHERE business_id = '$business_id' AND rating='2'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$two_stars = $row['count'];

// Get count for 3 stars
$sql = "SELECT COUNT(*) AS count FROM review WHERE business_id = '$business_id' AND rating='3'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$three_stars = $row['count'];

// Get count for 4 stars
$sql = "SELECT COUNT(*) AS count FROM review WHERE business_id = '$business_id' AND rating='4'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$four_stars = $row['count'];

// Get count for 5 stars
$sql = "SELECT COUNT(*) AS count FROM review WHERE business_id = '$business_id' AND rating='5'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$five_stars = $row['count'];

$dataStars = array($five_stars,$four_stars,$three_stars,$two_stars,$one_star);
$data_json = json_encode($dataStars);

// Get image path
$sql = "SELECT * FROM Image WHERE business_email='$business_email'";
$result = mysqli_query($conn, $sql);

// create an empty array to hold the image paths
$imagePaths = array();
// loop through the query result and append each image path to the array
while ($row = mysqli_fetch_assoc($result)) {
    $imagePaths[] = $row['image_path'];
}

// access each image path by index
$image1 = $imagePaths[0];
$image2 = $imagePaths[1];
$image3 = $imagePaths[2];

$sql1="SELECT review.review_id, review.rating,review.review_comments,user_info.user_fname, user_info.user_lname,user_info.user_email
FROM review
INNER JOIN user_info ON review.user_id = user_info.user_id
WHERE business_id='$business_id' ";

$result1 = mysqli_query($conn, $sql1);

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

        .rate {
            float: right;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:left;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
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

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">


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
                    <img style=" height: 360px; width: 300px;" src="<?php echo $image1 ?>" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img style=" height: 360px; width: 300px;" src="<?php echo $image2?>" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img style=" height: 360px; width: 300px;" src="<?php echo $image3?>" class="d-block w-100" alt="">
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
            data: <?php echo $data_json; ?>
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

<!-- The Modal -->
<div id="review-modal" class="modal">
    <!-- Modal content -->
    <div class="card card-md" style="width: 32%; margin-top: 20%;margin-left: 32%">
        <div class="card-body">
            <span class="close" onclick="closeReviewModal()">&times;</span>
            <h5 class="card-title">Write a Review</h5>



            <form class="row g-3" method="post" action="submit_review.php">
                <div class="rate">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
            </div>

<!--                <input style="align-items: center" type="number" style='width: 60px' id="rating" name="rating" value="" >-->
                <hr>
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
                <input type="hidden" name="business_id" value="<?php echo $business_id?>">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="title" placeholder="Title">
                        <label for="title">Title</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" name="comment" placeholder="Comment" id="comment" style="height: 100px;"></textarea>
                        <label for="comment">Comment</label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End floating Labels Form -->

        </div>
    </div>

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

const myrating = document.getElementById("rating");
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


<?php
if (!(mysqli_num_rows($result1) > 0)) {
    echo "<p style='text-align: center;color: red'>... No Reviews ...</p>";
    exit();
}

?>
<table style="width: 92%;margin-left: 4%; margin-bottom: 5%" id="myTable" class="table table-striped">
    <thead>
    <tr>
        <th></th>
        <th scope="col">Name</th>
        <th scope="col">Rating </th>
        <th scope="col">Comments</th>
    </tr>
    </thead>

    <tbody>

    <?php

    while($row = mysqli_fetch_assoc($result1)) {
        $user_fname= $row['user_fname'];
        $user_lname = $row['user_lname'];
        $user_email = $row['user_email'];
        $rating = $row['rating'];
        $review_id = $row['review_id'];
        $review_comments = $row['review_comments'];

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

        // Get image path
        $sql = "SELECT image_path FROM Image WHERE user_email='$user_email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $image_path = $row['image_path'];

        echo "<tr>";
        echo "<td><img style='width: 35px;height:35px' src='$image_path' alt='' class='rounded-circle'></td>";
        echo "<td>".$user_fname.' '.$user_lname."</td>";
        echo "<td>".$rating."</td>";
        echo "<td>".$review_comments."</td>";
        echo "</tr>";
    }
    ?>


    </tbody>
</table>


</body>

</html>
<?php
//this is the landing page B8860BFF?>

