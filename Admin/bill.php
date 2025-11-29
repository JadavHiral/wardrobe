<?php
include("config.php");
include("layout.php");
// DELETE BILL
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM bill_master WHERE bill_id='$id'");
    header("Location: bill.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bill Master</title>

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .bill-container {
            background: #1f334f;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .3);
            color: white;
        }

        .bill-title {
            font-size: 22px;
            margin-bottom: 20px;
            border-bottom: 1px solid #3b557a;
            padding-bottom: 10px;
        }

        .bill-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bill-table thead {
            background: #16263f;
        }

        .bill-table th {
            padding: 12px;
            text-align: left;
            color: #fff;
            font-weight: 600;
        }

        .bill-table td {
            padding: 12px;
            border-bottom: 1px solid #3b557a;
            color: #eaeaea;
        }

        .bill-table tr:hover {
            background: #243d63;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }

        .delete-btn:hover {
            background: #c0392b;
        }
    </style>
</head>

<body>

    <div class="bill-container">
        <div class="bill-title">🧾 Bill Master Table</div>

        <table class="bill-table">
            <thead>
                <tr>
                    <th>Bill No</th>
                    <th>Username</th>
                    <th>Bill Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $res = mysqli_query($con, "SELECT * FROM bill_master ORDER BY bill_id DESC");
                while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <tr>
                        <td><?= $row['bill_id']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= date("d/m/Y", strtotime($row['bill_date'])); ?></td>
                        <td>₹ <?= $row['total']; ?></td>
                        <td>
                            <a href="bill.php?delete=<?= $row['bill_id']; ?>" class="delete-btn"
                                onclick="return confirm('Are you sure to delete this bill?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>