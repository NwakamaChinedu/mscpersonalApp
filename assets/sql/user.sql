-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2023 at 04:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmm007`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `is_Admin` int(5) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_Admin`, `image`) VALUES
(2, 'Ephraim', 'ephraim@example.com', '$2y$10$eUjWubxljZweghQB6KSaQ.0s6GL07QR05MLx1.f9.0GOIgNZz0XMW', 0, NULL),
(5, 'Anthony', 'anthony@example.com', '$2y$10$ZDjCaCSJhqo5Hw.c/sHuCORNSfmZ2XTAoR/NflY0Qb1FhdLnvbHKu', 0, NULL),
(8, 'Storyteller', 'storyteller@example.com', '$2y$10$L4WuwKQz4GrzS7haw3QsYe2kg90Gx/PYGBGhZYmiFMQJcSU2BKHAO', 0, NULL),
(11, 'Adminuser', 'Adminuser@example.com', '$2y$10$In7J4QTi3NSSi9D42KxE.e3Cj86Ee7FWV/9map38vp86F.33CVGFe', 1, NULL),
(12, 'newadmin', 'new@admin.com', '$2y$10$htU92oENxzBxPGAcM4qrC.56cuubqk1gIC/HNC3gXSYpPWYA4UA6q', 1, NULL);

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
