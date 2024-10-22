<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This is introduction about The Web Developer (Muhammad Faiz bin Halek)" />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Muhammad Faiz bin Halek"  />
        <title>Plant's Notebook | Faiz</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_faiz">
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
                        
                        <label for="change_box" class="transform-box3">
                            <span class="box-text">Reveal My Picture <br> (Click Here) </span>
                            <img src="images/Faiz.jpg" alt="Faiz Picture" class="box-img">
                        </label>
                    </div>

                    <div class="profile-info">
                        <p><span class="profile-Name"><strong>Muhammad Faiz bin Halek</strong></span></p>
                        <br>
                        <p>104384313</p>
                        <br>
                        <p><span class="profile-course">Bachelor of Computer Science</span></p>
                    </div>

                    <br>

                    <table class="profile-table">
                        <tr class="odd-row3">
                            <th>Age</th>
                            <td>19</td>
                        </tr>
                        <tr class="even-row3">
                            <th>Gender</th>
                            <td>Male</td>
                        </tr>
                        <tr class="odd-row3">
                            <th>Nationality</th>
                            <td>Malaysian</td>
                        </tr>
                        <tr class="even-row3">
                            <th>My Hometown</th>
                            <td>I've lived in Kuching my whole life. What i loved most about living here is the friendly community with people from various ethnic background.
                            </td>
                        </tr>
                        <tr class="odd-row3">
                            <th>Something I am Proud of</th>
                            <td>I am Radiant in Valorant, Top 500 in Overwatch, Global in CSGO, Supersonic Legend in Rocket League and Challenger in League of Legends.</td>
                        </tr>
                        <tr class="even-row3">
                            <th>Something I Enjoy Doing</th>
                            <td>I enjoy watching shows, youtube and I spent a lot of time playing video games.</td>
                        </tr>
                    </table>

                    <br>
                    <br>
                    
                    <div class="email-button-faiz">
                        <a href="mailto:104384313@students.swinburne.edu.my">
                            Contact Me
                        </a>
                    </div>
                    
                    <br>
                    <br>

                </div>
            </div>

            <figure class='going-up-container'>
                <a href='#top_faiz'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>

        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_faiz'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>

</html>