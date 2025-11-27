<?php
include("config.php");
include("layout.php");

if (isset($_POST['submit'])) {
    $cat_nm = $_POST['cat_nm'];

    $img_name = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];

    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $new_img = time() . "." . $ext;

    move_uploaded_file($tmp_name, "img/" . $new_img);

    $qry = "INSERT INTO category (cat_nm, img) VALUES ('$cat_nm', '$new_img')";
    mysqli_query($con, $qry);

    header("Location: category.php");
}
?>
<div class="main-content" style="box-sizing: border-box; padding: 20px;">
    <h2 class="page-title">Add Category</h2>

    <form method="post" enctype="multipart/form-data" class="form-box">
        <label>Category Name</label>
        <input type="text" name="cat_nm" required><br><br><br>

        <label>Category Image</label>
        <input type="file" name="img" required><br><br><br>
        <button type="submit" name="submit" class="btn-add">Add Category</button>
    </form>
</div>

<?php include("footer.php"); ?>