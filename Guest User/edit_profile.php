
<!-- ✅ edit_profile.php -->
<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Handle form submission
$message = "";
$messageType = ""; // success or error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name  = $_POST['name'];
    $new_phone = $_POST['phone'];
    $photoName = null;

    if (!empty($_FILES['photo']['name'])) {
    $photoName = time() . "_" . basename($_FILES['photo']['name']);
    $targetPath = "uploads/" . $photoName;
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath);

    $stmt = $conn->prepare("UPDATE users SET fullname=?, phone=?, photo=? WHERE id=?");
    $stmt->bind_param("sssi", $new_name, $new_phone, $photoName, $user_id);

    // ✅ update session immediately
    $_SESSION['user_photo'] = $photoName;
} else {
    $stmt = $conn->prepare("UPDATE users SET fullname=?, phone=? WHERE id=?");
    $stmt->bind_param("ssi", $new_name, $new_phone, $user_id);

    // ✅ keep old photo in session
    // $_SESSION['user_photo'] = $user['photo'];
}


  if ($stmt->execute()) {
    // ✅ Refresh session with updated user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $updatedUser = $result->fetch_assoc();

    $_SESSION['user_name'] = $updatedUser['username']; // already set
    $_SESSION['user_photo'] = $updatedUser['photo'];   // ✅ new session variable

    // ✅ Redirect with a status flag
    header("Location: edit_profile.php?status=success");
    exit();
}
 else {
        header("Location: edit_profile.php?status=error");
        exit();
    }
}

// ✅ Fetch current user data
$stmt = $conn->prepare("SELECT fullname, username, email, phone, photo FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$fullname = $user['fullname'];
$username = $user['username'];
$email    = $user['email'];
$phone    = $user['phone'];
$photo    = $user['photo'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <style>
        body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(90deg, #f7ded4ff 50%, #e7b0c3ff 100%);
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

        .container {
            width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        input[type=text],
        input[type=email],
        input[type=file] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
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

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 15px;
        }

        #message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
        }

        #message.success {
            color: #155724;
            background: #d4edda;
        }

        #message.error {
            color: #721c24;
            background: #f8d7da;
        }
    </style>
</head>

<body>
    <header>
        <h1>Edit Profile</h1>
    </header>
    <div class="container">


        <img class="profile-photo" src="uploads/<?php echo $photo; ?>" alt="Profile Photo">

        <!-- ✅ Message container -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div id="message" class="success">Profile updated successfully!</div>
            <script>
                setTimeout(function() {
                    var msg = document.getElementById("message");
                    if (msg) {
                        msg.style.display = "none";
                    }
                }, 3000);
            </script>
        <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            <div id="message" class="error">Error updating profile!</div>
            <script>
                setTimeout(function() {
                    var msg = document.getElementById("message");
                    if (msg) {
                        msg.style.display = "none";
                    }
                }, 3000);
            </script>
        <?php endif; ?>


        <form method="POST" enctype="multipart/form-data">

            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $fullname; ?>" required>
            </div>

            <div class="input-group">
                <label>Email (not editable)</label>
                <input type="email" value="<?php echo $email; ?>" disabled>
            </div>

            <div class="input-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo $phone; ?>" required>
            </div>

            <div class="input-group">
                <label>Change Photo</label>
                <input type="file" name="photo">
            </div>

            <button type="submit">Update Profile</button>

            <button type="button" onclick="window.history.back();"
                style="margin-top:10px; background:#ccc; color:#000;">
                ← Back
            </button>

        </form>
    </div>

</body>

</html>