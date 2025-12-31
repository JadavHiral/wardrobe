<?php
session_start();
// No need for db_connect here since the account is already deleted
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Goodbye</title>
    <style>
        body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(90deg, #f7ded4ff 50%, #e7b0c3ff 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        h1 {
            color: #d12c6a;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            margin-bottom: 30px;
        }
        button {
            padding: 12px 20px;
            border: none;
            border-radius: 999px;
            background: linear-gradient(90deg, #ed86d0, #ff9eb0);
            color: white;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(255,111,145,0.15);
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(255,111,145,0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Goodbye from StyleHub 💖</h1>
        <p>Your account has been deleted successfully. We’re sad to see you go, but thank you for being part of StyleHub.</p>
        <button onclick="window.location.href='home.php'">Return to Home</button>
    </div>
</body>
</html>
