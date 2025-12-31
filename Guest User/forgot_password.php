<?php
$title_page = "Forgot Password";
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("db_connect.php");

$reset_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        // Generate token
        $token = bin2hex(random_bytes(50));

        // Save token
        $stmt = $conn->prepare("UPDATE users SET reset_token=? WHERE email=?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // For now just show link (later send via email)
        $reset_msg = "Reset link: <a href='reset_password.php?token=$token'>Click here</a>";
    } else {
        $reset_msg = "Email not found.";
    }
}
?>

<!doctype html>
<html>

<head>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#forgotForm").validate({
                errorElement: 'div',
                errorClass: 'error',
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: "Please enter a valid registered email address."
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
    <style>
        body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fffaf8;
            color: #222;
            line-height: 1.45;
        }

        .card {
            max-width: 600px;
            margin: 110px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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

        .btn {
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

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .info {
            background: #e6ffef;
            padding: 10px;
            border-left: 4px solid #16a34a;
            margin-bottom: 10px
        }

        label.error {
            color: red;
            font-size: 14px;
        }

        input.error,select.error
        {
            border: 2px solid red;
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

        label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .alert-message {
            margin-bottom: 20px;
            font-weight: 500;
        }
    </style>

</head>

<body>
    <header>
        <h1>Forgot Password</h1>
    </header>
    <div class="card">
        <?php if ($reset_msg): ?>
            <div class="alert alert-info alert-message text-center" style="text-align: center;"><?= $reset_msg ?></div>
        <?php endif; ?>

        <form id="forgotForm" action="forgot_password.php" method="post" novalidate>

            <label for="email">Registered Email</label>
            <input name="email" type="email" required>
            <div style="margin-top:12px"><button class="btn" type="submit">Send Reset Link</button></div>

            <p style="text-align:center; margin-top:4px;"> Remembered your password?
                <a href="login.php" style="color:#7a0c2e; font-weight:bold;">Back to Login</a>
            </p>

    </div>
    </form>
    </div>

</body>

</html>
<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>