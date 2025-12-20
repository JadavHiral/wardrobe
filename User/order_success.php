<?php
include_once("db_connect.php");
session_start();

/* User must be logged in */
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

/* Validate order id */
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    header("Location: index.php");
    exit;
}

$orderId  = intval($_GET['order_id']);
$username = $_SESSION['username'];

/* Fetch order from DB */
$stmt = $conn->prepare("
    SELECT o_id, order_date, total_amount, order_status 
    FROM orders 
    WHERE o_id = ? AND username = ?
    LIMIT 1
");
$stmt->bind_param("is", $orderId, $username);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

/* If order not found or not user's order */
if (!$order) {
    header("Location: index.php");
    exit;
}

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
h2 { margin-top: 10px; font-size: 30px; }
.order-info { margin: 20px 0; background: #f4f8f3; padding: 15px; border-radius: 8px; font-size: 16px; }
.buttons { margin-top: 30px; display: flex; justify-content: center; gap: 20px; }
.buttons a { padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: 600; }
.btn-shop { background: #ff9f43; color: #fff; }
.btn-orders { background: #111827; color: #fff; }
.btn-cancel { background: #e63946; color: #fff; }
</style>
</head>
<body>

<div class="success-container">
    <div class="success-icon">✔</div>

    <h2>Order Placed Successfully!</h2>

    <div class="order-info">
        <p><strong>Order ID:</strong> #<?= $order['o_id'] ?></p>
        <p><strong>Order Date:</strong> <?= date("d M Y", strtotime($order['order_date'])) ?></p>
        <p><strong>Total Amount:</strong> ₹<?= number_format($order['total_amount'], 2) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($order['order_status']) ?></p>
    </div>

    <p>Thank you for shopping with us! Your order is being processed.</p>
    <p><strong>Estimated Delivery:</strong> 3 – 5 Business Days</p>

    <div class="buttons">
        <a href="category.php" class="btn-shop">Continue Shopping</a>
        <a href="my_orders.php" class="btn-orders">View My Orders</a>
        <a href="cart_show.php" class="btn-cancel">Cancel</a>
    </div>
</div>

</body>
</html>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
