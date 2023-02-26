
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
<style>
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
        fill: linear-gradient(to right, gold 0%, gold calc(100% - 80% / 5 * (5 - var(--star-value)))), transparent calc(20% / 5 * (5 - var(--star-value))) 100%;
    }


</style>
<body>
<div class="card card-md">
    <div class="card-body">
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
</body>
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
</html>