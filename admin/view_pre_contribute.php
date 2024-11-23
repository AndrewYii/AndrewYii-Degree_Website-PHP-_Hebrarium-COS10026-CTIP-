<?php
    session_start();
    include('../database/connection.php');
    include('../database/database.php');

    require '../Dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;

    // Dompdf options
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('isFontSubsettingEnabled', true);
    $dompdf = new Dompdf($options);

    if (isset($_POST['generate_pdf'])) {

        include('../database/connection.php');
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (isset($_SESSION['precontribute_search']) && !empty($_SESSION['precontribute_search'])) {
            $search = $_SESSION['precontribute_search'];
            $sql = "SELECT * FROM Pre_Contribute WHERE Username LIKE '%$search%' ORDER BY Contribute_Created_At DESC";
        } else {
            $sql = "SELECT * FROM Pre_Contribute ORDER BY Contribute_Created_At DESC";
        }

        $result = mysqli_query($conn, $sql);
        
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; font-size: 10px; }
                .header {
                    text-align: center;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 20px;
                }
                .header h2 {
                    font-size: 16px;
                    color: #4CAF50;
                    margin: 0;
                }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { padding: 5px; text-align: left; border: 1px solid #ddd; }
                th { background-color: #4CAF50; color: white; font-size: 10px; }
                td { font-size: 9px; }
            </style>
        </head>
        <body>
            <div class="header">
                <h2>Pre-Contribution Records</h2>
            </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Plant Name</th>
                    <th>Tag</th>
                    <th>Family</th>
                    <th>Genus</th>
                    <th>Species</th>
                    <th>Description</th>
                    <th>Date Submitted</th>
                </tr>';

        // Generate table rows
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $html .= "<tr>
                            <td>{$row['Pre_Contribute_ID']}</td>
                            <td>{$row['Username']}</td>
                            <td>{$row['Plant_Name']}</td>
                            <td>{$row['Tag']}</td>
                            <td>{$row['Plant_Family']}</td>
                            <td>{$row['Plant_Genus']}</td>
                            <td>{$row['Plant_Species']}</td>
                            <td>{$row['Description_Contribute']}</td>
                            <td>{$row['Contribute_Created_At']}</td>
                        </tr>";
            }
        } else {
            $html .= "<tr><td colspan='12'>No pre-contribution records found</td></tr>";
        }

        $html .= '</table>
        </body>
        </html>';

        // Close the database connection
        mysqli_close($conn);

        // Load HTML into Dompdf
        $dompdf->loadHtml($html, 'UTF-8');

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="Pre_Contribute_Report.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Output the generated PDF
        echo $dompdf->output();

        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Pre-Contributions"/>
    <meta name="keywords" content="Plant's Notebook, Pre-Contributions, Admin View"/>
    <title>Plant's Notebook | View Pre-Contributions</title>
    <meta name="author" content=" Muhammad Faiz bin Halek"  />
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
</head>

