<!--register page-->
<?php
$title_page = "Register page";
ob_start();
?>


<!DOCTYPE html>
<html>

<head>
  <title>Register Validation</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

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

    h2 {
      text-align: center;
      margin-top: 30px;
      color: #111827;
    }

    /* Form Card */
    .form-container {
      max-width: 600px;
      margin: 40px auto;
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

    input,
    select {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 15px;
      transition: 0.3s;
    }

    input:focus,
    select:focus {
      border-color: #e58db5;
      box-shadow: 0px 0px 6px #f1b8da;
      outline: none;
    }

    /* Error styles */
    input.error,
    select.error {
      border: 2px solid red;
    }

    label.error {
      color: red;
      font-size: 12px;
      margin-top: 3px;
    }

    /* Submit Button */
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
  </style>
</head>

<body>
  <?php
  if (isset($_COOKIE['registered_msg'])) {
    echo "<div style='
        background: #d1ffd6; 
        padding: 15px; 
        border-left: 5px solid #28a745; 
        width: 90%; 
        margin: 10px auto;
        border-radius: 8px;
        font-size: 16px;
    '>
    <b>Hello " . $_COOKIE['registered_name'] . "!</b><br>
    " . $_COOKIE['registered_msg'] . "
    </div>";
  }
  ?>

  <header>
    <h1>Registration</h1>
  </header>
  <div class="form-container">
    <form id="regform" method="POST" action="register_action.php" enctype="multipart/form-data" novalidate>


      <div class="formgroup">
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname">
      </div>

      <div class="formgroup">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
      </div>

      <div class="formgroup">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
      </div>

      <div class="formgroup">
        <label for="phone">Phone</label>
        <!-- <input type="tel" name="phone" id="phone"> -->
        <input type="tel" name="phone" id="phone" pattern="^\+?[0-9\s\-]{10,15}$" title="Enter a valid phone number">

      </div>

      <div class="formgroup">
        <label for="gender">Gender</label>
        <select name="gender" id="gender">
          <option value="">Select gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>

      <div class="formgroup">
        <label for="dob">DOB</label>
        <input type="date" name="dob" id="dob">
      </div>

      <div class="formgroup">
        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" accept=".jpg,.jpeg,.png,.gif">
      </div>

      <div class="formgroup">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
      </div>

      <div class="formgroup">
        <label for="cpassword">Confirm Password</label>
        <input type="password" name="cpassword" id="cpassword">
      </div>

      <!-- <button type="submit" href="login.php">Register</button>-->
      <button type="submit">Register</button>

    </form>


    <p style="text-align:center; margin-top:15px;">
      Already have an account?
      <a href="l<ogin.php" style="color:#7a0c2e; font-weight:bold;">Login</a>
    </p>

  </div>

  <script>
    $(document).ready(function() {

      $.validator.addMethod("extension", function(value, element, param) {
        if (value === "") return true;
        var pattern = new RegExp("\\.(" + param + ")$", "i");
        return pattern.test(value);
      });

      $("#regform").validate({
        rules: {
          fullname: {
            required: true,
            minlength: 3
          },
          username: {
            required: true,
            minlength: 3,
            maxlength: 15
          },
          email: {
            required: true,
            email: true
          },
          // phone: { required: true, digits: true, minlength: 10, maxlength: 10 },
          phone: {
            required: true,
            minlength: 10,
            maxlength: 15,
            pattern: /^\+?[0-9\s\-]{10,15}$/
          },
          gender: {
            required: true
          },
          dob: {
            required: true
          },
          photo: {
            required: true,
            extension: "jpg|jpeg|png|gif"
          },
          password: {
            required: true,
            minlength: 6
          },
          cpassword: {
            required: true,
            equalTo: "#password"
          }
        },
        messages: {
          fullname: {
            required: "Enter your full name"
          },
          username: {
            required: "Enter a username"
          },
          email: {
            required: "Enter your email"
          },
          phone: {
            required: "Enter phone number"
          },
          gender: {
            required: "Select gender"
          },
          dob: {
            required: "Select date of birth"
          },
          photo: {
            required: "Select your photo"
          },
          password: {
            required: "Enter password"
          },
          cpassword: {
            equalTo: "Passwords do not match"
          }
        },
        errorPlacement: function(error, element) {
          error.insertAfter(element);
        },
        /*submitHandler: function(form) {
          alert("Registration Successful!");
          form.reset();
          return false;
        }*/
      });
    });
  </script>

</body>

</html>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
