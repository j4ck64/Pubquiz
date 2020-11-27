-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 07:34 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pubquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `anwser`
--

CREATE TABLE `anwser` (
  `id` int(11) NOT NULL,
  `anwser` varchar(300) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `dummy_anwser` varchar(300) NOT NULL,
  `dummy_anwser2` varchar(300) NOT NULL,
  `dummy_anwser3` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anwser`
--

INSERT INTO `anwser` (`id`, `anwser`, `question_id`, `dummy_anwser`, `dummy_anwser2`, `dummy_anwser3`) VALUES
(1, '2 test 4', 1, '3', '4', '5'),
(2, '4', 2, '5', '6', '8'),
(3, 'Berlin', 3, 'Moscow ', 'Madrid', 'Lisbon'),
(4, '1796', 4, '1911', '1889', '1945');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `question`, `slug`, `publish_date`) VALUES
(1, '1+1 test4', 'q-1', '2020-11-23 19:57:54'),
(2, '2+2', 'q-2', '2020-11-23 19:57:54'),
(3, 'What is the capital of Germany? ', 'q-4', '2020-11-26 00:44:49'),
(4, 'When was the smallpox vaccine created?', 'q-5', '2020-11-26 00:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `is_admin`) VALUES
(1, 'test', 'test', 0),
(3, 'test', '', 0),
(4, 'bye', '', 0),
(5, 'hiagain', 'byeagain', 0),
(6, 'md5EncrytionTest', '098f6bcd4621d373cade4e832627b4f6', 0),
(7, 'test', '098f6bcd4621d373cade4e832627b4f6', 0),
(8, 'james@hotmail.com', '098f6bcd4621d373cade4e832627b4f6', 0),
(9, 'barry@yahoo.com', '098f6bcd4621d373cade4e832627b4f6', 0),
(10, 'revenge ', 'aafb6955ddd4f789b34253175b4746e4', 0),
(11, 'admin', '098f6bcd4621d373cade4e832627b4f6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_anwser`
--

CREATE TABLE `user_anwser` (
  `id` int(11) NOT NULL,
  `anwser` varchar(300) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_anwser`
--

INSERT INTO `user_anwser` (`id`, `anwser`, `user_id`, `question_id`) VALUES
(75, '5', 7, 2),
(77, '4', 7, 2),
(79, '5', 7, 2),
(81, '4', 7, 2),
(83, '5', 7, 2),
(85, '5', 7, 2),
(87, '5', 7, 2),
(89, '6', 7, 2),
(91, '8', 7, 2),
(93, '4', 10, 2),
(96, '8', 10, 2),
(97, '5', 10, 2),
(100, '5', 10, 2),
(102, '5', 10, 2),
(104, '4', 10, 2),
(106, '5', 10, 2),
(108, '5', 10, 2),
(110, '6', 7, 2),
(112, '4', 7, 2),
(113, '4', 7, 2),
(115, '4', 7, 2),
(116, '8', 7, 2),
(117, '3', 7, 1),
(118, '6', 7, 2),
(119, '3', 7, 1),
(120, '4', 7, 2),
(121, '3', 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anwser`
--
ALTER TABLE `anwser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_anwser`
--
ALTER TABLE `user_anwser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anwser`
--
ALTER TABLE `anwser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_anwser`
--
ALTER TABLE `user_anwser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anwser`
--
ALTER TABLE `anwser`
  ADD CONSTRAINT `anwser_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Constraints for table `user_anwser`
--
ALTER TABLE `user_anwser`
  ADD CONSTRAINT `user_anwser_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_anwser_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
