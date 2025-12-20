<?php
include_once("db_connect.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

$ids = $_SESSION['checkout_cart_ids'] ?? [];
if (empty($ids)) {
    header("Location: cart_show.php");
    exit;
}

$ids = array_map('intval', $ids);
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$types = str_repeat('i', count($ids));

$sql = "SELECT * FROM add_to_cart WHERE username=? AND cart_id IN ($placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s".$types, $username, ...$ids);
$stmt->execute();
$cartItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$title_page = "Checkout";
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?= $title_page ?></title>
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
    max-width: 700px;
    margin: 40px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.formgroup {
    margin-bottom: 17px;
}
label {
    font-weight: 500;
    margin-bottom: 5px;
    display:block;
    color:#333;
}
input, textarea, select {
    width:100%;
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:15px;
    transition:0.3s;
}
input:focus, textarea:focus {
    border-color:#e58db5;
    box-shadow:0px 0px 6px #f1b8da;
    outline:none;
}
input.error, textarea.error {
    border:2px solid red;
}
label.error {
    color:red;
    font-size:12px;
    margin-top:3px;
}
.button-group {
    display:flex;
    justify-content:space-between;
    gap:10px;
    margin-top:20px;
}
button, .btn-cancel {
    padding:10px 16px;
    font-size:16px;
    border:none;
    border-radius:999px;
    cursor:pointer;
    font-weight:700;
    color:white;
    transition:0.3s;
}
button {
    background:linear-gradient(90deg, #ed86d0ff, #ff9eb0);
    box-shadow:0 6px 18px rgba(255,111,145,0.15);
}
button:hover {
    opacity:0.9;
    transform:translateY(-2px);
}
.btn-cancel {
    background:#e63946;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}
.cart-item {
    display:flex;
    align-items:center;
    gap:20px;
    padding:15px 0;
    border-bottom:1px solid #e0e0e0;
}
.cart-item img {
    width:90px;
    height:90px;
    border-radius:12px;
    object-fit:cover;
}
.cart-item-info h3 {
    margin:0 0 5px 0;
    font-weight:600;
    font-size:18px;
    color:#1a7f37;
}
.price {
    font-weight:600;
    color:#e63946;
    font-size:15px;
}
.total {
    text-align:right;
    font-size:24px;
    font-weight:700;
    margin-top:20px;
    color:#111;
}
@media(max-width:768px) {
    .cart-item { flex-direction:column; align-items:flex-start; }
    .cart-item img { width:100%; max-width:120px; height:auto; }
}
</style>

</head>
<body>

<header>
<h1>Checkout</h1>
</header>

<div class="form-container">
    <h2>Selected Items</h2>
    <?php $totalAmount=0; foreach ($cartItems as $item): ?>
        <div class="cart-item">
            <img src="images/women/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['pnm']) ?>">
            <div class="cart-item-info">
                <h3><?= htmlspecialchars($item['pnm']) ?></h3>
                <div class="price">
                    ₹<?= $item['price'] ?> x <?= $item['qty'] ?> = ₹<?= number_format($item['price']*$item['qty'],2) ?>
                </div>
            </div>
        </div>
        <?php $totalAmount += $item['price']*$item['qty']; endforeach; ?>
    <div class="total">Total: ₹<?= number_format($totalAmount,2) ?></div>

    <h2>Shipping Details</h2>
    <form id="checkoutForm" action="checkout_process.php" method="POST" novalidate>
        <div class="formgroup">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div class="formgroup">
            <label for="address">Address</label>
            <input type="text" name="address" id="address">
        </div>
        <div class="formgroup">
            <label for="city">City</label>
            <input type="text" name="city" id="city">
        </div>
        <div class="formgroup">
            <label for="state">State</label>
            <input type="text" name="state" id="state">
        </div>
        <div class="formgroup">
            <label for="country">Country</label>
            <input type="text" name="country" id="country">
        </div>
        <div class="formgroup">
            <label for="phno">Phone Number</label>
            <input type="text" name="phno" id="phno">
        </div>
        <div class="formgroup">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>

        <?php foreach ($cartItems as $item): ?>
            <input type="hidden" name="cart_ids[]" value="<?= $item['cart_id'] ?>">
        <?php endforeach; ?>

        <div class="button-group">
            <button type="submit">Place Order</button>
            <a href="cart_show.php" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<script>
$(document).ready(function () {
    $("#checkoutForm").validate({
        rules: {
            name: { required:true, minlength:2 },
            address: { required:true, minlength:5 },
            city: { required:true },
            state: { required:true },
            country: { required:true },
            phno: { required:true, digits:true, minlength:10, maxlength:15 },
            email: { required:true, email:true }
        },
        messages: {
            name: "Enter full name",
            address: "Enter address",
            city: "Enter city",
            state: "Enter state",
            country: "Enter country",
            phno: "Enter valid phone number",
            email: "Enter valid email"
        },
        errorPlacement: function(error, element){
            error.insertAfter(element);
        }
    });
});
</script>

</body>
</html>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>
 
