<?php
    // Create connection
    $conn = mysqli_connect($servername,$username,$password,$dbname);

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
        die("Error creating table: " . mysqli_error($conn));
    }


    // SQL to create Register table
    $sql_register = "CREATE TABLE IF NOT EXISTS Register (
        Register_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(60) NOT NULL,
        Username VARCHAR(60) NOT NULL,
        Email VARCHAR(50) NOT NULL,
        Password VARCHAR(15) NOT NULL,
        Confirm_Password VARCHAR(15) NOT NULL,
        Register_Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql_register)) {
        die("Error creating table: " . mysqli_error($conn));
    }

    mysqli_close($conn);
?>
