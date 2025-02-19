<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'image' => $_POST['product_image'],
        'quantity' => 1
    ];

    // Initialize cart if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product already exists in the cart
    $productExists = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $product['id']) {
            $cartItem['quantity']++;
            $productExists = true;
            break;
        }
    }

    // If the product doesn't exist in the cart, add it
    if (!$productExists) {
        $_SESSION['cart'][] = $product;
    }

    // Redirect back to the referring page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
