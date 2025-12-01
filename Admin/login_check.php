<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // ✅ STATIC ADMIN LOGIN
    if ($username === "admin" && $password === "admin") {

        $_SESSION['admin_username'] = "admin";
        header("Location: dashboard.php");
        exit;
    } else {

        $_SESSION['error'] = "Invalid username or password!";
        header("Location: login.php");
        exit;
    }
}
