<!--logout page-->
<?php
session_start();

// Clear login cookie
if (isset($_COOKIE['remember_user'])) {
    setcookie("remember_user", "", time() - 3600, "/");
}

// Clear registration cookies
setcookie("registered_user", "", time() - 3600, "/");
setcookie("registered_name", "", time() - 3600, "/");
setcookie("registered_msg", "", time() - 3600, "/");

// Destroy session
session_unset();
session_destroy();

?>




<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>

    <style>
        body {
            margin: 0;
            padding: 0;
         font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            color: #222;
            background: linear-gradient(120deg, #ffdde1, #ee9ca7);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logout-box {
            background: white;
            width: 380px;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0px 6px 25px rgba(0,0,0,0.12);
            text-align: center;
            animation: fadeIn 0.4s ease-in-out;
        }

        .logout-box h2 {
            color: #ca829aff;
            margin-bottom: 10px;
        }

        .logout-box p {
            color: #444;
            font-size: 15px;
        }

        .login-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #ff4f72;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #e6004c;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

</head>
<body>

    <div class="logout-box">
        <h2>You are logged out</h2>
        <p>Thank you for visiting! You can login again anytime.</p>

        <a href="login.php" class="login-btn">Login Again</a>
    </div>

</body>
</html>


