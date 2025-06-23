-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2025 at 08:55 PM
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
  `admen_full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admen_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admen_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `center_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admen_id`, `admen_full_name`, `admen_email`, `admen_password`, `location`, `phone`, `center_id`) VALUES
(1, 'yahya belhadj', 'yahya@gmail.com', '$2y$10$gQXk4iDyWnz6QwZrEL1IM.ZoMjZLtzS.XQ5rGbE6t5LN3CI83lcoq', 'tanger sa9aya', '06547125', 7),
(6, 'yahya belhadj2', 'sami@gmail.com', '$2y$10$3vlB.CzQmBXwVg4FWR87Jeh.RBw1oYO63iRDNsEdpveg8.OVFpsRi', 'tanger KASBAH', '065471245', 8);

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
  `Description` varchar(255) DEFAULT NULL,
  `person_in_need_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blood_request`
--

INSERT INTO `blood_request` (`blood_request_id`, `needed_units`, `request_status`, `hospital_name`, `location`, `status`, `created_at`, `blood_type_id`, `center_id`, `contact`, `needed_at`, `Description`, `person_in_need_name`) VALUES
(1, 5, 'done', 'mohamed 5', '', 'urgent', '2025-06-15 16:09:21', 10, 7, 'yahya bin yahya | 06060618 |yahya.belhadj.pro@gmail.com', '2025-06-22', 'please helppppppp', 'saida'),
(4, 3, 'done', 'mohamed 5', '', 'normal', '2025-06-17 12:23:36', 12, 7, 'abdol | 123456789 | yahya.belhadj.pro@gmail.com', '2026-01-01', 'WE NEED THIS BLOOD', 'nour');

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
(49, 25, 1, '2025-06-13', 25, 10, 7),
(50, 5, 2, '2025-06-20', 30, 11, 7),
(51, 0, 3, '2025-06-11', 35, 12, 7),
(52, 25, 4, '2025-06-14', 28, 13, 7),
(53, 0, 5, '2025-06-11', 40, 14, 7),
(54, 0, 6, '2025-06-11', 22, 15, 7),
(55, 38, 7, '2025-06-11', 38, 16, 7),
(56, 27, 8, '2025-06-16', 27, 17, 7),
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
  `blood_type_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `center_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `center_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `opening_hours` time DEFAULT NULL,
  `center_image` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `max_limite_per_day` int DEFAULT NULL,
  `closing_hour` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_centers`
--

INSERT INTO `donation_centers` (`center_id`, `center_name`, `center_location`, `contact_number`, `opening_hours`, `center_image`, `max_limite_per_day`, `closing_hour`) VALUES
(7, 'Tanger Central Blood Bank', 'Tanger, Morocco', '0539-123456', '08:00:00', '..\\center images\\center1.png', 10, '17:00:00'),
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
  `status` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `donation_date` date DEFAULT NULL,
  `donation_time_stamp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `news_event_id` int DEFAULT NULL,
  `center_id` int DEFAULT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_request`
--

INSERT INTO `donation_request` (`request_id`, `status`, `request_date`, `donation_date`, `donation_time_stamp`, `news_event_id`, `center_id`, `user_id`) VALUES
(7, 'pending', '2025-06-13', '2025-07-01', 'morning', NULL, 7, 3),
(8, 'pending', '2025-06-13', '2025-07-20', 'morning', NULL, 7, 3),
(18, 'pending', '2025-06-17', '2025-07-12', 'afternone', NULL, 11, 7),
(19, 'pending', '2025-06-17', '2025-07-27', 'morning', NULL, 11, 7),
(28, 'pending', '2025-06-18', '2025-06-20', 'afternone', NULL, 11, 20),
(30, 'pending', '2025-06-18', '2025-06-25', 'afternone', NULL, 11, 4),
(31, 'pending', '2025-06-18', '2025-07-16', 'evining', NULL, 8, 4),
(37, 'pending', '2025-06-18', '2025-08-22', 'morning', NULL, 8, 3),
(38, 'done', '2025-06-23', '2025-06-27', 'evining', 27, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `news_events`
--

CREATE TABLE `news_events` (
  `news_event_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `news_events_date` date DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `max_units_needed` int DEFAULT NULL,
  `center_id` int NOT NULL,
  `data_of_relais` date DEFAULT NULL,
  `blood_type_needed` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_events`
--

INSERT INTO `news_events` (`news_event_id`, `title`, `description`, `news_events_date`, `type`, `max_units_needed`, `center_id`, `data_of_relais`, `blood_type_needed`) VALUES
(24, 'ahmed needs you', 'ahmed need A+ blood for his brain cancer', '2025-07-24', 'event', 2, 7, '2025-06-23', 'A+ AB+'),
(27, 'help kids', 'donation event for kids who have cancer', '2025-09-25', 'event', 5, 7, '2025-06-23', 'ALL'),
(28, 'donation therepy', 'donating blood may save your life', NULL, 'news', NULL, 7, '2025-06-23', NULL),
(29, 'save a life', 'by donating one tie you at list saved a person', NULL, 'news', NULL, 7, '2025-06-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `blood_card_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `blood_type_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `user_email`, `user_password`, `location`, `phone`, `blood_card_photo`, `blood_type_id`) VALUES
(3, 'yahya belhadj', 'yahya.belhadj.pro@gmail.com', '$2y$10$8W94u9NETfgy6/Ouuc9MWe.Jfqiqjzp62IXUSrMw45k.1j3NvTD1W', 'tanger kasbah', '0681321347', NULL, 10),
(4, 'wahiba BASRI', 'jomanalola25@gmail.com', '$2y$10$VPOOvXwyZE8f9bdAb7JNuOVWpb8.rwq8ZISamGcqwE9/GtCJ1H8..', 'tanger kasbah', '0606061877', NULL, 16),
(6, 'monir MRISI', 'marnissimounir05@gmail.com', '$2y$10$zTLExj33GHwsSHh2kUHDDuJ1VIXy67reiaegaMZb1rjka/NtcIg.y', 'darbaida dradb', '1234567891', NULL, 17),
(7, 'sami basri', 'jornojovana9@gmail.com', '$2y$10$4g/CZvfCCp5Iy3qdOhBwjexPM0wlheHgZuHYDOFZgy33qHbUzBTXO', 'tanger mrchan', '1234567892', NULL, 10),
(20, 'nour cherif', 'nourchirawi12@gmail.com', '$2y$10$hypqZZ44mJuNexxo5SiA5.ipYaRe2zKMWnRlDgGzpUAJLHi6f3YbG', 'tanger DRADEB', '12245436543', NULL, 10),
(21, 'mohamed sombol', 'sombol@gmail.com', '$2y$10$1DNLEo.x3/Vxvz9bHdTsg.4cdz9A8bSTcoDlz.0qNvuMJ0hRnuO0S', 'tanger hayani', '1213456453', NULL, 11),
(23, 'brahim rabi3', 'brahim@gmail.com', '$2y$10$sCB8Ib9Uqt6lJ5w9e9DSEOujSe/X0uf1C3MjdJEdBK.ti6bpwSYiO', 'tanger zan9a_chok', '14725836997', NULL, 16),
(24, 'wahiba_zayn garen', 'sdcihnz@gmail.com', '$2y$10$wZ.3bd2GTHQP8J5.sIYZdu8cMMen2rGpYj2NsTh8cRFxnpfyVC7ma', 'chawn chalal', '1478523698', NULL, 12);

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
  MODIFY `admen_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `blood_request`
--
ALTER TABLE `blood_request`
  MODIFY `blood_request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `news_events`
--
ALTER TABLE `news_events`
  MODIFY `news_event_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
