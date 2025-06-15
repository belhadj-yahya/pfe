-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2025 at 09:12 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admen_id` int NOT NULL,
  `admen_full_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admen_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admen_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `center_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admen_id`, `admen_full_name`, `admen_email`, `admen_password`, `location`, `phone`, `center_id`) VALUES
(1, 'yahya belhadj', 'yahya@gmail.com', '$2y$10$gQXk4iDyWnz6QwZrEL1IM.ZoMjZLtzS.XQ5rGbE6t5LN3CI83lcoq', 'tanger sa9aya', '06547125', 7);

-- --------------------------------------------------------

--
-- Table structure for table `blood_request`
--

CREATE TABLE `blood_request` (
  `blood_request_id` int NOT NULL,
  `needed_units` int DEFAULT NULL,
  `request_status` varchar(100) DEFAULT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `blood_type_id` int NOT NULL,
  `center_id` int NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `needed_at` date DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blood_request`
--

INSERT INTO `blood_request` (`blood_request_id`, `needed_units`, `request_status`, `hospital_name`, `location`, `status`, `created_at`, `blood_type_id`, `center_id`, `contact`, `needed_at`, `Description`) VALUES
(1, 5, 'done', 'mohamed 5', '', 'urgent', '2025-06-15 16:09:21', 10, 7, 'yahya bin yahya | 06060618 |yahya.belhadj.pro@gmail.com', '2025-06-22', 'please helppppppp'),
(3, 1, 'pending', 'cnsdjf', '', 'urgent', '2025-06-15 16:17:44', 11, 9, 'yahya bin yahya3 | 06060648 | hos@gmail.com', '2026-07-14', 'sfk');

-- --------------------------------------------------------

--
-- Table structure for table `blood_supplay`
--

CREATE TABLE `blood_supplay` (
  `blood_supplay_id` int NOT NULL,
  `availible_unit` int DEFAULT NULL,
  `required_units` int DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `max_units` int DEFAULT NULL,
  `blood_type_id` int NOT NULL,
  `center_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_supplay`
--

INSERT INTO `blood_supplay` (`blood_supplay_id`, `availible_unit`, `required_units`, `last_update`, `max_units`, `blood_type_id`, `center_id`) VALUES
(49, 10, 1, '2025-06-13', 25, 10, 7),
(50, 0, 2, '2025-06-11', 30, 11, 7),
(51, 0, 3, '2025-06-11', 35, 12, 7),
(52, 25, 4, '2025-06-14', 28, 13, 7),
(53, 0, 5, '2025-06-11', 40, 14, 7),
(54, 0, 6, '2025-06-11', 22, 15, 7),
(55, 0, 7, '2025-06-11', 38, 16, 7),
(56, 0, 8, '2025-06-11', 27, 17, 7),
(57, 0, 1, '2025-06-11', 33, 10, 8),
(58, 0, 2, '2025-06-11', 24, 11, 8),
(59, 0, 3, '2025-06-11', 40, 12, 8),
(60, 0, 4, '2025-06-11', 37, 13, 8),
(61, 0, 5, '2025-06-11', 29, 14, 8),
(62, 0, 6, '2025-06-11', 26, 15, 8),
(63, 0, 7, '2025-06-11', 34, 16, 8),
(64, 0, 8, '2025-06-11', 31, 17, 8),
(65, 0, 1, '2025-06-11', 21, 10, 9),
(66, 0, 2, '2025-06-11', 39, 11, 9),
(67, 0, 3, '2025-06-11', 30, 12, 9),
(68, 0, 4, '2025-06-11', 26, 13, 9),
(69, 0, 5, '2025-06-11', 40, 14, 9),
(70, 0, 6, '2025-06-11', 35, 15, 9),
(71, 0, 7, '2025-06-11', 22, 16, 9),
(72, 0, 8, '2025-06-11', 24, 17, 9),
(73, 0, 1, '2025-06-11', 28, 10, 10),
(74, 0, 2, '2025-06-11', 23, 11, 10),
(75, 0, 3, '2025-06-11', 37, 12, 10),
(76, 0, 4, '2025-06-11', 32, 13, 10),
(77, 0, 5, '2025-06-11', 40, 14, 10),
(78, 0, 6, '2025-06-11', 21, 15, 10),
(79, 0, 7, '2025-06-11', 26, 16, 10),
(80, 0, 8, '2025-06-11', 29, 17, 10),
(81, 0, 1, '2025-06-11', 38, 10, 11),
(82, 0, 2, '2025-06-11', 30, 11, 11),
(83, 0, 3, '2025-06-11', 27, 12, 11),
(84, 0, 4, '2025-06-11', 24, 13, 11),
(85, 0, 5, '2025-06-11', 20, 14, 11),
(86, 0, 6, '2025-06-11', 39, 15, 11),
(87, 0, 7, '2025-06-11', 35, 16, 11),
(88, 0, 8, '2025-06-11', 22, 17, 11),
(89, 0, 1, '2025-06-11', 25, 10, 12),
(90, 0, 2, '2025-06-11', 40, 11, 12),
(91, 0, 3, '2025-06-11', 28, 12, 12),
(92, 0, 4, '2025-06-11', 31, 13, 12),
(93, 0, 5, '2025-06-11', 36, 14, 12),
(94, 0, 6, '2025-06-11', 23, 15, 12),
(95, 0, 7, '2025-06-11', 29, 16, 12),
(96, 0, 8, '2025-06-11', 27, 17, 12);

-- --------------------------------------------------------

--
-- Table structure for table `blood_types`
--

CREATE TABLE `blood_types` (
  `blood_type_id` int NOT NULL,
  `blood_type_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_types`
--

INSERT INTO `blood_types` (`blood_type_id`, `blood_type_name`) VALUES
(10, 'A+'),
(11, 'A-'),
(12, 'B+'),
(13, 'B-'),
(14, 'AB+'),
(15, 'AB-'),
(16, 'O+'),
(17, 'O-'),
(18, 'I don\'t know');

-- --------------------------------------------------------

--
-- Table structure for table `donation_centers`
--

CREATE TABLE `donation_centers` (
  `center_id` int NOT NULL,
  `center_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `center_location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `opening_hours` time DEFAULT NULL,
  `center_image` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `max_limite_per_day` int DEFAULT NULL,
  `closing_hour` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_centers`
--

INSERT INTO `donation_centers` (`center_id`, `center_name`, `center_location`, `contact_number`, `opening_hours`, `center_image`, `max_limite_per_day`, `closing_hour`) VALUES
(7, 'Tanger Central Blood Bank', 'Tanger, Morocco', '0539-123456', '08:00:00', '..\\center images\\center1.png', 100, '17:00:00'),
(8, 'Tanger City Hospital Blood Center', 'Tanger, Morocco', '0539-654321', '09:00:00', '..\\center images\\center2.png', 80, '18:00:00'),
(9, 'Tanger North Donation Center', 'Tanger, Morocco', '0539-112233', '08:30:00', '..\\center images\\center3.png', 70, '16:30:00'),
(10, 'Tanger South Donation Center', 'Tanger, Morocco', '0539-445566', '08:00:00', '..\\center images\\center4.png', 90, '17:00:00'),
(11, 'Tanger University Blood Donation', 'Tanger, Morocco', '0539-778899', '10:00:00', '..\\center images\\center5.png', 60, '16:00:00'),
(12, 'Tanger Community Health Center', 'Tanger, Morocco', '0539-998877', '07:30:00', '..\\center images\\center6.png', 50, '15:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `donation_request`
--

CREATE TABLE `donation_request` (
  `request_id` int NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `donation_date` date DEFAULT NULL,
  `donation_time_stamp` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `news_event_id` int DEFAULT NULL,
  `center_id` int DEFAULT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_request`
--

INSERT INTO `donation_request` (`request_id`, `status`, `request_date`, `donation_date`, `donation_time_stamp`, `news_event_id`, `center_id`, `user_id`) VALUES
(7, 'pending', '2025-06-13', '2025-06-14', 'morning', NULL, 7, 3),
(8, 'pending', '2025-06-13', '2025-06-14', 'morning', NULL, 7, 3),
(9, 'pending', '2025-06-13', '2025-06-15', 'afternone', NULL, 7, 3),
(10, 'pending', '2025-06-13', '2025-06-16', 'evining', NULL, 7, 3),
(11, 'pending', '2025-06-13', '2025-06-08', 'morning', NULL, 7, 3),
(12, 'pending', '2025-06-14', '2025-06-16', 'morning', 13, NULL, 3),
(13, 'pending', '2026-06-01', '2025-06-11', 'morning', NULL, 7, 3),
(14, 'pending', '2025-06-14', '2025-06-16', 'morning', 14, NULL, 3),
(15, 'pending', '2025-06-14', '2025-07-11', 'morning', NULL, 11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `news_events`
--

CREATE TABLE `news_events` (
  `news_event_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `news_events_date` date DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `max_units_needed` int DEFAULT NULL,
  `center_id` int NOT NULL,
  `data_of_relais` date DEFAULT NULL,
  `blood_type_needed` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_events`
--

INSERT INTO `news_events` (`news_event_id`, `title`, `description`, `news_events_date`, `type`, `max_units_needed`, `center_id`, `data_of_relais`, `blood_type_needed`) VALUES
(13, 'hamza need help', 'hamza is a 21 years old boy who need O- blood type', '2025-06-21', 'event', 10, 7, '2025-06-13', 'O-'),
(14, 'ahmad need you', 'ahmad need blood since he was a kid', '2025-06-27', 'event', 5, 7, '2025-06-14', 'AB+ A+'),
(15, 'eating currots', 'eating currots is useless', NULL, 'news', NULL, 7, '2025-06-14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_full_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `blood_card_photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `blood_type_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `user_email`, `user_password`, `location`, `phone`, `blood_card_photo`, `blood_type_id`) VALUES
(3, 'yahya belhadj', 'yahya.belhadj.pro@gmail.com', '$2y$10$wGKYb7POGHkiAq4sWiSU5ONV9rYpft1e9PK0ZPDFDe60oD4C2Yzou', 'tanger kasbah', '0681321347', NULL, 10),
(4, 'wahiba basri', 'jomanalola25@gmail.com', '$2y$10$O/UxSWX3QyKrLIXi1zzcQeBQyAQRcE6GZevXtn2JZ6m9av9EOVPVy', 'tanger kasbah', '0606061877', NULL, 16),
(5, 'sami', 'sami@gmail.com', '$2y$10$Al4LH4E0rb8BvZG2RX6TDuyX29MO.fnVBj602GMtsQR6tfEPTZoUG', 'kasbah tanger', '028476158', NULL, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admen_id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `blood_request`
--
ALTER TABLE `blood_request`
  ADD PRIMARY KEY (`blood_request_id`),
  ADD KEY `blood_type_id` (`blood_type_id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `blood_supplay`
--
ALTER TABLE `blood_supplay`
  ADD PRIMARY KEY (`blood_supplay_id`),
  ADD KEY `blood_type_id` (`blood_type_id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `blood_types`
--
ALTER TABLE `blood_types`
  ADD PRIMARY KEY (`blood_type_id`);

--
-- Indexes for table `donation_centers`
--
ALTER TABLE `donation_centers`
  ADD PRIMARY KEY (`center_id`);

--
-- Indexes for table `donation_request`
--
ALTER TABLE `donation_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `news_event_id` (`news_event_id`),
  ADD KEY `center_id` (`center_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `news_events`
--
ALTER TABLE `news_events`
  ADD PRIMARY KEY (`news_event_id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `blood_type_id` (`blood_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admen_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blood_request`
--
ALTER TABLE `blood_request`
  MODIFY `blood_request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blood_supplay`
--
ALTER TABLE `blood_supplay`
  MODIFY `blood_supplay_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `blood_types`
--
ALTER TABLE `blood_types`
  MODIFY `blood_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `donation_centers`
--
ALTER TABLE `donation_centers`
  MODIFY `center_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `donation_request`
--
ALTER TABLE `donation_request`
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `news_events`
--
ALTER TABLE `news_events`
  MODIFY `news_event_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `donation_centers` (`center_id`) ON DELETE CASCADE;

--
-- Constraints for table `blood_request`
--
ALTER TABLE `blood_request`
  ADD CONSTRAINT `blood_request_ibfk_1` FOREIGN KEY (`blood_type_id`) REFERENCES `blood_types` (`blood_type_id`),
  ADD CONSTRAINT `blood_request_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `donation_centers` (`center_id`);

--
-- Constraints for table `blood_supplay`
--
ALTER TABLE `blood_supplay`
  ADD CONSTRAINT `blood_supplay_ibfk_1` FOREIGN KEY (`blood_type_id`) REFERENCES `blood_types` (`blood_type_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blood_supplay_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `donation_centers` (`center_id`) ON DELETE CASCADE;

--
-- Constraints for table `donation_request`
--
ALTER TABLE `donation_request`
  ADD CONSTRAINT `donation_request_ibfk_1` FOREIGN KEY (`news_event_id`) REFERENCES `news_events` (`news_event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_request_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `donation_centers` (`center_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_request_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `news_events`
--
ALTER TABLE `news_events`
  ADD CONSTRAINT `news_events_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `donation_centers` (`center_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`blood_type_id`) REFERENCES `blood_types` (`blood_type_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
