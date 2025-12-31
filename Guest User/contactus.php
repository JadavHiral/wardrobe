<!--contactus.php-->
<?php
include_once("db_connect.php");

$title_page = "Contact Us";
ob_start();

// Handle form submission
$popup = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $subject = mysqli_real_escape_string($conn, $_POST['subject']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $sql = "INSERT INTO contactus (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";

  if (mysqli_query($conn, $sql)) {
    header("Location: contactus.php?status=success");
    exit;
  } else {
    header("Location: contactus.php?status=error");
    exit;
  }
}

?>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    background: linear-gradient(90deg, #f7ded4 50%, #e7b0c3 100%);
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

  .contact-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 40px;
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
    flex-wrap: wrap;
  }

  /* ---------- CONTACT FORM ---------- */
  .contact-form {
    flex: 1 1 480px;
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.06);
  }

  .contact-form h2 {
    margin-bottom: 16px;
    color: #111827;
    font-size: 22px;
  }

  .contact-form form {
    display: flex;
    flex-direction: column;
    gap: 14px;
  }

  .contact-form input,
  .contact-form textarea {
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 15px;
    outline: none;
    transition: border-color 0.2s ease;
  }

  .contact-form input:focus,
  .contact-form textarea:focus {
    border-color: #ff7da9;
  }

  .contact-form textarea {
    resize: none;
    min-height: 120px;
  }

  .contact-form button {
    padding: 12px 20px;
    background: linear-gradient(90deg, #ed86d0ff, #ff9eb0);
    color: white;
    font-weight: 700;
    border: none;
    border-radius: 999px;
    cursor: pointer;
    box-shadow: 0 6px 18px rgba(255, 111, 145, 0.15);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .contact-form button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(255, 111, 145, 0.25);
  }

  /* ---------- CONTACT INFO ---------- */
  .contact-info {
    flex: 1 1 350px;
    background: #111827;
    color: #fff;
    border-radius: 12px;
    padding: 25px 30px;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
  }

  .contact-info h2 {
    color: #ffd6e0;
    margin-bottom: 14px;
  }

  .contact-info p {
    margin-bottom: 10px;
    color: #e5e7eb;
  }

  .contact-info a {
    color: #ffd6e0;
    text-decoration: none;
    font-weight: 600;
  }

  .contact-info a:hover {
    text-decoration: underline;
  }

  /* ---------- RESPONSIVE ---------- */
  @media (max-width: 900px) {
    .contact-container {
      flex-direction: column;
      align-items: center;
    }

    .contact-form,
    .contact-info {
      width: 100%;
      max-width: 500px;
    }

    header h1 {
      font-size: 24px;
    }
  }

  @media (max-width: 500px) {

    .contact-form input,
    .contact-form textarea {
      font-size: 14px;
    }

    .contact-form button {
      font-size: 14px;
      padding: 10px 16px;
    }
  }
</style>
</head>

<body>
  <header>
    <h1>Contact Us</h1>
    <p style="color:#d1d5db;">We’d love to hear from you! Let’s connect.</p>
  </header>

  <div class="contact-container">
    <!-- CONTACT FORM -->
    <div class="contact-form">
      <h2>Send Us a Message</h2>

      <?php if (isset($_GET['status']) && $_GET['status'] == "success"): ?>
        <script>
          alert("Your message has been sent successfully!");
        </script>
      <?php elseif (isset($_GET['status']) && $_GET['status'] == "error"): ?>
        <script>
          alert("Failed to send message. Please try again.");
        </script>
      <?php endif; ?>


      <form method="POST">

        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <input type="text" name="subject" placeholder="Subject" />
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
        <button class="btn" onclick="window.location.href='myaccount.php'"
          style="margin-top:10px; background:#ccc; color:#000;">
          ← Back
        </button>
      </form>
    </div>

    <!-- CONTACT INFO -->
    <div class="contact-info">
      <h2>Get in Touch</h2>
      <p><strong>Email:</strong> <a href="mailto:support@stylehub.com">support@stylehub.com</a></p>
      <p><strong>Phone:</strong> <a href="tel:+1234567890">+1 (234) 567-890</a></p>
      <p><strong>Address:</strong> 123 Fashion Street, Rajkot, India</p>
    </div>
  </div>
  <?php
  $content1 = ob_get_clean();
  include_once("layout.php");
  ?>
