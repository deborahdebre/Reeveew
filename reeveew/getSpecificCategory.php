<?php
session_start();

require_once 'functions.php';

// Set default values for user session
if (!isset($_SESSION['user_id'])) {
    $user_name = "there";
    $nav_state = "Login";
    $state = 0;
} else {
    $user_name = $_SESSION["user_name"];
    $nav_state = "Logout";
    $state = 1;
}

// Retrieve all categories from the database
$categories = getCategories();

// Retrieve businesses for the selected category
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $businesses = getBusinessesByCategory($category_id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Location Selection</title>
</head>
<body>
<form>
    <?php foreach ($categories as $category) { ?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="<?php echo $category['id']; ?>" id="category-option<?php echo $category['id']; ?>">
            <label class="form-check-label" for="category-option<?php echo $category['id']; ?>"><?php echo $category['name']; ?></label>
        </div>
    <?php } ?>
    <button type="submit">Submit</button>
</form>

<?php if (isset($businesses)) { ?>
    <section class="section" style="padding-left: 30%; padding-top: 7%">
        <div class="row">
            <?php foreach ($businesses as $business) { ?>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $business['image_path']; ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $business['name']; ?></h5>
                                    <p class="card-text"><?php echo $business['description']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
</body>
</html>
