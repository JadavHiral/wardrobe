<?php
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wardrobe Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/sidebar.js"></script>
    <style>
        .logo {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, #ff6f91, #ffb6c1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 12px rgba(255, 111, 145, 0.18);
            font-weight: 700;
        }
    </style>
    <script>
        (function () {
            function initThemeToggle() {
                const toggleBtn = document.getElementById("themeToggle");
                if (!toggleBtn) {
                    // Retry after 50ms if button not found yet
                    setTimeout(initThemeToggle, 50);
                    return;
                }

                // Apply saved theme on load
                if (localStorage.getItem("theme") === "dark") {
                    document.body.classList.add("dark-theme");
                    toggleBtn.innerText = "☀️";
                }

                // Add click listener
                toggleBtn.addEventListener("click", function () {
                    const body = document.body;
                    body.classList.toggle("dark-theme");
                    if (body.classList.contains("dark-theme")) {
                        localStorage.setItem("theme", "dark");
                        toggleBtn.innerText = "☀️";
                    } else {
                        localStorage.setItem("theme", "light");
                        toggleBtn.innerText = "🌙";
                    }
                });
            }

            // Initialize toggle (it will wait until button exists)
            initThemeToggle();
        })();
    </script>

</head>

<body>

    <header>
        <div class="header-left">
            <!-- Hamburger -->
            <span class="menu-toggle" onclick="toggleSidebar()">☰</span>
            <div class="logo">SH</div> StyleHub
        </div>
        </div>

        <div class="header-right">
            <button id="themeToggle" class="theme-btn">🌙</button>

            <div class="dropdown">
                <span>Admin ▼</span>
                <div class="dropdown-content">
                    <a href="adminprofile.php">Profile</a>
                    <a href="login.php">Logout</a>
                </div>
            </div>
        </div>

    </header>

    <div class="wrapper">
        <aside class="sidebar" id="sidebar">
            <h3>ADMIN SIDE</h3>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="sub_category.php">Sub-Category</a></li>
                <li><a href="product.php">Product</a></li>
                <li><a href="order.php">Order Details</a></li>
                <li><a href="customer.php">Customer Details</a></li>
                <li><a href="manage_feedback.php">Feedback</a></li>
                <li><a href="shipping.php">Shipping Details</a></li>
                <li><a href="payment.php">Payment Details</a></li>
                <li><a href="bill.php">Bill Details</a></li>
            </ul>
        </aside>

        <!-- Logout Confirmation Modal -->
        <div id="logoutModal" class="modal">
            <div class="modal-content">
                <h3>Confirm Logout</h3>
                <p>Are you sure you want to log out?</p>
                <div class="modal-buttons">
                    <button id="confirmLogout" class="btn btn-yes">Yes</button>
                    <button id="cancelLogout" class="btn btn-no">Cancel</button>
                </div>
            </div>
        </div>
        <script>
            // Grab elements
            const logoutLink = document.querySelector('a[href="login.php"]');
            const modal = document.getElementById('logoutModal');
            const confirmBtn = document.getElementById('confirmLogout');
            const cancelBtn = document.getElementById('cancelLogout');

            if (logoutLink) {
                logoutLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    modal.style.display = 'flex';
                });
            }

            if (cancelBtn) {
                cancelBtn.addEventListener('click', function () {
                    modal.style.display = 'none';
                });
            }

            if (confirmBtn) {
                confirmBtn.addEventListener('click', function () {
                    window.location.href = 'login.php';
                });
            }

            window.addEventListener('click', function (e) {
                if (e.target == modal) {
                    modal.style.display = 'none';
                }
            });
        </script>

        <main class="main-content">
