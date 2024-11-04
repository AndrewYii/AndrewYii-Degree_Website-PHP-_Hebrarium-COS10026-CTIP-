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
        <meta name="description" content="This is introduction about The Web Developer (Andrew Teck Foon Yii)" />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Andrew</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_andrew">
            <?php include 'include/header.php';?>
        </header>

        <article>
            
            <?php include 'include/chatbot.php';?>

            <div class="profile-table-layout">
                <div class="adjust-location-profile-table">
                    <div class="profile-heading">
                        <h1>Student Profile Page</h1>
                    </div>
                    <div class="profile-picture-content">
                        <input type="checkbox" id="change_box">
                        
                        <label for="change_box" class="transform-box">
                            <span class="box-text">Reveal My Picture <br> (Click Here) </span>
                            <img src="images/Andrew.jpg" alt="Andrew Picture" class="box-img">
                        </label>
                    </div>

                    <div class="profile-info">
                        <p><span class="profile-Name"><strong> Andrew Teck Foon Yii</strong></span></p>
                        <br>
                        <p>104386568</p>
                        <br>
                        <p><span class="profile-course">Bachelor of Computer Science</span></p>
                    </div>

                    <br>

                    <table class="profile-table">
                        <tr class="odd-row">
                            <th>Age</th>
                            <td>19</td>
                        </tr>
                        <tr class="even-row">
                            <th>Gender</th>
                            <td>Male</td>
                        </tr>
                        <tr class="odd-row">
                            <th>Nationality</th>
                            <td>Malaysian</td>
                        </tr>
                        <tr class="even-row">
                            <th>My Hometown</th>
                            <td>I'm from Sibu, a small district in the middle region of sarawak. It is a very peaceful and slow-paced city to live in, and it has a wide variety of delicious local cuisines, sold at a fair and reasonable price. It's like a heaven to me and it feels very safe to live in sibu. Do hit me up whenever you are here for a vacation!</td>
                        </tr>
                        <tr class="odd-row">
                            <th>Something I am Proud of</th>
                            <td> Well, out of all the things which I have achieved, no matter small or big, I'm especially proud of myself for being ranked 61st in the International Mathematical Olympiad National Selection Test 1 back in the year 2023. I'm very fortunate to be able to compete with all the elites from all over the country, and getting into the top 100 in the nation means that all my efforts and dedication had paid off.</td>
                        </tr>
                        <tr class="even-row">
                            <th>Something I Enjoy Doing</th>
                            <td>I enjoy reading,playing video games in my free time!</td>
                        </tr>
                    </table>

                    <br>
                    <br>
                    
                    <div class="email-button-andrew">
                        <a href="mailto:104386568@students.swinburne.edu.my">
                            Contact Me
                        </a>
                    </div>
                    
                    <br>
                    <br>

                    

                </div>
            </div>

            <figure class='going-up-container'>
                <a href='#top_andrew'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>


        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_andrew'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>

</html>