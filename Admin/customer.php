<?php
include "config.php";
include "layout.php";

// Search value
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
?>


<style>
    body {
        background: #ffffff;
        font-family: Arial, sans-serif;
        color: #444;
    }

    .box {
        background: #fff;
        padding: 20px;
        border-radius: 6px;
        border: 1px solid #3a3a3a;
    }

    /* Title */
    h3 {
        margin-bottom: 15px;
        color: #4da3ff;
        /* same blue tone */
    }

    /* Search box */
    .search-box {
        margin-bottom: 15px;
    }

    .search-box input {
        padding: 8px;
        width: 260px;
        border-radius: 4px;
        border: 1px solid #444;
        background: #223b5a;
        color: white;
        border: black;
    }

    .search-box button {
        padding: 8px 14px;
        background: #4da3ff;
        border: none;
        color: white;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-box button:hover {
        background: #2f7fd8;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Header like Category table */
    th {
        background: #223b5a;
        color: white;
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #3a3a3a;
    }

    td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #3a3a3a;
        font-size: 14px;
    }

    /* Row hover */
    tr:hover {
        background: #fff;
    }

    /* Buttons */
    .btn-view {
        background: #00c292;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 13px;
    }

    .btn-view:hover {
        background: #00a67a;
    }

    .btn-delete {
        background: #e74c3c;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        margin-left: 6px;
        font-size: 13px;
    }

    .btn-delete:hover {
        background: #c0392b;
    }
</style>

<body>

    <div class="box">
        <h3>👤 Customer Table</h3>

        <!-- SEARCH -->
        <form method="GET" class="search-box">
            <input type="text" name="search" placeholder="Search name, username or email"
                value="<?php echo $search; ?>">
            <button type="submit">Search</button>
        </form>

        <table>
            <tr>
                <th>Register ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>

            <?php
            $query = "
            SELECT * FROM register
            WHERE fname LIKE '%$search%'
            OR lname LIKE '%$search%'
            OR email LIKE '%$search%'
            OR username LIKE '%$search%'
            ORDER BY id DESC
        ";

            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="view_customer.php?id=<?php echo $row['id']; ?>" class="btn-view">View</a>

                            <a href="delete_customer.php?id=<?php echo $row['id']; ?>" class="btn-delete"
                                onclick="return confirm('Are you sure you want to delete this customer?');">
                                <!-- <i class="glyphicon glyphicon-trash icon-white"></i> -->
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7'>No customers found</td></tr>";
            }
            ?>
        </table>
    </div>

</body>