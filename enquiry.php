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
        <meta name="description" content="Unlock the secrets of plant identification with Plant's Notebook. Learn to identify various plant species, understand their characteristics, and explore the tools and techniques used by botanists. Ideal for botanists, hobbyists, and nature enthusiasts." />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques,Plant Common Name, Plant Scientific Name,Herbarium Specimen" />
        <meta name="author" content="Aniq Nazhan bin Mazlan"  />
        <title>Plant's Notebook | Enquiry</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>

    <body>

        <header id="top_enq">
            <?php include 'include/header.php';?>
        </header>

        <article class="identify-enquiry">

            <?php include 'include/chatbot.php';?>

            <div class="enquiry-form">

                <h1 class="enquiry-head">Enquiry</h1>
                
                <form name="Feedback" method="post" action="enquiry_process.php">
                    <div class="enquiry-reset"><input class="feedback-butn" type="reset" value="Reset"></div>

                        <fieldset class="enquiry-fd">
                            <legend class="enquiry-legend">User's Information</legend>
                            <div class="enquiry-ui">
                                <div class="enquiry-fname">
                                    <label for="fname" class="feedback-cont">First Name</label>
                                    <input class="enquiry-data" type="text" name="first_name" placeholder="First Name" size="22" id="fname">
                                </div>
                                <div class="enquiry-lname">
                                    <label for="lname" class="feedback-cont">Last Name</label>
                                    <input class="enquiry-data" type="text" name="last_name" placeholder="Last Name" size="22"  id="lname">
                                </div>
                                <div class="enquiry-email">
                                    <label for="email" class="feedback-cont">Email</label>
                                    <input class="enquiry-data" type="text" id="email" name="email" placeholder="example@gmail.com" >
                                </div>
                                <div class="enquiry-pnum">
                                    <label for="pnum" class="feedback-cont">Phone Number</label>
                                    <input class="enquiry-data" type="text" id="pnum" name="phone"  placeholder="0123456789">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="enquiry-fd">
                            <legend class="enquiry-legend">Address</legend>
                            <table class="address-table">
                                <tr>
                                    <td class="feedback-cont">Street: </td>
                                    <td><input class="enquiry-data" type="text" name="Street" placeholder="2A,Lorong Bindurong"  id="street"></td>
                                </tr>
                                <tr>
                                    <td class="feedback-cont">City: </td>
                                    <td><input class="enquiry-data" type="text" name="City" placeholder="Bintulu"  id="city"></td>
                                </tr>
                                <tr>
                                    <td class="feedback-cont">Postcode: </td>
                                    <td><input class="enquiry-data" type="text" name="Postcode"  id="Postcode"></td>
                                </tr>
                                <tr>
                                    <td class="feedback-cont">State: </td>
                                    <td class="enquiry-td">
                                        <select name="State" id="state" class="enquiry-select" >
                                        <option value="">--Select--</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option value="Labuan">Labuan</option>
                                        <option value="Malacca">Malacca</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Putrajaya">Putrajaya</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Selangor">Selangor</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>

                        <fieldset class="enquiry-fd">
                            <legend class="enquiry-legend">Enquiry</legend>
                                <table class="enquiry-table">
                                        <tr>
                                            <td class="feedback-cont">Topic</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="page" id="page" size="1" class="enquiry-select" >
                                                    <option value="">--Select--</option>
                                                    <option value="Tutorial">Making Herbarium Specimens</option>
                                                    <option value="Care">Preserving Herbarium Specimens</option> 
                                                    <option value="Tools">Essential Herbarium Tools</option>
                                                </select> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="comment" class="feedback-cont">Comment</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="comment" rows="4" cols="70" placeholder="Comment.Does not exceed 500 words" id="comment" class="enquiry-comment"></textarea></td>
                                        </tr>
                                    </table>
                        </fieldset>
                    <div class="enquiry-end"><input class="feedback-butn" type="submit" value="Submit"></div>
                </form>

            </div>

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