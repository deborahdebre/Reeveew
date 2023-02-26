<?php

$request_id = $_POST['id'];
$business_name = $_POST['businessName'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];
$location = $_POST['location'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$work_time= $_POST['opcl'];
$keywords = $_POST['keywords'];


//database connection parameters
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "reeveew";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE user_request SET business_name='$business_name', keywords='$keywords', working_time='$work_time',business_email='$mail',
                        phone_num='$phone', description='$description',location='$location', category_id='$category_id' WHERE request_id='$request_id'";


if (mysqli_query($conn, $sql)) {
    header("Location: admin_view_request.php?request_id=$request_id");
    exit();
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
