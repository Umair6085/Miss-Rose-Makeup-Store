<?php
session_start();

if (isset($_GET['index'])) {
    $index = $_GET['index'];

    // Remove the item from the cart
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array
    }
}

header('Location: view_cart.php');
exit;
