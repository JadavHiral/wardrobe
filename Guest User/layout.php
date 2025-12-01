<!--layout page-->
<?php

include_once("db_connect.php");

// layout.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>cloth store</title>



    <style>
        /* ---------- Reset & base ---------- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fffaf8;
            color: #222;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.45;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            max-width: 100%;
            display: block;
        }

        /* ---------- NAVBAR ---------- */
        .navbar {
            width: 100%;
            background: linear-gradient(90deg, #111827 0%, #111827 60%, #1f2937 100%);
            color: #fff;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 20px;
            color: #ffd6e0;
        }

        .brand .logo {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, #ff6f91, #ffb6c1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(255, 111, 145, 0.18);
        }

        nav .nav-links {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .nav-links a {
            color: #f3f4f6;
            padding: 8px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;

        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            transform: translateY(-1px);
        }

        .nav-right {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ed86d0ff, #ff9eb0);
            color: white;
            border: none;
            padding: 9px 16px;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(255, 111, 145, 0.15);
        }

        .btn-alt {
            padding: 8px 12px;
            border-radius: 8px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: #fff;
        }

        /* USER DROPDOWN WRAPPER */
        .user-drop {
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        /* PROFILE PHOTO */
        .user-drop img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ff96c2;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            background: #fff;
        }

        /* USERNAME TEXT */
        .user-drop span {
            font-weight: 600;
            color: #fff;
            font-size: 14px;
        }

        /* DROPDOWN BOX */
        .user-drop .menu {
            position: absolute;
            right: 0;
            top: 50px;
            background: #ffffff;
            min-width: 190px;
            border-radius: 12px;
            padding: 8px 0;
            box-shadow: 0 6px 22px rgba(0, 0, 0, 0.15);
            display: none;
            z-index: 9999;
            animation: dropdownFade 0.2s ease-out;
        }

        /* SHOW MENU */
        .user-drop .menu.show {
            display: block;
        }

        /* MENU LINKS */
        .user-drop .menu a {
            padding: 12px 18px;
            display: block;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }

        /* HOVER EFFECT */
        .user-drop .menu a:hover {
            background: #ffe7f0;
            color: #d72d70;
        }

        /* ANIMATION */
        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ---------- CATEGORIES ---------- */
        .section {
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 6vw;
        }

        .section h2 {
            font-size: 22px;
            color: #111827;
            margin-bottom: 14px;
        }

        .cats {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin: 10% auto;
            max-width: 1200px;
        }

        .cat-card {
            flex: 1 1 280px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            text-align: center;
            padding: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
            text-decoration: none;
            color: inherit;
        }

        .cat-card img {
            width: 100%;
            height: 340px;
            /* ✅ keeps consistent height */
            object-fit: cover;
            /* ✅ crops images evenly */
            border-bottom: 3px solid #f7f7f7;
        }

        .cat-card h3 {
            padding: 15px;
            font-size: 20px;
            background: #fff;
            color: #333;
        }

        .cat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        /* ---------- PRODUCTS GRID ---------- */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 16px;
        }

        .product {
            background: #fff;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
            transition: transform .28s, box-shadow .28s;
        }

        .product:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.10);
        }

        .product .img {
            height: 260px;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .product .img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product h4 {
            font-size: 16px;
            color: #111827;
            margin: 8px 0;
        }

        .price {
            color: #000000ff;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .prod-actions {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 8px;
        }

        .small {
            font-size: 13px;
            color: #6b7280;
        }

        /* ---------- FOOTER ---------- */
        footer {
            margin-top: 40px;
            padding: 26px 6vw;
            background: linear-gradient(90deg, #111827, #1f2937);
            color: #fff;
        }

        footer .f-grid {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: auto;
            justify-content: space-between;
        }

        footer a {
            color: #ffd6e0;
            text-decoration: none;
            font-weight: 600;
        }

        /* ---------- Responsive ---------- */
        @media (max-width:880px) {
            .hero {
                flex-direction: column-reverse;
                padding: 24px;
            }

            .hero-banner {
                width: 100%;
                max-width: 520px;
            }

            .hero-left h1 {
                font-size: 28px;
            }

            .hero-right {
                padding-bottom: 10px;
            }
        }

        /* ---------- TOGGLE MENU (MOBILE) ---------- */
        .toggle {
            display: none;
            font-size: 22px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                background: #111827;
                width: 100%;
                /* remove position absolute so content moves down */
                text-align: center;
                padding: 10px 0;
                transition: all 0.3s ease;
                /* optional smooth open */
            }

            .nav-links.active {
                display: flex;
            }

            .toggle {
                display: block;
            }
        }
    </style>
    <script>
        function toggleMenu() {
            document.getElementById("navMenu").classList.toggle("active");
        }

        document.addEventListener("DOMContentLoaded", function() {
            const userDrop = document.querySelector(".user-drop");
            const menu = document.querySelector(".user-drop .menu");

            if (userDrop) {
                userDrop.addEventListener("click", function(e) {
                    e.stopPropagation();
                    menu.classList.toggle("show");
                });
            }

            // Close menu when clicking outside
            document.addEventListener("click", function() {
                if (menu) menu.classList.remove("show");
            });
        });
    </script>

</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="brand">
            <div class="logo">SH</div>StyleHub
        </div>

        <div class="toggle" onclick="toggleMenu()">☰</div>

        <nav class="nav-links" id="navMenu">
            <a href="home.php">Home</a>
            <a href="category.php">Collection</a>
            <a href="contactus.php">Contact</a>
            <a href="aboutus.php">About us</a>
        </nav>

        <!--icons-->
        <!--  <div class="icons">
        <a href="#"> <i class="ri-search-line"></i></a>
        <a href="#"> <i class="ri-user-line"></i></a>
        <a href="#"> <i class="ri-shopping-cart-line"></i></a>
        <div class = "bx bx-menu" id = "menu-icon"></div>
        </div>-->

        <!--icons end-->

        <div class="nav-right">
            <?php if (isset($_SESSION['user_email'])): ?>
                <a class="small" href="wishlist.php"><i class="fa-regular fa-heart"></i></a>
                <a class="small" href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>

                <div class="user-drop">
                    <div style="display:flex;align-items:center;gap:8px;cursor:pointer;color:#fff;">
                        <img src="uploads/<?php echo $_SESSION['user_image']; ?>"  style="
                            width:70px;
                            height:70px;
                            border-radius:40px;
                            object-fit:contain;
                            border:2px solid #fff;
                            background:#f2f2f2;
                            
                        ">
                        <?php echo $_SESSION['user_name']; ?>

                    </div>
                    <div class="menu">
                        <a href="myaccount.php"><i class="fa-solid fa-box me-2"></i>Profile</a>
                        <a href="orders.php"><i class="fa-solid fa-box me-2"></i>Orders</a>
                        <a href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
                    </div>
                </div>

            <?php else: ?>
                <a class="small" href="register.php" style="color:#ffd6e0;">Register</a>
                <a class="btn-primary" href="login.php">Sign In</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- DYNAMIC PAGE CONTENT (inserted by pages) -->
    <?php
    // pages include their HTML into $content1
    if (isset($content1)) echo $content1;
    else {
        // fallback: show a tiny landing
        echo '<div style="max-width:1200px;margin:30px auto;padding:0 6vw;"><p class="small">Welcome to StyleHub</p></div>';
    }
    ?>

    <!-- FOOTER -->
    <footer>
        <div class="f-grid">
            <div>
                <h3 style="color:#ffd6e0">StyleHub</h3>
                <p class="small" style="max-width:420px">Your go-to store for modern, stylish clothing for men & women. Fast delivery, easy returns.</p>
            </div>

            <div style="min-width:180px;">
                <h4 style="color:#fff">Categories</h4>
                <a href="subcategory.php?cat=women">Women</a><br>
                <a href="subcategory.php?cat=men">Men</a><br>
                <a href="sale.php">Sale</a>
            </div>

            <div style="min-width:200px;">
                <h4 style="color:#fff">Info</h4>
                <a href="contactus.php">Contact us </a><br>
                <a href="aboutus.php">About</a><br>
                <!--<a href="#">Pinterest</a>-->
            </div>
        </div>

        <p style="text-align:center;margin-top:18px;color:#bfc7d6">© <?php echo date('Y'); ?> StyleHub • Crafted with ❤️</p>
    </footer>

</body>

</html>