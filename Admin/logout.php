<?php
session_start();
session_destroy();
header("location:login.php");
?>
<link rel="stylesheet" href="css/style.css">

<?php
include "layout.php";
?>