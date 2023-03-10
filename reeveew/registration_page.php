<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Reeveew/Register</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/starlogo.png" rel="icon">
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
<script type='text/javascript'>
    function showMessage() {
        alert("This Account Already Exists");
    }
</script>

<?php
if (isset($_GET['exists'])) {
    $exists = $_GET['exists'];
    if ($exists == "yes") {
        echo "<script type='text/javascript'>showMessage();</script>";
    }
}
?>
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <!-- Logo -->
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="../assets/img/starlogo.png" alt="">
                                <span class="d-none d-lg-block">Reeveew</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Enter your personal details to create account</p>
                                </div>
                                <!-- Create account form -->
                                <form class="row g-3 needs-validation" action="process_registration.php" method="POST"  enctype="multipart/form-data" onsubmit="return validateForm()">
                                    <div class="col-12">
                                        <label for="fname" class="form-label">First Name</label>
                                        <input type="text" name="fname" class="form-control" id="fname" required>
                                        <div class="invalid-feedback">Please, enter your name!</div>
                                    </div>

                                    <div class="col-12">
                                            <label for="lname" class="form-label">Last Name</label>
                                        <input type="text" name="lname" class="form-control" id="lname" required>
                                        <div class="invalid-feedback">Please, enter your name!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="mail" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email" name="mail" class="form-control" id="mail" required>
                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="validationDefault04" class="form-label">Gender</label>
                                        <select name="gender" class="form-select" id="validationDefault04" required>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="upassword" class="form-control" id="password" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="cpassword" class="form-label">Confirm password</label>
                                        <input type="password" name="cpassword" class="form-control" id="cpassword" required>
                                        <div class="invalid-feedback">Please confirm your password!</div>
                                    </div>
                                    <label for="profile_pic">Upload Profile Picture</label>
                                    <input type="file" name="profile_pic" id="profile_pic" required>

                                    <div class="col-12">
                                        <input class="btn btn-primary w-100" name="register" type="submit" value="Create Account">
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Already have an account? <a href="login_page.php">Log in</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

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
    function validateForm() {
        var pass1 = document.getElementById("password").value;
        var pass2 = document.getElementById("cpassword").value;
        if (pass1 != pass2) {
            alert("Passwords do not match");
            return false;
        }
        return true;
    }

    function userExistAlert(){
        alert("This Account Already Exists");
        return true;
    }
</script>
</body>

</html>

