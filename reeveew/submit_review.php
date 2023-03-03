<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//check if register form was submited
//by checking if the submit button element name was sent as part of the request
if (isset($_POST['submit']))
{   $business_id = $_POST['business_id'];
    if (isset($_POST['rate'])) {
    //collection form data
        $user_id = $_POST['user_id'];
        $rating = $_POST['rate'];
        $comment =$_POST['comment'];

        if (empty($comment)) {
            $comment="No comment";
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


    // Insert user details into the database
    //user role (1 is admin, 2 is standard user) By default a user is registered as a standard user
    $sql = "INSERT INTO review (user_id, business_id, rating, review_comments)
	    VALUES ('$user_id','$business_id','$rating','$comment')";

    if (mysqli_query($conn, $sql)) {
        echo "Successful";

    // Close the connection
    mysqli_close($conn);
    //redirect to business_details
    header("Location: business_details.php?business_id=$business_id");
    exit();}
    else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}
    else{
        // Display confirmation message
        $message = "You must include a rating.";
        echo "<script>if (confirm('$message')) { window.location.href = 'business_details.php?business_id=$business_id'; }</script>";
        exit();
    }
}
else
{
    //redirect to index page
    header("Location: index.php");
    exit();
}

