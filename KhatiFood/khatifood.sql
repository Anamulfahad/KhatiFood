-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 05:52 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khatifood`
--

CREATE DATABASE IF NOT EXISTS khatifood;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--


CREATE TABLE `customer` (
  `username` varchar(15) NOT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `pass_word` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `phone`, `email`, `first_name`, `last_name`, `dob`, `city`, `area`, `location`, `pass_word`) VALUES
('arindam', ' 01523645556', 'ari@gmail.com', 'Arindam', 'Kundu', '2021-09-20', 'Dhaka', 'Mirpur', 'section-2, block-g, road-5, house-20', '1234'),
('sabit12', ' 01612415441', 'ahfahad118@gmail.com', 'Sabit', 'Hasan', '2021-10-01', 'Dhaka', 'Mirpur', 'section-2, block-g, road-5, house-20', '2345');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_man`
--

CREATE TABLE `delivery_man` (
  `username` varchar(15) NOT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `pass_word` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_man`
--

INSERT INTO `delivery_man` (`username`, `phone`, `email`, `first_name`, `last_name`, `dob`, `city`, `area`, `location`, `pass_word`) VALUES
('pinku', ' 01906145923', 'pdfgh@gmail.com', 'Prianka', 'Akter', '2021-10-04', 'Dhaka', 'Gulsan', 'section-2, block-g, road-5, house-20', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `f_id` int(11) NOT NULL,
  `fo_name` varchar(50) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`f_id`, `fo_name`, `username`, `category`, `price`) VALUES
(1, 'Mutton Kacchi', 'anamul123', 'Rice', 280),
(2, 'Chicken Curry', 'anamul123', 'Chicken', 120),
(3, 'Chicken Biriyani', 'anamul123', 'Chicken', 170),
(4, 'Beef Biriyani', 'anamul123', 'Rice', 120),
(6, 'Fish Curry', 'arindam', 'Fish', 130),
(10, 'Polao', 'anamul123', 'Rice', 100),
(11, 'Polao', 'anamul123', 'Rice', 100),
(12, 'Shak', 'anamul123', 'Vegetable', 10),
(13, 'alo vorta', 'anamul123', 'Vorta', 50),
(14, 'Dim Vorta', 'anamul123', 'Vorta', 10),
(15, 'vat', 'anamul123', 'Rice', 10),
(16, 'Pangas fish curry', 'anamul123', 'Fish', 60),
(17, 'Murgir pa', 'anamul123', 'Chicken', 50),
(18, 'Murgir pa', 'anamul123', 'Chicken', 50),
(19, 'Murgir pa', 'anamul123', 'Chicken', 50),
(20, 'ilish vaji', 'anamul123', 'Fish', 50),
(21, 'ilish vaji', 'anamul123', 'Fish', 50),
(22, 'Cake', 'anamul123', 'Dessert', 300),
(23, 'Cake', 'anamul123', 'Dessert', 300),
(24, 'Cake', 'anamul123', 'Dessert', 300),
(25, 'Fried rice', 'anamul123', 'Rice', 110),
(26, 'Fried rice', 'anamul123', 'Rice', 110);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `f_id` int(11) DEFAULT NULL,
  `ingredient_name` varchar(100) DEFAULT NULL,
  `quantity` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`f_id`, `ingredient_name`, `quantity`) VALUES
(15, 'rice', 1),
(24, 'cake', 1),
(24, '', 0),
(24, '', 0),
(24, '', 0),
(24, '', 0),
(24, '', 0),
(24, '', 0),
(24, '', 0),
(24, '', 0),
(24, '', 0),
(25, 'Rice', 0.5),
(25, 'oil', 0.25),
(25, 'vegetable ', 0.3),
(26, 'Rice', 0.5),
(26, 'oil', 0.25),
(26, 'vegetable ', 0.3);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `o_id` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `f_id` int(11) DEFAULT NULL,
  `customisation` varchar(255) DEFAULT NULL,
  `orderReadyMix` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`o_id`, `username`, `f_id`, `customisation`, `orderReadyMix`) VALUES
(9, 'sabit12', 2, NULL, NULL),
(11, 'arindam', 19, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_rating`
--

CREATE TABLE `review_rating` (
  `review` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `uname_s` varchar(15) DEFAULT NULL,
  `uname_c` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `username` varchar(15) NOT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `pass_word` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`username`, `phone`, `email`, `first_name`, `last_name`, `dob`, `city`, `area`, `location`, `pass_word`) VALUES
('anamul123', ' 01906145922', 'ahfahad118@gmail.com', 'Anamul', 'Hasan', '2021-09-02', 'Dhaka', 'Mirpur', 'section-2, block-g, road-5, house-20', '1234'),
('arindam', ' 01612415441', 'ahfahad118@gmail.com', 'Arindam', 'Kundu', '2021-12-08', 'Dhaka', 'Gulsan', 'vghfvgycfyhcgghxf scsujbs scgbbnsxd', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `s_d`
--

CREATE TABLE `s_d` (
  `uname_s` varchar(15) DEFAULT NULL,
  `uname_d` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `delivery_man`
--
ALTER TABLE `delivery_man`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `username` (`username`),
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `review_rating`
--
ALTER TABLE `review_rating`
  ADD KEY `uname_s` (`uname_s`),
  ADD KEY `uname_c` (`uname_c`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `s_d`
--
ALTER TABLE `s_d`
  ADD KEY `uname_s` (`uname_s`),
  ADD KEY `uname_d` (`uname_d`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`username`) REFERENCES `supplier` (`username`);

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `food` (`f_id`);

--
-- Constraints for table `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `order_table_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`),
  ADD CONSTRAINT `order_table_ibfk_2` FOREIGN KEY (`f_id`) REFERENCES `food` (`f_id`);

--
-- Constraints for table `review_rating`
--
ALTER TABLE `review_rating`
  ADD CONSTRAINT `review_rating_ibfk_1` FOREIGN KEY (`uname_s`) REFERENCES `supplier` (`username`),
  ADD CONSTRAINT `review_rating_ibfk_2` FOREIGN KEY (`uname_c`) REFERENCES `customer` (`username`);

--
-- Constraints for table `s_d`
--
ALTER TABLE `s_d`
  ADD CONSTRAINT `s_d_ibfk_1` FOREIGN KEY (`uname_s`) REFERENCES `supplier` (`username`),
  ADD CONSTRAINT `s_d_ibfk_2` FOREIGN KEY (`uname_d`) REFERENCES `delivery_man` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
