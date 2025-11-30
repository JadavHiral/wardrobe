<?php
include_once("db_connect.php");

// subcategory.php
$title_page = "Subcategory";
ob_start();

// Get category ID from URL
$catId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch category info
$categoryQuery = $conn->prepare("SELECT * FROM category WHERE cat_id = ?");
$categoryQuery->bind_param("i", $catId);
$categoryQuery->execute();
$categoryResult = $categoryQuery->get_result();
$category = $categoryResult->fetch_assoc();

$catName = $category ? strtolower($category['cat_nm']) : '';
$pageTitle = $category ? $category['cat_nm'] . " Collection" : "Subcategories";
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

        .cat-card img {
            width: 100%;
            height: 200px;
            object-fit: cover; /* ensures image fills the div without stretching */
            display: block;
            border-radius: 12px 12px 0 0;
            background: #f5f5f5;
        }

        .cat-card h3 {
            margin: 10px 0;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .cat-card {
                max-width: 90%;
            }
        }
    </style>
</head>

<header>
    <h1><?= htmlspecialchars($pageTitle) ?> - Choose Your Style</h1>
</header>

<section class="section">
    <div class="cats">
        <?php
        if ($catId > 0) {
            // Fetch subcategories for this category
            $subQuery = $conn->prepare("SELECT * FROM sub_category WHERE cat_id = ?");
            $subQuery->bind_param("i", $catId);
            $subQuery->execute();
            $subResult = $subQuery->get_result();

            if ($subResult->num_rows > 0) {
                while ($sub = $subResult->fetch_assoc()) {
                    $subName = strtolower($sub['sub_cat_nm']);
                    $subImg = "images/{$catName}/" . $sub['img']; // Use filename from DB

                    // fallback if image doesn't exist
                    if (!file_exists($subImg) || empty($sub['img'])) {
                        $subImg = "images/default.png";
                    }

                    echo "
                    <a class='cat-card' href='products.php?cat={$catName}&sub={$subName}'>
                        <img src='{$subImg}' alt='{$sub['sub_cat_nm']}'>
                        <h3>{$sub['sub_cat_nm']}</h3>
                    </a>
                    ";
                }
            } else {
                echo "<p style='text-align:center;'>No subcategories found for this category.</p>";
            }
        } else {
            echo "<p style='text-align:center;'>No category selected.</p>";
        }
        ?>
    </div>
</section>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
