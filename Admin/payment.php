<?php
include 'config.php';
include "layout.php";
$q = "SELECT * FROM payment";
$result = mysqli_query($con, $q);
?>

<style>
    .payment-box {
        background: #1f2f45;
        border-radius: 8px;
        padding: 18px;
        border: 1px solid #2f4f75;
        color: #fff;
    }

    .payment-box h3 {
        margin-bottom: 15px;
        border-bottom: 1px solid #3c5f8f;
        padding-bottom: 10px;
        color: #ffffff;
    }

    .payment-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .payment-table th {
        background: #233a5c;
        color: #ffffff;
        padding: 12px;
        text-align: left;
    }

    .payment-table td {
        padding: 12px;
        border-bottom: 1px solid #34557d;
        color: #ffffff;
    }

    .payment-table tr:hover {
        background: #263f63;
    }

    .action-btn {
        background: #e74c3c;
        color: #fff;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
    }

    .action-btn:hover {
        background: #c0392b;
    }

    .bulk-delete {
        margin-top: 12px;
        background: #e74c3c;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .bulk-delete:hover {
        background: #c0392b;
    }
</style>
<script>
    function toggle(source) {
        let checkboxes = document.getElementsByName('delete_id[]');
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>

<div class="payment-box">
    <h3>💳 Payment Details</h3>

    <form method="post" action="delete_payment.php">
        <table class="payment-table">
            <tr>
                <th><input type="checkbox" onclick="toggle(this)"></th>
                <th>ID</th>
                <th>Card No</th>
                <th>Card Type</th>
                <th>Expiry Date</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>
                        <input type="checkbox" name="delete_id[]" value="<?php echo $row['id']; ?>">
                    </td>
                    <td><?php echo $row['id']; ?></td>
                    <td>**** **** **** <?php echo substr($row['card_no'], -4); ?></td>
                    <td><?php echo $row['card_type']; ?></td>
                    <td><?php echo date("m/Y", strtotime($row['exp_date'])); ?></td>
                    <td>
                        <a href="delete_payment.php?id=<?php echo $row['id']; ?>" class="action-btn"
                            onclick="return confirm('Are you sure you want to delete this payment?');">
                            🗑 Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <button type="submit" class="bulk-delete" onclick="return confirm('Delete selected payments?')">Delete</button>
    </form>
</div>