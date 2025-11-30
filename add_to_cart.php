<?php
include_once("db_connect.php");
session_start();

// For demonstration, using a fixed username. Replace with login session in real app
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';

// Get product ID from URL
$pid = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Validate
if ($pid <= 0) {
    exit("Invalid product ID.");
}

// Fetch product info from database
$stmt = $conn->prepare("SELECT pid, pnm, price, img FROM product WHERE pid=? LIMIT 1");
$stmt->bind_param("i", $pid);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    exit("Product not found.");
}

// Quantity (default 1)
$qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;
if ($qty < 1) $qty = 1;

// Check if product already in cart
$stmt = $conn->prepare("SELECT cart_id, qty FROM add_to_cart WHERE pid=? AND username=?");
$stmt->bind_param("is", $pid, $username);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    // Update existing quantity
    $row = $res->fetch_assoc();
    $newQty = $row['qty'] + $qty;
    $update = $conn->prepare("UPDATE add_to_cart SET qty=?, cart_date=CURDATE() WHERE cart_id=?");
    $update->bind_param("ii", $newQty, $row['cart_id']);
    $update->execute();
} else {
    // Insert new item into cart
    $insert = $conn->prepare("INSERT INTO add_to_cart (pid, pnm, price, img, cart_date, qty, username) VALUES (?,?,?,?,CURDATE(),?,?)");
    $insert->bind_param("isdsis", $product['pid'], $product['pnm'], $product['price'], $product['img'], $qty, $username);
    $insert->execute();
}

// Redirect to cart page
header("Location: cart_show.php");
exit;
?>
