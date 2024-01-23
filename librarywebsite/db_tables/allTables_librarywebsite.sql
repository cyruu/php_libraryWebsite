-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2024 at 07:36 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `authorId` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`authorId`, `fname`, `lname`) VALUES
(15, 'Scott', 'Fitzgerald'),
(16, 'John', 'Green'),
(17, 'Matt', 'Haig'),
(18, 'Khaled', 'Hosseini'),
(19, 'William', 'Gibson'),
(20, 'Dan', 'Brown'),
(21, 'Leo', 'Tolstoy'),
(23, 'Jane', 'Austen'),
(24, 'Gillian', 'Flynn'),
(31, 'James', 'Clear'),
(32, 'Héctor', 'García '),
(33, 'Cyrus', 'Mhr');

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

-- --------------------------------------------------------

--
-- Table structure for table `bookcounts`
--

CREATE TABLE `bookcounts` (
  `countId` int(11) NOT NULL,
  `readCount` int(11) NOT NULL,
  `borrowCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookcounts`
--

INSERT INTO `bookcounts` (`countId`, `readCount`, `borrowCount`) VALUES
(1, 453, 110);

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

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `isbn` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `isbn`, `userId`) VALUES
(24, 134, 5),
(28, 131, 3),
(29, 129, 3);

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

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `published` int(11) NOT NULL,
  `copies` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `coverurl` varchar(200) NOT NULL,
  `pdfurl` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `published`, `copies`, `description`, `coverurl`, `pdfurl`) VALUES
