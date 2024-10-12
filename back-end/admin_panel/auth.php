
<?php
session_start();
include("config.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Error updating record: " . $conn->error;

if (isset($_POST["adminadd"])) {
    $admin_name = $_POST["admin_name"];
    $admin_surname = $_POST["admin_surname"];
    $admin_username = $_POST["admin_username"];
    $admin_pass = $_POST["admin_pass"];

    if (!empty($admin_name) && !empty($admin_surname) && !empty($admin_username) && !empty($admin_pass)) {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO admin_table (admin_name, admin_surname, admin_username, admin_pass, admin_status) VALUES (?, ?, ?, ?, 1)");
        $stmt->bind_param("ssss", $admin_name, $admin_surname, $admin_username, $admin_pass);

        if ($stmt->execute() === TRUE) {
            header("Location: add_admin.php?success=1");
            exit;
        } else {
            header("Location: add_admin.php?error=" . urlencode($stmt->error));
            exit;
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: add_admin.php?error=Please fill all fields");
        exit;
    }
}

if (isset($_POST["categoryadd"])) {
    $category_name = $_POST["category_name"];
    $category_order = $_POST["category_order"];

    if (!empty($category_name) && !empty($category_order)) {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO category_table (category_name, category_order) VALUES (?, ?)");
        $stmt->bind_param("si", $category_name, $category_order);

        if ($stmt->execute() === TRUE) {
            header("Location: add_category.php?success=1");
            exit;
        } else {
            header("Location: add_category.php?error=" . urlencode($stmt->error));
            exit;
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: add_category.php?error=Please fill all fields");
        exit;
    }
}



if (isset($_POST["customeradd"])) {
    $customer_name = $_POST["customer_name"];
    $customer_surname = $_POST["customer_surname"];
    $customer_username = $_POST["customer_username"];
    $customer_pass = $_POST["customer_pass"];

    if (!empty($customer_name) && !empty($customer_surname) && !empty($customer_username) && !empty($customer_pass)) {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO customer_table (customer_name, customer_surname, customer_username, customer_pass, customer_status) VALUES (?, ?, ?, ?, 1)");
        $stmt->bind_param("ssss", $customer_name, $customer_surname, $customer_username, $customer_pass);

        if ($stmt->execute() === TRUE) {
            header("Location: add_customer.php?success=1");
            exit;
        } else {
            header("Location: add_customer.php?error=" . urlencode($stmt->error));
            exit;
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: add_customer.php?error=Please fill all fields");
        exit;
    }
}





if (isset($_POST["productadd"])) {
    $product_name = $_POST["product_name"];
    $category_id = $_POST["category_id"];
    $product_price = $_POST["product_price"];
    $product_stock = $_POST["product_stock"];
    $product_details = $_POST["product_details"];
    
    // Image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
        header("Location: add_product.php?error=File is not an image.");
        exit;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
        header("Location: add_product.php?error=Sorry, file already exists.");
        exit;
    }

    // Check file size (5MB maximum)
    if ($_FILES["image"]["size"] > 5000000) {
        $uploadOk = 0;
        header("Location: add_product.php?error=Sorry, your file is too large.");
        exit;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
        header("Location: add_product.php?error=Sorry, only JPG, JPEG, & PNG files are allowed.");
        exit;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header("Location: add_product.php?error=Sorry, your file was not uploaded.");
        exit;
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $product_image_path = $target_file;

            // Save product data to the database
            if (!empty($product_name) && !empty($category_id) && !empty($product_price) && !empty($product_stock) && !empty($product_details) && !empty($product_image_path)) {
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $stmt = $conn->prepare("INSERT INTO product_table (product_name, category_id, product_price, product_stock, product_details, product_image_path) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("siidss", $product_name, $category_id, $product_price, $product_stock, $product_details, $product_image_path);

                if ($stmt->execute() === TRUE) {
                    header("Location: add_product.php?success=1");
                    exit;
                } else {
                    header("Location: add_product.php?error=" . urlencode($stmt->error));
                    exit;
                }

                $stmt->close();
                $conn->close();
            } else {
                header("Location: add_product.php?error=Please fill all fields");
                exit;
            }
        } else {
            header("Location: add_product.php?error=Sorry, there was an error uploading your file.");
            exit;
        }
    }
}

if (isset($_POST["orderadd"])) {
    $product_id = $_POST["product_id"];
    $customer_id = $_POST["customer_id"];
    $order_address = $_POST["order_address"];
    $cargo_no = time();
    $color = $_POST["color"];
    $size = $_POST["size"];
    $order_status = $_POST["order_status"];

    if (!empty($product_id) && !empty($customer_id) && !empty($order_address) && !empty($cargo_no) && !empty($color) && !empty($size) && !empty($order_status)) {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO order_table (product_id, customer_id, order_address, cargo_no, color, size, order_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisisss", $product_id, $customer_id, $order_address, $cargo_no, $color, $size, $order_status);

        if ($stmt->execute() === TRUE) {
            header("Location: add_order.php?success=1");
            exit;
        } else {
            header("Location: add_order.php?error=" . urlencode($stmt->error));
            exit;
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: add_order.php?error=Please fill all fields ");
        exit;
    }
}

?>
