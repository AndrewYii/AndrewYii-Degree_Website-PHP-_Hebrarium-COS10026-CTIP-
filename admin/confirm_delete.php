<?php
include '../database/connection.php';
include '../database/database.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: admin_login_control_panel.php?message=invalid_request");
    exit();
}

$id = $_GET['id'];

// Display the confirmation form
echo "
    <p>Are you sure you want to delete this record?</p>
    <form action='delete_login.php' method='post'>
        <input type='hidden' name='id' value='" . $id . "' />
        <button type='submit' name='confirm' value='yes'>Yes, Delete</button>
        <a href='admin_login_control_panel.php'><button type='button'>No, Cancel</button></a>
    </form>
";
?>
