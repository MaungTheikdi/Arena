-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2024 at 08:31 AM
-- Server version: 8.0.30
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theikdimaung_arena2`
--

-- --------------------------------------------------------

--
-- Table structure for table `arena_events`
--

CREATE TABLE `arena_events` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `event_date` datetime NOT NULL,
  `price` int DEFAULT '0',
  `status` enum('Upcoming','Ongoing','Completed','Canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Upcoming',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arena_events`
--

INSERT INTO `arena_events` (`id`, `name`, `description`, `event_date`, `price`, `status`, `created_at`, `updated_at`, `image_url`) VALUES
(1, 'Event Name', '  \r\n                This is event description  \r\n            ', '2024-12-09 22:00:00', 20000, 'Upcoming', '2024-12-08 09:13:59', '2024-12-11 17:35:03', 'event_photos/6759cd476127d.jpg'),
(2, 'Event Name Two', '  \r\n                Description  \r\n            ', '2024-12-09 22:00:00', 25000, 'Upcoming', '2024-12-08 09:31:57', '2024-12-11 17:35:11', 'event_photos/6759cd4fc4765.jpg'),
(3, 'Eevent New', 'Eevent New', '2024-12-12 00:03:00', 100000, 'Upcoming', '2024-12-11 17:33:37', '2024-12-11 17:33:37', 'event_photos/6759ccf17fad4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `menu_item_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`menu_item_id`, `name`) VALUES
(1, 'Person'),
(2, 'Beer'),
(3, 'Water'),
(4, 'Mixer'),
(5, 'Limited Edition'),
(6, 'Fruit'),
(7, 'Signature Shisha'),
(8, 'Gold Label'),
(9, 'French Fried');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int NOT NULL,
  `customer_service_phone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int NOT NULL,
  `table_type_id` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `table_type_id`, `description`, `price`) VALUES
(1, 1, '4 persons, 4 beers, 2 waters, 2 mixers', 200000),
(2, 2, '5 persons, 10 beers, 3 waters, 3 mixers', 350000),
(3, 3, '6 persons, 8 beers, 4 waters, 3 mixers', 550000),
(4, 4, '7 persons, 1 Limited Edition, 1 Fruit, 5 waters, 5 mixers', 650000),
(5, 4, '7 persons, 10 beers, 5 waters, 5 mixers', 650000),
(6, 5, '10 persons, 1 Signature Shisha, 1 Gold Label, 6 waters, 6 mixers', 1000000),
(7, 5, '10 persons, 1 French Fried, 12 beers, 6 waters, 6 mixers', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `package_items`
--

CREATE TABLE `package_items` (
  `package_item_id` int NOT NULL,
  `package_id` int NOT NULL,
  `menu_item_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_items`
--

INSERT INTO `package_items` (`package_item_id`, `package_id`, `menu_item_id`, `quantity`) VALUES
(1, 1, 1, 4),
(2, 1, 2, 4),
(3, 1, 3, 2),
(4, 1, 4, 2),
(5, 2, 1, 5),
(6, 2, 2, 10),
(7, 2, 3, 3),
(8, 2, 4, 3),
(9, 3, 1, 6),
(10, 3, 2, 8),
(11, 3, 3, 4),
(12, 3, 4, 3),
(13, 4, 1, 7),
(14, 4, 5, 1),
(15, 4, 6, 1),
(16, 4, 3, 5),
(17, 4, 4, 5),
(18, 5, 1, 7),
(19, 5, 2, 10),
(20, 5, 3, 5),
(21, 5, 4, 5),
(22, 6, 1, 10),
(23, 6, 7, 1),
(24, 6, 8, 1),
(25, 6, 3, 6),
(26, 6, 4, 6),
(27, 7, 1, 10),
(28, 7, 9, 1),
(29, 7, 2, 12),
(30, 7, 3, 6),
(31, 7, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int NOT NULL,
  `user_id` int NOT NULL,
  `table_id` int NOT NULL,
  `package_id` int NOT NULL,
  `reservation_date` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sitting` enum('No','Yes') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `user_id`, `table_id`, `package_id`, `reservation_date`, `created_date`, `sitting`) VALUES
(1, 5, 5, 1, '2024-12-15 00:00:00', '2024-12-13 16:23:11', 'No'),
(2, 5, 30, 2, '2024-12-16 00:00:00', '2024-12-13 16:26:57', 'No'),
(3, 5, 23, 2, '2024-12-17 00:00:00', '2024-12-13 18:05:09', 'No'),
(4, 5, 22, 2, '2024-12-18 00:00:00', '2024-12-13 18:08:44', 'No'),
(5, 5, 3, 1, '2024-12-19 00:00:00', '2024-12-14 07:29:08', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int NOT NULL,
  `table_type_id` int NOT NULL,
  `table_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('ON','OFF') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'ON'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_type_id`, `table_name`, `status`) VALUES
