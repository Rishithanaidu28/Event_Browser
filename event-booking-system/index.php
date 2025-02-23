<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Welcome to Event Booking System</h1>
    <nav>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="browse_events.php">Browse Events</a>
    </nav>
</header>

<div class="container">
    
</div>

<!-- Load JavaScript at the end for better performance -->
<script src="js/script.js"></script>

</body>
</html>
