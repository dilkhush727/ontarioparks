-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 06:33 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ontarioparks`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `park` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `item` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `payment_token` varchar(100) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `price_range` varchar(50) DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`id`, `name`, `items`, `price_range`, `details`, `status`) VALUES
(1, 'Starter', '[\r\n    {\"title\": \"Tent\", \"price\": 10},\r\n    {\"title\": \"Sleeping Bag\", \"price\": 8},\r\n    {\"title\": \"Portable Stove\", \"price\": 5},\r\n    {\"title\": \"Water Cooler\", \"price\": 3},\r\n    {\"title\": \"Reusable Dishware\", \"price\": 2},\r\n    {\"title\": \"Flashlight\", \"price\": 2},\r\n    {\"title\": \"Multipurpose Tools\", \"price\": 1},\r\n    {\"title\": \"Toiletry Kit\", \"price\": 1},\r\n    {\"title\": \"First Aid Kit\", \"price\": 1}\r\n]', '$150-300', 'All the camping basics in one bundle — tent, sleeping gear, stove, and more. Perfect for first-timers or light packers.', 1),
(2, 'Intermediate', '[\r\n    {\"title\": \"Tent\", \"price\": 15},\r\n    {\"title\": \"Sleeping Bag\", \"price\": 12},\r\n    {\"title\": \"Portable Stove\", \"price\": 8},\r\n    {\"title\": \"Water Cooler\", \"price\": 5},\r\n    {\"title\": \"Reusable Dishware\", \"price\": 4},\r\n    {\"title\": \"Flashlight\", \"price\": 3},\r\n    {\"title\": \"Multipurpose Tools\", \"price\": 2},\r\n    {\"title\": \"Toiletry Kit\", \"price\": 2},\r\n    {\"title\": \"First Aid Kit\", \"price\": 2}\r\n]', '$250-500', 'Upgraded essentials for campers who know the ropes — better comfort, durability, and extra tools for longer stays.', 1),
(3, 'Advance', '[\r\n    {\"title\": \"Tent\", \"price\": 20},\r\n    {\"title\": \"Sleeping Bag\", \"price\": 18},\r\n    {\"title\": \"Portable Stove\", \"price\": 12},\r\n    {\"title\": \"Water Cooler\", \"price\": 7},\r\n    {\"title\": \"Reusable Dishware\", \"price\": 5},\r\n    {\"title\": \"Flashlight\", \"price\": 4},\r\n    {\"title\": \"Multipurpose Tools\", \"price\": 3},\r\n    {\"title\": \"Toiletry Kit\", \"price\": 3},\r\n    {\"title\": \"First Aid Kit\", \"price\": 3}\r\n]', '$400-700', 'Pro-level gear for serious explorers—built for tough terrain, extreme weather, and total self-reliance.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=First Time Camper\r\n1=Experienced Camper',
  `onboarding` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `f_name`, `l_name`, `email`, `password`, `verified_at`, `phone`, `image`, `status`, `onboarding`, `created_at`) VALUES
(1, 'Dilkhush', NULL, 'dilkhushyadav@gmail.com', '$2a$08$DgAEfrd4k0XsMIRyR9r1HehvGkoTfkvN7ut2EvVjzwyPMp3WrNT6K', '2025-04-07 12:52:22', NULL, NULL, 1, 1, '2025-04-07 12:45:15'),
(2, 'Raina', 'Motihar', 'rainamotihar@gmail.com', '$2a$08$DgAEfrd4k0XsMIRyR9r1HehvGkoTfkvN7ut2EvVjzwyPMp3WrNT6K', '2025-04-07 12:52:22', NULL, NULL, 1, 1, '2025-04-07 12:45:15'),
(3, 'Adil', NULL, 'adilsurve@gmail.com', '$2a$08$DgAEfrd4k0XsMIRyR9r1HehvGkoTfkvN7ut2EvVjzwyPMp3WrNT6K', '2025-04-07 12:52:22', NULL, NULL, 1, 1, '2025-04-07 12:45:15'),
(4, 'Lulia', NULL, 'lulia@gmail.com', '$2a$08$DgAEfrd4k0XsMIRyR9r1HehvGkoTfkvN7ut2EvVjzwyPMp3WrNT6K', '2025-04-07 12:52:22', NULL, NULL, 0, 1, '2025-04-07 12:45:15'),
(5, 'Ruhma', NULL, 'ruhma@gmail.com', '$2a$08$DgAEfrd4k0XsMIRyR9r1HehvGkoTfkvN7ut2EvVjzwyPMp3WrNT6K', '2025-04-07 12:52:22', NULL, NULL, 0, 1, '2025-04-07 12:45:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
