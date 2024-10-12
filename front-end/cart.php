<?php
session_start();

// Initialize cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Fonksiyon: Ürünleri listele


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <h1>Cart</h1>
    <div>
        <div id="content">
                <div id="content-container">
                    <div class="col-md-12">
                        <table class="table table-bordered table-highlight">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($_SESSION['cart'])> 0) {
                                    foreach ($_SESSION['cart'] as $row) {
                                        $imagePath = "../berkhoca_project/admin_panel/" . $row["product_image_path"];
                                ?>
                                <tr>
                                    <td><?php echo $row["product_name"] ?></td>
                                    <td><?php echo $row["product_price"] ?></td>
                                    <td><img src="<?php echo $imagePath ?>" alt="Product Image" width="100" height="100"></td>
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
    <div>
        <a href="index.php">Continue to shopping</a>
        <form action="process_order.php" method="POST">
        <div class="form-group">
                            <label class="col-md-2">Address</label>
                            <div class="col-md-10">
                                <textarea name="order_address" class="form-control" placeholder="Address" required></textarea>
                            </div>
                        </div>
          <button type="submit" class="btn btn-primary btn-sm">PAY AND BUY</button>
        </form>
    </div>
</body>
</html>
