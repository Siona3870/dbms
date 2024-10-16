<?php
// Display errors for debugging (optional)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "c_booking_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
