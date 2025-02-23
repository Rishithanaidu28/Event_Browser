<?php
include("includes/config.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to book an event.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $user_id = $_SESSION['user_id'];

    // Check if the user already booked this event
    $sql = "SELECT id FROM bookings WHERE user_id = ? AND event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User already booked this event
        echo "<p style='color: red; font-weight: bold;'>You have already booked this event.</p>";
    } else {
        // Check if there are available seats
        $sql = "SELECT available_seats FROM events WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $stmt->bind_result($available_seats);
        $stmt->fetch();
        $stmt->close();

        if ($available_seats > 0) {
            // Insert booking
            $sql = "INSERT INTO bookings (user_id, event_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $user_id, $event_id);
            if ($stmt->execute()) {
                // Reduce available seats
                $sql = "UPDATE events SET available_seats = available_seats - 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $event_id);
                $stmt->execute();

                echo "<p style='color: green; font-weight: bold;'>Booking successful!</p>";
            } else {
                echo "<p style='color: red; font-weight: bold;'>Error booking event.</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color: red; font-weight: bold;'>No seats available.</p>";
        }
    }
}
?>

<!-- Back to Event Manager Button -->
<br>
<a href="browse_events.php" style="text-decoration: none; padding: 10px 15px; background: #007bff; color: white; border-radius: 5px; font-weight: bold;">Back to Event Manager</a>
