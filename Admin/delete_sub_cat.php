<?php
include 'config.php';

// Check if delete id exists
if (isset($_GET['id'])) {

    $sub_cat_id = $_GET['id'];

    /* ==== OPTIONAL: Delete sub category image ==== */
    $img_sql = $con->prepare(
        "SELECT sub_cat_img FROM sub_category WHERE sub_cat_id = ?"
    );
    $img_sql->bind_param("i", $sub_cat_id);
    $img_sql->execute();
    $img_result = $img_sql->get_result();
    $img_row = $img_result->fetch_assoc();

    if ($img_row && file_exists("img/" . $img_row['sub_cat_img'])) {
        unlink("img/" . $img_row['sub_cat_img']);
    }
    $img_sql->close();

    /* ==== DELETE SUB CATEGORY RECORD ==== */
    $stmt = $con->prepare(
        "DELETE FROM sub_category WHERE sub_cat_id = ?"
    );
    $stmt->bind_param("i", $sub_cat_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back
    header("Location: sub_category.php");
    exit();
}

// If someone opens file directly
header("Location: sub_category.php");
exit();
