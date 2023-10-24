<?php
// Establishing connection
$conn = new mysqli("localhost", "root", "");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "USE UCodeSoftRegistration";
if (!$conn->query($sql)) {
    die("Error switching database: " . $conn->error);
}

// Creating database
$sql = "CREATE DATABASE IF NOT EXISTS UCodeSoftRegistration";
if (!$conn->query($sql)) {
    die("Error creating database: " . $conn->error);
}

// Creating table
$sql = "CREATE TABLE IF NOT EXISTS users (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(15) NOT NULL, username VARCHAR(15) NOT NULL UNIQUE, gender ENUM('Male', 'Female', 'Other') NOT NULL, email VARCHAR(50) NOT NULL UNIQUE, phone CHAR(10) NOT NULL UNIQUE, password VARCHAR(16) NOT NULL, active BOOLEAN DEFAULT TRUE)";
if (!$conn->query($sql)) {
    die("Error creating table: " . $conn->error);
}