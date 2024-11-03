<?php include 'database/connection.php';?>
<?php include 'database/database.php';?>

<!DOCTYPE html>

<html lang="en">
    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Unlock the secrets of plant identification with Plant's Notebook. Learn to identify various plant species, understand their characteristics, and explore the tools and techniques used by botanists. Ideal for botanists, hobbyists, and nature enthusiasts." />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques,Plant Common Name, Plant Scientific Name,Herbarium Specimen" />
        <meta name="author" content="Aniq Nazhan bin Mazlan"  />
        <title>Plant's Notebook | Plant Identification Hub</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>

    <body>

        <header id="top_iden">
            <?php include 'include/header.php';?>    
        </header>
        
        <article class="identify-article">

            <?php include 'include/chatbot.php';?>
            
            <div class="identify">
                <h1>HERBS IDENTIFICATION</h1>
            </div>
            <section class="identify-detail">
                <h2>Herbs's Identifier can help to identify which herbs that the user upload. After the system 
                    identify which herb was uploaded, it will display the name, scientific name, tutorial on how
                    to transfer a fresh leaf into herbarium specimens, information on the tools used to create 
                    herbarium specimens and information on how to preserve the herbarium</h2>
            </section>
            <aside class="identify-aside">
                <span class="identify-span">Hover For Tips</span>
                <h2>Tips for Uploading Suitable Herb images</h2>
                <h3>1. Lighting</h3>
                <p><strong>Natural Light:</strong> Use natural sunlight when possible, as it provides the best lighting for capturing true colors.</p>
                <p><strong>Avoid Shadows:</strong> Position the herb so that it's not in shadow. Early morning or late afternoon light is often ideal.</p>
            
                <h3>2. Background</h3>
                <p><strong>Simple and Neutral:</strong> Use a plain, uncluttered background (like a wooden table or a white sheet) to make the herb stand out.</p>
                <p><strong>Contrast:</strong> Ensure the background contrasts with the color of the herb to enhance visibility.</p>
            
                <h3>3. Focus and Clarity</h3>
                <p><strong>Sharp Focus:</strong> Make sure the image is in sharp focus. Blurry images can make it difficult to identify details.</p>
                <p><strong>Use a Macro Setting:</strong> If available, use the macro setting on your camera or smartphone to capture close-up details of the leaves and flowers.</p>
            </aside>
            <label for="upload" class="identify-img">
                <span>
                    <input type="file" name="Upload" id="upload">
                    <img src="images/upload_logo.png" alt="upload logo" class="identify-upload">
                </span>
            </label>
            <p class="identify-p">Upload Image Here</p>
            <div class="identify-table">
                <fieldset>
                    <legend>Herbs Information</legend>
                    <table class="identify-hidden">
                        <tr class="identify-hidden">
                            <th class="Sample">Sample images:</th>
                        </tr>
                        <tr class="identify-hidden">
                            <th class="identify-sample">
                                <div class="identify-outer">
                                    <img src="images/OcimumBasilicum.jpg" alt="">
                                    <img src="images/OcimumBasilicum2.jpg" alt="">
    
                                    <img src="images/OcimumBasilicum3.jpg" alt="">
                                    <img src="images/OcimumBasilicum4.jpg" alt="">
                                </div>
                            </th>   
                        </tr>
                    </table>
                    <table>
                        <tr class="identify-row">
                            <th class="identify-image">Sample images:</th>
                            <td class="identify-sample">
                                <div class="identify-outer">
                                    <img src="images/OcimumBasilicum.jpg" alt="">
                                    <img src="images/OcimumBasilicum2.jpg" alt="">
    
                                    <img src="images/OcimumBasilicum3.jpg" alt="">
                                    <img src="images/OcimumBasilicum4.jpg" alt="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>Basil</td>
                        </tr>
                        <tr>
                            <th>Scientific Name:</th>
                            <td>Ocimum basilicum</td>
                        </tr>
                        <tr>
                            <th>Tutorial:</th>
                            <td>Start seeds indoors 6-8 weeks before the last frost. Plant in well-draining soil, water gently, and keep in a sunny spot. Germination occurs in 5-10 days.</td>
                        </tr>
                        <tr>
                            <th>Tool:</th>
                            <td>
                                <ul>
                                    <li>Pruning Shears: For trimming leaves and maintaining plant shape.</li>
                                    <li>Potting Soil: Rich, well-draining soil to support root growth.</li>
                                    <li>Seed Tray: Ideal for starting seeds indoors before transplanting.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Care:</th>
                            <td>
                                <ul>
                                    <li>Water regularly, keeping the soil evenly moist but not soggy.</li>
                                    <li>Provide 6-8 hours of full sunlight daily for optimal growth.</li>
                                    <li>Pinch off top leaves regularly to promote bushy growth and prevent flowering.</li>
                                    <li>Avoid overwatering, as it can lead to root rot.</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                
            </div>
            <figure class='going-up-container'>
                <a href='#top_iden'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>
        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>
        
        <figure class='going-up-container'>
            <a href='#top_iden'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>

</html>