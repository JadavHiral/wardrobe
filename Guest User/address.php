<?php $title_page = "Saved Addresses";
ob_start();
session_start();
include_once("db_connect.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$uid = (int)$_SESSION['user_id'];
$msg = $_SESSION['msg'] ?? "";
unset($_SESSION['msg']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_address'])) {
    $line1 = trim($_POST['line1'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $pincode = trim($_POST['pincode'] ?? '');
    if ($line1 && $city && $pincode) {
        $stmt = $conn->prepare("INSERT INTO addresses (user_id, line1, city, pincode) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $uid, $line1, $city, $pincode);
        $stmt->execute();
        $stmt->close();
        $_SESSION['msg'] = "Address saved.";
        header("Location: address.php");
        exit;
    } else {
        $msg = "Please fill all fields.";
    }
}
// Delete address 
if (isset($_GET['delete'])) {
    $aid = (int)$_GET['delete'];
    $d = $conn->prepare("DELETE FROM addresses WHERE id=? AND user_id=?");
    $d->bind_param("ii", $aid, $uid);
    $d->execute();
    $d->close();
    header("Location: address.php");
    exit;
}
// Fetch all addresses 
$r = $conn->prepare("SELECT id, line1, city, pincode FROM addresses WHERE user_id=? ORDER BY id DESC");
$r->bind_param("i", $uid);
$r->execute();
$addresses = $r->get_result();
?>
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

        .wrap {
            max-width: 900px;
            ;
            margin: 75px auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06)
        }

        .addr {
            border: 1px solid #f1d5df;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 12px;
            background: #fff6f8
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd
        }
.back-btn {
            margin-top: 10px;
            background: #ccc;
            color: #000;
            padding: 10px;
            border-radius: 999px;
            text-align: center;
            display: block; 
            width: 100%;
            text-decoration: none;
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

        a.del {
            color: #b91c1c;
            text-decoration: none;
            padding-left: 8px
        }

        header {
            background: linear-gradient(40deg, #111827, #1f2937);

            padding: 10px;
            text-align: center;
        }

        header h1 {
            font-size: 28px;
            color: #ffd6e0;
        }

        a.del {
            color: #b91c1c;
            text-decoration: none;
            font-weight: bold;
            font-style: italic;
        }
    </style>
</head>

<body>
    <header>
        <h1>Saved Addresses</h1>
    </header>
    <?php if ($msg): ?><div style="text-align: center; color:green ; font-weight: bold;"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

        <div class="wrap">
    
        <div style="display:flex;gap:20px;flex-wrap:wrap">
            <div style="flex:1;min-width:300px">
                <form method="POST">
                    <label>Address</label>
                    <input name="line1" required><br><br>
                    <label>City</label>
                    <input name="city" required><br><br>
                    <label>Pincode</label>
                    <input name="pincode" required><br><br>
                    <div style="margin-top:12px"><button class="btn" name="add_address" type="submit">Save Address</button></div>
               <button class="btn" onclick="window.location.href='myaccount.php'"
            style="margin-top:10px; background:#ccc; color:#000;">
            ← Back
        </button>
                </form>
            </div>

            <div style="flex:1;min-width:300px">
                <h3>Your saved addresses:</h3>
                <?php if ($addresses->num_rows == 0): ?>
                    <p>No saved addresses yet.</p>
                    <?php else: while ($a = $addresses->fetch_assoc()): ?>
                        <div> <?= htmlspecialchars($a['line1']) ?>,
                            <?= htmlspecialchars($a['city']) ?> -
                            <?= htmlspecialchars($a['pincode']) ?>
                            <a class="del" href="address.php?delete=<?= (int)$a['id'] ?>"
                                onclick="return confirm('Delete this address?')">Delete</a>
                                
                            <!-- <a href="checkout.php?address=<?= (int)$a['id'] ?>">Use this address</a>  -->
                        </div>
                <?php endwhile;
                endif; ?> 
            </div>
        </div>
    </div>
</body>

</html>
<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>