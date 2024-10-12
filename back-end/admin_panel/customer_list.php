<?php
include("config.php");
include("logged_in_check.php");

// Veritabanı bağlantısını yap
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Veritabanından müşteri verilerini al
$sql = "SELECT * FROM customer_table";
$result = $conn->query($sql);
?>

<?php include('header.php'); ?>

<body>
    <div id="wrapper">
        <?php include('top_bar.php'); ?>
        <?php include('left_sidebar.php'); ?>

        <div id="content">
            <div id="content-header">
                <h1>CUSTOMER LIST</h1>
            </div> <!-- #content-header -->

            <div class="portlet">
                <div class="portlet-header"></div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <table class="table table-bordered table-highlight">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                $count = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $count++;
                            ?>
                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $row["customer_name"] ?></td>
                                        <td><?php echo $row["customer_surname"] ?></td>
                                        <td><?php echo $row["customer_username"] ?></td>
                                        <td><?php echo $row["customer_status"] ?></td>
                                        <td>
                                            <a href="edit_customer.php?customer_id=<?php echo $row['customer_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="?delete_id=<?php echo $row['customer_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>No records found</td></tr>";
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
