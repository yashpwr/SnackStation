-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2020 at 04:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snackstation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `trn_date`) VALUES
(3, 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-04-19 07:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `snacks_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `snack_id` varchar(100) NOT NULL,
  `vendor_id` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_id`, `user_id`, `snack_id`, `vendor_id`, `trn_date`) VALUES
(1, 'xsgAPI', '1', '3', '8', '2020-04-26 15:31:14'),
(2, 'e9oaE8', '1', '2', '15', '2020-04-26 15:31:53'),
(3, 'eEzjoJ', '1', '1', '8', '2020-04-26 15:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `status` enum('pending','delivered','canceled') NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `status`, `name`, `email`, `address`, `city`, `state`, `country`, `pincode`, `phone`, `trn_date`) VALUES
(1, 'xsgAPI', 'canceled', 'yashpwr', 'yashdvn@gmail.com', 'ahmedabad', 'Ahmedabad', 'Gujarat', 'India', 380008, '2147483647', '2020-04-26 15:31:14'),
(2, 'e9oaE8', 'pending', 'yashpwr', 'yashdvn@gmail.com', 'ahmedabad', 'Ahmedabad', 'Gujarat', 'India', 380008, '9898989898', '2020-04-26 15:31:53'),
(3, 'eEzjoJ', 'delivered', 'yashpwr', 'yashdvn@gmail.com', 'ahmedabad', 'Ahmedabad', 'Gujarat', 'India', 380008, '9898989898', '2020-04-26 15:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `img`, `title`, `description`, `trn_date`) VALUES
(1, 'collection-1.jpg', 'slider title updated', 'slider decription updated', '2020-02-23 14:30:53'),
(2, 'collection-2.jpg', 'slider title 2', 'slider decription 2', '2020-02-23 14:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `snacks`
--

CREATE TABLE `snacks` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` enum('in Stock','out of Stock') NOT NULL,
  `uploaded_by` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `snacks`
--

INSERT INTO `snacks` (`id`, `img`, `name`, `category`, `quantity`, `price`, `description`, `status`, `uploaded_by`, `trn_date`) VALUES
(1, 'collection-5.jpg', 'kadhai paneer', 'demo category', '50', 30, 'bcjzhbcjhbkzuh ', 'in Stock', '8', '2020-02-23 10:56:50'),
(2, 'collection-1.jpg', 'butter chiken', 'demo category', '50', 16, 'ugdfguhijokgfxfcvjklkjhgchgvbjkl', 'in Stock', '15', '2020-02-23 15:32:22'),
(3, 'collection-4.jpg', 'bhindi masala', 'user category', '60', 60, 'bnml;kjhgfcgvhbjkljhgvc vbjnkml;k hgcgvhbjkjhv m      ', 'in Stock', '8', '2020-02-23 17:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `snacks_category`
--

CREATE TABLE `snacks_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `snacks_category`
--

INSERT INTO `snacks_category` (`id`, `category`, `added_by`, `trn_date`) VALUES
(1, 'demo category', 'admin', '2020-02-23 10:04:50'),
(2, 'demo category 2', 'admin', '2020-02-23 10:07:45'),
(4, 'user category', 'user@gmail.com', '2020-02-23 17:30:39'),
(5, 'demo category', 'vendor@gmail.com', '2020-02-24 18:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `img`, `fname`, `lname`, `email`, `password`, `trn_date`) VALUES
(1, 'collection-1.jpg', 'yash', 'pawar', 'yash@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-26 17:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `v_profile` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `r_id` varchar(100) NOT NULL,
  `r_name` varchar(100) NOT NULL,
  `r_location` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `v_profile`, `fname`, `lname`, `r_id`, `r_name`, `r_location`, `email`, `password`, `trn_date`) VALUES
(8, '16-payment.jpg', 'demo fname', 'demo lname', '5e521edf095fa', 'demo restaurent 2', 'ahmedabad', 'user@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-22 15:12:08'),
(15, '02-Login.jpg', 'vendor2', 'vendor', '5e52412319ac7', 'demo restaurant ', 'demo location', 'vendor@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-23 10:08:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snacks`
--
ALTER TABLE `snacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snacks_category`
--
ALTER TABLE `snacks_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `snacks`
--
ALTER TABLE `snacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `snacks_category`
--
ALTER TABLE `snacks_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
