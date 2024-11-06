<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start(); 

    if (!isset($_SESSION['username'])) {
        echo "<div class='cannot-access'>
                <div class='snackbar show error'>
                    Sorry, you need to log in to your account before enjoying our contribute features.<br>
                    You will be redirected to the login page within 2 seconds.
                </div>
              </div>
              <meta http-equiv='refresh' content='2 ;url=login.php'>";
    }

?>


<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Contribute your innovative ideas and insights to enhance our Plant Identification Hub Database and share your findings with other Enthusiasts" />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Contribute Your Findings </title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_contribute">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>

            <div class="contribute-form-background-layout">
                <div class="contribute-form-layout">
                    <form action="contribute_process.php" method="post" enctype="multipart/form-data">

                        <input type="reset" class="contribute-word">

                        <h1>
                            Contribute Your Finds!
                        </h1>

                        <fieldset class="contribute-fieldset">

                            <legend>
                                Personalise Your Contribute Card
                            </legend>

                            <div class="contribute-input">
                                <span class="contribute-form-info">Select The Photo You Prefer</span>
                                <br>
                                <input type="radio" id="picture1" name="Picture_Option" value="picture1" checked="checked">
                                <label for="picture1">
                                    <img src="images/boy_icon.png" alt="Boy Profile Picture" class="contribute-form-picture">
                                </label>
                                <input type="radio" id="picture2" name="Picture_Option" value="picture2" required="required">
                                <label for="picture2">
                                    <img src="images/girl_icon.png" alt="Girl Profile Picture" class="contribute-form-picture">
                                </label>
                                <input type="radio" id="picture3" name="Picture_Option" value="picture3" required="required">
                                <label for="picture3">
                                    <img src="images/man_icon.png" alt="Man Profile Picture" class="contribute-form-picture">
                                </label>
                                <input type="radio" id="picture4" name="Picture_Option" value="picture4" required="required">
                                <label for="picture4">
                                    <img src="images/woman_icon.png" alt="Woman Profile Picture" class="contribute-form-picture">
                                </label>
                            </div>


                            <div class="contribute-input">
                                <span class="contribute-form-info">Select Some Description About You</span>
                                <br>
                                <input type="checkbox" id="tag1" name="Tag[]" value="None" checked="checked">
                                <label for="tag1">
                                    None
                                </label>
                            </div>
                            <div class="contribute-input">
                                <input type="checkbox" id="tag2" name="Tag[]" value="Botanical Nomenclature Expert">
                                <label for="tag2">
                                    Botanical Nomenclature Expert
                                </label>
                            </div>
                            <div class="contribute-input">
                                <input type="checkbox" id="tag3" name="Tag[]" value="Plant Taxonomist">
                                <label for="tag3">
                                    Plant Taxonomist
                                </label>
                            </div>
                            <div class="contribute-input">
                                <input type="checkbox" id="tag4" name="Tag[]" value="Plant Systematics Expert">
                                <label for="tag4">
                                    Plant Systematics Expert
                                </label>
                            </div>
                            <div class="contribute-input">
                                <input type="checkbox" id="tag5" name="Tag[]" value="Herbarium Specimen Identifier">
                                <label for="tag5">
                                    Herbarium Specimen Identifier
                                </label>
                            </div>
                        </fieldset>

                        <fieldset class="contribute-fieldset">

                            <legend>Voice Out Your Find</legend>

                            <div class="contribute-input">
                                <label for="plant-name">
                                    <span class="contribute-form-info">Plant's Name</span>
                                </label>
                                <input type="text" id="plant-name" name="PlantName">
                            </div>

                            <div class="contribute-input">
                                <label for="plant-family">
                                    <span class="contribute-form-info">Plant's Family</span>
                                </label>

                                <select name="plant-family" id="plant-family" required="required">
                                  <option value="">Select The Plant Family</option>
                                  <option value="Dipterocarpaceae">Dipterocarpaceae</option>
                                  <option value="Lauraceae">Lauraceae</option>
                                  <option value="Burseraceae">Burseraceae</option>
                                </select>
                            </div>

                            <div class="contribute-input">
                                <label for="plant-genus">
                                    <span class="contribute-form-info">Plant's Genus</span>
                                </label>

                                <select name="plant-genus" id="plant-genus">
                                  <option value="">Select The Plant Genus</option>
                                  <option value="Vatica">Vatica</option>
                                  <option value="Dipterocarpus">Dipterocarpus</option>
                                  <option value="Hopea">Hopea</option>
                                  <option value="Actinodaphne">Actinodaphne</option>
                                  <option value="Endiandra">Endiandra</option>
                                  <option value="Beilschmiedia">Beilschmiedia</option>
                                  <option value="Canarium">Canarium</option>
                                  <option value="Dacryodes">Dacryodes</option>
                                  <option value="Santiria">Santiria</option>
                                </select>
                            </div>

                            
                            <div class="contribute-input">
                                <label for="plant-species">
                                    <span class="contribute-form-info">Plant's Species</span>
                                </label>

                                <select name="plant-species" id="plant-species">
                                  <option value="">Select The Plant Species</option>
                                  <option value="Najibiana">Najibiana</option>
                                  <option value="Rynchocarpa">Rynchocarpa</option>
                                  <option value="Coriacea">Coriacea</option>
                                  <option value="Baudii">Baudii</option>
                                  <option value="Cornutus">Cornutus</option>
                                  <option value="Alatus">Alatus</option>
                                  <option value="Odorata">Odorata</option>
                                  <option value="Parviflora">Parviflora</option>
                                  <option value="Jucunda">Jucunda</option>
                                  <option value="Angustifolia">Angustifolia</option>
                                  <option value="Malaccensis">Malaccensis</option>
                                  <option value="Lawsonii">Lawsonii</option>
                                  <option value="Pubens">Pubens</option>
                                  <option value="Acuminata">Acuminata</option>
                                  <option value="Montana">Montana</option>
                                  <option value="Mannii">Mannii</option>
                                  <option value="Recurva">Recurva</option>
                                  <option value="Tarairi">Tarairi</option>
                                  <option value="Odontophyllum">Odontophyllum</option>
                                  <option value="Schweinfurthii">Schweinfurthii</option>
                                  <option value="Harveyi">Harveyi</option>
                                  <option value="Edulis">Edulis</option>
                                  <option value="Rostrata">Rostrata</option>
                                  <option value="Microcarpa">Microcarpa</option>
                                  <option value="Apiculata">Apiculata</option>
                                  <option value="Laevigata">Laevigata</option>
                                  <option value="Impressinervis">Impressinervis</option>
                                </select>
                            </div>

                            <div class="contribute-input">
                                <div class="upload-photo-left">
                                    <label for="plant-leaf-photo">
                                        <span class="contribute-form-info">Plant's Leaf Photos</span>
                                    </label>
                                    <input type="file" id="plant-leaf-photo" name="plant-leaf-photo">
                                </div>
                                <div class="upload-photo-right">
                                    <label for="herbarium-photo">
                                        <span class="contribute-form-info">Herbarium Photos</span>
                                    </label>
                                    <input type="file"  id="herbarium-photo" name="plant-herbarium-photo">
                                </div>
                            </div>

                            
                            <div class="contribute-input">
                                <label for="plant-description">
                                    <span class="contribute-form-info">Description</span>
                                </label>
                                <textarea placeholder="Write Down Your Find! (around 200 to 2000 words)" rows="5" id="plant-description" name="plant-contribute-comment"></textarea>
                            </div>

                        </fieldset>

                        <button type="submit" class="contribute-btn">
                            Submit
                        </button>

                    </form>
                </div>
            </div>
            
            <figure class='going-up-container'>
                <a href='#top_contribute'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>

        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_contribute'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>

</html>
