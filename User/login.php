<?php
$title_page = "Login page";
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - StyleHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fffaf8;
            color: #222;
            line-height: 1.45;
        }
        header {
            background: linear-gradient(40deg, #111827, #1f2937);
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        header h1 {
            font-size: 28px;
            color: #ffd6e0;
        }
        .form-container {
            max-width: 600px;
            margin: 110px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .formgroup { margin-bottom: 17px; }
        label { font-weight: 500; margin-bottom: 5px; display:block; color:#333; }
        input {
            width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; font-size:15px; transition:0.3s;
        }
        input:focus { border-color:#e58db5; box-shadow:0px 0px 6px #f1b8da; outline:none; }
        button {
            width:100%; padding:10px 16px; font-size:16px; border:none; border-radius:999px; cursor:pointer;
            font-weight:700; background:linear-gradient(90deg, #ed86d0ff, #ff9eb0); color:white; transition:0.3s;
            box-shadow:0 6px 18px rgba(255,111,145,0.15);
        }
        button:hover { opacity:0.9; transform:translateY(-2px); }
        label.error { color:red; font-size:12px; margin-top:3px; }
        input.error { border:2px solid red; }
    </style>

    <script>
    $(document).ready(function() {
        $("#loginForm").validate({
            rules: {
                username: { required:true, minlength:3 },
                password: { required:true, minlength:4, maxlength:8 }
            },
            messages: {
                username: "Enter your username",
                password: "Enter password (max 8 characters)"
            },
            errorPlacement: function(error, element){ error.insertAfter(element); }
        });
    });
    </script>
</head>

<body>

<header>
    <h1>Login</h1>
</header>

<div class="form-container">
    <form id="loginForm" method="POST" action="login_process.php">
        <div class="formgroup">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>

        <div class="formgroup">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" maxlength="8">
        </div>

        <button type="submit">Login</button>
    </form>

    <p style="text-align:center; margin-top:15px;">
        Don’t have an account? <a href="register.php" style="color:#7a0c2e; font-weight:bold;">Register</a>
    </p>

    <!-- Display error -->
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "wrongpassword") {
            echo "<p style='color:red; text-align:center;'>Incorrect password!</p>";
        }
        if ($_GET['error'] == "notfound") {
            echo "<p style='color:red; text-align:center;'>User not found!</p>";
        }
    }
    ?>
</div>

</body>
</html>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
