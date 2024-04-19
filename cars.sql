-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 02:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `image`) VALUES
(1, 'Honda Accord', 25000.00, 'imgs/honda_accord.jpeg'),
(2, 'Honda Civic', 22000.00, 'imgs/honda_civic.jpg'),
(3, 'Honda CR-V', 28000.00, 'imgs/honda_cr_v.jpeg'),
(4, 'Honda HR-V', 24000.00, 'imgs/honda_hr_v.jpeg'),
(5, 'Honda Fit', 20000.00, 'imgs/honda_fit.jpeg'),
(6, 'Honda Odyssey', 35000.00, 'imgs/honda_odyssey.jpeg'),
(7, 'Honda Pilot', 38000.00, 'imgs/honda_pilot.jpeg'),
(8, 'Honda Ridgeline', 32000.00, 'imgs/honda_ridgeline.jpeg'),
(9, 'Honda Insight', 27000.00, 'imgs/honda_insight.jpeg'),
(10, 'Honda Passport', 33000.00, 'imgs/honda_passport.jpeg'),
(11, 'Honda CR-Z', 26000.00, 'imgs/honda_cr_z.jpeg'),
(12, 'Honda Clarity', 30000.00, 'imgs/honda_clarity.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`) VALUES
(1, '123', '123', '$2y$10$nhGZNO2Vg.m0zSOL66jFIeEpUx.FLIrVdEPMRuAeAoUz8E8lpqSvy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
