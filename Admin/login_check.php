<?php
include 'config.php'; // contains $con = new mysqli(...);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
    } else {
        echo "<script>alert('Invalid username or password'); window.history.back();</script>";
    }
}
?>