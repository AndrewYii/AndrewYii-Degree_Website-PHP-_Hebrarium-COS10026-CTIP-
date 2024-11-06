<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start();
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $error = '';
    $error_connection = '';
    $message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Connect to the database
        $conn = mysqli_connect($servername, $username, $password, $dbname);


        $first_name = mysqli_real_escape_string($conn, $_POST['FirstName']);
        $last_name = mysqli_real_escape_string($conn, $_POST['LastName']);
        $username = mysqli_real_escape_string($conn, $_POST['Username']);
        $email = mysqli_real_escape_string($conn, $_POST['Email']);
        $password = mysqli_real_escape_string($conn, $_POST['Password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['Password_Confirm']);

        // First Name 
        if (empty(trim($first_name))) {
            $error .= "First name is required.<br>";
        } else if (!preg_match('/^[a-zA-Z\s]+$/', $first_name)) {
            $error .= "Only alphabetic characters and space are allowed in the first name.<br>";
        } else if (strlen($first_name) > 25) {
            $error .= "First name too long. It cannot exceed 25 characters.<br>";
        }

        // Last Name 
        if (empty(trim($last_name))) {
            $error .= "Last name is required.<br>";
        } else if (!preg_match('/^[a-zA-Z\s]+$/', $last_name)) {
            $error .= "Only alphabetic characters and space are allowed in the last name.<br>";
        } else if (strlen($last_name) > 25) {
            $error .= "Last name too long. It cannot exceed 25 characters.<br>";
        }

        // Username 
        if (empty(trim($username))) {
            $error .= "Username is required.<br>";
        } else if (str_word_count($username) > 25) {
            $error .= "Username cannot exceed 25 words.<br>";
        }
        // Check if username already exists
        $query = "SELECT * FROM Register WHERE Username='$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $error .= "Username already exists. Please choose a different username.<br>";
        }

        // Email 
        if (empty(trim($email))) {
            $error .= "Email is required.<br>";
        } else if (!preg_match('/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $error .= "Please enter a valid email address.<br>";
        }
        $query = "SELECT * FROM Register WHERE Email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $error .= "Email already exists. Please choose a different email.<br>";
        }

        // Password
        if (empty(trim($password))) {
            $error .= "Password is required.<br>";
        } 
        else if (!preg_match('/^[a-zA-Z]+$/', $password)) {
            $error .= "Only alphabetic characters are allowed in the password.<br>";}
        else if (strlen($password) > 25) {
            $error .= "Password too long. It cannot exceed 25 characters.<br>";
        }

        // Confirm Password 
        if (empty(trim($confirm_password))) {
            $error .= "Confirm password is required.<br>";
        } else if ($confirm_password != $password) {
            $error .= "Passwords do not match.<br>";
        }

        if ($error == '') {
            
            $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO Register (Name, Username, Email, Password) 
                    VALUES ('$first_name $last_name', '$username', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {
                $message =" Congratulations, $username! Your registration has been successfully submitted. We're excited to have you on board. You can now <a href='login.php'>log in</a> to enjoy all the features we offer, including contributing to our website, asking any enquiries, and accessing our plant identification hub. Be sure to check your email for a confirmation message and to verify your account. If you have any questions or need assistance, don't hesitate to reach out to our <a href='mailto:104386568@students.swinburne.edu.my'>support team</a> Welcome to our community! You will redirect to login page within 2 seconds";
                $mail = new PHPMailer(true);
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'sslibrary0505@gmail.com'; 
                    $mail->Password = 'sdxa arsy rznc iypi';     
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Recipients
                    $mail->setFrom('sslibrary0505@gmail.com', 'Plant\'s Notebook Staff (Andrew)');
                    $mail->addAddress($email); // Recipient's email

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Welcome to Plant\'s Notebook - Your Journey into Herbarium Creation Starts Here!';
                    $mail->Body = "
                        Dear $username,<br><br>
                        Welcome to Plant's Notebook! We're thrilled to have you join our community dedicated to the art and science of herbarium creation.<br><br>
                        As a member, you now have access to a variety of tools and resources to help you make and preserve herbariums. From tutorials on preservation techniques to comprehensive plant classification guides, we're here to support every step of your journey.<br><br>
                        Start exploring our tutorials, discover new techniques, and dive into the fascinating world of plant preservation. If you need any assistance, feel free to contact our support team.<br><br>
                        Happy collecting!<br><br>
                        Best regards,<br>
                        Plant's Notebook Support Team
                    ";
                    // Send the email
                    if (!($mail->send())) {
                        echo "<div class='snackbar show error'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
                    }
                } catch (Exception $e) {
                    echo "<div class='snackbar show error'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
                }        
            } else {
                $error_connection = "We couldn't store your data due to a technical issue. Please try again later. If the issue persists, feel free to reach out to our <a href='mailto:104386568@students.swinburne.edu.my'>support team</a> for assistance.";
            }
        }

        // Close Connection
        mysqli_close($conn);
    }

    if ($error !== '') {
        echo "<div class='snackbar show error'>" . $error . "Please Try Again </div>";
    } else if ($error_connection !== '') {
        echo "<div class='snackbar show error'>" . $error_connection . "</div>";
    } else if ($message !== '') {
        echo "<div class='snackbar show success'>" . $message . "</div>";
        echo"<meta http-equiv='refresh' content='2 ;url=login.php'>";            
}?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Join Plant's Notebook to dive into the fascinating world of botany. Access comprehensive tutorials on herbarium specimen creation, plant classification, and identification. Connect with fellow nature enthusiasts and contribute to our growing botanical community. Start your botanical journey with us today!" />
        <meta name="keywords" content="Plant's Notebook login, botany login, herbarium specimen tutorial, plant classification, plant identification, botanical community, botanical education, nature enthusiasts, plant preservation, botanical tools, herbarium techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Become Our Member To Explore The Botany World</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_reg">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php 
                include 'include/chatbot.php';
            ?>

            <div class="register-form-layout">

                <div class="login-form">

                    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">

                            <input type="reset" class="word">

                            <h1>
                                Register
                            </h1>

                            <br>

                            <fieldset class="contribute-fieldset">
                                <legend> Personal Info</legend>
                                <div class="contribute-input">
                                    <span class="contribute-form-info">First Name</span>
                                    <input type="text" placeholder="Andrew Yu Rui"  name="FirstName">
                                </div>

                                
                                <div class="contribute-input">
                                    <span class="contribute-form-info">Last Name</span>
                                    <input type="text" placeholder="Ling" name="LastName">
                                </div>
                            </fieldset>


                            <fieldset class="contribute-fieldset">
                                <legend> Account Info</legend>
                                <div class="contribute-input">
                                    <span class="contribute-form-info">Username</span>
                                    <input type="text" placeholder="Leoooooooo" name="Username" >
                                </div>

                                <div class="contribute-input">
                                    <span class="contribute-form-info">Email</span>
                                    <input type="text" placeholder="abc@gmail.com" name="Email" >
                                </div>

                                <div class="contribute-input">
                                    <span class="contribute-form-info">Password</span>
                                    <input type="password"  placeholder="abcdefg" name="Password" >
                                </div>

                                <div class="contribute-input">
                                    <span class="contribute-form-info">Confirm Password</span>
                                    <input type="password"  placeholder="abcdefg" name="Password_Confirm" >
                                </div>
                            </fieldset>

                            <button type="submit" class="contribute-btn">
                                Register
                            </button>

                            <div class="register-link">
                                <p>Already have the account!<a href="login.php">Login</a></p>
                            </div>
                    </form>

                </div>
            </div>
            
            <figure class='going-up-container'>
                <a href='#top_reg'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>
            
        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_reg'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>


    </body>
    
</html>