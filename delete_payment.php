<?php
include 'config.php';
include "layout.php";

// Single delete
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($con, "DELETE FROM payment WHERE id='$id'");
    header("Location: payment.php");
}

// Multiple delete
if (isset($_POST['delete_id'])) {
    foreach ($_POST['delete_id'] as $id) {
        mysqli_query($conn, "DELETE FROM payment WHERE id='$id'");
    }
    header("Location: payment.php");
}
?>