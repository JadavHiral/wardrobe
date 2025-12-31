<!-- reset_password.php -->
<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("db_connect.php");

$msg = "";

// Check if token is present
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify token
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token=? LIMIT 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password === $confirm_password) {
                $hashed = password_hash($new_password, PASSWORD_DEFAULT);

                // Update password and clear token
                $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL WHERE id=?");
                $stmt->bind_param("si", $hashed, $user['id']);
                $stmt->execute();

                $msg = "✅ Password reset successful! <a href='login.php'>Login here</a>";
            } else {
                $msg = "❌ Passwords do not match.";
            }
        }
    } else {
        $msg = "❌ Invalid or expired token.";
    }
} else {
    $msg = "❌ No token provided.";
}
?>

<header><h1>Reset Password</h1></header>

    
    <div class="form-container">
        
        <?php if (!empty($msg)): ?>
            <div class="alert alert-info text-center"><?= $msg ?></div>
        <?php endif; ?>

        <form id="resetForm" action="reset_password.php?token=<?= htmlspecialchars($_GET['token']) ?>" method="post" novalidate>
        
                <label for="new_password">New Password</label>
                <input type="password"  id="new_password" name="new_password" required />
           

                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required />
        

            <button type="submit" class="btn btn-reset w-100">Reset Password</button>

               <p style="text-align:center; margin-top:4px;"> Go back to
                <a href="login.php" style="color:#7a0c2e; font-weight:bold;">Login</a>
            </p>

        </form>
    </div>
</div>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery & Validation -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $("#resetForm").validate({
            errorElement: 'div',
            errorClass: 'error',
            rules: {
                new_password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: "#new_password"
                }
            },
            messages: {
                new_password: "Enter a new password (min 6 chars)",
                confirm_password: "Passwords must match"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

<style>
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

   body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fffaf8;
            color: #222;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.45;
        }

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
        label.error {
            color: red;
            font-size: 14px;
        }

        input.error,select.error
        {
            border: 2px solid red;
        }

label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }
  

    .btn-reset {
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

    .btn-reset:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

   

    .alert-info {
        font-weight: 500;
        margin-bottom: 20px;
    }
</style>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>