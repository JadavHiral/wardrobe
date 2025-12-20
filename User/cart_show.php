<?php
include_once("db_connect.php");
session_start();

$username = $_SESSION['username'] ?? 'guest';

// Fetch cart items
$stmt = $conn->prepare("SELECT * FROM add_to_cart WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$cartItems = $result->fetch_all(MYSQLI_ASSOC);

$title_page = "Your Cart";
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title_page ?></title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fffaf8;
            margin: 0;
            color: #222;
        }

        header {
            background: linear-gradient(40deg, #111827, #1f2937);
            color: #ffd6e0;
            text-align: center;
            padding: 20px;
            font-size: 28px;
        }

        .cart-container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 15px 0;
            border-bottom: 1px solid #ddd;
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            object-fit: contain;
            border: 1px solid #eee;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-info h3 {
            margin: 0 0 6px 0;
            color: #218838;
        }

        .price {
            color: #e63946;
            font-size: 15px;
            font-weight: bold;
        }

        .extra-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 10px;
        }

        .extra-buttons a,
        .extra-buttons button {
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .extra-buttons a {
            background: #ff9f43;
            color: #fff;
            text-decoration: none;
        }

        button.buy {
            background: #28a745;
            color: #fff;
        }

        button.remove {
            background: #ff4d4d;
            color: #fff;
        }

        input[type=checkbox] {
            transform: scale(1.3);
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <header>Your Cart</header>
    <div class="cart-container">

        <?php if (!empty($cartItems)): ?>
            <form action="cart_action.php" method="POST">
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <input type="checkbox" name="cart_ids[]" value="<?= $item['cart_id'] ?>" checked>
                        <img src="images/women/<?= htmlspecialchars($item['img']) ?>">
                        <div class="cart-item-info">
                            <h3><?= htmlspecialchars($item['pnm']) ?></h3>
                            <div class="price">
                                ₹<?= $item['price'] ?> x <?= $item['qty'] ?> =
                                ₹<?= number_format($item['price'] * $item['qty'], 2) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="extra-buttons">
                    <a href="category.php">Back to Products</a>
                    <button type="submit" name="action" value="buy" class="buy">Buy Selected</button>
                    <button type="submit" name="action" value="remove" class="remove">Remove Selected</button>
                </div>
            </form>

        <?php else: ?>
            <p style="text-align:center; padding:40px;">Your cart is empty.</p>
            <center>
                <a href="category.php" style="background:#ff9f43; padding:10px 20px; border-radius:8px; color:#fff;">Shop
                    Now</a>
            </center>
        <?php endif; ?>

    </div>
</body>

</html>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
