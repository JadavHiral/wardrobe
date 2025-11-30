<?php
include_once("db_connect.php");
session_start();

// Use session username or guest
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';

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
<html>
<head>
<title><?= $title_page ?></title>

<style>
body {
  font-family: 'Segoe UI', sans-serif;
  background: #fffaf8;
  margin: 0;
}

header {
  background: linear-gradient(40deg,#111827,#1f2937);
  color: #ffd6e0;
  text-align: center;
  padding: 20px;
  font-size: 26px;
}

.cart-container {
  max-width: 1000px;
  margin: 40px auto;
  background: #fff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
  object-fit: contain;
  border-radius: 12px;
}

.cart-item-info {
  flex: 1;
}

.cart-item-info h3 {
  margin: 0 0 10px 0;
  color: #218838;
}

.cart-item-info .price {
  color: #e63946;
  font-weight: bold;
}

.cart-actions {
  display: flex;
  gap: 10px;
}

.cart-actions form button,
.cart-actions a {
  padding: 8px 15px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  font-weight: 600;
  text-decoration: none;
  transition: 0.3s;
}

.cart-actions form button { background:#ff6b6b; color:#fff; }
.cart-actions a { background:#111827; color:#fff; }

.cart-actions form button:hover,
.cart-actions a:hover { opacity: 0.9; }

.total-price {
  text-align: right;
  font-size: 22px;
  font-weight: bold;
  margin-top: 20px;
}

.extra-buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.extra-buttons a,
.extra-buttons form button {
  padding: 10px 20px;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  transition: 0.3s;
}

.extra-buttons a { background: #ff9f43; color: #fff; }
.extra-buttons form button { background: #ff6b6b; color: #fff; }

.extra-buttons a:hover,
.extra-buttons form button:hover { opacity: 0.9; }
</style>
</head>
<body>

<header>Your Cart</header>

<div class="cart-container">
<?php if (!empty($cartItems)): ?>

  <?php
  $total = 0;
  foreach ($cartItems as $item):
      $subtotal = $item['price'] * $item['qty'];
      $total += $subtotal;
  ?>
  <div class="cart-item">
    <img src="images/women/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['pnm']) ?>">
    <div class="cart-item-info">
      <h3><?= htmlspecialchars($item['pnm']) ?></h3>
      <div class="price">₹<?= number_format($item['price'],2) ?> x <?= $item['qty'] ?> = ₹<?= number_format($subtotal,2) ?></div>
    </div>
    <div class="cart-actions">
      <form action="remove_from_cart.php" method="POST">
        <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
        <button type="submit">Remove</button>
      </form>
      <a href="checkout.php?cart_id=<?= $item['cart_id'] ?>">Buy Now</a>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="total-price">Total: ₹<?= number_format($total,2) ?></div>

  <div class="extra-buttons">
    <a href="products.php">Back to Products</a>
    <form action="clear_cart.php" method="POST">
      <button type="submit">Clear Cart</button>
    </form>
  </div>

<?php else: ?>
  <p style="text-align:center; padding: 40px;">Your cart is empty.</p>
  <div style="text-align:center; margin-top:20px;">
    <a href="products.php" style="background:#ff9f43; color:#fff; padding:10px 20px; border-radius:8px; text-decoration:none;">Back to Products</a>
  </div>
<?php endif; ?>
</div>

</body>
</html>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
