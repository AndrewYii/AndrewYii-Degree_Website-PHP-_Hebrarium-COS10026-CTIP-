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

        // SQL query to fetch enquiry records

        if (isset($_SESSION['enquiry_search']) && !empty($_SESSION['enquiry_search'])) {
            $search = $_SESSION['enquiry_search'];
            $sql = "SELECT * FROM enquiry WHERE Name LIKE '%$search%' ORDER BY Enquiry_Created_At DESC";
        } else {
            $sql = "SELECT * FROM enquiry ORDER BY Enquiry_Created_At DESC";
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
                <h2>Enquiry Records</h2>
            </div>
            <table>
                <tr>
                    <th>Enquiry ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date Submitted</th>
                </tr>';

        // Generate table rows for enquiries
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $html .= "<tr>
                            <td>{$row['Enquiry_ID']}</td>
                            <td>{$row['Name']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['Subject']}</td>
                            <td>{$row['Message']}</td>
                            <td>{$row['Enquiry_Created_At']}</td>
                        </tr>";
            }
        } else {
            $html .= "<tr><td colspan='6'>No enquiry records found</td></tr>";
        }

        $html .= '</table>
        </body>
        </html>';

        mysqli_close($conn);

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="Enquiry_Report.pdf"');
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
    <meta name="description" content="View Plant's Notebook Enquiries"/>
    <meta name="keywords" content="Plant's Notebook, Enquiries, Admin View"/>
    <title>Plant's Notebook | View Enquiries</title>
    <meta name="author" content=" Muhammad Faiz bin Halek"  />
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
</head>

