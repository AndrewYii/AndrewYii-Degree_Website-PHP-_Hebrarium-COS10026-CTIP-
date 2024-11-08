<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Login Records"/>
    <meta name="keywords" content="Plant's Notebook, Login Records, Admin View"/>
    <title>Plant's Notebook | View Login Records</title>
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
        // Display the message
        echo "<p>" . $_SESSION['message'] . "</p>";
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
                <li><a href="view_login.php" class="active"><img src="../images/login_icon.png" alt="Login" class="login-sidebar-icon"><span>Login</span></a></li>
                <li><a href="view_contribute.php"><img src="../images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon"><span>Contribute</span></a></li>
                <li><a href="view_enquiry.php"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></a></li>
                <label for='logoutCheckbox' class='admin-logout-button'>Logout</label>
                            <input type='checkbox' id='logoutCheckbox'>
                            <div class='logout-background'>
                                <div class='logout-content'>
                                    <p>Are you sure you want to log out?</p>
                                    <a href='logout.php' class='confirm-logout'>Yes</a>
                                    <label for='logoutCheckbox' class='cancel-logout'>No</label>
                                </div>
                            </div>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header class="admin-header">
            <h2 class="admin-header-text">
                Login 
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
                            <h3>Login Records</h3>
                            <button>Refresh</button>
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
                                        <th class="admin-delete-option">Delete</th>
                                    </tr>
                                </thead>
                                <?php
                                $conn = mysqli_connect($servername,$username,$password,$dbname);
                                $sql = "SELECT * FROM login";
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
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                <input type="hidden" name="id" value="<?php echo $row['Login_ID']; ?>">
                                                <button type="submit" class="admin-delete-button">Delete</button>
                                            </form>
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
            
            // Redirect to same page instead of different page
        }

        // If showing the confirmation dialog, show only the confirmation modal
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Output the confirmation dialog
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
</body>
</html>