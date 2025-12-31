<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['confirm_delete'])) {
    // Delete user record
    mysqli_query($conn, "DELETE FROM users WHERE id='$user_id'");
    
    
    // Clear session and redirect
    session_destroy();
    header("Location: goodbye.php"); // make a simple goodbye page
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <style>
        body { font-family:Poppins, sans-serif; background:#f7ded4; }
        .container { max-width:500px; margin:50px auto; background:#fff; padding:20px; border-radius:12px; text-align:center; }
        h2 { color:red; }
        button { margin:10px; padding:10px 20px; border:none; border-radius:8px; cursor:pointer; }
        .danger { background:#e63946; color:#fff; }
        .safe { background:#ccc; }
    </style>
</head>
<body>
<div class="container">
    <h2>⚠ Delete Account</h2>
    <p>Are you sure you want to permanently delete your account? This action cannot be undone.</p>
    <form method="POST">
        <button type="submit" name="confirm_delete" class="danger">Yes, Delete My Account</button>
        <button type="button" class="safe" onclick="window.location.href='myaccount.php'">Cancel</button>
    </form>
</div>
</body>
</html>
