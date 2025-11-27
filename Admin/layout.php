<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wardrobe Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>

</head>

<body>
    <header>
        <div class="logo">👗 Wardrobe</div>
        <div class="dropdown admin-dropdown">
            <span>Admin ▼</span>
            <div class="dropdown-content">
                <a href="adminprofile.php">Profile</a>
                <a href="login.php">Logout</a>
            </div>
        </div>

    </header>

    <!-- <div class="wrapper"> -->
    <aside class="sidebar">
        <h3>ADMIN SIDE</h3>
        <ul>
            <li><a href="home.php">Dashboard</a></li>
            <li> <a href="category.php">Category</a></li>
            <li> <a href="sub_category.php">Sub-Category</a> </li>
            <li><a href="add_product.php">Add Product</a></li>
            <li> <a href="customer_details.php">Customer Details</a></li>
            <li> <a href="manage_feedback.php">Feedback</a></li>
            <li> <a href="manage_order.php">Shipping Details</a></li>
            <li> <a href="payment.php">Payment Details</a></li>
            <li> <a href="bill.php">Bill Details</a></li>
        </ul>
    </aside>

    <main class="content">
        <h2>Welcome to Wardrobe Admin Panel</h2>
        <!-- <p>Manage your fashion empire with elegance and ease.</p> -->
    </main>
    </div>

</body>

</html>
<?php
// include('footer.php');
?>