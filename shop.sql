-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2023 at 01:45 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(44) NOT NULL,
  `story` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `story`) VALUES
(1, 'Welcome to our website, your destination for cutting-edge tech and digital dreams!\r\n\r\nAt our website, we\'re obsessed with tech. Our mission? To bring you the latest gadgets, gear, and innovations that elevate your digital experience. From smartphones to gaming rigs, we\'ve curated the best tech to in');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `quantity` int(100) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `image`, `quantity`, `user_id`) VALUES
(11, 'ALIENWARE - M16  2023', 1400, 'lap2.jpg', 2, 0),
(12, 'iPhone 13 Pro', 1300, '4.png', 1, 0),
(13, 'headphones Marshall', 250, 'mix5.png', 1, 0),
(14, 'GG-58SUA Discovery', 1000, 'QE98Q900RBU.jpg', 2, 0),
(15, 'Sport x7', 250, 'watch1.png', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_nopad_ci NOT NULL,
  `description` text CHARACTER SET armscii8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(27, 'phone', ''),
(28, 'others', ''),
(29, 'screen', ''),
(30, 'laptop', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(150) NOT NULL,
  `image` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `cat_id`) VALUES
(32, 'ALIENWARE - M16  2023', '16\"  QHD  2K  165HZ \r\ni7 13700HX \r\nRTX 4070 \r\n16 RAM DDR5 \r\n1TB SSD \r\nWINDOWS 11 PRO', 1500, 'laptopPromo.png', 30),
(33, 'ALIENWARE - M16  2023', 'ALIENWARE - M16  2023 \r\n16\"  QHD  2K  165HZ \r\ni7 13700HX \r\nRTX 4070 \r\n16 RAM DDR5 \r\n1TB SSD \r\nWINDOWS 11 PRO', 1400, 'lap2.jpg', 30),
(34, 'ALIENWARE - M16  2023', 'ALIENWARE - M16  2023 \r\n16\"  QHD  2K  165HZ \r\ni7 13700HX \r\nRTX 4070 \r\n16 RAM DDR5 \r\n1TB SSD \r\nWINDOWS 11 PRO', 1200, 'pavilion13.jpeg', 30),
(35, 'ALIENWARE - M16  2023', 'ALIENWARE - M16  2023 \r\n16\"  QHD  2K  165HZ \r\ni7 13700HX \r\nRTX 4070 \r\n16 RAM DDR5 \r\n1TB SSD \r\nWINDOWS 11 PRO', 1000, 'zenbook14.jpg', 30),
(36, 'ALIENWARE - M16  2023', 'ALIENWARE - M16  2023 \r\n16\"  QHD  2K  165HZ \r\ni7 13700HX \r\nRTX 4070 \r\n16 RAM DDR5 \r\n1TB SSD \r\nWINDOWS 11 PRO', 1500, 'creatorP65.jpg', 30),
(37, 'ALIENWARE - M16  2023', 'ALIENWARE - M16  2023 \r\n16\"  QHD  2K  165HZ \r\ni7 13700HX \r\nRTX 4070 \r\n16 RAM DDR5 \r\n1TB SSD \r\nWINDOWS 11 PRO', 1600, 'sony_vaio_5.jpg', 30),
(38, 'iPhone 13 Pro', 'Processor: A15 Bionic\r\nAdvanced camera\r\nConnectivity: 5G\r\niOS', 1300, '4.png', 27),
(39, 'iPhone 13 Pro', 'Processor: A15 Bionic\r\nAdvanced camera\r\nConnectivity: 5G\r\niOS', 1000, 'phone1.png', 27),
(40, 'iPhone 13 Pro', 'Processor: A15 Bionic\r\nAdvanced camera\r\nConnectivity: 5G\r\niOS', 1300, 'Gallery - 4.png', 27),
(41, 'iPhone 13 Pro', 'Processor: A15 Bionic\r\nAdvanced camera\r\nConnectivity: 5G\r\niOS', 1000, 'image.jpeg', 27),
(42, 'iPhone 13 Pro', 'Processor: A15 Bionic\r\nAdvanced camera\r\nConnectivity: 5G\r\niOS', 1000, 'p30.jpg', 27),
(43, 'iPhone 13 Pro', 'Processor: A15 Bionic\r\nAdvanced camera\r\nConnectivity: 5G\r\niOS', 900, 'p40lite.jpg', 27),
(44, 'iPhone 13 Pro', 'Processor: A15 Bionic\r\nAdvanced camera\r\nConnectivity: 5G\r\niOS', 850, '2.png', 27),
(45, 'GG-58SUA Discovery', 'Screen Size 50 Inch LED TV.\r\nResolution Ultra HD TV 3840 X 2160\r\nSmart TV Android 10.0 - Licensed\r\nCPU A 53 4 1.5 Ghz', 700, 'screen2.png', 29),
(46, 'GG-58SUA Discovery', 'Screen Size 50 Inch LED TV.\r\nFrameless.\r\nResolution Ultra HD TV 3840 X 2160\r\nSmart TV Android 10.0 - Licensed\r\nCPU A 53 4 1.5 Ghz', 1000, 'QE98Q900RBU.jpg', 29),
(47, 'GG-58SUA Discovery', 'Screen Size 50 Inch LED TV.\r\nFrameless.\r\nResolution Ultra HD TV 3840 X 2160\r\nSmart TV Android 10.0 - Licensed\r\nCPU A 53 4 1.5 Ghz', 600, 'T24H390SIX.jpg', 29),
(48, 'GG-58SUA Discovery', 'Screen Size 50 Inch LED TV.\r\nFrameless.\r\nResolution Ultra HD TV 3840 X 2160\r\nSmart TV Android 10.0 - Licensed\r\nCPU A 53 4 1.5 Ghz', 900, 'screen1.jpg', 29),
(49, 'Sport x7', 'OLED display\r\nmeasured vertically\r\nefficient S-series chip\r\noffers GPS', 250, 'watch1.png', 28),
(50, 'headphones Marshall', 'Bluetooth version:5.0\r\nBattery:250mAh\r\nFrequency:2.402Ghz-2.480Ghz\r\nMaterial:ABS+PC+Protein Skin', 250, 'mix5.png', 28),
(51, 'Tablet', 'Processor: A15 Bionic\r\nAdvanced camera\r\nConnectivity: 5G\r\niOS', 800, 'matePadPro.jpg', 28);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(150) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `active`, `password`, `role_id`) VALUES
(4, 'lawzah', 'lawzah@GMAIL.com', '888888888', 'Screenshot 2023-08-30 200236.jpg', 1, '123', 1),
(11, 'lawzah', 'lawzeeah@GMAIL.com', '0777777777', '5.png', 1, '111', 2),
(13, 'safaa dheb', 'safaa@gmail.com', '04444444', 'about.jpg', 1, '111', 1),
(14, 'badoor', 'eeeeeee@gmail.com', '444', '1624240500_avatar.png', 0, '11', 1),
(15, 'ddddd', 'dddd@gmail.com', '1111', '٢٠٢١١٢٣١_١٢٢٧٠٩.jpg', 0, '111', NULL),
(22, 'gggg', 'gggg@gmail.com', '111111', '٢٠٢١١٢٣١_١٢٢٨١٩.jpg', 0, '$2y$10$KphOTMXxWjkSOTjy96hhbezaGB45XOknzxknWwi9pu2IXoH26wcvy', NULL),
(24, 'bador', 'nayem@gmail.com', '1111', '-5375312825947372918_120.jpg', 0, '$2y$10$ZNHNUB1WHMOYwygMwrmstew9dbaMgQaRQoDS7KZ3r48EyCfzfhkwy', NULL),
(28, 'lawzah', 'lawww@gmail.com', '1111', '1624240500_avatar.png', 0, '$2y$10$DufJehOEq6NvKgf4VxTEuO38zb54mBYkfxmpaoFysZcYzvGG5.lRe', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(44) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
