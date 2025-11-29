<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($con, "DELETE FROM feedback WHERE id = '$id'");
}

header("Location: manage_feedback.php");
exit;
