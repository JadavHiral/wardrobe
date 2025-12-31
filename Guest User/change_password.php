<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = $error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'] ?? '';
    $new     = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($new !== $confirm) {
        $error = "New passwords do not match.";
    } elseif (strlen($new) < 6) {
        $error = "New password must be at least 6 characters.";
    } else {
        // Fetch stored hash
        $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($storedHash);
        if ($stmt->fetch()) {
            $stmt->close();
            if (password_verify($current, $storedHash) || $current === $storedHash || md5($current) === $storedHash) {
                // valid


                // $newHash = password_hash($new, PASSWORD_DEFAULT);
                // $update = $conn->prepare("UPDATE users SET password=? WHERE id=?");
                // $update->bind_param("si", $newHash, $user_id);
                // $update->execute();

                // if ($update->execute()) {
                //     header("Location: change_password.php?status=success");
                //     exit();
                // } else {
                //     $error = "Error updating password.";
                // }
                // $update->close();
                $newHash = password_hash($new, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE users SET password=? WHERE id=?");
                $update->bind_param("si", $newHash, $user_id);

                if ($update->execute()) {
                    $_SESSION['notifications'][] = "🔐 Your password has been changed successfully!";
                    header("Location: change_password.php?status=success");
                    exit();
                } else {
                    $error = "Error updating password.";
                }
                $update->close();
            } else {
                $error = "Current password is incorrect.";
            }
        } else {
            $error = "User not found.";
            $stmt->close();
        }
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(90deg, #f7ded4 50%, #e7b0c3 100%);
            color: #222;
        }

        .container {
            max-width: 500px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ff698c;
        }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #ed86d0ff, #ff9eb0);
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 999px;
            cursor: pointer;
        }

        .message {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }

        .back-btn {
            margin-top: 10px;
            background: #ccc;
            color: #000;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            display: block;
            text-decoration: none;
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
</head>

<body>
    <header>
        <h1>Change Password</h1>
    </header>
    <div class="container">


        <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
            <div class="message success">Password updated successfully!</div>
            <script>
                setTimeout(() => {
                    document.querySelector('.success')?.remove();
                }, 3000);
            </script>
        <?php elseif (!empty($error)): ?>
            <div class="message error"><?= $error ?></div>
            <script>
                setTimeout(() => {
                    document.querySelector('.error')?.remove();
                }, 3000);
            </script>
        <?php endif; ?>

        <form method="POST">
            <label>Current Password</label>
            <input type="password" name="current_password" required>

            <label>New Password</label>
            <input type="password" name="new_password" required>

            <label>Confirm New Password</label>
            <input type="password" name="confirm_password" required>

            <button class="btn" type="submit">Update Password</button>
        </form>
        <button class="btn" onclick="window.location.href='myaccount.php'"
            style="margin-top:10px; background:#ccc; color:#000;">
            ← Back
        </button>
    </div>

</body>

</html>
<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>