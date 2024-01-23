-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2024 at 07:39 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarywebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `acceptedbooks`
--

CREATE TABLE `acceptedbooks` (
  `acceptId` int(11) NOT NULL,
  `requestId` int(11) NOT NULL,
  `borrowDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acceptedbooks`
--

INSERT INTO `acceptedbooks` (`acceptId`, `requestId`, `borrowDate`, `returnDate`, `userId`) VALUES
(11, 18, '2023-12-29', '2024-01-28', 3),
(14, 19, '2024-01-07', '2024-02-06', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acceptedbooks`
--
ALTER TABLE `acceptedbooks`
  ADD PRIMARY KEY (`acceptId`),
  ADD KEY `requestId_fk` (`requestId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acceptedbooks`
--
ALTER TABLE `acceptedbooks`
  MODIFY `acceptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acceptedbooks`
--
ALTER TABLE `acceptedbooks`
  ADD CONSTRAINT `requestId_fk` FOREIGN KEY (`requestId`) REFERENCES `bookrequests` (`requestId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
