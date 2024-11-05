<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start();
?>


<html lang="en">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Forgot your password for Plant's Notebook? Enter your username and first name to receive an authentication code via email to reset your password and regain access to your account." />
        <meta name="keywords" content="Plant's Notebook password reset, forgot password, authentication code, reset account, botany education, herbarium specimen tutorial" />
        <meta name="author" content="Andrew Yii Teck Foon" />
        <title>Plant's Notebook | Reset Your Password</title>
        <link rel="stylesheet" href="styles/style.css">
        <link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_log">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>

            <div class="login-form-layout">
                <form class="login-form" action="#" method="POST">
                    <figure class="forgot-password-logo">
                        <img  src="images/password_remove.png" alt="Forgot Password Symbol">
                    </figure>

                    <h1>
                        Forgot Password ?
                    </h1>

                    <p class="forgot-password-info">No worries, we will send you reset instructions!</p>

                    <div class="contribute-input">
                        <span class="contribute-form-info">Username</span>
                        <input type="text" name="Username">
                    </div>

                    <button type="submit" class="contribute-btn">
                            Reset Password
                    </button>

                    <div class="register-link forgot-password">
                        <p><a href="login.php"> <span id="arrow-back"> ← </span> Back to Login</a></p>
                    </div>
                </form>
            </div>

        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_log'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>

</html>