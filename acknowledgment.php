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
        <meta name="description" content="Our reference source for making this website." />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Our Reference</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_ack">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>

            <div class="image-text">
                <div class="desc1">
                    
                    <div>
                        <div class="acknowledgment-heading">
                            <h1>Info Gathered/Research</h1>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://www.sciencedirect.com/science/article/pii/S0925231221014934">
                                Plant Classification Knowledge Source 1
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://www.americanmeadows.com/content/general-guides/plant-classification?srsltid=AfmBOoovhnywl-QVkIywNQ3jeJ5UmmNwn2mpk_Sdn-yYzJHIiDrHR4Ag">
                                Plant Classification Knowledge Source 2
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://www.inaturalist.org/taxa/47126-Plantae">
                                Plant Classification Knowledge Source 3
                            </a>
                        </div>
                        <div class="acknowledgment-heading">
                            <h1>General Set Up</h1>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://www.patchplants.com/gb/en/">
                                Website Design(Sample/Refer)
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://www.figma.com/design/0k0RHq5EQk1Te7Befud1tO/WireFrame-CTIP-Plant's-Notebook?node-id=0-1&node-type=canvas&t=uxBLGVY5e8pH0Szd-0">
                                Draf the WireFrame of Website Design
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://www.remove.bg/">
                                Remove Background of Picture
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://www.canva.com/">
                                Designing The Logo
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://cdn-icons-png.flaticon.com/512/130/130884.png">
                                Next_Icon
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://codepen.io/tuckermassad/pen/yLNOPrO">
                                ChatBot Design
                            </a>
                        </div>
                        <div class="acknowledgment-heading">
                            <h1>Menubar Set Up</h1>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/800px-Hamburger_icon.svg.png">
                                Hamburger Icon Picture
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://static.vecteezy.com/system/resources/thumbnails/008/442/086/small_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg">
                                User Icon Picture
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJNajyeZ1-a_lyQKXKuB6SxJcmt7pOlXH7qA&s">
                                Search Icon Picture
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://tse3.mm.bing.net/th?id=OIG4.VCRbLECsUDQT_am3HTEH&pid=ImgGn">
                                Enquiry Photo (Navigation Bar)
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://tse4.mm.bing.net/th?id=OIG3.IRb3ZUvvP8oYF.hConQ5&w=270&h=270&c=6&r=0&o=5&dpr=1.6&pid=ImgGn">
                                Contribution Photo (Navigation Bar)
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://helios-i.mashable.com/imagery/articles/04WFpIeBHwQSHHQdyg506Si/hero-image.fill.size_1248x702.v1661953117.jpg">
                                Identify Photo (Navigation Bar)
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://tse4.mm.bing.net/th?id=OIG2.aE6vdGpz6IBQTLfg53TZ&w=270&h=270&c=6&r=0&o=5&dpr=1.6&pid=ImgGn">
                                Tutorial Photo (Navigation Bar)
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://i.etsystatic.com/19868469/r/il/d4007e/3230518758/il_fullxfull.3230518758_jtgb.jpg">
                                Classification Photo (Navigation Bar)
                            </a>
                        </div>
                        <div class="acknowledgment-text">
                            <a href="https://www.youtube.com/watch?v=EJdtHQqGW6E&t=617s&pp=ygUWb3ZlcmZsb3cgYW5pbWF0aW9uIGNzcw%3D%3D">
                                Menu Bar Design
                            </a>
                        </div>
                        <div id="point-ack">
                            <div class="acknowledgment-heading">
                                <h1>Index Set Up</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.youtube.com/watch?v=pvjNbaV0Keo">
                                    Making The Extend Card Box Animation
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.w3schools.com/howto/howto_css_flip_box.asp">
                                    Making The Flip Box Animation
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.youtube.com/watch?v=lW8-w66v9CQ&pp=ygUWb3ZlcmZsb3cgYW5pbWF0aW9uIGNzcw%3D%3D">
                                    Star Rating Animation
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://static.vecteezy.com/system/resources/thumbnails/019/153/476/small_2x/checklist-is-completed-by-hand-and-pen-document-for-testing-filling-out-exam-form-vector.jpg">
                                    Filling Form Picture
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn-icons-png.flaticon.com/512/5726/5726470.png">
                                    Question Picture (Back of the Flip Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn-icons-png.freepik.com/512/5384/5384177.png">
                                    Address Icon Picture (Back of the Flip Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn-icons-png.flaticon.com/512/9946/9946319.png">
                                    Phone Icon Picture (Back of the Flip Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://static-00.iconduck.com/assets.00/email-address-icon-2048x1665-2yd9ec5m.png">
                                    Email Icon Picture (Back of the Flip Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://png.pngtree.com/png-vector/20220609/ourmid/pngtree-question-mark-and-background-png-image_4946531.png">
                                    Question Picture (Front of the Flip Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://i.etsystatic.com/8386769/r/il/07277f/1953429014/il_570xN.1953429014_lzz9.jpg">
                                    Herbarium Specimen Photo (Extend Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://media.istockphoto.com/id/1402801804/photo/closeup-nature-view-of-palms-and-monstera-and-fern-leaf-background.jpg?s=612x612&w=0&k=20&c=0pX8CbzsrqvMQKMa4853JRUw8oGy8NnsOC812H3o9Xo=
                                ">
                                    Fresh Leaf Photo (Extend Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://hgtvhome.sndimg.com/content/dam/images/hgtv/fullset/2022/4/18/2/shutterstock_colorful-flower-bed-663920386.jpg.rend.hgtvcom.1280.960.suffix/1650306743795.jpeg">
                                    Plant's Species Photo (Extend Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://t4.ftcdn.net/jpg/07/77/02/51/360_F_777025192_OWfKaFBbapBwOCrLH0rtF6FwrJYcQUlm.jpg">
                                    Plant's Genus Photo (Extend Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://png.pngtree.com/background/20230522/original/pngtree-room-with-lots-of-plants-on-a-floor-picture-image_2696350.jpg">
                                    Plant's Family Photo (Extend Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cGxhbnR8ZW58MHx8MHx8fDA%3D">
                                    Plant's Name Photo (Extend Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://lifehacker.com/imagery/articles/01HF2HGK294WHR6FQBGJ8G8Q6W/hero-image.fill.size_400x225.jpg">
                                    Theme Photo (Classification Section)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.freshlypressed.chatbot%2Fblog%2F2017%2F7%2F2%2Fherbarium-how-to-1-ythsk&psig=AOvVaw3dHRYrtEEnX6ct_cmyUSSK&ust=1725672363629000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCNDx4tiUrYgDFQAAAAAdAAAAABAS">
                                    Tutorial Photo (Overflow Opacity Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.rhs.org.uk/science/conservation-biodiversity/conserving-garden-plants/rhs-herbarium/pressing-and-collecting-samples">
                                    Tools Photo (Overflow Opacity Box)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://blog.babylonstoren.com/wp-content/uploads/2020/05/DSC04004-1-scaled.jpg">
                                    Care Photo (Overflow Opacity Box)
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Login/Register Set Up</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://img.freepik.com/premium-photo/dark-green-leaf-wallpaper-that-is-tropical-wallpaper_889227-26448.jpg">
                                    Background Login/Register
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.youtube.com/watch?v=hlwlM4a5rxg">
                                    Login Design
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.youtube.com/watch?v=KWIM5FuUJ8U">
                                    Login Animation
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Introduction Profile Set Up</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.youtube.com/watch?v=qOO6lVMhmGc">
                                    Introduction Profile Design(Concept & Replace JavaScript Using Css)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://img.freepik.com/free-photo/green-leaf-texture-leaf-texture-background_501050-120.jpg">
                                    Introduction Profile Background Picture
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.iconfinder.com/icons/4043232/avatar_batman_comics_hero_icon">
                                    Introduction Profile Batman Icon (Aniq)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn2.iconfinder.com/data/icons/famous-character-vol-1-colored/48/Avatars_Famous_Characters_Artboard_99-512.png">
                                    Introduction Profile Reverse Flash Icon (Faiz)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMoXxuZJfUtQHAiab7NQK0dOxQMOpkCRjd2g&s">
                                    Introduction Profile Spiderman Icon (Assufi)
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUMqVUoxT-W4nyAtVq7SkVtTs9-EG6cE9OiQ&s">
                                    Introduction Profile Joker Icon (Andrew)
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Personal Profile Set Up</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://blog.hubspot.com/website/css-animation-examples">
                                    Profile Table Reveal Picture Concept
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Contribution(output) & Contribute(input) Set Up</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdni.iconscout.com/illustration/premium/thumb/nothing-found-illustration-download-in-svg-png-gif-file-formats--empty-not-fount-search-limerror-pack-design-development-illustrations-2815869.png?f=webp">
                                    No Found Picture
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn-icons-png.freepik.com/512/146/146007.png">
                                    Boy Icon Selection in Contribute Form and Display on the contributor page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/Santiria_impressinervis.jpg/1200px-Santiria_impressinervis.jpg">
                                    Santiria Impressinervis Herbarium Specimen Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://d2seqvvyy3b8p2.cloudfront.net/ffd4cca0183daa72b3ed076c8598b544.jpg">
                                    Actinodaphne Angustifolia Herbarium Specimen Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://indiabiodiversity.org/files-api/api/get/raw/img//Vatica%20chinensis/Vatica_chinensis_3.jpeg">
                                    Vatica Najibiana Herbarium Specimen Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn-icons-png.freepik.com/256/8348/8348130.png?ga=GA1.1.2043322695.1726567947">
                                    Man Icon Selection in Contribute Form and Display on the contributor page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://upload.wikimedia.org/wikipedia/commons/b/bc/Actinodaphne_angustifolia_%285360941764%29.jpg">
                                    Actinodaphne Angustifolia Leaf Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn-icons-png.freepik.com/512/146/146005.png">
                                    Girl Icon Selection in Contribute Form and Display on the contributor page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://rimbundahan.org/wp-content/uploads/2010/11/Dipterocarpus-baudii.jpg">
                                    Dipterocarpus Baudiin Leaf Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://indiabiodiversity.org/files-api/api/get/raw/img//Dipterocarpus%20indicus/Dipterocarpus_indicus_2.jpg">
                                    Dipterocarpus Baudiin Herbarium Specimen Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://inaturalist-open-data.s3.amazonaws.com/photos/269524451/medium.jpeg">
                                    Santiria Impressinervis Leaf Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn-icons-png.freepik.com/256/8348/8348110.png">
                                    Woman Icon Selection in Contribute Form and Display on the contributor page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEibzX7PtaqpsuZDcg3jugsPcMt8T7YTyRCQouXaWaAoZ04mHklV9mB36qRRXu3AIlUMRLRZpsMWZXwrlahWybgVporxvkesVdG9YoqqmzKG8GqxFQoptQHpvrcMShZPhrl5IwWzzA5MKWQ/w1200-h630-p-k-no-nu/Vatica_najibiana-novataxa_2018-Ummul-Nazrah.jpg">
                                    Vatica Najibiana Leaf Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn-icons-png.freepik.com/256/8348/8348110.png">
                                    Woman Icon Selection in Contribute Form and Display on the contributor page
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Tutorial(Introduction)</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://i.etsystatic.com/5615972/r/il/206c41/1526624648/il_fullxfull.1526624648_li2j.jpg">
                                Background Picture for the tutorial introduction
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://media.istockphoto.com/id/1407898933/video/work-on-the-herbarium-samples-part-of-plants-on-herbarium-sheets.jpg?s=640x640&k=20&c=lETjCPNbKUQQaAFJ0hNu938uzru0wzGlUHzCo23sACg=">
                                Tools Section Introduction Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.anspblog.org/wp-content/uploads/2023/08/Herbarium-18-scaled.jpg">
                                Tutorial Section Introduction Photo
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://upload.wikimedia.org/wikipedia/commons/c/ce/Nepenthes_herbarium_specimens.jpg">
                                Preserve Section Introduction Photo
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Tutorial(Tutorial)</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://fwbg.org/wp-content/uploads/2022/04/20220607_4-specimens.png">
                                    Picture for the upper most Tutorial Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://img.freepik.com/premium-photo/feet-waterproof-insulated-rubber-boots-stand-multicolored-various-fallen-leaves-forest_262238-3002.jpg">
                                    Collecting Picture Tutorial Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://static1.squarespace.com/static/53b64004e4b0f56649f67481/53b65be3e4b01c43f7d8adcb/5962c8f7197aea49afd21070/1504102096435/001-2-+What+to+Collect.JPG?format=1500w">
                                    Preparation Picture Tutorial Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.squarespace-cdn.com/content/v1/53b64004e4b0f56649f67481/1499026325595-80JJVN8TG7PRKTC1JYFK/wildflower_protection_freshly-pressed">
                                    Pressing Picture Tools Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.squarespace-cdn.com/content/v1/53b64004e4b0f56649f67481/1499026447948-8TNDXSM3ST1VH1N9N28L/wildflower-pressing_freshly-pressed">
                                    Mounting Picture Tools Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.squarespace-cdn.com/content/v1/53b64004e4b0f56649f67481/1499645357955-KAQ6JR5FZYGM8I0DSIJ6/freezing-wildflowers_freshly-pressed">
                                    Freezing Picture Tools Page
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Tutorial(Tools)</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://musnaz.org/wp-content/uploads/2021/03/Herbarium.jpg">
                                    Picture for the upper most Tools Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://preview.redd.it/they-seriously-spent-all-the-effort-of-making-24-custom-v0-s28pxgbwgdyc1.jpeg?auto=webp&s=ea226c0ad449a0f4ded2b0ea990235cadef92532">
                                    Trowel Picture Tools Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.universityproducts.com/media/amasty/webp/catalog/product/cache/8868365e980b59d8508d26839c18d9d6/3/5/356-8106-inuse_jpg.webp">
                                    Plant Press Picture Tools Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYdJ0ysxmivNkHWc5GUBOJYh1vjpD9bZvfNJSssN89Crh7zsClW2ky8HuxzE00cxSERZ0&usqp=CAU">
                                    Parchment Papers Picture Tools Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnHCxYxR8U7vkL0Lhynce5Bmw7XPwKleZ0zT5VlK196aPPajWDGUbeDGDeMOtf2CYtdXE&usqp=CAU">
                                    Plastic foil Picture Tools Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://img.ws.mms.shopee.com.my/f95e98740956c0593467c19540070229">
                                    Acid-free adhesive Picture Tools Page
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Tutorial(Care)</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.thesenior.com.au/images/transform/v1/crop/frm/172374647/49e14d8b-f181-4b04-8575-13dec0058595.jpg/r307_0_3694_2258_w4000_h2667_fmax.jpg">
                                    Picture for the upper most Care Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwRDlmgIyfNSfdkeMlodLG14HAhTrWINoCi7_VXJ03nuaPlGUZmjp4btc0R5JnJP7GE0w&usqp=CAU">
                                    Step 1 Picture Care Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.uia.no/naturmuseum/forskning/botanikk-bildekarusell/krediteres-med-libseth.-forsidebilde-til-botanikk-side-(17).jpeg">
                                    Step 2 Picture Care Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.rbge.org.uk/media/1742/2_label.jpg?width=1280&height=720&mode=max">
                                    Step 3 Picture Care Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://blog.babylonstoren.com/wp-content/uploads/2020/05/DSC04004-1024x683.jpg">
                                    Step 4 Picture Care Page
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://scx2.b-cdn.net/gfx/news/hires/2024/with-deep-roots-and-ex.jpg">
                                    Step 5 Picture Care Page
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Identify</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/hBG3pcq5r3dGnhCh6">
                                    Upload Logo
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Classification</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn.serc.carleton.edu/images/integrate/teaching_materials/food_supply/student_materials/figure_6.2.1_plant_family_744.webp">
                                    Plant Family Picture
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.greeners.co/wp-content/uploads/2021/01/Keruing-1-min-150x150.jpg">
                                    Picture of Dipterocarpaceae
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Vatica_chinensis-5.JPG/320px-Vatica_chinensis-5.JPG">
                                    Picture of Vatica
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Hopea_parviflora.jpg/220px-Hopea_parviflora.jpg">
                                    Picture of Hopea
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://www.nparks.gov.sg/-/media/ffw/migrated/round2/flora/4820/591a84d6f8874926bde173230f209aea.jpg">
                                    Picture of Vatica Yeechongii
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Hopea_parviflora_04.JPG/320px-Hopea_parviflora_04.JPG">
                                    Picture of Hopea Parviflora
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Forgot Password</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://cdn-icons-png.flaticon.com/512/6146/6146586.png">
                                    Forgot Password Lock Picture
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/KQCSyGyiDYxg3ai47">
                                    OTP Approve Picture
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/WW9qG2gynYk4E8sd6">
                                    Reset Password Success Picture
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>API</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://my.plantnet.org/">
                                    Plant's Net API for plant identification
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Admin Control Panel</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/wrhPeT3KXDK7fEuR8">
                                    Register Icon
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/bzxNEwTu9Jy3TqaZ8">
                                    Login Icon
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/YxqcWiEwH6Q5PbRn7">
                                    Contribute Icon
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/ktuscpiWrrufBkp78">
                                    Precontribute Icon
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/6VJUZtqKxJ4HY67B7">
                                    Comments Icon
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/MRfdRJqcUhNxZNeBA">
                                    Feedback Icon
                                </a>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/uKNZuF8U2AJgeL4S6">
                                    Logout Icon
                                </a>
                            </div>
                            <div class="acknowledgment-heading">
                                <h1>Search Module</h1>
                            </div>
                            <div class="acknowledgment-text">
                                <a href="https://images.app.goo.gl/CNY8J7ToddXHLS1S9">
                                    No Found Picture
                                </a>
                            </div>
                        </div>
                        <figure class='going-up-container'>
                            <a href='#top_ack'>
                                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                            </a>
                        </figure>
                    </div>
                </div>
            </div>

        </article>

    
        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_ack'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>

</html>