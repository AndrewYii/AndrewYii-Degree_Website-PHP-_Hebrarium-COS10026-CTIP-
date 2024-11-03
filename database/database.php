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
        Email VARCHAR(50) NOT NULL UNIQUE,
        Password VARCHAR(255) NOT NULL,
        Register_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql_register)) {
        die("Error creating register table: " . mysqli_error($conn));
    }

    // SQL to create Login table
    $sql_login = "CREATE TABLE IF NOT EXISTS Login (
        Login_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Register_ID INT(6) UNSIGNED NOT NULL,
        Username VARCHAR(60) NOT NULL,
        Password VARCHAR(255) NOT NULL,
        Login_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (Register_ID) REFERENCES Register(Register_ID) ON DELETE CASCADE
    )";

    if (!mysqli_query($conn, $sql_login)) {
        die("Error creating login table: " . mysqli_error($conn));
    }

    $sql_contribute = "CREATE TABLE IF NOT EXISTS Contribute (
        Contribute_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Picture_Option VARCHAR(50) NOT NULL,
        Tag VARCHAR(50) NOT NULL,
        Plant_Name VARCHAR(50) NOT NULL,
        Plant_Family VARCHAR(50) NOT NULL,
        Plant_Genus VARCHAR(50) NOT NULL,
        Plant_Species VARCHAR(50) NOT NULL,
        Plant_Leaf_Photo VARCHAR(255) NOT NULL,
        Plant_Herbarium_Photo VARCHAR(255) NOT NULL,
        Comment_Contribute TEXT NOT NULL,
        Contribute_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql_contribute)) {
        die("Error creating contribute table: " . mysqli_error($conn));
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
        Enquiry_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql_enquiry)) {
        die("Error creating enquiry table: " . mysqli_error($conn));
    }

    mysqli_close($conn);
?>
