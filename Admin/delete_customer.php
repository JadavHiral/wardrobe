<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($con, "DELETE FROM register WHERE id = $id");

    header("Location: customer.php");
    exit();
}

header("Location: customer.php");
exit();
