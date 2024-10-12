<?php
include("config.php");
include("logged_in_check.php");

// Veritabanı bağlantısını yap
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);

// Yönetici silme işlemi
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM admin_table WHERE admin_id = $delete_id";
    $conn->query($delete_sql);
    header("Location: admin_list.php");
}

if (isset($_POST['orderedit'])) {
    $order_id = $_POST["order_id"];
    $product_id = $_POST["product_id"];
    $customer_id = $_POST["customer_id"];
    $order_address = $_POST["order_address"];
    $cargo_no = $_POST["cargo_no"];
    $color = $_POST["color"];
    $size = $_POST["size"];
    $order_status = $_POST["order_status"];
 


    $sql = "UPDATE order_table 
        SET product_id='$product_id', 
            customer_id='$customer_id', 
            order_address='$order_address', 
            cargo_no='$cargo_no', 
            color='$color', 
            size='$size', 
            order_status='$order_status' 
        WHERE order_id=$order_id";
        
        if ($conn->query($sql) === TRUE) {
        echo "order updated successfully";
        header("Location: order_list.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$order_id = $_GET['id'];

// Siparişi veritabanından çek
$sql = "SELECT * FROM order_table WHERE order_id = $order_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Order not found.";
    exit();
}

// Ürünleri veritabanından çek
$product_sql = "SELECT * FROM product_table";
$product_result = $conn->query($product_sql);

// Müşterileri veritabanından çek
$customer_sql = "SELECT customer_id, customer_name, customer_surname FROM customer_table";
$customer_result = $conn->query($customer_sql);
?>

<?php include('header.php'); ?>

<body>
    <div id="wrapper">
        <?php include('top_bar.php'); ?>
        <?php include('left_sidebar.php'); ?>

        <div id="content">
            <div id="content-header">
                <h1>EDIT ORDER</h1>
            </div> <!-- #content-header -->

            <div class="portlet">
                <div class="portlet-header"></div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <form action="edit_order.php" method="POST" class="form-horizontal" role="form">
                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Name</label>
                            <div class="col-md-10">
                                <select name="product_id" class="form-control" required>
                                    <option value="">Select Product</option>
                                    <?php
                                    if ($product_result->num_rows > 0) {
                                        while($product_row = $product_result->fetch_assoc()) {
                                            $selected = ($product_row['product_id'] == $row['product_id']) ? 'selected' : '';
                                            echo "<option value='" . $product_row['product_id'] . "' $selected>" . $product_row['product_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Customer</label>
                            <div class="col-md-10">
                                <select name="customer_id" class="form-control" required>
                                    <option value="">Select Customer</option>
                                    <?php
                                    if ($customer_result->num_rows > 0) {
                                        while($customer_row = $customer_result->fetch_assoc()) {
                                            $selected = ($customer_row['customer_id'] == $row['customer_id']) ? 'selected' : '';
                                            echo "<option value='" . $customer_row['customer_id'] . "' $selected>" . $customer_row['customer_name'] . " " . $customer_row['customer_surname'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Size</label>
                            <div class="col-md-10">
                                <select name="size" class="form-control" required>
                                    <option value="S" <?php echo ($row['size'] == 'S') ? 'selected' : ''; ?>>S</option>
                                    <option value="M" <?php echo ($row['size'] == 'M') ? 'selected' : ''; ?>>M</option>
                                    <option value="L" <?php echo ($row['size'] == 'L') ? 'selected' : ''; ?>>L</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Address</label>
                            <div class="col-md-10">
                                <textarea name="order_address" class="form-control" placeholder="Address" required><?php echo $row['order_address']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Cargo No</label>
                            <div class="col-md-10">
                            <input type="text" name="cargo_no" class="form-control" value="<?php echo $row['cargo_no']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Color</label>
                            <div class="col-md-10">
                                <select name="color" class="form-control" required>
                                    <option value="black" <?php echo ($row['color'] == 'black') ? 'selected' : ''; ?>>Black</option>
                                    <option value="white" <?php echo ($row['color'] == 'white') ? 'selected' : ''; ?>>White</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Status</label>
                            <div class="col-md-10">
                                <select name="order_status" class="form-control" required>
                                    <option value="order received" <?php echo ($row['order_status'] == 'order received') ? 'selected' : ''; ?>>Order Received</option>
                                    <option value="in cargo" <?php echo ($row['order_status'] == 'in cargo') ? 'selected' : ''; ?>>In Cargo</option>
                                    <option value="out of stock" <?php echo ($row['order_status'] == 'out of stock') ? 'selected' : ''; ?>>Out of Stock</option>
                                    <option value="canceled" <?php echo ($row['order_status'] == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" name="orderedit" class="btn btn-primary">Update Order</button>
                            <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>

                        </div>
                    </div>
                    </form>
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div> <!-- #content -->
    </div> <!-- #wrapper -->
    <?php include('footer.php'); ?>
</body>
</html>