(1, 1, 'ST-1', 'ON'),
(2, 1, 'ST-2', 'ON'),
(3, 1, 'ST-3', 'ON'),
(4, 1, 'ST-4', 'ON'),
(5, 1, 'ST-5', 'ON'),
(6, 1, 'ST-6', 'ON'),
(7, 1, 'ST-7', 'ON'),
(8, 1, 'ST-8', 'OFF'),
(9, 1, 'ST-9', 'OFF'),
(10, 1, 'ST-10', 'OFF'),
(11, 1, 'ST-11', 'OFF'),
(12, 1, 'ST-12', 'OFF'),
(13, 1, 'ST-13', 'OFF'),
(14, 1, 'ST-14', 'OFF'),
(15, 1, 'ST-15', 'OFF'),
(16, 2, 'R-1', 'ON'),
(17, 2, 'R-2', 'ON'),
(18, 2, 'R-3', 'ON'),
(19, 2, 'R-4', 'ON'),
(20, 2, 'R-5', 'ON'),
(21, 2, 'R-6', 'ON'),
(22, 2, 'R-7', 'ON'),
(23, 2, 'R-8', 'ON'),
(24, 2, 'R-9', 'ON'),
(25, 2, 'R-10', 'ON'),
(26, 2, 'R-11', 'ON'),
(27, 2, 'R-12', 'ON'),
(28, 2, 'R-13', 'ON'),
(29, 2, 'R-14', 'ON'),
(30, 2, 'R-15', 'ON'),
(31, 2, 'R-16', 'ON'),
(32, 2, 'R-17', 'OFF'),
(33, 2, 'R-18', 'OFF'),
(34, 2, 'R-19', 'OFF'),
(35, 2, 'R-20', 'OFF'),
(36, 3, 'BRONZE-1', 'ON'),
(37, 3, 'BRONZE-2', 'ON'),
(38, 3, 'BRONZE-3', 'ON'),
(39, 3, 'BRONZE-4', 'ON'),
(40, 3, 'BRONZE-5', 'ON'),
(41, 3, 'BRONZE-6', 'ON'),
(42, 3, 'BRONZE-7', 'ON'),
(43, 3, 'BRONZE-8', 'ON'),
(44, 3, 'BRONZE-9', 'ON'),
(45, 3, 'BRONZE-10', 'ON'),
(46, 3, 'BRONZE-11', 'ON'),
(47, 3, 'BRONZE-12', 'OFF'),
(48, 3, 'BRONZE-13', 'OFF'),
(49, 3, 'BRONZE-14', 'OFF'),
(50, 3, 'BRONZE-15', 'OFF'),
(51, 3, 'BRONZE-16', 'OFF'),
(52, 3, 'BRONZE-17', 'OFF'),
(53, 3, 'BRONZE-18', 'OFF'),
(54, 3, 'BRONZE-19', 'OFF'),
(55, 3, 'BRONZE-20', 'OFF'),
(56, 4, 'SILVER-1', 'ON'),
(57, 4, 'SILVER-2', 'ON'),
(58, 4, 'SILVER-3', 'ON'),
(59, 4, 'SILVER-4', 'ON'),
(60, 4, 'SILVER-5', 'ON'),
(61, 4, 'SILVER-6', 'ON'),
(62, 4, 'SILVER-7', 'ON'),
(63, 4, 'SILVER-8', 'ON'),
(64, 4, 'SILVER-9', 'ON'),
(65, 4, 'SILVER-10', 'ON'),
(66, 4, 'SILVER-11', 'ON'),
(67, 4, 'SILVER-12', 'ON'),
(68, 4, 'SILVER-13', 'ON'),
(69, 4, 'SILVER-14', 'ON'),
(70, 4, 'SILVER-15', 'ON'),
(71, 4, 'SILVER-16', 'ON'),
(72, 4, 'SILVER-17', 'OFF'),
(73, 4, 'SILVER-18', 'OFF'),
(74, 4, 'SILVER-19', 'OFF'),
(75, 4, 'SILVER-20', 'OFF'),
(76, 5, 'DIAMOND-1', 'ON'),
(77, 5, 'DIAMOND-2', 'ON'),
(78, 5, 'DIAMOND-3', 'ON'),
(79, 5, 'DIAMOND-4', 'ON'),
(80, 5, 'DIAMOND-5', 'ON'),
(81, 5, 'DIAMOND-6', 'ON'),
(82, 5, 'DIAMOND-7', 'ON'),
(83, 5, 'DIAMOND-8', 'ON'),
(84, 5, 'DIAMOND-9', 'ON'),
(85, 5, 'DIAMOND-10', 'ON'),
(86, 5, 'DIAMOND-11', 'ON'),
(87, 5, 'DIAMOND-12', 'OFF'),
(88, 5, 'DIAMOND-13', 'OFF'),
(89, 5, 'DIAMOND-14', 'OFF'),
(90, 5, 'DIAMOND-15', 'OFF'),
(91, 5, 'DIAMOND-16', 'OFF'),
(92, 5, 'DIAMOND-17', 'OFF'),
(93, 5, 'DIAMOND-18', 'OFF'),
(94, 5, 'DIAMOND-19', 'OFF'),
(95, 5, 'DIAMOND-20', 'OFF');

