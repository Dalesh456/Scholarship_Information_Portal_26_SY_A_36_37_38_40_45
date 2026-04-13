<?php
// Database Configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'scholarship_portal';

// Create Connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
