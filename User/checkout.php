<?php
include_once("db_connect.php");
session_start();

$title_page = "Checkout Page";
ob_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Fetch user data
$userData = [];
$stmt = $conn->prepare("SELECT * FROM register WHERE username=? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Fetch cart items
$stmtCart = $conn->prepare("SELECT * FROM add_to_cart WHERE username=?");
$stmtCart->bind_param("s", $username);
$stmtCart->execute();
$resultCart = $stmtCart->get_result();
$cartItems = $resultCart->fetch_all(MYSQLI_ASSOC);

// Calculate total amount
$totalAmount = 0;
foreach ($cartItems as $item) {
    $totalAmount += $item['price'] * $item['qty'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title_page ?></title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<!-- jQuery and jQuery Validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

<style>
/* Body and header */
body {
    font-family: 'Poppins', sans-serif;
    background: #fffaf8;
    margin: 0;
    color: #222;
    line-height: 1.5;
}

header {
    background: linear-gradient(40deg, #111827, #1f2937);
    color: #ffd6e0;
    padding: 15px 0;
    text-align: center;
}
header h1 {
    font-size: 28px;
    margin: 0;
}

/* Form Container */
.form-container {
    max-width: 750px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Cart Summary */
.cart-summary {
    margin-bottom: 25px;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    background: #fdf7f3;
}
.cart-summary h3 {
    margin-top: 0;
}
.cart-item {
    display: flex;
    gap: 15px;
    align-items: center;
    margin-bottom: 10px;
}
.cart-item img {
    width: 80px;
    height: 80px;
    object-fit: contain;
    border-radius: 8px;
    border: 1px solid #ddd;
}
.cart-item-details {
    flex: 1;
}
.cart-item-name {
    font-weight: 500;
    font-size: 16px;
}
.cart-item-price {
    font-weight: 600;
    color: #e63946;
    font-size: 15px;
}
.total-price {
    text-align: right;
    font-size: 18px;
    font-weight: 700;
    margin-top: 10px;
}

/* Form Groups */
.formgroup {
    margin-bottom: 20px;
}
label {
    display: block;
    font-weight: 500;
    margin-bottom: 6px;
    color: #333;
}
input, textarea {
    width: 100%;
    padding: 10px;
    font-size: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    transition: 0.3s;
}
input:focus, textarea:focus {
    border-color: #e58db5;
    box-shadow: 0 0 6px #f1b8da;
    outline: none;
}
input.error, textarea.error {
    border: 2px solid red;
}
label.error {
    color: red;
    font-size: 12px;
    margin-top: 3px;
}

/* Buttons */
.buttons {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}
button, .buttons a {
    flex: 1;
    text-align: center;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: 700;
    border-radius: 999px;
    cursor: pointer;
    transition: 0.3s;
}
button {
    border: none;
    background: linear-gradient(90deg,#ed86d0,#ff9eb0);
    color: #fff;
    box-shadow: 0 6px 18px rgba(255,111,145,0.15);
}
button:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}
.buttons a {
    background: #888;
    color: #fff;
    text-decoration: none;
}
.buttons a:hover {
    opacity: 0.9;
}
</style>
</head>
<body>

<header><h1>Checkout</h1></header>

<div class="form-container">

<?php if (!empty($cartItems)): ?>

    <!-- Cart Summary -->
    <div class="cart-summary">
        <h3>Order Summary</h3>
        <?php foreach ($cartItems as $item): ?>
            <div class="cart-item">
                <img src="images/women/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['pnm']) ?>">
                <div class="cart-item-details">
                    <div class="cart-item-name"><?= htmlspecialchars($item['pnm']) ?> x <?= $item['qty'] ?></div>
                    <div class="cart-item-price">₹<?= number_format($item['price'] * $item['qty'],2) ?></div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="total-price">Total Amount: ₹<?= number_format($totalAmount,2) ?></div>
    </div>

    <!-- Checkout Form -->
    <form id="checkoutForm" method="POST" action="checkout_process.php" novalidate>

        <div class="formgroup">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars(($userData['fname'] ?? '') . ' ' . ($userData['lname'] ?? '')) ?>">
        </div>

        <div class="formgroup">
            <label for="address">Address</label>
            <textarea name="address" id="address" rows="3"><?= htmlspecialchars($userData['address'] ?? '') ?></textarea>
        </div>

        <div class="formgroup">
            <label for="city">City</label>
            <input type="text" name="city" id="city" value="<?= htmlspecialchars($userData['city'] ?? '') ?>">
        </div>

        <div class="formgroup">
            <label for="state">State</label>
            <input type="text" name="state" id="state" value="<?= htmlspecialchars($userData['state'] ?? '') ?>">
        </div>

        <div class="formgroup">
            <label for="country">Country</label>
            <input type="text" name="country" id="country" value="<?= htmlspecialchars($userData['country'] ?? '') ?>">
        </div>

        <div class="formgroup">
            <label for="phno">Phone Number</label>
            <input type="tel" name="phno" id="phno" value="<?= htmlspecialchars($userData['mobile'] ?? '') ?>">
        </div>

        <div class="formgroup">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($userData['email'] ?? '') ?>">
        </div>

        <!-- Buttons -->
        <div class="buttons">
            <button type="submit">Place Order</button>
            <a href="cart_show.php">Cancel Order</a>
        </div>

    </form>

<?php else: ?>
    <p>Your cart is empty. <a href="category.php">Go to products</a></p>
<?php endif; ?>

</div>

<script>
$(document).ready(function(){
    $("#checkoutForm").validate({
        rules: {
            name: { required:true, minlength:3 },
            address: { required:true, minlength:5 },
            city: { required:true, minlength:2 },
            state: { required:true, minlength:2 },
            country: { required:true, minlength:2 },
            phno: { required:true, digits:true, minlength:10, maxlength:10 },
            email: { required:true, email:true }
        },
        messages: {
            name: "Please enter your full name",
            address: "Please enter your address",
            city: "Please enter your city",
            state: "Please enter your state",
            country: "Please enter your country",
            phno: "Please enter a valid 10-digit phone number",
            email: "Please enter a valid email"
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
