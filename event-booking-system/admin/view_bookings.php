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

// Fetch bookings for the specific event
$sql = "SELECT * FROM bookings WHERE event_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Bookings for Event ID: <?php echo $event_id; ?></h2>

<table border="1">
    <tr>
        <th>User ID</th>
        <th>Booking Date</th>
        <th>Seats Booked</th>
    </tr>
    <?php while ($booking = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo htmlspecialchars($booking['user_id']); ?></td>
        <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
        <td><?php echo htmlspecialchars($booking['seats_booked']); ?></td>
    </tr>
    <?php } ?>
</table>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
