<?php
//this is the page where the admin can see all requests made to add businesses
session_start();
if(!(isset($_SESSION['user_id'])) and $_SESSION["user_role"] !=1 ){
    header ("Location: login_page.php");
}
$user_name = $_SESSION["user_name"];

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
$sql = "SELECT * FROM user_request WHERE status_id=1 AND request_id='$request_id'";
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

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.5.0
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="admin_analytics.php" class="logo d-flex align-items-center">
            <img src="../assets/img/starlogo.png" alt="">
            <span class="d-none d-lg-block">Reeveew</span>
        </a>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">Hello  <?php echo $user_name; ?></span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <span>What do you want to do?</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="admin_analytics.php">
                            <i class="bi bi-graph-down"></i>
                            <span>View Analytics</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="admin_manage_requests.php">
                            <i class="bi bi-patch-question"></i>
                            <span>Manage Requests</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="admin_manage_businesses.php">
                            <i class="bi bi-buildings"></i>
                            <span>Manage Businesses</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="admin_view_users.php">
                            <i class="bi bi-person"></i>
                            <span>Manage Users</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="admin_view_feedback.php">
                            <i class="bi bi-pencil-square"></i>
                            <span>View Feedback</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="process_logout.php">
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Logout</span>
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
<script>
    function processRequest(request_id,button_id) {
        // send a request to update the request status
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "update_request_status.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Redirect to a new page
                window.location.href = "admin_manage_requests.php";
            }
        }
        if(button_id===1){
            xhr.send("request_id=" + request_id + "&button_id=1"); // set status to approved
        }
        else if(button_id===0){
            xhr.send("request_id=" + request_id + "&button_id=0"); // set status to denied
        }

    }
</script>
    <div style="margin-top: 7%;text-align: center;margin-bottom: 3%" class="pagetitle">
        <h1>Manage Request for <?php echo $business_name; ?></h1>
    </div><!-- End Page Title -->

    <section style="margin-left: 12%" class="section profile">
        <div class="row">

            <div style=" height: 150px;width: 200px; margin-right: 2%" class="col-xl-3">

                <div  class="card">
                    <img style=" height: 150px; width: 200px;" src="<?php echo $image1?>" alt="">
                </div>
                <div class="card">
                    <img style=" height: 150px; width: 200px;" src="<?php echo $image2?>" alt="">
                </div>
                <div class="card">
                    <img style=" height: 150px; width: 200px;" src="<?php echo $image3?>" alt="">
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Request</button>
                            </li>
                            <li class="nav-item">
                                <button style="margin-left: 400%" class="btn btn-success" onclick="processRequest(<?php echo $request_id; ?>,1)">Accept</button>
                            </li>
                            <li class="nav-item">
                                <button style="margin-left: 520%" class="btn btn-danger" onclick="processRequest(<?php echo $request_id; ?>,0)">Deny</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Business Description</h5>
                                <p class="small fst-italic"> <?php echo $description; ?></p>

                                <h5 class="card-title">Business Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Business Name</div>
                                    <div class="col-lg-9 col-md-8"> <?php echo $business_name; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Category</div>
                                    <div class="col-lg-9 col-md-8"> <?php echo $category; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Location</div>
                                    <div class="col-lg-9 col-md-8"> <?php echo $location; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8"> <?php echo $phone_num; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"> <?php echo $business_email; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Open/Close</div>
                                    <div class="col-lg-9 col-md-8"> <?php echo $work_time; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Keywords</div>
                                    <div class="col-lg-9 col-md-8"> <?php echo $keywords; ?></div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="update_request.php" method="POST">
                                    <input name="id" value="<?php echo $request_id; ?>" hidden="">
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Business Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="businessName" type="text" class="form-control" id="businessName" value="<?php echo $business_name; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">Business description</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="description" class="form-control" id="about" style="height: 100px"><?php echo $description; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Category</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select name="category_id" class="form-select" id="validationDefault04"  required>
                                                <option value=1>Hotel</option>
                                                <option value=2>Restaurant</option>
                                                <option value=3>Salon</option>
                                                <option value=4>Spa</option>
                                                <option value=5>Event</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Location</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="location" type="text" class="form-control" id="location" value="<?php echo $location; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $phone_num; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="mail" type="text" class="form-control" id="mail" value="<?php echo $business_email; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Open/Close</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="opcl" type="text" class="form-control" id="opcl" value="<?php echo $work_time; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Keywords</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="keywords" type="text" class="form-control" id="keywords" value="<?php echo $keywords; ?>">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>



                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
<script>
    const mySelect = document.getElementById("validationDefault04");
    mySelect.selectedIndex =  <?php echo $category_id -1; ?>;

</script>


</body>

</html>
<?php
//this is the page where the admin views a specific business request?>


<?php
?>