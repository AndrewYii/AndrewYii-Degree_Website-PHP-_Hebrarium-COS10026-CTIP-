<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Login Records"/>
    <meta name="keywords" content="Plant's Notebook, Login Records, Admin View"/>
    <title>Plant's Notebook | View Login Records</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
</head>

<body>
    <?php 
    session_start(); 
    include ('../database/connection.php');
    include ('../database/database.php');

    // Add this message check and display
    if (isset($_SESSION['message'])) {
        $messageClass = strpos($_SESSION['message'], 'Error') !== false ? 'error-message' : 'success-message';
        echo "<div class='admin-message {$messageClass}'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Clear the message after displaying
    }
    ?>

    <!-- Logout HTML moved here -->
    <input type='checkbox' id='logoutCheckbox'>
    <div class='logout-background'>
        <div class='logout-content'>
            <p>Are you sure you want to log out?</p>
            <a href='../logout.php' class='confirm-logout'>Yes</a>
            <label for='logoutCheckbox' class='cancel-logout'>No</label>
        </div>
    </div>

    <!-- Rest of your existing code -->
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
                <li><a href="view_register.php"><img src="../images/register_icon.png" alt="Register" class="register-sidebar-icon"><span>Register</span></a></li>
                <li><a href="view_login.php" class="active"><img src="../images/login_icon.png" alt="Login" class="login-sidebar-icon"><span>Login</span></a></li>
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
                Login 
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
                            <h3>Login Records</h3>
                            <button class="admin-print-button">Print</button>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <button type="submit" name="refresh_table">Refresh</button>
                            </form>
                        </div>
                    
                        <div class="card-body">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Register ID</th>
                                        <th>Username</th>
                                        <th>Login At</th>
                                        <th>Logout At</th>
                                        <th class="admin-delete-option">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $conn = mysqli_connect($servername,$username,$password,$dbname);
                                $sql = "SELECT * FROM login ORDER BY Login_At DESC";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["Login_ID"]; ?></td>
                                        <td><?php echo $row["Register_ID"]; ?></td>
                                        <td><?php echo $row["Username"]; ?></td>
                                        <td><?php echo $row["Login_At"]; ?></td>
                                        <td><?php echo isset($row["Logout_At"]) && $row["Logout_At"] !== null
                                        ? $row["Logout_At"]
                                        : "Still Logged In"; ?></td>
                                        <td>
                                            <input type="checkbox" id="toggle-<?php echo $row['Login_ID']; ?>" class="toggle-checkbox">
                                            <label for="toggle-<?php echo $row['Login_ID']; ?>" class="kebab-menu-icon">
                                                <img src="../images/kebab-menu.webp" alt="kebab menu" class="kebab-menu-icon">
                                            </label>
                                            <div class="menu-content">                            
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                <input type="hidden" name="view_id" value="<?php echo $row['Login_ID']; ?>">
                                                <button type="submit" class="admin-view-button menu-button">View</button>
                                            </form>                         
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['Login_ID']; ?>">
                                                <button type="submit" class="admin-edit-button menu-button">Edit</button>
                                            </form>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                <input type="hidden" name="id" value="<?php echo $row['Login_ID']; ?>">
                                                <button type="submit" class="admin-delete-button menu-button">Delete</button>
                                            </form> 
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No login records found</td></tr>";
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
            // Create new connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            $id = $_POST['id'];
            
            // Use prepared statement to prevent SQL injection
            $sql = "DELETE FROM login WHERE Login_ID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = 'Record deleted successfully';
                echo"<meta http-equiv='refresh' content='0 ;url=view_login.php'>";  
                
            } else {
                $_SESSION['message'] = 'Error deleting record: ' . mysqli_error($conn);
            }
            
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            
            // Redirect to same page instead of different page
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
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
    $sql = "SELECT * FROM login WHERE Login_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Login Details</h2>
                </div>
                <div class="detail-row">
                    <strong>ID:</strong> <?php echo htmlspecialchars($row['Login_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Register ID:</strong> <?php echo htmlspecialchars($row['Register_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Username:</strong> <?php echo htmlspecialchars($row['Username']); ?>
                </div>
                <div class="detail-row">
                    <strong>Login At:</strong> <?php echo htmlspecialchars($row['Login_At']); ?>
                </div>
                <div class="detail-row">
                    <strong>Logout At:</strong> <?php echo htmlspecialchars($row['Logout_At']); ?>
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
    $sql = "SELECT * FROM login WHERE Login_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Edit Login Details</h2>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="edit-form">
                    <input type="hidden" name="edit_login_id" value="<?php echo htmlspecialchars($row['Login_ID']); ?>">
                    
                    <div class="detail-row">
                        <strong>ID:</strong> <?php echo htmlspecialchars($row['Login_ID']); ?>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Register ID:</strong>
                        <input type="text" name="edit_register_id" value="<?php echo htmlspecialchars($row['Register_ID']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Username:</strong>
                        <input type="text" name="edit_username" value="<?php echo htmlspecialchars($row['Username']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Login At:</strong>
                        <input type="text" name="edit_login_at" value="<?php echo htmlspecialchars($row['Login_At']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Logout At:</strong> <?php echo htmlspecialchars($row['Logout_At']); ?>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" name="update_login" class="save-button">Save Changes</button>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="cancel-button">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
    mysqli_close($conn);
}

// Handle the form submission for updates
if (isset($_POST['update_login'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $id = mysqli_real_escape_string($conn, $_POST['edit_login_id']);
    $register_id = mysqli_real_escape_string($conn, $_POST['edit_register_id']);
    $username = mysqli_real_escape_string($conn, $_POST['edit_username']);
    $login_at = mysqli_real_escape_string($conn, $_POST['edit_login_at']);
    
    $sql = "UPDATE login SET Register_ID=?, Username=?, Login_At=? WHERE Login_ID=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $register_id, $username, $login_at, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Record updated successfully';
    } else {
        $_SESSION['message'] = 'Error updating record: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    echo "<meta http-equiv='refresh' content='0;url=view_login.php'>";
    exit();
}
?>
</body>
</html>