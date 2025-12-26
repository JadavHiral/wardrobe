<?php
session_start();
include_once("db_connect.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($product_id > 0) {
    // Check if product already in wishlist
    $check = $conn->prepare("SELECT id FROM wishlist WHERE user_id=? AND product_id=?");
    $check->bind_param("ii", $user_id, $product_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows == 0) {
        // Insert into wishlist
        $stmt = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
    }
}

// Redirect to wishlist page
header("Location: wishlist.php");
exit;
?>
