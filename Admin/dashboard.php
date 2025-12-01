<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit;
}
include('config.php');
include('layout.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fb;
        }

        .dashboard-container {
            padding: 25px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            padding: 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .stat-card h3 {
            font-size: 28px;
            margin: 0;
        }

        .stat-card span {
            font-size: 14px;
            opacity: 0.9;
        }

        .bg-sales {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .bg-orders {
            background: linear-gradient(135deg, #43cea2, #185a9d);
        }

        .bg-users {
            background: linear-gradient(135deg, #f7971e, #ffd200);
        }

        .bg-products {
            background: linear-gradient(135deg, #f953c6, #b91d73);
        }

        table thead {
            background: #eef2ff;
        }

        .table img {
            width: 45px;
            border-radius: 8px;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <?php
    // Dummy API values (replace with database queries)
    $totalSales = 12450;
    $totalOrders = 320;
    $totalUsers = 890;
    $totalProducts = 210;
    ?>

    <div class="dashboard-container">

        <!-- STAT CARDS -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card stat-card bg-sales">
                    <span>Total Sales</span>
                    <h3>$<?php echo $totalSales; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-orders">
                    <span>Total Orders</span>
                    <h3><?php echo $totalOrders; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-users">
                    <span>Customers</span>
                    <h3><?php echo $totalUsers; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-products">
                    <span>Products</span>
                    <h3><?php echo $totalProducts; ?></h3>
                </div>
            </div>
        </div>

        <!-- CHART + TOP PRODUCTS -->
        <div class="row g-4 mb-4">
            <div class="col-md-8">
                <div class="card p-4">
                    <h5 class="mb-3">Monthly Sales</h5>
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <h5 class="mb-3">Top Products</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">Men Jacket <span>$1,200</span></li>
                        <li class="list-group-item d-flex justify-content-between">Women Dress <span>$980</span></li>
                        <li class="list-group-item d-flex justify-content-between">Formal Wears <span>$860</span></li>
                        <li class="list-group-item d-flex justify-content-between">Traditional Wears <span>$740</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- RECENT ORDERS -->
        <div class="card p-4">
            <h5 class="mb-3">Recent Orders</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="img/fce66036f6c89716f3c4767a7e03b902.jpg"> Hoodie</td>
                            <td>John Doe</td>
                            <td>$65</td>
                            <td><span class="badge bg-success">Delivered</span></td>
                        </tr>
                        <tr>
                            <td><img src="img/dc3eb40f49b8823f27320ab75fecc969.jpg"> Dress</td>
                            <td>Anna Smith</td>
                            <td>$120</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td><img src="img/combo.jpg">Outfit(Combo)</td>
                            <td>Mark Lee</td>
                            <td>$90</td>
                            <td><span class="badge bg-info">Shipped</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        const ctx = document.getElementById('salesChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Sales ($)',
                    data: [1200, 1900, 3000, 2500, 4200, 3800, 5100],
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                plugins: { legend: { display: false } }
            }
        });
    </script>

</body>

</html>