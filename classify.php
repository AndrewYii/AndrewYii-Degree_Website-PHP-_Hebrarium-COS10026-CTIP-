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
        <meta name="description" content="Unlock the secrets of plant classification with Plant's Notebook. Explore detailed guides on identifying and categorizing plants, perfect for botanists, hobbyists, and nature enthusiasts." />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Muhammad Faiz Bin Halek"  />
        <title>Plant's Notebook |  Unlocking the Secrets of Plant Classification</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>

    <body class="classify_background">

        <header id="top_classify">
            <?php include 'include/header.php';?>
        </header>

        <article class="classify-article">

            <?php include 'include/chatbot.php';?>

            <div class="classify_welcome">
                <h1 class="classify_heading1">Classification</h1>
                <h2 class="classify_heading">Plant Lineage: Family, Genus, Species</h2>
            </div>

            <section>
                <div class="classification1">
                    <figure class="classify1">
                        <img src="images/classify_pic1.webp" alt="classifypic1">
                        <figcaption class="plantfamtree">Plant Family Tree</figcaption>
                    </figure>
                    <div class="defi_taxo_container">
                        <div class="defi1-container1">
                            <h3 class="defi1-heading">Plant Families</h3>
                            <p class="defi1">
                                Plants that have similar flowers, reproductive structures, other characteristics, and are evolutionarily related.
                            </p>
                            <h3 class="defi1-heading">Genus</h3>
                            <p class="defi1">
                                The first part of a plant's botanical name used to properly describe it.
                            </p>
                            <h3 class="defi1-heading">Species</h3>
                            <p class="defi1">
                                Plants who have the same characteristics and are able to breed with each other.
                            </p>
                        </div>

                    </div>
                    <div class="defi_container">
                        <h3 class="defi1-heading">
                            Plant Families
                        </h3>
                        <p class="defi1">
                            Plants that have similar flowers, reproductive structures, other characteristics, and are evolutionarily related.
                        </p>
                        <h3 class="defi1-heading">
                            Genus
                        </h3>
                        <p class="defi1">
                            The first part of a plant's botanical name used to properly describe it.
                        </p>
                        <h3 class="defi1-heading">
                            Species
                        </h3>
                        <p class="defi1">
                            Plants who have the same characteristics and are able to breed with each other.
                        </p>
                    </div>

                    <aside class="care-aside">
                        <span class="care-span">Hover For More</span>
                        <h2>Taxonomic Hierarchy</h2>
                        <ol>
                            <li>Kingdom</li>
                            <li>Avoid direct sunlight to prevent fading.</li>
                            <li>Phylum</li>
                            <li>Class</li>
                            <li><strong>Family</strong></li>
                            <li><strong>Genus</strong></li>
                            <li><strong>Species</strong></li>
                        </ol>
                    </aside>
                </div>
            </section>

            <section class="point-classify">
                <h2 class="family_title">Families</h2>
                <h3 class="dipte">Dipterocarpaceae</h3>
                <div class="dipte-container">
                    <div class="dipte-content">
                        <figure class="classify2">
                            <img src="images/classify_pic2.jpg" alt="classifypic2" >
                            <figcaption class="caption_dipte1">Picture of Dipterocarpaceae</figcaption>
                        </figure>    
                        <div class="dipte-text">
                            <p class="dipte_defi"><strong>The Dipterocarpaceae</strong> <span class="smaller_word">family consists of 16 genera and approximately 695 known species, 
                                primarily made up of lowland tropical forest trees. These trees have a pantropical 
                                distribution, found in regions ranging from northern South America to Africa, the 
                                Seychelles, India, Indochina, Indonesia, Malaysia, and the Philippines. Borneo hosts 
                                the highest diversity of Dipterocarpaceae species.</span></p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="point-classify">
                <h2 class="family_title">Genus</h2>

                <div class="genus_container">
                    <div class="vatica_part">
                        <h3 class="vatica_title">Vatica</h3>
                        <figure class="vatica_content">
                            <img src="images/classify_pic3.jpg" alt="classifypic3">
                            <figcaption class="picofvatica">Picture of Vatica</figcaption>
                        </figure>
                        <p class="vatica_explain"><strong>Vatica</strong><span class="smaller_word"> is a genus of plants belonging to 
                            the Dipterocarpaceae family. The genus Vatica has approximately 65 species. 
                            From southern China and India, 
                            these species spread to the Philippines, New Guinea, Indochina, Indonesia, 
                            and Sri Lanka. The majority of species are located in lowland rainforests, 
                            where they are important emergent or canopy trees. Vatica species are well 
                            known for their hardwood, which is useful for building and creating furniture.
                            They play a vital role in forest ecosystems, supporting biodiversity and 
                            serving as a home for a variety of creatures, just like other members of the 
                            Dipterocarpaceae family. Conservation efforts are crucial since deforestation 
                            and habitat loss have put certain species in danger.</span></p>
                    </div>

                    <div class="hopea_part">
                        <h3 class="hopea_title">Hopea</h3>
                        <figure class="hopea_content">
                            <img src="images/classify_pic4.jpg" alt="classifypic4">
                            <figcaption class="picofhopea">Picture of Hopea</figcaption>
                        </figure>
                        <p class="hopea_explain"><strong>Hopea</strong><span class="smaller_word"> is a genus within the Dipterocarpaceae family, 
                            comprising around 113 species. These species are found in southern India and 
                            Sri Lanka, the Andaman Islands, Myanmar, southern China, and all the way down 
                            Malesia to New Guinea. The majority of Hopea species are found in lowland 
                            rainforests, where they contribute to the structure of tropical forests by 
                            acting as canopy or subcanopy trees. Hopea nutans is one of the species that 
                            can develop into an emergent tree. The strong hardwood of the Hopea species 
                            is also prized for its durability and frequent usage in furniture and 
                            building. Conservation is important because, like other members of the 
                            Dipterocarpaceae family, certain species are threatened by habitat loss and 
                            deforestation.</span></p>
                    </div>
                </div>

            </section>

            <section class="point-classify">
                
                <h2 class="family_title">Species</h2>

                <div class="genus_container">
                    <div class="vatica_part vatica_part1">
                        <h3 class="vatica_title1">Vatica Yeechongii</h3>
                        <figure class="vatica_content">
                            <img src="images/classify_pic5.JPG" alt="classifypic5">
                            <figcaption class="picofyeechongii">Picture of Vatica Yeechongii</figcaption>
                        </figure>
                        <div class="vatica_details">
                            <ul>
                                <li><strong>Height:</strong><span class="smaller_word"> Up to 15 m.</span></li>
                                <li><strong>Twigs:</strong> <span class="smaller_word">Covered in reddish-brown star-shaped hairs.</span></li>
                                <li><strong>Leaves:</strong><span class="smaller_word"> Leathery, oblong to lanceolate (44-84 cm long, 10-16.5 cm wide), dark green on top, pale green underside. 28-30 secondary veins, domatia may be present.</span></li>
                                <li><strong>Petiole:</strong><span class="smaller_word"> 2-3 cm, reddish-brown hairs, cracked when dried.</span></li>
                                <li><strong>Fruit:</strong> <span class="smaller_word">Grows in bunches, 5 ovate calyx lobes (3.5-4 cm long) turn reddish-brown when ripe. Nut: ovoid, 1.5-1.8 cm diameter.</span></li>
                                <li><strong>Habitat:</strong><span class="smaller_word">Lowland dipterocarp forest, 50 m altitude, near riverbank. </span></li>
                                <li><strong>Etymology:</strong><span class="smaller_word">Named after Chan Yee Chong, who helped discover the species.</span></li>
                            </ul>
                        </div>
                        
                    </div>

                    <div class="hopea_part hopea_part1">
                        <h3 class="hopea_title1">Hopea Parviflora</h3>
                        <figure class="hopea_content1">
                            <img src="images/classify_pic6.webp" alt="classifypic6">
                            <figcaption class="picofparviflora">Picture of Hopea Parviflora</figcaption>
                        </figure>
                        <div class="vatica_details1">
                            <ul>
                                <li><strong>Height:</strong><span class="smaller_word">25-40 m, with a clear bole of 10-20 m.</span></li>
                                <li><strong>Diameter:</strong><span class="smaller_word">Up to 130 cm.</span></li>
                                <li><strong>Features:</strong><span class="smaller_word">Often buttressed.</span></li>
                                <li><strong>Bark:</strong><span class="smaller_word"> Light brown, mottled with white; smooth in young trees, turning rusty brown and rough with age.</span></li>
                                <li><strong>Habitat:</strong><span class="smaller_word">West coast tropical evergreen, Southern hill-top tropical evergreen, West coast semi-evergreen, and West coast secondary evergreen Dipterocarp forests.</span></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                
            </section>


            <div class="flip-card-classify">
                <div class="flip-card-inner-classify">
                    <div class="flip-card-front-classify">
                        <table class="classify_table">
                            <caption class="caption_classify">Plant's Myths and Folklore</caption>
                                <tr>
                                <th>Plant Name</th>
                                <th>Myth and Folklore</th>
                                <th>Region</th>
                                </tr>
                                <tr>
                                <td class="test1">Mistletoe</td>
                                <td class="test2">Believed to be protective, mistletoe was placed above doors or carved into rings to ward off 
                                    witches and poisons. In British paganism, it was hung with red ribbon and burned during Imbolc to 
                                    protect the home and ward off disease.</td>
                                <td class="test1">Western Europe</td>
                                </tr>
                                <tr>
                                <td class="test1">Sage</td>
                                <td class="test2">Romans considered sage a holy herb for memory and teeth cleaning. In the Middle Ages, it was believed
                                    to grant immortality if eaten daily in May and was used to cure warts. Sage was also used to cover 
                                    rotting meat due to its antibacterial properties.</td>
                                <td class="test1">Europe</td>
                                </tr>
                                <tr>
                                <td class="test1">Yew Tree</td>
                                <td class="test2">Yew trees, often found in English churchyards, were believed to purify plague victims if placed on 
                                    their graves. The oldest yew in the UK, around 2,000–3,000 years old, is located in a Perthshire 
                                    churchyard.</td>
                                <td class="test1">UK</td>
                            </tr>
                            <tr>
                                <td class="test1">Elder Tree</td>
                                <td class="test2">The English elder's name comes from the Anglo-Saxon 'aeld' meaning fire. In folklore, it hosted the 
                                    Elder Mother spirit and was believed to protect homes. Dried elder leaves were hung to ward off evil, and having 
                                    the tree nearby was seen as a sign of good luck.</td>
                                <td class="test1">Northern Europe</td>

                            </tr>
                        </table>
                    </div>
                    <div class="flip-card-back-classify">
                        <h3 class="defi_caption">Definition List</h3>
                        <dl class="classify_definition">
                            <dt class="dt_classify">
                                <span class="dt_head">Emergent Tree</span>
                            </dt>
                            <dd class="even_defi">
                                <span class="classify_span">A tree that grows taller than the surrounding canopy, emerging above the rest of 
                                the forest.</span>
                            </dd>
                            <dt class="dt_classify">
                                <span class="dt_head">Canopy Tree</span>
                            </dt>
                            <dd class="odd_defi">
                                <span class="classify_span">A tree that forms part of the upper layer of a forest, capturing most of 
                                the sunlight.</span>
                            </dd>
                            <dt class="dt_classify">
                                <span class="dt_head">Subcanopy Tree</span>
                            </dt>
                            <dd class="even_defi">
                                <span class="classify_span">A tree that grow beneath the canopy but above the understory, playing an 
                                important ecological role.</span>
                            </dd>
                            <dt class="dt_classify">
                                <span class="dt_head">Hardwood</span>
                            </dt>
                            <dd class="odd_defi">
                                <span class="classify_span">Dense wood from broadleaf trees, valued for its strength and durability, 
                                commonly used in furniture and construction.</span>
                            </dd>
                            <dt class="dt_classify">
                                <span class="dt_head">Biodiversity</span>
                            </dt>
                            <dd class="odd_defi">
                                <span class="classify_span">Varieties of plants and animals, which is mostly considered important and desirable.</span>
                            </dd>
                        </dl>
                    </div>
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
            <a href='#top_classify'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>
</html>