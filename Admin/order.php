<?php
include("config.php");
include("layout.php");
?>

<style>
    /* Page title */
    .page-title {
        color: #1e40af;
        margin-bottom: 15px;
    }

    /* Table container */
    .table-container {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        overflow-x: auto;
    }

    /* Table */
    .order-table {
        width: 100%;
        min-width: 700px;
        border-collapse: collapse;
        text-align: center;
    }

    .order-table th,
    .order-table td {
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .order-table th {
        background: var(--primary-dark);
        color: #fff;
    }

    /* Status badges */
    .status {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: bold;
        color: #fff;
    }

    .pending {
        background: #f39c12;
    }

    .completed {
        background: #2ecc71;
    }

    .cancelled {
        background: #e74c3c;
    }

    /* Buttons */
    .btn-view {
        background: #3498db;
        padding: 6px 12px;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
    }

    .btn-delete {
        background: #e74c3c;
        padding: 6px 12px;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
    }

    input[type="text"] {
        margin-bottom: 15px;
        padding: 8px 12px;
        width: 100%;
        max-width: 300px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .page-title {
            text-align: center;
        }
    }
</style>

<div>
    <h2 class="page-title">Orders Management</h2>

    <div class="table-container">

        <input type="text" id="searchInput" placeholder="Search orders...">

        <table class="order-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                    <th>Shipping ID</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>


            <tbody id="OrderTable">
                <?php
                $qry = "SELECT * FROM orders ORDER BY o_id DESC";
                $res = mysqli_query($con, $qry);

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {

                        // Normalize status class
                        $statusClass = strtolower($row['order_status']);
                        ?>
                        <tr>
                            <td><?php echo $row['o_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo date("d M Y, h:i A", strtotime($row['order_date'])); ?></td>
                            <td>₹ <?php echo number_format($row['total_amount'], 1); ?></td>
                            <td><?php echo $row['shipping_id']; ?></td>
                            <td><?php echo $row['payment_method']; ?></td>
                            <td>
                                <span class="status <?php echo $statusClass; ?>">
                                    <?php echo $row['order_status']; ?>
                                </span>
                            </td>
                            <td>
                                <a href="view_order.php?id=<?php echo $row['o_id']; ?>" class="btn-view">
                                    View
                                </a>

                                <a href="delete_order.php?id=<?php echo $row['o_id']; ?>" class="btn-delete"
                                    onclick="return confirm('Are you sure you want to delete this order?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>No Orders Found</td></tr>";
                }
                ?>
            </tbody>

        </table>

    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll("#OrderTable tr");

        rows.forEach(function (row) {
            row.style.display = row.textContent.toLowerCase().includes(value)
                ? ""
                : "none";
        });
    });
</script>