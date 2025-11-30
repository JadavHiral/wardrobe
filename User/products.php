<?php
include_once("db_connect.php");

// Start session to check login
session_start();

// products.php
$title_page = "Products";
ob_start();

// Check login
$isLoggedIn = isset($_SESSION['username']);

// Get category and subcategory from URL
$catName = isset($_GET['cat']) ? strtolower($_GET['cat']) : '';
$subName = isset($_GET['sub']) ? strtolower($_GET['sub']) : '';

// Fetch subcategory ID
$subQuery = $conn->prepare("SELECT * FROM sub_category WHERE LOWER(sub_cat_nm) = ? LIMIT 1");
$subQuery->bind_param("s", $subName);
$subQuery->execute();
$subResult = $subQuery->get_result();
$sub = $subResult->fetch_assoc();

$subCatId = $sub ? $sub['sub_cat_id'] : 0;
$pageTitle = $sub ? $sub['sub_cat_nm'] . " Products" : "Products";
?>

<head>
    <style>
        body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fffaf8;
            color: #222;
            line-height: 1.45;
        }

        header {
            background: linear-gradient(40deg, #111827, #1f2937);
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 28px;
            color: #ffd6e0;
            margin: 0;
        }

        /* Grid layout */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            justify-items: center;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Product card */
        .product {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
            max-width: 270px;
        }

        .product:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(15,23,42,0.10);
        }

        .product img {
            width: 100%;       
            height: auto;      
            display: block;
            border-radius: 12px 12px 0 0;
            background: #f5f5f5;
        }

        .product h4 {
            margin: 10px 0;
            font-size: 16px;
            color: #111827;
        }

        .price {
            color: #000;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .prod-actions {
            display: flex;
            justify-content: center;
            margin-bottom: 12px;
            gap: 8px;
        }

        .prod-actions a {
            text-decoration: none;
            color: #fff;
            background: #ed86d0;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .product {
                max-width: 90%;
            }
        }
    </style>
</head>

<header>
    <h1><?= htmlspecialchars($pageTitle) ?></h1>
</header>

<section class="section">
    <div class="grid">
        <?php
        if ($subCatId > 0) {
            $prodQuery = $conn->prepare("SELECT * FROM product WHERE sub_cat_id = ?");
            $prodQuery->bind_param("i", $subCatId);
            $prodQuery->execute();
            $prodResult = $prodQuery->get_result();

            if ($prodResult->num_rows > 0) {
                while ($prod = $prodResult->fetch_assoc()) {
                    $prodImg = "images/{$catName}/" . $prod['img'];
                    if (!file_exists($prodImg) || empty($prod['img'])) {
                        $prodImg = "images/default.png";
                    }

                    // Determine the View link based on login status
                    if ($isLoggedIn) {
                        $viewLink = "product_detail.php?id={$prod['pid']}";
                        $viewOnClick = "";
                    } else {
                        $viewLink = "javascript:void(0);";
                        $viewOnClick = "onclick=\"alert('Please login first!'); window.location.href='login.php?redirect=product_detail.php?id={$prod['pid']}';\"";
                    }

                    echo "
                    <div class='product'>
                        <img src='{$prodImg}' alt='" . htmlspecialchars($prod['pnm']) . "'>
                        <h4>" . htmlspecialchars($prod['pnm']) . "</h4>
                        <div class='price'>₹" . number_format($prod['price'], 2) . "</div>
                        <div class='prod-actions'>
                            <a href='{$viewLink}' {$viewOnClick}>View</a>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<p style='text-align:center;'>No products found in this subcategory.</p>";
            }
        } else {
            echo "<p style='text-align:center;'>Invalid subcategory selected.</p>";
        }
        ?>
    </div>
</section>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
