<?php include 'database/connection.php';?>
<?php include 'database/database.php';?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This is introduction about The Web Developer (Assufi Bin Luqman)" />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Assufi Bin Luqman"  />
        <title>Plant's Notebook | Assufi</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_assufi">
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
                        
                        <label for="change_box" class="transform-box2">
                            <span class="box-text">Reveal My Picture <br> (Click Here) </span>
                            <img src="images/Assufi.jpg" alt="Assufi Picture" class="box-img">
                        </label>
                    </div>

                    <div class="profile-info">
                        <p><span class="profile-Name"><strong>Assufi bin Luqman</strong></span></p>
                        <br>
                        <p>104381877</p>
                        <br>
                        <p><span class="profile-course">Bachelor of Computer Science</span></p>
                    </div>

                    <br>

                    <table class="profile-table">
                        <tr class="odd-row2">
                            <th>Age</th>
                            <td>19</td>
                        </tr>
                        <tr class="even-row2">
                            <th>Gender</th>
                            <td>Male</td>
                        </tr>
                        <tr class="odd-row2">
                            <th>Nationality</th>
                            <td>Malaysian</td>
                        </tr>
                        <tr class="even-row2">
                            <th>My Hometown</th>
                            <td>I'm from Kuching, home to a myriad of diverse ethnic groups and delicious foods like Laksa Sarawak, Mee Kolok and Belacan Beehoon</td>
                        </tr>
                        <tr class="odd-row2">
                            <th>Something I am Proud of</th>
                            <td>When I was an active athlete, I participated many squash tournaments in different states. Eventhough I wasn't near top 3, I still had a great time with my friends that I made along the way.</td>
                        </tr>
                        <tr class="even-row2">
                            <th>Something I Enjoy Doing</th>
                            <td>I love running, futsal and playing video games.</td>
                        </tr>
                    </table>

                    <br>
                    <br>
                    
                    <div class="email-button-assufi">
                        <a href="mailto:104381877@students.swinburne.edu.my">
                            Contact Me
                        </a>
                    </div>
                    
                    <br>
                    <br>

                </div>
            </div>
            
            <figure class='going-up-container'>
                <a href='#top_assufi'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>

        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_assufi'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>


    </body>

</html>