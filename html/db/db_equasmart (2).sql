-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2024 at 07:49 PM
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
  `contact_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_datetime` datetime NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cron_status`
--

CREATE TABLE `cron_status` (
  `cron_id` int(11) NOT NULL,
  `job_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cron_status`
--

INSERT INTO `cron_status` (`cron_id`, `job_name`, `is_enabled`) VALUES
(1, 'feeder', 0);

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
  `feed_duration` int(11) NOT NULL,
  `day_of_week` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feeding_schedule`
--

INSERT INTO `feeding_schedule` (`id`, `time`, `feed_duration`, `day_of_week`, `created_at`, `updated_at`) VALUES
(440, '13:31:01', 0, 'Sunday', '2024-11-11 05:30:17', '2024-11-11 05:30:17'),
(441, '13:31:01', 0, 'Monday', '2024-11-11 05:30:17', '2024-11-11 05:30:17'),
(442, '13:31:01', 0, 'Tuesday', '2024-11-11 05:30:17', '2024-11-11 05:30:17'),
(443, '13:31:01', 0, 'Wednesday', '2024-11-11 05:30:17', '2024-11-11 05:30:17'),
(444, '13:31:01', 0, 'Thursday', '2024-11-11 05:30:17', '2024-11-11 05:30:17'),
(445, '13:31:01', 0, 'Friday', '2024-11-11 05:30:17', '2024-11-11 05:30:17'),
(446, '13:31:01', 0, 'Saturday', '2024-11-11 05:30:17', '2024-11-11 05:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `feedmotor_calibration`
--

CREATE TABLE `feedmotor_calibration` (
  `id` int(11) NOT NULL,
  `grams_per_second` decimal(10,2) NOT NULL,
  `calibration_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedmotor_calibration`
--

INSERT INTO `feedmotor_calibration` (`id`, `grams_per_second`, `calibration_time`) VALUES
(1, '15.00', '2024-09-22 18:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `feed_history`
--

CREATE TABLE `feed_history` (
  `id` int(11) NOT NULL,
  `feed_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `motor_runtime` float NOT NULL,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(40, '2024-10-29 04:42:22', 10, 150, '2024-10-29 04:42:22'),
(41, '2024-10-29 21:59:22', 10, 150, '2024-10-29 21:59:22'),
(42, '2024-10-30 03:59:22', 10, 150, '2024-10-30 03:59:22'),
(43, '2024-10-30 04:42:22', 10, 150, '2024-10-30 04:42:22'),
(44, '2024-10-30 21:59:22', 10, 150, '2024-10-30 21:59:22'),
(45, '2024-10-31 03:59:23', 10, 150, '2024-10-31 03:59:23'),
(46, '2024-10-31 04:42:22', 10, 150, '2024-10-31 04:42:22'),
(47, '2024-10-31 21:59:22', 10, 150, '2024-10-31 21:59:22'),
(48, '2024-11-01 03:59:22', 10, 150, '2024-11-01 03:59:22'),
(49, '2024-11-01 04:42:24', 10, 150, '2024-11-01 04:42:24'),
(50, '2024-11-01 21:59:22', 10, 150, '2024-11-01 21:59:22'),
(51, '2024-11-02 03:59:22', 10, 150, '2024-11-02 03:59:22'),
(52, '2024-11-02 04:42:22', 10, 150, '2024-11-02 04:42:22'),
(53, '2024-11-02 21:59:22', 10, 150, '2024-11-02 21:59:22'),
(54, '2024-11-03 03:59:22', 10, 150, '2024-11-03 03:59:22'),
(55, '2024-11-03 04:42:22', 10, 150, '2024-11-03 04:42:22'),
(56, '2024-11-03 21:59:22', 10, 150, '2024-11-03 21:59:22'),
(57, '2024-11-04 03:59:22', 10, 150, '2024-11-04 03:59:22'),
(58, '2024-11-04 04:42:23', 10, 150, '2024-11-04 04:42:23'),
(59, '2024-11-04 21:59:23', 10, 150, '2024-11-04 21:59:23'),
(60, '2024-11-05 03:59:22', 10, 150, '2024-11-05 03:59:22'),
(61, '2024-11-05 04:42:22', 10, 150, '2024-11-05 04:42:22'),
(62, '2024-11-05 21:59:23', 10, 150, '2024-11-05 21:59:23'),
(63, '2024-11-06 03:59:23', 10, 150, '2024-11-06 03:59:23'),
(64, '2024-11-06 04:42:22', 10, 150, '2024-11-06 04:42:22'),
(65, '2024-11-06 21:59:22', 10, 150, '2024-11-06 21:59:22'),
(66, '2024-11-07 03:59:23', 10, 150, '2024-11-07 03:59:23'),
(67, '2024-11-07 04:42:22', 10, 150, '2024-11-07 04:42:22'),
(68, '2024-11-07 21:59:22', 10, 150, '2024-11-07 21:59:22'),
(69, '2024-11-08 03:59:22', 10, 150, '2024-11-08 03:59:22'),
(70, '2024-11-08 04:42:22', 10, 150, '2024-11-08 04:42:22'),
(71, '2024-11-08 21:59:22', 10, 150, '2024-11-08 21:59:22'),
(72, '2024-11-09 03:59:22', 10, 150, '2024-11-09 03:59:22'),
(73, '2024-11-09 04:42:22', 10, 150, '2024-11-09 04:42:22'),
(74, '2024-11-09 21:59:23', 10, 150, '2024-11-09 21:59:23'),
(75, '2024-11-10 03:59:22', 10, 150, '2024-11-10 03:59:22'),
(76, '2024-11-10 04:42:23', 10, 150, '2024-11-10 04:42:23'),
(77, '2024-11-10 21:59:22', 10, 150, '2024-11-10 21:59:22'),
(78, '2024-11-11 03:59:21', 10, 150, '2024-11-11 03:59:21'),
(79, '2024-11-11 05:31:11', 10, 150, '2024-11-11 05:31:11'),
(80, '2024-11-12 05:31:22', 10, 150, '2024-11-12 05:31:22');

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
(1, 150, 3, 100, '2024-05-23 16:46:25', '2024-11-11 06:40:48');

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
-- Table structure for table `motor_calibration`
--

CREATE TABLE `motor_calibration` (
  `id` int(11) NOT NULL,
  `motor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `run_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `motor_times`
--

CREATE TABLE `motor_times` (
  `id` int(11) NOT NULL,
  `motor_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `run_time_ms` int(11) NOT NULL,
  `test_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `motor_times`
--

INSERT INTO `motor_times` (`id`, `motor_name`, `run_time_ms`, `test_type`, `created_at`, `updated_at`) VALUES
(1, 'ammonia1', 1200, 'ammonia', '2024-11-12 08:54:20', '2024-11-12 08:54:20'),
(2, 'ammonia2', 123, '', '2024-11-12 11:06:04', '2024-11-12 11:17:13'),
(4, 'nitrate1', 0, '', '2024-11-12 11:06:37', '2024-11-12 11:06:37'),
(5, 'nitrate2', 0, '', '2024-11-12 11:06:45', '2024-11-12 11:06:45'),
(6, 'ph', 0, '', '2024-11-12 11:06:52', '2024-11-12 11:06:52'),
(7, 'control_water', 0, '', '2024-11-12 11:06:58', '2024-11-12 11:06:58'),
(8, 'pond_water', 0, '', '2024-11-12 11:07:07', '2024-11-12 11:07:07');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
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
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_datetime` datetime NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recyclebin_account_request`
--

INSERT INTO `recyclebin_account_request` (`request_id`, `firstname`, `lastname`, `email`, `contact_number`, `request_datetime`, `username`, `user_password`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '1234567890', '2024-11-07 10:00:00', 'johndoe', 'password123'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '0987654321', '2024-11-07 11:00:00', 'janesmith', 'password456'),
(3, 'Alice', 'Johnson', 'alice.johnson@example.com', '1122334455', '2024-11-07 12:00:00', 'alicej', 'pass789'),
(4, 'Bob', 'Brown', 'bob.brown@example.com', '2233445566', '2024-11-07 13:00:00', 'bobb', 'mypassword'),
(5, 'Charlie', 'Davis', 'charlie.davis@example.com', '3344556677', '2024-11-07 14:00:00', 'charlied', 'secure123'),
(6, 'Emily', 'Miller', 'emily.miller@example.com', '4455667788', '2024-11-07 15:00:00', 'emilym', 'mypassword1'),
(7, 'Frank', 'Wilson', 'frank.wilson@example.com', '5566778899', '2024-11-07 16:00:00', 'frankw', 'mypassword2'),
(8, 'Grace', 'Taylor', 'grace.taylor@example.com', '6677889900', '2024-11-07 17:00:00', 'gracet', 'mypassword3'),
(9, 'Henry', 'Anderson', 'henry.anderson@example.com', '7788990011', '2024-11-07 18:00:00', 'henrya', 'mypassword4'),
(10, 'Ivy', 'Thomas', 'ivy.thomas@example.com', '8899001122', '2024-11-07 19:00:00', 'ivyt', 'mypassword5');

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
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `account_creation` datetime NOT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `PasswordHash`, `EmailAddress`, `ContactNumber`, `position`, `firstname`, `lastname`, `is_active`, `account_creation`, `reset_token`) VALUES
(1, 'admin', '$2y$10$3flyGtxedHNQZWBmDcKc4ujjgQKZ5mqAqk8YNO6xB3NobWyOERVJm', 'mp.student.email@gmail.com', '09171924809', 'admin', '', '', 1, '0000-00-00 00:00:00', NULL),
(13, 'test', '$2y$10$3flyGtxedHNQZWBmDcKc4ujjgQKZ5mqAqk8YNO6xB3NobWyOERVJm', 'test', '', '', '', '', 1, '2024-11-02 15:18:09', NULL),
(14, 'tech', '$2y$10$3flyGtxedHNQZWBmDcKc4ujjgQKZ5mqAqk8YNO6xB3NobWyOERVJm', 'tech', '', '', '', '', 1, '2024-11-02 15:18:09', NULL);

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
(46, 13, 1),
(47, 14, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `water_test_input`
--

CREATE TABLE `water_test_input` (
  `Test_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Value` float NOT NULL,
  `Date_and_Time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `water_test_input`
--

INSERT INTO `water_test_input` (`Test_ID`, `Name`, `Value`, `Date_and_Time`) VALUES
(15, 'Ammonia', 10, '2024-11-06 21:52:48'),
(16, 'Nitrate', 10, '2024-11-06 21:52:48'),
(17, 'pH', 1, '2024-11-06 21:52:48'),
(18, 'Ammonia', 20, '2024-11-06 21:52:48'),
(19, 'Ammonia', 40, '2024-11-06 21:53:06'),
(20, 'Ammonia', 12, '2024-11-12 19:35:38'),
(21, 'Nitrate', 31, '2024-11-12 19:39:30');

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
-- Indexes for table `motor_times`
--
ALTER TABLE `motor_times`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `motor_name` (`motor_name`);

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
  ADD KEY `user_permissions_ibfk_1` (`user_id`),
  ADD KEY `user_permissions_ibfk_2` (`permission_id`);

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
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;
--
-- AUTO_INCREMENT for table `feedmotor_calibration`
--
ALTER TABLE `feedmotor_calibration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `feed_history`
--
ALTER TABLE `feed_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
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
-- AUTO_INCREMENT for table `motor_times`
--
ALTER TABLE `motor_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `userdevices`
--
ALTER TABLE `userdevices`
  MODIFY `UserDeviceID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `user_permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `water_test_data`
--
ALTER TABLE `water_test_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `water_test_input`
--
ALTER TABLE `water_test_input`
  MODIFY `Test_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `user_permissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
