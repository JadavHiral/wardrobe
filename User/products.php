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
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            box-sizing: border-box;
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fffaf8;
            color: #222;
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

        /* Grid container */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 10px; /* slight padding for small screens */
            display: grid;
            gap: 30px;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            justify-items: center;
        }

        /* Product card */
        .product-card {
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(214, 51, 108, 0.1);
            transition: box-shadow 0.3s ease, transform 0.2s ease;
            text-align: center;
            text-decoration: none;
            color: #222;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 270px;
        }

        .product-card:hover {
            box-shadow: 0 8px 20px rgba(214, 51, 108, 0.3);
            transform: translateY(-5px);
        }

        /* Product image */
        .product-image {
            width: 100%;
            height: auto;
            max-height: 200px;      /* keeps cards uniform */
            object-fit: contain;     /* ensures full image visible */
            background-color: #f9f9f9;
            border-radius: 0.5rem;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-name {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
            text-align: center;
        }

        .price {
            color: #000;
            font-weight: 700;
            margin-bottom: 12px;
            font-size: 1.1rem;
        }

        .btn-view {
            background: linear-gradient(45deg, #a50046, #d6336c);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 10px 0;
            width: 100%;
            border-radius: 0.4rem;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-view:hover,
        .btn-view:focus {
            background: linear-gradient(45deg, #d6336c, #a50046);
            color: #fff;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .product-card {
                max-width: 90%;
            }
        }
    </style>
</head>

<header>
    <h1><?= htmlspecialchars($pageTitle) ?></h1>
</header>

<section>
    <div class="container">
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

                    if ($isLoggedIn) {
                        $viewLink = "product_detail.php?id={$prod['pid']}";
                        $viewOnClick = "";
                    } else {
                        $viewLink = "javascript:void(0);";
                        $viewOnClick = "onclick=\"alert('Please login first!'); window.location.href='login.php?redirect=product_detail.php?id={$prod['pid']}';\"";
                    }

                    echo "
                    <div class='product-card'>
                        <img src='{$prodImg}' alt='" . htmlspecialchars($prod['pnm']) . "' class='product-image'>
                        <div class='product-name'>" . htmlspecialchars($prod['pnm']) . "</div>
                        <div class='price'>₹" . number_format($prod['price'], 2) . "</div>
                        <a href='{$viewLink}' class='btn-view' {$viewOnClick}>View</a>
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
