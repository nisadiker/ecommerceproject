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

if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
    $sql = "SELECT * FROM admin_table WHERE admin_id = $admin_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No admin found with this ID";
        exit;
    }
}

if (isset($_POST['adminedit'])) {
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $admin_surname = $_POST['admin_surname'];
    $admin_username = $_POST['admin_username'];
    $admin_pass = $_POST['admin_pass'];

    $sql = "UPDATE admin_table SET admin_name='$admin_name', admin_surname='$admin_surname', admin_username='$admin_username', admin_pass='$admin_pass' WHERE admin_id=$admin_id";
    if ($conn->query($sql) === TRUE) {
        echo "Admin updated successfully";
        header("Location: admin_list.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include('header.php'); ?>

<body>
<div id="wrapper">
    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">
        <div id="content-header">
            <h1>EDIT ADMIN</h1>
        </div> <!-- #content-header -->  
        
        <div class="portlet">
            <div class="portlet-header"></div> <!-- /.portlet-header -->
            <div class="portlet-content">
                <form action="edit_admin.php" method="POST" class="form-horizontal" role="form">
                    <input type="hidden" name="admin_id" value="<?php echo $row['admin_id']; ?>">
                    <div class="form-group">
                        <label class="col-md-2">Name</label>
                        <div class="col-md-10">
                            <input type="text" name="admin_name" class="form-control" placeholder="Name" value="<?php echo $row['admin_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">Surname</label>
                        <div class="col-md-10">
                            <input type="text" name="admin_surname" class="form-control" placeholder="Surname" value="<?php echo $row['admin_surname']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">Username</label>
                        <div class="col-md-10">
                            <input type="text" name="admin_username" class="form-control" placeholder="Username" value="<?php echo $row['admin_username']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">Password</label>
                        <div class="col-md-10">
                            <input type="password" name="admin_pass" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" name="adminedit" class="btn btn-primary">Update Admin</button>
                            <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>

                        </div>
                    </div>
                </form>
            </div> <!-- /.portlet-content -->
        </div> <!-- /.portlet -->
    </div> <!-- /#content -->
</div> <!-- /#wrapper -->
</body>
</html>
