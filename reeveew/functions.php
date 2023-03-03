<?php

function getCategories() {
    $pdo = new PDO("mysql:host=localhost;dbname=reeveew", "root", "password");
    $stmt = $pdo->prepare("SELECT * FROM category");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBusinessesByCategory($category_id) {
    $pdo = new PDO("mysql:host=localhost;dbname=reeveew", "root", "password");
    $stmt = $pdo->prepare("SELECT bd.business_name as name, bd.description as description, i.image_path as image_path
        FROM business_details bd
        JOIN image i ON bd.business_id = i.business_id
        JOIN business_category bc ON bd.business_id = bc.business_id
        WHERE bc.category_id = ?");
    $stmt->execute([$category_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addBusiness($business_name, $description, $category_ids, $image_path) {
    $pdo = new PDO("mysql:host=localhost;dbname=reeveew", "root", "password");
    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("INSERT INTO business_details (business_name, description) VALUES (?, ?)");
        $stmt->execute([$business_name, $description]);
        $business_id = $pdo->lastInsertId();
        $stmt = $pdo->prepare("INSERT INTO image (business_id, image_path) VALUES (?, ?)");
        $stmt->execute([$business_id, $image_path]);
        foreach ($category_ids as $category_id) {
            $stmt = $pdo->prepare("INSERT INTO business_category (business_id, category_id) VALUES (?, ?)");
            $stmt->execute([$business_id, $category_id]);
        }
        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollback();
        throw $e;
    }
}

function addUser($username, $password, $email) {
    $pdo = new PDO("mysql:host=localhost;dbname=reeveew", "root", "password");
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $email]);
}

function getUserByUsername($username) {
    $pdo = new PDO("mysql:host=localhost;dbname=reeveew", "root", "password");
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserByEmail($email) {
    $pdo = new PDO("mysql:host=localhost;dbname=reeveew", "root", "password");
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>


