<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "reeveew";
$conn = null;



if (isset($_GET['method'])) {
    switch ($_GET['method']) {
        case 'filter':
            filter();
            break;
    }
}


function openConnection() {
    global $servername, $username, $password, $dbname, $conn;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

function closeConnection() {
    global $conn;

    if ($conn != null) {
        mysqli_close($conn);
        $conn = null;
    }
}



function filter() {
    global $conn;
    echo "<script>alert('3');</script>";

    if ($conn == null) {
        openConnection();
        echo "<script>alert('4');</script>";
    }
    $stringTemp = $_GET['queryString'];

    echo "<script>alert('" . $_GET['queryString'] . "');</script>";


    parse_str($stringTemp, $query_vars);
    echo "<script>alert('5');</script>";

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
        echo "<script>alert('6');</script>";
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
        echo "<script>alert('7');</script>";
    }
    if (!empty($category_options)) {
        $category_ids = implode(",", $category_options);
        $sql .= " AND bd.category_id IN ($category_ids)";
        echo "<script>alert('8');</script>";
    }

    if (!empty($price_min) && !empty($price_max)) {
        $sql .= " AND bd.average_price BETWEEN $price_min AND $price_max";
        echo "<script>alert('9');</script>";
    }
    echo "<script>alert('10');</script>";
    $result = mysqli_query($conn, $sql);
    echo "<script>alert('11');</script>";

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    if (mysqli_num_rows($result) > 0) {

        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $_SESSION["filter"] = 1;
        $_SESSION["filteredBusinesses"] = $data;
        header("Location: all_businesses.php");
        exit();
    }else{
        header("Location: all_businesses.php");
    }

}

function getAllLocations() {
    global $conn;

    if ($conn == null) {
        openConnection();
    }

    $sql = "SELECT * FROM location_details";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $data;
}

function getAllCategories() {
    global $conn;

    if ($conn == null) {
        openConnection();
    }

    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $data;
}

function getAllBusinesses() {
    global $conn;

    if ($conn == null) {
        openConnection();
    }

    $sql = "SELECT bd.business_name, bd.business_id, bd.category_id, bd.description, bd.location, bd.phone_num, bd.working_time, bd.keywords, bd.average_price, bd.average_rating, i.image_path, c.category_name, l.location
FROM business_details bd
JOIN Image i ON bd.business_id = i.business_id
JOIN category c ON bd.category_id = c.category_id
JOIN location_details l ON bd.location_id = l.location_id;
";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $data;
}


?>