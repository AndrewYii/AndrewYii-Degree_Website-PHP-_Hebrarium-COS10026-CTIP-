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

        <header id="top_contribution">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>
            
            <div class="contributor-background-layout">
                <div>
                    <h1 class="contributor-layout-heading">
                        <span class="line"></span>
                        DISCOVER THE TREASURES UNEARTHED
                        <br class="forline">
                        BY OUR CONTRIBUTORS
                        <span class="line"></span>
                    </h1>
                </div>
                <div class="horizontal-contributecard-layout-line">
                    <div class="contributor-card-content">
                        <div class="contributor-card-wrapper">
                            <div class="contributor-card">
                                <div class="contributor-image-content">
                                    <span class="contributor-overlay"></span>
                                    <div class="contributor-image">
                                        <img src="images/boy_icon.png" alt="boy_icon" class="contributor-img">
                                    </div>
                                </div>
                                <div class="contributor-content">
                                    <h2 class="contributor-name">Leoooooooooo</h2>
                                    <br>
                                    <div>
                                       <span class="tag3">Plant Taxonomist</span> <br><br> <span class="tag4">Plant Systematics Expert </span> <br><br> <span class="tag5">Herbarium Specimen Identifier</span>
                                    </div>
                                    <br>
                                    <ul class="contributor-description">
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Name:
                                                </span>
                                            </strong>
                                            Vatica Najibiana
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Family:
                                                </span>
                                            </strong>
                                            Dipterocarpaceae
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Genus:
                                                </span>
                                            </strong>
                                            Vatica
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Species:
                                                </span>
                                            </strong>
                                            Najibiana
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Description:
                                                </span>
                                            </strong>
                                            Let me introduce you to the Vatica genus, a fascinating group of trees in the Dipterocarpaceae family. One notable species is Vatica najibiana, found in the lush forests of Peninsular Malaysia, specifically in Kelantan and Pahang.
                                        </li>
                                    </ul>
                                    <form class="contributor-card-comment-section">
                                        <input type="checkbox" id="open-comment">
                                        <label for="open-comment">
                                            <span class="contributor-button-comments">Comment</span>
                                            <img src="images/close_icon.png" class="contributor-close-comments" alt="Close Icon">
                                        </label>
                                        <textarea placeholder="Write Down Your Opinions!"></textarea>
                                        <input type="submit" value="Submit">
                                    </form>
                                </div>
                            </div>
                            <div class="picture-findings-contributor">
                                <figure class="picture-shown-right">
                                    <img src="images/vaticanajibianaleafphoto.jpg" alt="Vatica Najibiana's Leaf">
                                    <span>Plant's Leaf</span>
                                </figure>
                                <figure class="picture-shown-right">
                                    <img src="images/vaticanajibianaherbariumspecimen.jpeg" alt="Vatica Najibiana's Herbarium Specimen">
                                    <span>Herbarium Specimen</span>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <br class="column-display-contribute">
                    <br class="column-display-contribute">
                    <div class="contributor-card-content">
                        <div class="contributor-card-wrapper">
                            <div class="contributor-card">
                                <div class="contributor-image-content">
                                    <span class="contributor-overlay"></span>
                                    <div class="contributor-image">
                                        <img src="images/girl_icon.png" alt="girl_icon" class="contributor-img">
                                    </div>
                                </div>
                                <div class="contributor-content">
                                    <h2 class="contributor-name">Joanelyn</h2>
                                    <br>
                                    <div>
                                       <span class="tag3">Plant Taxonomist</span> <br><br> <span class="tag5">Herbarium Specimen Identifier</span>
                                    </div>
                                    <br>
                                    <ul class="contributor-description">
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Name:
                                                </span>
                                            </strong>
                                            Dipterocarpus Baudii
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Family:
                                                </span>
                                            </strong>
                                            Dipterocarpaceae
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Genus:
                                                </span>
                                            </strong>
                                            Dipterocarpus
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Species:
                                                </span>
                                            </strong>
                                            Baudii
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Description:
                                                </span>
                                            </strong>
                                            I recently found the fascinating Dipterocarpus baudii in the tropical forests of Peninsular Malaysia. This evergreen tree can grow up to 30 meters tall, with a trunk that remains branch-free for up to 20 meters. Its obovate-elliptic leaves and fragrant flowers make it a standout in the forest.
                                        </li>
                                    </ul>
                                    <form class="contributor-card-comment-section">
                                        <input type="checkbox" id="open-comment1">
                                        <label for="open-comment1">
                                            <span class="contributor-button-comments">Comment</span>
                                            <img src="images/close_icon.png" class="contributor-close-comments" alt="Close Icon">
                                        </label>
                                        <textarea placeholder="Write Down Your Opinions!"></textarea>
                                        <input type="submit" value="Submit">
                                    </form>
                                </div>
                            </div>
                            <div class="picture-findings-contributor">
                                <figure class="picture-shown-right">
                                    <img src="images/Dipterocarpus-baudiileafphoto.jpg" alt="Dipterocarpus Baudii's Leaf">
                                    <span>Plant's Leaf</span>
                                </figure>
                                <figure class="picture-shown-right">
                                    <img src="images/Dipterocarpus_bauddin_herbariumspecimen.jpg" alt="Dipterocarpus Baudii's Herbarium Specimen">
                                    <span>Herbarium Specimen</span>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="horizontal-contributecard-layout-line detect-con">
                    <div class="contributor-card-content">
                        <div class="contributor-card-wrapper">
                            <div class="contributor-card">
                                <div class="contributor-image-content">
                                    <span class="contributor-overlay"></span>
                                    <div class="contributor-image">
                                        <img src="images/man_icon.png" alt="man_icon" class="contributor-img">
                                    </div>
                                </div>
                                <div class="contributor-content">
                                    <h2 class="contributor-name">HakunaMatata</h2>
                                    <br>
                                    <div class="tag-layout">
                                        <span class="tag1">None</span>
                                    </div>
                                    <br>
                                    <ul class="contributor-description">
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Name:
                                                </span>
                                            </strong>
                                            Actinodaphne Angustifolia
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Family:
                                                </span>
                                            </strong>
                                            Lauraceae
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Genus:
                                                </span>
                                            </strong>
                                            Actinodaphne
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Species:
                                                </span>
                                            </strong>
                                            Angustifolia
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Description:
                                                </span>
                                            </strong>
                                            I recently encountered the intriguing Actinodaphne angustifolia in the tropical forests of Peninsular Malaysia. This medium-sized evergreen tree is part of the Lauraceae family and is known for its elliptic or oblong-lanceolate leaves, which are often pendulous and covered in reddish hairs.
                                        </li>
                                    </ul>
                                    <form class="contributor-card-comment-section">
                                        <input type="checkbox" id="open-comment2">
                                        <label for="open-comment2">
                                            <span class="contributor-button-comments">Comment</span>
                                            <img src="images/close_icon.png" class="contributor-close-comments" alt="Close Icon">
                                        </label>
                                        <textarea placeholder="Write Down Your Opinions!"></textarea>
                                        <input type="submit" value="Submit">
                                    </form>
                                </div>
                            </div>
                            <div class="picture-findings-contributor">
                                <figure class="picture-shown-right">
                                    <img src="images/Actinodaphne_angustifolia_leafphoto.jpg"  alt="Actinodaphne Angustifolia's Leaf">
                                    <span>Plant's Leaf</span>
                                </figure>
                                <figure class="picture-shown-right">
                                    <img src="images/Actinodaphne_angustifolia_herbariumspecimen.jpg" alt="Actinodaphne Angustifolia's Herbarium Specimen">
                                    <span>Herbarium Specimen</span>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <br class="column-display-contribute">
                    <br class="column-display-contribute">
                    <div class="contributor-card-content">
                        <div class="contributor-card-wrapper">
                            <div class="contributor-card">
                                <div class="contributor-image-content">
                                    <span class="contributor-overlay"></span>
                                    <div class="contributor-image">
                                        <img src="images/woman_icon.png" alt="woman_icon" class="contributor-img">
                                    </div>
                                </div>
                                <div class="contributor-content">
                                    <h2 class="contributor-name">Cinderellilia</h2>
                                    <br>
                                    <div>
                                        <span class="tag2">Botanical Nomenclature Expert</span> <br><br><span class="tag3">Plant Taxonomist</span><br><br> <span class="tag4">Plant Systematics Expert </span>
                                    </div>
                                    <br>
                                    <ul class="contributor-description">
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Name:
                                                </span>
                                            </strong>
                                            Santiria Impressinervis
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Family:
                                                </span>
                                            </strong>
                                            Burseraceae
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Genus:
                                                </span>
                                            </strong>
                                            Santiria
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Plant's Species:
                                                </span>
                                            </strong>
                                            Impressinervis
                                        </li>
                                        <li>
                                            <strong>
                                                <span class="contributor-description-heading">
                                                    Description:
                                                </span>
                                            </strong>
                                            I recently came across the fascinating Santiria impressinervis in the Kelabit Highlands of Sarawak, Malaysia. This tree, part of the Burseraceae family, is known for its unique characteristics and ecological importance.
                                        </li>
                                    </ul>
                                    <form class="contributor-card-comment-section">
                                        <input type="checkbox" id="open-comment3">
                                        <label for="open-comment3">
                                            <span class="contributor-button-comments">Comment</span>
                                            <img src="images/close_icon.png" class="contributor-close-comments" alt="Close Icon">
                                        </label>
                                        <textarea placeholder="Write Down Your Opinions!"></textarea>
                                        <input type="submit" value="Submit">
                                    </form>
                                </div>
                            </div>
                            <div class="picture-findings-contributor">
                                <figure class="picture-shown-right">
                                    <img src="images/sanitriaimpressinverisleafphoto.jpeg" alt="Santiria Impressinervis's Leaf">
                                    <span>Plant's Leaf</span>
                                </figure>
                                <figure class="picture-shown-right">
                                    <img src="images/sanitriaimpressinverisherbariumspecimen.jpg" alt="Santiria Impressinervis's Herbarium Specimen">
                                    <span>Herbarium Specimen</span>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div>
                    <p class="button-contribute"><a href="contribute.php">Become Our Contributor</a></p>
                </div>

                <figure class='going-up-container'>
                    <a href='#top_contribute'>
                        <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                    </a>
                </figure>
            </div>z
            

            
        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_contribution'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>


    </body>

</html>