-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2024 at 03:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infinity_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `bike_name` varchar(20) DEFAULT NULL,
  `bike_number` varchar(20) NOT NULL,
  `address` varchar(20) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_name`, `bike_name`, `bike_number`, `address`, `time`, `status`, `user_id`, `service_id`, `remarks`) VALUES
(12, 'Bibek Chaudhary', 'fz2', 'pa-3-002-5656', 'bafal', '29-09', 0, 3, 3, 'hheh'),
(13, 'Bibek', 'Bibek', 'Bibek ko no', 'Bibek ko address', '2024-09-05T10:35', 0, 2, 3, NULL),
(16, 'Bibek2', '23f', '34-sj', 'Kalimati', '2023-10-07T09:00', 1, 2, 4, 'help'),
(17, 'Bibek Chaudhary', '', 'pa-03-23', 'Bafal', '2023-10-09T13:00', 1, 3, 4, 'Help'),
(18, 'Naresh Tharu', 'Fz-s', 'pa-23-006', 'Balkhu', '2023-10-09T09:00', 1, 22, 7, 'Break Shoe'),
(19, 'Dharmendra', 'Fz-s', 'sa-02-500', 'balkumari', '2023-10-09T12:06', 1, 0, 4, 'Service');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(30) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `Status`) VALUES
(7, 'Yamaha', 1),
(8, 'Bajaj', 1),
(9, 'Hero', 1),
(10, 'Honda', 1),
(11, 'Tvs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `payment` varchar(20) DEFAULT NULL,
  `ostatus` enum('pending','accepted','delivered') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `fname`, `mobile`, `address`, `email`, `user_id`, `product_id`, `payment`, `ostatus`) VALUES
(3, 'bibek', '98776', 'phidim-4', 'sunrise@gmail.com', 5, 7, 'hgfh', 'delivered'),
(4, 'Rupesh', '98767', 'Kalimati', 'rupesh@gmail.com', 5, 10, 'something', 'pending'),
(5, 'Sujit', '98766', 'kathmandu', 'sujit@gmail.com', 17, 7, 'dsjafhsa', 'delivered'),
(6, 'Michael', '9876', 'bafal', 'michael@gmail.com', 2, 6, 'ufhewfhwe', 'accepted'),
(8, 'Binod', '9843233212', 'Koteshwor', 'binod@gmail.com', 23, 6, '', 'pending'),
(9, 'Naresh Tharu', '9812324312', 'Balkhu', 'naresh@gmail.com', 22, 8, '', 'pending'),
(12, 'Gita', '9876543212', 'Kalanki', 'gita@gmail.com', 22, 5, '', 'pending'),
(13, 'Luman', '9812345678', 'Bafal', 'dharmendraram7852@gm', 24, 17, '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `quantity`, `price`, `category_id`, `description`, `status`) VALUES
(5, 'Dispad for Scooter', 'uploads/1696782924.7057dispad1.jpg', 5, 400, 7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, dolores.', 1),
(6, 'Brakeshoe(FZ)', 'uploads/1696783040.6686brakeshoe.jpg', 15, 1000, 7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, dolores.', 1),
(7, 'Mobil', 'uploads/1696783070.5277mobil.jpeg', 40, 800, 7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, dolores.', 1),
(8, 'Mobil Filter', 'uploads/1696783088.4469mobilfilter.jpeg', 35, 400, 7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, dolores.', 1),
(9, 'Air Filter', 'uploads/1696783114.4526airfilter.jpeg', 30, 250, 7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, dolores.', 1),
(10, 'Plug', 'uploads/1696783135.7505plug.jpeg', 20, 500, 7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, dolores.', 1),
(11, 'Helmet', 'uploads/1696783156.7409helments.png', 10, 2500, 8, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, dolores.', 1),
(12, 'Battery', 'uploads/1696783179.5119battery.jpg', 8, 3000, 8, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, dolores.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `price`, `image`, `description`) VALUES
(3, 'Accessories', 500, 'uploads/shopping.svg', 'lorem'),
(4, 'Servicing', 400, 'uploads/servicing.svg', 'lorem..'),
(6, 'Emergency Contact', 0, 'uploads/emergency.svg', 'Call at anytime!'),
(7, 'Maintenance', 5000, 'uploads/1696786417.2201.jpeg', 'maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(35) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `type` enum('admin','service_provider','user') DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `address`, `username`, `password`, `type`, `status`) VALUES
(2, 'Bibek', '1234', 'bibek@gmail.com', 'Bafal', 'bibek', '12', 'user', 1),
(3, 'rupesh', '1234', 'rupesh@gmail.com', 'bafl', 'rupesh@12', '123456', 'admin', 1),
(5, 'Jenisha', '12345', 'jenisha@gmail.com', 'Bafal', 'jen@12', '12', 'user', 1),
(17, 'Dharmendra', '9877', 'dharmu@gmail.com', 'Kalimati', 'dharmu@123', '123456', 'user', 1),
(18, 'Sujit', '9877', 'sujit@gmail.com', 'kalanki', 'suju@12', '123456', 'user', 1),
(22, 'Naresh', '9819745073', 'ram@gmail.com', 'Balkumari', 'naresh@12', '123456', 'user', 1),
(23, 'Binod', '9843233212', 'binod@gmail.com', 'Koteshwor', 'binod@32', '098765', 'user', 1),
(24, 'Luman', '9880227545', 'luman@gmail.com', 'Ramkot', 'luman@12', 'Luman@12', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
