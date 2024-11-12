<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start();

    $error = '';
    $message = '';
    $error_connection = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION['username'])) {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
    
            if (!$conn) {
                $error_connection = "We're experiencing technical difficulties connecting to our database. Please try again later.";
            } else {
                $username = $_SESSION['username'];
                
                if (isset($_POST['rating'])) {
                    
                    $feedback = filter_var($_POST['rating'], FILTER_VALIDATE_INT);
    
                    $query = "SELECT * FROM Feedback WHERE Username='$username'";
                    $result = mysqli_query($conn, $query);
                    
                    if (mysqli_num_rows($result) > 0) {
                        $error = "It looks like you've already provided your feedback. Thank you for sharing your thoughts!";
                    } else {
                        $sql = "INSERT INTO Feedback (Username, Feedback_Mark) VALUES ('$username', '$feedback')";
                        if (mysqli_query($conn, $sql)) {
                            $message = "Thank you for your feedback! We truly appreciate your support.";
                        } else {
                            $error_connection = "We encountered an issue while saving your feedback. Please try again later. If the problem persists, kindly reach out to our <a href='mailto:104386568@students.swinburne.edu.my'>support team</a>.";
                        }
                    }
                } else {
                    $error = "Please select a rating before submitting.";
                }
                
                mysqli_close($conn);
            }
        } else {
            $error = "Please log in to submit your feedback. We value your input!";
        }
    }
    
?>


