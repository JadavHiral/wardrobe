<?php
include_once("db_connect.php");

$title_page = "Product Detail";
ob_start();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$prodQuery = $conn->prepare("
    SELECT p.*, s.sub_cat_nm 
    FROM product p 
    LEFT JOIN sub_category s ON p.sub_cat_id = s.sub_cat_id
    WHERE p.pid = ? LIMIT 1
");
$prodQuery->bind_param("i", $id);
$prodQuery->execute();
$prodResult = $prodQuery->get_result();
$product = $prodResult->fetch_assoc();
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

.product-container {
  max-width: 1000px;
  margin: 40px auto;
  display: flex;
  gap: 40px;
  flex-wrap: wrap;
  background: #fff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* IMAGE */
.product-image {
  flex: 1;
  min-width: 320px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f5f5f5;
  border-radius: 12px;
  padding: 15px;
}
.product-image img {
  width: 100%;
  height: auto;
  object-fit: contain;
  border-radius: 12px;
}

/* INFO */
.product-info {
  flex: 1;
  min-width: 300px;
}
.product-info h2 {
  font-size: 28px;
  margin-bottom: 10px;
  color: #218838;
}
.price {
  font-size: 22px;
  font-weight: bold;
  color: #e63946;
  margin: 10px 0;
}
.description {
  color: #444;
  margin-bottom: 15px;
  font-size: 16px;
  line-height: 1.5;
}
.info-meta {
  color: #666;
  font-size: 14px;
  margin-bottom: 15px;
}

label {
  font-weight: 600;
  margin-bottom: 5px;
  display: block;
}

input[type="number"] {
  width: 80px;
  padding: 8px;
  border-radius: 8px;
  border: 1px solid #ccc;
  margin-bottom: 15px; /* Reduced space between quantity and buttons */
}

/* BUTTON ROWS */
.btn-row {
  display: flex;
  gap: 15px;
  margin-bottom: 15px;
}

.btn-row form,
.btn-row a {
  flex: 1;
  display: flex;
}

/* BUTTON STYLE */
.btn {
  flex: 1;
  padding: 12px 0;
  border-radius: 8px;
  text-decoration: none;
  border: none;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: 600;
  transition: 0.3s;
}

.btn-back { background: linear-gradient(90deg,#ed86d0,#ff9eb0); color: #fff; }
.btn-cart { background: linear-gradient(90deg,#ff9eb0,#ffb6c1); color: #111; }
.btn-buy  { background:#111827; color:#fff; }
.btn-wishlist { background: linear-gradient(90deg,#f1afd5,#f191d6); color:#111; }

.btn:hover { opacity: 0.9; }

@media(max-width:768px){
    .product-container {
        flex-direction: column;
        gap: 20px;
    }
    .product-info, .product-image {
        min-width: 100%;
    }
}
</style>
</head>

<body>

<header>Product Detail</header>

<?php if ($product): ?>

<?php
$imgPath = "images/women/" . $product["img"];
if (!file_exists(__DIR__ . "/" . $imgPath) || empty($product["img"])) {
    $imgPath = "images/default.png";
}
?>

<div class="product-container">

  <div class="product-image">
    <img src="<?= $imgPath ?>" alt="<?= htmlspecialchars($product['pnm']) ?>">
  </div>

  <div class="product-info">
    <h2><?= htmlspecialchars($product['pnm']) ?></h2>

    <div class="price">₹<?= number_format($product['price'], 2) ?></div>

    <!-- PRODUCT DESCRIPTION -->
    <?php if (!empty($product['product_description'])): ?>
      <div class="description"><?= nl2br(htmlspecialchars($product['product_description'])) ?></div>
    <?php endif; ?>

    <!-- SUBCATEGORY INFO -->
    <?php if(!empty($product['sub_cat_nm'])): ?>
      <div class="info-meta"><strong>Category:</strong> <?= htmlspecialchars($product['sub_cat_nm']) ?></div>
    <?php endif; ?>

    <!-- QUANTITY -->
    <label>Quantity:</label>
    <input type="number" value="1" min="1" max="100" />

    <!-- BUTTON ROW 1 -->
    <div class="btn-row">
        <form action="add_to_cart.php" method="GET">
          <input type="hidden" name="action" value="add">
          <input type="hidden" name="id" value="<?= $product['pid'] ?>">
          <button class="btn btn-cart">🛒 Add to Cart</button>
        </form>

        <a class="btn btn-back" href="category.php?sub=<?= urlencode($product['sub_cat_nm']) ?>">
          Back to Products
        </a>
    </div>

    <!-- BUTTON ROW 2 -->
    <div class="btn-row">
        <a class="btn btn-buy" href="add_to_cart.php?action=buy&id=<?= $product['pid'] ?>">Buy Now</a>

        <form action="add_to_whishlist.php" method="POST">
          <input type="hidden" name="id" value="<?= $product['pid'] ?>">
          <button class="btn btn-wishlist">❤️ Wishlist</button>
        </form>
    </div>

  </div>
</div>

<?php else: ?>
<p style="text-align:center;margin-top:40px;">Product not found</p>
<?php endif; ?>

</body>
</html>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
