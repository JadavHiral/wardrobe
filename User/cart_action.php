<?php
include_once("db_connect.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_ids = $_POST['cart_ids'] ?? [];
    $action = $_POST['action'] ?? '';

    if (empty($cart_ids)) {
        header("Location: cart_show.php");
        exit;
    }

    // Sanitize IDs
    $ids = array_map('intval', $cart_ids);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $types = str_repeat('i', count($ids));

    if ($action === 'buy') {
        // Redirect to checkout with selected items
        // Store selected cart_ids in session to use in checkout.php
        $_SESSION['checkout_cart_ids'] = $ids;
        header("Location: checkout.php");
        exit;
    } elseif ($action === 'remove') {
        // Remove selected items from cart
        $sql = "DELETE FROM add_to_cart WHERE username=? AND cart_id IN ($placeholders)";
        $stmt = $conn->prepare($sql);

        $bind_names[] = "s" . $types;
        $bind_values[] = $username;
        foreach ($ids as $id)
            $bind_values[] = $id;

        $refs = [];
        foreach ($bind_values as $key => $value)
            $refs[$key] = &$bind_values[$key];

        call_user_func_array([$stmt, 'bind_param'], array_merge([$bind_names[0]], $refs));
        $stmt->execute();

        header("Location: cart_show.php");
        exit;
    } else {
        header("Location: cart_show.php");
        exit;
    }

} else {
    header("Location: cart_show.php");
    exit;
}
?>
