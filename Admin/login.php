<?php
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND role='admin'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // If password is not hashed
        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = 'admin';
            header("Location: dashboard.php");
            exit;
        }
    }

    $error = "Invalid login details";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <!-- Font Awesome for eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background:
                linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
                url('img/slider-2.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        * {
            box-sizing: border-box;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
            padding: 35px 30px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(14px);
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 600;
            color: #fff;
            letter-spacing: 0.5px;
        }

        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        .login-box input {
            width: 100%;
            height: 50px;
            padding: 0 44px 0 14px;
            border-radius: 10px;
            border: none;
            outline: none;
            font-size: 15px;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #1e40af;
            font-size: 18px;
            opacity: 0.95;
        }

        .toggle-password:hover {
            opacity: 1;
        }

        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }

        .login-box button {
            width: 100%;
            height: 50px;
            margin-top: 15px;
            background: #2563eb;
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-box button:hover {
            background: #1e40af;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.45);
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>

    <form class="login-box" method="POST" action="login_check.php">
        <h2>Admin Login</h2>

        <?php
        if (isset($_SESSION['error'])) {
            echo '
    <div style="
        background:#ff4d4d;
        color:#fff;
        padding:12px;
        border-radius:10px;
        margin-bottom:15px;
        font-size:14px;
        animation: shake 0.3s;
    ">
        ' . $_SESSION['error'] . '
    </div>';
            unset($_SESSION['error']);
        }
        ?>




        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" id="password" placeholder="Password" required autocomplete="off"
                data-lpignore="true">

            <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()"></i>
        </div>


        <button type="submit">Login</button>

    </form>

    <script>
        function togglePassword() {
            const pwd = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");

            if (pwd.type === "password") {
                pwd.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                pwd.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>

</body>

</html>
