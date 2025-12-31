<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications</title>
    <style>
        body { font-family: Poppins, sans-serif; background:#f7ded4; }
        .container { max-width:600px; margin:50px auto; background:#fff; padding:20px; border-radius:12px; }
        h2 { color:#d12c6a; }
        .note { padding:10px; border-bottom:1px solid #eee; }
        .empty { color:#555; }
        button { margin-top:20px; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;
                 background:linear-gradient(90deg,#ed86d0,#ff9eb0); color:#fff; font-weight:700; }
    </style>
</head>
<body>
<div class="container">
    <h2>🔔 Your Notifications</h2>
    <?php if (!empty($_SESSION['notifications'])): ?>
        <?php foreach ($_SESSION['notifications'] as $note): ?>
            <div class="note"><?php echo $note; ?></div>
        <?php endforeach; ?>
        <?php // Clear after showing so they don’t repeat ?>
        <?php $_SESSION['notifications'] = []; ?>
    <?php else: ?>
        <p class="empty">No new notifications.</p>
    <?php endif; ?>
    <button onclick="window.location.href='myaccount.php'">← Back to Account</button>
</div>
</body>
</html>
