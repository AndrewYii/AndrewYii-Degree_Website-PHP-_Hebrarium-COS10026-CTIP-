<?php // STILL DRAFT, WILL BE CHANGES
session_start();
include('database/connection.php');
include ('database/database.php');

// Create a new connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    $register_id = $_POST['register_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check if all fields are filled
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        echo "<script>alert('All password fields are required.');
        window.location.href='change_password.php';</script>";
        exit;
    }
    
    // Check if new passwords match
    if ($new_password !== $confirm_password) {
        echo "<script>alert('New passwords do not match.');
        window.location.href='change_password.php';</script>";
        exit;
    }

    // Get current password from database
    $check_sql = "SELECT Password FROM Register WHERE Register_ID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $register_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo "<script>alert('User not found.');
        window.location.href='change_password.php';</script>";
        exit;
    }

    $user = $result->fetch_assoc();
    
    // Verify current password
    if ($current_password !== $user['Password']) {
        echo "<script>alert('Current password is incorrect.');
        window.location.href='change_password.php';</script>";
        $check_stmt->close();
        exit;
    }
    
    // Update password
    $update_sql = "UPDATE Register SET Password = ? WHERE Register_ID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $new_password, $register_id);
    
    if ($update_stmt->execute()) {
        echo "<script>alert('Password updated successfully!');
        window.location.href='change_password.php';</script>";
    } else {
        echo "<script>alert('Error updating password.');
        window.location.href='change_password.php';</script>";
    }
    
    // Close statements
    $check_stmt->close();
    $update_stmt->close();
}

$conn->close();
?>
