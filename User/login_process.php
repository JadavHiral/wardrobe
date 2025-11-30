<?php
session_start();
include_once("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Query your register table
    $sql = "SELECT * FROM register WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Check plain password (since varchar(8) stores plain password)
        if ($password === $user['password']) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: home.php");
            exit;
        } else {
            header("Location: login.php?error=wrongpassword");
            exit;
        }
    } else {
        header("Location: login.php?error=notfound");
        exit;
    }

} else {
    header("Location: login.php");
    exit;
}
?>
