<?php

include_once("db_connect.php");

// product_detail.php
$title_page = "Product Detail";
ob_start();

$cat = isset($_GET['cat']) ? strtolower($_GET['cat']) : 'unknown';
$sub = isset($_GET['sub']) ? strtolower($_GET['sub']) : 'unknown';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Example product data (normally from DB)
$products = [
  //women
  1 => ['name' => 'Floral Saree', 'price' => '₹1,299', 'old' => '₹1,899', 'desc' => 'Beautiful floral saree with lightweight fabric.', 'img' => 'images/women/floral_saree1.jpg'],

  2 => ['name' => 'Embroidered Silk Saree', 'price' => '₹1,999 ', 'old' => '₹2,499', 'desc' => 'Embroidered Purpal beautiful Silk Saree, perfect for any occasion.', 'img' => 'images/women/silk_saree.jpg'],

  3 => ['name' => 'Cotton Kurta Set', 'price' => '₹899', 'old' => '₹1,299', 'desc' => 'Pure Cotton Kurta Pant Dupatta Set. ', 'img' => 'images/women/cotton_kurta.jpg'],

  4 => ['name' => 'Anarkali Kurta Set', 'price' => '₹1,099', 'old' => '₹1,499', 'desc' => 'Elegant cotton Anarkali with soft lining.', 'img' => 'images/women/anarkali_kurta.jpg'],

  5 => ['name' => 'Stylish Top', 'price' => '₹699', 'old' => '₹999', 'desc' => 'Stylis Embroidered ragular fit Collared Top. ', 'img' => 'images/women/stylist_top.jpg'],

  6 => ['name' => 'Casual Crop Top', 'price' => '₹599', 'old' => '₹899', 'desc' => 'Red V- Nack Frilled Ruffled Top. ', 'img' => 'images/women/crop_top2.jpg'],

  7 => ['name' => 'Blue Denim Jeans', 'price' => '₹1,299', 'old' => '₹1,799', 'desc' => 'Sky Blue High Waist Wide Leg Jeans. ', 'img' => 'images/women/jeans1.jpg'],

  8 => ['name' => 'Black Trouser', 'price' => '₹999', 'old' => '₹1,399', 'desc' => 'Slim Fit Black Lycra Blend Trouser.', 'img' => 'images/women/trouser.jpg'],

  9 => ['name' => 'Formal Fit', 'price' => '₹899', 'old' => '₹1,299', 'desc' => 'Formal Shirt with blazer and formal jeans for women. ', 'img' => 'images/women/formal1.jpg'],

  10 => ['name' => 'Plain T-shirt', 'price' => '₹699', 'old' => '₹999', 'desc' => 'Plain Black t-shirt for women.', 'img' => 'images/women/formal2.jpg'],

  11 => ['name' => 'Bridal Lehenga', 'price' => '₹3,499', 'old' => '₹4,199', 'desc' => 'Beautiful Bridal Lehenga,pefect for your wedding. ', 'img' => 'images/women/bridal_lehenga1.jpg'],

  12 => ['name' => 'Floral Lehenga', 'price' => '₹2,999', 'old' => '₹3,599', 'desc' => 'Floral Black Beautiful Lehenga With Crop top.', 'img' => 'images/women/floral_lehenga2.jpg'],

  //men
  13 => ['name' => 'Casual T-Shirt', 'price' => '₹799', 'old' => '₹1,199',  'desc' => 'Comfortable casual t-shirt for everyday wear.', 'img' => 'images/men/casual_tshirt.jpg'],

  14 => ['name' => 'Printed T-Shirt', 'price' => '₹999', 'old' => '₹1,499',  'desc' => 'Printed t-shirt for everyday wear.', 'img' => 'images/men/printed_tshirt.jpg'],

  15 => ['name' => 'Cargo', 'price' => '₹1,299', 'old' => '₹1,799',  'desc' => 'Comfortable and Relexed Cargo Jeans.', 'img' => 'images/men/cargo_jeans.jpg'],

  16 => ['name' => 'Regular Fit Jeans', 'price' => '₹1,099', 'old' => '₹1,599',  'desc' => 'Regular Fit jeans for everyday wear.',  'img' => 'images/men/jeans1.jpg'],

  17 => ['name' => 'Indo Western', 'price' => '₹1,899', 'old' => '₹2,499',  'desc' => 'elegant Indo Western Perfect choice for sangeet night, receptions, engagements and festive celebrations.',  'img' => 'images/men/indowestern.jpg'],

  18 => ['name' => 'JodhPuri', 'price' => '₹1,499', 'old' => '₹1,999',  'desc' => 'Stylist and Black jodhPuri perfect for any occasion.', 'img' => 'images/men/jodhapuri.jpg'],

  19 => ['name' => 'Denim Jacket', 'price' => '₹2,999', 'old' => '₹3,499',  'desc' => 'Blue Denim Jacket for everyday wear.', 'img' => 'images/men/denim_jacket.jpg'],

  20 => ['name' => 'Casual Jacket', 'price' => '₹2,499', 'old' => '₹3,099',  'desc' => 'Casual Black Jacket for men.', 'img' => 'images/men/casual_jacket.jpg'],

  21 => ['name' => 'Formal Blazer', 'price' => '₹2,999', 'old' => '₹3,499',  'desc' => 'Formal Blezer for your everyday Office wear.', 'img' => 'images/men/blazer.jpg'],

  22 => ['name' => 'formal', 'price' => '₹2,499', 'old' => '₹3,099',  'desc' => 'Causal Formal for Office wear.', 'img' => 'images/men/formal.jpg'],
];

