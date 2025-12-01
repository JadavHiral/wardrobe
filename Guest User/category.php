<?php

include_once("db_connect.php");

// category.php
$title_page = "category";
ob_start();
?>

<head>
    <style>
         body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
               background: linear-gradient(90deg, #f7ded4 50%, #e7b0c3 100%);
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

        /*.cats {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin: 10%;
        }*/

        .cat-card img {
           
            object-fit: fill;
        }

        .section {
            max-width: 150%;
            margin: 32px auto;
            padding: 0 6vw;
        }
    </style>
</head>
<!-- CATEGORIES -->
<header>
    <h1>Our Classic Collection </h1>
</header>
<section class="section">

    <div class="cats">
        <a class="cat-card" href="subcategory.php?cat=women">

            <img src="images/women/women.png" alt="Women">
            <h3>Women</h3>
        </a>

        <a class="cat-card" href="subcategory.php?cat=men">

            <img src="images/men/men.png" alt="Men">
            <h3>Men</h3>
        </a>

        <!--<a class="cat-card" href="sale.php">
            <img src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&s=ccccc" alt="Sale">
            <h3>Sale</h3>
        </a>-->
    </div>
</section>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>