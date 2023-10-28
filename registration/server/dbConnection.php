<?php
try {
    mysqli_report(MYSQLI_REPORT_OFF);
    // Establishing connection
    $conn = new mysqli("localhost", "root", "");

    // Creating database
    $sql = "CREATE DATABASE IF NOT EXISTS UCodeSoftRegistration";
    $conn->query($sql);

    // Switching database
    $sql = "USE UCodeSoftRegistration";
    $conn->query($sql);
    
    // Creating users table
    $sql = "CREATE TABLE IF NOT EXISTS users (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(15) NOT NULL, username VARCHAR(15) NOT NULL UNIQUE, gender ENUM('Male', 'Female', 'Other') NOT NULL, email VARCHAR(50) NOT NULL UNIQUE, phone CHAR(10) NOT NULL UNIQUE, password VARCHAR(16) NOT NULL, active BOOLEAN DEFAULT TRUE)";
    $conn->query($sql);

    // Creating userImg table
    $sql = "CREATE TABLE IF NOT EXISTS userImg (img_id INT PRIMARY KEY AUTO_INCREMENT, user_id int, display_name VARCHAR(50), unique_name VARCHAR(50), creation_date DATETIME, modified_date DATETIME DEFAULT NULL, FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE)";
    $conn->query($sql);
} catch (Exception $ex) {
    die("Some error occured: " . $ex->getMessage());
}
