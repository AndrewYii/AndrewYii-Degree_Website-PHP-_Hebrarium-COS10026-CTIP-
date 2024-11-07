<?php
include 'database/connection.php';
include 'database/database.php';
session_start();

$error = ''; 

// Add API handling
function identifyPlant($imagePath) {
    $apiKey = '2b10n8lDPfHYnbJs5oIKcUC4O';
    $url = 'https://my-api.plantnet.org/v2/identify/all?api-key=' . $apiKey;

    $cfile = new CURLFile($imagePath, 'image/jpeg', basename($imagePath));

    $data = array(
        'organs' => 'auto',
        'images' => $cfile
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        error_log('Curl error: ' . curl_error($ch));
        return false;
    }
    
    curl_close($ch);
    
    return json_decode($response, true);
}

// Handle file upload and API call
$identificationResults = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["Upload"])) {
    $targetDir = "identify/";
    if (!file_exists($targetDir) && !mkdir($targetDir, 0777, true)) {
        $error .= "Error occurred while connecting our plant identification hub."; 
        return;
    }
    
    $targetFile = $targetDir . basename($_FILES["Upload"]["name"]);
    
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = array('jpg', 'jpeg', 'png');
    
    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["Upload"]["tmp_name"], $targetFile)) {
            $identificationResults = identifyPlant($targetFile);
            
            if (!$identificationResults) {
                $error .= "Error occurred while connecting our plant identification hub.<br>"; 
            }
        } else {
            $error .= "Failed to upload file.<br>"; 
        }
    } else {
        $error .= "Sorry, only JPG, JPEG & PNG files are allowed.<br>"; 
    }
}
?>

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

        <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <label for="upload" class="identify-img">
                <span>
                    <input type="file" name="Upload" id="upload">
                    <img src="images/upload_logo.png" alt="upload logo" class="identify-upload">
                </span>
            </label>
            <p class="identify-p">Upload Image Here</p>
            <div class="upload-btn">
                <button type="submit">Upload</button>
            </div>
        </form>

        <?php
            if ($error != '') {
                echo '
                <input type="checkbox" id="close-identify-find">
                <div class="identify-result-overlay">
                    <div class="identify-result-container">
                        <div class="identify-result-header">
                            <h3>Error</h3>
                            <label for="close-identify-find" class="identify-result-close">
                                <img src="images/close_icon.png" alt="Close icon">
                            </label>
                        </div>
                        <div class="identify-result-content">
                            <div class="identify-result-item">
                                <p>' . $error . '</p>
                            </div>
                        </div>
                    </div>
                </div>';
            } else if ($identificationResults) {
                echo '
                <input type="checkbox" id="close-identify-find">
                <div class="identify-result-overlay">
                    <div class="identify-result-container">
                        <div class="identify-result-header">
                            <h3>Plant Identification Results</h3>
                            <label for="close-identify-find" class="identify-result-close">
                                <img src="images/close_icon.png" alt="Close icon">
                            </label>
                        </div>
                        <div class="identify-result-content">';
                
                if (isset($identificationResults['results'])) {
                    foreach ($identificationResults['results'] as $result) {
                        echo '
                        <div class="identify-result-item">
                            <div class="identify-result-score">
                                Match Score: ' . number_format($result['score'] * 100, 2) . '%
                            </div>
                            <div class="identify-result-detail">
                                <strong>Scientific Name:</strong> ' . $result['species']['scientificNameWithoutAuthor'] . ' ' . $result['species']['scientificNameAuthorship'] . '
                            </div>';
                            
                        if (isset($result['species']['commonNames'])) {
                            echo '
                            <div class="identify-result-detail">
                                <strong>Common Names:</strong> ' . implode(", ", $result['species']['commonNames']) . '
                            </div>';
                        }

                        echo '
                            <div class="identify-result-detail">
                                <strong>Family:</strong> ' . $result['species']['family']['scientificNameWithoutAuthor'] . '
                            </div>
                            <div class="identify-result-detail">
                                <strong>Genus:</strong> ' . $result['species']['genus']['scientificNameWithoutAuthor'] . '
                            </div>
                        </div>';
                    }
                } else {
                    echo '
                    <div class="identify-result-item">
                        <p>No matches found</p>
                    </div>';
                }

                echo '</div></div></div>';
            }
        ?>

        <figure class='going-up-container'>
            <a href='#top_iden'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>
    </article>

    <footer>
        <?php include 'include/footer.php';?>
    </footer>
</body>
</html>
