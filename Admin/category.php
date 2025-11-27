<?php
include("config.php"); // DB connection
include("layout.php"); // Header and sidebar
?>
<style>
    .main-content {
        margin-left: 260px;
        padding: 20px;
    }

    .page-title {
        color: #d63384;
        margin-bottom: 15px;
    }

    .table-container {
        background: #f8c8dc;
        padding: 20px;
        border-radius: 8px;
    }

    .btn-add {
        display: inline-block;
        margin-bottom: 15px;
        padding: 8px 15px;
        background: #d63384;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .category-table {
        width: 100%;
        border-collapse: collapse;
        color: #0c0a0aff;
    }

    .category-table th,
    .category-table td {
        padding: 12px;
        border-bottom: 1px solid #fff;
        text-align: center;
    }

    .category-table th {
        background: #ffeef2;
    }

    .cat-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }

    .btn-edit {
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
</style>
<div class="main-content">
    <h2 class="page-title">Category Table</h2>

    <div class="table-container">
        <a href="add_cat.php" class="btn-add">+ Add Record</a>

        <table class="category-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $qry = "SELECT * FROM category";
                $res = mysqli_query($con, $qry);

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row['cat_id']; ?></td>
                            <td><?php echo $row['cat_nm']; ?></td>
                            <td>
                                <img src="uploads/<?php echo $row['img']; ?>" class="cat-img">
                            </td>
                            <td>
                                <a href="edit_cat.php?id=<?php echo $row['cat_id']; ?>" class="btn-edit">Edit</a>
                                <a href="delete_cat.php?id=<?php echo $row['cat_id']; ?>" class="btn-delete"
                                    onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>No Categories Found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("footer.php"); ?>