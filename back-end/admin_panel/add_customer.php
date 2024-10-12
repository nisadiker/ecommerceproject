<?php
include("config.php");
include("logged_in_check.php");

// Veritabanı bağlantısını yap
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST["customer_name"];
    $customer_surname = $_POST["customer_surname"];
    $customer_username = $_POST["customer_username"];
    $customer_pass = $_POST["customer_pass"];

    $stmt = $conn->prepare("INSERT INTO customer_table (customer_name, customer_surname, customer_username, customer_pass, customer_status) VALUES (?, ?, ?, ?, 'Active')");
    $stmt->bind_param("ssss", $customer_name, $customer_surname, $customer_username, $customer_pass);

    if ($stmt->execute()) {
        // JavaScript ile pop-up göster
        echo "<script>alert('Customer added successfully!');</script>";
        // Sayfayı refreshle
        echo "<script>window.location.href='add_customer.php';</script>";
        exit;
    } else {
        header("Location: add_customer.php?error=" . urlencode($stmt->error));
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include('header.php'); ?>

<body>
    <div id="wrapper">
        <?php include('top_bar.php'); ?>
        <?php include('left_sidebar.php'); ?>

        <div id="content">
            <div id="content-header">
                <h1>ADD CUSTOMER</h1>
            </div> <!-- #content-header -->

            <div class="portlet">
                <div class="portlet-header"></div> <!-- /.portlet-header -->
                <div class="portlet-content">
                <?php if (isset($_GET['error'])) : ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2">Customer Name</label>
                        <div class="col-md-10">
                            <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Customer Surname</label>
                        <div class="col-md-10">
                            <input type="text" name="customer_surname" class="form-control" placeholder="Customer Surname" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Username</label>
                        <div class="col-md-10">
                            <input type="text" name="customer_username" class="form-control" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Password</label>
                        <div class="col-md-10">
                            <input type="password" name="customer_pass" class="form-control" placeholder="Password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning">Submit</button>
                </form>
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div> <!-- #content -->
    </div> <!-- #wrapper -->
    <?php include('footer.php'); ?>
</body>
</html>
