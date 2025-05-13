-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 12:47 AM
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
-- Database: `newproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuser`
--

CREATE TABLE `fuser` (
  `farmer_id` int(11) NOT NULL,
  `farmer_name` varchar(50) NOT NULL,
  `farmer_email` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `farmer_password` varchar(50) NOT NULL,
  `status` enum('pending','accepted','denied') DEFAULT 'pending',
  `blocked` tinyint(1) DEFAULT 0,
  `registration_timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fuser`
--

INSERT INTO `fuser` (`farmer_id`, `farmer_name`, `farmer_email`, `phone_number`, `farmer_password`, `status`, `blocked`, `registration_timestamp`) VALUES
(43, 'omar', 'oabdelaziz554@gmail.com', '01066923775', '1234', 'accepted', 0, '2024-12-10 01:56:34'),
(47, 'zoz', 'os211@gmail.com', '01018284053', '12345', 'accepted', 0, '2024-12-10 14:08:35'),
(52, 'ahmed ', 'ahmed@gmail.com', '12341321', '1234', 'accepted', 0, '2025-02-25 00:29:12'),
(53, 'Hassan', 'o23@gmail.com', '123466', '1234', 'pending', 0, '2025-02-25 19:29:21'),
(54, 'y', 'y@g.com', '154656868', '123456', 'accepted', 0, '2025-02-26 01:18:01'),
(55, 'yarab', 'yarab@gmail.com', '69', '1234', 'accepted', 0, '2025-02-26 01:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) DEFAULT 1,
  `message` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(3, 43, 1, 'hi', '2024-12-10 14:56:58'),
(4, 43, 1, 'hi', '2024-12-10 15:30:00'),
(5, 43, 1, 'hi', '2024-12-10 15:31:00'),
(6, 43, 1, 'hi', '2024-12-10 15:31:02'),
(7, 43, 1, 'hi', '2024-12-10 15:31:07'),
(8, 43, 1, 'hi', '2024-12-10 15:31:19'),
(9, 43, 1, 'hi', '2024-12-10 15:31:40'),
(10, 43, 1, 'hi', '2024-12-10 15:32:52'),
(11, 43, 1, 'hi', '2024-12-10 15:34:18'),
(12, 43, 1, 'hi', '2024-12-10 15:34:37'),
(13, 43, 1, 'hi', '2024-12-10 15:34:48'),
(14, 43, 1, 'hello', '2024-12-10 15:45:31'),
(15, 43, 1, 'hello', '2024-12-10 15:54:07'),
(16, 43, 1, 'hii', '2024-12-10 15:54:20'),
(17, 43, 1, 'hii', '2024-12-10 15:55:07'),
(18, 43, 1, '1', '2024-12-10 15:55:10'),
(19, 43, 1, '1', '2024-12-10 15:55:25'),
(20, 43, 1, '1', '2024-12-10 15:55:38'),
(21, 43, 1, '1', '2024-12-10 15:56:09'),
(22, 43, 1, '11', '2024-12-10 15:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('login','registration','blocked') NOT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `details`, `timestamp`, `is_read`) VALUES
(8, 43, 'registration', 'New user registered. Awaiting approval.', '2024-12-10 01:56:34', 0),
(9, 43, 'registration', 'Your registration has been accepted by the admin.', '2024-12-10 01:56:43', 0),
(10, 43, 'registration', 'Your registration has been accepted by the admin.', '2024-12-10 01:58:32', 0),
(11, 43, 'registration', 'Your registration has been accepted by the admin.', '2024-12-10 01:58:35', 0),
(18, 43, 'registration', 'Your registration has been accepted by the admin.', '2024-12-10 02:04:21', 0),
(23, 43, 'registration', 'Your registration has been accepted by the admin.', '2024-12-10 02:10:59', 0),
(25, 43, 'login', 'User logged in successfully.', '2024-12-10 13:53:34', 0),
(26, 43, 'registration', 'Your registration has been accepted by the admin.', '2024-12-10 13:57:41', 0),
(27, 43, 'registration', 'Your registration has been accepted by the admin.', '2024-12-10 13:59:14', 0),
(29, 47, 'registration', 'New user registered. Awaiting approval.', '2024-12-10 14:08:35', 0),
(30, 43, 'login', 'User logged in successfully.', '2024-12-10 14:56:53', 0),
(31, 43, 'login', 'User logged in successfully.', '2024-12-10 15:44:10', 0),
(32, 43, 'login', 'User logged in successfully.', '2024-12-10 16:40:50', 0),
(33, 43, 'login', 'User logged in successfully.', '2024-12-10 18:15:55', 0),
(39, 43, 'login', 'User logged in successfully.', '2024-12-12 00:07:03', 0),
(41, 47, 'registration', 'Your registration has been accepted by the admin.', '2025-02-25 00:11:46', 0),
(42, 47, 'login', 'User logged in successfully.', '2025-02-25 00:11:57', 0),
(43, 52, 'registration', 'New user registered. Awaiting approval.', '2025-02-25 00:29:12', 0),
(44, 52, 'registration', 'Your registration has been accepted by the admin.', '2025-02-25 00:29:33', 0),
(45, 52, 'login', 'User logged in successfully.', '2025-02-25 00:29:55', 0),
(46, 53, 'registration', 'New user registered. Awaiting approval.', '2025-02-25 19:29:21', 0),
(47, 47, 'login', 'User logged in successfully.', '2025-02-25 22:05:23', 0),
(48, 54, 'registration', 'New user registered. Awaiting approval.', '2025-02-26 01:18:01', 0),
(49, 54, 'registration', 'Your registration has been accepted by the admin.', '2025-02-26 01:22:12', 0),
(50, 54, 'login', 'User logged in successfully.', '2025-02-26 01:25:36', 0),
(51, 55, 'registration', 'New user registered. Awaiting approval.', '2025-02-26 01:35:41', 0),
(52, 54, 'registration', 'Your registration has been accepted by the admin.', '2025-02-26 01:35:58', 0),
(53, 55, 'registration', 'Your registration has been accepted by the admin.', '2025-02-26 01:36:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `sensor_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `temperature` float NOT NULL,
  `soil_moisture` float NOT NULL,
  `air_humidity` float NOT NULL,
  `light_intensity` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `water_level` enum('low','high') NOT NULL DEFAULT 'low'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`sensor_id`, `farmer_id`, `temperature`, `soil_moisture`, `air_humidity`, `light_intensity`, `timestamp`, `water_level`) VALUES
(7, 43, 24.5, 40.2, 60.1, 500, '2025-02-24 22:47:28', 'high');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fuser`
--
ALTER TABLE `fuser`
  ADD PRIMARY KEY (`farmer_id`,`farmer_email`) USING BTREE;

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`sensor_id`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fuser`
--
ALTER TABLE `fuser`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `fuser` (`farmer_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fuser` (`farmer_id`) ON DELETE CASCADE;

--
-- Constraints for table `sensors`
--
ALTER TABLE `sensors`
  ADD CONSTRAINT `sensors_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `fuser` (`farmer_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
