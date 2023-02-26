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

// Retrieve all submitted business requests from the database
$sql = "SELECT * FROM user_request WHERE status_id=1";
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
    function processRequest(request_id,button_id) {
        // send a request to update the request status
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "update_request_status.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // reload the page to see the updated requests
                window.location.reload();
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

<div style="margin-top: 4%;" class="card">
    <div class="card-body">
        <div style="margin-top: 3%;text-align: center;margin-bottom: 3%" class="pagetitle">
            <h1>Manage Requests</h1>

        </div><!-- End Page Title -->
        <!-- Default Table -->
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Business Name</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            <?php
            if (!(mysqli_num_rows($result) > 0)) {
                echo "<p style='text-align: center;color: red'>...There are no pending Requests...</p>";
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
                $request_id = $row['request_id'];
                
                echo "<tr>";
                echo "<td>".$counter."</td>";
                echo "<td>".$row['business_name']."</td>";
                echo "<td>".$category."</td>";
                echo "<td>".$row['description']."</td>";
                echo "<td><a href='admin_view_request.php?request_id=".$request_id."'>See More</a></td>";
                echo "<td><button class='btn btn-success' onclick=\"processRequest($request_id,1)\">Approve</button></td>";
                echo "<td><button class='btn btn-danger' onclick=\"processRequest($request_id,0)\">Deny</button></td>";
                echo "</tr>";
                $counter = $counter + 1;
            }
            ?>

            </tbody>
        </table>
        <!-- End Default Table Example -->
    </div>
</div>
</body>

</html>

