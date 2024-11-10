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

// After setting the session variables
//var_dump($_SESSION); // Uncomment for debugging if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            justify-content: center;
            background-color: #2d333b;
            color: #ffffff;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #ffffff;
            color: #000000;
            align-items: center;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #000000;
        }

        .profile-container {
            text-align: left;
            margin-top: 50px;
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        .profile-detail {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .action-button {
            background-color: #ffcc33;
            color: #2d333b;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
            margin: 10px 5px;
            transition: background-color 0.3s;
        }

        .action-button:hover {
            background-color: #e6b800;
        }

        .button-container {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <div class="title">
        &#128100; User Profile
    </div>
</header>

<div class="profile-container">
    <p class="profile-detail" id="user-name">Name: <?php echo $user_name; ?></p>
    <p class="profile-detail" id="user-email">Email: <?php echo $user_email; ?></p>

    <div class="button-container">
        <button class="action-button" onclick="editProfile()">Edit Profile</button>
        <button class="action-button" onclick="viewActivity()">View Past Activity</button>
    </div>
</div>

<script>
    // Redirect functions for buttons
    function editProfile() {
        window.location.href = "edit-profile.php"; // Adjust to your edit profile page
    }

    function viewActivity() {
        window.location.href = "past-activity.php"; // Adjust to your past activity page
    }
</script>

</body>
</html>
