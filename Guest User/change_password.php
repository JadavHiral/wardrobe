<?php
$title_page = "Change Password";
ob_start();
session_start();
include_once("db_connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$uid = (int)$_SESSION['user_id'];
$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($new !== $confirm) {
        $error = "New passwords do not match.";
    } elseif (strlen($new) < 6) {
        $error = "New password should be 6+ characters.";
    } else {
        $stmt = $conn->prepare("SELECT password FROM users WHERE id=? LIMIT 1");
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $stmt->bind_result($hash);
        if ($stmt->fetch() && password_verify($current, $hash)) {
            $stmt->close();
            $newhash = password_hash($new, PASSWORD_DEFAULT);
            $u = $conn->prepare("UPDATE users SET password=? WHERE id=?");
            $u->bind_param("si", $newhash, $uid);
            if ($u->execute()) {
                $success = "Password updated.";
            } else {
                $error = "Update failed.";
            }
            $u->close();
        } else {
            $error = "Current password incorrect.";
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html>

<head>
    <title> 
<script src="js/jquery.validate.min.js"></script>
<script src="js/jquery.validate.min.js"></script>

   
    <script src="jquery-3.7.1.js"></script>
</title>
    <style>
         body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
          background: linear-gradient(90deg, #f7ded4 50%, #e7b0c3 100%);
            color: #222;
            line-height: 1.45;
        }


        .box {
            max-width: 640px;
            margin: 80px auto;
            background: #fff;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06)
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
            border: 1px solid #ddd
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

        .success {
            background: #e6ffef;
            padding: 12px;
            border-left: 4px solid #16a34a;
            margin-bottom: 10px
        }

        .error {
            background: #ffecec;
            padding: 12px;
            border-left: 4px solid #f43f5e;
            margin-bottom: 10px
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
    </style>
    <script>
$(document).ready(function () {

    $("#changePasswordForm").validate({
        rules: {
            current_password: {
                required: true,
                minlength: 5
            },
            new_password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "input[name='new_password']"
            }
        },

        messages: {
            current_password: {
                required: "Enter your current password",
                minlength: "Password must be at least 5 characters"
            },
            new_password: {
                required: "Enter a new password",
                minlength: "New password must be at least 6 characters"
            },
            confirm_password: {
                required: "Confirm your new password",
                minlength: "Confirm password must be at least 6 characters",
                equalTo: "Passwords do not match"
            }
        }
    });

});
</script>

</head>

<body>
    <header><h1>Change Password</h1></header>
    <div class="box">
        
        <?php if ($success): ?><div class="success"><?= $success ?></div><?php endif; ?>
        <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

        <form method="POST">
            <label>Current password</label>
            <input type="password" name="current_password" required>

            <label>New password</label>
            <input type="password" name="new_password" required>

            <label>Confirm new password</label>
            <input type="password" name="confirm_password" required> </br><br>
       
            <button class="btn" type="submit">Update password</button>
        </form>
    </div>
</body>

</html>
<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>