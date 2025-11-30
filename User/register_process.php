<?php
// Include the database connection
include_once("db_connect.php");

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form values
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $address = trim($_POST['address']);
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Simple validation
    if ($fname == "" || $lname == "" || $username == "" || $email == "" || $mobile == "" || $address == "" || $dob == "" || $password == "" || $cpassword == "") {
        echo "<script>alert('Please fill all fields'); window.history.back();</script>";
        exit;
    }

    if ($password !== $cpassword) {
        echo "<script>alert('Passwords do not match'); window.history.back();</script>";
        exit;
    }

    // Since your password field is only varchar(8), we cannot hash it (otherwise it won't fit)
    // Just store plain password (not secure, but works for beginner/demo)
    $password_plain = $password;

    // Insert into your actual table: 'register'
    $sql = "INSERT INTO register (fname, lname, username, email, mobile, address, dob, password) 
            VALUES ('$fname', '$lname', '$username', '$email', '$mobile', '$address', '$dob', '$password_plain')";

    if ($conn->query($sql) === TRUE) {
        // Show success popup and redirect to login
        echo "<script>
                alert('Registered Successfully! Please Login.');
                window.location.href = 'login.php';
              </script>";
        exit;
    } else {
        // Show error
        echo "<script>
                alert('Error: Could not register. ".$conn->error."');
                window.history.back();
              </script>";
        exit;
    }

} else {
    // If someone tries to open this page directly
    header("Location: register.php");
    exit;
}
?>
