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
        <meta name="description" content="This is confirm page about the contribute submission" />
        <meta name="keywords" content="" />
        <meta name="author" content="Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Contribute Confirmation</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>

    <body>
        <header id="top_ctprocess">
            <?php include 'include/header.php';?>
        </header>

        <?php
            include 'database/connection.php';
            include 'database/database.php';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                //Connect Again
                $conn = mysqli_connect($servername,$username,$password,$dbname);

                $username = mysqli_real_escape_string($conn, $_SESSION['username']);
                $picture_option = mysqli_real_escape_string($conn, $_POST['Picture_Option']);
                $tag_option = mysqli_real_escape_string($conn, implode(', ', $_POST['Tag']));
                $plantname = mysqli_real_escape_string($conn, $_POST['PlantName']);
                $plantfamily = mysqli_real_escape_string($conn, $_POST['plant-family']);
                $plantgenus = mysqli_real_escape_string($conn, $_POST['plant-genus']);
                $plantspecies = mysqli_real_escape_string($conn, $_POST['plant-species']);
                $contributedescription = mysqli_real_escape_string($conn, $_POST['plant-contribute-comment']);
                

                // Validation
                $error = '';
                $error_connection ='';
                $message = '';
                $spam = '';
                
                //Picture Option
                if(empty(trim($picture_option))){
                    $error .= "Please select the picture which you want to be displayed in the contribution page.<br>";
                }

                //Tag Option
                if(empty(trim($tag_option))){
                    $error .= "Please select at least one tag to describe your find.<br>";
                }

                //Plant Name
                if(empty(trim($plantname))){
                    $error .= "Please type the plant name <br>";
                }
                else if(!preg_match('/^[a-zA-Z\s]+$/', $plantname)){
                    $error .= "Only alphabetic characters and spaces are allowed.<br>";
                }

                //Plant Family
                if(empty(trim($plantfamily))){
                    $error .= "Please select the plant family.<br>";
                }
                
                //Plant Genus
                if(empty(trim($plantgenus))){
                    $error .= "Please select the plant genus.<br>";
                }

                //Plant Species
                if(empty(trim($plantspecies))){
                    $error .= "Please select the plant species.<br>";
                }

                // File Uploads
                $upload_dir = 'contributeuploads/';
                $plantleaf_path = '';
                $plantherbarium_path = '';

                if (isset($_FILES['plant-leaf-photo']) && $_FILES['plant-leaf-photo']['error'] == 0) {
                    $plantleaf_path = $upload_dir . basename($_FILES['plant-leaf-photo']['name']);
                    if (!move_uploaded_file($_FILES['plant-leaf-photo']['tmp_name'], $plantleaf_path)) {
                        $error .= "Failed to upload the leaf photo.<br>";
                    }
                } else {
                    $error .= "Leaf photo is required.<br>";
                }

                if (isset($_FILES['plant-herbarium-photo']) && $_FILES['plant-herbarium-photo']['error'] == 0) {
                    $plantherbarium_path = $upload_dir . basename($_FILES['plant-herbarium-photo']['name']);
                    if (!move_uploaded_file($_FILES['plant-herbarium-photo']['tmp_name'], $plantherbarium_path)) {
                        $error .= "Failed to upload the herbarium photo.<br>";
                    }
                } else {
                    $error .= "Herbarium photo is required.<br>";
                }

                if(empty(trim($contributedescription))){
                    $error .= "Please leave comment about your finds.<br>";
                }
                else if(!preg_match('/^.{100,2000}$/', $contributedescription)){
                    $error .= "Please leave a comment between 100 and 2000 characters.<br>";
                }

                $check_duplicate_sql = "SELECT * FROM Contribute 
                                WHERE Username = '$username' 
                                AND Tag = '$tag_option' 
                                AND Plant_Name = '$plantname' 
                                AND Plant_Family = '$plantfamily' 
                                AND Plant_Genus = '$plantgenus' 
                                AND Plant_Species = '$plantspecies'
                                AND Description_Contribute = '$contributedescription'";
                $result = mysqli_query($conn, $check_duplicate_sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $spam = "It looks like you've already submitted this contribution. Duplicate entries are not allowed.";
                }

                // No error
                if ($error == '' && $spam == '')
                {
                    $sql = "INSERT INTO Contribute (Username, Picture_Option, Tag, Plant_Name, Plant_Family, Plant_Genus, Plant_Species, Plant_Leaf_Photo, Plant_Herbarium_Photo, Description_Contribute) 
                    VALUES ('$username', '$picture_option', '$tag_option', '$plantname', '$plantfamily', '$plantgenus', '$plantspecies', '$plantleaf_path', '$plantherbarium_path', '$contributedescription')";            
                    if (mysqli_query($conn, $sql)){
                        $message = "Your contribution has been submitted successfully, and it is displayed in the contribution page. Go there to take a look!";
                    }
                    else{
                        $error_connection = "We're sorry, but we couldn't store your data due to a technical issue with our database. Please try again later. If the issue persists, feel free to reach out to our <a href='mailto:104386568@students.swinburne.edu.my'>support team</a> for assistance.";
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

            <div class="image-text">
                <div class="confirm_card">
                    <?php
                        echo '<p class="small_word_confirm">Plant\'s Notebook / CONFIRM</p>';
                        if($spam !== ''){
                            echo '<h1 class="title_confirm">WARNING !</h1>';
                            echo '<p class="confirm_words">' . $spam . '</p>';
                        }
                        else if ($error !== ''){
                            echo '<h1 class="title_confirm">SORRY !</h1>';
                            echo '<p class="confirm_words"><span class="fail_words">Input Invalid</span>: <br>' . $error . '</p>';
                            echo '<p class="confirm_words invalid_handle">Please check your input and <a href="contribute.php">try again</a>. If the problem persists, contact our <a href="mailto:104386568@students.swinburne.edu.my">customer service team </a>for assistance.</p>';
                            echo '<p class="small_word_confirm">If you have any further questions or need immediate assistance, please don\'t hesitate to reach out to our <a href="mailto:104386568@students.swinburne.edu.my">customer service team </a>.You will redirect back to the Contribute Page within 2 seconds.</p>';
                            echo '<meta http-equiv="refresh" content="2 ;url=contribute.php">';

                        }
                        else if ($error_connection !== ''){
                            echo '<h1 class="title_confirm">SORRY !</h1>';
                            echo '<p class="confirm_words"><span class="fail_words">Errors</span>: ' . $error_connection . 'Please <a href="contribute.php">try submitting your request again </a>in a few moments. If the problem persists, feel free to reach out to our <a href="mailto:104386568@students.swinburne.edu.my">support team</a> for further assistance. We apologize for any inconvenience and appreciate your patience.</p>';
                        }
                        else if ($message !== ''){
                            echo '<h1 class="title_confirm">THANK YOU !</h1>';
                            echo '<p class="confirm_words"><span class="success_words">Success</span>: ' . $message . '</p>';
                            echo '<a class="button_view_confirm" href="contribute.php"> View Your Contribute Details</a>';
                            echo '<p class="small_word_confirm">If you have any further questions or need immediate assistance, please don\'t hesitate to reach out to our <a href="mailto:104386568@students.swinburne.edu.my">customer service team </a>.You will redirect back to the Contribution Page within 2 seconds.</p>';
                            echo '<meta http-equiv="refresh" content="2 ;url=contribution.php">';
                        }
                    ?>
                </div>
            </div>

        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_ctprocess'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure> 

    </body>

</html>
