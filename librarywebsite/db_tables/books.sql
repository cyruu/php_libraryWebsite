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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `isbn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
