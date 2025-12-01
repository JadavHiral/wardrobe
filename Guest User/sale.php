<?php

include_once("db_connect.php");

// sale.php
$title_page = "Sale";
ob_start();
?>
<head>
    <style>
        body {
          font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(90deg, #f7ded4ff 50%, #e7b0c3ff 100%);
            color: #222;
            line-height: 1.45;
            margin: 0;
            padding: 0;
        }
 
        header {
            background: linear-gradient(40deg, #111827, #1f2937);
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-size: 32px;
            color: #ffd6e0;
            margin: 0;
        }

        .section {
            padding: 50px 5%;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .product {
            height: 450px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .product .img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product h4 {
            font-size: 18px;
            margin: 15px 0 5px;
            color: #333;
        }

        .price {
            font-size: 16px;
            color: #e63946;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .prod-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding-bottom: 20px;
        }

        .btn-primary,
        .btn-alt {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #111827;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #374151;
        }

        .btn-alt {
            background-color: #ffd6e0;
            color: #111827;
        }

        .btn-alt:hover {
            background-color: #ffbfcf;
        }
    </style>
</head>

<header>
    <h1>🎉 Special Festive Sale 🎉</h1>
</header>

<section class="section">
    <div class="grid">

        <!-- Product 1 -->
        <div class="product">
            <div class="img">
                <img src="images/kurta_set.jpg" alt="Kurta Set">
            </div>
            <h4>Embroidered Kurta Set</h4>
            <div class="price">₹1,499 <del style="color:#888;">₹2,299</del></div>
            <div class="prod-actions">
                <a class="btn-alt" href="product.php?id=1">View</a>
                <a class="btn-primary" href="product.php?id=1">Buy</a>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="product">
            <div class="img">
                <img src="images/denim jacket.jpg" alt="Denim Jacket">
            </div>
            <h4>Classic Denim Jacket</h4>
            <div class="price">₹1,999 <del style="color:#888;">₹2,899</del></div>
            <div class="prod-actions">
                <a class="btn-alt" href="product.php?id=2">View</a>
                <a class="btn-primary" href="product.php?id=2">Buy</a>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="product">
            <div class="img">
                <img src="images/wide_leg_jeans.jpg" alt="jeans">
            </div>
            <h4>Wide Leg Jeans </h4>
            <div class="price">₹1,299 <del style="color:#888;">₹1,899</del></div>
            <div class="prod-actions">
                <a class="btn-alt" href="product.php?id=3">View</a>
                <a class="btn-primary" href="product.php?id=3">Buy</a>
            </div>
        </div>

        <!-- Product 4 -->
        <div class="product">
            <div class="img">
                <img src="images/Blazer.jpg" alt="Blazer">
            </div>
            <h4>Tailored Blazer</h4>
            <div class="price">₹2,999 <del style="color:#888;">₹3,999</del></div>
            <div class="prod-actions">
                <a class="btn-alt" href="product.php?id=4">View</a>
                <a class="btn-primary" href="product.php?id=4">Buy</a>
            </div>
        </div>

    </div>
</section>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
