<?php

$con = mysqli_connect("localhost", "root", "", );

try {
    mysqli_select_db($con, "wardrobe_db");
} catch (Exception $e) {
    echo "Error in selecting database";
}
?>