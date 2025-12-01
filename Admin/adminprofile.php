<?php
include "config.php";
include "layout.php";

// Assume user is already logged in
$userId = $_SESSION['user_id'] ?? 1; // demo user id

// Dummy user data (REPLACE with DB fetch)
$user = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '9876543210',
    'address' => 'New York, USA',
    'image' => 'https://via.placeholder.com/120'
];

// Handle form submission
if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Image upload (optional)
    if (!empty($_FILES['profile_image']['name'])) {
        $imgName = time() . '_' . $_FILES['profile_image']['name'];
        move_uploaded_file($_FILES['profile_image']['tmp_name'], 'uploads/' . $imgName);
        $user['image'] = 'uploads/' . $imgName;
    }

    $success = "Profile updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        body {
            background: #f5f7fb;
        }

        .profile-card {
            max-width: 700px;
            margin: auto;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .07);
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #eaeaea;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="card profile-card p-4">
            <h4 class="mb-4">Edit Profile</h4>

            <?php if (!empty($success)) { ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php } ?>

            <form method="post" enctype="multipart/form-data">
                <div class="text-center mb-4">
                    <img src="<?= $user['image'] ?>" class="profile-img mb-2">
                    <input type="file" name="profile_image" class="form-control mt-2">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="<?= $user['address'] ?>">
                    </div>
                </div>

                <button name="update_profile" class="btn btn-primary px-4">Save Changes</button>
            </form>
        </div>
    </div>

</body>

</html>