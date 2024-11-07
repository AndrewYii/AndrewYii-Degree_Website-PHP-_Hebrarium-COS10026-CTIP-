<?php
session_start(); // Start the session at the beginning of the script

include '../database/connection.php';
include '../database/database.php';

// Create new connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if ID is provided
if (!isset($_GET['id'])) {
    // Set error message in session
    $_SESSION['message'] = 'Invalid request';
    // Redirect to admin control panel
    header('Location: admin_enquiry_control_panel.php');
    exit();
}

$id = $_GET['id'];

// Use prepared statement to prevent SQL injection
$sql = "DELETE FROM enquiry WHERE Enquiry_ID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    // Set success message in session
    $_SESSION['message'] = 'Record deleted successfully';
} else {
    // Set error message in session if deletion fails
    $_SESSION['message'] = 'Error deleting record: ' . mysqli_error($conn);
}

// Redirect back to the control panel
header('Location: admin_enquiry_control_panel.php');
exit();

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
