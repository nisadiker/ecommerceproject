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

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT * FROM category_table WHERE category_id = $category_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No category found with this ID";
        exit;
    }
}

if (isset($_POST['categoryedit'])) {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $category_order = $_POST['category_order'];
 


    $sql = "UPDATE category_table SET category_name='$category_name', category_order='$category_order'  WHERE category_id=$category_id";
    if ($conn->query($sql) === TRUE) {
        echo "category updated successfully";
        header("Location: category_list.php");
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
            <h1>EDIT CATEGORY</h1>
        </div> <!-- #content-header -->  
        
        <div class="portlet">
            <div class="portlet-header"></div> <!-- /.portlet-header -->
            <div class="portlet-content">
                <form action="edit_category.php" method="POST" class="form-horizontal" role="form">
                    <input type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>">
                    <div class="form-group">
                        <label class="col-md-2">Category Name </label>
                        <div class="col-md-10">
                            <input type="text" name="category_name" class="form-control" placeholder="Category Name " value="<?php echo $row['category_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">Category Order</label>
                        <div class="col-md-10">
                            <input type="text" name="category_order" class="form-control" placeholder="Category Order" value="<?php echo $row['category_order']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        
                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" name="categoryedit" class="btn btn-primary">Update Category</button>
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
