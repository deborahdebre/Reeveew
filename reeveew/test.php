<?php
session_start();

// database configuration
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "reeveew";

// create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// parse query string parameters
$stringTemp = "location=3&rating=1&category=5&price_min=0&price_max=500";
parse_str($stringTemp, $query_vars);

$location_options = explode(",", $query_vars['location']);
$rating_options = explode(",", $query_vars['rating']);
$category_options = explode(",", $query_vars['category']);
$price_min = $query_vars['price_min'];
$price_max = $query_vars['price_max'];

$sql = "SELECT bd.business_name, bd.business_id, bd.category_id, bd.description, bd.location, bd.phone_num, bd.working_time, bd.keywords, bd.average_price, bd.average_rating, i.image_path, c.category_name, l.location
            FROM business_details bd
            JOIN Image i ON bd.business_id = i.business_id
            JOIN category c ON bd.category_id = c.category_id
            JOIN location_details l ON bd.location_id = l.location_id
             WHERE 1=1";

if (!empty($location_options)) {
    $location_ids = implode(",", $location_options);
    $sql .= " AND bd.location_id IN ($location_ids)";
}

if (!empty($rating_options)) {
    foreach ($rating_options as $rating) {
        $rating_value = null;
        switch ($rating) {
            case '4.5':
                $rating_value = "4.5";
                break;
            case '2.5':
                $rating_value = "2.5";
                break;
            case '1.5':
                $rating_value = "1.5";
                break;
            case '1':
                $rating_value = "1";
                break;
        }
        if ($rating_value != null) {
            $sql .= " AND bd.average_rating > $rating_value";
        }
    }
}
if (!empty($category_options)) {
    $category_ids = implode(",", $category_options);
    $sql .= " AND bd.category_id IN ($category_ids)";
}

if (!empty($price_min) && !empty($price_max)) {
    $sql .= " AND bd.average_price BETWEEN $price_min AND $price_max";
}

$result = mysqli_query($conn, $sql);


if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

if (mysqli_num_rows($result) > 0) {

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $_SESSION["filter"] = 1;
    $_SESSION["filteredBusinesses"] = $data;
    header("Location: all_businesses.php");
}else{
    header("Location: all_businesses.php");
}

//else {
//    // display SQL query for debugging purposes
//    echo "<script> alert('".$sql."') </script>";
//    header("Location: login.php");
//}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Location Selection</title>
</head>
<body>

</body>
</html>
