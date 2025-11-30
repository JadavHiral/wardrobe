<?php
$title_page = "Register page";
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
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
      margin: 40px auto;
      background: #ffffff;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .formgroup 
    {
       margin-bottom: 17px;
    }
    label 
    {
       font-weight: 500; 
       margin-bottom: 5px; 
       display:block; 
       color:#333; 
    }
    input,
    textarea, 
    select 
    {
      width:100%; 
      padding:10px; 
      border-radius:8px; 
      border:1px solid #ccc; 
      font-size:15px; transition:0.3s;
    }
    input:focus,
    textarea:focus 
    {
       border-color:#e58db5; 
       box-shadow:0px 0px 6px #f1b8da; 
       outline:none; 
    }
    input.error, 
    textarea.error 
    {
       border:2px solid red; 
    }
    label.error 
    {
       color:red; 
       font-size:12px; 
       margin-top:3px; 
    }
    button 
    {
      width:100%; 
      padding:10px 16px; 
      font-size:16px; 
      border:none; 
      border-radius:999px;
      cursor:pointer; 
      font-weight:700; 
      background:linear-gradient(90deg, #ed86d0ff, #ff9eb0); 
      color:white; transition:0.3s;
      box-shadow:0 6px 18px rgba(255,111,145,0.15);
    }
    button:hover 
    {
       opacity:0.9; 
       transform:translateY(-2px); 
    }
  </style>
</head>

<body>
<?php 
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<script>
            alert('Registered Successfully! Please Login.');
            window.location.href = 'login.php';
          </script>";
}
?>

<header>
  <h1>Register</h1>
</header>

<div class="form-container">
  <form id="regform" method="POST" action="register_process.php" novalidate>

    <div class="formgroup">
      <label for="fname">First Name</label>
      <input type="text" name="fname" id="fname">
    </div>

    <div class="formgroup">
      <label for="lname">Last Name</label>
      <input type="text" name="lname" id="lname">
    </div>

    <div class="formgroup">
      <label for="username">Username</label>
      <input type="text" name="username" id="username">
    </div>

    <div class="formgroup">
      <label for="email">Email</label>
      <input type="email" name="email" id="email">
    </div>

    <div class="formgroup">
      <label for="mobile">Mobile</label>
      <input type="tel" name="mobile" id="mobile">
    </div>

    <div class="formgroup">
      <label for="address">Address</label>
      <textarea name="address" id="address" rows="3"
      style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; font-size:15px;"></textarea>
    </div>

    <div class="formgroup">
      <label for="dob">Date of Birth</label>
      <input type="date" name="dob" id="dob">
    </div>

    <div class="formgroup">
      <label for="password">Password (max 8 chars)</label>
      <input type="password" name="password" id="password" maxlength="8">
    </div>

    <div class="formgroup">
      <label for="cpassword">Confirm Password</label>
      <input type="password" name="cpassword" id="cpassword" maxlength="8">
    </div>

    <button type="submit">Register</button>
  </form>

  <p style="text-align:center; margin-top:15px;">
    Already have an account? 
    <a href="login.php" style="color:#7a0c2e; font-weight:bold;">Login</a>
  </p>
</div>

<script>
$(document).ready(function() {
  $("#regform").validate({
    rules: {
      fname: { required:true, minlength:2 },
      lname: { required:true, minlength:2 },
      username: { required:true, minlength:3, maxlength:12 },
      email: { required:true, email:true },
      mobile: { required:true, digits:true, minlength:10, maxlength:10 },
      address: { required:true, minlength:5 },
      dob: { required:true },
      password: { required:true, minlength:4, maxlength:8 },
      cpassword: { required:true, equalTo:"#password" }
    },
    messages: {
      fname: "Enter first name",
      lname: "Enter last name",
      username: "Enter username",
      email: "Enter a valid email",
      mobile: "Enter 10-digit mobile",
      address: "Enter address",
      dob: "Select date of birth",
      password: "Enter password (max 8 chars)",
      cpassword: "Passwords do not match"
    },
    errorPlacement: function(error, element){ error.insertAfter(element); }
  });
});
</script>

</body>
</html>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
