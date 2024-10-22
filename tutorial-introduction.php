<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Explore the art of herbarium with our comprehensive guides on plant preservation, essential tools, and step-by-step tutorials." />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Discover the Art of Herbarium</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="tutointro_top">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>
            
            <input type="checkbox" id="change-background-tutorial">
            <label for="change-background-tutorial">
                <span class="select-area">
                    nothin
                </span>
            </label>
            <div class="tutorial-intrduction-background-layout">
                <div class="start-section">
                    <h3>
                        Ready to Dive In The 
                    </h3>
                    <h3>
                        World Of Herbarium Specimen?
                    </h3>
                    <br>
                    <p>
                        Discover the tools you'll need, the best methods for preserving plant material,
                    </p>
                    <p>
                        and the techniques for transferring leaves into herbarium sheets.
                    </p>
                    <p>
                        Let's get started on this botanical adventure together!
                    </p>
                    <p>
                       <span class="different-colour-tutointro"><strong>click this section to start your journey.</strong></span>  
                    </p>
                </div>
                <div class="end-section">
                    <h3>
                        Welcome to Real 
                    </h3>
                    <h3>
                        Herbarium Specimen Section!
                    </h3>
                    <br>
                    <p>
                        Are u ready to embark on your fantasy trip about the herbarium treasures?
                    </p>
                    <p>
                        At here, we are passionate about botany and the art of preserving plant life.
                    </p>
                    <p>
                        Our comprehensive tutorials will guide you through
                    </p>
                    <p>
                    every step of creating and maintaining herbarium specimens.
                    </p>
                    <p>
                        Whether you're a seasoned botanist or a curious beginner,
                    </p>
                    <p>
                        you'll find valuable insights and practical tips here.
                    </p>
                    <br>
                </div>
            </div>

            <div class="tutorial-intrduction-background-layout1">
                <input type="radio" id="tools" name="tutorial-section" checked="checked">
                <input type="radio" id="tutorial" name="tutorial-section">
                <input type="radio" id="care" name="tutorial-section">
                <ul>
                    <li id="tools-section">
                        <label for="tools">Herbarium Tools</label>
                    </li>
                    <li id="tutorial-section">
                        <label for="tutorial">Create Specimens</label>
                    </li>
                    <li id="care-section">
                        <label for="care">Preserve Specimens</label>
                    </li>
                </ul>
                <br>
                <div class="toolssection">
                    <div class="tutorial-introduction-image-content">
                        <img src="images/tools-section(introduction-herbariumspecimen-tutorial).jpg" alt="Herbarium Specimen Tools">
                    </div>
                    <div class="tutorial-introduction-text-content">
                        <input type="checkbox" id="read-more">
                        <h3><a href="tools.php" title="go to tools page">Essential Tools for Herbarium Specimen Preparation</a></h3>
                        <p>Creating herbarium specimens is like embarking on a botanical adventure, and having the right tools makes the journey even more exciting! Essential tools include a plant press for flattening and drying specimens, secateurs for cleanly cutting plant samples, and newspaper or blotting paper to absorb moisture. Once dried, specimens are mounted on acid-free paper using archival-quality adhesives like PVA glue. Accurate labeling with the plant's scientific name, collection date and location, and the collector's name is crucial. <label for="read-more"><span class="read_more">Read More...</span></label>
                        </p>
                        <br>
                        <p>
                            Tweezers and brushes help handle delicate parts and clean off debris, ensuring a neat appearance. Finally, storage boxes protect the mounted specimens from light, dust, and pests. Imagine you're a plant detective, exploring the wild to uncover botanical treasures. Each tool in your kit helps capture the essence of the plants you find, contributing to a global effort to understand and protect plant biodiversity.
                        </p>
                    </div>
                </div>
                <div class="tutorialsection">
                    <div class="tutorial-introduction-image-content">
                        <img src="images/herbarium_specimen_introduction_tutorial.jpg" alt="Herbarium Specimen Tutorial">
                    </div>
                    <div class="tutorial-introduction-text-content">
                        <h3><a href="tutorial.php" title="go to tutorial page">Crafting Your Own Herbarium Masterpieces</a></h3>
                        <p>Creating herbarium specimens is like capturing a moment in nature's timeline. Imagine selecting vibrant, healthy plants and carefully pressing them to preserve their beauty and intricate details. Start by choosing your specimens thoughtfully, then press them between sheets of newspaper or blotting paper. Use a plant press or heavy books to ensure even pressure. Once dried, mount your botanical treasures on herbarium sheets, labeling them with essential information like the plant's name, collection location, and date. This process not only immortalizes the plant but also contributes to documenting plant diversity and aiding in identification. It's a blend of art and science, perfect for any plant enthusiast!</p>
                    </div>
                </div>
                <div class="caresection">
                    <div class="tutorial-introduction-image-content">
                        <img src="images/herbarium_specimen_introduction_care.jpg" alt="Herbarium Specimen preservation">
                    </div>
                    <div class="tutorial-introduction-text-content">
                        <h3><a href="care.php" title="go to care page">Preserving Botanical Treasures</a></h3>
                        <p>Preserving herbarium specimens is an art that ensures the longevity of your botanical collections. Begin by carefully drying your pressed plants to prevent mold and decay. Once dried, mount them on herbarium sheets using archival-quality materials to avoid deterioration over time. Label each specimen with detailed information, including the plant's name, collection date, and location. Proper preservation not only maintains the specimen's beauty and scientific value but also creates a lasting record of plant biodiversity for future generations. It's a meticulous process that transforms your plant samples into enduring botanical treasures.</p>
                    </div>
                </div>
            </div>

            <figure class='going-up-container'>
                <a href='#tutointro_top'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>

        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#tutointro_top'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>
    
</html>