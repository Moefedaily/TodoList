-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 02:59 AM
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
-- Database: `my_webapp__31`--

-- --------------------------------------------------------

--
-- Table structure for table `tdl_category`
--

CREATE TABLE `tdl_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tdl_category`
--

INSERT INTO `tdl_category` (`category_id`, `name`) VALUES
(5, 'Work'),
(6, 'Personal'),
(7, 'Health'),
(8, 'Finance'),
(9, 'Education'),
(10, 'Social'),
(11, 'Family'),
(12, 'Entertainment'),
(13, 'Travel'),
(14, 'Hobbies');

-- --------------------------------------------------------

--
-- Table structure for table `tdl_priority`
--

CREATE TABLE `tdl_priority` (
  `priority_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tdl_priority`
--

INSERT INTO `tdl_priority` (`priority_id`, `name`) VALUES
(1, 'Important'),
(2, 'Normal'),
(3, 'Urgent');

-- --------------------------------------------------------

--
-- Table structure for table `tdl_task`
--

CREATE TABLE `tdl_task` (
  `task_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `dueto` date DEFAULT NULL,
  `completed` tinyint(1) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tdl_task`
--

INSERT INTO `tdl_task` (`task_id`, `title`, `description`, `dueto`, `completed`, `priority_id`, `user_id`) VALUES
(116, 'Write Journal Entry', 'Reflect on the day\'s events and jot down thoughts in the journal', '2024-04-05', 1, 1, 41),
(117, 'Create Presentation Slides', 'Prepare slides for upcoming project presentation', '2024-03-29', 0, 1, 41),
(118, 'Review Meeting Notes', 'Go through notes from previous team meeting and highlight action items', '2024-04-01', 0, 2, 42),
(119, 'Research Market Trends', 'Gather data on market trends to inform business strategy', '2024-04-03', 0, 2, 42),
(120, 'Attend Networking Event', 'Participate in networking event to expand professional contacts', '2024-04-10', 0, 3, 41),
(121, 'Update Resume', 'Revise and update resume with latest achievements and skills', '2024-03-30', 1, 3, 41),
(122, 'Plan Birthday Party', 'Organize birthday party for a family member or friend', '2024-04-07', 0, 3, 42),
(123, 'Practice Public Speaking', 'Practice delivering a speech or presentation', '2024-04-15', 0, 1, 42),
(124, 'Research Investment Opportunities', 'Explore potential investment opportunities for savings', '2024-04-04', 0, 2, 41),
(125, 'Schedule Dentist Appointment', 'Book appointment for dental check-up and cleaning', '2024-04-02', 1, 2, 41),
(126, 'Write Business Proposal', 'Draft a proposal for a new business venture or project', '2024-04-20', 0, 3, 42),
(127, 'Call Parents', 'Catch up with parents and check on their well-being', '2024-04-08', 0, 3, 42),
(128, 'Update Social Media Profiles', 'Review and update social media profiles with recent information', '2024-04-12', 0, 2, 41),
(129, 'Research Travel Destinations', 'Explore potential travel destinations for upcoming vacation', '2024-04-06', 0, 2, 41),
(130, 'Write Thank You Notes', 'Express gratitude by writing thank you notes to colleagues or clients', '2024-04-09', 0, 1, 42),
(131, 'Prepare Lunch', 'Pack a healthy and nutritious lunch for work or school', '2024-03-31', 1, 1, 42),
(132, 'Attend Photography Class', 'Participate in photography class to improve skills', '2024-04-05', 0, 3, 41),
(133, 'Update Blog', 'Write and publish a new post on personal or professional blog', '2024-04-07', 0, 3, 41),
(134, 'Practice Yoga', 'Engage in a yoga session to improve flexibility and relaxation', '2024-04-08', 0, 3, 42),
(135, 'Watch Documentary', 'Spend time watching a documentary on an interesting topic', '2024-04-03', 0, 2, 42),
(136, 'Experiment with Cooking', 'Try out new recipes or cooking techniques in the kitchen', '2024-04-04', 0, 1, 42),
(137, 'Water Garden Plants', 'Ensure plants in the garden are watered and cared for', '2024-04-01', 1, 1, 42),
(138, 'Organize Digital Files', 'Sort through digital files and organize them into folders', '2024-04-10', 0, 1, 42),
(139, 'Review Investment Portfolio', 'Evaluate performance of investment portfolio and make adjustments', '2024-03-30', 0, 1, 41),
(140, 'Practice Drawing', 'Spend time practicing drawing or sketching', '2024-04-15', 0, 2, 41);

-- --------------------------------------------------------

--
-- Table structure for table `tdl_task_has_category`
--

CREATE TABLE `tdl_task_has_category` (
  `task_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tdl_task_has_category`
--

INSERT INTO `tdl_task_has_category` (`task_id`, `category_id`) VALUES
(116, 5),
(117, 6),
(118, 7),
(119, 8),
(120, 9),
(121, 10),
(122, 11),
(123, 12),
(124, 13),
(125, 14),
(126, 7),
(127, 5),
(128, 6),
(129, 7),
(130, 8),
(131, 9),
(132, 10),
(133, 11),
(134, 12),
(135, 13),
(136, 14),
(137, 9),
(138, 5),
(139, 6),
(140, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tdl_users`
--

CREATE TABLE `tdl_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tdl_users`
--

INSERT INTO `tdl_users` (`user_id`, `first_name`, `last_name`, `password`, `email`) VALUES
(41, 'mohmmed', 'Fedaily', '$2y$10$Wlr3LWh7F5GBmhM13m/rDO2ou5c7.LZcyiE6VQ1A4LobHAoQQkWaG', 'moe@gmail.com'),
(42, 'moe', 'moe', '$2y$10$Ovx7YlTjGuO6L1N6pSyBZO23oqyAW3JWWFBPthuvgFYv3DqUSCeKC', 'moe@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tdl_category`
--
ALTER TABLE `tdl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tdl_priority`
--
ALTER TABLE `tdl_priority`
  ADD PRIMARY KEY (`priority_id`);

--
-- Indexes for table `tdl_task`
--
ALTER TABLE `tdl_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tdl_task_has_category`
--
ALTER TABLE `tdl_task_has_category`
  ADD KEY `category_id` (`category_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tdl_users`
--
ALTER TABLE `tdl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tdl_category`
--
ALTER TABLE `tdl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tdl_priority`
--
ALTER TABLE `tdl_priority`
  MODIFY `priority_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tdl_task`
--
ALTER TABLE `tdl_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `tdl_users`
--
ALTER TABLE `tdl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tdl_task`
--
ALTER TABLE `tdl_task`
  ADD CONSTRAINT `tdl_task_ibfk_1` FOREIGN KEY (`priority_id`) REFERENCES `tdl_priority` (`priority_id`),
  ADD CONSTRAINT `tdl_task_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tdl_users` (`user_id`);

--
-- Constraints for table `tdl_task_has_category`
--
ALTER TABLE `tdl_task_has_category`
  ADD CONSTRAINT `tdl_task_has_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tdl_category` (`category_id`),
  ADD CONSTRAINT `tdl_task_has_category_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tdl_task` (`task_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
