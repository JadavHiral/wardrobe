<?php
include("config.php");

if (!isset($_GET['id'])) {
    header("Location: orders.php");
    exit;
}

$id = (int) $_GET['id'];

mysqli_query($con, "DELETE FROM orders WHERE o_id = $id");

header("Location: order.php");
exit;
