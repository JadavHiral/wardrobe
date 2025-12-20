<?php
include_once("db_connect.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cart_ids = $_POST['cart_ids'] ?? [];
    if (empty($cart_ids)) {
        header("Location: cart_show.php");
        exit;
    }

    $name    = trim($_POST['name']);
    $address = trim($_POST['address']);
    $city    = trim($_POST['city']);
    $state   = trim($_POST['state']);
    $country = trim($_POST['country']);
    $phno    = trim($_POST['phno']);
    $email   = trim($_POST['email']);

    // Sanitize cart IDs
    $ids = array_map('intval', $cart_ids);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $types = str_repeat('i', count($ids));

    // Fetch selected cart items
    $sql = "SELECT * FROM add_to_cart WHERE username=? AND cart_id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $bind_names[] = "s" . $types;
    $bind_values[] = $username;
    foreach ($ids as $id) $bind_values[] = $id;

    $refs = [];
    foreach ($bind_values as $key => $value) $refs[$key] = &$bind_values[$key];
    call_user_func_array([$stmt, 'bind_param'], array_merge([$bind_names[0]], $refs));
    $stmt->execute();
    $result = $stmt->get_result();
    $cartItems = $result->fetch_all(MYSQLI_ASSOC);

    if (empty($cartItems)) {
        header("Location: cart_show.php");
        exit;
    }

    // Calculate total for selected items
    $totalAmount = 0;
    foreach ($cartItems as $c) $totalAmount += $c['price'] * $c['qty'];

    // Insert shipping
    $stmtShip = $conn->prepare("INSERT INTO shipping (name,address,city,state,country,phno,email) VALUES (?,?,?,?,?,?,?)");
    $stmtShip->bind_param("sssssis", $name,$address,$city,$state,$country,$phno,$email);
    $stmtShip->execute();
    $shippingId = $stmtShip->insert_id;

    // Insert order
    $paymentMethod = "COD";
    $status = "Pending";
    $stmtOrder = $conn->prepare("INSERT INTO orders (username,order_date,total_amount,shipping_id,payment_method,order_status) VALUES (?,NOW(),?,?,?,?)");
    $stmtOrder->bind_param("sdiss", $username,$totalAmount,$shippingId,$paymentMethod,$status);
    $stmtOrder->execute();
    $orderId = $stmtOrder->insert_id;

    // Remove only selected items from cart
    $sqlDelete = "DELETE FROM add_to_cart WHERE username=? AND cart_id IN ($placeholders)";
    $stmtDelete = $conn->prepare($sqlDelete);
    $bind_names_del[] = "s" . $types;
    $bind_values_del[] = $username;
    foreach ($ids as $id) $bind_values_del[] = $id;
    $refs_del = [];
    foreach ($bind_values_del as $key => $value) $refs_del[$key] = &$bind_values_del[$key];
    call_user_func_array([$stmtDelete, 'bind_param'], array_merge([$bind_names_del[0]], $refs_del));
    $stmtDelete->execute();

    header("Location: order_success.php?order_id=".$orderId);
    exit;
} else {
    header("Location: cart_show.php");
    exit;
}
?>
