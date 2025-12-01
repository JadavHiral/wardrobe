<!--myaccount--->
<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['user_name'])) {

    header("Location: login.php");
    exit;
}

$username = $_SESSION['user_name'];

$userQuery = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' LIMIT 1");
$user = mysqli_fetch_assoc($userQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Account</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
/* --------------------- GLOBAL STYLE --------------------- */
body {
    margin: 0;
   font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
   background: linear-gradient(90deg, #f7ded4ff 50%, #e7b0c3ff 100%);
}

/* --------------------- TOP HEADER --------------------- */
.header {
    background: linear-gradient(40deg, #111827, #1f2937);
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    
}

.logo {
    font-size: 25px;
    font-weight: 800;
    color: #fa88a2ff;  
}

.header-right {
    display: flex;
    align-items: center;
    gap: 25px;
}

.header-right i {
    font-size: 22px;
    cursor: pointer;
}

.profile-pic-top {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ff9ecb;
    cursor: pointer;
}

/* --------------------- MAIN WRAPPER --------------------- */
.wrapper {
    display: flex;
    margin-top: 20px;
    padding: 50px 50px;
    gap: 25px;

    flex-wrap: wrap;
}

/* --------------------- SIDEBAR --------------------- */
.sidebar {
    width: 300px;
    background: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    height: fit-content;
}

.sidebar h2 {
    font-size: 20px;
    color: #d12c6a;
    text-align: center;
    margin-bottom: 25px;
}

.sidebar a {
    display: block;
    padding: 12px 15px;
    background: #faf4f6;
    margin-bottom: 12px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    color: #333;
    border: 1px solid #f0c9d9;
    transition: 0.3s;
}

.sidebar a:hover {
    background: #ffe3ef;
    border-color: #ffb3d4;
    transform: translateX(5px);
}

/* --------------------- CONTENT --------------------- */
.content-box {
    flex: 1;
    background: white;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-bottom: 25px;
    padding-left: 70px;
}

.profile-photo-big {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid #ffc8de;
    object-fit: cover;
}

.profile-info h3 {
margin: 5px;
    font-size: 24px;
    padding: 15px;
    padding-top: 0px;
    text-align: center;
}

.profile-info p {
    margin: 3px 0;
    color: gray;
}

/* --------------------- DASHBOARD CARDS --------------------- */
.grid {
    display: grid;

    margin-top: 25px;
    grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
    gap: 25px;
    
}

.card {
    background: #faf4f6;
    border: 1px solid #f1c7d9;
    padding: 40px;
    text-align: center; 
    border-radius: 14px;
    cursor: pointer;
    transition: 0.3s;
    font-size: 20px;
    font-weight: 600;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);
}

.card:hover {
    transform: translateY(-5px);
    background: #ffe3ef;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}
    .card p {
      font-size: 14px;
      color: #555;
    }
button{
    padding:9px 16px;
            border-radius:8px;
            border:none;
            background: linear-gradient(90deg, #ed86d0ff, #ff9eb0);
            cursor:pointer;
             box-shadow: 0 6px 18px rgba(255, 111, 145, 0.15);
              border-radius: 999px;
              font-weight: 800;
              color: white;
}
/* --------------------- RESPONSIVE --------------------- */
@media (max-width: 768px) {
    .wrapper {
        flex-direction: column;
    }
    
    .sidebar {
        width: 100%;
    }
    .profile-header {
 
    padding-left: 140px;
}



}

   

</style>
</head>
<body>

<!-- ================= TOP HEADER ================= -->
<div class="header">
   <!-- <div class="logo">StyleHub</div>-->
<div class="logo">My Account</div>
    <div class="header-right">
        <i class="fa-solid fa-bag-shopping" onclick="location.href='cart.php'"></i>
        <i class="fa-regular fa-heart" onclick="location.href='wishlist.php'"></i>
        
        <button onclick="location.href='logout.php'">
            Logout
        </button> 
        
        <!--<img src="uploads/</?php echo $user['photo']; ?>" */
             class="profile-pic-top"
             onclick="location.href='myaccount.php'">-->
    </div>
</div>

<!-- ================= MAIN LAYOUT ================= -->
<div class="wrapper">

    <!-- ========== SIDEBAR ========== -->
    <div class="sidebar">
        
   <!-- Profile Header -->
        <div class="profile-header">
            <img src="uploads/<?php echo $user['photo']; ?>" class="profile-photo-big">
    </div>
            <div class="profile-info">
                <h3><?php echo $user['fullname']; ?></h3>
              <!--  <p>@</?php echo $user['username']; ?></p>
                <p></?php echo $user['email']; ?></p>
                <p></?php echo $user['phone']; ?></p>-->
            </div>
       
        <a href="edit_profile.php">✏ Edit Profile</a>
        <a href="feedback.php">💬 Give Feedback</a>
        <a href="change_password.php">🔐 Change Password</a>
    </div>

    <!-- ========== MAIN CONTENT ========== -->
    <div class="content-box">
        <!-- Grid Section -->
        <div class="grid">
            <div class="card" onclick="location.href='orders.php'">🛒 My Orders 
                <p>
                    View your complete order history
                </p>
            </div>
            <div class="card" onclick="location.href='wishlist.php'">❤️ Wishlist
                <p>
Items you saved for later
                </p>
            </div>
            <div class="card" onclick="location.href='cart.php'">🛍️ Cart
                <p>
Products waiting for checkout
                </p>
            </div>
            <div class="card" onclick="location.href='track_order.php'">📦 Track Order
                <p>Track your active orders</p>
            </div>
            <div class="card" onclick="location.href='address.php'">🏠 Saved Addresses
                <p>
                    Manage your delivery addresses
                </p>
            </div>
        </div>

    </div>
</div>

</body>
</html>
