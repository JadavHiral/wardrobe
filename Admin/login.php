<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            /* background: linear-gradient(to right, #ffe6f0, #fce4ec); */
            background-image: url('img/slider-2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: #fff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 0 15px rgba(255, 182, 193, 0.4);
            width: 500px;
            height: auto;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 30px;
            color: #d81b60;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #f8bbd0;
            border-radius: 6px;
        }

        .toggle-password {
            position: relative;
            float: right;
            margin-top: -30px;
            margin-right: 10px;
            cursor: pointer;
            color: #d81b60;
        }

        .login-box button {
            background: #d81b60;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-box button:hover {
            background: #c2185b;
        }
    </style>
</head>

<body>
    <form class="login-box" method="POST" action="layout.php">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <span class="toggle-password" onclick="togglePassword()"></span>
        <button type="submit">Login</button>
    </form>

    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            pwd.type = pwd.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>

</html>