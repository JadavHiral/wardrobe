<!-- login_action.php -->
<?php
session_start();
include_once("db_connect.php");

// Auto login from cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {

    $user_id = $_COOKIE['remember_user'];
    $sql = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $user = mysqli_fetch_assoc($res);

        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name']  = $user['username'];
        $_SESSION['user_photo'] = $user['photo'];   // FIXED

        header("Location: home.php");
        exit;
    }
}

// Normal login
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) == 1) {

    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name']  = $user['username'];
        $_SESSION['user_photo'] = $user['photo'];   // FIXED

        if (isset($_POST['remember_me'])) {
            setcookie("remember_user", $user['id'], time() + 86400 * 3, "/");
        }

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
?>
