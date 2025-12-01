<?php
include 'config.php';
include "layout.php";
$q = "SELECT * FROM payment";
$result = mysqli_query($con, $q);
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

    /* Search input */
    #searchInput {
        margin-bottom: 15px;
        padding: 8px 12px;
        width: 100%;
        max-width: 300px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    /* Table */
    .category-table {
        width: 100%;
        min-width: 600px;
        border-collapse: collapse;
        text-align: center;
    }

    .category-table th,
    .category-table td {
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .category-table th {
        background: var(--primary-dark);
        color: #fff;
    }

    /* Buttons */
    .btn-delete {
        background: #e74c3c;
        padding: 6px 12px;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
    }

    .btn-delete:hover {
        background: #c0392b;
    }

    .bulk-delete {
        margin-top: 15px;
        background: #e74c3c;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .bulk-delete:hover {
        background: #c0392b;
    }

    /* ✅ Mobile optimization */
    @media (max-width: 768px) {
        .page-title {
            text-align: center;
        }
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

<div>
    <h2 class="page-title">Payment Details</h2>
    <div class="table-container">

        <input type="text" id="searchInput" placeholder="Search payments...">

        <form method="post" action="delete_payment.php">
            <table class="category-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" onclick="toggle(this)"></th>
                        <th>ID</th>
                        <th>Card No</th>
                        <th>Card Type</th>
                        <th>Expiry Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="paymentBody">
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
                                <a href="delete_payment.php?id=<?php echo $row['id']; ?>" class="btn-delete"
                                    onclick="return confirmDelete();">
                                    Delete
                                </a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <button type="submit" class="bulk-delete" onclick="return confirm('Delete selected payments?')">Delete
            </button>
        </form>
    </div>
</div>
<!-- foe delete confirmation pop up box-->
<script>
    function confirmDelete() {
        return confirm("Are you sure?");
    }
</script>
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll("#paymentBody tr");

        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(value) ? "" : "none";
        });
    });
</script>