// Get product details
$product = $products[$id] ?? null;
?>

<head>
  <style>
    body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fffaf8;
            color: #222;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.45;
        }

    header {
      background: linear-gradient(40deg, #111827, #1f2937);
      color: #fff;
      text-align: center;
      padding: 15px;
    }

    header h1 {
      color: #ffd6e0;
      font-size: 26px;
    }

    .product-detail {
      max-width: 1000px;
      margin: 50px auto;
      display: flex;
      background: #fbf9f9ff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .product-detail img {
      width: 50%;
      height: 730px;
      object-fit: cover;
    }

    .product-info {
      padding: 10%;
      flex: 1;
    }

    .product-info h2 {
      font-size: 30px;
      margin-bottom: 10px;
    }

    .price {
      font-size: 20px;
      color: #e63946;
      margin: 10px 0;
    }

    .old-price {
      color: #777;
      text-decoration: line-through;
      margin-left: 10px;
    }

    .description {
      margin: 20px 0;
      font-size: 18px;
      color: #1b1a1aff;
    }

    /*::cue.btn-group {
      margin-top: 20px;
      font-size: smaller;
    }

    .btn {
      padding: 10px 10px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
    }*/

    .btn-group {
      display: flex;
      gap: 12px;
      /* space between buttons */
      flex-wrap: wrap;
      /* allow wrapping on very small screens */
      align-items: center;
      margin-top: 20px;
    }

    /* common button reset */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 10px 14px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      font-size: 13px;
      line-height: 1;
      cursor: pointer;
      border: none;
      transition: transform .12s ease, box-shadow .12s ease;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    /* give each button its own color/appearance */
    .btn-buy {
      background: #111827;
      /* dark */
      color: #fff;
    }

    .btn-back {
      background: linear-gradient(90deg, #ed86d0ff, #ff9eb0);
      /* pink gradient */
      color: #fff;
    }

    .btn-cart {
      background: linear-gradient(90deg, #ff9eb0, #ffb6c1);
      /* softer pink */
      color: #111;
    }

    .btn-wishlist {
      background: linear-gradient(90deg, #f1afd5ff, #f191d6ff);
      /* white outline button */

      
    }

    /*.btn-buy {
      background: #111827;
      color: #fff;
    }


    .btn-back {

      background: linear-gradient(90deg, #ed86d0ff, #ff9eb0);
      color: white;
      border: none;
    }
.btn-cart {
      background: linear-gradient(90deg, #f1afd5ff, #f191d6ff);
      color: white;
      border: none;
    }

    .btn-wishlist {
      background: linear-gradient(90deg, #f1afd5ff, #f191d6ff);
      color: white;
      border: none;

    }*/
    @media (max-width: 768px) {
      .product-detail {
        flex-direction: row;
      }

      .product-detail img {
        width: 50%;
        height: 500px;

      }

      .btn-group {
        margin-top: 10px;
        font-size: smaller;
      }

      .btn {
        padding: 3px 3px;
        border-radius: 3px;
        text-decoration: none;
        font-weight: 200;
        margin-right: 10px;
        display: grid;
      }

      .description {
        margin: 10px 0;
        font-size: 15px;
        color: #1b1a1aff;
      }

      .product-info h2 {
        font-size: 15px;
        margin-bottom: 10px;
      }

      .price {
        font-size: 15px;
        color: #e63946;
        margin: 5px 0;
      }

      .old-price {
        color: #777;
        text-decoration: line-through;
        margin-left: 5px;
      }
    }

    /* small / mobile adjustments */
    @media (max-width: 480px) {
      .btn-group {
        gap: 8px;
      }

      .btn {
        padding: 8px 10px;
        font-size: 10px;
        border-radius: 6px;
      }

      /* make “Back” smaller so it doesn't dominate on tiny screens */
      .btn-back {
        padding-left: 10px;
        padding-right: 10px;
      }
    }
  </style>
</head>

<header>
  <h1>Product Detail</h1>
</header>

<?php if ($product): ?>
  <section class="product-detail">
    <img src="<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
    <div class="product-info">
      <h2><?= $product['name'] ?></h2>
      <div class="price">
        <?= $product['price'] ?>
        <span class="old-price"><?= $product['old'] ?></span>
      </div>
      <p class="description"><?= $product['desc'] ?></p>

<!-------------------->

    <form method="GET" action="#">
      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" value="1" min="1" max="100" required>
    
      
 
<!-------------------->


      <div class="btn-group">
        <a href="cart.php?action=add&cat={$cat}&sub={$sub}&id={$p['id']}" class="btn btn-buy">Buy Now</a>
        <a href="products.php?cat=<?= $cat ?>&sub=<?= $sub ?>" class="btn btn-back">Back to Products</a>

        <!-- 🟢 Added Buttons Start -->
        <a href="cart.php" class="btn btn-cart">Add to Cart</a>
       <a href="add_to_wishlist.php?id=<?= $id ?>" class="btn btn-wishlist">Add to Wishlist</a>

        <!-- 🟢 Added Buttons End -->

      </div>

  </section>
<?php else: ?>
  <p style="text-align:center; margin-top:50px;">Product not found.</p>
<?php endif; ?>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>