<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Explore the captivating world of botany with Plant's Notebook. Know the essential tools and learn how to create and preserve herbarium specimens, classify plants, and discover the amazing plant identification in Plant's Notebook. Perfect for botanists, hobbyists, and nature enthusiasts." />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Your Guide to Botany and Herbarium</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_index">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>

            <div class="image-text">
                <figure class="non-displayfirst">
                    <img src="images/classification_index.jpg" alt="Plant Classification" class="index-img"> 
                </figure>
                <div class="desc1">
                    <h3><span class="line1">UNCOVERING THE </span><span class="line2">SECRETS BEHIND PLANTS</span></h3>
                    <p>Dive into the fascinating kingdom of botany with us as we explore the mysterious and extraordinary secrets behind various flora.</p>
                    <p>Join us on the journey that reveals the incredible stories and untold traits of green around us.</p>
                    <div class="button-index">
                        <p>
                            <span class="space_button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a href="classify.php" title="Go To The Plant Classification">Explore Now
                            </a>
                        </p>
                    </div>
                </div>
                <figure id="special_case">
                    <img src="images/classification_index.jpg" alt="Plant Classification" class="index-img"> 
                </figure>
            </div>


            <div class="rate-text">
                <div class="rate-text-desc">
                    <p>We Value Your Feedback Rate Us !</p>
                    <form class="rating-form" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate="novalidate">
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" class="star">&#9733;</label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" class="star">&#9733;</label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" class="star">&#9733;</label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" class="star">&#9733;</label>
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" class="star">&#9733;</label>
                        <button id="submit-feedback">Submit</button>
                    </form>
                </div>
            </div>

            

            <div class="image-text">
                <figure>
                    <img src="images/identify_index.jpg" alt="Plant Identification" class="index-img"> 
                </figure>
                <div class="desc1">
                    <h3><span class="line1">PLANT IDENTIFICATION</span><span class="line2">HUB INTRODUCED</span></h3>
                    <p>Simply submit a photo, and our system will provide you with the scientific name, common name, and images of herbarium specimens for the plant. </p>
                    <p> Immerse in and start exploring the fascinating world of plant identification!</p>
                    <div class="button-index">
                        <p>
                            <span class="space_button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a href="identify.php" title="Go to The Plant Identification Hub">
                                Capture Now
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="white_region">
                <div class="desc1white_region">
                    <h3>
                        <span class="line"></span>
                        FROM FRESH LEAVES TO PRESERVED
                        <br class="forline">
                        SPECIMENS : LEARN HOW
                        <span class="line"></span>
                    </h3>
                    <div class="white_region-green_region">
                        <p>From transferring fresh leaves into herbarium specimens to understanding the essential tools and preservation techniques, we have got you covered. Try and discover the captivating world of herbarium preparation!</p>
                        <div class="grid_tutorial">
                            <img src="images/tutorial(tutorial)_index.jpg" alt="herbarium products">
                            <div class="grid_tutorial_layer">
                                <div class="desc_grid_tutorial">
                                    <p>This tutorial will provide you with the knowledge and tips needed to create high-quality herbarium specimens.</p>
                                    <p><a href="tutorial.php"><span class="hiddenword">Let Us Explore More !</span></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="grid_tutorial">
                            <img src="images/tutorial(tools)_index.jpg" alt="herbarium tools">
                            <div class="grid_tutorial_layer">
                                <div class="desc_grid_tutorial">
                                    <p>From trowels and clippers to presses and preservation materials, we'll cover everything you need to know to get started.</p>
                                    <p><a href="tools.php"><span class="hiddenword">Let Us Explore More !</span></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="grid_tutorial">
                            <img src="images/tutorial(care)_index.jpg" alt="herbarium preserve">
                            <div class="grid_tutorial_layer">
                                <div class="desc_grid_tutorial">
                                    <p>Preserve fresh leaves, ensuring they retain their shape, color, and details for long-term study and display.</p>
                                    <p><a href="care.php"><span class="hiddenword">Let Us Explore More !</span></a></p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="button-grid">
                            <a href="tutorial.php" title="Go To The Tutorial Page">
                                Tutorial
                            </a>
                        </div>
                        <div class="button-grid">
                            <a href="tools.php" title="Go To The Tools Page">
                                Tools
                            </a>
                        </div>
                        <div class="button-grid">
                            <a href="care.php" title="Go To The Care Page">
                                Care
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="white_region">
                <div class="desc1white_region">
                    <div class="heading_white_region_layout">
                        <h3>
                            <span class="line"></span>
                            JOIN OUR COMMUNITY : SHARE YOUR
                            <br class="forline">
                            PLANT DISCOVERIES
                            <span class="line"></span>
                        </h3>
                    </div>
                    <div class="white_region-green_region">
                        <p>We're excited to invite you to contribute  the following information to our ever-growing plant database.Your valuable contributions will be stored in our database and utilized in our Plant Identification Hub, helping fellow plant enthusiasts and researchers identify and learn about various species. </p>
                        <div class="extend-box-layout">
                            <div class="extend-box">
                                <img src="images/plant_name.jpeg" alt="Plant">
                                <div class="extend-box-layer">
                                    <div class="extend-box-info">
                                        <h3><span class="hiddenword_extend">Plant's</span></h3>
                                        <h3><span class="hiddenword_extend">Name</span></h3>
                                        <h3><span class="hiddingthesmallword">Plant's Name</span></h3>
                                        <a href="contribution.php" title="Go To The Contribute Page">Share Your Ideas!</a>
                                    </div>
                                </div>
                            </div>
                            <div class="extend-box">
                                <img src="images/plant_family.jpg" alt="Plant Family">
                                <div class="extend-box-layer">
                                    <div class="extend-box-info">
                                        <h3><span class="hiddenword_extend">Plant's</span></h3>
                                        <h3><span class="hiddenword_extend">Family</span></h3>
                                        <h3 ><span class="hiddingthesmallword">Plant's Family</span></h3>
                                        <a href="contribution.php" title="Go To The Contribute Page">Share Your Ideas!</a>
                                    </div>
                                </div>
                            </div>
                            <div class="extend-box">
                                <img src="images/plant_genus.jpg" alt="Plant Genus">
                                <div class="extend-box-layer">
                                    <div class="extend-box-info">
                                        <h3><span class="hiddenword_extend">Plant's</span></h3>
                                        <h3><span class="hiddenword_extend">Genus</span></h3>
                                        <h3 ><span class="hiddingthesmallword">Plant's Genus</span></h3>

                                        <a href="contribution.php" title="Go To The Contribute Page">Share Your Ideas!</a>
                                    </div>
                                </div>
                            </div>
                            <div class="extend-box">
                                <img src="images/plant_species.jpeg" alt="Plant Species">
                                <div class="extend-box-layer">
                                    <div class="extend-box-info">
                                        <h3><span class="hiddenword_extend">Plant's</span></h3>
                                        <h3><span class="hiddenword_extend">Species</span></h3>
                                        <h3 ><span class="hiddingthesmallword">Plant's Species</span></h3>
                                        <a href="contribution.php" title="Go To The Contribute Page">Share Your Ideas!</a>
                                    </div>
                                </div>
                            </div>
                            <div class="extend-box">
                                <img src="images/plant_leaf.jpeg" alt="Fresh Leaf">
                                <div class="extend-box-layer">
                                    <div class="extend-box-info">
                                        <h3><span class="hiddenword_extend">Fresh</span></h3>
                                        <h3><span class="hiddenword_extend">Leaf</span></h3>
                                        <h3 ><span class="hiddenword_extend">(Photos)</span></h3>
                                        <h3 ><span class="hiddingthesmallword">Fresh Leaf (Photos)</span></h3>
                                        <a href="contribution.php" title="Go To The Contribute Page">Share Your Ideas!</a>
                                    </div>
                                </div>
                            </div>
                            <div class="extend-box">
                                <img src="images/plant_herbarium.jpg" alt="Herbarium Specimen">
                                <div class="extend-box-layer">
                                    <div class="extend-box-info">
                                        <h3><span class="hiddenword_extend">Herbarium</span></h3>
                                        <h3><span class="hiddenword_extend">Specimen</span></h3>
                                        <h3 ><span class="hiddenword_extend">(Photos)</span></h3>
                                        <h3 ><span class="hiddingthesmallword">Herbarium Specimen (Photos)</span></h3>
                                        <a href="contribution.php" title="Go To The Contribute Page">Share Your Ideas!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="white_region">
                <div class="desc1white_region">
                    <div class="heading_white_region_layout">
                        <h3>
                            <span class="line"></span>
                            SEIZE THIS CHANCE BEFORE
                            <br class="forline">
                            IT'S GONE FOREVER
                            <span class="line"></span>
                        </h3>
                    </div>
                    <div class="white_region-green_region">
                        <p>Are you passionate about botany, or simply curious about the world of plant specimens? This is your golden opportunity to delve into the intricate art of herbarium specimen preparation. But hurry—this offer won't last long! You may flip cards below to see the infos needed and share your problems.</p>
                        <div class="flip-box-layout">
                            <a href="enquiry.php" title="Go To The Enquiry Form">
                                <div class="flip-box">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front">
                                            <img src="images/question_mark.jpg" alt="Question Mark">
                                        </div>
                                        <div class="flip-box-back">
                                            <img src="images/name_index.png" alt="Name Tag">
                                            <h3><span class="shorter">Name</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="enquiry.php" title="Go To The Enquiry Form">
                                <div class="flip-box">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front">
                                            <img src="images/question_mark.jpg" alt="Question Mark">
                                        </div>
                                        <div class="flip-box-back">
                                            <img src="images/email_index.png" alt="Email Address">
                                            <h3>Email Address</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="enquiry.php" title="Go To The Enquiry Form">
                                <div class="flip-box">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front">
                                            <img src="images/question_mark.jpg" alt="Question Mark">
                                        </div>
                                        <div class="flip-box-back">
                                            <img src="images/phone_index.png" alt="Phone Calling">
                                            <h3>Contact Num.</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="enquiry.php" title="Go To The Enquiry Form">
                                <div class="flip-box">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front">
                                            <img src="images/question_mark.jpg" alt="Question Mark">
                                        </div>
                                        <div class="flip-box-back">
                                            <img src="images/address_index.png" alt="Address Icon">
                                            <h3><span class="short">Address</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="enquiry.php" title="Go To The Enquiry Form">
                                <div class="flip-box">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front">
                                            <img src="images/question_mark.jpg" alt="Question Mark">
                                        </div>
                                        <div class="flip-box-back">
                                            <img src="images/Question.png" alt="Question">
                                            <h3><span class="short">Question</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="enquiry.php" title="Go To The Enquiry Form">
                                <div class="flip-box">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front">
                                            <img src="images/question_mark.jpg" alt="Question Mark">
                                        </div>
                                        <div class="flip-box-back">
                                            <img src="images/fillingform.png" alt="Filling Form" >
                                            <h3><span class="short">Fill Now!</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            &nbsp;
                        </div>
                    </div>
                </div>

            </div>

            <figure class='going-up-container'>
                <a href='#top_index'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>


        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_index'>
                <img src='images/going_up.png' alt='going-up' class='going-up' title="going to the top">
            </a>
        </figure>

    </body>

</html>