<body>
    <?php 

    if (isset($_SESSION['message'])) {
        $messageClass = strpos($_SESSION['message'], 'Error') !== false ? 'error-message' : 'success-message';
        echo "<div class='admin-message {$messageClass}'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Clear the message after displaying
    }
    ?>

    <?php
        if ($_SESSION['username'] != 'Admin') {
            header('Location: ../index.php'); 
            exit();
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
                <li><a href="view_enquiry.php" class="active"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></a></li>
                <li><a href="view_pre_contribute.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/pre_contribute_icon.png" alt="pre-contribute" class="pre-contribute-sidebar-icon"><span>Pre-Contribute</span></div></a></li>
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
                Enquiries
            </h2>

            <div class="search-wrapper">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="admin-search-form">
                    <input type="search" name="search" placeholder="Search by name">
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
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <button class="admin-print-button" name="generate_pdf">Print</button>
                            </form>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <button type="submit" name="refresh_table" form="status-form">Refresh</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th class="description-column">Message</th>
                                        <th class="admin-delete-option">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $conn = mysqli_connect($servername,$username,$password,$dbname);

                                $_SESSION['enquiry_search'] = ''; 
                                
                                // Check if search is submitted
                                if(isset($_POST['search']) && !empty($_POST['search'])) {
                                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                                    $sql = "SELECT * FROM enquiry WHERE Name LIKE '%$search%' ORDER BY Enquiry_Created_At DESC";
                                    $_SESSION['enquiry_search'] = $search; 
                                } else {
                                    $sql = "SELECT * FROM enquiry ORDER BY Enquiry_Created_At DESC";
                                }
                                
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <td>
                                        <?php
                                        $currentStatus = $row['Status'];
                                        if ($currentStatus == 'Unresolved') {
                                            echo '<div class="status-indicator red"></div>';
                                        } elseif ($currentStatus == 'Pending') {
                                            echo '<div class="status-indicator yellow"></div>';
                                        } elseif ($currentStatus == 'Solved') {
                                            echo '<div class="status-indicator green"></div>';
                                        }
                                        ?>
                                        </td>
                                        <td><?php echo $row["Enquiry_ID"]; ?></td>
                                        <td><?php 
                                        $currentStatus = $row['Status'];
                                        echo "<form class='status-form' action='".$_SERVER['PHP_SELF']."' id='status-form-".$row['Enquiry_ID']."' method='post'>
                                            <select name='Status' id='status-".$row['Enquiry_ID']."' class='status-select'>
                                                <option value='Unresolved' " . ($currentStatus == 'Unresolved' ? 'selected' : '') . " class='Unresolved'>Unresolved</option>
                                                <option value='Pending' " . ($currentStatus == 'Pending' ? 'selected' : '') . " class='Pending'>Pending</option>
                                                <option value='Solved' " . ($currentStatus == 'Solved' ? 'selected' : '') . " class='Solved'>Solved</option>
                                            </select>
                                            <input type='hidden' name='enquiry_id' value='{$row['Enquiry_ID']}'>
                                            <input type='submit' id='submit-status-".$row['Enquiry_ID']."' form='status-form-".$row['Enquiry_ID']."' value='Update'>
                                        </form>";

                                        if (isset($_POST['Status']) && isset($_POST['enquiry_id'])) {
                                            $newStatus = mysqli_real_escape_string($conn, $_POST['Status']);
                                            $enquiryId = mysqli_real_escape_string($conn, $_POST['enquiry_id']);
                                            
                                            $sql = "UPDATE enquiry SET Status = ? WHERE Enquiry_ID = ?";
                                            $stmt = mysqli_prepare($conn, $sql);
                                            mysqli_stmt_bind_param($stmt, "si", $newStatus, $enquiryId);
                                            
                                            if (mysqli_stmt_execute($stmt)) {
                                                $_SESSION['message'] = 'Status updated successfully';
                                                echo"<meta http-equiv='refresh' content='0 ;url=view_enquiry.php'>";  
                                            } else {
                                                $_SESSION['message'] = 'Error updating status: ' . mysqli_error($conn);
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                        ?></td>
                                        <td><?php echo $row["Name"]; ?></td>
                                        <td><?php echo $row["Email"]; ?></td>
                                        <td><?php echo $row["Subject"]; ?></td>
                                        <td class="description-column"><?php echo $row["Message"]; ?></td>
                                        <td>
                                            <input type="checkbox" id="toggle-<?php echo $row['Enquiry_ID']; ?>" class="toggle-checkbox">
                                            <label for="toggle-<?php echo $row['Enquiry_ID']; ?>" class="kebab-menu-icon">
                                                <img src="../images/kebab-menu.webp" alt="kebab menu" class="kebab-menu-icon">
                                            </label>
                                            <div class="menu-content">
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                <input type="hidden" name="update_id" value="<?php echo $row['Enquiry_ID']; ?>">
                                                <button type="submit" class="admin-update-button menu-button" form="status-form-<?php echo $row['Enquiry_ID']; ?>">Update Status</button>
                                            </form>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                <input type="hidden" name="view_id" value="<?php echo $row['Enquiry_ID']; ?>">
                                                <button type="submit" class="admin-view-button menu-button">View</button>
                                            </form>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['Enquiry_ID']; ?>">
                                                <button type="submit" class="admin-edit-button menu-button">Edit</button>
                                            </form>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                <input type="hidden" name="response_id" value="<?php echo $row['Enquiry_ID']; ?>">
                                                <button type="submit" class="admin-response-button menu-button">Response</button>
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
                            <br>
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

<?php
if (isset($_GET['response_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_GET['response_id']);
    $_SESSION['response-enquiry-id']=$id;
    $sql = "SELECT * FROM enquiry WHERE Enquiry_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Response Form</h2>
                </div>
                <div class="detail-row">
                    <?php  
                        $email = htmlspecialchars($row["Email"]);
                        $reference_comment = "comment_" . $row['Enquiry_ID'];
                        $email = $row["Email"]; // Create a unique name for the textarea
                        $response = $row["Response"];
                        echo "
                        <form class='Response-Form' method='post' action='".$_SERVER['PHP_SELF']."' id='Response-Form'>
                            <textarea placeholder='Enquiry Response' name='response' >$response</textarea>
                            <input type='submit'   name='response-submit' value='Upload Response'>
                        </form>";
                    ?>
                </div>
                <div class="response-bot-bar">
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="close-view-button">Close</a>
                    <?php echo "<a href='mailto:$email?subject=Response to Enquiry&body={$row['Response']}'' class='response-mail'>Send Email</a>";?>
                </div>
            </div>
        </div>
        <?php
        mysqli_close($conn);
    }
}
?>

<?php

    if (isset($_POST['response-submit'])) {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $response = mysqli_real_escape_string($conn, $_POST['response']);

        $sql = "UPDATE enquiry SET Response = ? WHERE Enquiry_ID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $response,  $_SESSION['response-enquiry-id']);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Response submitted successfully.";
        } else {
            $_SESSION['message'] = "Error submitting response: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        echo "<meta http-equiv='refresh' content='0;url=view_enquiry.php'>";

    }
?>

</body>
</html>