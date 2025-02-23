-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2025 at 02:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `event_id`, `booking_date`) VALUES
(1, 1, 1, '2025-02-23 08:55:49'),
(2, 1, 2, '2025-02-23 09:32:23'),
(3, 3, 2, '2025-02-23 10:40:40'),
(4, 3, 4, '2025-02-23 10:40:46'),
(5, 5, 2, '2025-02-23 10:48:11'),
(6, 5, 5, '2025-02-23 10:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `venue` varchar(255) NOT NULL,
  `available_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `venue`, `available_seats`) VALUES
(1, 'Tech Conference 2025', 'A technology conference on AI and Web Development', '2025-03-10', 'Conference Hall A', 46),
(2, 'Music Fest', 'A live music concert with various artists', '2025-04-15', 'City Stadium', 97),
(3, 'Startup Meetup', 'A meetup for entrepreneurs and investors', '2025-05-20', 'Business Center', 30),
(4, 'Dancing Fest', 'Dancing event for the enjoyment purpose', '2025-02-25', 'Sai Nagar', 49),
(5, 'Concert Night', 'Cocert Dj Night', '2025-02-28', 'MBU', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'RishiJanu', 'rishijanu@gmail.com', '$2y$10$cQar6mNS68EiGg4/VRJED.ucUCtPZDbiVaPyzN.KdAt.cyUP8c15W', 'user'),
(3, 'mammu', 'mammu@gmail.com', '$2y$10$FfwEXYIZKirE3G4qZ73nrezbVEvPd2OLcrKoy/Vir.vtJpbPpL2PG', 'user'),
(4, 'Admin User', 'admin@gmail.com', '$2y$10$AEfcFL1fQg39n1/PJHFiPOPlJpw8VtBi6bZbFLlgEhRtmmLcfwHWK', 'admin'),
(5, 'Shaik Ishrath', 'ishrath@gmail.com', '$2y$10$y4dwb6oBNFAcDkD1BUmeYeNAZNAKHny25HWLyeQVoodpiOG7tVcZ.', 'user'),
(6, 'Naidu', 'naidu@gmail.com', '$2y$10$hBZustHq1zIflnzlQ69uvOgGjLMjKh2dqG1QVrUVIDOvqzJLpWaoy', 'user'),
(7, 'abc', 'abc@gmail.com', '$2y$10$2Z5huujuXO1Zv7sfnr/H5OaAr2ZfwqPkMbrb5ocw3gkXUKJPQqfPi', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
