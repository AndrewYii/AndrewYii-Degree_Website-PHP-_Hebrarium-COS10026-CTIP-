<?php
session_start(); // Start the session at the beginning of the script

include '../database/connection.php';
include '../database/database.php';

// If the form is submitted (after confirmation)
if (isset($_POST['confirm_delete'])) {
    // Create new connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $id = $_POST['id'];
    
    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM login WHERE Login_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Record deleted successfully';
    } else {
        $_SESSION['message'] = 'Error deleting record: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    header('Location: admin_login_control_panel.php');
    exit();
}

// If just showing the confirmation dialog
if (isset($_GET['id'])) {
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Deletion</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="modal-overlay">
        <div class="confirmation-box">
            <h2>Are you sure you want to delete this record?</h2>
            <div class="button-group">
                <form action="delete_login.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <input type="hidden" name="confirm_delete" value="1">
                    <button type="submit" class="confirm-button">Yes, Delete</button>
                </form>
                <a href="admin_login_control_panel.php" class="cancel-button">Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
} else {
    $_SESSION['message'] = 'Invalid request';
    header('Location: admin_login_control_panel.php');
    exit();
}
?>
