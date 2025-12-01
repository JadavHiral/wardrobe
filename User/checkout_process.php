<?php
include_once("db_connect.php");
session_start();

// User must be logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Check POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect form data
    $name    = trim($_POST['name']);
    $address = trim($_POST['address']);
    $city    = trim($_POST['city']);
    $state   = trim($_POST['state']);
    $country = trim($_POST['country']);
    $phno    = trim($_POST['phno']);
    $email   = trim($_POST['email']);

    // Fetch cart items
    $stmt = $conn->prepare("SELECT * FROM add_to_cart WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultCart = $stmt->get_result();
    $cartItems = $resultCart->fetch_all(MYSQLI_ASSOC);

    // If cart is empty, redirect
    if (empty($cartItems)) {
        header("Location: cart_show.php");
        exit;
    }

    // Calculate total amount
    $totalAmount = 0;
    foreach ($cartItems as $c) {
        $totalAmount += $c['price'] * $c['qty'];
    }

    // Insert shipping details
    $stmtShip = $conn->prepare("INSERT INTO shipping (name, address, city, state, country, phno, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmtShip->bind_param("sssssis", $name, $address, $city, $state, $country, $phno, $email);
    $stmtShip->execute();
    $shippingId = $stmtShip->insert_id;

    // Insert into orders table
    $paymentMethod = "COD";
    $status = "Pending";

    $stmtOrder = $conn->prepare("INSERT INTO orders (username, order_date, total_amount, shipping_id, payment_method, status) VALUES (?, NOW(), ?, ?, ?, ?)");
    $stmtOrder->bind_param("sdiss", $username, $totalAmount, $shippingId, $paymentMethod, $status);
    $stmtOrder->execute();
    $orderId = $stmtOrder->insert_id;

    // Clear cart
    $stmtClear = $conn->prepare("DELETE FROM add_to_cart WHERE username=?");
    $stmtClear->bind_param("s", $username);
    $stmtClear->execute();

    // Redirect to success page
    header("Location: order_success.php?order_id=" . $orderId);
    exit;

} else {
    header("Location: checkout.php");
    exit;
}
?>
