<?php
$servername = "localhost"; // Usually localhost for XAMPP
$username = "root";        // Default username for XAMPP
$password = "";            // Default password for XAMPP (leave blank)
$dbname = "c_booking_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>