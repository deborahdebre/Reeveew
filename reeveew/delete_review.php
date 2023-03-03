<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the POST variable is set
if (!isset($_POST['review_id'])) {
    echo "Error: Review ID not provided";
    exit();
}

$review_id = $_POST['review_id'];

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

$sql = "DELETE FROM review WHERE review_id='$review_id'";
error_log($sql);
if (mysqli_query($conn, $sql)) {
        error_log("Review record deleted successfully");
} else {
    error_log("Error deleting Review record: " . mysqli_error($conn));
}

// Close the connection
mysqli_close($conn);

