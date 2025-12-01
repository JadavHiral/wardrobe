<?php
include_once("db_connect.php");

$search = "";

if (isset($_GET['search']) && trim($_GET['search']) !== "") {
    $search = "%" . $conn->real_escape_string($_GET['search']) . "%";
    $stmt = $conn->prepare("SELECT * FROM category WHERE cat_nm LIKE ? ORDER BY cat_id ASC");
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM category ORDER BY cat_id ASC");
}

if ($result->num_rows > 0) {
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
} else {
    echo "<p style='text-align:center; width:100%;'>No categories found.</p>";
}
?>