<body>
    <?php 
    if ($_SESSION['username'] != 'admin') {
        header('Location: ../index.php'); 
        exit();
    }
    
    // Check if there's a message in the session
    if (isset($_SESSION['message'])) {
        $messageClass = strpos($_SESSION['message'], 'Error') !== false ? 'error-message' : 'success-message';
        echo "<div class='admin-message {$messageClass}'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Clear the message from session after displaying it
    }
    ?>

    <!-- Moved logout HTML here -->
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
            <li><a href="view_register.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/register_icon.png" alt="Register" class="register-sidebar-icon"><span>Register</span></div></a></li>
                <li><a href="view_login.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/login_icon.png" alt="Login" class="login-sidebar-icon"><span>Login</span></div></a></li>
                <li><a href="view_contribute.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon-main"><span>Contribute</span></div></a></li>
                <li><a href="view_enquiry.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></div></a></li>
                <li><a href="view_pre_contribute.php" class="active"><img src="../images/pre_contribute_icon.png" alt="pre-contribute" class="pre-contribute-sidebar-icon"><span>Pre-Contribute</span></a></li>
                <li><a href="view_comments.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/comments_icon.png" alt="comments" class="comments-sidebar-icon"><span>Comments</span></div></a></li>
                <li><a href="view_feedback.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/feedback_icon.png" alt="feedback" class="feedback-sidebar-icon"><span>Feedback</span></div></a></li>
                <label for='logoutCheckbox' class='admin-logout-button'>Logout</label>
                <label for='logoutCheckbox'><img src="../images/logout-icon.png" alt="Logout" class="admin-logout-icon"Logout></label>
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
                            <h3>Pre-Contribution Records</h3>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <button class="admin-print-button" name="generate_pdf">Print</button>
                            </form>
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
                                        <th>Created At</th>
                                        <th class="admin-delete-option">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $conn = mysqli_connect($servername, $username, $password, $dbname);

                                $_SESSION['precontribute_search'] = '';
                                
                                // Check if search was submitted
                                if(isset($_POST['search']) && !empty($_POST['search'])) {
                                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                                    $sql = "SELECT * FROM pre_contribute WHERE Username LIKE '%$search%' ORDER BY Contribute_Created_At DESC";
                                    $_SESSION['precontribute_search'] = $search;
                                } else {
                                    $sql = "SELECT * FROM pre_contribute ORDER BY Contribute_Created_At DESC";
                                }
                                
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['Pre_Contribute_ID']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Username']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Plant_Name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Tag']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Picture_Option']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Plant_Family']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Plant_Genus']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Plant_Species']); ?></td>
                                            <td class="description-column"><?php echo htmlspecialchars($row['Description_Contribute']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Plant_Leaf_Photo']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Plant_Herbarium_Photo']); ?></td>
                                            <td><?php echo isset($row['Contribute_Created_At']) ? htmlspecialchars($row['Contribute_Created_At']) : date('Y-m-d H:i:s'); ?></td>
                                            <td>
                                                <label class="menu-label">
                                                    <input type="checkbox" class="toggle-checkbox">
                                                    <img src="../images/kebab-menu.webp" alt="menu" class="kebab-menu-icon">
                                                    <div class="menu-content">
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                            <input type="hidden" name="view_id" value="<?php echo $row['Pre_Contribute_ID']; ?>">
                                                            <button type="submit" class="admin-view-button menu-button">View</button>
                                                        </form>
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                            <input type="hidden" name="edit_id" value="<?php echo $row['Pre_Contribute_ID']; ?>">
                                                            <button type="submit" class="admin-edit-button menu-button">Edit</button>
                                                        </form>
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                            <input type="hidden" name="accept_id" value="<?php echo $row['Pre_Contribute_ID']; ?>">
                                                            <button type="submit" class="admin-accept-button menu-button">Accept</button>
                                                        </form>
                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                            <input type="hidden" name="reject_id" value="<?php echo $row['Pre_Contribute_ID']; ?>">
                                                            <button type="submit" class="admin-reject-button menu-button">Reject</button>
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
                    <strong>Created At:</strong> <?php echo htmlspecialchars($row['Contribute_Created_At']); ?>
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
                        <strong>Username:</strong>
                        <input type="text" name="edit_username" value="<?php echo htmlspecialchars($row['Username']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Plant Name:</strong>
                        <input type="text" name="edit_picture_name" value="<?php echo htmlspecialchars($row['Plant_Name']); ?>" required>
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
                        <input type="text" name="edit_description" value="<?php echo htmlspecialchars($row['Description_Contribute']); ?>" required>
                    </div>

                    <div class="detail-row">
                        <strong>Leaf Image:</strong>
                        <input type="file" name="edit_plant_leaf_photo" value="<?php echo htmlspecialchars($row['Plant_Leaf_Photo']); ?>" required>
                    </div>

                    <div class="detail-row">
                        <strong>Herbarium Image:</strong>
                        <input type="file" name="edit_plant_herbarium_photo" value="<?php echo htmlspecialchars($row['Plant_Herbarium_Photo']); ?>" required>
                    </div>

                    <div class="detail-row">
                        <strong>Created At:</strong>
                        <input type="text" name="edit_created_at" value="<?php echo htmlspecialchars($row['Contribute_Created_At']); ?>" required>
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
    $username = mysqli_real_escape_string($conn, $_POST['edit_username']);
    $picture_option = mysqli_real_escape_string($conn, $_POST['edit_picture_option']);
    $tag = mysqli_real_escape_string($conn, $_POST['edit_tag']);
    $plant_name = mysqli_real_escape_string($conn, $_POST['edit_plant_name']);
    $plant_family = mysqli_real_escape_string($conn, $_POST['edit_plant_family']);
    $plant_genus = mysqli_real_escape_string($conn, $_POST['edit_plant_genus']);
    $plant_species = mysqli_real_escape_string($conn, $_POST['edit_plant_species']);
    $plant_leaf_photo = mysqli_real_escape_string($conn, $_POST['edit_plant_leaf_photo']);
    $plant_herbarium_photo = mysqli_real_escape_string($conn, $_POST['edit_plant_herbarium_photo']);
    $description_contribute = mysqli_real_escape_string($conn, $_POST['edit_description_contribute']);
    $status = mysqli_real_escape_string($conn, $_POST['edit_status']);
    
    // Handle image upload if a new image was provided
    if (!empty($_FILES['edit_image']['name'])) {
        $target_dir = "../uploads/";
        $file_extension = strtolower(pathinfo($_FILES["edit_image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["edit_image"]["tmp_name"], $target_file)) {
            $image_path = "uploads/" . $new_filename;
            
            $sql = "UPDATE pre_contribute SET Pre_Contribute_ID=?, Username=?, Picture_Option=?, Tag=?, Plant_Name=?, Plant_Family=?, Plant_Genus=?, Plant_Species=?, Plant_Leaf_Photo=?, Plant_Herbarium_Photo=?, Description_Contribute=?, Status=?, Contribute_Created_At=? WHERE Pre_Contribute_ID=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "isssssssssssi", $id, $username, $picture_option, $tag, $plant_name, $plant_family, $plant_genus, $plant_species, $plant_leaf_photo, $plant_herbarium_photo, $description_contribute, $status, $contribute_created_at, $id);
        } else {
            $_SESSION['message'] = 'Error uploading image';
            header("Location: view_pre_contribute.php");
            exit();
        }
    } else {
        // No new image, update without changing the image
        $sql = "UPDATE pre_contribute SET Pre_Contribute_ID=?, Username=?, Picture_Option=?, Tag=?, Plant_Name=?, Plant_Family=?, Plant_Genus=?, Plant_Species=?, Plant_Leaf_Photo=?, Plant_Herbarium_Photo=?, Description_Contribute=?, Status=?, Contribute_Created_At=? WHERE Pre_Contribute_ID=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "isssssssssssi", $id, $username, $picture_option, $tag, $plant_name, $plant_family, $plant_genus, $plant_species, $plant_leaf_photo, $plant_herbarium_photo, $description_contribute, $status, $contribute_created_at, $id);
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

// Handle Accept
if (isset($_POST['accept_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_POST['accept_id']);
    
    // First, get the pre_contribute record
    $sql = "SELECT * FROM pre_contribute WHERE Pre_Contribute_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        // Insert into contribute table
        $sql = "INSERT INTO contribute (Username, Picture_Option, Tag, Plant_Name, Plant_Family, 
                Plant_Genus, Plant_Species, Plant_Leaf_Photo, Plant_Herbarium_Photo, Description_Contribute) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssss", 
            $row['Username'],
            $row['Picture_Option'],
            $row['Tag'],
            $row['Plant_Name'],
            $row['Plant_Family'],
            $row['Plant_Genus'],
            $row['Plant_Species'],
            $row['Plant_Leaf_Photo'],
            $row['Plant_Herbarium_Photo'],
            $row['Description_Contribute']  // Changed from Description_Contributor
        );
        
        if (mysqli_stmt_execute($stmt)) {
            // Delete from pre_contribute
            $delete_sql = "DELETE FROM pre_contribute WHERE Pre_Contribute_ID = ?";
            $stmt = mysqli_prepare($conn, $delete_sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = 'Contribution accepted';
                echo "<meta http-equiv='refresh' content='0;url=view_pre_contribute.php'>";
            } else {
                $_SESSION['message'] = 'Error deleting from pre_contribute: ' . mysqli_error($conn);
                echo "<meta http-equiv='refresh' content='0;url=view_pre_contribute.php'>";
            }
        } else {
            $_SESSION['message'] = 'Error accepting contribution: ' . mysqli_error($conn);
            echo "<meta http-equiv='refresh' content='0;url=view_pre_contribute.php'>";
        }
    }
    
    mysqli_close($conn);
    exit();
}

// Handle Reject
if (isset($_POST['reject_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_POST['reject_id']);
    
    // Delete the record
    $sql = "DELETE FROM pre_contribute WHERE Pre_Contribute_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Contribution rejected and deleted';
        echo "<meta http-equiv='refresh' content='0;url=view_pre_contribute.php'>";
    } else {
        $_SESSION['message'] = 'Error rejecting contribution: ' . mysqli_error($conn);
        echo "<meta http-equiv='refresh' content='0;url=view_pre_contribute.php'>";
    }
    
    mysqli_close($conn);
    exit();
}
?>
</body>
</html>