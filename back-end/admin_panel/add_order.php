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

// Ürünleri veritabanından çek
$sql = "SELECT * FROM product_table";
$product_result = $conn->query($sql);

// Müşterileri veritabanından çek
$sql2 = "SELECT customer_id, customer_name, customer_surname FROM customer_table";
$customer_result = $conn->query($sql2);
?>

<?php include('header.php'); ?>

<body>
    <div id="wrapper">
        <?php include('top_bar.php'); ?>
        <?php include('left_sidebar.php'); ?>
        
        <div id="content">
            <div id="content-header">
                <h1>ADD ORDER</h1>
            </div> <!-- #content-header -->  
            
            <div class="portlet">
                <div class="portlet-header"></div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <?php if (isset($_GET['success'])) : ?>
                        <div class="alert alert-success">
                            Order added successfully!
                        </div>
                    <?php elseif (isset($_GET['error'])) : ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($_GET['error']); ?>
                        </div>
                    <?php endif; ?>
                    <form action="auth.php" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-2">Product Name</label>
                            <div class="col-md-10">
                                <select name="product_id" class="form-control" required>
                                    <option value="">Select Product</option>
                                    <?php
                                    if ($product_result->num_rows > 0) {
                                        while($row = $product_result->fetch_assoc()) {
                                            echo "<option value='" . $row['product_id'] . "'>" . $row['product_name'] . "</option>";
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
                                        while($row = $customer_result->fetch_assoc()) {
                                            echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_name'] . " " . $row['customer_surname'] . "</option>";
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
                                    <option value="">Select Size</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Address</label>
                            <div class="col-md-10">
                                <textarea name="order_address" class="form-control" placeholder="Address" required></textarea>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-2">Color</label>
                            <div class="col-md-10">
                                <select name="color" class="form-control" required>
                                    <option value="">Select Color</option>
                                    <option value="black">Black</option>
                                    <option value="white">White</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Status</label>
                            <div class="col-md-10">
                                <select name="order_status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="order received">Order Received</option>
                                    <option value="in cargo">In Cargo</option>
                                    <option value="out of stock">Out of Stock</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="submit" name="orderadd" class="btn btn-warning">Submit</button>
                    </form>
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div> <!-- #content -->
    </div> <!-- #wrapper -->
    <?php include('footer.php'); ?>
</body>
</html>
