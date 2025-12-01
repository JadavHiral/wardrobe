

<!doctype html>
<html>

<head>
    <style>
         body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
          background: linear-gradient(90deg, #f7ded4 50%, #e7b0c3 100%);
            color: #222;
            line-height: 1.45;
        }

        .card {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06)
        }

        textarea {
            width: 100%;
            min-height: 140px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd
        }

        input,
        textarea {
            font-size: 14px
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
            padding: 10px;
            border-left: 4px solid #16a34a;
            margin-bottom: 8px
        }

        .error {
            background: #ffecec;
            padding: 10px;
            border-left: 4px solid #f43f5e;
            margin-bottom: 8px
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
    </style>
</head>

<body>
    <header><h1>Send Feedback</h1></header>
    <div class="card">
    
        <?php if ($success): ?><div class="success"><?= $success ?></div><?php endif; ?>
        <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

        <form method="POST">
             <label for="email">Email</label>
        <input type="text" name="email" id="email" require><br><br>
            <label>Subject</label>
            <input type="text" name="subject" required><br><br>

            <label style="margin-top:10px">Message</label>
            <textarea name="message" required></textarea><br><br>

            <div style="margin-top:12px"><button class="btn" type="submit">Send Feedback</button></div>
        </form>
    </div>
</body>

</html>
<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>