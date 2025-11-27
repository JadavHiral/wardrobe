<?php
session_start();
$catnm = $_POST["cat_nm"];

$path = "../img/category/" . $_FILES['catimg']['name'];
$path1 = $_FILES['catimg']['name'];
move_uploaded_file($_FILES['catimg']['tmp_name'], $path);

include "config.php";
$qry = "insert into category(cat_nm,img) values('$catnm','$path1')";
$res = mysqli_query($con, $qry);
echo $res;
if ($res) {
    $_SESSION['msg'] = "Record Added Successfully...";
    echo "<script>window.location='category.php';</script>";
} else {
    $errormsg = "Something went wrong, Try again";
    echo "<script type='text/javascript'>alert('$errormsg');</script>";
}
ob_end_flush();

?>