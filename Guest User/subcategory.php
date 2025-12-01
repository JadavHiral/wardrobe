<?php

include_once("db_connect.php");

// subcategory.php
$title_page = "Subcategory";
ob_start();

// Get category from URL (e.g. ?cat=women or ?cat=men)
$cat = isset($_GET['cat']) ? strtolower($_GET['cat']) : 'unknown';

// Page Title
$pageTitle = ($cat === 'men') ? "Men's Collection" : (($cat === 'women') ? "Women's Collection" : "Our Collection");
?>

<head>
  <style>
     body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(90deg, #f7ded4ff 50%, #e7b0c3ff 100%);
            color: #222;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.45;
        }

    header {
      background: linear-gradient(40deg, #111827, #1f2937);
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    header h1 {
      font-size: 28px;
      color: #ffd6e0;
    }

  

    @media (max-width: 768px) {
      .cat-card {
        width: 90%;
      }
    }

    .cats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      justify-items: center;
      padding: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .cat-card {
      text-align: center;
      text-decoration: none;
      color: inherit;
      border-radius: 12px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s, box-shadow 0.3s;
      width: 100%;
      max-width: 270px;
    }
  </style>
</head>

<header>
  <h1><?= $pageTitle ?> - Choose Your Style</h1>
</header>

<section class="section">
  <div class="cats">
    <?php if ($cat === 'women') : ?>
      <a class="cat-card" href="products.php?cat=women&sub=saree">
        <img src="images/women/saree.jpg" alt="Saree">
        <h3>Sarees</h3>
      </a>

      <a class="cat-card" href="products.php?cat=women&sub=kurta">
        <img src="images/women/kurta.jpg" alt="Kurta Set">
        <h3>Kurta Sets</h3>
      </a>

      <a class="cat-card" href="products.php?cat=women&sub=tops">
        <img src="images/women/tops.jpg" alt="Tops">
        <h3>Tops</h3>
      </a>

      <a class="cat-card" href="products.php?cat=women&sub=bottomwear">
        <img src="images/women/w_bottom.jpg" alt="Jeans">
        <h3>Bottom Wear</h3>
      </a>

      <a class="cat-card" href="products.php?cat=women&sub=formalfit">
        <img src="images/women/formalfit.jpg" alt="T-shirts">
        <h3>Formal fit</h3>
      </a>

      <a class="cat-card" href="products.php?cat=women&sub=lehengas">
        <img src="images/women/lehenga.jpg" alt="T-shirts">
        <h3>Lehenga</h3>
      </a>

    <?php elseif ($cat === 'men') : ?>

      <a class="cat-card" href="products.php?cat=men&sub=tshirt">
        <img src="images/men/shirt.jpg" alt="shirts">
        <h3>T-Shirts</h3>
      </a>

      <a class="cat-card" href="products.php?cat=men&sub=jeans">
        <img src="images/men/bottom.jpg" alt="Jeans">
        <h3>Bottom Wear</h3>
      </a>

      <a class="cat-card" href="products.php?cat=men&sub=ethnicwear">
        <img src="images/men/ethnic.jpg" alt="ethnic">
        <h3>Ethnic Wear</h3>
      </a>

      <a class="cat-card" href="products.php?cat=men&sub=jacket">
        <img src="images/men/denim2.jpg" alt="denim">
        <h3>Jackets</h3>
      </a>

      <a class="cat-card" href="products.php?cat=men&sub=formal-fit">
        <img src="images/men/formalfit.jpg" alt="formalfit">
        <h3>Formal fit</h3>
      </a>


    <?php else : ?>
      <p style="text-align:center;">No category selected.</p>
    <?php endif; ?>
  </div>
</section>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>