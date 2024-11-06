<?php
// Start the session and include your database connection
session_start();
include('database/connection.php');
include ('database/database.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user ID (assuming it is stored in the session after login)
    $retrived_registerid = $row['Register_ID'];

    // Get form data
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Step 1: Fetch the current password hash from the database
    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($db_password);
    $stmt->fetch();
    $stmt->close();

    // Step 2: Verify the current password matches the hash in the database
    if (!password_verify($current_password, $db_password)) {
        echo "Current password is incorrect.";
        exit;
    }

    // Step 3: Check if the new password and confirm password match
    if ($new_password !== $confirm_password) {
        echo "New passwords do not match.";
        exit;
    }

    // Step 4: Hash the new password and update it in the database
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_password_hash, $user_id);

    if ($stmt->execute()) {
        echo "Password updated successfully.";
    } else {
        echo "Error updating password.";
    }

    $stmt->close();
    $conn->close();
}
?>
