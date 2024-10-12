<?php
include("config.php");
include("logged_in_check.php");

// Veritabanı bağlantısını yap
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $size = $_POST['size'];
    $address = $_POST['address'];
    $cargo_no = $_POST['cargo_no'];
    $color = $_POST['color'];
    $status = $_POST['status'];

    $sql = "UPDATE order_table SET size='$size', address='$address', cargo_no='$cargo_no', color='$color', status='$status' WHERE order_id=$order_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: order_list.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
