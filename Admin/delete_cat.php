<?php
include 'config.php'; // database connection

// Check if delete id exists
if (isset($_GET['id'])) {

    $cat_id = $_GET['id'];

    /* ==== OPTIONAL: Delete category image ==== */
    $img_sql = $con->prepare("SELECT img FROM category WHERE cat_id = ?");
    $img_sql->bind_param("i", $cat_id);
    $img_sql->execute();
    $img_result = $img_sql->get_result();
    $img_row = $img_result->fetch_assoc();

    if ($img_row && file_exists("uploads/" . $img_row['img'])) {
        unlink("img/" . $img_row['img']);
    }
    $img_sql->close();

    /* ==== DELETE CATEGORY RECORD ==== */
    $stmt = $con->prepare("DELETE FROM category WHERE cat_id = ?");
    $stmt->bind_param("i", $cat_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back
    header("Location: category.php");
    exit();
}

// If someone opens file directly
header("Location: category.php");
exit();
