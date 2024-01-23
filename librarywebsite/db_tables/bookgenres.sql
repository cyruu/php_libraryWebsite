-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2024 at 07:40 AM
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
-- Table structure for table `bookgenres`
--

CREATE TABLE `bookgenres` (
  `isbn` int(11) NOT NULL,
  `genreId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookgenres`
--

INSERT INTO `bookgenres` (`isbn`, `genreId`) VALUES
(128, 1),
(129, 1),
(130, 2),
(131, 10),
(132, 9),
(133, 3),
(134, 1),
(136, 5),
(138, 3),
(144, 8),
(146, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD PRIMARY KEY (`isbn`,`genreId`),
  ADD KEY `bookgenreid_fk` (`genreId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD CONSTRAINT `bookgenreid_fk` FOREIGN KEY (`genreId`) REFERENCES `genres` (`genreId`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookgenreisbn_fk` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
