<?php
session_start();
include("includes/config.php");

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in to cancel a booking.";
    header("Location: browse_events.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$event_id = $_POST['event_id'] ?? null;

if (!$event_id) {
    $_SESSION['error'] = "Invalid event selection.";
    header("Location: browse_events.php");
    exit();
}

// Check if the user has a booking for this event
$check_booking = $conn->prepare("SELECT * FROM bookings WHERE user_id = ? AND event_id = ?");
$check_booking->bind_param("ii", $user_id, $event_id);
$check_booking->execute();
$result = $check_booking->get_result();

if ($result->num_rows > 0) {
    // Delete the booking
    $delete_booking = $conn->prepare("DELETE FROM bookings WHERE user_id = ? AND event_id = ?");
    $delete_booking->bind_param("ii", $user_id, $event_id);
    $delete_booking->execute();

    // Increase available seats in the event
    $update_event = $conn->prepare("UPDATE events SET available_seats = available_seats + 1 WHERE id = ?");
    $update_event->bind_param("i", $event_id);
    $update_event->execute();

    $_SESSION['message'] = "Booking successfully canceled.";
} else {
    $_SESSION['error'] = "No booking found for this event.";
}

// Redirect back to events page
header("Location: browse_events.php");
exit();
?>
