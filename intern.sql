-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 02:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `number`, `email`, `password`, `role`) VALUES
(1, 'Jibrin Saleh', '08034897634', 'info@fmcbkd.gov.ng', '$2y$10$rU4.MGFldvt54H8mZ8UeOOzWeXyH1SKJF1/O0442f7D5S1FPep.u6', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `close`
--

CREATE TABLE `close` (
  `id` int(11) NOT NULL,
  `status` int(22) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `close`
--

INSERT INTO `close` (`id`, `status`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `date_created`) VALUES
(22, 'Nursing Service', '2024-12-08 00:28:21'),
(23, 'Orthopedic', '2024-12-08 00:28:30'),
(24, 'Dental', '2024-12-08 00:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `intern`
--

CREATE TABLE `intern` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `sex` enum('Male','Female','Other') NOT NULL,
  `dob` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `state` varchar(100) NOT NULL,
  `local_gov` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `licence_exp` date DEFAULT NULL,
  `status` enum('PAID','UNPAID') NOT NULL DEFAULT 'UNPAID',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `regno` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL DEFAULT '0',
  `passport` varchar(100) NOT NULL DEFAULT '0',
  `cv` varchar(100) NOT NULL DEFAULT '0',
  `license` varchar(100) NOT NULL DEFAULT '0',
  `bsc` varchar(255) DEFAULT '0',
  `ssce` varchar(255) DEFAULT '0',
  `lga` varchar(255) DEFAULT '0',
  `birth_cert` varchar(255) DEFAULT '0',
  `receipt` varchar(255) NOT NULL DEFAULT '0',
  `admission` enum('ADMITTED','NOT ADMITTED') NOT NULL DEFAULT 'NOT ADMITTED'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intern`
--

INSERT INTO `intern` (`id`, `name`, `sex`, `dob`, `phone`, `email`, `password`, `state`, `local_gov`, `address`, `qualification`, `licence_exp`, `status`, `created_date`, `regno`, `department`, `passport`, `cv`, `license`, `bsc`, `ssce`, `lga`, `birth_cert`, `receipt`, `admission`) VALUES
(12, '0', 'Male', '', '', 'aliyuabubakarjdh@gmail.com', '$2y$10$eAQVqS9q4TWiRUhNDStRNuDBuh2GyUSPPqG97W0L0gy9R4f29Plji', '', '', '', '', NULL, 'PAID', '2024-12-08 00:55:38', 'FMC/BKD/ADM/24/001', '0', '0', '0', '0', '0', '0', '0', '0', 'Capture.PNG', 'NOT ADMITTED');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('successful','failed','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `close`
--
ALTER TABLE `close`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intern`
--
ALTER TABLE `intern`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `close`
--
ALTER TABLE `close`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `intern`
--
ALTER TABLE `intern`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
