<!--login page-->
<?php
$title_page = "Login page";
ob_start();
?>

<?php
session_start();
include_once("db_connect.php");

$error = "";

// If user already logged in → redirect
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login - StyleHub</title>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery Validation Plugin -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fffaf8;
            color: #222;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
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

        /* Form Card */
        .form-container {
            max-width: 600px;
            margin: 110px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .formgroup {
            margin-bottom: 17px;
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #e58db5;
            box-shadow: 0px 0px 6px #f1b8da;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px 16px;
            font-size: 16px;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 700;
            background: linear-gradient(90deg, #ed86d0ff, #ff9eb0);
            color: white;
            transition: 0.3s;
            box-shadow: 0 6px 18px rgba(255, 111, 145, 0.15);
        }

        button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }


        label.error {
            color: red;
            font-size: 14px;
        }

        input.error,
        select.error {
            border: 2px solid red;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#loginForm").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4
                    },
                    password: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    username: "Enter valid username (min 4 characters)",
                    password: "Password must be at least 5 characters"
                }
            });
        });
    </script>
</head>

<body>
    <?php
    if (isset($_COOKIE['registered_msg'])) {

        echo "<div style='
        background: #d1ffd6;
        padding: 15px;
        border-left: 5px solid #28a745;
        width: 92%;
        margin: 20px auto;
        border-radius: 10px;
        font-size: 16px;
        color: #034d12;
        font-family: Poppins;
    '>
    <b>Hello " . $_COOKIE['registered_name'] . "!</b><br>
    " . $_COOKIE['registered_msg'] . "
    </div>";

        // Delete message cookie so it shows only once
        setcookie('registered_msg', '', time() - 3600, '/');
    }
    ?>

    <header>
        <h1>Login</h1>
    </header>

    <div class="form-container">
        <form id="loginForm" method="POST" action="login_action.php">


            <label for="username">Username</label>
            <input type="text" name="username"><br><br>

            <label for="password">Password</label>
            <input type="password" name="password"><br><br>

            <button type="submit">Login</button>

            <p style="text-align:center; margin-top:15px;">
                Don’t have an account? <a href="register.php" style="color:#7a0c2e; font-weight:bold;">Register</a>

                <label>
                    <input type="checkbox" name="remember_me"> Remember Me
                </label>
            <p style="text-align:center; margin-top:4px;">
                <a href="forgot_password.php" style="color:#7a0c2e; font-weight:bold;">Forgot Password?</a>
            </p>

            </p>
        </form>
        <!--for error-->
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
