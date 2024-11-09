<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Enquiries"/>
    <meta name="keywords" content="Plant's Notebook, Enquiries, Admin View"/>
    <title>Plant's Notebook | View Enquiries</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
</head>

<body>
    <?php 
    session_start(); 
    include ('../database/connection.php');
    include ('../database/database.php');
    ?>

    <?php
    // Check if there's a message in the session
    if (isset($_SESSION['message'])) {
        $messageClass = strpos($_SESSION['message'], 'Error') !== false ? 'error-message' : 'success-message';
        echo "<div class='admin-message {$messageClass}'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Clear the message from session after displaying it
    }
    ?>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
    <p class="logo_admin">
        <a href="../index.php"><img src="../images/logo.png" alt="Plant\'s Notebook">
        <span class="admin_logo_text">Plant's Notebook</span></a>
    </p>

        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft">Admin Control Panel</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li><a href="view_register.php" class="active"><img src="../images/register_icon.png" alt="Register" class="register-sidebar-icon"><span>Register</span></a></li>
                <li><a href="view_login.php"><img src="../images/login_icon.png" alt="Login" class="login-sidebar-icon"><span>Login</span></a></li>
                <li><a href="view_contribute.php"><img src="../images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon"><span>Contribute</span></a></li>
                <li><a href="view_enquiry.php"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></a></li>
                <li><a href="view_pre_contribute.php"><img src="../images/pre_contribute_icon.png" alt="pre-contribute" class="pre-contribute-sidebar-icon"><span>Pre-Contribute</span></a></li>
                <li><a href="view_comments.php"><img src="../images/comments_icon.png" alt="comments" class="comments-sidebar-icon"><span>Comments</span></a></li>
                <label for='logoutCheckbox' class='admin-logout-button'>Logout</label>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header class="admin-header">
            <h2 class="admin-header-text">
                Register 
            </h2>

            <div class="search-wrapper">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="admin-search-form">
                    <input type="search" name="search" placeholder="Search here">
                    <button class="admin-search-button" id="admin-button-activate" type="submit">
                        <label for="admin-button-activate">
                            <img src="../images/search_icon.png" alt="Search" class="admin-search-icon">
                        </label>
                    </button>
                </form>
            </div>

            <div class="user-wrapper">
                <img src="../images/admin-icon.jpg" alt="admin profile picture">
                <div>
                    <h4>Admin</h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>

        <main>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Register Records</h3>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display: inline;">
                                <button type="submit" name="refresh_table" onclick="window.location.reload();">Refresh</button>
                            </form>            
                        </div>
                    
                        <div class="card-body">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Date Submitted</th>
                                    <th class="admin-delete-option">Action</th>
                                </tr>

                            </thead>
                            <?php
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            $sql = "SELECT * FROM Register ORDER BY Register_Created_At DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row["Register_ID"]; ?></td>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Username"]; ?></td>
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["Register_Created_At"]; ?></td>
                    <td>
                        <input type="checkbox" id="toggle-<?php echo $row['Register_ID']; ?>" class="toggle-checkbox">
                        <label for="toggle-<?php echo $row['Register_ID']; ?>" class="kebab-menu-icon">
                            <img src="../images/kebab-menu.webp" alt="kebab menu" class="kebab-menu-icon">
                        </label>
                        <div class="menu-content">      
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="display: inline;">
                            <input type="hidden" name="view_id" value="<?php echo $row['Register_ID']; ?>">
                            <button type="submit" class="admin-view-button menu-button">View</button>
                        </form>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="display: inline;">
                            <input type="hidden" name="edit_id" value="<?php echo $row['Register_ID']; ?>">
                            <button type="submit" class="admin-edit-button menu-button">Edit</button>
                        </form>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <input type="hidden" name="id" value="<?php echo $row['Register_ID']; ?>">
                            <button type="submit" class="admin-delete-button menu-button">Delete</button>
                        </form>
                        </div>
                    </td>
                </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='11'>No register records found</td></tr>";
            }
            mysqli_close($conn);
        ?>

                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php
        // If the form is submitted (after confirmation)
        if (isset($_POST['confirm_delete'])) {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            
            // First get the username of the profile being deleted
            $get_username_sql = "SELECT Username FROM register WHERE Register_ID = ?";
            $stmt = mysqli_prepare($conn, $get_username_sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            
            if ($user) {
                // Start transaction to ensure all or nothing is deleted
                mysqli_begin_transaction($conn);
                
                try {
                    // Delete their contributions
                    $delete_contributions = "DELETE FROM contribute WHERE Username = ?";
                    $stmt = mysqli_prepare($conn, $delete_contributions);
                    mysqli_stmt_bind_param($stmt, "s", $user['Username']);
                    mysqli_stmt_execute($stmt);
                    
                    // Delete their pre-contributions
                    $delete_pre_contributions = "DELETE FROM pre_contribute WHERE Username = ?";
                    $stmt = mysqli_prepare($conn, $delete_pre_contributions);
                    mysqli_stmt_bind_param($stmt, "s", $user['Username']);
                    mysqli_stmt_execute($stmt);
                    
                    // Delete their profile
                    $delete_profile = "DELETE FROM register WHERE Register_ID = ?";
                    $stmt = mysqli_prepare($conn, $delete_profile);
                    mysqli_stmt_bind_param($stmt, "i", $id);
                    mysqli_stmt_execute($stmt);
                    
                    // If we got here, commit the transaction
                    mysqli_commit($conn);
                    $_SESSION['message'] = 'Profile and all associated contributions deleted successfully';
                } catch (Exception $e) {
                    // If anything went wrong, rollback the changes
                    mysqli_rollback($conn);
                    $_SESSION['message'] = 'Error deleting profile and contributions: ' . $e->getMessage();
                }
            } else {
                $_SESSION['message'] = 'Profile not found';
            }
            
            mysqli_close($conn);
            echo "<meta http-equiv='refresh' content='0;url=view_register.php'>";
            exit();
        }

        // If showing the confirmation dialog, show only the confirmation modal
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Output the confirmation dialog
            ?>
            <div class="modal-overlay">
                <div class="confirmation-box">
                    <h2>Are you sure you want to delete this record?</h2>
                    <div class="button-group">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            <input type="hidden" name="confirm_delete" value="1">
                            <button type="submit" class="confirm-button">Yes, Delete</button>
                        </form>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="cancel-button">Cancel</a>
                    </div>
                </div>
            </div>

            <?php
            exit(); 
        }
    ?>

