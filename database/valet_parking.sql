-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2018 at 02:06 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `valet_parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `image`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1538136974.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created`, `updated`) VALUES
(8, 'Hotel', '1537531474.jpg', '2018-09-21 12:04:34', '2018-09-21 12:04:34'),
(9, 'Mall Shops', '1537531625.jpg', '2018-09-21 12:04:45', '2018-09-21 12:07:05'),
(10, 'Restaurant', '1537531613.jpg', '2018-09-21 12:06:53', '2018-09-21 12:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(50) NOT NULL,
  `valet_id` int(11) NOT NULL,
  `ticketno` bigint(20) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 for pending,1 for available ',
  `read_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 for unread 1 for read',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `valet_id`, `ticketno`, `phone`, `first_name`, `brand`, `color`, `year`, `model`, `created`, `status`, `read_status`, `updated`) VALUES
(2, 1, 707344075, 8872852005, 'baljinder', 'maruti', 'white', NULL, NULL, '2018-10-01 06:32:04', 4, 0, '2018-10-01 06:48:53'),
(5, 1, 316674523, 8872312892, 'shubham', 'hundai', 'white', '2018', '2008', '2018-10-01 12:14:12', 4, 1, '2018-10-01 12:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `valets`
--

CREATE TABLE `valets` (
  `id` bigint(50) NOT NULL,
  `category` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `valets`
--

INSERT INTO `valets` (`id`, `category`, `name`, `email`, `phone`, `password`, `address`, `image`, `created`, `updated`) VALUES
(1, 'Hotel', 'gurii', 'gurii@gmail.com', 8872852005, '21232f297a57a5a743894a0e4a801fc3', 'gurii', '1538137104.png', '2018-09-25 06:35:06', '2018-09-28 12:18:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `valets`
--
ALTER TABLE `valets`
  ADD PRIMARY KEY (`id`,`email`,`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `valets`
--
ALTER TABLE `valets`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
