-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2024 at 05:27 PM
-- Server version: 10.1.48-MariaDB-0+deb9u2
-- PHP Version: 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_equasmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslogs`
--

CREATE TABLE `accesslogs` (
  `AccessLogID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `DeviceID` int(11) DEFAULT NULL,
  `Timestamp` datetime NOT NULL,
  `Action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `account_request`
--

CREATE TABLE `account_request` (
  `request_id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` int(11) NOT NULL,
  `request_time` datetime NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `DeviceID` int(11) NOT NULL,
  `DeviceName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DeviceType` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devicestatus`
--

CREATE TABLE `devicestatus` (
  `DeviceStatusID` int(11) NOT NULL,
  `DeviceID` int(11) DEFAULT NULL,
  `Status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastUpdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feeding_schedule`
--

CREATE TABLE `feeding_schedule` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `day_of_week` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feeding_schedule`
--

INSERT INTO `feeding_schedule` (`id`, `time`, `day_of_week`, `created_at`, `updated_at`) VALUES
(155, '12:32:00', 'Sunday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(156, '12:32:00', 'Monday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(157, '12:32:00', 'Tuesday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(158, '12:32:00', 'Wednesday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(159, '12:32:00', 'Thursday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(160, '12:34:00', 'Sunday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(161, '12:34:00', 'Monday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(162, '12:34:00', 'Tuesday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(163, '12:34:00', 'Wednesday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(164, '12:34:00', 'Thursday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(165, '23:33:33', 'Sunday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(166, '23:33:33', 'Monday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(167, '23:33:33', 'Tuesday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(168, '23:33:33', 'Wednesday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(169, '23:33:33', 'Thursday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(170, '10:00:00', 'Sunday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(171, '10:00:00', 'Monday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(172, '10:00:00', 'Tuesday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(173, '10:00:00', 'Wednesday', '2024-06-02 04:56:28', '2024-06-02 04:56:28'),
(174, '10:00:00', 'Thursday', '2024-06-02 04:56:28', '2024-06-02 04:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `feed_history`
--

CREATE TABLE `feed_history` (
  `id` int(11) NOT NULL,
  `feed_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feed_history`
--

INSERT INTO `feed_history` (`id`, `feed_time`, `amount`, `created_at`) VALUES
(1, '2024-05-24 08:18:42', 30, '2024-05-24 08:18:42'),
(2, '2024-05-24 08:19:41', 30, '2024-05-24 08:19:41'),
(3, '2024-05-24 08:20:04', 50, '2024-05-24 08:20:04'),
(4, '2024-05-24 08:35:44', 50, '2024-05-24 08:35:44'),
(5, '2024-05-24 08:41:12', 50, '2024-05-24 08:41:12'),
(6, '2024-05-24 11:45:00', 50, '2024-05-24 11:45:00'),
(7, '2024-05-24 11:45:54', 50, '2024-05-24 11:45:54'),
(8, '2024-05-24 12:02:28', 50, '2024-05-24 12:02:28'),
(9, '2024-08-28 14:51:04', 55, '2024-08-28 14:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `feed_settings`
--

CREATE TABLE `feed_settings` (
  `id` int(11) NOT NULL,
  `amount_per_feeding` float NOT NULL,
  `feeding_session_frequency` int(11) DEFAULT NULL,
  `adjust_amount_by` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feed_settings`
--

INSERT INTO `feed_settings` (`id`, `amount_per_feeding`, `feeding_session_frequency`, `adjust_amount_by`, `created_at`, `updated_at`) VALUES
(1, 55, 4, 40, '2024-05-23 16:46:25', '2024-06-02 04:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `log_entries`
--

CREATE TABLE `log_entries` (
  `id` int(11) NOT NULL,
  `log_date` date NOT NULL,
  `log_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` int(11) NOT NULL,
  `notification_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `auto_send` tinyint(1) NOT NULL DEFAULT '0',
  `notification_interval` enum('15 Minutes','30 Minutes','1 Hour','6 Hours','12 Hours','24 Hours') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recyclebin_account_request`
--

CREATE TABLE `recyclebin_account_request` (
  `request_id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` int(11) NOT NULL,
  `request_time` datetime NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdevices`
--

CREATE TABLE `userdevices` (
  `UserDeviceID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `DeviceID` int(11) DEFAULT NULL,
  `AccessLevel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PasswordHash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EmailAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `PasswordHash`, `EmailAddress`, `ContactNumber`, `position`, `firstname`, `lastname`) VALUES
(1, 'Jay', '$2y$10$3flyGtxedHNQZWBmDcKc4ujjgQKZ5mqAqk8YNO6xB3NobWyOERVJm', 'mp', '123', 'admin', '', ''),
(4, 'jay1', '$2y$10$8eZEfOKXUbgCK48R9Z24xe0cmNzsVnz3ewMEKVHF6EpIV6PxFh/5m', 'mp.phone.email@gmail.com', '123', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `Username` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Status_Time` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `water_test_data`
--

CREATE TABLE `water_test_data` (
  `id` int(11) NOT NULL,
  `test_date` date NOT NULL,
  `test_time` time NOT NULL,
  `ammonia` decimal(5,2) NOT NULL,
  `nitrate` decimal(5,2) NOT NULL,
  `nitrite` decimal(5,2) NOT NULL,
  `temperature` decimal(5,2) NOT NULL,
  `ph` decimal(4,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslogs`
--
ALTER TABLE `accesslogs`
  ADD PRIMARY KEY (`AccessLogID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `DeviceID` (`DeviceID`);

--
-- Indexes for table `account_request`
--
ALTER TABLE `account_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `devicestatus`
--
ALTER TABLE `devicestatus`
  ADD PRIMARY KEY (`DeviceStatusID`),
  ADD KEY `DeviceID` (`DeviceID`);

--
-- Indexes for table `feeding_schedule`
--
ALTER TABLE `feeding_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_history`
--
ALTER TABLE `feed_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_settings`
--
ALTER TABLE `feed_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_entries`
--
ALTER TABLE `log_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recyclebin_account_request`
--
ALTER TABLE `recyclebin_account_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `userdevices`
--
ALTER TABLE `userdevices`
  ADD PRIMARY KEY (`UserDeviceID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `DeviceID` (`DeviceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `water_test_data`
--
ALTER TABLE `water_test_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslogs`
--
ALTER TABLE `accesslogs`
  MODIFY `AccessLogID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `account_request`
--
ALTER TABLE `account_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `devicestatus`
--
ALTER TABLE `devicestatus`
  MODIFY `DeviceStatusID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feeding_schedule`
--
ALTER TABLE `feeding_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT for table `feed_history`
--
ALTER TABLE `feed_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `feed_settings`
--
ALTER TABLE `feed_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `log_entries`
--
ALTER TABLE `log_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recyclebin_account_request`
--
ALTER TABLE `recyclebin_account_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userdevices`
--
ALTER TABLE `userdevices`
  MODIFY `UserDeviceID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `water_test_data`
--
ALTER TABLE `water_test_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
