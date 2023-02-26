<?php

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
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Get all necessary data for analytics
$sql1 = "SELECT * FROM user_info WHERE role_id=2";
$sql2 = "SELECT * FROM business_details";
$sql3 = "SELECT * FROM user_feedback";
$sql4 = "SELECT * FROM user_request WHERE status_id=1";
$sql5 = "SELECT * FROM user_info WHERE user_gender='male' AND role_id=2 ";
$sql6 = "SELECT * FROM user_info WHERE user_gender='female' AND role_id=2";
$sql7 = "SELECT * FROM user_request WHERE status_id=2";
$sql8 = "SELECT * FROM user_request WHERE status_id=3";

//users in the system
$result = mysqli_query($conn, $sql1);
$reg_users = mysqli_num_rows($result);

//businesses in the system
$result1 = mysqli_query($conn, $sql2);
$reg_businesses = mysqli_num_rows($result1);

//feedback in the system
$result2 = mysqli_query($conn, $sql3);
$feedback = mysqli_num_rows($result2);

//pending requests in the system
$result3 = mysqli_query($conn, $sql4);
$pending_requests = mysqli_num_rows($result3);

//users gender
$result4 = mysqli_query($conn, $sql5);
$male = mysqli_num_rows($result4);

$result5 = mysqli_query($conn, $sql6);
$female = mysqli_num_rows($result5);

//approved requests in the system
$result6 = mysqli_query($conn, $sql7);
$approved_requests = mysqli_num_rows($result6);

//denied requests in the system
$result7 = mysqli_query($conn, $sql8);
$denied_requests = mysqli_num_rows($result7);

// Close the connection
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Reeveew/Dashboard</title>
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

<div style="margin-top: 4%;" class="card">
    <div class="card-body">
        <div style="margin-top: 3%;text-align: center;margin-bottom: 3%" class="pagetitle">
            <h1>Dashboard</h1>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Businesses stats -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">


                                <div class="card-body">
                                    <h5 class="card-title">Businesses</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-buildings-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $reg_businesses;?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Businesses stats Card -->

                        <!-- Registered Users Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Registered Users</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $reg_users;?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Registered Users Card -->

                        <!-- Number of Feedback Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">User Feedback</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-pencil-square"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $feedback;?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Feedback Card -->

                        <!-- Pending Requests Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Pending Requests</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i style="color: darkblue" class="bi bi-question"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $pending_requests;?></h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Pending Requests Card -->

                        <!-- Approved Requests Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Approved Requests</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i style="color: darkgreen" class="bi bi-check2-all"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $approved_requests;?></h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Approved requests Card -->

                        <!-- Denied Requests Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Denied Requests</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i style="color: red" class="bi bi-x-circle"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $denied_requests;?></h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End denied requests Card -->



                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Page Views <span>/Today</span></h5>

                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                    name: 'Page Views',
                                                    data: [31, 40, 28, 51, 42, 82, 56],
                                                }],
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                colors: ['#4154f1'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'datetime',
                                                    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'dd/MM/yy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                    </script>
                                    <!-- End Line Chart -->

                                </div>

                            </div>
                        </div><!-- End Reports -->

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Top Rated Businesses <span>| Today</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Business</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Last Rated</th>
                                            <th scope="col">Ratings <i class="bi bi-star"></i></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">#1</th>
                                            <td>Golden Tulip</td>
                                            <td>Hotel</td>
                                            <td>2/02/2023</td>
                                            <td>4.8 </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#2</th>
                                            <td>Kempinski</td>
                                            <td>Hotel</td>
                                            <td>1/02/2023</td>
                                            <td>4.5 </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#3</th>
                                            <td>Bondai</td>
                                            <td>Restaurant</td>
                                            <td>2/02/2023</td>
                                            <td>4.5 </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#4</th>
                                            <td>Twists & locs Salon</td>
                                            <td>Salon</td>
                                            <td>2/02/2023</td>
                                            <td>4.2 </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#5</th>
                                            <td>Kora Spa</td>
                                            <td>Spa</td>
                                            <td>2/02/2023</td>
                                            <td>4 </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->



                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- User Gender distribution  -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h6 class="card-title">User Gender Distribution</h6>

                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#trafficChart")).setOption({
                                        tooltip: {
                                            trigger: 'item'
                                        },
                                        legend: {
                                            top: '5%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Gender',
                                            type: 'pie',
                                            radius: ['40%', '70%'],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: 'center'
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: false
                                            },
                                            data: [{
                                                value:  <?php echo $male; ?>,
                                                name: 'Male'
                                            },
                                                {
                                                    value: <?php echo $female; ?>,
                                                    name: 'Female'
                                                },

                                            ]
                                        }]
                                    });
                                });
                            </script>

                        </div>
                    </div><!-- End gender distribution -->

                    <!-- News & Updates Traffic -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h5 class="card-title">User Feedback <span>| Today</span></h5>

                            <div class="news">
                                <div class="post-item clearfix">
                                    <img src="../assets/img/girl1.jpeg" alt="">
                                    <h4><a href="#">Miriam Duke</a></h4>
                                    <p>I love using your app, but I noticed that it crashes whenever I try to filter reviews by date. Could you please look into this issue? Thank you!"
                                    </p>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="../assets/img/girl2.jpeg" alt="">
                                    <h4><a href="#">Aiishaa Nuhu</a></h4>
                                    <p>Your app is already great, but I think it would be even better if you could add a feature that allows users to save their favorite businesses. It would be really helpful. Thanks!</p>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="../assets/img/girl3.jpeg" alt="">
                                    <h4><a href="#">Akua Boateng</a></h4>
                                    <p>I really like the design and layout of your app. It's easy to use and navigate. However, I think it would be even better if you could make the font size a bit larger. Thanks for your hard work!</p>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="../assets/img/girl4.jpeg" alt="">
                                    <h4><a href="#">Maame Frimpong</a></h4>
                                    <p>I visited this restaurant based on the reviews on your app and I wasn't disappointed. The food was delicious and the service was excellent. Thank you for the recommendation!</p>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="../assets/img/guy1.jpeg" alt="">
                                    <h4><a href="#">Deloris Kwabenya</a></h4>
                                    <p>I noticed that the address for Golden Tulip is incorrect. It's actually located on the next street over can you please update the address information in your app? Thank you for your attention to this matter.</p>
                                </div>

                            </div><!-- End sidebar recent posts-->

                        </div>
                    </div><!-- End News & Updates -->

                </div><!-- End Right side columns -->

            </div>
        </section>



    </div>
</div>
</body>

</html>


