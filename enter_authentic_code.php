<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start();

    // Initialise attempt count if not already set
    if (!isset($_SESSION['otp_attempts'])) {
        $_SESSION['otp_attempts'] = 0;
    } 

    if (!(isset($_SESSION['forgot_username']))){
        header('Location: index.php'); 
        exit();
    }



    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Increment attempt count
        $_SESSION['otp_attempts'] += 1;

        $entered_otp = implode('', $_POST['auth_code']);

        // Compare with the OTP stored in the session
        if (isset($_SESSION['auth_code']) && $entered_otp == $_SESSION['auth_code']) {
            $_SESSION['otp_attempts'] = 0; 
            echo "<div class='snackbar show success'>OTP verified successfully! Redirecting to reset password within 1 second.</div>";;
            echo "<meta http-equiv='refresh' content='1; url=reset_password.php'>";
        } else {
            // Incorrect OTP
            // Check if attempts have exceeded the limit
            if ($_SESSION['otp_attempts'] >= 5) {
                // Redirect to login page if attempts exceed limit
                $_SESSION['otp_attempts'] = 0;
                echo "<div class='snackbar show error'>You have exceeded the maximum number of attempts. Redirecting to login within 1 second.</div>";
                echo "<meta http-equiv='refresh' content='1; url=login.php'>";
            }
            else{
                echo "<div class='snackbar show error'>Incorrect OTP. You have " . (5 - $_SESSION['otp_attempts']) . " attempts remaining.</div>";
            }
        }
    }
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Enter your authentication code to reset your password for Plant's Notebook." />
        <meta name="keywords" content="authentication code, reset password, Plant's Notebook" />
        <meta name="author" content="Andrew Yii Teck Foon" />
        <title>Plant's Notebook | Enter Authentication Code</title>
        <link rel="stylesheet" href="styles/style.css">
        <link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    </head>

    <body>

        <header id="top_aut">
            <?php include 'include/header.php'; ?>
        </header>

        <article>
            <?php include 'include/chatbot.php';?>

            <div class="login-form-layout">
                <form class="login-form" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <figure class="forgot-password-logo">
                        <img src="images/otp_verify.png" alt="OTP Symbol">
                    </figure>

                    <h1>Enter OTP Code</h1>
                    <p class="forgot-password-info">We sent an OTP code to your registered email. Please enter it below:</p>

                    <div class="otp-inputs">
                        <input type="text" name="auth_code[]" maxlength="1" required>
                        <input type="text" name="auth_code[]" maxlength="1" required>
                        <input type="text" name="auth_code[]" maxlength="1" required>
                        <input type="text" name="auth_code[]" maxlength="1" required>
                        <input type="text" name="auth_code[]" maxlength="1" required>
                        <input type="text" name="auth_code[]" maxlength="1" required>
                    </div>

                    <button type="submit" class="contribute-btn">Verify Code</button>

                    <div class="register-link forgot-password">
                        <p><a href="login.php"> <span id="arrow-back"> ← </span> Back to Login</a></p>
                    </div>
                </form>
            </div>
        </article>

        <footer>
            <?php include 'include/footer.php'; ?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_aut'>
                <img src='images/going_up.png' alt='going-up' class='going-up' title="going to the top">
            </a>
        </figure>

    </body>

</html>