-- --------------------------------------------------------

--
-- Table structure for table `table_types`
--

CREATE TABLE `table_types` (
  `table_type_id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `total_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_types`
--

INSERT INTO `table_types` (`table_type_id`, `name`, `total_count`) VALUES
(1, 'Standing Table', 7),
(2, 'Regular Sofa', 16),
(3, 'Bronze Sofa', 12),
(4, 'Silver Sofa', 20),
(5, 'Diamond Sofa', 14);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reservation_id` int DEFAULT NULL,
  `transaction_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int NOT NULL,
  `transaction_type` enum('Reservation','Payment','Add Fund') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `reservation_id`, `transaction_date`, `amount`, `transaction_type`) VALUES
(1, 5, 1, '2024-12-13 22:53:11', 200000, 'Reservation'),
(2, 5, 2, '2024-12-13 22:56:57', 350000, 'Reservation'),
(3, 5, 3, '2024-12-14 00:35:09', 350000, 'Reservation'),
(4, 5, 4, '2024-12-14 00:38:44', 350000, 'Reservation'),
(5, 5, 5, '2024-12-14 13:59:08', 200000, 'Reservation'),
(6, 5, NULL, '2024-12-14 14:02:24', 500, 'Payment'),
(7, 5, NULL, '2024-12-14 14:13:55', 100, 'Payment'),
(8, 5, NULL, '2024-12-14 14:57:56', 400, 'Payment'),
(9, 5, NULL, '2024-12-14 15:03:47', 300, 'Payment'),
(10, 5, NULL, '2024-12-14 15:10:20', 500, 'Payment'),
(11, 5, NULL, '2024-12-14 15:11:00', 300, 'Payment'),
(12, 5, NULL, '2024-12-14 15:15:43', 50000, 'Payment'),
(13, 5, NULL, '2024-12-14 21:14:08', 600, 'Payment'),
(14, 5, NULL, '2024-12-14 23:08:07', 300, 'Payment'),
(15, 5, NULL, '2024-12-15 23:21:07', 500, 'Payment'),
(16, 5, NULL, '2024-12-16 02:00:34', 53500, 'Add Fund');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sex` enum('Male','Female') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Male',
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wallet_balance` int NOT NULL DEFAULT '0',
  `card_number` char(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `member_type` enum('Regular','VIP') COLLATE utf8mb4_general_ci DEFAULT 'Regular',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `sex`, `phone`, `password_hash`, `wallet_balance`, `card_number`, `member_type`, `created_date`) VALUES
(1, 'Theikdi', 'Male', '09263230441', '$2y$10$vWF.RdX3Ie16CbshoIfrWOPZxuBZIKYeFtYFQncUOYgN2C7k0qrhO', 0, '3653241212004922', 'Regular', '2024-12-12 00:49:22'),
(5, 'Theikdi Maung', 'Male', '09263230440', '$2y$10$vWF.RdX3Ie16CbshoIfrWOPZxuBZIKYeFtYFQncUOYgN2C7k0qrhO', 300000, '3653241212004921', 'Regular', '2024-12-12 00:49:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arena_events`
--
ALTER TABLE `arena_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_event_date` (`event_date`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`menu_item_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `table_type_id` (`table_type_id`);

--
-- Indexes for table `package_items`
--
ALTER TABLE `package_items`
  ADD PRIMARY KEY (`package_item_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `menu_item_id` (`menu_item_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD UNIQUE KEY `table_id` (`table_id`,`reservation_date`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`),
  ADD UNIQUE KEY `table_name` (`table_name`),
  ADD KEY `table_type_id` (`table_type_id`);

--
-- Indexes for table `table_types`
--
ALTER TABLE `table_types`
  ADD PRIMARY KEY (`table_type_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `card_number` (`card_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arena_events`
--
ALTER TABLE `arena_events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `menu_item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `package_items`
--
ALTER TABLE `package_items`
  MODIFY `package_item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `table_types`
--
ALTER TABLE `table_types`
  MODIFY `table_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`table_type_id`) REFERENCES `table_types` (`table_type_id`);

--
-- Constraints for table `package_items`
--
ALTER TABLE `package_items`
  ADD CONSTRAINT `package_items_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`),
  ADD CONSTRAINT `package_items_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`menu_item_id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`table_id`) REFERENCES `tables` (`table_id`),
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`);

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `tables_ibfk_1` FOREIGN KEY (`table_type_id`) REFERENCES `table_types` (`table_type_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
