<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//check if register form was submited
//by checking if the submit button element name was sent as part of the request
if (isset($_POST['submit']))
{
        //collection form data
        $user_id = $_POST['user_id'];
        $user_feedback =$_POST['user_feedback'];

        if (empty($user_id)) {
            $sql = "INSERT INTO user_feedback ( feedback)
	    VALUES ('$user_feedback')";
        }
        else{
            $sql = "INSERT INTO user_feedback (user_id, feedback)
	    VALUES ('$user_id','$user_feedback')";
        }

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

        if (mysqli_query($conn, $sql)) {
            echo "Successful";

            // Close the connection
            mysqli_close($conn);
            //redirect to business_details
            header("Location: contact_us_page.php");
            exit();}
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

else
{
    //redirect to index page
    header("Location: index.php");
    exit();
}

