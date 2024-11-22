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

        if (isset($_SESSION['login_search']) && !empty($_SESSION['login_search'])) {
            $search = $_SESSION['login_search'];
            $sql = "SELECT * FROM login WHERE Username LIKE '%$search%' ORDER BY Login_At DESC";
        } else {
            $sql = "SELECT * FROM login ORDER BY Login_At DESC";
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
                .header img {
                    width: 50px;
                    height: auto;
                    margin-right: 10px;
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
                <h2>Login Records</h2>
            </div>
            <table>
                <tr>
                    <th>Login ID</th>
                    <th>Register ID</th>
                    <th>Username</th>
                    <th>Login At</th>
                    <th>Logout At</th>
                </tr>';

        // Generate table rows for login records
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $html .= "<tr>
                            <td>{$row['Login_ID']}</td>
                            <td>{$row['Register_ID']}</td>
                            <td>{$row['Username']}</td>
                            <td>{$row['Login_At']}</td>
                            <td>" . (isset($row['Logout_At']) && $row['Logout_At'] ? $row['Logout_At'] : 'Still Logged In') . "</td>
                        </tr>";
            }
        } else {
            $html .= "<tr><td colspan='5'>No login records found</td></tr>";
        }

        $html .= '</table>
        </body>
        </html>';

        mysqli_close($conn);

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="Login_Report.pdf"');
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
    <meta name="description" content="View Plant's Notebook Login Records"/>
    <meta name="keywords" content="Plant's Notebook, Login Records, Admin View"/>
    <title>Plant's Notebook | View Login Records</title>
    <meta name="author" content=" Muhammad Faiz bin Halek"  />
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
</head>

<body>
    <?php 
    include ('../database/connection.php');
    include ('../database/database.php');

    if ($_SESSION['username'] != 'admin') {
        header('Location: ../index.php'); 
        exit();
    }

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
                <li><a href="view_register.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/register_icon.png" alt="Register" class="register-sidebar-icon"><span>Register</span></div></a></li>
                <li><a href="view_login.php" class="active"><img src="../images/login_icon.png" alt="Login" class="login-sidebar-icon-main"><span>Login</span></a></li>
                <li><a href="view_contribute.php" class="admin-register-link"><img src="../images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon"><span>Contribute</span></a></li>
                <li><a href="view_enquiry.php" class="admin-register-link"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></a></li>
                <li><a href="view_pre_contribute.php" class="admin-register-link"><img src="../images/pre_contribute_icon.png" alt="pre-contribute" class="pre-contribute-sidebar-icon"><span>Pre-Contribute</span></a></li>
                <li><a href="view_comments.php" class="admin-register-link"><img src="../images/comments_icon.png" alt="comments" class="comments-sidebar-icon"><span>Comments</span></a></li>
                <li><a href="view_feedback.php" class="admin-register-link"><img src="../images/feedback_icon.png" alt="feedback" class="feedback-sidebar-icon"><span>Feedback</span></a></li>
                <label for='logoutCheckbox' class='admin-logout-button'>Logout</label>
                <label for='logoutCheckbox'><img src="../images/logout-icon.png" alt="Logout" class="admin-logout-icon"Logout></label>
            </ul>
        </div>
    </div>

    <div class="main-content-login">
        <header class="admin-header">
            <h2 class="admin-header-text">
                Login 
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
                            <h3>Login Records</h3>
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
                                        <th>Register ID</th>
                                        <th>Username</th>
                                        <th>Login At</th>
                                        <th>Logout At</th>
                                        <th class="admin-delete-option">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $conn = mysqli_connect($servername,$username,$password,$dbname);

                                $_SESSION['login_search'] = '';
                                
                                if(isset($_POST['search']) && !empty($_POST['search'])) {
                                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                                    $sql = "SELECT * FROM login WHERE Username LIKE '%$search%' ORDER BY Login_At DESC";
                                    $_SESSION['login_search'] = $search;
                                } else {
                                    $sql = "SELECT * FROM login ORDER BY Login_At DESC";
                                }
                                
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