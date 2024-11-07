<?php
include '../database/connection.php';
include '../database/database.php';

// Create new connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if ID is provided
if (!isset($_GET['id'])) {
    echo "<script>
            alert('Invalid request');
            window.location.href='admin_register_control_panel.php';
          </script>";
    exit();
}

$id = $_GET['id'];

// Use prepared statement to prevent SQL injection
$sql = "DELETE FROM Register WHERE Register_ID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
            alert('Record deleted successfully');
            window.location.href='admin_control_panel.php';
          </script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?> 

