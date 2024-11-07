<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Enquiries"/>
    <meta name="keywords" content="Plant's Notebook, Enquiries, Admin View"/>
    <title>Plant's Notebook | View Enquiries</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">
</head>

<body>
    <?php 
    include ('database/connection.php');
    include ('database/database.php');
    ?>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
    <p class="logo_admin">
        <a href="index.php"><img src="images/logo.png" alt="Plant\'s Notebook">
        <span class="admin_logo_text">Plant's Notebook</span></a>
    </p>

        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft">Password</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li><a href="user_view_enquiry.php"><img src="images/register_icon.png" alt="Register" class="register-sidebar-icon"><span>Username</span></a></li>
                <li><a href="change_password.php" class="active"><img src="images/login_icon.png" alt="Login" class="login-sidebar-icon"><span>Password</span></a></li>
                <li><a href=""><img src="images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon"><span>Contribute history</span></a></li>
                <li><a href=""><img src="images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiry history</span></a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header class="admin-header">
            <h2>
                <label for="nav-toggle">
                    <img src="images/hamburger_icon2.png" alt="Toggle Menu" class="hamburger-icon">
                </label>
                Password
            </h2>

            <div class="search-wrapper">
                <img src="images/search_icon.png" alt="Search" class="admin-search-icon"></img>
                <input type="search" placeholder="Search here" />
            </div>

            <div class="user-wrapper">
                <img src="images/admin-icon.jpg" alt="admin profile picture">
                <div>
                    <h4>User</h4>
                    <small>User</small>
                </div>
            </div>
        </header>

        <main>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Profile Password</h3>

                            <button>See All <span class="las la-arrow-right"></span></button>
                        </div>
                    
                        <div class="card-body">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Password Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php
                            $conn = mysqli_connect($servername,$username,$password,$dbname);
                            $sql = "SELECT * FROM Register";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row["Register_ID"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td>
                                    <td><?php echo $row["Username"]; ?></td>
                                    <td>
                                        <form method="POST" action="process_password.php" class="password-form">
                                            <input type="hidden" name="register_id" value="<?php echo $row["Register_ID"]; ?>">
                                            <div class="form-group">
                                                <label>Current Password:</label>
                                                <input type="password" name="current_password" required>
                                            </div>
                                            <div class="form-group">
                                                <label>New Password:</label>
                                                <input type="password" name="new_password" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm New Password:</label>
                                                <input type="password" name="confirm_password" required>
                                            </div>
                                    </td>
                                    <td>
                                            <button type="submit" name="update_password">Update Password</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No records found</td></tr>";
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
</body>
</html>