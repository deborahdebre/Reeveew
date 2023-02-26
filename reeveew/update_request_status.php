<?php

$request_id = $_POST['request_id'];
$action = $_POST['button_id'];
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

if($action==0){
    //update the status of the request to 'denied'
    $sql = "UPDATE user_request SET status_id=3 WHERE request_id='$request_id'";}
else if ($action==1){
    //update the status of the request to 'approved'
    $sql = "UPDATE user_request SET status_id=2 WHERE request_id='$request_id'";
}

if (mysqli_query($conn, $sql)) {
    echo "Request processed successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
