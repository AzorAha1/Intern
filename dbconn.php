<?php
// Database connection parameters
$host = 'localhost'; // Database host (usually 'localhost' for local development)
$username = 'root';  // Your MySQL username (use 'root' for local development)
$password = '';      // Your MySQL password (leave empty for default)
$dbname = 'intern';  // The name of your database

// Create a new PDO connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // You can echo a message if the connection is successful (optional)
    // echo "Connected successfully"; 
} catch (PDOException $e) {
    // If the connection fails, display the error message
    echo "Connection failed: " . $e->getMessage();
}
?>
