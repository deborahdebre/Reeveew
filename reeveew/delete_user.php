<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the POST variable is set
if (!isset($_POST['user_id'])) {
    echo "Error: User ID not provided";
    exit();
}

$person_id = $_POST['user_id'];

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

$sql = "DELETE FROM user_info WHERE user_id='$person_id'";
error_log($sql);
if (mysqli_query($conn, $sql)) {
    error_log("User record deleted successfully");
} else {
    error_log("Error deleting user record: " . mysqli_error($conn));
}

// Close the connection
mysqli_close($conn);

