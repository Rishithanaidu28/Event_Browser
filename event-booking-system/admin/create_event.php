<?php 
session_start();
include("../includes/config.php");

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $venue = $_POST['venue'];
    $available_seats = $_POST['available_seats'];

    // Insert new event into the database
    $sql = "INSERT INTO events (title, date, description, venue, available_seats) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $date, $description, $venue, $available_seats);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Create New Event</h2>

<form method="POST" action="">
    <label for="title">Event Title:</label>
    <input type="text" name="title" required>

    <label for="date">Event Date:</label>
    <input type="date" name="date" required>

    <label for="description">Event Description:</label>
    <textarea name="description" required></textarea>

    <label for="venue">Venue:</label>
    <input type="text" name="venue" required>

    <label for="available_seats">Available Seats:</label>
    <input type="number" name="available_seats" required>

    <button type="submit">Create Event</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
