<!--register_action-->
<?php
session_start();
include_once("db_connect.php");

$success = "";
$error = "";

// When form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data safely
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);

    // Password hashing
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Handle image upload
    $photoName = "";

    if (!empty($_FILES['photo']['name'])) {

        // Create uploads folder if not exists
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        $photoName = time() . "_" . basename($_FILES['photo']['name']);
        $target = "uploads/" . $photoName;

        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
    }

    // Insert into DB
    $sql = "INSERT INTO users (fullname, username, email, phone, gender, dob, photo, password) 
            VALUES ('$fullname', '$username', '$email', '$phone', '$gender', '$dob', '$photoName', '$password')";

    if (mysqli_query($conn, $sql)) {

        // -------------------------------
        // Add cookies (valid for 30 days)
        // -------------------------------
        setcookie("registered_user", $username, time() + (30 * 24 * 60 * 60), "/");
        setcookie("registered_name", $fullname, time() + (30 * 24 * 60 * 60), "/");
        setcookie("registered_msg", "Welcome back! You are already registered.", time() + (30 * 24 * 60 * 60), "/");

        // Redirect to login
        header("Location: login.php?registered=1");
        exit;
    } else {
        $error = "Error: Could not register. Username or email may already exist.";
        echo $error;
    }
}
?>
