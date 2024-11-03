<?php
    // Create connection
    $conn = mysqli_connect($servername,$username,$password,$dbname);

    // SQL to create Enquiry table
    $sql = "CREATE TABLE IF NOT EXISTS Enquiry (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(60) NOT NULL,
        email VARCHAR(50) NOT NULL,
        phone VARCHAR(15) NOT NULL,
        subject VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        street VARCHAR(100) NOT NULL,
        city VARCHAR(50) NOT NULL,
        postcode VARCHAR(10) NOT NULL,
        state VARCHAR(30) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql)) {
        die("Error creating table: " . mysqli_error($conn));
    }

    mysqli_close($conn);
?>
