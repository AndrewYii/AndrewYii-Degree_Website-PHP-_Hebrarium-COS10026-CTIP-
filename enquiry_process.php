<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This is confirm page about the enquiry submission" />
        <meta name="keywords" content="" />
        <meta name="author" content=""  />
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
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

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


                // Validation
                $error = '';
                $error_connection ='';
                $message = '';
                

                //First Name
                if(empty(trim($first_name))){
                    $error .= "First name is required.<br>";
                }
                else if(!preg_match('/^[a-zA-Z]+$/', $first_name)){
                    $error .= "Only characters are allowed.<br>";
                }
                else if(strlen($first_name) > 25){
                    $error .="First name too long.<br>";
                }

                //Last Name
                if(empty(trim($last_name))){
                    $error .= "Last name is required.<br>";
                }
                else if(!preg_match('/^[a-zA-Z]+$/', $last_name)){
                    $error .= "Only characters are allowed.<br>";
                }
                else if(strlen($last_name) > 25){
                    $error .="Last name too long.<br>";
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
                    $error .= "Street is required.<br>";
                }
                else if(!preg_match('/^.{1,40}$/', $street)){
                    $error .= "Street too long.<br>";
                }

                //City Name
                if(empty(trim($city))){
                    $error .= "City name is required.<br>";
                }
                else if(!preg_match('/^.{1,20}$/', $city)){
                    $error .= "City name too long.<br>";
                }

                //Postcode
                if(empty(trim($postcode))){
                    $error .= "Postcode is required<br>";
                }
                else if (!preg_match('/^\d{5}$/', $postcode)){
                    $error .= "Postcode must be exactly 5 digits.<br>";
                }

                //State
                if(empty(trim($state))){
                    $error .= "State is required.<br>";
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
                    $error .= "Comment too long.<br>";
                }

                // No error
                if ($error == '')
                {
                    $sql = "INSERT INTO Enquiry (name, email, phone, subject, message, street, city, postcode, state) 
                            VALUES ('$first_name $last_name', '$email', '$phone', '$topic', '$comment', '$street', '$city', '$postcode', '$state')";
                    if (mysqli_query($conn, $sql)){
                        $message = "Your enquiry has been successfully submitted, and we will get back to you shortly.";
                    }
                    else{
                        $error_connection = "Your submission has failed. Unfortunately, we were unable to store your data due to a database error. Please try again later or contact support for assistance.";
                    }         
                }

                //Close Connection
                mysqli_close($conn);
            }
        ?>

        <article>
            <?php
                include 'include/chatbot.php';
            ?>
            <div>
                <?php
                    if ($error !== ''){
                        echo '<p>Field errors: ' . $error . '</p>';
                    }
                    else if ($error_connection !== ''){
                        echo '<p>Errors: ' . $error_connection . '</p>';
                    }
                    else if ($message !== ''){
                        echo '<p>Success: ' . $message . '</p>';
                    }
                ?>
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