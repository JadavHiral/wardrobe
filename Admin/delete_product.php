<?php
include 'config.php';

// Check if delete id exists
if (isset($_GET['id'])) {

    $pid = $_GET['id'];

    /* ==== OPTIONAL: Delete product image ==== */
    $img_sql = $con->prepare("SELECT img FROM product WHERE pid = ?");
    $img_sql->bind_param("i", $pid);
    $img_sql->execute();
    $img_result = $img_sql->get_result();
    $img_row = $img_result->fetch_assoc();

    if ($img_row && file_exists("img/" . $img_row['img'])) {
        unlink("img/" . $img_row['img']);
    }
    $img_sql->close();

    /* ==== DELETE PRODUCT RECORD ==== */
    $stmt = $con->prepare("DELETE FROM product WHERE pid = ?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $stmt->close();

    // Redirect back
    header("Location: product.php");
    exit();
}

// If someone opens file directly
header("Location: product.php");
exit();
