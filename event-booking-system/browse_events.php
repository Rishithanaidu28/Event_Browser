<?php
session_start();
include("includes/config.php");

$user_id = $_SESSION['user_id']; // Ensure the user is logged in

$sql = "SELECT * FROM events WHERE available_seats > 0";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Events</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Add styling for logout button */
        .logout-button {
            background-color: #f44336; /* Red color */
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
            font-weight: bold;
        }

        .logout-button:hover {
            background-color: #d32f2f; /* Darker red on hover */
        }

        /* Centering the main title */
        h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Container styling */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Event box styling */
        .event {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .event h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.5em;
        }

        .event p {
            color: #555;
            margin: 5px 0;
        }

        /* Book & Cancel buttons */
        .event button {
            display: inline-block;
            width: 100%;
            max-width: 200px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            font-size: 1em;
        }

        .event button:hover {
            background-color: #0056b3;
        }

        .cancel-btn {
            background: #dc3545;
        }

        .cancel-btn:hover {
            background: #c82333;
        }

        /* Success/Error messages */
        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            border-radius: 5px;
        }

        .success {
            background-color: #28a745;
            color: white;
        }

        .error {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logout button -->
        <a href="logout.php" class="logout-button">Logout</a>

        <h2>Available Events</h2>

        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['message'])) { ?>
            <p class="message success"><?= $_SESSION['message']; ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <p class="message error"><?= $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php } ?>

        <?php while ($row = $result->fetch_assoc()) { 
            $event_id = $row['id'];

            // Check if the user has already booked this event
            $check_booking = $conn->query("SELECT * FROM bookings WHERE user_id = '$user_id' AND event_id = '$event_id'");
            $is_booked = $check_booking->num_rows > 0;
        ?>
            <div class="event">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p><?= htmlspecialchars($row['description']) ?></p>
                <p><strong>Date:</strong> <?= $row['date'] ?></p>
                <p><strong>Venue:</strong> <?= htmlspecialchars($row['venue']) ?></p>
                <p><strong>Seats Available:</strong> <?= $row['available_seats'] ?></p>

                <?php if ($is_booked) { ?>
                    <form action="cancel_booking.php" method="post">
                        <input type="hidden" name="event_id" value="<?= $event_id ?>">
                        <button type="submit" class="cancel-btn">Cancel Booking</button>
                    </form>
                <?php } else { ?>
                    <form action="book_event.php" method="post">
                        <input type="hidden" name="event_id" value="<?= $event_id ?>">
                        <button type="submit">Book Now</button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>
