<?php
include("config.php");
include("layout.php");

if (!isset($_GET['id'])) {
    echo "<h3 style='color:red; padding:20px;'>Invalid Order ID</h3>";
    exit;
}

$order_id = intval($_GET['id']); // safer

$qry = "SELECT * FROM orders WHERE o_id = $order_id";
$res = mysqli_query($con, $qry);

if (mysqli_num_rows($res) == 0) {
    echo "<h3 style='color:red; padding:20px;'>Order Not Found</h3>";
    exit;
}

$order = mysqli_fetch_assoc($res);
$statusClass = strtolower($order['order_status']);
?>

<style>
    .page-title {
        color: #1e40af;
        margin-bottom: 20px;
    }

    .order-card {
        background: #fff;
        border-radius: 8px;
        padding: 25px;
        max-width: 800px;
    }

    .order-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .order-row:last-child {
        border-bottom: none;
    }

    .label {
        font-weight: bold;
        color: #374151;
    }

    .value {
        color: #111827;
    }

    .status {
        padding: 6px 12px;
        border-radius: 15px;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
    }

    .pending {
        background: #f39c12;
    }

    .completed {
        background: #2ecc71;
    }

    .cancelled {
        background: #e74c3c;
    }

    .btn-back {
        display: inline-block;
        margin-top: 20px;
        background: #3498db;
        padding: 8px 16px;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
    }

    .btn-back:hover {
        opacity: 0.9;
    }
</style>

<div>
    <h2 class="page-title">Order Details</h2>

    <div class="order-card">

        <div class="order-row">
            <span class="label">Order ID</span>
            <span class="value"><?php echo $order['o_id']; ?></span>
        </div>

        <div class="order-row">
            <span class="label">Username</span>
            <span class="value"><?php echo htmlspecialchars($order['username']); ?></span>
        </div>

        <div class="order-row">
            <span class="label">Order Date</span>
            <span class="value">
                <?php echo date("d M Y, h:i A", strtotime($order['order_date'])); ?>
            </span>
        </div>

        <div class="order-row">
            <span class="label">Total Amount</span>
            <span class="value">₹ <?php echo number_format($order['total_amount'], 1); ?></span>
        </div>

        <!-- ✅ NEW: Shipping ID -->
        <div class="order-row">
            <span class="label">Shipping ID</span>
            <span class="value"><?php echo $order['shipping_id']; ?></span>
        </div>

        <!-- ✅ NEW: Payment Method -->
        <div class="order-row">
            <span class="label">Payment Method</span>
            <span class="value"><?php echo $order['payment_method']; ?></span>
        </div>

        <div class="order-row">
            <span class="label">Order Status</span>
            <span class="status <?php echo $statusClass; ?>">
                <?php echo $order['order_status']; ?>
            </span>
        </div>

        <a href="order.php" class="btn-back">← Back to Orders</a>
    </div>
</div>