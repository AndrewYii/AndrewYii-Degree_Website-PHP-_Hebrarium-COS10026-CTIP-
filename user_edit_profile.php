<?php
session_start();
include('database/connection.php'); // Include database connection file

// Retrieve form data
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
$retrived_registerid = $_SESSION['Register_ID']; // Assuming ID is stored in the session

// Check if the new passwords match
if ($new_password !== $confirm_password) {
    echo "New passwords do not match.";
    exit;
}

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the current password hash from the database
$sql = "SELECT password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($stored_password_hash);
$stmt->fetch();
$stmt->close();

// Verify current password
if (!password_verify($current_password, $stored_password_hash)) {
    echo "Current password is incorrect.";
    exit;
}

// Hash the new password
$new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

// Update the new password in the database
$update_sql = "UPDATE users SET password = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("si", $new_password_hash, $user_id);

if ($update_stmt->execute()) {
    echo "Password successfully updated!";
} else {
    echo "Error updating password. Please try again.";
}

$update_stmt->close();
mysqli_close($conn);
?>
