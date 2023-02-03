-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2023 at 08:32 AM
-- Server version: 5.7.40-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `benax_iot`
--

-- --------------------------------------------------------

--
-- Table structure for table `mavericks_oti_light`
--

CREATE TABLE `mavericks_oti_light` (
  `id` int(11) NOT NULL,
  `device_name` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mavericks_oti_light`
--

INSERT INTO `mavericks_oti_light` (`id`, `device_name`, `status`) VALUES
(1, 'Mavericks', 'OFF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mavericks_oti_light`
--
ALTER TABLE `mavericks_oti_light`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_name` (`device_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mavericks_oti_light`
--
ALTER TABLE `mavericks_oti_light`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
