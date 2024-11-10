<?php
$pickupLat = $_GET['pickupLat'];
$pickupLng = $_GET['pickupLng'];
$dropoffLat = $_GET['dropoffLat'];
$dropoffLng = $_GET['dropoffLng'];


$apiKey = '5b3ce3597851110001cf624828f799c4e10a4908b87c9d480519a4b2';  // Your OpenRouteService API key here
$url = "https://api.openrouteservice.org/v2/directions/driving-car?api_key=$apiKey&start=$pickupLng,$pickupLat&end=$dropoffLng,$dropoffLat";

// Use PHP to fetch data from OpenRouteService
$response = file_get_contents($url);

// Send the response back to the browser
echo $response;
?>
