<?php
// Veritabanı bağlantısını yap
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories
$sql_category = "SELECT * FROM category_table";
$category_result = $conn->query($sql_category);

// Get selected category ID from URL
$selected_category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Fetch products based on selected category
$sql_product = "SELECT * FROM product_table";
if ($selected_category_id > 0) {
    $sql_product .= " WHERE product_stock > 0 AND category_id = " . $selected_category_id;
}
$product_result = $conn->query($sql_product);
?>

<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    <?php
                    if ($category_result->num_rows > 0) {
                        while ($row = $category_result->fetch_assoc()) {
                            echo '<a href="?category_id=' . $row['category_id'] . '" class="nav-item nav-link">' . $row['category_name'] . '</a>';
                        }
                    }
                    ?>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>ZartZurt</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="shop.html" class="nav-item nav-link">Shop</a>
                        <div class="nav-item dropdown">
                            <div class="dropdown-menu rounded-0 m-0"></div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        <a href="" class="nav-item nav-link">Login</a>
                        <a href="" class="nav-item nav-link">Register</a>
                    </div>
                </div>
            </nav>
            <div id="content">
                <div id="content-container">
                    <div class="col-md-12">
                        <table class="table table-bordered table-highlight">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Stock</th>
                                    <th>Product Price</th>
                                    <th>Product Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($product_result->num_rows > 0) {
                                    while ($row = $product_result->fetch_assoc()) {
                                        $imagePath = "../berkhoca_project/admin_panel/" . $row["product_image_path"];
                                ?>
                                <tr>
                                    <td><?php echo $row["product_name"] ?></td>
                                    <td><?php echo $row["product_stock"] ?></td>
                                    <td><?php echo $row["product_price"] ?></td>
                                    <td><img src="<?php echo $imagePath ?>" alt="Product Image" width="100" height="100"></td>
                                    <td>
                                        <form action="add_to_cart.php" method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                            <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                                            <input type="hidden" name="product_image_path" value="<?php echo $row['product_image_path']; ?>">
                                            <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php 
                                    } 
                                } else {
                                    echo "<tr><td colspan='5'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> <!-- /.col -->
                </div> <!-- /.content-container -->
            </div> <!-- /#content -->
        </div>
    </div>
</div>
