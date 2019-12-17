-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2019 at 06:08 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `BookName` varchar(255) DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `Author` varchar(255) DEFAULT NULL,
  `ISBNNumber` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`b_id`, `BookName`, `Category`, `Author`, `ISBNNumber`, `RegDate`, `UpdationDate`) VALUES
(1, 'Java', 'JAVA', 'radhika', 7030, '2019-12-12 23:06:36', NULL),
(2, 'Head First Java', 'JAVA', 'Kathy seirra', 8468, '2019-12-14 06:00:26', NULL),
(3, 'Murach\'s php', 'PHP', 'Joel Murach', 9977, '2019-12-14 06:01:03', NULL),
(4, 'Murach mysql', 'MYSQL', 'Joel Murach', 5498, '2019-12-14 06:01:30', NULL),
(5, 'Learn sql using PHP', 'SQL and PHP', 'Bruce Herbert', 5393, '2019-12-14 06:02:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issuedbookdetails`
--

DROP TABLE IF EXISTS `issuedbookdetails`;
CREATE TABLE IF NOT EXISTS `issuedbookdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ISBNNumber` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ReturnStatus` enum('Yes','No') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issuedbookdetails`
--

INSERT INTO `issuedbookdetails` (`id`, `ISBNNumber`, `number`, `IssuesDate`, `ReturnDate`, `ReturnStatus`) VALUES
(1, 7030, 200427053, '2019-12-12 23:05:04', NULL, NULL),
(2, 5498, 200430083, '2019-12-12 23:09:55', NULL, NULL),
(3, 9977, 200425909, '2019-12-12 23:10:19', NULL, NULL),
(4, 5393, 200430083, '2019-12-14 06:04:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `number` int(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` enum('admin','general') NOT NULL DEFAULT 'general',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(2, 'admin', 1234, 'admin@gmail.com', 'admin', '$2y$10$O2KQWaDj53FBBVQ9dobLPeocdbTCCXrH/CM1j4w0/jwEpPh0067n.', '2019-12-11 06:12:25', '2019-12-11 06:12:50'),
(7, 'Harnish', 200430083, 'harnishdharwa5@gmail.com', 'general', '$2y$10$qWsIGf.vkY1yloqVIpiIJ.KzoBVn7TSG1BuTJfcHCLIO909dENoOK', '2019-12-14 06:06:58', '2019-12-14 06:06:58'),
(8, 'Prince', 200425909, 'princedobariya00@gmail.com', 'general', '$2y$10$skTWMkjN3NVhqEM8DmfHV.c0kJWIms3VZiwJ3..db6vwjf1dIXJ4a', '2019-12-14 06:07:28', '2019-12-14 06:07:28'),
(9, 'Simran', 200430441, 'simrankaur2628@gmail.com', 'general', '$2y$10$4FA6UYeOHQPmMKIBCkfORuU3kdZS2vUellsdc1b/vORPVixBCn32y', '2019-12-14 06:07:55', '2019-12-14 06:07:55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
