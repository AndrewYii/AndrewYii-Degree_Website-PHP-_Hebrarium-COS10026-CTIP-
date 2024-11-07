<?php
// Start the session and include your database connection
session_start();
include('database/connection.php');
include ('database/database.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_username'])) {
    $register_id = $_POST['register_id'];
    $new_username = trim($_POST['new_username']);
    
    // Validate username
    if (strlen($new_username) < 3) {
        echo "<script>alert('Username must be at least 3 characters long.');
        window.location.href='user_view_enquiry.php';</script>";
        exit;
    }
    
    // Check if username already exists
    $check_sql = "SELECT Register_ID FROM Register WHERE Username = ? AND Register_ID != ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("si", $new_username, $register_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo "<script>alert('Username already exists. Please choose another.');
        window.location.href='user_view_enquiry.php';</script>";
        exit;
    }
    
    // Update username
    $update_sql = "UPDATE Register SET Username = ? WHERE Register_ID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $new_username, $register_id);
    
    if ($update_stmt->execute()) {
        echo "<script>alert('Username updated successfully!');
        window.location.href='user_view_enquiry.php';</script>";
    } else {
        echo "<script>alert('Error updating username.');
        window.location.href='user_view_enquiry.php';</script>";
    }
    
    $check_stmt->close();
    $update_stmt->close();
    $conn->close();
}
?>
