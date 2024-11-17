<?php
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL to create Register table
    $sql_register = "CREATE TABLE IF NOT EXISTS Register (
        Register_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(60) NOT NULL,
        Username VARCHAR(60) NOT NULL UNIQUE,
        Phone VARCHAR(15) NOT NULL,
        Email VARCHAR(50) NOT NULL UNIQUE,
        Password VARCHAR(255) NOT NULL,
        Profile_Picture VARCHAR(255) DEFAULT NULL,
        Street VARCHAR(100) DEFAULT NULL,
        City VARCHAR(50) DEFAULT NULL,
        Postcode VARCHAR(10) DEFAULT NULL,
        State VARCHAR(30) DEFAULT NULL,
        Register_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql_register)) {
        die("Error creating register table: " . mysqli_error($conn));
    }

    // Insert admin
    $default_username = 'admin'; 
    $default_email = '104386568@students.swinburne.edu.my'; 
    $default_password = password_hash('admin', PASSWORD_DEFAULT); 

    $insert_default_user = "INSERT INTO Register (Name, Username, Email, Password)
                            SELECT 'Admin', '$default_username', '$default_email', '$default_password'
                            WHERE NOT EXISTS (SELECT * FROM Register)";

    if (!mysqli_query($conn, $insert_default_user)) {
        die("Error inserting default user: " . mysqli_error($conn));
    }

    // SQL to create Login table
    $sql_login = "CREATE TABLE IF NOT EXISTS Login (
        Login_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Register_ID INT(6) UNSIGNED NOT NULL,
        Username VARCHAR(60) NOT NULL,
        Login_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Logout_At TIMESTAMP NULL DEFAULT NULL,
        FOREIGN KEY (Register_ID) REFERENCES Register(Register_ID) ON DELETE CASCADE
    )";

    if (!mysqli_query($conn, $sql_login)) {
        die("Error creating login table: " . mysqli_error($conn));
    }

    // SQL to create Pre_Contribution table
    $sql_pre_contribute = "CREATE TABLE IF NOT EXISTS Pre_Contribute (
        Pre_Contribute_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Username VARCHAR(60) NOT NULL,
        Picture_Option VARCHAR(50) NOT NULL,
        Tag VARCHAR(500) NOT NULL,
        Plant_Name VARCHAR(50) NOT NULL,
        Plant_Family VARCHAR(50) NOT NULL,
        Plant_Genus VARCHAR(50) NOT NULL,
        Plant_Species VARCHAR(50) NOT NULL,
        Plant_Leaf_Photo VARCHAR(255) NOT NULL,
        Plant_Herbarium_Photo VARCHAR(255) NOT NULL,
        Description_Contribute TEXT NOT NULL,
        Contribute_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql_pre_contribute)) {
        die("Error creating contribute table: " . mysqli_error($conn));
    }

    // SQL to create Contribution table
    $sql_contribute = "CREATE TABLE IF NOT EXISTS Contribute (
        Contribute_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Username VARCHAR(60) NOT NULL,
        Picture_Option VARCHAR(50) NOT NULL,
        Tag VARCHAR(500) NOT NULL,
        Plant_Name VARCHAR(50) NOT NULL,
        Plant_Family VARCHAR(50) NOT NULL,
        Plant_Genus VARCHAR(50) NOT NULL,
        Plant_Species VARCHAR(50) NOT NULL,
        Plant_Leaf_Photo VARCHAR(255) NOT NULL,
        Plant_Herbarium_Photo VARCHAR(255) NOT NULL,
        Description_Contribute TEXT NOT NULL,
        Contribute_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql_contribute)) {
        die("Error creating contribute table: " . mysqli_error($conn));
    }

    //Insert Raw Contributor
    $check_query = "SELECT COUNT(*) AS total FROM Contribute";
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row['total'] == 0) {
        $insert_contributors = "
        INSERT INTO Contribute (Username, Picture_Option, Tag, Plant_Name, Plant_Family, Plant_Genus, Plant_Species, Plant_Leaf_Photo, Plant_Herbarium_Photo, Description_Contribute) 
        VALUES 
        ('Leoooooooooo', 'picture1', 'Plant Taxonomist, Plant Systematics Expert, Herbarium Specimen Identifier', 'Vatica Najibiana', 'Dipterocarpaceae', 'Vatica ', ' Najibiana', 'images/vaticanajibianaleafphoto.jpg', 'images/vaticanajibianaherbariumspecimen.jpeg', 'Let me introduce you to the Vatica genus, a fascinating group of trees in the Dipterocarpaceae family. One notable species is Vatica najibiana, found in the lush forests of Peninsular Malaysia, specifically in Kelantan and Pahang.'),
        ('Joanelyn', 'picture2', 'Plant Taxonomist, Herbarium Specimen Identifier', 'Dipterocarpus Baudii', 'Dipterocarpaceae', 'Dipterocarpus', 'Baudii', 'images/Dipterocarpus-baudiileafphoto.jpg', 'images/Dipterocarpus_bauddin_herbariumspecimen.jpg', 'I recently found the fascinating Dipterocarpus baudii in the tropical forests of Peninsular Malaysia. This evergreen tree can grow up to 30 meters tall, with a trunk that remains branch-free for up to 20 meters. Its obovate-elliptic leaves and fragrant flowers make it a standout in the forest.'),
        ('HakunaMatata', 'picture3', 'None', 'Actinodaphne Angustifolia ', 'Lauraceae', 'Actinodaphne', ' Angustifolia', 'images/Actinodaphne_angustifolia_leafphoto.jpg', 'images/Actinodaphne_angustifolia_herbariumspecimen.jpg', ' I recently encountered the intriguing Actinodaphne angustifolia in the tropical forests of Peninsular Malaysia. This medium-sized evergreen tree is part of the Lauraceae family and is known for its elliptic or oblong-lanceolate leaves, which are often pendulous and covered in reddish hairs.'),
        ('Cinderellilia', 'picture4', 'Botanical Nomenclature Expert, Plant Taxonomist, Plant Systematics Expert', 'Santiria Impressinervis', 'Burseraceae', 'Santiria', ' Impressinervis', 'images/sanitriaimpressinverisleafphoto.jpeg', 'images/sanitriaimpressinverisherbariumspecimen.jpg', 'I recently came across the fascinating Santiria impressinervis in the Kelabit Highlands of Sarawak, Malaysia. This tree, part of the Burseraceae family, is known for its unique characteristics and ecological importance.')";
    
        if (!mysqli_query($conn, $insert_contributors)) {
            die("Error inserting contributors: " . mysqli_error($conn));
        }
    }

    // SQL to create Contribution Comment table
    $sql_comments = "CREATE TABLE IF NOT EXISTS Contribute_Comments (
        Comment_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Contribute_ID INT(6) UNSIGNED,
        Commenter_Username VARCHAR(60) NOT NULL,
        Comment_Text TEXT NOT NULL,
        Comment_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (Contribute_ID) REFERENCES Contribute(Contribute_ID) ON DELETE CASCADE
    )";
    
    if (!mysqli_query($conn, $sql_comments)) {
        die("Error creating comments table: " . mysqli_error($conn));
    }

    // SQL to create Enquiry table
    $sql_enquiry = "CREATE TABLE IF NOT EXISTS Enquiry (
        Enquiry_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(60) NOT NULL,
        Email VARCHAR(50) NOT NULL,
        Phone VARCHAR(15) NOT NULL,
        Subject VARCHAR(100) NOT NULL,
        Message TEXT NOT NULL,
        Street VARCHAR(100) NOT NULL,
        City VARCHAR(50) NOT NULL,
        Postcode VARCHAR(10) NOT NULL,
        State VARCHAR(30) NOT NULL,
        Username VARCHAR(60) DEFAULT NULL,
        Status VARCHAR(60) DEFAULT 'Unresolved',
        Response TEXT DEFAULT NULL,
        Enquiry_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql_enquiry)) {
        die("Error creating enquiry table: " . mysqli_error($conn));
    }

    // SQL to create Feedback table
    $sql_feedback = "CREATE TABLE IF NOT EXISTS Feedback (
        Feedback_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Username VARCHAR(60) NOT NULL,
        Feedback_Mark INT(2) NOT NULL,
        Feedback_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql_feedback)) {
        die("Error creating feedback table: " . mysqli_error($conn));
    }

    mysqli_close($conn);
?>
