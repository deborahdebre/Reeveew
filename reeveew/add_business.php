<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//check if register form was submited
//by checking if the submit button element name was sent as part of the request
if (isset($_POST['submit']))
{
    //collection form data
    $business_name = $_POST['businessName'];;
    $keywords = $_POST['keywords'];;
    $description = $_POST['description'];
    $work_time = $_POST['working_time'];
    $business_email = $_POST['businessEmail'];
    $phone_num = $_POST['phoneNum'];
    $location = $_POST['location'];
    $category_id = $_POST['category'];

    //database connection parameters
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

    // Insert REQUEST into the database

    $sql = "INSERT INTO user_request (status_id,business_name, keywords, working_time,business_email, phone_num, description,location, category_id,image_path)
    VALUES('1','$business_name','$keywords','$work_time','$business_email','$phone_num','$description','$location','$category_id','here/here')";

    if (mysqli_query($conn, $sql)) {
            echo " successful";
            //redirect to homepage
            header("Location: user_request.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    // Close the connection
    mysqli_close($conn);

}
else
{
    //redirect to login page
    header("Location: login_page.php");
    exit();
}

