<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "event_booking"; // Make sure this matches your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