(128, 'The Great Gatsby', 1925, 1, 'The Great Gatsby is a 1925 novel by American writer F. Scott Fitzgerald. Set in the Jazz Age on Long Island.In the spring of 1922, Nick takes a house in the fictional village of West Egg on Long Island, where he finds himself living among the colossal mansions of the newly rich. Across the water in the more refined village of East Egg live his cousin Daisy and her brutish, absurdly wealthy husband Tom Buchanan.', 'TheGreatGatsby.jpg', 'thegreatgatsby.pdf'),
(129, 'Fault in Our Stars', 2012, 1, 'The Fault in Our Stars is a novel by John Green. It is his fourth solo novel, and sixth novel overall. It was published on January 10, 2012.', 'faultinourstars.jpg', 'faultinourstars.pdf'),
(130, 'The Midnight Library', 2020, 3, 'Between life and death there is a library, and within that library, the shelves go on forever. Every book provides a chance to try another life you could have lived. To see how things would be if you ', 'midnight.jpg', 'The-Midnight-Library.pdf'),
(131, 'Kite Runner', 2003, 2, 'The Kite Runner is the first novel by Afghan-American author Khaled Hosseini.[1] Published in 2003 by Riverhead Books, it tells the story of Amir, a young boy from the Wazir Akbar Khan district of Kab', 'kite.jpeg', 'The-Kite-Runner.pdf'),
(132, 'Neuromancer', 1984, 2, 'Henry Dorsett Case is a low-level hustler in the dystopian underworld of Chiba City, Japan. Once a talented computer hacker and console cowboy, Case was caught stealing from his employer. As punishmen', 'Neuromancer.jpg', 'Neuromancer.pdf'),
(133, 'The Da Vinci Code', 2003, 1, 'Louvre curator and Priory of Sion grand master Jacques Saunière is fatally shot one night at the museum by an albino Catholic monk named Silas, who is working on behalf of someone he knows only as the', 'thedavincicode.jpg', 'TheDaVinciCode.pdf'),
(134, 'War and Peace', 1869, 2, 'The work chronicles the Napoleonic era within Russia, notably detailing the French invasion of Russia and its aftermath. The book highlights the impact of Napoleon on Tsarist society through five inte', 'war.jpg', 'war-and-peace.pdf'),
(136, 'Pride and Prejudice', 1813, 1, 'In the early 19th century, the Bennet family live at their Longbourn estate, situated near the village of Meryton in Hertfordshire, England. Mrs Bennets greatest desire is to marry off her five daught', 'prideandprejudice.jpg', 'Pride_and_Prejudice.pdf'),
(138, 'Gone Girl', 2012, 2, 'Gone Girl is a 2012 crime thriller novel by American writer Gillian Flynn. It was published by Crown Publishing Group in June 2012. The novel was popular and made the New York Times Best Seller list. ', 'gonegirl.jpg', 'gone.pdf'),
(144, 'Atomic Habits', 2018, 0, 'Thoughtful and easy to understand, James Clears Atomic Habits is a must for anyone trying to change their productivity. This simple guide will help create a strong foundation for building good habits ', 'atomic.png', ''),
(146, 'Ikigai', 2017, 1, 'According to the Japanese, everyone has an ikigai—a reason for living. And according to the residents of the Japanese village with the world’s longest-living people, finding it is the key to a happier', 'ikigai.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genreId` int(11) NOT NULL,
  `gname` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genreId`, `gname`) VALUES
(1, 'Novel'),
(2, 'Fantasy'),
(3, 'Thriller'),
(4, 'Horror'),
(5, 'Romance'),
(6, 'Adventure'),
(7, 'Biography'),
(8, 'Psychology'),
(9, 'Science Fiction'),
(10, 'History'),
(11, 'Comedy');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notificationId` int(11) NOT NULL,
  `requestId` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notificationId`, `requestId`, `status`, `userId`) VALUES
(8, 13, 'accept', 5),
(9, 14, 'reject', 5),
(10, 13, 'returned', 5),
(11, 15, 'accept', 3),
(12, 15, 'returned', 3),
(13, 16, 'accept', 3),
(14, 16, 'returned', 3),
(15, 17, 'reject', 3),
(16, 18, 'accept', 3),
(17, 20, 'accept', 5),
(18, 20, 'returned', 5),
(19, 21, 'accept', 5),
(20, 19, 'accept', 5),
(21, 22, 'accept', 5),
(22, 22, 'returned', 5),
(23, 21, 'returned', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'cyru', 'cyru'),
(5, 'asur', 'asur');

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
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`authorId`);

--
-- Indexes for table `bookauthors`
--
ALTER TABLE `bookauthors`
  ADD PRIMARY KEY (`isbn`,`authorId`),
  ADD KEY `bookauthorid_fk` (`authorId`);

--
-- Indexes for table `bookcounts`
--
ALTER TABLE `bookcounts`
  ADD PRIMARY KEY (`countId`);

--
-- Indexes for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD PRIMARY KEY (`isbn`,`genreId`),
  ADD KEY `bookgenreid_fk` (`genreId`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookmarkisbn_fk` (`isbn`),
  ADD KEY `bookmarkuserid` (`userId`);

--
-- Indexes for table `bookrequests`
--
ALTER TABLE `bookrequests`
  ADD PRIMARY KEY (`requestId`),
  ADD KEY `borrowisbn` (`bookIsbn`),
  ADD KEY `borrowuser` (`userId`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genreId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notificationId`),
  ADD KEY `notirequestId_fk` (`requestId`);

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
-- AUTO_INCREMENT for table `acceptedbooks`
--
ALTER TABLE `acceptedbooks`
  MODIFY `acceptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `authorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `bookcounts`
--
ALTER TABLE `bookcounts`
  MODIFY `countId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `bookrequests`
--
ALTER TABLE `bookrequests`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `isbn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acceptedbooks`
--
ALTER TABLE `acceptedbooks`
  ADD CONSTRAINT `requestId_fk` FOREIGN KEY (`requestId`) REFERENCES `bookrequests` (`requestId`);

--
-- Constraints for table `bookauthors`
--
ALTER TABLE `bookauthors`
  ADD CONSTRAINT `bookauthorid_fk` FOREIGN KEY (`authorId`) REFERENCES `authors` (`authorId`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookauthorisbn_fk` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE;

--
-- Constraints for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD CONSTRAINT `bookgenreid_fk` FOREIGN KEY (`genreId`) REFERENCES `genres` (`genreId`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookgenreisbn_fk` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE;

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarkisbn_fk` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarkuserid` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookrequests`
--
ALTER TABLE `bookrequests`
  ADD CONSTRAINT `borrowisbn` FOREIGN KEY (`bookIsbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowuser` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notirequestId_fk` FOREIGN KEY (`requestId`) REFERENCES `bookrequests` (`requestId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
