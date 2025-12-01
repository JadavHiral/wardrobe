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
        /* ✅ prevents overlap on mobile */
    }

    /* Add button */
    .btn-add {
        display: inline-block;
        margin-bottom: 15px;
        padding: 8px 16px;
        background: var(--accent-blue);
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
    }

    .btn-add:hover {
        background: var(--hover-blue);
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

    /* Image */
    .cat-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
    }

    /* Buttons */
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

    /* ✅ MOBILE OPTIMIZATION */
    @media (max-width: 768px) {
        .page-title {
            text-align: center;
        }

        .btn-add {
            display: block;
            width: fit-content;
            margin: 0 auto 15px;
        }
    }
</style>

<div>
    <h2 class="page-title">Product Table</h2>

    <div class="table-container">
        <a href="add_product.php" class="btn-add">+ Add Record</a>
        <input type="text" id="searchInput" placeholder="Search Product..." style="
        margin-bottom: 15px;
        padding: 8px 12px;
        width: 100%;
        max-width: 300px;
        border: 1px solid #ccc;
        border-radius: 6px;
    ">

        <table class="category-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sub Category</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Product Image</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody id="ProductTable">
                <?php
                $qry = "SELECT p.*, s.sub_cat_nm 
                        FROM product p
                        JOIN sub_category s 
                        ON p.sub_cat_id = s.sub_cat_id";
                $res = mysqli_query($con, $qry);

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row['pid']; ?></td>
                            <td><?php echo $row['sub_cat_nm']; ?></td>
                            <td><?php echo $row['pnm']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td>
                                <img src="img/<?php echo $row['img']; ?>" class="cat-img">
                            </td>
                            <td>
                                <a href="edit_product.php?id=<?php echo $row['pid']; ?>" class="btn-edit">
                                    Edit
                                </a>
                                <a href="delete_product.php?id=<?php echo $row['pid']; ?>" class="btn-delete"
                                    onclick="return confirm('Are you sure you want to delete this product?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No Products Found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll("#ProductTable tr");

        rows.forEach(function (row) {
            row.style.display = row.textContent.toLowerCase().includes(value)
                ? ""
                : "none";
        });
    });
</script>