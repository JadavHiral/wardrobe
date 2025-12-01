<?php

include_once("db_connect.php");

$title_page = "About Us";
ob_start();
?>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
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

    /*.map-container {
      margin-top: 16px;
      border-radius: 10px;
      overflow: hidden;
    }

    iframe {
      border: 0;
      width: 100%;
      height: 200px;
    }*/

    /* ---------- RESPONSIVE ---------- */
    @media (max-width: 900px) {
      .contact-container {
        flex-direction: column;
        align-items: center;
      }

      .contact-form, .contact-info {
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
      <form>
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <input type="text" name="subject" placeholder="Subject" />
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
      </form>
    </div>

    <!-- CONTACT INFO -->
    <div class="contact-info">
      <h2>Get in Touch</h2>
      <p><strong>Email:</strong> <a href="mailto:support@stylehub.com">support@stylehub.com</a></p>
      <p><strong>Phone:</strong> <a href="tel:+1234567890">+1 (234) 567-890</a></p>
      <p><strong>Address:</strong> 123 Fashion Street, Rajkot, India</p>

    <!--  <div class="map-container">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.995692946469!2d-74.00601538459467!3d40.7127759793304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a316158c52b%3A0xdeb71a0c3b13dd99!2sNew%20York%20City!5e0!3m2!1sen!2sus!4v1634370839736!5m2!1sen!2sus"
          allowfullscreen=""
          loading="lazy"></iframe>
      </div>-->
    </div>
  </div>
<?php
$content1 = ob_get_clean();
include_once ("layout.php");
?>
