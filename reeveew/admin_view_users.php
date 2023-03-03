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

// Retrieve all users from the database
$sql = "SELECT * FROM user_info WHERE role_id=2";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Reeveew/Manage Users</title>
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
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
        }

        .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
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

    <input style="width: 600px;margin-left: 3%;padding-left: 20px" type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search Users...">
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

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
    function deleteUser(user_id) {
        // send a request to update the request status
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_user.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log(this.responseText);
                // reload the page to see the updated requests
                window.location.reload();
            }
        }
        xhr.send("user_id=" + user_id);
    }
    function showProfile(id) {
        // Get the modal popup
        var modal = document.getElementById("profileModal");

        // Get the close button element
        var closeBtn = modal.querySelector(".close");

        // Show the modal popup
        modal.style.display = "block";

        // Fetch the user profile using AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Display the user profile in the popup
                var profileDetails = modal.querySelector("#profileDetails");
                profileDetails.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "getProfile.php?user_id=" + id, true);
        xhttp.send();

        // Add a click event listener to the close button to hide the modal popup
        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });
    }

</script>


<div style="margin-top: 4%;" class="card">
<div class="card-body">
    <div style="margin-top: 3%;text-align: center;margin-bottom: 3%" class="pagetitle">
        <h1>Manage Users</h1>

    </div><!-- End Page Title -->

    <table style="margin-left: 13%;width: 900px" id="myTable" class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col"></th>
            <th scope="col">Delete User</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!(mysqli_num_rows($result) > 0)) {
            echo "<p style='text-align: center;color: red'>...There are currently no users in the system...</p>";
        }
        $counter=1;
        while($row = mysqli_fetch_assoc($result)) {
            $person_id = $row['user_id'];
            $person_fname = $row['user_fname'];
            $person_lname = $row['user_lname'];
            $person_email = $row['user_email'];
            $person_gender = $row['user_gender'];

            echo "<tr>";
            echo "<td>".$counter."</td>";
            echo "<td>".$person_fname.' '.$person_lname."</td>";
            echo "<td>".$person_email."</td>";
            echo "<td>".$person_gender."</td>";
            echo "<td><button class='btn btn-link' onclick='showProfile(\"$person_id\")'>View Profile</button></td>";
            echo "<td><button style='margin-left: 14%' type='button' class='btn btn-danger' onclick=\"deleteUser($person_id)\"><i class='bi bi-trash'></i></button></td>";
            echo "</tr>";
            $counter = $counter + 1;
        }
        ?>

        </tbody>
    </table>
    <div class="modal" id="profileModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h5 style="text-align: center" class="pagetitle">User Profile</h5>
            <div id="profileDetails">
                <!-- Profile details will be displayed here -->
            </div>
        </div>
    </div>




</div>

    <script>
        function searchTable() {
            // Get input element and table
            const input = document.getElementById("searchInput");
            const table = document.getElementById("myTable");
            // Get table rows
            const rows = table.getElementsByTagName("tr");
            // Get search keyword and convert to lowercase
            const keyword = input.value.toLowerCase();
            // Loop through rows and hide/show based on search keyword
            for (let i = 0; i < rows.length; i++) {
                const name = rows[i].getElementsByTagName("td")[1];
                const email = rows[i].getElementsByTagName("td")[2];
                const gender = rows[i].getElementsByTagName("td")[3];
                if (name || email || gender) {
                    const nameValue = name.textContent.toLowerCase();
                    const emailValue = email.textContent.toLowerCase();
                    const genderValue = gender.textContent.toLowerCase();
                    if (nameValue.includes(keyword) || emailValue.includes(keyword) || genderValue.includes(keyword)) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
        }

    </script>

</body>

</html>

