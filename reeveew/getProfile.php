<?php
// Get the email parameter from the URL
$id = $_GET["user_id"];

// Query the database to fetch the user profile
// Replace this with your own code to query the database and fetch the user profile

// Connect to the database
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

// Retrieve all submitted business requests from the database
$sql = "SELECT * FROM user_info WHERE user_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$u_fname = $row['user_fname'];
$u_lname = $row['user_lname'];
$u_email = $row['user_email'];
$u_gender = $row['user_gender'];

// Get image path
$sql = "SELECT image_path FROM Image WHERE user_email='$u_email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$image_path = $row['image_path'];

$sql1 = "SELECT * FROM review WHERE user_id='$id'";
$result1 = mysqli_query($conn, $sql1);

// Close the connection
mysqli_close($conn);



// Display the user profile
echo "<br>";
echo "<img src=$image_path alt='' class='rounded-circle' style='width: 100px;height:100px; margin-left: 40%;margin-right: 2%'>";
echo "<br>";
echo "<h6 style='text-align: center'>$u_fname $u_lname </h6>";
echo "<table style='margin-left: 3%;width: auto;'>";
echo "<tr style='border: 0.5px grey;'><th>Comments</th></tr>";

while($row = mysqli_fetch_assoc($result1)) {
    $review_id = $row['review_id'];
    $comment = $row['review_comments'];

    echo "<tr>";
    echo "<td>" . $comment . "</td>";
    echo "</tr>";
}
echo "</table>";


?>
</body>
</html>