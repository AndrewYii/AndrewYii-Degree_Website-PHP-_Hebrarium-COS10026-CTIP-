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
            <h2><span class="lab la-accusoft">User Profile</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li><a href="admin_control_panel.php" class="active"><img src="images/register_icon.png" alt="Register" class="register-sidebar-icon"><span>Register</span></a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header class="admin-header">
            <h2>
                <label for="nav-toggle">
                    <img src="images/hamburger_icon2.png" alt="Toggle Menu" class="hamburger-icon">
                </label>
                Register
            </h2>

            <div class="search-wrapper">
                <img src="images/search_icon.png" alt="Search" class="admin-search-icon"></img>
                <input type="search" placeholder="Search here" />
            </div>

            <div class="user-wrapper">
                <img src="images/admin-icon.jpg" alt="admin profile picture">
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
                            <h3>Recent Projects</h3>

                            <button>See All <span class="las la-arrow-right"></span></button>
                        </div>
                    
                        <div class="card-body">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Date Submitted</th>
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
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["Register_Created_At"]; ?></td>

                </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='11'>No enquiries found</td></tr>";
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