<?php
include_once("db_connect.php");

$title_page = "Category";
ob_start();
?>

<head>
<style>
    body {
        font-family: 'Poppins', system-ui;
        background: #fffaf8;
        color: #222;
    }
    header {
        background: linear-gradient(40deg, #111827, #1f2937);
        color: #fff;
        padding: 20px;
        text-align: center;
    }
    header h1 { font-size: 28px; color: #ffd6e0; margin: 0; }

    /* Search box */
    .search-box {
        max-width: 400px;
        margin: 20px auto;
        text-align: center;
    }
    .search-box input {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    /* Category Grid */
    .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 15px;
        display: grid;
        gap: 30px;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .cat-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        background: #fff;
        text-align: center;
        text-decoration: none;
        color: black;
        box-shadow: 0 4px 10px rgba(214, 51, 108, 0.1);
        transition: 0.3s;
    }

    .cat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(214, 51, 108, 0.3);
    }

    .cat-image {
        width: 100%;
        aspect-ratio: 4/3;
        object-fit: contain;
        background: #f9f9f9;
        border-radius: 10px;
        margin-bottom: 15px;
    }
</style>

<script>
function searchCategory() {
    let s = document.getElementById('cat-search').value;

    let req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('category-container').innerHTML = this.responseText;
        }
    };

    req.open("GET", "search_category.php?search=" + s, true);
    req.send();
}
</script>

</head>

<header>
    <h1>Our Classic Categories</h1>
</header>

<!-- Search Box -->
<div class="search-box">
    <input type="text" id="cat-search" onkeyup="searchCategory()" placeholder="Search Categories...">
</div>

<section>
    <div class="container" id="category-container">
        <?php
        $result = $conn->query("SELECT * FROM category ORDER BY cat_id ASC");

        while ($row = $result->fetch_assoc()) {
            $catId = $row['cat_id'];
            $catName = strtolower($row['cat_nm']);

            $catImg = "images/$catName/" . $row['img'];
            if (!file_exists($catImg) || empty($row['img'])) {
                $catImg = "images/default.png";
            }

            echo "
            <a class='cat-card' href='sub_category.php?cat={$catName}&id={$catId}'>
                <img src='{$catImg}' class='cat-image'>
                <div class='cat-name'>{$row['cat_nm']}</div>
            </a>";
        }
        ?>
    </div>
</section>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
