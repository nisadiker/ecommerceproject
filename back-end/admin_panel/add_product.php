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
                <h1>ADD PRODUCT</h1>
            </div> <!-- #content-header -->  
            
            <div class="portlet">
                <div class="portlet-header"></div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <?php if (isset($_GET['success'])) : ?>
                        <div class="alert alert-success">
                            Product added successfully!
                        </div>
                    <?php elseif (isset($_GET['error'])) : ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($_GET['error']); ?>
                        </div>
                    <?php endif; ?>
                    <form action="auth.php" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-2">Product Name</label>
                            <div class="col-md-10">
                                <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
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
                                            echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Price</label>
                            <div class="col-md-10">
                                <input type="number" name="product_price" class="form-control" placeholder="Product Price" min="0" step="0.01" oninput="validity.valid||(value='');" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Stock</label>
                            <div class="col-md-10">
                                <input type="number" name="product_stock" class="form-control" placeholder="Product Stock" min="0" step="1" oninput="validity.valid||(value='');" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Detail</label>
                            <div class="col-md-10">
                                <input type="text" name="product_details" class="form-control" placeholder="Product Detail" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Product Image</label>
                            <div class="col-md-10">
                                <input type="file" name="image" class="form-control" placeholder="Image" required>
                            </div>
                        </div>
                        
                        <button type="submit" name="productadd" class="btn btn-warning">Submit</button>
                    </form>
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div> <!-- #content -->
    </div> <!-- #wrapper -->
    <?php include('footer.php'); ?>
</body>
</html>
