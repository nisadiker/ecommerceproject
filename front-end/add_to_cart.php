<?php
session_start();

// Initialize cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product details from POST request
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image_path = $_POST['product_image_path'];


// Add product to cart
$_SESSION['cart'][] = [
    'product_id' => $product_id,
    'product_name' => $product_name,
    'product_price' => $product_price,
    'product_image_path' => $product_image_path // Default quantity
];

// Redirect back to the products page
header("Location: index.php"); // Change this to the appropriate page
exit;
?>
