<?php
session_start();

// If no order id, go back to home
if (!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit;
}

$orderId = intval($_GET['order_id']);
$title_page = "Order Successful";
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title_page ?></title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #fffaf8;
    margin: 0;
}

.success-container {
    max-width: 700px;
    margin: 60px auto;
    background: #fff;
    padding: 40px 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.success-icon {
    font-size: 70px;
    color: #28a745;
}

h2 {
    margin-top: 10px;
    color: #1a1a1a;
    font-size: 30px;
    font-weight: 700;
}

.order-id-box {
    margin: 20px 0;
    padding: 12px 20px;
    background: #f4f8f3;
    border-left: 5px solid #28a745;
    font-size: 18px;
    display: inline-block;
    border-radius: 8px;
}

p {
    font-size: 16px;
    color: #444;
    margin: 10px 0 20px 0;
}

.buttons {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    gap: 20px;
}

.buttons a {
    padding: 12px 25px;
    font-size: 16px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-shop {
    background: #ff9f43;
    color: white;
}

.btn-shop:hover {
    opacity: 0.9;
}

.btn-orders {
    background: #111827;
    color: white;
}

.btn-orders:hover {
    opacity: 0.9;
}
</style>
</head>
<body>

<div class="success-container">

    <div class="success-icon">✔</div>

    <h2>Order Placed Successfully!</h2>

    <div class="order-id-box">
        Order ID: <strong>#<?= $orderId ?></strong>
    </div>

    <p>Thank you for your purchase! Your order has been placed and is now being processed.</p>
    <p>Estimated Delivery: <strong>3 - 5 Business Days</strong></p>

    <div class="buttons">
        <a href="category.php" class="btn-shop">Continue Shopping</a>
        <a href="my_orders.php" class="btn-orders">View Orders</a>
    </div>

</div>

</body>
</html>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
