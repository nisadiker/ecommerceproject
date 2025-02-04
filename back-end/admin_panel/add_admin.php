<?php
session_start();
include("config.php");
include("logged_in_check.php");
?>

<?php include('header.php'); ?>

<body>
<div id="wrapper">
    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>
    
    <div id="content">
        <div id="content-header">
            <h1>ADD ADMIN</h1>
        </div> <!-- #content-header -->  
        
        <div class="portlet">
            <div class="portlet-header"></div> <!-- /.portlet-header -->
            <div class="portlet-content">
                <?php if (isset($_GET['success'])) : ?>
                    <div class="alert alert-success">
                        Admin added successfully!
                    </div>
                <?php elseif (isset($_GET['error'])) : ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
                <form action="auth.php" method="POST" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2">Name</label>
                        <div class="col-md-10">
                            <input type="text" name="admin_name" class="form-control" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">Surname</label>
                        <div class="col-md-10">
                            <input type="text" name="admin_surname" class="form-control" placeholder="Surname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">Username</label>
                        <div class="col-md-10">
                            <input type="text" name="admin_username" class="form-control" placeholder="Username" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2">Password</label>
                        <div class="col-md-10">
                            <input type="password" name="admin_pass" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <button type="submit" name="adminadd" class="btn btn-warning">Submit</button>
                </form>
            </div> <!-- /.portlet-content -->
        </div> <!-- /.portlet -->
    </div> <!-- #content -->
</div> <!-- #wrapper -->
<?php include('footer.php'); ?>
</body>
</html>
