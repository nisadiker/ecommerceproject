<?php
// session_start();
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

// Yönetici silme işlemi
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM admin_table WHERE admin_id = $delete_id";
    $conn->query($delete_sql);
    header("Location: admin_list.php");
}

// Veritabanından verileri alarak tabloya ekle
$sql = "SELECT * FROM admin_table";
$result = $conn->query($sql);

?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">      
        
        <div id="content-header">
            <h1>ADMIN LIST</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">

            <div class="col-md-12">
                <h4 class="heading">ADMIN LIST TABLE</h4>
                <table class="table table-bordered table-highlight">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
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
                            <td><?php echo $row["admin_name"] ?></td>
                            <td><?php echo $row["admin_surname"] ?></td>
                            <td><?php echo $row["admin_username"] ?></td>
                            <td>
                                <?php 
                                if ($row["admin_status"] == 1) {
                                    echo "Active";
                                } else {
                                    echo "Inactive";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="edit_admin.php?admin_id=<?php echo $row['admin_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="?delete_id=<?php echo $row['admin_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</a>
                                
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
            </div> <!-- /.col -->

        </div> <!-- /.content-container -->

    </div> <!-- /#content -->

    <?php include('footer.php'); ?>

</div> <!-- /#wrapper -->

</body>
</html>
