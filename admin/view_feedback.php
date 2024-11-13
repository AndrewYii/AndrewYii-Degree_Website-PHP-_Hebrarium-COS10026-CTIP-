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

        if (isset($_SESSION['register_search']) && !empty($_SESSION['register_search'])) {
            $search = $_SESSION['register_search'];
            $sql = "SELECT * FROM Register WHERE Username LIKE '%$search%' ORDER BY Register_Created_At DESC";
        } else {
            $sql = "SELECT * FROM Register ORDER BY Register_Created_At DESC";
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
                <h2>Registered Users</h2>
            </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Date Registered</th>
                </tr>';

        // Generate table rows
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $html .= "<tr>
                            <td>{$row['Register_ID']}</td>
                            <td>{$row['Name']}</td>
                            <td>{$row['Username']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['Register_Created_At']}</td>
                        </tr>";
            }
        } else {
            $html .= "<tr><td colspan='5'>No registration records found</td></tr>";
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
        header('Content-Disposition: attachment; filename="Register_Report.pdf"');
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