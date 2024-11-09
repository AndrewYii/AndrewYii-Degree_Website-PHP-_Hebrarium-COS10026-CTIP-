<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Pre-Contributions"/>
    <meta name="keywords" content="Plant's Notebook, Pre-Contributions, Admin View"/>
    <title>Plant's Notebook | View Pre-Contributions</title>
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
                <li><a href="view_enquiry.php"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></a></li>
                <li><a href="view_pre_contribute.php" class="active"><img src="../images/pre_contribute_icon.png" alt="pre-contribute" class="pre-contribute-sidebar-icon"><span>Pre-Contribute</span></a></li>
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
                Pre-Contributions
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
                            <h3>Pre-Contribution Records</h3>
                            <button>Refresh</button>
                        </div>
                    
                        <div class="card-body">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Register ID</th>
                                        <th>Username</th>
                                        <th>Plant Name</th>
                                        <th>Scientific Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="admin-delete-option">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $conn = mysqli_connect($servername, $username, $password, $dbname);
                                $sql = "SELECT * FROM pre_contribute ORDER BY Pre_Contribute_ID DESC";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['Pre_Contribute_ID']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Register_ID']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Username']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Plant_Name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Scientific_Name']); ?></td>
                                            <td class="description-column"><?php echo htmlspecialchars($row['Description']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Category']); ?></td>
                                            <td><img src="<?php echo htmlspecialchars($row['Image']); ?>" alt="Plant Image" style="width: 50px; height: 50px;"></td>
                                            <td><?php echo htmlspecialchars($row['Status']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Pre_Contribute_Created_At']); ?></td>
                                            <td>
                                                <label class="menu-label">
                                                    <input type="checkbox" class="toggle-checkbox">
                                                    <img src="../images/kebab-menu.png" alt="menu" class="kebab-menu-icon">
                                                    <div class="menu-content">
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="display: inline;">
                                                            <input type="hidden" name="view_id" value="<?php echo $row['Pre_Contribute_ID']; ?>">
                                                            <button type="submit" class="admin-view-button menu-button">View</button>
                                                        </form>
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="display: inline;">
                                                            <input type="hidden" name="edit_id" value="<?php echo $row['Pre_Contribute_ID']; ?>">
                                                            <button type="submit" class="admin-edit-button menu-button">Edit</button>
                                                        </form>
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display: inline;">
                                                            <input type="hidden" name="delete_id" value="<?php echo $row['Pre_Contribute_ID']; ?>">
                                                            <button type="submit" class="admin-delete-button menu-button" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </label>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='11'>No records found</td></tr>";
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
// View Modal
if (isset($_GET['view_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_GET['view_id']);
    $sql = "SELECT * FROM pre_contribute WHERE Pre_Contribute_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Pre-Contribution Details</h2>
                </div>
                <div class="detail-row">
                    <strong>ID:</strong> <?php echo htmlspecialchars($row['Pre_Contribute_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Register ID:</strong> <?php echo htmlspecialchars($row['Register_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Username:</strong> <?php echo htmlspecialchars($row['Username']); ?>
                </div>
                <div class="detail-row">
                    <strong>Plant Name:</strong> <?php echo htmlspecialchars($row['Plant_Name']); ?>
                </div>
                <div class="detail-row">
                    <strong>Scientific Name:</strong> <?php echo htmlspecialchars($row['Scientific_Name']); ?>
                </div>
                <div class="detail-row">
                    <strong>Description:</strong> <?php echo htmlspecialchars($row['Description']); ?>
                </div>
                <div class="detail-row">
                    <strong>Category:</strong> <?php echo htmlspecialchars($row['Category']); ?>
                </div>
                <div class="detail-row">
                    <strong>Image:</strong><br>
                    <img src="<?php echo htmlspecialchars($row['Image']); ?>" alt="Plant Image" style="max-width: 200px; margin-top: 10px;">
                </div>
                <div class="detail-row">
                    <strong>Status:</strong> <?php echo htmlspecialchars($row['Status']); ?>
                </div>
                <div class="detail-row">
                    <strong>Created At:</strong> <?php echo htmlspecialchars($row['Pre_Contribute_Created_At']); ?>
                </div>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="close-view-button">Close</a>
            </div>
        </div>
        <?php
    }
    mysqli_close($conn);
}

// Edit Modal
if (isset($_GET['edit_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_GET['edit_id']);
    $sql = "SELECT * FROM pre_contribute WHERE Pre_Contribute_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Edit Pre-Contribution</h2>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="edit-form" enctype="multipart/form-data">
                    <input type="hidden" name="edit_pre_contribute_id" value="<?php echo htmlspecialchars($row['Pre_Contribute_ID']); ?>">
                    
                    <div class="detail-row">
                        <strong>ID:</strong> <?php echo htmlspecialchars($row['Pre_Contribute_ID']); ?>
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
                        <strong>Plant Name:</strong>
                        <input type="text" name="edit_plant_name" value="<?php echo htmlspecialchars($row['Plant_Name']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Scientific Name:</strong>
                        <input type="text" name="edit_scientific_name" value="<?php echo htmlspecialchars($row['Scientific_Name']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Description:</strong>
                        <textarea name="edit_description" required><?php echo htmlspecialchars($row['Description']); ?></textarea>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Category:</strong>
                        <input type="text" name="edit_category" value="<?php echo htmlspecialchars($row['Category']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Current Image:</strong><br>
                        <img src="<?php echo htmlspecialchars($row['Image']); ?>" alt="Current Plant Image" style="max-width: 200px; margin-top: 10px;">
                    </div>
                    
                    <div class="detail-row">
                        <strong>New Image:</strong>
                        <input type="file" name="edit_image">
                    </div>
                    
                    <div class="detail-row">
                        <strong>Status:</strong>
                        <select name="edit_status" required>
                            <option value="Pending" <?php echo $row['Status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Approved" <?php echo $row['Status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                            <option value="Rejected" <?php echo $row['Status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" name="update_pre_contribute" class="save-button">Save Changes</button>
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
if (isset($_POST['update_pre_contribute'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $id = mysqli_real_escape_string($conn, $_POST['edit_pre_contribute_id']);
    $register_id = mysqli_real_escape_string($conn, $_POST['edit_register_id']);
    $username = mysqli_real_escape_string($conn, $_POST['edit_username']);
    $plant_name = mysqli_real_escape_string($conn, $_POST['edit_plant_name']);
    $scientific_name = mysqli_real_escape_string($conn, $_POST['edit_scientific_name']);
    $description = mysqli_real_escape_string($conn, $_POST['edit_description']);
    $category = mysqli_real_escape_string($conn, $_POST['edit_category']);
    $status = mysqli_real_escape_string($conn, $_POST['edit_status']);
    
    // Handle image upload if a new image was provided
    if (!empty($_FILES['edit_image']['name'])) {
        $target_dir = "../uploads/";
        $file_extension = strtolower(pathinfo($_FILES["edit_image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["edit_image"]["tmp_name"], $target_file)) {
            $image_path = "uploads/" . $new_filename;
            
            $sql = "UPDATE pre_contribute SET Register_ID=?, Username=?, Plant_Name=?, Scientific_Name=?, Description=?, Category=?, Image=?, Status=? WHERE Pre_Contribute_ID=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "isssssssi", $register_id, $username, $plant_name, $scientific_name, $description, $category, $image_path, $status, $id);
        } else {
            $_SESSION['message'] = 'Error uploading image';
            header("Location: view_pre_contribute.php");
            exit();
        }
    } else {
        // No new image, update without changing the image
        $sql = "UPDATE pre_contribute SET Register_ID=?, Username=?, Plant_Name=?, Scientific_Name=?, Description=?, Category=?, Status=? WHERE Pre_Contribute_ID=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "issssssi", $register_id, $username, $plant_name, $scientific_name, $description, $category, $status, $id);
    }
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Record updated successfully';
    } else {
        $_SESSION['message'] = 'Error updating record: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    header("Location: view_pre_contribute.php");
    exit();
}

// Handle deletion
if (isset($_POST['delete_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    
    // Get the image path before deleting the record
    $sql = "SELECT Image FROM pre_contribute WHERE Pre_Contribute_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    $sql = "DELETE FROM pre_contribute WHERE Pre_Contribute_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        // Delete the image file if it exists
        if ($row && isset($row['Image'])) {
            $image_path = "../" . $row['Image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $_SESSION['message'] = 'Record deleted successfully';
    } else {
        $_SESSION['message'] = 'Error deleting record: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    header("Location: view_pre_contribute.php");
    exit();
}
?>
</body>
</html>