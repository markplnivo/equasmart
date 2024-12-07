-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2024 at 06:49 PM
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
(77, '06:00:00', 0, 'Sunday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(78, '06:00:00', 0, 'Monday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(79, '06:00:00', 0, 'Tuesday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(80, '06:00:00', 0, 'Wednesday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(81, '06:00:00', 0, 'Thursday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(82, '06:00:00', 0, 'Friday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(83, '06:00:00', 0, 'Saturday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(84, '12:00:00', 0, 'Sunday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(85, '12:00:00', 0, 'Monday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(86, '12:00:00', 0, 'Tuesday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(87, '12:00:00', 0, 'Wednesday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(88, '12:00:00', 0, 'Thursday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(89, '12:00:00', 0, 'Friday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(90, '12:00:00', 0, 'Saturday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(91, '17:00:00', 0, 'Sunday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(92, '17:00:00', 0, 'Monday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(93, '17:00:00', 0, 'Tuesday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(94, '17:00:00', 0, 'Wednesday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(95, '17:00:00', 0, 'Thursday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(96, '17:00:00', 0, 'Friday', '2024-11-19 01:11:15', '2024-11-19 01:11:15'),
(97, '17:00:00', 0, 'Saturday', '2024-11-19 01:11:15', '2024-11-19 01:11:15');

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
(80, '2024-11-12 05:31:22', 10, 150, '2024-11-12 05:31:22'),
(81, '2024-11-13 05:31:22', 10, 150, '2024-11-13 05:31:22'),
(82, '2024-11-14 05:30:23', 10, 150, '2024-11-14 05:30:23'),
(83, '2024-11-14 05:31:22', 10, 150, '2024-11-14 05:31:22'),
(84, '2024-11-17 04:43:12', 10, 150, '2024-11-17 04:43:12'),
(85, '2024-11-17 04:44:11', 10, 150, '2024-11-17 04:44:11'),
(86, '2024-11-17 05:05:12', 10, 150, '2024-11-17 05:05:12'),
(87, '2024-11-17 13:42:25', 10, 150, '2024-11-17 13:42:25'),
(88, '2024-11-17 13:47:18', 10, 150, '2024-11-17 13:47:18'),
(89, '2024-11-17 13:50:25', 10, 150, '2024-11-17 13:50:25'),
(90, '2024-11-17 13:52:20', 10, 150, '2024-11-17 13:52:20'),
(91, '2024-11-17 13:54:18', 10, 150, '2024-11-17 13:54:18'),
(92, '2024-11-17 13:56:19', 10.13, 152, '2024-11-17 13:56:19'),
(93, '2024-11-17 13:58:19', 10.27, 154, '2024-11-17 13:58:19'),
(94, '2024-11-18 10:19:11', 10.4, 156, '2024-11-18 10:19:11'),
(95, '2024-11-18 10:21:12', 10.53, 158, '2024-11-18 10:21:12'),
(96, '2024-11-19 03:59:13', 11.2, 168, '2024-11-19 03:59:13'),
(97, '2024-11-19 08:59:13', 11.33, 170, '2024-11-19 08:59:13'),
(98, '2024-11-19 21:59:12', 10.67, 160, '2024-11-19 21:59:12'),
(99, '2024-11-20 03:59:11', 10.8, 162, '2024-11-20 03:59:11'),
(100, '2024-11-20 08:59:12', 10.93, 164, '2024-11-20 08:59:12');

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
(1, 166, 3, 2, '2024-05-23 16:46:25', '2024-11-20 08:59:12');

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
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `distance` float DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `distance`, `timestamp`) VALUES
(1, 27, '2024-11-14 18:04:56'),
(2, 28, '2024-11-16 10:26:01'),
(3, 14, '2024-11-18 05:56:26'),
(4, 21, '2024-11-19 01:00:12'),
(5, 16, '2024-11-20 01:05:57');

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
(1, 'ammonia1', 250, 'ammonia', '2024-11-12 08:54:20', '2024-11-18 08:51:08'),
(2, 'ammonia2', 250, '', '2024-11-12 11:06:04', '2024-11-18 08:51:09'),
(4, 'nitrate1', 250, '', '2024-11-12 11:06:37', '2024-11-18 08:59:38'),
(5, 'nitrate2', 250, '', '2024-11-12 11:06:45', '2024-11-18 08:59:42'),
(6, 'ph', 100, '', '2024-11-12 11:06:52', '2024-11-18 09:07:29'),
(7, 'control_water', 3500, '', '2024-11-12 11:06:58', '2024-11-18 08:34:39'),
(8, 'pond_water', 5000, '', '2024-11-12 11:07:07', '2024-11-17 05:33:18');

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
(1, 'admin', '$2y$10$3flyGtxedHNQZWBmDcKc4ujjgQKZ5mqAqk8YNO6xB3NobWyOERVJm', 'mp.student.email@gmail.com', '09171924809', 'admin', '', '', 1, '0000-00-00 00:00:00', '0ea12d2328ecc3c25fc733fe7d0e00817d3576acc930fddfee1374559c8effe0'),
(13, 'test', '$2y$10$3flyGtxedHNQZWBmDcKc4ujjgQKZ5mqAqk8YNO6xB3NobWyOERVJm', 'test', '', '', '', '', 1, '2024-11-02 15:18:09', NULL),
(14, 'tech', '$2y$10$3flyGtxedHNQZWBmDcKc4ujjgQKZ5mqAqk8YNO6xB3NobWyOERVJm', 'tech', '', '', '', '', 1, '2024-11-02 15:18:09', NULL),
(15, 'jd24', '$2y$10$8tHZSoIzyD960.vo42OXUec8nwotOJpTaXGOSejtb9M3s02tX2iF2', 'phoenixequasmart@gmail.com', '09948019153', '', 'john', 'doe', 1, '2024-11-16 13:53:32', '02fd9628183da19ed8c7e86e3a80cf52c1785cb3a278ee61a19cc4729f8eb1d2'),
(16, 'jb123', '$2y$10$MElxQ9m23Me6jG5peSAmR.nKa3cBbJBBNIMfqHyd8ZmjYsmu1fnDi', 'jrafon19@gmail.com', '09948019153', '', 'javee', 'rafon', 1, '2024-11-16 13:57:41', '74f0b057c38221e8aef26792c8d02f9f41daabf093a142d8404fa025c2125459'),
(17, 'm13', '$2y$10$rHclDmiKmvRMggB66WsPVuEprk/FoeVy3TO/RctXFL3U9btPjSAJO', 'markfrederickr@gmail.com', '09812324321', '', 'Mark', 'Romualdo', 1, '2024-11-18 18:12:23', NULL);

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
(47, 14, 1),
(48, 15, 1),
(49, 16, 1),
(50, 17, 1);

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
-- Table structure for table `water_testing_history`
--

CREATE TABLE `water_testing_history` (
  `id` int(11) NOT NULL,
  `test_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_date` date NOT NULL,
  `test_time` time NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `water_testing_schedule`
--

CREATE TABLE `water_testing_schedule` (
  `id` int(11) NOT NULL,
  `test_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `days_of_week` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scheduled_time` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `water_testing_schedule`
--

INSERT INTO `water_testing_schedule` (`id`, `test_type`, `days_of_week`, `scheduled_time`, `created_at`) VALUES
(11, 'ammonia', 'Monday', '19:00', '2024-11-17 16:57:04'),
(12, 'nitrate', 'Wednesday,Thursday,Saturday', '', '2024-11-17 16:57:32'),
(13, 'ph', '', '', '2024-11-17 16:57:46');

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
(21, 'Nitrate', 31, '2024-11-12 19:39:30'),
(22, 'Ammonia', 23, '2024-11-13 22:19:27'),
(23, 'Nitrate', 23, '2024-11-13 22:19:27'),
(24, 'pH', 23, '2024-11-13 22:19:27'),
(25, 'Ammonia', 23, '2024-11-13 22:21:04'),
(26, 'Ammonia', 23, '2024-11-16 17:13:44'),
(27, 'Nitrate', 23, '2024-11-16 17:13:44'),
(28, 'pH', 23, '2024-11-16 17:13:44'),
(29, 'Ammonia', 23, '2024-11-16 17:14:36'),
(30, 'Nitrate', 23, '2024-11-16 17:14:36'),
(31, 'pH', 23, '2024-11-16 17:14:36'),
(32, 'Ammonia', 0, '2024-11-16 17:14:40'),
(33, 'Nitrate', 23, '2024-11-16 17:14:40'),
(34, 'pH', 0, '2024-11-16 17:14:40'),
(35, 'Ammonia', 0, '2024-11-16 17:14:49'),
(36, 'Nitrate', 0, '2024-11-16 17:14:49'),
(37, 'pH', 12, '2024-11-16 17:14:49'),
(38, 'Ammonia', 0, '2024-11-16 17:16:34'),
(39, 'Nitrate', 0, '2024-11-16 17:16:34'),
(40, 'pH', 12, '2024-11-16 17:16:34'),
(41, 'Ammonia', 0, '2024-11-16 17:18:58'),
(42, 'Nitrate', 0, '2024-11-16 17:18:58'),
(43, 'pH', 12, '2024-11-16 17:18:58'),
(44, 'Ammonia', 0, '2024-11-16 17:25:45'),
(45, 'Nitrate', 0, '2024-11-16 17:25:45'),
(46, 'pH', 12, '2024-11-16 17:25:45'),
(47, 'Ammonia', 0, '2024-11-16 17:25:48'),
(48, 'Nitrate', 0, '2024-11-16 17:25:48'),
(49, 'pH', 12, '2024-11-16 17:25:48'),
(50, 'Ammonia', 1, '2024-11-17 15:15:46'),
(51, 'Nitrate', 0, '2024-11-17 15:15:46'),
(52, 'pH', 0, '2024-11-17 15:15:46'),
(53, 'Ammonia', 0, '2024-11-17 15:18:02'),
(54, 'Nitrate', 35, '2024-11-17 15:18:02'),
(55, 'pH', 0, '2024-11-17 15:18:02'),
(101, 'Ammonia', 0.25, '2024-11-18 18:32:12'),
(102, 'Nitrate', 20, '2024-11-18 18:32:12'),
(103, 'pH', 7, '2024-11-18 18:32:12');

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
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
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
-- Indexes for table `water_testing_history`
--
ALTER TABLE `water_testing_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `water_testing_schedule`
--
ALTER TABLE `water_testing_schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_type` (`test_type`);

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
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `feedmotor_calibration`
--
ALTER TABLE `feedmotor_calibration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `feed_history`
--
ALTER TABLE `feed_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
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
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `motor_calibration`
--
ALTER TABLE `motor_calibration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `motor_times`
--
ALTER TABLE `motor_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
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
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `user_permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `water_testing_history`
--
ALTER TABLE `water_testing_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `water_testing_schedule`
--
ALTER TABLE `water_testing_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `water_test_data`
--
ALTER TABLE `water_test_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `water_test_input`
--
ALTER TABLE `water_test_input`
  MODIFY `Test_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
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
