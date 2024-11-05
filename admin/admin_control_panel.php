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
    include ('../database/connection.php');
    include ('../database/database.php');
    ?>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft">Admin Control Panel</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li><a href="" class="active"><span class="las la-igloo"></span><span>Register</span></a></li>
                <li><a href=""><span class="las la-users"></span><span>Login</span></a></li>
                <li><a href=""><span class="las la-clipboard-list"></span><span>Contribute</span></a></li>
                <li><a href=""><span class="las la-shopping-bag"></span><span>Enquiries</span></a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header class="admin-header">
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                Register
            </h2>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search here" />
            </div>

            <div class="user-wrapper">
                <img src="../images/Faiz.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>Jason Nguyen</h4>
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
                        <table class="admin-table" width="100%">
                            <thead>
                                <tr>
                                    <td>Project Title</td>
                                    <td>Department</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>UI/UX Design</td>
                                    <td>UI team</td>
                                    <td>
                                        <span class="status"></span>
                                        review
                                    </td>
                                </tr>
                                <tr>
                                    <td>Web Development</td>
                                    <td>Frontend</td>
                                    <td>
                                        <span class="status"></span>
                                        in progress
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ushop App</td>
                                    <td>Mobile team</td>
                                    <td>
                                        <span class="status"></span>
                                        pending
                                    </td>
                                </tr>
                                <tr>
                                    <td>UI/UX Design</td>
                                    <td>UI team</td>
                                    <td>
                                        <span class="status"></span>
                                        review
                                    </td>
                                </tr>
                                <tr>
                                    <td>Web Development</td>
                                    <td>Frontend</td>
                                    <td>
                                        <span class="status"></span>
                                        in progress
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ushop App</td>
                                    <td>Mobile team</td>
                                    <td>
                                        <span class="status"></span>
                                        pending
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>