<?php
if (isset($_GET['view_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_GET['view_id']);
    $sql = "SELECT * FROM Register WHERE Register_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Register Details</h2>
                </div>
                <div class="detail-row">
                    <strong>ID:</strong> <?php echo htmlspecialchars($row['Register_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Name:</strong> <?php echo htmlspecialchars($row['Name']); ?>
                </div>
                <div class="detail-row">
                    <strong>Username:</strong> <?php echo htmlspecialchars($row['Username']); ?>
                </div>
                <div class="detail-row">
                    <strong>Email:</strong> <?php echo htmlspecialchars($row['Email']); ?>
                </div>
                <div class="detail-row">
                    <strong>Date Submitted:</strong> <?php echo htmlspecialchars($row['Register_Created_At']); ?>
                </div>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="close-view-button">Close</a>
            </div>
        </div>
        <?php
    }
    mysqli_close($conn);
}
?>

<?php
if (isset($_GET['edit_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_GET['edit_id']);
    $sql = "SELECT * FROM Register WHERE Register_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Edit Register Details</h2>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="edit-form">
                    <input type="hidden" name="edit_register_id" value="<?php echo htmlspecialchars($row['Register_ID']); ?>">
                    
                    <div class="detail-row">
                        <strong>ID:</strong> <?php echo htmlspecialchars($row['Register_ID']); ?>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Name:</strong>
                        <input type="text" name="edit_name" value="<?php echo htmlspecialchars($row['Name']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Username:</strong>
                        <input type="text" name="edit_username" value="<?php echo htmlspecialchars($row['Username']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Email:</strong>
                        <input type="email" name="edit_email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
                    </div>
                                        
                    <div class="detail-row">
                        <strong>Date:</strong> <?php echo htmlspecialchars($row['Register_Created_At']); ?>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" name="update_register" class="save-button">Save Changes</button>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="cancel-button">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
    mysqli_close($conn);
}

// Handle the form submission
if (isset($_POST['update_register'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $id = mysqli_real_escape_string($conn, $_POST['edit_register_id']);
    $name = mysqli_real_escape_string($conn, $_POST['edit_name']);
    $username = mysqli_real_escape_string($conn, $_POST['edit_username']);
    $email = mysqli_real_escape_string($conn, $_POST['edit_email']);
    
    // Create the SQL statement
    $sql = "UPDATE Register SET Name=?, Username=?, Email=? WHERE Register_ID=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $username, $email, $id);
        
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Record updated successfully';
    } else {
        $_SESSION['message'] = 'Error updating record: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    echo "<meta http-equiv='refresh' content='0;url=view_register.php'>";
    exit();
}
?>

<!-- Move this outside the sidebar, right after <body> tag -->
<input type='checkbox' id='logoutCheckbox'>
<div class='logout-background'>
    <div class='logout-content'>
        <p>Are you sure you want to log out?</p>
        <a href='../logout.php' class='confirm-logout'>Yes</a>
        <label for='logoutCheckbox' class='cancel-logout'>No</label>
    </div>
</div>
</body>
</html>