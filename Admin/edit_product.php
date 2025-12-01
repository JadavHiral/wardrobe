<?php
include("config.php");
include("layout.php");

$id = $_GET['id'];

$qry = "SELECT * FROM product WHERE pid='$id'";
$res = mysqli_query($con, $qry);
$data = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {

    $sub_cat_id = $_POST['sub_cat_id'];
    $pnm = $_POST['pnm'];
    $price = $_POST['price'];
    $old_img = $_POST['old_img'];

    if (!empty($_FILES['img']['name'])) {
        $img_name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];

        $ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $new_img = time() . "." . $ext;

        move_uploaded_file($tmp_name, "img/" . $new_img);

        if ($old_img != "" && file_exists("img/" . $old_img)) {
            unlink("img/" . $old_img);
        }
    } else {
        $new_img = $old_img;
    }

    $update = "UPDATE product 
               SET sub_cat_id='$sub_cat_id',
                   pnm='$pnm',
                   price='$price',
                   img='$new_img' 
               WHERE pid='$id'";
    mysqli_query($con, $update);

    header("Location: product.php");
}
?>

<style>
    .main-content {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 40px;
        background-color: #ffffff;
        min-height: 100vh;
    }

    .form-box {
        background: #ffffff;
        padding: 30px 35px;
        width: 400px;
        border-radius: 8px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .page-title {
        text-align: center;
        margin-bottom: 20px;
        color: #1e40af;
    }

    .form-box label {
        font-weight: 600;
        color: #444;
        margin-bottom: 6px;
        display: block;
    }

    .form-box input[type="text"],
    .form-box input[type="number"],
    .form-box input[type="file"],
    .form-box select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #0ea5e9;
    }

    .btn-add {
        width: 100%;
        background-color: #1e40af;
        color: #fff;
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-add:hover {
        background-color: #1e40af;
    }

    .preview-img {
        margin-top: 10px;
        width: 100px;
        height: auto;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
</style>

<div class="main-content">
    <form method="post" enctype="multipart/form-data" class="form-box">
        <h2 class="page-title">Edit Product</h2>

        <label>Sub Category</label>
        <select name="sub_cat_id" required>
            <?php
            $sub_qry = "SELECT * FROM sub_category";
            $sub_res = mysqli_query($con, $sub_qry);
            while ($sub = mysqli_fetch_assoc($sub_res)) {
                $selected = ($sub['sub_cat_id'] == $data['sub_cat_id']) ? "selected" : "";
                ?>
                <option value="<?php echo $sub['sub_cat_id']; ?>" <?php echo $selected; ?>>
                    <?php echo $sub['sub_cat_nm']; ?>
                </option>
            <?php } ?>
        </select>
        <br><br>

        <label>Product Name</label>
        <input type="text" name="pnm" value="<?php echo $data['pnm']; ?>" required>
        <br><br>

        <label>Price</label>
        <input type="number" name="price" value="<?php echo $data['price']; ?>" required>
        <br><br>

        <label>Current Image</label>
        <img src="img/<?php echo $data['img']; ?>" class="preview-img">
        <br><br>

        <label>Change Image (optional)</label>
        <input type="file" name="img">
        <br><br>

        <input type="hidden" name="old_img" value="<?php echo $data['img']; ?>">

        <button type="submit" name="update" class="btn-add">
            Update Product
        </button>
    </form>
</div>

<?php include("footer.php"); ?>