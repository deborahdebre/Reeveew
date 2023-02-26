-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2023 at 03:33 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reeveew`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_details`
--

CREATE TABLE `business_details` (
  `business_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `phone_num` varchar(100) NOT NULL,
  `business_email` varchar(100) NOT NULL,
  `working_time` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `keywords` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Hotel'),
(2, 'Restaurant'),
(3, 'Salon'),
(4, 'Spa'),
(5, 'Event');

-- --------------------------------------------------------

--
-- Table structure for table `Image`
--

CREATE TABLE `Image` (
  `image_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `image_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_status`
--

CREATE TABLE `request_status` (
  `status_id` int(11) NOT NULL,
  `status_details` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_status`
--

INSERT INTO `request_status` (`status_id`, `status_details`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Denied');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_comments` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `feedback` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_lname` varchar(100) NOT NULL,
  `user_fname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_gender` enum('male','female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_request`
--

CREATE TABLE `user_request` (
  `request_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `phone_num` varchar(100) NOT NULL,
  `business_email` varchar(100) NOT NULL,
  `working_time` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `keywords` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_type`) VALUES
(1, 'Admin'),
(2, 'Regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_details`
--
ALTER TABLE `business_details`
  ADD PRIMARY KEY (`business_id`),
  ADD UNIQUE KEY `business_email` (`business_email`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `request_status`
--
ALTER TABLE `request_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_request`
--
ALTER TABLE `user_request`
  ADD PRIMARY KEY (`request_id`),
  ADD UNIQUE KEY `business_email` (`business_email`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_details`
--
ALTER TABLE `business_details`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Image`
--
ALTER TABLE `Image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_status`
--
ALTER TABLE `request_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_request`
--
ALTER TABLE `user_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_details`
--
ALTER TABLE `business_details`
  ADD CONSTRAINT `business_details_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `Image`
--
ALTER TABLE `Image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business_details` (`business_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`business_id`) REFERENCES `business_details` (`business_id`);

--
-- Constraints for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`);

--
-- Constraints for table `user_request`
--
ALTER TABLE `user_request`
  ADD CONSTRAINT `user_request_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `request_status` (`status_id`),
  ADD CONSTRAINT `user_request_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
