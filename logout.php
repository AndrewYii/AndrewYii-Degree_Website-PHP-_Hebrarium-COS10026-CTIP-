<?php
    session_start();

    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Plants_Notebook";

    if (isset($_SESSION['login_id'])) {

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Update the logout time for the current session's login record
        $sql_logout = "UPDATE Login SET Logout_At = CURRENT_TIMESTAMP WHERE Login_ID = ?";
        $stmt = $conn->prepare($sql_logout);
        $stmt->bind_param("i", $_SESSION['login_id']);
        $stmt->execute();

        $stmt->close();
        mysqli_close($conn);
    }

    session_unset();

    session_destroy();

    header("Location: login.php");

    exit();

?>