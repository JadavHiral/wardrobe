<?php
include_once("db_connect.php");

$title_page = "Category";
ob_start();
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
            padding: 10px;
            text-align: center;
        }

        header h1 {
            font-size: 28px;
            color: #ffd6e0;
        }

        .cats {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
            margin: 32px 0;
        }

        .cat-card {
            text-align: center;
            text-decoration: none;
            color: #222;
            width: 220px; /* fixed width for consistency */
            padding: 10px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .cat-card:hover {
            transform: translateY(-5px);
        }

        .cat-card img {
            width: 100%; /* image fills width of card */
            height: auto; /* height adjusts automatically */
            border-radius: 12px;
            object-fit: contain; /* ensures full image is visible */
            display: block;
            margin: 0 auto; /* center image horizontally */
            background: #f5f5f5; /* optional placeholder background */
        }

        .cat-card h3 {
            margin-top: 10px;
            font-size: 18px;
        }
    </style>
</head>

<header>
    <h1>Our Classic Collection</h1>
</header>

<section class="section">
    <div class="cats">
        <?php
        $sql = "SELECT * FROM category ORDER BY cat_id ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $catId = $row['cat_id'];
                $catName = strtolower($row['cat_nm']);

                // Build correct image path
                $catImg = 'images/' . $catName . '/' . $row['img'];

                // fallback if image doesn't exist
                if (!file_exists($catImg)) {
                    $catImg = 'images/default.png';
                }

                echo "
                <a class='cat-card' href='sub_category.php?cat={$catName}&id={$catId}'>
                    <img src='{$catImg}' alt='{$row['cat_nm']}'>
                    <h3>{$row['cat_nm']}</h3>
                </a>
                ";
            }
        } else {
            echo "<p style='text-align:center;'>No categories found.</p>";
        }
        ?>
    </div>
</section>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
