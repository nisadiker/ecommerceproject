<?php
session_start();
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

// Ürün bilgilerini veritabanından çek
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM product_table WHERE product_id = $product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "No product found with this ID";
        exit;
    }
}

// Kategorileri veritabanından çek
$sql = "SELECT * FROM category_table";
$category_result = $conn->query($sql);
?>

<?php include('header.php'); ?>

<body>
    <div id="wrapper">
        <?php include('top_bar.php'); ?>
        <?php include('left_sidebar.php'); ?>
        
        <div id="content">
            <div id="content-header">
                <h1>EDIT PRODUCT</h1>
            </div> <!-- #content-header -->  
            
            <div class="portlet">
                <div class="portlet-header"></div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <form action="auth.php" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Name</label>
                            <div class="col-md-10">
                                <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="<?php echo $product['product_name']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Category Name</label>
                            <div class="col-md-10">
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    if ($category_result->num_rows > 0) {
                                        while($row = $category_result->fetch_assoc()) {
                                            $selected = ($row['category_id'] == $product['category_id']) ? 'selected' : '';
                                            echo "<option value='" . $row['category_id'] . "' $selected>" . $row['category_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Price</label>
                            <div class="col-md-10">
                                <input type="text" name="product_price" class="form-control" placeholder="Product Price" value="<?php echo $product['product_price']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Stock</label>
                            <div class="col-md-10">
                                <input type="text" name="product_stock" class="form-control" placeholder="Product Stock" value="<?php echo $product['product_stock']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Detail</label>
                            <div class="col-md-10">
                                <input type="text" name="product_details" class="form-control" placeholder="Product Detail" value="<?php echo $product['product_details']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Image</label>
                            <div class="col-md-10">
                                <input type="file" name="image" class="form-control" placeholder="Image"  >
                            </div>
                        </div>
                        
                        <button type="submit" name="productedit" class="btn btn-warning">Update</button>
                        <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>
                    </form>
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div> <!-- #content -->
    </div> <!-- #wrapper -->
    <?php include('footer.php'); ?>
</body>
</html>
