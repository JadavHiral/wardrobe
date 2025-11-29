<?php
include("config.php");
include("layout.php");

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $phno = $_POST['phno'];
    $email = $_POST['email'];

    mysqli_query($con, "
        INSERT INTO shipping (name, address, city, state, country, phno, email)
        VALUES ('$name','$address','$city','$state','$country','$phno','$email')
    ");

    header("Location: shipping.php");
    exit;
}
?>
<style>
    /* Main box container */
    .shipping-container {
        max-width: 450px;
        background: #ffffff;
        padding: 25px 30px;
        border-radius: 10px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        margin: 40px 0 0 40px;
    }

    /* Title */
    .shipping-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #1e3a5f;
        font-weight: 600;
    }

    /* Form spacing */
    .form-group {
        margin-bottom: 15px;
    }

    /* Input fields */
    .shipping-container input {
        width: 100%;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    /* Input focus effect */
    .shipping-container input:focus {
        border-color: #1e88e5;
    }

    /* Save button */
    .btn-save {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 6px;
        background: #1e88e5;
        color: #ffffff;
        font-size: 15px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    /* Button hover */
    .btn-save:hover {
        background: #1669bb;
    }
</style>
<div class="shipping-container">
    <h2>Add Shipping Details</h2>

    <form method="post" action="shipping.php">
        <div class="form-group">
            <input type="text" name="name" placeholder="Name" required>
        </div>

        <div class="form-group">
            <input type="text" name="address" placeholder="Address" required>
        </div>

        <div class="form-group">
            <input type="text" name="city" placeholder="City">
        </div>

        <div class="form-group">
            <input type="text" name="state" placeholder="State">
        </div>

        <div class="form-group">
            <input type="text" name="country" placeholder="Country">
        </div>

        <div class="form-group">
            <input type="text" name="phone" placeholder="Phone No">
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Email">
        </div>

        <button type="submit" class="btn-save">Save</button>
    </form>
</div>