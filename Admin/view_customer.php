<?php
include "config.php";
include "layout.php";

$id = $_GET['id'];
$sql = "SELECT * FROM register WHERE id='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result); ?>

<style>
    .view-box {
        background: #1f2f45;
        border-radius: 6px;
        border: 1px solid #2f4f75;
        padding: 20px;
        color: white;
    }

    .view-box h3 {
        margin-bottom: 15px;
        color: #ffffff;
        border-bottom: 1px solid #4169a8;
        padding-bottom: 10px;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-table td {
        padding: 12px;
        border-bottom: 1px solid #34557d;
    }

    .detail-table td:first-child {
        width: 30%;
        font-weight: bold;
        color: #c7d9ff;
        background: #233a5c;
    }

    .detail-table td:last-child {
        background: #1f2f45;
        color: white;
    }

    .back-btn {
        margin-top: 20px;
        background: #00c292;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .back-btn:hover {
        background: #00a67a;
    }
</style>


<div class="view-box">
    <h3>👤 Customer Details</h3>

    <table class="detail-table">
        <tr>
            <td>Name</td>
            <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><?php echo $row['email']; ?></td>
        </tr>

        <tr>
            <td>User Name</td>
            <td><?php echo $row['username']; ?></td>
        </tr>

        <tr>
            <td>Mobile</td>
            <td><?php echo $row['mobile']; ?></td>
        </tr>

        <tr>
            <td>Date of Birth</td>
            <td><?php echo date("d/m/Y", strtotime($row['dob'])); ?></td>
        </tr>

        <tr>
            <td>Address</td>
            <td><?php echo $row['address']; ?></td>
        </tr>
    </table>

    <a href="customer.php" class="back-btn">⬅ Back</a>
</div>