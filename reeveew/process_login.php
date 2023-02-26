<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "reeveew";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered email and password
    $entered_email = $_POST["mail"];
    $entered_password =  md5($_POST["password"]);

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the SELECT statement
    $sql = "SELECT * FROM user_info WHERE user_email = '$entered_email' AND user_pass = '$entered_password'";
    $result = mysqli_query($conn, $sql);

    // Check if a matching record was found
    if (!(mysqli_num_rows($result) > 0)) {
        // The entered email and password were incorrect
        //redirect to log in page
        header("Location: login_page.php?isvalid=no");
        exit();
    }
    else{
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];
        $user_fname = $row["user_fname"];
        $user_role = $row["role_id"];

        session_start();
        // Set session variables
        $_SESSION["user_id"] = $user_id;
        $_SESSION["user_role"] = $user_role;
        $_SESSION["user_name"] = $user_fname;

        if ($user_role == 1 ) {
            //redirect to analytics page for admin
            header("Location: admin_analytics.php");
            exit();
        }
        elseif ($user_role == 2){
            //redirect to landing page for logged in standard user
            header("Location: index.php");
            exit();
        }
    }
    // Close the connection
    mysqli_close($conn);
}

