-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2021 at 03:55 PM
-- Server version: 5.7.34
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darwinde_reference-job`
--

-- --------------------------------------------------------

--
-- Table structure for table `xx_packages`
--

CREATE TABLE `xx_packages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `detail` varchar(255) NOT NULL,
  `no_of_posts` int(11) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `package_for` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `xx_packages`
--

INSERT INTO `xx_packages` (`id`, `title`, `slug`, `price`, `detail`, `no_of_posts`, `no_of_days`, `package_for`, `is_active`, `sort_order`, `created_date`, `updated_date`) VALUES
(7, 'Basic', '', 50, 'xyz', 5, 30, 1, 1, 2, '2019-05-24 09:05:33', '2019-05-26 10:05:49'),
(6, 'Silver', '', 150, 'Some text here', 5, 45, 1, 1, 3, '2019-05-24 10:05:42', '2019-05-26 10:05:00'),
(5, 'Free', '', 0, 'Some text here', 5, 30, 1, 1, 4, '2019-05-24 10:05:25', '2019-05-26 10:05:12'),
(8, 'Unlimited CV Search', 'ucvs', 200, 'csvss', 100, 90, 1, 0, 1, '2019-10-25 23:39:56', '2020-06-18 02:06:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xx_packages`
--
ALTER TABLE `xx_packages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `xx_packages`
--
ALTER TABLE `xx_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
