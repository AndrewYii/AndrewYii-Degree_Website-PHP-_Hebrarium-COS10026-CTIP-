<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start();

    $username_value = ''; 

    if (isset($_COOKIE['remembered_username'])) {
        $username_value = ($_COOKIE['remembered_username']); // Set cookie value if "Remember Me" was checked
    } else {
        $username_value = ''; // Leave blank if cookie is not set
    }

    $error = '';
    $error_connection = '';
    $message = '';
    $spam = '';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Connect to the database
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    
        $username = mysqli_real_escape_string($conn, $_POST['Username']);
        $password = mysqli_real_escape_string($conn, $_POST['Password']);


        
        // Detect whether users want to remember username or not
        if (isset($_POST['remember'])) {
            $remember = 1; 
        } else {
            $remember = 0; 
        }
        
        //Retrieve Data 
        $sql_retrievedata = "SELECT Register_ID, Username, Password FROM Register WHERE Username = ?";
        $stmt = $conn->prepare($sql_retrievedata);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        //Username
        if (empty(trim($username))) {
            $error .= "Username is required.<br>";
        }
        else if (isset($_SESSION['username']) && $_SESSION['username'] === $username) {//Check whether login same account or not to avoid spam
            $spam = "You are already logged in as " . $_SESSION['username'] . ".";
        }

        // Set "Remember Me" cookie if the option is checked
         
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $retrived_registerid = $row['Register_ID']; 
            $checked_name = $row['Username']; 
            $hashed_password = $row['Password'];

            if ($remember == 1) {
                setcookie("remembered_username", $username, time() + (30 * 24 * 60 * 60),  "/"); // 30 days expiration
            } else {
                    // If not remembered, clear the cookie
                setcookie("remembered_username", "", time() - 3600,  "/"); 
            }
               

            // Password
            if (empty(trim($password))) {
                $error .= "Password is required.<br>";
            }
            else if(!password_verify($password,$hashed_password)){
                $error .= "Password is wrong.<br>";
            }
        }
        else{
            $error .= "No account found with that username.<br>";
            setcookie("remembered_username", "", time() - 3600,  "/"); 
        }

    
        if ($error == ''&&$spam == '' ) {
            
            $sql = "INSERT INTO Login ( Register_ID, Username) 
                    VALUES ('$retrived_registerid','$username')";
    
            if (mysqli_query($conn, $sql)) {
                $login_id = mysqli_insert_id($conn);

                $_SESSION['login_id'] = $login_id; 
                $_SESSION['username'] = $username;

                if($username=="admin"){
                    $message =" Welcome back, admin! You will be redirected to admin control panel within 3 seconds";
                }
                else{
                    $message =" Welcome back, $username ! You will be redirected to main page within 3 seconds";
                }
            } else {
                $error_connection = "We couldn't find your data due to a technical issue. Please try again later. If the issue persists, feel free to reach out to our <a href='mailto:104386568@students.swinburne.edu.my'>support team</a> for assistance.";
            }
        }

        $stmt->close();

        // Close Connection
        mysqli_close($conn);
    }

    if ($spam !== '') {
        echo "<div class='snackbar show error'>" . $spam . "<br>Don't Spam Anymore!</div>";
    }else if ($error !== '') {
        echo "<div class='snackbar show error'>" . $error . "Please Try Again </div>";
        echo "<meta http-equiv='refresh' content='1.5; url=login.php'>";
    } else if ($error_connection !== '') {
        echo "<div class='snackbar show error'>" . $error_connection .  "</div>";
    } else if ($message !== '') {
        echo "<div class='snackbar show success'>" . $message . "</div>";
        ?>
        <?php if ($username == "admin") { ?>
            <meta http-equiv="refresh" content="3; url=admin/admin_control_panel.php">
        <?php } else { ?>
            <meta http-equiv="refresh" content="3; url=index.php">
        <?php } ?>
    <?php
    }


?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Log in to Plant's Notebook to explore detailed tutorials on herbarium specimen creation and preservation, classify plants, discover new species, and contribute to our botanical community. Join us today!" />
        <meta name="keywords" content="Plant's Notebook login, botany login, herbarium specimen tutorial, plant classification, plant identification, botanical community, botanical education, nature enthusiasts, plant preservation, botanical tools, herbarium techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Login To Discover The Botany World</title>
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
                <div class="login-form">

                    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <h1>
                            Login
                        </h1>

                        <div class="contribute-input">
                            <span class="contribute-form-info">Username</span>
                            <input type="text" name="Username" value="<?php echo $username_value; ?>">
                        </div>

                        <div class="contribute-input">
                            <span class="contribute-form-info">Password</span>
                            <input type="password" name="Password">
                        </div>

                        <div class="remember-forgot">
                        <label for="remember">
                            <input id="remember" type="checkbox" name="remember" value="1" 
                            <?php if (isset($_COOKIE['remembered_username'])) { echo 'checked'; } ?>>
                            Remember me 
                        </label>
                            <a href="forgot_password.php">Forgot password?</a>
                        </div>

                        <button type="submit" class="contribute-btn">
                            Sign In
                        </button>

                        <div class="register-link">
                            <p>Don't have an account?<a href="registration.php">Register</a></p>
                        </div>

                    </form>

                </div>
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