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
-- Table structure for table `bookauthors`
--

CREATE TABLE `bookauthors` (
  `isbn` int(5) NOT NULL,
  `authorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookauthors`
--

INSERT INTO `bookauthors` (`isbn`, `authorId`) VALUES
(128, 16),
(129, 16),
(130, 17),
(131, 18),
(132, 19),
(133, 20),
(134, 21),
(136, 23),
(138, 16),
(144, 31),
(146, 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookauthors`
--
ALTER TABLE `bookauthors`
  ADD PRIMARY KEY (`isbn`,`authorId`),
  ADD KEY `bookauthorid_fk` (`authorId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookauthors`
--
ALTER TABLE `bookauthors`
  ADD CONSTRAINT `bookauthorid_fk` FOREIGN KEY (`authorId`) REFERENCES `authors` (`authorId`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookauthorisbn_fk` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
