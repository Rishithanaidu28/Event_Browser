<?php 
session_start();
include("../includes/config.php");

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Get the event ID from the URL
$event_id = $_GET['id'];

// Fetch event details from the database
$sql = "SELECT * FROM events WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get updated data from the form
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $venue = $_POST['venue'];
    $available_seats = $_POST['available_seats'];

    // Update event in the database
    $sql = "UPDATE events SET title=?, date=?, description=?, venue=?, available_seats=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $title, $date, $description, $venue, $available_seats, $event_id);

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
    <title>Edit Event - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Edit Event</h2>

<form method="POST" action="">
    <label for="title">Event Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>

    <label for="date">Event Date:</label>
    <input type="date" name="date" value="<?php echo htmlspecialchars($event['date']); ?>" required>

    <label for="description">Event Description:</label>
    <textarea name="description" required><?php echo htmlspecialchars($event['description']); ?></textarea>

    <label for="venue">Venue:</label>
    <input type="text" name="venue" value="<?php echo htmlspecialchars($event['venue']); ?>" required>

    <label for="available_seats">Available Seats:</label>
    <input type="number" name="available_seats" value="<?php echo htmlspecialchars($event['available_seats']); ?>" required>

    <button type="submit">Update Event</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
