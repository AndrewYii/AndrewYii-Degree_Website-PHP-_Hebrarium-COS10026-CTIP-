<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Contributions"/>
    <meta name="keywords" content="Plant's Notebook, Contributions, Admin View"/>
    <title>Plant's Notebook | View Contributions</title>
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
    if (isset($_SESSION['message'])) {
        $messageClass = strpos($_SESSION['message'], 'Error') !== false ? 'error-message' : 'success-message';
        echo "<div class='admin-message {$messageClass}'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>

    <input type='checkbox' id='logoutCheckbox'>
    <div class='logout-background'>
        <div class='logout-content'>
            <p>Are you sure you want to log out?</p>
            <a href='../logout.php' class='confirm-logout'>Yes</a>
            <label for='logoutCheckbox' class='cancel-logout'>No</label>
        </div>
    </div>

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
                <li><a href="view_contribute.php" class="active"><img src="../images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon"><span>Contribute</span></a></li>
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
                Contributions 
            </h2>

            <div class="search-wrapper">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="admin-search-form">
                    <input type="search" name="search" placeholder="Search by username">
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
                            <h3>Contributions Records</h3>
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
                                        <th>Username</th>
                                        <th>Plant Name</th>
                                        <th>Tag</th>
                                        <th>Picture Option</th>
                                        <th>Plant Family</th>
                                        <th>Plant Genus</th>
                                        <th>Plant Species</th>
                                        <th>Description</th>
                                        <th>Leaf Image</th>
                                        <th>Herbarium Image</th>
                                        <th>Date Submitted</th>
                                        <th class="admin-delete-option">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $conn = mysqli_connect($servername,$username,$password,$dbname);
                                
                                $sql = "SELECT * FROM contribute";
                                
                                if(isset($_POST['search']) && !empty($_POST['search'])) {
                                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                                    $sql .= " WHERE Username LIKE '%$search%'";
                                }
                                
                                $sql .= " ORDER BY Contribute_Created_At DESC";
                                
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row["Contribute_ID"]; ?></td>
                                            <td><?php echo $row["Username"]; ?></td>
                                            <td><?php echo $row["Plant_Name"]; ?></td>
                                            <td><?php echo $row["Tag"]; ?></td>
                                            <td><?php echo $row["Picture_Option"]; ?></td>
                                            <td><?php echo $row["Plant_Family"]; ?></td>
                                            <td><?php echo $row["Plant_Genus"]; ?></td>
                                            <td><?php echo $row["Plant_Species"]; ?></td>
                                            <td class="description-column"><?php echo $row["Description_Contribute"]; ?></td>
                                            <td><?php echo $row["Plant_Leaf_Photo"]; ?></td>
                                            <td><?php echo $row["Plant_Herbarium_Photo"]; ?></td>
                                            <td><?php echo $row["Contribute_Created_At"]; ?></td>
                                            <td>
                                                <input type="checkbox" id="toggle-<?php echo $row['Contribute_ID']; ?>" class="toggle-checkbox">
                                                <label for="toggle-<?php echo $row['Contribute_ID']; ?>" class="kebab-menu-icon">
                                                    <img src="../images/kebab-menu.webp" alt="kebab menu" class="kebab-menu-icon">
                                                </label>
                                                <div class="menu-content">
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                    <input type="hidden" name="view_id" value="<?php echo $row['Contribute_ID']; ?>">
                                                    <button type="submit" class="admin-view-button menu-button">View</button>
                                                </form>
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                    <input type="hidden" name="edit_id" value="<?php echo $row['Contribute_ID']; ?>">
                                                    <button type="submit" class="admin-edit-button menu-button">Edit</button>
                                                </form>
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                    <input type="hidden" name="id" value="<?php echo $row['Contribute_ID']; ?>">
                                                    <button type="submit" class="admin-delete-button menu-button">Delete</button>
                                                </form>
                                            </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No contributions records found</td></tr>";
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
        include '../database/connection.php';
        include '../database/database.php';

        if (isset($_POST['confirm_delete'])) {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            $id = $_POST['id'];
            
            $sql = "DELETE FROM contribute WHERE Contribute_ID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = 'Record deleted successfully';
                echo"<meta http-equiv='refresh' content='0 ;url=view_contribute.php'>";  
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
    $sql = "SELECT * FROM contribute WHERE Contribute_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Contribution Details</h2>
                </div>
                <div class="detail-row">
                    <strong>ID:</strong> <?php echo htmlspecialchars($row['Contribute_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Username:</strong> <?php echo htmlspecialchars($row['Username']); ?>
                </div>
                <div class="detail-row">
                    <strong>Plant Name:</strong> <?php echo htmlspecialchars($row['Plant_Name']); ?>
                </div>
                <div class="detail-row">
                    <strong>Tag:</strong> <?php echo htmlspecialchars($row['Tag']); ?>
                </div>
                <div class="detail-row">
                    <strong>Picture Option:</strong> <?php echo htmlspecialchars($row['Picture_Option']); ?>
                </div>
                <div class="detail-row">
                    <strong>Plant Family:</strong> <?php echo htmlspecialchars($row['Plant_Family']); ?>
                </div>
                <div class="detail-row">
                    <strong>Plant Genus:</strong> <?php echo htmlspecialchars($row['Plant_Genus']); ?>
                </div>
                <div class="detail-row">
                    <strong>Plant Species:</strong> <?php echo htmlspecialchars($row['Plant_Species']); ?>
                </div>
                <div class="detail-row">
                    <strong>Description:</strong> <?php echo htmlspecialchars($row['Description_Contribute']); ?>
                </div>
                <div class="detail-row">
                    <strong>Leaf Image:</strong> <?php echo htmlspecialchars($row['Plant_Leaf_Photo']); ?>
                </div>
                <div class="detail-row">
                    <strong>Herbarium Image:</strong> <?php echo htmlspecialchars($row['Plant_Herbarium_Photo']); ?>
                </div>
                <div class="detail-row">
                    <strong>Date Submitted:</strong> <?php echo htmlspecialchars($row['Contribute_Created_At']); ?>
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
    $sql = "SELECT * FROM contribute WHERE Contribute_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Edit Contribution Details</h2>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="edit-form">
                    <input type="hidden" name="edit_contribute_id" value="<?php echo htmlspecialchars($row['Contribute_ID']); ?>">
                    
                    <div class="detail-row">
                        <strong>ID:</strong> <?php echo htmlspecialchars($row['Contribute_ID']); ?>
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
                        <strong>Tag:</strong>
                        <input type="text" name="edit_tag" value="<?php echo htmlspecialchars($row['Tag']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Picture Option:</strong>
                        <input type="text" name="edit_picture_option" value="<?php echo htmlspecialchars($row['Picture_Option']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Plant Family:</strong>
                        <input type="text" name="edit_plant_family" value="<?php echo htmlspecialchars($row['Plant_Family']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Plant Genus:</strong>
                        <input type="text" name="edit_plant_genus" value="<?php echo htmlspecialchars($row['Plant_Genus']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Plant Species:</strong>
                        <input type="text" name="edit_plant_species" value="<?php echo htmlspecialchars($row['Plant_Species']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Description:</strong>
                        <textarea name="edit_description_contribute" required><?php echo htmlspecialchars($row['Description_Contribute']); ?></textarea>
                    </div>

                    <div class="detail-row">
                        <strong>Plant Leaf Photo:</strong>
                        <input type="text" name="edit_plant_leaf_photo" value="<?php echo htmlspecialchars($row['Plant_Leaf_Photo']); ?>" required>
                    </div>

                    <div class="detail-row">
                        <strong>Plant Herbarium Photo:</strong>
                        <input type="text" name="edit_plant_herbarium_photo" value="<?php echo htmlspecialchars($row['Plant_Herbarium_Photo']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Date:</strong> <?php echo htmlspecialchars($row['Contribute_Created_At']); ?>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" name="update_contribute" class="save-button">Save Changes</button>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="cancel-button">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
    mysqli_close($conn);
}

// Update the form submission handler
if (isset($_POST['update_contribute'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $id = mysqli_real_escape_string($conn, $_POST['edit_contribute_id']);
    $username = mysqli_real_escape_string($conn, $_POST['edit_username']);
    $plant_name = mysqli_real_escape_string($conn, $_POST['edit_plant_name']);
    $tag = mysqli_real_escape_string($conn, $_POST['edit_tag']);
    $picture_option = mysqli_real_escape_string($conn, $_POST['edit_picture_option']);
    $plant_family = mysqli_real_escape_string($conn, $_POST['edit_plant_family']);
    $plant_genus = mysqli_real_escape_string($conn, $_POST['edit_plant_genus']);
    $plant_species = mysqli_real_escape_string($conn, $_POST['edit_plant_species']);
    $description_contribute = mysqli_real_escape_string($conn, $_POST['edit_description_contribute']);
    $plant_leaf_photo = mysqli_real_escape_string($conn, $_POST['edit_plant_leaf_photo']);
    $plant_herbarium_photo = mysqli_real_escape_string($conn, $_POST['edit_plant_herbarium_photo']);
    
    $sql = "UPDATE contribute SET Username=?, Plant_Name=?, Tag=?, Picture_Option=?, Plant_Family=?, 
            Plant_Genus=?, Plant_Species=?, Description_Contribute=?, Plant_Leaf_Photo=?, Plant_Herbarium_Photo=? 
            WHERE Contribute_ID=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssssi", $username, $plant_name, $tag, $picture_option, $plant_family, 
                          $plant_genus, $plant_species, $description_contribute, $plant_leaf_photo, $plant_herbarium_photo, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Record updated successfully';
    } else {
        $_SESSION['message'] = 'Error updating record: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    echo "<meta http-equiv='refresh' content='0;url=view_contribute.php'>";
    exit();
}
?>
</body>
</html>