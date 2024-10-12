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
if (isset($_GET['delete_id']) && isset($_GET['confirm'])) {
    $delete_id = $_GET['delete_id'];
    if ($_GET['confirm'] == 'yes') {
        $delete_sql = "DELETE FROM order_table WHERE order_id = $delete_id";
        $conn->query($delete_sql);
        header("Location: admin_list.php");
    } else {
        header("Location: order_list.php");
    }
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Siparişleri veritabanından çek
$sql = "SELECT order_table.*, product_table.product_name, customer_table.customer_name, customer_table.customer_surname FROM order_table LEFT JOIN product_table ON order_table.product_id = product_table.product_id LEFT JOIN customer_table ON order_table.customer_id = customer_table.customer_id ORDER BY order_id DESC"; // Order by descending order_id to get the latest orders first
$order_result = $conn->query($sql);
?>

<?php include('header.php'); ?>

<body>
    <div id="wrapper">
        <?php include('top_bar.php'); ?>
        <?php include('left_sidebar.php'); ?>

        <div id="content">
            <div id="content-header">
                <h1>ORDER LIST</h1>
            </div> <!-- #content-header -->

            <div class="portlet">
                <div class="portlet-header"></div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Customer Name and Surname</th>
                                <th>Size</th>
                                <th>Address</th>
                                <th>Cargo No</th>
                                <th>Color</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($order_result->num_rows > 0) {
                                while($row = $order_result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . (isset($row['product_name']) ? $row['product_name'] : '') . "</td>";
                                    echo "<td>" . (isset($row['customer_name']) ? $row['customer_name'] : '') . " " . (isset($row['customer_surname']) ? $row['customer_surname'] : '') . "</td>";
                                    echo "<td>" . (isset($row['size']) ? $row['size'] : '') . "</td>";
                                    echo "<td>" . (isset($row['order_address']) ? $row['order_address'] : '') . "</td>";
                                    echo "<td>" . (isset($row['cargo_no']) ? $row['cargo_no'] : '') . "</td>";
                                    echo "<td>" . (isset($row['color']) ? $row['color'] : '') . "</td>";
                                    echo "<td>" . (isset($row['order_status']) ? $row['order_status'] : '') . "</td>";
                                    echo "<td>
                                        <a href='edit_order.php?id=" . $row['order_id'] . "' class='btn btn-primary'>Edit</a>
                                        <a href='order_list.php?delete_id=" . $row['order_id'] . "&confirm=yes' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this order?')\">Delete</a>
                                        </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No orders found.</td></tr>";
                            }
                            
                            ?>
                        </tbody>
                    </table>
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div> <!-- #content -->
    </div> <!-- #wrapper -->
    <?php include('footer.php'); ?>
</body>
</html>
