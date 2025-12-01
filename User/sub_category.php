<?php
include_once("db_connect.php");

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
        /* Reset extra space */
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
            padding: 0; /* remove extra padding */
            display: grid;
            gap: 30px;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            justify-items: center;
            box-sizing: border-box;
        }

        /* Card styling */
        .cat-card {
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
            box-sizing: border-box;
        }

        .cat-card:hover {
            box-shadow: 0 8px 20px rgba(214, 51, 108, 0.3);
            transform: translateY(-5px);
        }

        /* Image styling */
        .cat-image {
            width: 100%;
            aspect-ratio: 4 / 3; /* keeps consistent ratio */
            object-fit: contain;  /* perfect fit without cropping */
            background-color: #f9f9f9;
            border-radius: 0.5rem;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .cat-card:hover .cat-image {
            transform: scale(1.05);
        }

        .cat-name {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
            text-align: center;
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

<section>
    <div class="container">
        <?php
        if ($catId > 0) {

            // Fetch subcategories
            $subQuery = $conn->prepare("SELECT * FROM sub_category WHERE cat_id = ?");
            $subQuery->bind_param("i", $catId);
            $subQuery->execute();
            $subResult = $subQuery->get_result();

            if ($subResult->num_rows > 0) {
                while ($sub = $subResult->fetch_assoc()) {

                    $subName = strtolower($sub['sub_cat_nm']);
                    $subImg = "images/{$catName}/" . $sub['sub_cat_img'];

                    // fallback image
                    if (!file_exists($subImg) || empty($sub['sub_cat_img'])) {
                        $subImg = "images/default.png";
                    }

                    echo "
                    <a class='cat-card' href='products.php?cat={$catName}&sub={$subName}'>
                        <img src='{$subImg}' class='cat-image' alt='".htmlspecialchars($sub['sub_cat_nm'])."'>
                        <div class='cat-name'>".htmlspecialchars($sub['sub_cat_nm'])."</div>
                    </a>";
                }
            } else {
                echo "<p style='text-align:center;'>No subcategories found.</p>";
            }

        } else {
            echo "<p style='text-align:center;'>Invalid category selected.</p>";
        }
        ?>
    </div>
</section>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
