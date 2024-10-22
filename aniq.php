<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This is introduction about The Web Developer (Aniq Nazhan bin Mazlan)" />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Aniq Nazhan bin Mazlan"  />
        <title>Plant's Notebook | Aniq</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_aniq">
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
                        
                        <label for="change_box" class="transform-box1">
                            <span class="box-text">Reveal My Picture <br> (Click Here) </span>
                            <img src="images/aniq.jpeg" alt="Aniq Picture" class="box-img">
                        </label>
                    </div>

                    <div class="profile-info">
                        <p><span class="profile-Name"><strong>Aniq Nazhan bin Mazlan</strong></span></p>
                        <br>
                        <p>104384915</p>
                        <br>
                        <p><span class="profile-course">Bachelor of Computer Science</span></p>
                    </div>

                    <br>

                    <table class="profile-table">
                        <tr class="odd-row1">
                            <th>Age</th>
                            <td>19</td>
                        </tr>
                        <tr class="even-row1">
                            <th>Gender</th>
                            <td>Male</td>
                        </tr>
                        <tr class="odd-row1">
                            <th>Nationality</th>
                            <td>Malaysian</td>
                        </tr>
                        <tr class="even-row1">
                            <th>My Hometown</th>
                            <td>I'm from Bintulu, It's an indrustrial city so there's a lot of factory near where I live. Unsuprisingly, the air pollution in my hometown is very bad so everytime I come back I'll get sick for at least a few days before my body adapt</td>
                        </tr>
                        <tr class="odd-row1">
                            <th>Something I am Proud of</th>
                            <td>Back in secondary school, I was in the debate team without any prior experience in debate. Apparently I was very bad at it and struggle to keep up with the rest of my team. Fortunately, my I had my teacher and my team to guide me. I received the best debaters award during my competition.</td>
                        </tr>
                        <tr class="even-row1">
                            <th>Something I Enjoy Doing</th>
                            <td>I like to hang out with my friends in discord and play games together with them.</td>
                        </tr>
                    </table>

                    <br>
                    <br>
                    
                    <div class="email-button-aniq">
                        <a href="mailto:104384915@students.swinburne.edu.my">
                            Contact Me
                        </a>
                    </div>
                    
                    <br>
                    <br>

                </div>
            </div>

            <figure class='going-up-container'>
                <a href='#top_aniq'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>

        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_aniq'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>


    </body>

</html>