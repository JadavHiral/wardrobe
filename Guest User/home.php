<?php

include_once("db_connect.php");

// index.php
$title_page = "Home";
ob_start();
?>

<head>
    <style>
        /* HERO SECTION */
        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
            padding: 60px 8%;
            background: linear-gradient(90deg, #f7ded4ff 50%, #e7b0c3ff 100%);
        }

        .hero-left {
            flex: 1;
            animation: fadeInLeft 1s ease;
        }

        .hero-left .eyebrow {
            color: #ff6f91;
            letter-spacing: 2px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .hero-left h1 {
            font-size: 44px;
            color: #111827;
            margin: 10px 0;
        }

        .hero-left p {
            font-size: 16px;
            color: #444;
            margin-bottom: 20px;
        }

        .hero-left a {
            background-color: #ff6f91;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .hero-left a:hover {
            background-color: #ff4d73;
        }

        .hero-right {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .hero-right img {
            width: 100%;
            max-width: 450px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /*sale banner*/
        .sale-banner {
            background: linear-gradient(120deg, #ffe2e0, #ffd6e0);
            text-align: center;
            padding: 60px 20px;
            border-radius: 12px;
            margin: 50px auto;
            max-width: 1000px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            color: #1f2937;
        }

        .sale-banner h1 {
            font-size: 36px;
            color: #111827;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .sale-banner p {
            font-size: 18px;
            color: #444;
            margin-bottom: 25px;
        }



        @media (max-width: 992px) {
  .sale-banner {
    padding: 50px 15px;
    margin: 40px 15px;
  }
  .sale-banner h1 {
    font-size: 30px;
  }
  .sale-banner p {
    font-size: 16px;
  }
}

    </style>
</head>
<!-- HERO -->
<section class="hero">
    <div class="hero-left">
        <div class="eyebrow">NEW COLLECTION</div>
        <h1>Make your everyday special with StyleHub</h1>
        <p>Minimal, modern and crafted for comfort. Shop new arrivals for Women & Men.</p>


        <div style="margin-top:18px; display:flex; gap:12px; align-items:center;">
            <div class="small"><i class="fa-solid fa-truck-fast" style="color:#ff6f91"></i> Fast delivery</div>
            <!-- <div class="small"><i class="fa-solid fa-shield-halved" style="color:#ff6f91"></i> 30-day returns</div>-->
        </div>
    </div>

    <div class="hero-right">
        <div class="hero-banner">
            <img src="images/b3.jpg">
        </div>
    </div>
</section>

<!-- SALE BANNER -->
<section class="sale-banner">
    <h1>Big Festive Sale!</h1>
    <p>Up to 20% Off on Selected Styles. Don’t Miss Out!</p>
    <a href="sale.php" class="btn-primary">Shop Now</a>
</section>

<!-- CATEGORIES -->
<section class="section">
    <h2 align="center">Shop Both Traditional & Western</h2>
    <div class="cats">
        <a class="cat-card" href="subcategory.php?cat=women">
            <img src="images/women/w2.jpg" alt="Women">
            <h3>Women</h3>
        </a>

        <a class="cat-card" href="subcategory.php?cat=men">
            <img src="images/men/m_t1.webp" alt="Men">
            <h3>Men</h3>
        </a>

    </div>
</section>

<!-- FEATURED PRODUCTS -->
<!--<section class="section">
    <h2>Featured Picks</h2>

    <div class="grid">
       product 1
        <div class="product">
            <div class="img"><img src="https://images.unsplash.com/photo-1520975911155-6d5332a2c9f6?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&s=11111" alt=""></div>
            <h4>Classic Linen Shirt</h4>
            <div class="price">₹1,299</div>
            <div class="prod-actions">
                <a class="btn-alt" href="product.php?id=1">View</a>
                <a class="btn-primary" href="product.php?id=1">Buy</a>
            </div>
        </div>

    product 2 
        <div class="product">
            <div class="img"><img src="https://images.unsplash.com/photo-1530845641711-7e6f27a0b34b?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&s=22222" alt=""></div>
            <h4>Everyday Tee</h4>
            <div class="price">₹699</div>
            <div class="prod-actions">
                <a class="btn-alt" href="product.php?id=2">View</a>
                <a class="btn-primary" href="product.php?id=2">Buy</a>
            </div>
        </div> 

        product 3 
        <div class="product">
            <div class="img"><img src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&s=33333" alt=""></div>
            <h4>Chic Midi Dress</h4>
            <div class="price">₹1,899</div>
            <div class="prod-actions">
                <a class="btn-alt" href="product.php?id=3">View</a>
                <a class="btn-primary" href="product.php?id=3">Buy</a>
            </div>
        </div>

        product 4
        <div class="product">
            <div class="img"><img src="https://images.unsplash.com/photo-1520975531631-c5f7b0e057d4?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&s=44444" alt=""></div>
            <h4>Tailored Blazer</h4>
            <div class="price">₹3,499</div>
            <div class="prod-actions">
                <a class="btn-alt" href="product.php?id=4">View</a>
                <a class="btn-primary" href="product.php?id=4">Buy</a>
            </div>
        </div>

    </div>
</section>- -->


<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>