<?php 
session_start();
include("../includes/config.php");

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Fetch all events
$sql = "SELECT * FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Event Booking System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Admin Dashboard</h2>

<!-- Display List of Events -->
<h3>Events</h3>
<table border="1">
    <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Venue</th>
        <th>Available Seats</th>
        <th>Actions</th>
    </tr>
    <?php while ($event = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo htmlspecialchars($event['title']); ?></td>
        <td><?php echo htmlspecialchars($event['date']); ?></td>
        <td><?php echo htmlspecialchars($event['venue']); ?></td>
        <td><?php echo htmlspecialchars($event['available_seats']); ?></td>
        <td>
            <a href="edit_event.php?id=<?php echo $event['id']; ?>">Edit</a> |
            <a href="delete_event.php?id=<?php echo $event['id']; ?>" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a> |
            <a href="view_bookings.php?id=<?php echo $event['id']; ?>">View Bookings</a>
        </td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="create_event.php">Create New Event</a> | 
<a href="../logout.php">Logout</a>

</body>
</html>
