<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product details from POST request
foreach ($_SESSION['cart'] as $row) {
    
    $product_id = $row["product_id"];
    $customer_id = 1234;
    $order_address = $_POST["order_address"];
    $cargo_no = time();
    $order_status = "order received";
    $size = "M";
    $color = "Red";



        $stmt = $conn->prepare("INSERT INTO order_table (product_id, customer_id, order_address, cargo_no, color, size, order_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisisss", $product_id, $customer_id, $order_address, $cargo_no, $color, $size, $order_status);

        if ($stmt->execute() === TRUE) {
            
        } else {
            header("Location: index.php?error=" . urlencode($stmt->error));
            exit;
        }

        

}

$stmt->close();
        $conn->close();

        $_SESSION['cart'] = [];

// Redirect back to the products page
header("Location: index.php"); // Change this to the appropriate page
exit;
?>
