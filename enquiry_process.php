<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This is confirm page about the enquiry submission" />
        <meta name="keywords" content="Process on checking info of enquiry submission" />
        <meta name="author" content="Andrew Teck Foon Yii"  />
        <title>Plant's Notebook | Enquiry Confirmation</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>

    <body>
        <header id="top_enprocess">
            <?php include 'include/header.php';?>
        </header>

        <?php
            include 'database/connection.php';
            include 'database/database.php';

            $spam = '';
            $error = '';
            $error_connection ='';
            $message = '';
            $max_attempts = 3;
            $block_duration = 600; 

            if (!isset($_SESSION['failed_attempts'])) {
                $_SESSION['failed_attempts'] = 0;
            }
            if (!isset($_SESSION['block_time'])) {
                $_SESSION['block_time'] = 0;
            }

            $current_time = time();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Check if user is blocked
                if ($_SESSION['block_time'] > $current_time) {
                    $spam .= "You are currently blocked. Please wait until the block period expires.";
                    $remaining_time = ($_SESSION['block_time'] - $current_time) / 60;
                    $spam .= " You have been temporarily blocked due to too many failed attempts. Please try again after " . ceil($remaining_time) . " minutes. Don't Spam Anymore!<br>";
                } else {
                    //Connect Again
                    $conn = mysqli_connect($servername,$username,$password,$dbname);

                    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
                    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                    $street = mysqli_real_escape_string($conn, $_POST['Street']);
                    $city = mysqli_real_escape_string($conn, $_POST['City']);
                    $postcode = mysqli_real_escape_string($conn, $_POST['Postcode']);
                    $state = mysqli_real_escape_string($conn, $_POST['State']);
                    $topic = mysqli_real_escape_string($conn, $_POST['page']);
                    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

                    //First Name
                    if(empty(trim($first_name))){
                        $error .= "First name is required.<br>";
                    }
                    else if(!preg_match('/^[a-zA-Z\s]+$/', $first_name)){
                        $error .= "Only alphabetic characters and spaces are allowed.<br>";
                    }
                    else if(strlen($first_name) > 25){
                        $error .="First name too long. It cannot exceed 25 words.<br>";
                    }

                    //Last Name
                    if(empty(trim($last_name))){
                        $error .= "Last name is required.<br>";
                    }
                    else if(!preg_match('/^[a-zA-Z\s]+$/', $last_name)){
                        $error .= "Only alphabetic characters and spaces are allowed.<br>";
                    }
                    else if(strlen($last_name) > 25){
                        $error .="Last name too long. It cannot exceed 25 words.<br>";
                    }
                    
                    //Email
                    if(empty(trim($email))){
                        $error .= "Email is required.<br>";
                    }
                    else if(!preg_match('/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/', $email)){
                        $error .= "Please type the proper email.<br>";
                    }

                    //Phone
                    if(empty(trim($phone))){
                        $error .= "Phone number is required<br>";
                    }
                    else if (!preg_match('/^\d{1,10}$/', $phone)) {
                        $error .= "Only numbers are allowed, and up to 10 digits.<br>";
                    }

                    //Street Address
                    if(empty(trim($street))){
                        $error .= "Street information is required.<br>";
                    }
                    else if(!preg_match('/^.{1,40}$/', $street)){
                        $error .= "Street too long. It cannot exceed 40 words.<br>";
                    }

                    //City Name
                    if(empty(trim($city))){
                        $error .= "City name is required.<br>";
                    }
                    else if(!preg_match('/^.{1,20}$/', $city)){
                        $error .= "City name too long. It cannot exceed 20 words.<br>";
                    }

                    //Postcode
                    if(empty(trim($postcode))){
                        $error .= "Postcode information is required<br>";
                    }
                    else if (!preg_match('/^\d{5}$/', $postcode)){
                        $error .= "Postcode must be exactly 5 digits.<br>";
                    }

                    //State
                    if(empty(trim($state))){
                        $error .= "State information is required.<br>";
                    }

                    //Topic
                    if(empty(trim($topic))){
                        $error .= "Tutoral topic is required.<br>";
                    }

                    //Comment
                    if(empty(trim($comment))){
                        $error .= "Comment is required.<br>";
                    }
                    else if(!preg_match('/^.{1,500}$/', $comment)){
                        $error .= "Comment too long. It cannot exceed 500 characters.<br>";
                    }

                    // No error
                    if ($error == '') {   
                        if (isset($_SESSION['username'])){
                            $username = $_SESSION['username'];
                        }
                        else{
                            $username = 'Guest';
                        }
                        $_SESSION['failed_attempts'] = 0; // Reset attempts on success
                        $sql = "INSERT INTO enquiry (Name, Email, Phone, Subject, Message, Street, City, Postcode, State, Username) 
                                VALUES ('$first_name $last_name', '$email', '$phone', '$topic', '$comment', '$street', '$city', '$postcode', '$state', '$username')";
                        if (mysqli_query($conn, $sql)){
                            $message = "Your enquiry has been submitted successfully, and we'll be in touch shortly";
                        }
                        else{
                            $error_connection = "We're sorry, but we couldn't store your data due to a technical issue with our database. Please try again later. If the issue persists, feel free to reach out to our <a href='mailto:104386568@students.swinburne.edu.my'>support team</a> for assistance.";
                        }         
                    }
                    else {
                        $_SESSION['failed_attempts']++;
                        
                        if ($_SESSION['failed_attempts'] > $max_attempts) {
                            $_SESSION['block_time'] = time() + $block_duration;
                            $spam = "You have exceeded the maximum number of attempts. You are now blocked for " . ($block_duration/60) . " minutes.";
                        }
                    }

                    //Close Connection
                    mysqli_close($conn);
                }
            }
        ?>

        <article>
            <?php
                include 'include/chatbot.php';
            ?>

            <div class="image-text">
                <div class="confirm_card">
                    <?php
                        echo '<p class="small_word_confirm">Plant\'s Notebook / CONFIRM</p>';
                        if($spam !==''){
                            echo "<h1 class='title_confirm'>WARNING ! </h1>";
                            echo '<p class="confirm_words"><span class="fail_words">Spam</span>: <br>' . $spam . '</p>';
                        }
                        else if ($error !== ''){
                            echo "<h1 class='title_confirm'>SORRY !</h1>";
                            echo '<p class="confirm_words"><span class="fail_words">Input Invalid</span>: <br>' . $error . '</p>';
                            echo '<p class="confirm_words invalid_handle">Please check your input and <a href="enquiry.php">try again</a>. If the problem persists, contact our <a href="mailto:104386568@students.swinburne.edu.my">customer service team </a>for assistance.</p>';
                        }
                        else if ($error_connection !== ''){
                            echo "<h1 class='title_confirm'>SORRY !</h1>";
                            echo '<p class="confirm_words"><span class="fail_words">Errors</span>: ' . $error_connection . 'Please <a href="enquiry.php">try submitting your request again </a>in a few moments. If the problem persists, feel free to reach out to our <a href="mailto:104386568@students.swinburne.edu.my">support team</a> for further assistance. We apologize for any inconvenience and appreciate your patience.</p>';
                        }
                        else if ($message !== ''){
                            echo "<h1 class='title_confirm'>THANK YOU !</h1>";
                            echo '<p class="confirm_words"><span class="success_words">Success</span>: ' . $message . 'We\'re excited to assist you and have started working on your request. You will receive a confirmation email shortly at our <a href="mailto:104386568@students.swinburne.edu.my">staff\'s email</a>. In the meantime, feel free to browse our latest updates, services, and resources to stay informed and inspired.</p>';
                            echo '<a class="button_view_confirm" href="user_view_enquiry.php" target="_blank"> View Your Enquiry Details</a>';
                        }
                        echo '<p class="small_word_confirm">If you have any further questions or need immediate assistance, please don\'t hesitate to reach out to our <a href="mailto:104386568@students.swinburne.edu.my">customer service team</a>.You will redirect back to the Enquiry Page within 3 seconds.</p>';
                    ?>
                    <meta http-equiv="refresh" content="3 ;url=enquiry.php">
                </div>
            </div>

        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_enprocess'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure> 

    </body>

</html>