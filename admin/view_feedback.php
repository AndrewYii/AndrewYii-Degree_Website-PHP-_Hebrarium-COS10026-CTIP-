<?php
    session_start();
    include('../database/connection.php');
    include('../database/database.php');
?>

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
        if ($_SESSION['username'] != 'admin') {
            header('Location: ../index.php'); 
            exit();
        }
    ?>

    <?php
    // Check if there's a message in the session
    if (isset($_SESSION['message'])) {
        $messageClass = strpos($_SESSION['message'], 'Error') !== false ? 'error-message' : 'success-message';
        echo "<div class='admin-message {$messageClass}'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Clear the message from session after displaying it
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
                <li><a href="view_login.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/login_icon.png" alt="Login" class="login-sidebar-icon"><span>Login</span></div></a></li>
                <li><a href="view_contribute.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon-main"><span>Contribute</span></div></a></li>
                <li><a href="view_enquiry.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></div></a></li>
                <li><a href="view_pre_contribute.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/pre_contribute_icon.png" alt="pre-contribute" class="pre-contribute-sidebar-icon"><span>Pre-Contribute</span></div></a></li>
                <li><a href="view_comments.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/comments_icon.png" alt="comments" class="comments-sidebar-icon"><span>Comments</span></div></a></li>
                <li><a href="view_feedback.php" class="active"><img src="../images/feedback_icon.png" alt="feedback" class="feedback-sidebar-icon"><span>Feedback</span></a></li>
                <label for='logoutCheckbox' class='admin-logout-button'>logout</label>
                <label for='logoutCheckbox'><img src="../images/logout-icon.png" alt="Logout" class="admin-logout-icon"Logout></label>
            </ul>
        </div>
    </div>

    
    <div class="main-content">
        <header class="admin-header">
            <h2 class="admin-header-text">
                Feedback
            </h2>

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

                        <div class="card-body">
                            <div class="rating-distribution">
                                <?php
                                // Establish database connection
                                include('../database/connection.php');
                                $conn = mysqli_connect($servername, $username, $password, $dbname);

                                // Check connection
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                // Get rating counts from database
                                $ratings = array(
                                    5 => array('label' => 'Very Good', 'count' => 0),
                                    4 => array('label' => 'Good', 'count' => 0),
                                    3 => array('label' => 'Average', 'count' => 0),
                                    2 => array('label' => 'Below Average', 'count' => 0),
                                    1 => array('label' => 'Poor', 'count' => 0)
                                );
                                $total = 0;
                                
                                $sql = "SELECT 
                                    Feedback_Mark, 
                                    COUNT(*) as count,
                                    MAX(Feedback_Created_At) as latest_feedback 
                                FROM Feedback 
                                GROUP BY Feedback_Mark 
                                ORDER BY Feedback_Mark DESC";
                                $result = mysqli_query($conn, $sql);
                                $latest_update = null;

                                if ($result) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $ratings[$row['Feedback_Mark']]['count'] = $row['count'];
                                        $total += $row['count'];
                                        // Keep track of the latest feedback timestamp
                                        if ($latest_update === null || strtotime($row['latest_feedback']) > strtotime($latest_update)) {
                                            $latest_update = $row['latest_feedback'];
                                        }
                                    }
                                }

                                // Display rating bars
                                foreach($ratings as $score => $data) {
                                    $percentage = $total > 0 ? ($data['count'] / $total) * 100 : 0;
                                    ?>
                                    <div class="rating-row">
                                        <div class="rating-label"><?php echo $data['label']; ?></div>
                                        <div class="rating-bar">
                                            <div class="rating-fill" style="width: <?php echo $percentage; ?>%">
                                                <?php if($data['count'] > 0) echo $data['count'] . " users (" . number_format($percentage, 1) . "%)"; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                
                                <div class="rating-summary">
                                    Total Feedback Received: <?php echo $total; ?><br>
                                    Last Updated: <?php echo $latest_update ? date('d-m-Y H:i:s', strtotime($latest_update)) : 'No feedback yet'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>