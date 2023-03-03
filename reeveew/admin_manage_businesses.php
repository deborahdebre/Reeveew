<?php
//this is the page where the admin can see all requests made to add businesses
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Retrieve all businesses from the database
$sql = "SELECT * FROM business_details";
$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Reeveew/Manage Requests</title>
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
                    <span class="d-none d-md-block dropdown-toggle ps-2">Hello <?php echo $user_name; ?></span>
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
    function deleteBusiness(business_id) {
        // send a request to update the request status
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_business.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log(this.responseText);
                // reload the page to see the updated requests
                window.location.reload();
            }
        }
        xhr.send("business_id=" + business_id);
    }
</script>
<div style="margin-top: 4%;" class="card">
    <div class="card-body">
        <div style="margin-top: 3%;text-align: center;margin-bottom: 3%; display: flex;" class="pagetitle">
            <h1 style="margin-left: 42%;text-align: center">Manage Businesses</h1>
            <a href="admin_add_business_form.php"><i style="color: darkgreen; margin-left: 200%" class="bi bi-plus-square"></i></a>
        </div>

        <!-- End Page Title -->
        <!-- Table with hoverable rows -->
        <table  class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Business Name</th>
                <th scope="col">Category</th>
                <th scope="col">Business Email</th>
                <th scope="col">Location</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Working Times</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!(mysqli_num_rows($result) > 0)) {
                echo "<p style='text-align: center;color: red'>There are currently no businesses in the system</p>";
            }
            $counter=1;
            while($row = mysqli_fetch_assoc($result)) {
                if($row['category_id']==1){
                    $category = "Hotel";
                }
                elseif ($row['category_id']==2){
                    $category = "Restaurant";
                }
                elseif ($row['category_id']==3){
                    $category = "Salon";
                }
                elseif ($row['category_id']==4){
                    $category = "Spa";
                }
                elseif ($row['category_id']==5){
                    $category = "Event";
                }
                $business_id = $row['business_id'];
                $business_name = $row['business_name'];
                $work_times = $row['working_time'];
                $business_email = $row['business_email'];
                $keywords = $row['keywords'];
                $location = $row['location'];
                $phone_num = $row['phone_num'];

                echo "<tr>";
                echo "<td>".$counter."</td>";
                echo "<td>".$business_name."</td>";
                echo "<td>".$category."</td>";
                echo "<td>".$business_email."</td>";
                echo "<td>".$location."</td>";
                echo "<td>".$phone_num."</td>";
                echo "<td>".$work_times."</td>";
                echo "<td><a href='edit_business.php?business_id=".$business_id."'><i class='bi bi-pencil'></i></a></td>";
                echo "<td><button style='background: none;border: none' type='button' onclick=\"deleteBusiness($business_id)\"><i style='color: red' class='bi bi-trash'></i></button></td>";
                echo "</tr>";
                $counter = $counter + 1;
            }
            ?>
            </tbody>
        </table>
        <!-- End Table with hoverable rows -->
    </div>
</div>

</body>

</html>

