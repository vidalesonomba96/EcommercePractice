<?php
// EcommerceProject/db_connect.php

$servername = "localhost"; // Or your server address if different
$username_db = "root"; // Your MySQL username for phpMyAdmin
$password_db = ""; // Your MySQL password for phpMyAdmin
$dbname = "users_db"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    // In a real application, log this error and show a user-friendly message
    // For debugging, you can leave die()
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully"; // Uncomment for testing connection
?>