<?php
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

        // SQL query to fetch comments
        $sql = "SELECT * FROM contribute_comments ORDER BY Comment_Created_At DESC";
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
                <h2>Comment Records</h2>
            </div>
            <table>
                <tr>
                    <th>Comment ID</th>
                    <th>Contribute ID</th>
                    <th>Username</th>
                    <th>Comment</th>
                    <th>Date Submitted</th>
                </tr>';

        // Generate table rows for comments
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $html .= "<tr>
                            <td>{$row['Comment_ID']}</td>
                            <td>{$row['Contribute_ID']}</td>
                            <td>{$row['Commenter_Username']}</td>
                            <td>{$row['Comment_Text']}</td>
                            <td>{$row['Comment_Created_At']}</td>
                        </tr>";
            }
        } else {
            $html .= "<tr><td colspan='5'>No comment records found</td></tr>";
        }

        $html .= '</table>
        </body>
        </html>';

        mysqli_close($conn);

        $dompdf->loadHtml($html, 'UTF-8');

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream("Comments_Report.pdf", ["Attachment" => true]);
        exit();
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Comments"/>
    <meta name="keywords" content="Plant's Notebook, Comments, Admin View"/>
    <title>Plant's Notebook | View Comments</title>
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
                <li><a href="view_contribute.php"><img src="../images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon"><span>Contribute</span></a></li>
                <li><a href="view_enquiry.php"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></a></li>
                <li><a href="view_pre_contribute.php"><img src="../images/pre_contribute_icon.png" alt="pre-contribute" class="pre-contribute-sidebar-icon"><span>Pre-Contribute</span></a></li>
                <li><a href="view_comments.php" class="active"><img src="../images/comments_icon.png" alt="comments" class="comments-sidebar-icon"><span>Comments</span></a></li>
                <label for='logoutCheckbox' class='admin-logout-button'>Logout</label>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header class="admin-header">
            <h2 class="admin-header-text">
                Comments
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
                            <h3>Comment Records</h3>
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
                                        <th>Comment ID</th>
                                        <th>Contribute ID</th>
                                        <th>Username</th>
                                        <th>Comment</th>
                                        <th>Date Submitted</th>
                                        <th class="admin-delete-option">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                                    
                                    if(isset($_POST['search']) && !empty($_POST['search'])) {
                                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                                        $sql = "SELECT * FROM contribute_comments WHERE Commenter_Username LIKE '%$search%' ORDER BY Comment_Created_At DESC";
                                    } else {
                                        $sql = "SELECT * FROM contribute_comments ORDER BY Comment_Created_At DESC";
                                    }
                                    
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['Comment_ID']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Contribute_ID']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Commenter_Username']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Comment_Text']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Comment_Created_At']); ?></td>
                                                <td>
                                                    <label class="menu-label">
                                                        <input type="checkbox" class="toggle-checkbox">
                                                        <img src="../images/kebab-menu.webp" alt="menu" class="kebab-menu-icon">
                                                        <div class="menu-content">
                                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                                <input type="hidden" name="view_id" value="<?php echo $row['Comment_ID']; ?>">
                                                                <button type="submit" class="admin-view-button menu-button">View</button>
                                                            </form>
                                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                                <input type="hidden" name="edit_id" value="<?php echo $row['Comment_ID']; ?>">
                                                                <button type="submit" class="admin-edit-button menu-button">Edit</button>
                                                            </form>
                                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                                <input type="hidden" name="id" value="<?php echo $row['Comment_ID']; ?>">
                                                                <button type="submit" class="admin-delete-button menu-button">Delete</button>
                                                            </form>
                                                        </div>
                                                    </label>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No comments found</td></tr>";
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
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
    $sql = "SELECT * FROM contribute_comments WHERE Comment_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Comment Details</h2>
                </div>
                <div class="detail-row">
                    <strong>Comment ID:</strong> <?php echo htmlspecialchars($row['Comment_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Contribute ID:</strong> <?php echo htmlspecialchars($row['Contribute_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Username:</strong> <?php echo htmlspecialchars($row['Commenter_Username']); ?>
                </div>
                <div class="detail-row">
                    <strong>Comment:</strong> <?php echo htmlspecialchars($row['Comment_Text']); ?>
                </div>
                <div class="detail-row">
                    <strong>Date Submitted:</strong> <?php echo htmlspecialchars($row['Comment_Created_At']); ?>
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
    $sql = "SELECT * FROM contribute_comments WHERE Comment_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Edit Comment</h2>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="edit-form">
                    <input type="hidden" name="edit_comment_id" value="<?php echo htmlspecialchars($row['Comment_ID']); ?>">
                    
                    <div class="detail-row">
                        <strong>ID:</strong> <?php echo htmlspecialchars($row['Comment_ID']); ?>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Contribute ID:</strong>
                        <input type="text" name="edit_contribute_id" value="<?php echo htmlspecialchars($row['Contribute_ID']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Username:</strong>
                        <input type="text" name="edit_username" value="<?php echo htmlspecialchars($row['Commenter_Username']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Comment:</strong>
                        <textarea name="edit_comment" required><?php echo htmlspecialchars($row['Comment_Text']); ?></textarea>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Date Submitted:</strong>
                        <input type="text" name="edit_created_at" value="<?php echo htmlspecialchars($row['Comment_Created_At']); ?>" readonly>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" name="update_comment" class="save-button">Save Changes</button>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="cancel-button">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
    mysqli_close($conn);
}

// Handle Update
if (isset($_POST['update_comment'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $comment_id = mysqli_real_escape_string($conn, $_POST['edit_comment_id']);
    $contribute_id = mysqli_real_escape_string($conn, $_POST['edit_contribute_id']);
    $commenter_username = mysqli_real_escape_string($conn, $_POST['edit_username']);
    $comment_text = mysqli_real_escape_string($conn, $_POST['edit_comment']);
    
    $sql = "UPDATE contribute_comments SET Contribute_ID=?, Commenter_Username=?, Comment_Text=? WHERE Comment_ID=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issi", $contribute_id, $commenter_username, $comment_text, $comment_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Comment updated successfully';
        echo "<meta http-equiv='refresh' content='0;url=view_comments.php'>";
    } else {
        $_SESSION['message'] = 'Error updating comment: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit();
}

// Handle the form submission for deletion
if (isset($_POST['confirm_delete'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    
    $sql = "DELETE FROM contribute_comments WHERE Comment_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Comment deleted successfully';
        echo "<meta http-equiv='refresh' content='0;url=view_comments.php'>";
    } else {
        $_SESSION['message'] = 'Error deleting comment: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit();
}

// Show confirmation dialog when delete is clicked
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    ?>
    <div class="modal-overlay">
        <div class="confirmation-box">
            <h2>Are you sure you want to delete this comment?</h2>
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
</body>
</html>