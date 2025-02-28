<?php
$host = "localhost"; // Change if using a remote server
$user = "root";      // Default XAMPP MySQL user
$password = "";      // Default XAMPP password is empty
$database = "estcasa"; // Your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
