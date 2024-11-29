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
        <meta name="description" content="Temporary View User Enquiry After The Appointment" />
        <meta name="keywords" content="Enquiry View, User, Temporary, Plant's Notebook" />
        <meta name="author" content="Aniq Nazhan bin Mazlan"  />
        <title>Plant's Notebook | View Enquiry</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>

    <body>
    <?php
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            
            // Check if user is logged in
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            
            // Query the latest enquiry
            $sql = "SELECT * FROM enquiry ORDER BY Enquiry_ID DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
            } else {
                // Redirect if no enquiry found
                header("Location: user_view_enquiry.php");
                exit();
            }
        ?>

        <header id="top_enq">
            <?php include 'include/header.php';
            ?>
        </header>

        <article class="identify-enquiry">

            <?php include 'include/chatbot.php';?>
            
            <div class="enquiry-view-form">
                <h1>View Enquiry</h1>
                <br>
                <p><strong>Name:</strong> <?php echo $user_data['Name']; ?></p>
                <p><strong>Email:</strong> <?php echo $user_data['Email']; ?></p>
                <p><strong> At:</strong> <?php echo $user_data['Enquiry_Created_At']; ?></p>
                <p><strong>Subject:</strong> <?php echo $user_data['Subject']; ?></p>
                <p><strong>Enquiry:</strong> <?php echo $user_data['Message']; ?></p>
            </div>
            <?php   
            mysqli_close($conn);
            ?>
            <figure class='going-up-container'>
                <a href='#top_enq'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>
        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_enq'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure> 

    </body>
</html>