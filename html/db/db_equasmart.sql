-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 02:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
  `Action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `account_request`
--

CREATE TABLE `account_request` (
  `request_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `request_datetime` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cron_status`
--

CREATE TABLE `cron_status` (
  `cron_id` int(11) NOT NULL,
  `job_name` varchar(50) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cron_status`
--

INSERT INTO `cron_status` (`cron_id`, `job_name`, `is_enabled`) VALUES
(1, 'feeder', 1);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `DeviceID` int(11) NOT NULL,
  `DeviceName` varchar(255) NOT NULL,
  `UID` varchar(255) NOT NULL,
  `DeviceType` varchar(50) NOT NULL,
  `Location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devicestatus`
--

CREATE TABLE `devicestatus` (
  `DeviceStatusID` int(11) NOT NULL,
  `DeviceID` int(11) DEFAULT NULL,
  `Status` varchar(50) NOT NULL,
  `LastUpdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feeding_schedule`
--

CREATE TABLE `feeding_schedule` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `feed_duration` int(11) NOT NULL,
  `day_of_week` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feeding_schedule`
--

INSERT INTO `feeding_schedule` (`id`, `time`, `feed_duration`, `day_of_week`, `created_at`, `updated_at`) VALUES
(398, '06:00:00', 0, 'Sunday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(399, '06:00:00', 0, 'Monday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(400, '06:00:00', 0, 'Tuesday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(401, '06:00:00', 0, 'Wednesday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(402, '06:00:00', 0, 'Thursday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(403, '06:00:00', 0, 'Friday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(404, '06:00:00', 0, 'Saturday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(405, '12:00:00', 0, 'Sunday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(406, '12:00:00', 0, 'Monday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(407, '12:00:00', 0, 'Tuesday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(408, '12:00:00', 0, 'Wednesday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(409, '12:00:00', 0, 'Thursday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(410, '12:00:00', 0, 'Friday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(411, '12:00:00', 0, 'Saturday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(412, '12:43:00', 0, 'Sunday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(413, '12:43:00', 0, 'Monday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(414, '12:43:00', 0, 'Tuesday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(415, '12:43:00', 0, 'Wednesday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(416, '12:43:00', 0, 'Thursday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(417, '12:43:00', 0, 'Friday', '2024-10-28 04:42:32', '2024-10-28 04:42:32'),
(418, '12:43:00', 0, 'Saturday', '2024-10-28 04:42:32', '2024-10-28 04:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `feedmotor_calibration`
--

CREATE TABLE `feedmotor_calibration` (
  `id` int(11) NOT NULL,
  `grams_per_second` decimal(10,2) NOT NULL,
  `calibration_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedmotor_calibration`
--

INSERT INTO `feedmotor_calibration` (`id`, `grams_per_second`, `calibration_time`) VALUES
(1, 15.00, '2024-09-22 18:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `feed_history`
--

CREATE TABLE `feed_history` (
  `id` int(11) NOT NULL,
  `feed_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `motor_runtime` float NOT NULL,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feed_history`
--

INSERT INTO `feed_history` (`id`, `feed_time`, `motor_runtime`, `amount`, `created_at`) VALUES
(1, '2024-05-24 08:18:42', 0, 30, '2024-05-24 08:18:42'),
(2, '2024-05-24 08:19:41', 0, 30, '2024-05-24 08:19:41'),
(3, '2024-05-24 08:20:04', 0, 50, '2024-05-24 08:20:04'),
(4, '2024-05-24 08:35:44', 0, 50, '2024-05-24 08:35:44'),
(5, '2024-05-24 08:41:12', 0, 50, '2024-05-24 08:41:12'),
(6, '2024-05-24 11:45:00', 0, 50, '2024-05-24 11:45:00'),
(7, '2024-05-24 11:45:54', 0, 50, '2024-05-24 11:45:54'),
(8, '2024-05-24 12:02:28', 0, 50, '2024-05-24 12:02:28'),
(9, '2024-08-28 14:51:04', 0, 55, '2024-08-28 14:51:04'),
(10, '2024-09-03 04:18:08', 0, 55, '2024-09-03 04:18:08'),
(11, '2024-09-06 08:05:36', 0, 55, '2024-09-06 08:05:36'),
(12, '2024-09-14 08:25:21', 0, 55, '2024-09-14 08:25:21'),
(13, '0000-00-00 00:00:00', 4, 60, '2024-09-22 22:09:06'),
(14, '2024-09-22 22:13:07', 4, 60, '2024-09-22 22:13:07'),
(15, '2024-09-22 22:14:07', 5, 78, '2024-09-22 22:14:07'),
(16, '2024-09-23 11:12:06', 5, 78, '2024-09-23 11:12:06'),
(17, '2024-09-23 11:15:07', 5, 78, '2024-09-23 11:15:07'),
(18, '2024-09-23 11:16:06', 5, 78, '2024-09-23 11:16:06'),
(19, '2024-09-24 04:41:07', 5, 78, '2024-09-24 04:41:07'),
(20, '2024-09-24 04:46:07', 5, 78, '2024-09-24 04:46:07'),
(21, '2024-09-25 00:58:06', 5, 78, '2024-09-25 00:58:06'),
(22, '2024-09-25 00:58:15', 5, 78, '2024-09-25 00:58:15'),
(23, '2024-10-02 10:10:05', 3, 50, '2024-10-02 10:10:05'),
(24, '2024-10-02 10:10:10', 3, 50, '2024-10-02 10:10:10'),
(25, '2024-10-02 10:10:14', 3, 50, '2024-10-02 10:10:14'),
(26, '2024-10-02 10:10:18', 3, 50, '2024-10-02 10:10:18'),
(27, '2024-10-02 10:10:23', 3, 50, '2024-10-02 10:10:23'),
(28, '2024-10-02 10:11:04', 3, 50, '2024-10-02 10:11:04'),
(29, '2024-10-02 10:11:09', 3, 50, '2024-10-02 10:11:09'),
(30, '2024-10-02 10:11:13', 3, 50, '2024-10-02 10:11:13'),
(31, '2024-10-02 10:11:18', 3, 50, '2024-10-02 10:11:18'),
(32, '2024-10-02 10:11:22', 3, 50, '2024-10-02 10:11:22'),
(33, '2024-10-02 10:13:04', 3, 50, '2024-10-02 10:13:04'),
(34, '2024-10-02 10:13:08', 3, 50, '2024-10-02 10:13:08'),
(35, '2024-10-27 07:59:12', 10, 150, '2024-10-27 07:59:12'),
(36, '2024-10-27 21:59:11', 10, 150, '2024-10-27 21:59:11'),
(37, '2024-10-28 03:59:23', 10, 150, '2024-10-28 03:59:23'),
(38, '2024-10-28 21:59:22', 10, 150, '2024-10-28 21:59:22'),
(39, '2024-10-29 03:59:22', 10, 150, '2024-10-29 03:59:22'),
(40, '2024-10-29 04:42:22', 10, 150, '2024-10-29 04:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `feed_settings`
--

CREATE TABLE `feed_settings` (
  `id` int(11) NOT NULL,
  `amount_per_feeding` float NOT NULL,
  `feeding_session_frequency` int(11) DEFAULT NULL,
  `adjust_amount_by` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feed_settings`
--

INSERT INTO `feed_settings` (`id`, `amount_per_feeding`, `feeding_session_frequency`, `adjust_amount_by`, `created_at`, `updated_at`) VALUES
(1, 150, 3, 100, '2024-05-23 16:46:25', '2024-10-27 05:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `log_entries`
--

CREATE TABLE `log_entries` (
  `id` int(11) NOT NULL,
  `log_date` date NOT NULL,
  `log_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `motor_calibration`
--

CREATE TABLE `motor_calibration` (
  `id` int(11) NOT NULL,
  `motor` varchar(50) NOT NULL,
  `direction` varchar(10) NOT NULL,
  `run_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` int(11) NOT NULL,
  `notification_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `auto_send` tinyint(1) NOT NULL DEFAULT 0,
  `notification_interval` enum('15 Minutes','30 Minutes','1 Hour','6 Hours','12 Hours','24 Hours') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission_name`) VALUES
(2, 'control_motors'),
(3, 'set_schedules'),
(1, 'view_only');

-- --------------------------------------------------------

--
-- Table structure for table `recyclebin_account_request`
--

CREATE TABLE `recyclebin_account_request` (
  `request_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `request_datetime` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdevices`
--

CREATE TABLE `userdevices` (
  `UserDeviceID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `DeviceID` int(11) DEFAULT NULL,
  `AccessLevel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL,
  `position` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `account_creation` datetime NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `PasswordHash`, `EmailAddress`, `ContactNumber`, `position`, `firstname`, `lastname`, `is_active`, `account_creation`, `reset_token`) VALUES
(1, 'admin', '$2y$10$3flyGtxedHNQZWBmDcKc4ujjgQKZ5mqAqk8YNO6xB3NobWyOERVJm', 'mp.student.email@gmail.com', '09171924809', 'admin', '', '', 1, '0000-00-00 00:00:00', NULL),
(4, 'tech', '$2y$10$rmnoSSWS7Hr8dlk3ecYlg.AHAK72axbv3p6t4kG/u8xY721zwjsG2', 'mp.phone.email@gmail.com', '123', '', '', '', 1, '0000-00-00 00:00:00', '02ff7e7ee15f09074c227cd2c8a0d3c08471a02a40ed12614267a7eb7970bb12'),
(13, 'Kian123', '$2y$10$vp7Tefkc8GWsVb8RKKGNFeDSQ5TGhJxG9Izy6nXSrw4IqSqnR5JlC', 'kianer2nd@gmail.com', '09090909099', '', 'Kian', 'Penas', 1, '2024-11-05 22:56:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `user_permission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`user_permission_id`, `user_id`, `permission_id`) VALUES
(38, 4, 1),
(39, 4, 2),
(40, 4, 3),
(45, 13, 1);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `water_test_input`
--

CREATE TABLE `water_test_input` (
  `Test_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Value` float NOT NULL,
  `Date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_test_input`
--

INSERT INTO `water_test_input` (`Test_ID`, `Name`, `Value`, `Date`) VALUES
(15, 'Ammonia', 10, '2024-11-06 21:52:48'),
(16, 'Nitrate', 10, '2024-11-06 21:52:48'),
(17, 'pH', 1, '2024-11-06 21:52:48'),
(18, 'Ammonia', 20, '2024-11-06 21:52:48'),
(19, 'Ammonia', 40, '2024-11-06 21:53:06');

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
-- Indexes for table `cron_status`
--
ALTER TABLE `cron_status`
  ADD PRIMARY KEY (`cron_id`);

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
-- Indexes for table `feedmotor_calibration`
--
ALTER TABLE `feedmotor_calibration`
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
-- Indexes for table `motor_calibration`
--
ALTER TABLE `motor_calibration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

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
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`user_permission_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `permission_id` (`permission_id`);

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
-- Indexes for table `water_test_input`
--
ALTER TABLE `water_test_input`
  ADD PRIMARY KEY (`Test_ID`);

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
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cron_status`
--
ALTER TABLE `cron_status`
  MODIFY `cron_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `devicestatus`
--
ALTER TABLE `devicestatus`
  MODIFY `DeviceStatusID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feeding_schedule`
--
ALTER TABLE `feeding_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT for table `feedmotor_calibration`
--
ALTER TABLE `feedmotor_calibration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feed_history`
--
ALTER TABLE `feed_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
-- AUTO_INCREMENT for table `motor_calibration`
--
ALTER TABLE `motor_calibration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recyclebin_account_request`
--
ALTER TABLE `recyclebin_account_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userdevices`
--
ALTER TABLE `userdevices`
  MODIFY `UserDeviceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `user_permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `water_test_data`
--
ALTER TABLE `water_test_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `water_test_input`
--
ALTER TABLE `water_test_input`
  MODIFY `Test_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `user_permissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
