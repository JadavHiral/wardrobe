<?php
include("config.php");
include("layout.php");

$res = mysqli_query($con, "SELECT * FROM shipping");
?>

<h2>Shipping Details</h2>

<a href="add_shipping.php" style="
    padding:8px 15px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:5px;">
    + Add Shipping
</a>

<br><br>

<table border="1" width="100%" cellpadding="10" cellspacing="0">
    <tr style="background:#1f2937;color:white;">
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Country</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['address']); ?></td>
            <td><?= htmlspecialchars($row['city']); ?></td>
            <td><?= htmlspecialchars($row['state']); ?></td>
            <td><?= htmlspecialchars($row['country']); ?></td>
            <td><?= $row['phno']; ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td>
                <a href="delete_shipping.php?id=<?= $row['id']; ?>" onclick="return confirm('Delete this shipment?')"
                    style="color:red;">
                    Delete
                </a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php include("footer.php"); ?>