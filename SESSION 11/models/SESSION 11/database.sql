-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2026 at 05:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarymidterm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `publication_year` int(11) DEFAULT NULL,
  `available_copies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `isbn`, `title`, `author`, `publisher`, `publication_year`, `available_copies`) VALUES
(1, '9780001', 'Clean Code', 'Robert Martin', 'Prentice Hall', 2008, 5),
(2, '9780002', 'Design Patterns', 'GoF', 'Addison Wesley', 1994, 3),
(3, '9780003', 'PHP Basics', 'John Doe', 'TechBooks', 2020, 10),
(4, '9780004', 'Database Systems', 'Elmasri', 'Pearson', 2015, 4),
(5, '9780005', 'Web Development', 'Jane Smith', 'OReilly', 2021, 6),
(6, '9780006', 'Java Programming', 'James Gosling', 'Oracle Press', 2018, 7),
(7, '9780007', 'Python Crash Course', 'Eric Matthes', 'No Starch', 2019, 8),
(8, '9780008', 'AI Basics', 'Andrew Ng', 'Coursera', 2022, 2),
(9, '9780009', 'Machine Learning', 'Tom Mitchell', 'McGraw Hill', 1997, 3),
(10, '9780010', 'Data Science 101', 'Data Team', 'DataPub', 2023, 9);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_transactions`
--

CREATE TABLE `borrow_transactions` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('Borrowed','Returned','Overdue') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `borrow_transactions`
--
ALTER TABLE `borrow_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `borrow_transactions`
--
ALTER TABLE `borrow_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_transactions`
--
ALTER TABLE `borrow_transactions`
  ADD CONSTRAINT `borrow_transactions_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
