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
    $user_id = $_POST['user_id'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];
    $work_time = $_POST['working_time'];
    $business_email = $_POST['businessEmail'];
    $location_id = $_POST['location_id'];
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

    $sql = "INSERT INTO user_request (status_id,business_name, keywords, working_time,business_email, phone_num, description,location, category_id,location_id,user_id)
    VALUES('1','$business_name','$keywords','$work_time','$business_email','$phone_num','$description','$location','$category_id','$location_id','$user_id')";

    if (mysqli_query($conn, $sql)) {
            echo " successful";

        $fileCount = count($_FILES['business_pic']['name']);
        // check if exactly three files were uploaded
        if($fileCount === 3) {
            for($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES['business_pic']['name'][$i];
                $fileTmpName = $_FILES['business_pic']['tmp_name'][$i];
                $fileSize = $_FILES['business_pic']['size'][$i];
                $fileType = $_FILES['business_pic']['type'][$i];
                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = array("jpg", "jpeg", "png");
                $uploadFolder = "../assets/request/";
                $fileDestination = $uploadFolder . $fileName;

                if(in_array($fileExt, $allowedExtensions)) {
                    if($fileSize < 5000000) {
                        if(move_uploaded_file($fileTmpName, $fileDestination)) {
                            // save the file path to the database
                            $query = "INSERT INTO Image (business_email,image_path) VALUES ('$business_email','$fileDestination')";
                            mysqli_query($conn, $query);
                            echo "File uploaded successfully.";
                        } else {
                            echo "Error uploading file.";
                        }
                    } else {
                        echo "File size exceeded.";
                    }
                } else {
                    echo "Invalid file type.";
                }
            }
        } else {

            echo "<script> alert('Please upload exactly three files.')</script>";
            header("Location: user_request_form.php");
            exit();
        }
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

