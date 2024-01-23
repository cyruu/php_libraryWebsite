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
-- Table structure for table `bookrequests`
--

CREATE TABLE `bookrequests` (
  `requestId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bookIsbn` int(11) NOT NULL,
  `requestDate` date NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `descr` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookrequests`
--

INSERT INTO `bookrequests` (`requestId`, `userId`, `bookIsbn`, `requestDate`, `fname`, `lname`, `descr`, `email`, `status`) VALUES
(13, 5, 129, '2023-12-28', 'asur', 'cha', 'for personal use', 'asur@asur', 'returned'),
(14, 5, 146, '2023-12-29', 'aaus', 'praj', 'personal use', 'aaus@mail.com', 'reject'),
(15, 3, 129, '2023-12-29', 'Cyru', 'Mah', 'this is a cool book', 'cyru@cyru', 'returned'),
(16, 3, 132, '2023-12-29', 'Cyru', 'Mah', 'i just want it', 'cyru@cyru', 'returned'),
(17, 3, 138, '2023-12-29', 'Cyru', 'cha', 'i am a fan of this book', 'cyru@cyru', 'reject'),
(18, 3, 133, '2023-12-29', 'Cyru', 'Mhr', 'ill buy it', 'cyru@cyru', 'accept'),
(19, 5, 136, '2023-12-29', 'asur', 'cha', 'i like reading books', 'asur@asur', 'accept'),
(20, 5, 132, '2024-01-07', 'asur', 'Flynn', 'adasdasd', 'asur@asur', 'returned'),
(21, 5, 131, '2024-01-07', 'asd', 'Flynn', 'll', 'asur@asur', 'returned'),
(22, 5, 128, '2024-01-07', 'asd', 'Green', 'sa', 'asur@asur', 'returned'),
(23, 3, 128, '2024-01-09', 'cyru', 'maharjan', 'great fan of this book', 'cyru@cyru', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookrequests`
--
ALTER TABLE `bookrequests`
  ADD PRIMARY KEY (`requestId`),
  ADD KEY `borrowisbn` (`bookIsbn`),
  ADD KEY `borrowuser` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookrequests`
--
ALTER TABLE `bookrequests`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookrequests`
--
ALTER TABLE `bookrequests`
  ADD CONSTRAINT `borrowisbn` FOREIGN KEY (`bookIsbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowuser` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
