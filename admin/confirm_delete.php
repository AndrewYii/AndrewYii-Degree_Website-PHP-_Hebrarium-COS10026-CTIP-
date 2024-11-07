<?php
session_start();
include '../database/connection.php';
include '../database/database.php';

if (!isset($_GET['id'])) {
    $_SESSION['message'] = 'Invalid request';
    header('Location: admin_control_panel.php');
    exit();
}

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
                <form action="delete.php" method="get" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <button type="submit" class="confirm-button">Yes, Delete</button>
                </form>
                <a href="admin_control_panel.php" class="cancel-button">Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>
