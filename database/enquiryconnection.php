<!DOCTYPE html>

<?php
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inquiry_system";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if (mysqli_query($conn, $sql)) {
        // Select the database
        mysqli_select_db($conn, $dbname);
    } else {
        die("Error creating database: " . mysqli_error($conn));
    }
?>
