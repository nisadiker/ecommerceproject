<?php
include("config.php");
include("auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $customer_name = $_POST["customer_name"];
    $customer_surname = $_POST["customer_surname"];
    $customer_username = $_POST["customer_username"];
    $customer_pass = $_POST["customer_pass"];
    $customer_status = $_POST["customer_status"];

    if (!empty($customer_id) && !empty($customer_name) && !empty($customer_surname) && !empty($customer_username) && !empty($customer_pass) && !empty($customer_status)) {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("UPDATE customer_table SET customer_name=?, customer_surname=?, customer_username=?, customer_pass=?, customer_status=? WHERE customer_id=?");
        $stmt->bind_param("sssssi", $customer_name, $customer_surname, $customer_username, $customer_pass, $customer_status, $customer_id);

        if ($stmt->execute() === TRUE) {
            header("Location: customer_list.php?success=1");
            exit;
        } else {
            header("Location: edit_customer.php?error=" . urlencode($stmt->error));
            exit;
        }

        $stmt->close();
        $conn->close();
    } else {
        $error_message = "Please fill all fields";
    }
} else {
    $customer_id = $_GET["customer_id"];
    $sql = "SELECT * FROM customer_table WHERE customer_id = $customer_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $customer_name = $row["customer_name"];
        $customer_surname = $row["customer_surname"];
        $customer_username = $row["customer_username"];
        $customer_pass = $row["customer_pass"];
        $customer_status = $row["customer_status"];
    } else {
        header("Location: customer_list.php?error=Customer not found");
        exit;
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
                <h1>Edit Customer</h1>
            </div> <!-- #content-header -->  
            
            <div class="portlet">
                <div class="portlet-header"></div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <?php if (isset($error_message)) : ?>
                        <div class="alert alert-danger">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="form-horizontal" role="form">
                        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                        <div class="form-group">
                            <label class="col-md-2">Customer Name</label>
                            <div class="col-md-10">
                                <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Customer Surname</label>
                            <div class="col-md-10">
                                <input type="text" name="customer_surname" class="form-control" value="<?php echo $customer_surname; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Username</label>
                            <div class="col-md-10">
                                <input type="text" name="customer_username" class="form-control" value="<?php echo $customer_username; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2">Password</label>
                            <div class="col-md-10">
                                <input type
