<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    die('User not logged in'); // If not logged in, stop execution
}

// Get data from the URL
$pickupLat = $_GET['pickupLat'];
$pickupLng = $_GET['pickupLng'];
$dropoffLat = $_GET['dropoffLat'];
$dropoffLng = $_GET['dropoffLng'];
$price = $_GET['price']; // Receive price from JavaScript

$user_name = $_SESSION['user_name']; // Get user_name from session

// OpenRouteService API Key and URL
$apiKey = '5b3ce3597851110001cf624828f799c4e10a4908b87c9d480519a4b2'; // Replace with your OpenRouteService API key
$url = "https://api.openrouteservice.org/v2/directions/driving-car?api_key=$apiKey&start=$pickupLng,$pickupLat&end=$dropoffLng,$dropoffLat";

// Fetch data from OpenRouteService
$response = file_get_contents($url);

// Decode the API response to get route details (if needed for future use)
$routeData = json_decode($response, true);

// You can extract information like distance or duration here if necessary
if ($routeData) {
    // You can do something with the route data if needed for debugging or logging
    // For example, logging the distance or duration for later use
    // $distance = $routeData['features'][0]['properties']['segments'][0]['distance'];
    // $duration = $routeData['features'][0]['properties']['segments'][0]['duration'];
} else {
    // Handle error if no valid data returned from OpenRouteService
    echo json_encode(['success' => false, 'message' => 'Error fetching route data']);
    exit;
}

// Database connection using PDO
$dsn = 'mysql:host=localhost;dbname=c_booking_db';
$username = 'root';
$password = ''; // Change this to your actual DB password
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $username, $password, $options);

    // Update the fare for the current user in the booking table
    $stmt = $pdo->prepare('UPDATE booking SET fare = ? WHERE user_name = ?');
    $stmt->execute([$price, $user_name]);

    // Return a success response
    echo json_encode(['success' => true, 'message' => 'Fare updated successfully!']);
} catch (PDOException $e) {
    // Handle any database connection errors
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>

