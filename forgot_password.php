<?php
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include 'database/connection.php';
    include 'database/database.php';
    session_start();

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $username = $_POST['Username'];

        // Check if the username exists in the database
        $sql_email = "SELECT Email FROM Register WHERE Username = ?";
        $stmt = $conn->prepare($sql_email);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result_email = $stmt->get_result();
        $user = $result_email->fetch_assoc();

        if ($user) {
            $auth_code = rand(100000, 999999); // Generates a 6-digit code
            $_SESSION['auth_code'] = $auth_code;

            
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'plantsnotebookctip@gmail.com'; 
                $mail->Password = 'ABc328022';     
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('plantsnotebookctip@gmail.com', 'Plant\'s Notebook Staff (Andrew)');
                $mail->addAddress($user['Email']); // Recipient's email

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Your Authentication Code';
                $mail->Body = "Your authentication code is: $auth_code";

                // Send the email
                if ($mail->send()) {
                    echo "<div class='snackbar show success'>The authentication code has been sent. You will be redirected to continue resetting your password within 1 second.</div>";
                    echo "<meta http-equiv='refresh' content='1; url=enter_authentic_code.php'>";
                } else {
                    echo "<div class='snackbar show error'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
                }
            } catch (Exception $e) {
                echo "<div class='snackbar show error'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
            }
        } else {
            echo "<div class='snackbar show error'>Username does not exist!</div>";
        }

        $stmt->close();

        mysqli_close($conn);
    }


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
                <form class="login-form" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">
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