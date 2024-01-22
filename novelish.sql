-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 03:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novelish`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` int(11) NOT NULL,
  `bookName` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `book` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `publishedDate` timestamp NULL DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `genreID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `download` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `bookName`, `description`, `book`, `image`, `publishedDate`, `price`, `genreID`, `userID`, `premium`, `download`) VALUES
(11, 'Emma', '<p>The Project Gutenberg EBook of Emma, by Jane Austen<br>This eBook is for the use of anyone anywhere at no cost and with<br>almost no restrictions whatsoever. You may copy it, give it away or<br>re-use it under the terms of the Project Gutenberg License included<br>with this eBook or online at www.gutenberg.org<br>Title: Emma<br>Author: Jane Austen<br>Release Date: January 21, 2010 [EBook #158]<br>Last Updated: March 10, 2018<br>Language: English<br>*** START OF THIS PROJECT GUTENBERG EBOOK EMMA ***<br>Produced by An Anonymous Volunteer, and David Widger</p>', 'Emma.pdf', '416724347_290681120674739_3256802496836540782_n.png', '2024-01-21 07:44:38', 10, 3, 6, 0, 0),
(12, 'Unwritten Letters to You kahsjdf bksajhdfk fhksjadhf skajdfhksadf skadfmjsd dsfkjdsf dsfhksjdf ', '<p style=\"text-align: justify;\">In my 25 years of life, I have experienced a multitude of&nbsp;emotions. These pages are the result of those emotions,&nbsp;from the ones who I&rsquo;ve lost, to the ones I have loved and&nbsp;still seek to love. It has been a journey that has made me the person I am today. It is a terrible thing to feel such deep&nbsp;things and not be able to let it out, whether that is through&nbsp;music, art or words. To be able to communicate what our&nbsp;hearts most desire to speak is what we all long for. I am so&nbsp;grateful that I have been given this ability to make blood&nbsp;into ink and to make pain into stories.</p>', 'Unwritten_Letters_To_You.pdf', '419612853_328168783529497_310883650609084959_n.png', '2024-01-21 09:59:22', 5, 3, 6, 1, 0),
(13, 'THE UNIVERSE OF US', '<p>ATTENTION: SCHOOLS AND BUSINESSES<br>Andrews McMeel books are available at quantity discounts with bulk purchase<br>for educational, business, or sales promotional use. For information, please e-<br>mail the Andrews McMeel Publishing Special Sales Department:<br>specialsales@amuniversal.com</p>', 'The_Universe_of_Us_by_Lang_Leav.pdf', '419897819_1026189505346248_5868467497921535892_n.png', '2024-01-21 10:00:51', 20, 3, 6, 1, 0),
(14, 'The Chaos of Longing', '<p>(i.) i was an insecure<br>cocoa brown<br>hunchback girl<br>who swallowed poems<br>and never thought of<br>heaven or hell<br>when i met him.</p>', 'The_Chaos_of_Longing_-_K_Y_Robinson.pdf', '419901584_3526360554243773_5383554585770442861_n.png', '2024-01-21 10:02:28', 10, 3, 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `checkedOut` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `userID`, `checkedOut`) VALUES
(12, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `itemID` int(11) NOT NULL,
  `cartID` int(11) DEFAULT NULL,
  `bookID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`itemID`, `cartID`, `bookID`) VALUES
(27, 12, 13),
(28, 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(11) NOT NULL,
  `bookID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `bookID`, `userID`, `message`, `created_at`) VALUES
(5, 11, 9, 'abc', '2024-01-22 08:06:27'),
(6, 11, 11, 'nice', '2024-01-22 08:09:01'),
(9, 12, 10, 'nice\r\n', '2024-01-22 12:27:26'),
(10, 13, 10, 'abc\r\n', '2024-01-22 12:28:44'),
(11, 13, 10, 'def', '2024-01-22 12:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genreID` int(11) NOT NULL,
  `genreName` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genreID`, `genreName`) VALUES
(3, 'entertainment'),
(4, 'sceince');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `name`, `email`, `address`, `contact`, `message`) VALUES
(2, 'abc', 'abc@gmail.com', 'tandi', '9852145632', 'abc\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','User','Author') DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `book_allowed` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `name`, `password`, `role`, `is_approved`, `book_allowed`) VALUES
(6, 'techdipesh36@gmail.com', 'dipesh', '$2y$10$mzCnJHiFCTCBf/CQdpRY6eTVljBlmnEV1giwbOZUUQ55roO9v//j.', 'Admin', 0, '[]'),
(9, 'abcd@gmail.com', 'abcd', '$2y$10$KT34mQf8FCAUL4pF3ocFQ.OnuI0qCb2Uu3mu1ucOk7cO0Cb0tL7Vm', 'Author', 1, '[\"12\",\"13\"]'),
(10, 'test@gmail.com', 'test', '$2y$10$KT34mQf8FCAUL4pF3ocFQ.OnuI0qCb2Uu3mu1ucOk7cO0Cb0tL7Vm', 'User', 0, '[\"13\",\"12\"]'),
(11, 'suman@gmail.com', 'sumancdy', '$2y$10$nf1B976QtCzgL9ul.gQRyun.H/Mo9Lv2FDbHz48pQFj7DNl6nVrH6', 'Author', 1, '[\"12\",\"11\"]'),
(12, 'testabc@gmail.com', 'testabc', '$2y$10$sBzOR5gGtVHnFRruNq2euu1Nuz083V9kF3fLB16EJfzSxqE3//Lpa', 'User', 0, '[]'),
(13, 'lkjsdfj@gmail.com', 'jhaskd', '$2y$10$Q3yMqvmCw8vH2O5mychF0elSM3MmkE1Bx7DuC2izzWsjBpecASrWi', 'User', 0, '[]'),
(15, 'lksjlkdf@gmail.com', 'ahdkfj', '$2y$10$nkZZpczN/7taUPiNgR4gt.71iHYoMLK5mAq9VAplz07O7DwDWVdM2', 'User', 0, '[]'),
(19, 'jhgj@gmail.com', 'ahdkfj', '$2y$10$nkZZpczN/7taUPiNgR4gt.71iHYoMLK5mAq9VAplz07O7DwDWVdM2', 'User', 0, '[]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`),
  ADD KEY `books_ibfk_1` (`genreID`),
  ADD KEY `books_ibfk_2` (`userID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `cartID` (`cartID`),
  ADD KEY `bookID` (`bookID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`),
  ADD KEY `bookID` (`bookID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genreID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`genreID`) REFERENCES `genre` (`genreID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `cart` (`cartID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
