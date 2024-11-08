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
        <meta name="description" content="View and celebrate your contributions to plant classification! Explore the Plant Identification Hub to see your discoveries and insights shared with the community" />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Discover Your Green Treasures </title>
        <link rel="stylesheet" href="styles/style.css">
        <link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    </head>

    <body>
        <header id="top_search">
            <?php include 'include/header.php'; ?>
        </header>

        <article>
            <?php include 'include/chatbot.php'; ?>

            <div class="contributor-background-layout">

                <?php
                // Connect to the database
                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // Check if a search term is provided
                $searchQuery = "";
                if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
                    $searchInput = trim($_GET['search']);
                    $searchQuery = mysqli_real_escape_string($conn, $searchInput);
                    $query = "SELECT * FROM Contribute WHERE Plant_Name LIKE '%$searchQuery%' 
                            OR Plant_Family LIKE '%$searchQuery%' 
                            OR Plant_Genus LIKE '%$searchQuery%'
                            OR Plant_Species LIKE '%$searchQuery%'";
                } else {
                    $query = "SELECT * FROM Contribute";
                }

                $result = mysqli_query($conn, $query);
                $row = 0;

                // Display results
                if ($result && mysqli_num_rows($result) > 0) {
                    echo"
                        <div>
                            <h1 class='contributor-layout-heading'>
                                <span class='line'></span>
                                DISCOVER THE TREASURES UNEARTHED
                                        <br>
                                    BY OUR CONTRIBUTORS
                                <span class='line'></span>
                            </h1>
                        </div>
                        ";
                    while ($contribution = mysqli_fetch_assoc($result)) {
                        if($row>9){
                            break;
                        }
                        if($row % 2 == 0){
                            echo "
                            <div class='horizontal-contributecard-layout-line'>
                                <div class='contributor-card-content'>
                                    <div class='contributor-card-wrapper'>
                                        <div class='contributor-card'>
                                            <div class='contributor-image-content'>
                                                <span class='contributor-overlay'></span>
                                                <div class='contributor-image'>";
                                                if ($contribution['Picture_Option'] == 'picture1') {
                                                    echo "<img src='images/boy_icon.png' alt='boy_icon' class='contributor-img'>";
                                                }
                                                else if ($contribution['Picture_Option'] == 'picture2') {
                                                    echo "<img src='images/girl_icon.png' alt='girl_icon' class='contributor-img'>";
                                                }
                                                else if ($contribution['Picture_Option'] == 'picture3') {
                                                    echo "<img src='images/man_icon.png' alt='man_icon' class='contributor-img'>";
                                                }
                                                else if ($contribution['Picture_Option'] == 'picture4') {
                                                    echo "<img src='images/woman_icon.png' alt='woman_icon' class='contributor-img'>";
                                                }
                                                echo "
                                                </div>
                                            </div>
                                            <div class='contributor-content'>
                                                <h2 class='contributor-name'>".$contribution['Username']."</h2>
                                                <br>
                                                <div>";
                                                    $tags = explode(', ', $contribution['Tag']);
                                                    foreach ($tags as $tag) {
                                                            if($tag == 'None'){
                                                                echo "<span class='tag1'>None</span><br><br>";
                                                            }
                                                            elseif($tag == 'Botanical Nomenclature Expert'){
                                                                echo "<span class='tag2'>Botanical Nomenclature Expert</span><br><br>";
                                                            }
                                                            elseif($tag == 'Plant Taxonomist'){
                                                                echo "<span class='tag3'>Plant Taxonomist</span><br><br>";
                                                            }
                                                            elseif($tag == 'Plant Systematics Expert'){
                                                                echo "<span class='tag4'>Plant Systematics Expert</span><br><br>";
                                                            }
                                                            elseif($tag == 'Herbarium Specimen Identifier'){
                                                                echo "<span class='tag5'>Herbarium Specimen Identifier</span><br><br>";
                                                            }
                                                        }
                                                echo "
                                                </div>
                                                <br>
                                                <ul class='contributor-description'>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Plant's Name:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Plant_Name']."
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Plant's Family:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Plant_Family']."
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Plant's Genus:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Plant_Genus']."
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Plant's Species:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Plant_Species']."
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Description:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Description_Contribute']."
                                                    </li>
                                                </ul>
                                                <form class='contributor-card-comment-section'>
                                                    <input type='checkbox' id='open-comment$row'>
                                                    <label for='open-comment$row'>
                                                        <span class='contributor-button-comments'>Comment</span>
                                                        <img src='images/close_icon.png' class='contributor-close-comments' alt='Close Icon'>
                                                    </label>
                                                    <textarea placeholder='Write Down Your Opinions!'></textarea>
                                                    <input type='submit' value='Submit'>
                                                </form>
                                            </div>
                                        </div>
                                        <div class='picture-findings-contributor'>
                                            <figure class='picture-shown-right'>
                                                <img src='" . $contribution['Plant_Leaf_Photo'] . "' alt='" . $contribution['Plant_Name'] . "'s Leaf'>
                                                <span>Plant's Leaf</span>
                                            </figure>
                                            <figure class='picture-shown-right'>
                                                <img src='" . $contribution['Plant_Herbarium_Photo'] . "' alt='" . $contribution['Plant_Name'] . "'s Herbarium Specimen'>
                                                <span>Herbarium Specimen</span>
                                            </figure>
                                        </div>
                                    </div>
                                </div>";
                        }
                        else{
                            echo "
                            <br class='column-display-contribute'>
                            <br class='column-display-contribute'>
                            <div class='contributor-card-content'>
                                    <div class='contributor-card-wrapper'>
                                        <div class='contributor-card'>
                                            <div class='contributor-image-content'>
                                                <span class='contributor-overlay'></span>
                                                <div class='contributor-image'>";
                                                    if ($contribution['Picture_Option'] == 'picture1') {
                                                        echo "<img src='images/boy_icon.png' alt='boy_icon' class='contributor-img'>";
                                                    }
                                                    else if ($contribution['Picture_Option'] == 'picture2') {
                                                        echo "<img src='images/girl_icon.png' alt='girl_icon' class='contributor-img'>";
                                                    }
                                                    else if ($contribution['Picture_Option'] == 'picture3') {
                                                        echo "<img src='images/man_icon.png' alt='man_icon' class='contributor-img'>";
                                                    }
                                                    else if ($contribution['Picture_Option'] == 'picture4') {
                                                        echo "<img src='images/woman_icon.png' alt='woman_icon' class='contributor-img'>";
                                                    }
                                                    echo "
                                                </div>
                                            </div>
                                            <div class='contributor-content'>
                                                <h2 class='contributor-name'>".$contribution['Username']."</h2>
                                                <br>
                                                <div>";
                                                    $tags = explode(', ', $contribution['Tag']);
                                                    foreach ($tags as $tag) {
                                                            if($tag == 'None'){
                                                                echo "<span class='tag1'>None</span><br><br>";
                                                            }
                                                            elseif($tag == 'Botanical Nomenclature Expert'){
                                                                echo "<span class='tag2'>Botanical Nomenclature Expert</span><br><br>";
                                                            }
                                                            elseif($tag == 'Plant Taxonomist'){
                                                                echo "<span class='tag3'>Plant Taxonomist</span><br><br>";
                                                            }
                                                            elseif($tag == 'Plant Systematics Expert'){
                                                                echo "<span class='tag4'>Plant Systematics Expert</span><br><br>";
                                                            }
                                                            elseif($tag == 'Herbarium Specimen Identifier'){
                                                                echo "<span class='tag5'>Herbarium Specimen Identifier</span><br><br>";
                                                            }
                                                        }
                                                echo "
                                                </div>
                                                <br>
                                                <ul class='contributor-description'>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Plant's Name:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Plant_Name']."
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Plant's Family:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Plant_Family']."
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Plant's Genus:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Plant_Genus']."
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Plant's Species:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Plant_Species']."
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            <span class='contributor-description-heading'>
                                                                Description:
                                                            </span>
                                                        </strong>
                                                        ".$contribution['Description_Contribute']."
                                                    </li>
                                                </ul>
                                                <form class='contributor-card-comment-section'>
                                                    <input type='checkbox' id='open-comment$row'>
                                                    <label for='open-comment$row'>
                                                        <span class='contributor-button-comments'>Comment</span>
                                                        <img src='images/close_icon.png' class='contributor-close-comments' alt='Close Icon'>
                                                    </label>
                                                    <textarea placeholder='Write Down Your Opinions!'></textarea>
                                                    <input type='submit' value='Submit'>
                                                </form>
                                            </div>
                                        </div>
                                        <div class='picture-findings-contributor'>
                                            <figure class='picture-shown-right'>
                                                <img src='" . $contribution['Plant_Leaf_Photo'] . "' alt='" . $contribution['Plant_Name'] . "'s Leaf'>
                                                <span>Plant's Leaf</span>
                                            </figure>
                                            <figure class='picture-shown-right'>
                                                <img src='" . $contribution['Plant_Herbarium_Photo'] . "' alt='" . $contribution['Plant_Name'] . "'s Herbarium Specimen'>
                                                <span>Herbarium Specimen</span>
                                            </figure>
                                        </div>
                                    </div>
                            </div>
                        </div>";
                        }
                        $row++;
                    }
                    if($row%2!=0){
                        echo"</div";
                    }
                }
                 else {
                    echo "<div id='no-results'>
                            <figure id='nofound'>
                                <img src='images/nofound.png' alt='No found Picture'>
                            </figure>
                            <h1 id='no-results-heading'>Error #404</h1>   
                            <p class='no-results-message'>No contributions found" . (!empty($searchQuery) ? " for '<strong>" . htmlspecialchars($searchQuery) . "</strong>'" : "") . ".</p>
                            <p class='no-results-message'> Try to search other things </p>
                            <p class='no-results-message'>Press <a href='index.php' title='Go Back To Home Page'>me</a> go back to home page.</p>
                            <br>
                          </div>";
                }
                ?>

                <br>
                
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    echo"<div>
                            <p class='button-contribute'><a href='contribute.php'>Become Our Contributor</a></p>
                        </div>";
                }
                ?>

                <figure class='going-up-container'>
                    <a href='#top_search'>
                        <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                    </a>
                </figure>

            </div>

        </article>

        <footer>
            <?php include 'include/footer.php'; ?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_search'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>


    </body>
</html>
