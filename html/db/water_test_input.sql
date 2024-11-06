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
-- Indexes for table `water_test_input`
--
ALTER TABLE `water_test_input`
  ADD PRIMARY KEY (`Test_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `water_test_input`
--
ALTER TABLE `water_test_input`
  MODIFY `Test_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
