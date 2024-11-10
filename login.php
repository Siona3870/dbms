<?php
session_start(); // Start the session

include 'config.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Prepare the SQL statement to avoid SQL injection
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Verify the password and check if the user exists
    if ($user && password_verify($password, $user['password'])) {
        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id(true);

        // Store user data in session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username']; 
        $_SESSION['user_email'] = $user['email'];    

        // Redirect to the booking page (booking.php for PHP session handling)
        header("Location: booking.php");
        exit(); // Stop further execution to prevent accidental output
    } else {
        echo "<script>alert('Invalid email or password');window.location.href='login.php';</script>";
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
