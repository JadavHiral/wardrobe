<?php
include_once("db_connect.php");
session_start();

// Use session username or guest
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']); // Ensure it's integer

    // Prepare delete query to remove the item for this user
    $stmt = $conn->prepare("DELETE FROM add_to_cart WHERE cart_id = ? AND username = ?");
    $stmt->bind_param("is", $cart_id, $username);
    if ($stmt->execute()) {
        // Redirect back to cart with success message
        header("Location: cart_show.php?msg=Item+removed+successfully");
        exit;
    } else {
        // Redirect back to cart with error message
        header("Location: cart_show.php?msg=Error+removing+item");
        exit;
    }
} else {
    // Invalid request
    header("Location: cart_show.php");
    exit;
}
?>
