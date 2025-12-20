<?php
include_once("db_connect.php");
session_start();

$username = $_SESSION['username'] ?? 'guest';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Remove selected items
    if (isset($_POST['remove_selected']) && !empty($_POST['cart_ids'])) {
        $cartIds = $_POST['cart_ids']; // array of cart IDs
        $placeholders = implode(',', array_fill(0, count($cartIds), '?'));
        $types = str_repeat('i', count($cartIds));
        $stmt = $conn->prepare("DELETE FROM add_to_cart WHERE cart_id IN ($placeholders) AND username=?");

        // Bind parameters dynamically
        $bind_names[] = $types . 's';
        foreach ($cartIds as $k => $id) {
            $bind_name = 'id' . $k;
            $$bind_name = $id;
            $bind_names[] = &$$bind_name;
        }
        $bind_names[] = &$username;
        call_user_func_array(array($stmt, 'bind_param'), $bind_names);

        $stmt->execute();
    }
}

header("Location: cart_show.php");
exit;
?>
