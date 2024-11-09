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
                <li><a href="view_register.php"><img src="../images/register_icon.png" alt="Register" class="register-sidebar-icon"><span>Register</span></a></li>
                <li><a href="view_login.php"><img src="../images/login_icon.png" alt="Login" class="login-sidebar-icon"><span>Login</span></a></li>
                <li><a href="view_contribute.php"><img src="../images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon"><span>Contribute</span></a></li>
                <li><a href="view_enquiry.php" class="active"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></a></li>
                <li><a href="view_pre_contribute.php"><img src="../images/pre_contribute_icon.png" alt="pre-contribute" class="pre-contribute-sidebar-icon"><span>Pre-Contribute</span></a></li>
                <li><a href="view_comments.php"><img src="../images/comments_icon.png" alt="comments" class="comments-sidebar-icon"><span>Comments</span></a></li>
                <label for='logoutCheckbox' class='admin-logout-button'>Logout</label>
                            <input type='checkbox' id='logoutCheckbox'>
                            <div class='logout-background'>
                                <div class='logout-content'>
                                    <p>Are you sure you want to log out?</p>
                                    <a href='../logout.php' class='confirm-logout'>Yes</a>
                                    <label for='logoutCheckbox' class='cancel-logout'>No</label>
                                </div>
                            </div>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header class="admin-header">
            <h2 class="admin-header-text">
                Enquiries
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
                            <h3>Enquiries Records</h3>
                            <button>Refresh</button>
                        </div>
                    
                        <div class="card-body">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th class="description-column">Message</th>
                                        <th>Date Submitted</th>
                                        <th class="admin-delete-option">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $conn = mysqli_connect($servername,$username,$password,$dbname);
                                $sql = "SELECT * FROM enquiry";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["Enquiry_ID"]; ?></td>
                                        <td><?php echo $row["Name"]; ?></td>
                                        <td><?php echo $row["Email"]; ?></td>
                                        <td><?php echo $row["Subject"]; ?></td>
                                        <td class="description-column"><?php echo $row["Message"]; ?></td>
                                        <td><?php echo $row["Enquiry_Created_At"]; ?></td>
                                        <td>
                                            <input type="checkbox" id="toggle-<?php echo $row['Enquiry_ID']; ?>" class="toggle-checkbox">
                                            <label for="toggle-<?php echo $row['Enquiry_ID']; ?>" class="kebab-menu-icon">
                                                <img src="../images/kebab-menu.webp" alt="kebab menu" class="kebab-menu-icon">
                                            </label>
                                            <div class="menu-content">
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="display: inline;">
                                                <input type="hidden" name="view_id" value="<?php echo $row['Enquiry_ID']; ?>">
                                                <button type="submit" class="admin-view-button menu-button">View</button>
                                            </form>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="display: inline;">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['Enquiry_ID']; ?>">
                                                <button type="submit" class="admin-edit-button menu-button">Edit</button>
                                            </form>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                <input type="hidden" name="id" value="<?php echo $row['Enquiry_ID']; ?>">
                                                <button type="submit" class="admin-delete-button menu-button">Delete</button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No enquiries found</td></tr>";
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

        if (isset($_POST['confirm_delete'])) {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            $id = $_POST['id'];
            
            $sql = "DELETE FROM enquiry WHERE Enquiry_ID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = 'Record deleted successfully';
                echo"<meta http-equiv='refresh' content='0 ;url=view_enquiry.php'>";  
            } else {
                $_SESSION['message'] = 'Error deleting record: ' . mysqli_error($conn);
            }
            
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
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
    $sql = "SELECT * FROM enquiry WHERE Enquiry_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Enquiry Details</h2>
                </div>
                <div class="detail-row">
                    <strong>ID:</strong> <?php echo htmlspecialchars($row['Enquiry_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Name:</strong> <?php echo htmlspecialchars($row['Name']); ?>
                </div>
                <div class="detail-row">
                    <strong>Email:</strong> <?php echo htmlspecialchars($row['Email']); ?>
                </div>
                <div class="detail-row">
                    <strong>Subject:</strong> <?php echo htmlspecialchars($row['Subject']); ?>
                </div>
                <div class="detail-row">
                    <strong>Message:</strong> <?php echo htmlspecialchars($row['Message']); ?>
                </div>
                <div class="detail-row">
                    <strong>Date Submitted:</strong> <?php echo htmlspecialchars($row['Enquiry_Created_At']); ?>
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
    $sql = "SELECT * FROM enquiry WHERE Enquiry_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Edit Enquiry Details</h2>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="edit-form">
                    <input type="hidden" name="edit_enquiry_id" value="<?php echo htmlspecialchars($row['Enquiry_ID']); ?>">
                    
                    <div class="detail-row">
                        <strong>ID:</strong> <?php echo htmlspecialchars($row['Enquiry_ID']); ?>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Name:</strong>
                        <input type="text" name="edit_name" value="<?php echo htmlspecialchars($row['Name']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Email:</strong>
                        <input type="email" name="edit_email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Subject:</strong>
                        <input type="text" name="edit_subject" value="<?php echo htmlspecialchars($row['Subject']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Message:</strong>
                        <textarea name="edit_message" required><?php echo htmlspecialchars($row['Message']); ?></textarea>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Date:</strong> <?php echo htmlspecialchars($row['Enquiry_Created_At']); ?>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" name="update_enquiry" class="save-button">Save Changes</button>
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
if (isset($_POST['update_enquiry'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $id = mysqli_real_escape_string($conn, $_POST['edit_enquiry_id']);
    $name = mysqli_real_escape_string($conn, $_POST['edit_name']);
    $email = mysqli_real_escape_string($conn, $_POST['edit_email']);
    $subject = mysqli_real_escape_string($conn, $_POST['edit_subject']);
    $message = mysqli_real_escape_string($conn, $_POST['edit_message']);
    
    $sql = "UPDATE enquiry SET Name=?, Email=?, Subject=?, Message=? WHERE Enquiry_ID=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $subject, $message, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Record updated successfully';
    } else {
        $_SESSION['message'] = 'Error updating record: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    echo "<meta http-equiv='refresh' content='0;url=view_enquiry.php'>";
    exit();
}
?>
</body>
</html>