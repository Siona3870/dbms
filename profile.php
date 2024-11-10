<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    exit();
}

// Retrieve user details from session
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <p>Welcome, <?php echo $user_name; ?>!</p>
    <p>Email: <?php echo $user_email; ?></p>

    <!-- Add other profile-related information here -->
</body>
</html>
