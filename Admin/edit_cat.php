<?php
include("config.php");
include("layout.php");

$id = $_GET['id'];

$qry = "SELECT * FROM category WHERE cat_id='$id'";
$res = mysqli_query($con, $qry);
$data = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {

    $cat_nm = $_POST['cat_nm'];
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

    $update = "UPDATE category 
               SET cat_nm='$cat_nm', img='$new_img' 
               WHERE cat_id='$id'";
    mysqli_query($con, $update);

    header("Location: category.php");
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
    .form-box input[type="file"] {
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
        <h2 class="page-title">Edit Category</h2>

        <label>Category Name</label>
        <input type="text" name="cat_nm" value="<?php echo $data['cat_nm']; ?>" required>
        <br><br>

        <label>Current Image</label>
        <img src="img/<?php echo $data['img']; ?>" class="preview-img">
        <br><br>

        <label>Change Image (optional)</label>
        <input type="file" name="img">
        <br><br>

        <input type="hidden" name="old_img" value="<?php echo $data['img']; ?>">

        <button type="submit" name="update" class="btn-add">
            Update Category
        </button>
    </form>
</div>

<?php include("footer.php"); ?>