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

// Retrieve all submitted business requests from the database
$sql = "SELECT * FROM user_request WHERE request_id='$request_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$business_name = $row['business_name'];
$keywords = $row['keywords'];
$description = $row['description'];
$work_time = $row['working_time'];
$business_email = $row['business_email'];
$location_id = $row['location_id'];
$phone_num = $row['phone_num'];
$location = $row['location'];
$category_id = $row['category_id'];

if($action==0){
    //update the status of the request to 'denied'
    $sql = "UPDATE user_request SET status_id=3 WHERE request_id='$request_id'";}
else if ($action==1){
    //update the status of the request to 'approved'
    $sql = "UPDATE user_request SET status_id=2 WHERE request_id='$request_id'";
    $sql1 = "INSERT INTO business_details (business_name, keywords, working_time,business_email, phone_num, description,location, category_id,location_id)
    VALUES('$business_name','$keywords','$work_time','$business_email','$phone_num','$description','$location','$category_id','$location_id')";

}

if (mysqli_query($conn, $sql)) {
    mysqli_query($conn, $sql1);
    echo "Request processed successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
