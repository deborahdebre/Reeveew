<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//check if register form was submited
//by checking if the submit button element name was sent as part of the request
if (isset($_POST['register']))
{
    //collection form data
    $first_name =  $_POST['fname'];
    $last_name =  $_POST['lname'];
    $user_email =  $_POST['mail'];
    $user_gender =  $_POST['gender'];
    $user_pass = $_POST['upassword'];
    $confirm_user_pass = $_POST['cpassword'];

    //check if entered password matches
    if ($user_pass != $confirm_user_pass) {
        //redirect to registration
        header("Location: registration_page.php");
        exit();
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

    //encrypt password
    //use the php md5 function
    $encrypted_pass = md5($user_pass);

    // Check if user is already registered
    $sql = "SELECT * FROM user_info WHERE user_email = '$user_email'";
    echo $sql;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User already exists in system, redirect to registration page
        header("Location: registration_page.php?exists=yes");
        exit();
    }
    else {
        // Insert user details into the database
        //user role (1 is admin, 2 is standard user) By default a user is registered as a standard user
        $sql = "INSERT INTO user_info (role_id, user_lname, user_fname, user_email, user_gender, user_pass)
	    VALUES ('2','$last_name','$first_name','$user_email','$user_gender','$encrypted_pass')";

        if (mysqli_query($conn, $sql)) {
            echo "User registration successful";
            //redirect to homepage
            header("Location: login_page.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
        // Close the connection
        mysqli_close($conn);

}
else
{
    //redirect to register page
    header("Location: registration_page.php");
    exit();
}

