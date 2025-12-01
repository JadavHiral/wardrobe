<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    mysqli_query($con, "DELETE FROM shipping WHERE id=$id");
}

header("Location: shipping.php");
exit;
