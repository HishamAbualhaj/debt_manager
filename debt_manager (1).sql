-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Sep 12, 2023 at 01:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `debt_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `mainUserId` int(200) NOT NULL,
  `id` int(11) NOT NULL,
  `transc_id` int(200) NOT NULL,
  `transfer_type` varchar(200) NOT NULL,
  `amount_transfer` int(11) NOT NULL,
  `new_amount` int(11) NOT NULL,
  `date` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`mainUserId`, `id`, `transc_id`, `transfer_type`, `amount_transfer`, `new_amount`, `date`, `description`, `created_at`) VALUES
(342074875, 7, 204751, 'إضافة', 816, 273, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 243574, 'إضافة', 943, 927, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 300237, 'إضافة', 495, 990, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 328187, 'إضافة', 686, 210, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 362889, 'إضافة', 752, 233, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 394527, 'إضافة', 469, 954, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 407102, 'إضافة', 781, 386, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 414134, 'إضافة', 431, 293, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 455221, 'إضافة', 402, 872, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 535156, 'إضافة', 506, 888, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 586222, 'إضافة', 701, 570, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 589480, 'إضافة', 205, 910, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 734956, 'إضافة', 535, 210, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 755308, 'إضافة', 638, 455, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 851484, 'إضافة', 119, 383, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 896158, 'إضافة', 375, 614, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 906863, 'إضافة', 718, 971, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 920869, 'إضافة', 166, 270, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 978167, 'إضافة', 311, 526, '2023-04-26', '', '0000-00-00 00:00:00'),
(342074875, 7, 1682546523, 'إضافة', 36, -2964, '2023-04-26', '', '2023-04-26 21:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `mainusers`
--

CREATE TABLE `mainusers` (
  `mainUserId` int(200) NOT NULL,
  `personal_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mainusers`
--

INSERT INTO `mainusers` (`mainUserId`, `personal_name`, `username`, `password`, `notes`) VALUES
(342074875, 'هشام', 'hisham', 'hisham2001', 'new user'),
(622781605, 'ali', 'ali', 'alix20394', 'new user'),
(842522819, 'mohammed', 'm7md', 'moh99#$23', 'new user'),
(1364738371, 'wassem', 'wassem', 'wase$$1234', 'old user'),
(1116533532, 'khaled', 'khaled', 'kha2003$E', 'deleted One');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `mainUserId` int(200) NOT NULL,
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `amount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`mainUserId`, `id`, `name`, `type`, `date`, `amount`) VALUES
(342074875, 7, 'hisham', 'دائن', '2023-04-07', -2964);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`transc_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
