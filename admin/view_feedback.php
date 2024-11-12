<?php
    session_start();
    include('../database/connection.php');
    include('../database/database.php');

    // Create database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get feedback statistics
    $feedbackStats = array_fill(1, 5, 0);
    $totalFeedback = 0;

    $query = "SELECT Feedback_Mark, COUNT(*) as count FROM Feedback GROUP BY Feedback_Mark ORDER BY Feedback_Mark";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $feedbackStats[$row['Feedback_Mark']] = $row['count'];
        $totalFeedback += $row['count'];
    }

    // Calculate percentages
    $feedbackPercentages = array();
    for ($i = 1; $i <= 5; $i++) {
        $feedbackPercentages[$i] = $totalFeedback > 0 ? ($feedbackStats[$i] / $totalFeedback) * 100 : 0;
    }

    // Keep the connection open for any other database operations you need
    // Only close it at the very end of the file
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
                <li><a href="view_comments.php"><img src="../images/comments_icon.png" alt="comments" class="comments-sidebar-icon"><span>Comments</span></a></li>
                <li><a href="view_feedback.php" class="active"><img src="../images/feedback_icon.png" alt="feedback" class="feedback-sidebar-icon"><span>Feedback</span></a></li>
                <label for='logoutCheckbox' class='admin-logout-button'>Logout</label>
            </ul>
        </div>
    </div>

    
    <div class="main-content">
        <header class="admin-header">
            <h2 class="admin-header-text">
                Feedback
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
        
        <div class="feedback-chart-container">
            <h3>User Feedback Distribution</h3>
            <div class="feedback-chart">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <div class="chart-row">
                        <div class="star-label"><?php echo $i; ?> ★</div>
                        <div class="bar-container">
                            <div class="bar" style="width: <?php echo $feedbackPercentages[$i]; ?>%">
                                <span class="bar-value">
                                    <?php echo $feedbackStats[$i]; ?> user<?php echo $feedbackStats[$i] !== 1 ? 's' : ''; ?>
                                    (<?php echo number_format($feedbackPercentages[$i], 1); ?>%)
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="feedback-summary">
                <p>Total Feedback Received: <?php echo $totalFeedback; ?></p>
                <p>Last Updated: <?php echo date('Y-m-d H:i:s'); ?></p>
            </div>
        </div>

        <!-- Original feedback table can go here -->
    </div>

    <!-- ... rest of your HTML ... -->

<?php
    // Close the connection at the very end of the file
    mysqli_close($conn);
?>
</html>