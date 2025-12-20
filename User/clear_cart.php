<?php
include_once("db_connect.php");
session_start();

// Username or guest
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';

// Delete all items for this user
$stmt = $conn->prepare("DELETE FROM add_to_cart WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();

// Redirect back to cart
header("Location: cart_show.php");
exit;
?>

