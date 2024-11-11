<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start();

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Ensure the user is verified
    if (!isset($_SESSION['forgot_username'])) {
        header("Location: login.php");
        exit;
    }

    $username = $_SESSION['forgot_username']; 
    $error = ""; 

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate New Password
        if (empty(trim($new_password))) {
            $error .= "Password is required.<br>";
        } 
        else if (!preg_match('/^[a-zA-Z]+$/', $new_password)) {
            $error .= "Only alphabetic characters are allowed in the password.<br>";
        }
        else if (strlen($password) > 25 || strlen($password) < 5 ) {
            $error .= "Password must between 5 to 25 alphabetic characters.<br>";
        }
    
        // Validate Confirm Password
        if (empty(trim($confirm_password))) {
            $error .= "Confirm password is required.<br>";
        }
        else if($new_password != $confirm_password){
            $error .= "Passwords do not match. Please try again.<br>";
        }
        
        if ($error == '') {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update the password in the database
            $sql = "UPDATE Register SET Password = ? WHERE Username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashed_password, $username);
            
            if ($stmt->execute()) {
                echo "<div class='snackbar show success'>Password reset successfully! Redirecting to login page within 1 second</div>";
                echo "<meta http-equiv='refresh' content='1; url=login.php'>";
                session_unset();
                session_destroy();
            } else {
                $error .= "Error updating password. Please try again.<br>";
            }

            $stmt->close();

        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Enter your authentication code to reset your password for Plant's Notebook." />
        <meta name="keywords" content="authentication code, reset password, Plant's Notebook" />
        <meta name="author" content="Andrew Yii Teck Foon" />
        <title>Plant's Notebook | Reset Your Password</title>
        <link rel="stylesheet" href="styles/style.css">
        <link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    </head>

    <body>
        <header>
            <?php include 'include/header.php'; ?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>

            <div class="login-form-layout">
                <form class="login-form" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <figure class="forgot-password-logo">
                        <img src="images/reset_success.png" alt="OTP Symbol">
                    </figure>
                    <h1>Reset Password</h1>
                    
                    <div class="contribute-input">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" placeholder="5 - 25 alphabetical characters" name="new_password">
                    </div>
                    
                    <div class="contribute-input">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" id="confirm_password"   placeholder="Must be same as the first password you typed" name="confirm_password">
                    </div>
                    
                    <button type="submit" class="contribute-btn">Reset</button>
                </form>
            </div>

            <?php if ($error!='') {
                echo "<div class='snackbar show error'>". $error ."</div>";
            } ?>
        </article>

        <footer>
            <?php include 'include/footer.php'; ?>
        </footer>
    </body>
</html>