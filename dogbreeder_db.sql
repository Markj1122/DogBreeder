-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 05:41 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dogbreeder_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `profile_image` blob NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `email`, `password`, `user_type`, `profile_image`, `updated_at`) VALUES
(2, 'Jeanne', 'Ochavo', 'ochavojeanne@gmail.com', '7488e331b8b64e5794da3fa4eb10ad5d', 'admin', 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f61646d696e2f3339343738383837385f313732323837383032313437313533395f313033303635363731343932393439393133375f6e2e706e67, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `breeders`
--

CREATE TABLE `breeders` (
  `breeder_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `profile_image` blob NOT NULL,
  `id_image` blob NOT NULL,
  `receipt` blob NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breeders`
--

INSERT INTO `breeders` (`breeder_id`, `fname`, `lname`, `email`, `password`, `user_type`, `payment`, `profile_image`, `id_image`, `receipt`, `updated_at`) VALUES
(1, 'Manilyn', 'Jumawan', 'sample@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Breeder', 'Maya', 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f627265656465722f66656174757265642d646f672e6a7067, 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f627265656465722f66656174757265642d70757070792e706e67, 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f627265656465722f67636173682d71722d636f64652e6a7067, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(100) NOT NULL,
  `to_id` int(100) NOT NULL,
  `message` text NOT NULL,
  `opened` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `from_id`, `to_id`, `message`, `opened`, `created_at`) VALUES
(1, 2, 1, 'Musta na', 1, '0000-00-00 00:00:00'),
(2, 1, 2, 'ok ra', 0, '0000-00-00 00:00:00'),
(3, 1, 2, 'cge', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chat_users`
--

CREATE TABLE `chat_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `p_p` varchar(255) NOT NULL,
  `last_seen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_users`
--

INSERT INTO `chat_users` (`user_id`, `name`, `username`, `password`, `p_p`, `last_seen`) VALUES
(1, 'Manilyn Jumawan', 'admin', '$2y$10$cOVbwf0ln06.wwSgPnORyOxWwufwXQOA8xymzmOI6Lj8k4fTzloJK', 'admin.jpg', '2023-11-18 03:44:40'),
(2, 'Jeanne Ochavo', 'jeanne1', '$2y$10$/xbD4JH0d5q3tEW5eGuZeOy2jq.yKxEretcemS..5L9TLa0KkmqeK', 'jeanne1.jpg', '2023-11-09 15:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user_1` int(100) NOT NULL,
  `user_2` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `user_1`, `user_2`) VALUES
(0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `purchase_id` int(100) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `delivery` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `pet_image` varchar(1500) NOT NULL,
  `status` varchar(255) NOT NULL,
  `breeder_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `breed_type` varchar(255) NOT NULL,
  `dog_type` varchar(255) NOT NULL,
  `date_purchase` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pending_approval`
--

CREATE TABLE `pending_approval` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `profile_image` blob NOT NULL,
  `id_image` blob NOT NULL,
  `receipt` blob NOT NULL,
  `date_requested` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Error reading data for table dogbreeder_db.pending_approval: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `dogbreeder_db`.`pending_approval`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pending_purchase`
--

CREATE TABLE `pending_purchase` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `purchase_id` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `delivery` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `breeder_name` varchar(255) NOT NULL,
  `breed_type` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `dog_type` varchar(255) NOT NULL,
  `pet_image` varchar(1500) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_purchase` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_purchase`
--

INSERT INTO `pending_purchase` (`id`, `tracking_number`, `purchase_id`, `fname`, `lname`, `address`, `delivery`, `payment`, `contact`, `breeder_name`, `breed_type`, `price`, `dog_type`, `pet_image`, `status`, `date_purchase`) VALUES
(1, 'DBW-TN-000001', '1', 'Jeanne', 'Ochavo', '753, Ibabao, Cordova, Cebu', 'Delivery', 'Cash', '9234280345', 'Manilyn Jumawan', '0', '15000', 'Adult', 'a:1:{i:0;s:0:\"\";}', 'Pending', '2023-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `post_feed`
--

CREATE TABLE `post_feed` (
  `id` int(11) NOT NULL,
  `breeder_id` int(100) NOT NULL,
  `breeder_profile` blob NOT NULL,
  `breeder_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `breed_type` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `dog_type` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `dam_image` blob NOT NULL,
  `vaccine_image` blob NOT NULL,
  `sire_image` blob NOT NULL,
  `pet_image` blob NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_feed`
--

INSERT INTO `post_feed` (`id`, `breeder_id`, `breeder_profile`, `breeder_name`, `content`, `breed_type`, `price`, `dog_type`, `birthdate`, `dam_image`, `vaccine_image`, `sire_image`, `pet_image`, `status`, `date_posted`) VALUES
(1, 1, 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f627265656465722f66656174757265642d646f672e6a7067, 'Manilyn Jumawan', 'Sell this pet', 'Pomeranian', '15000', 'Adult', '2023-08-17', 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f706f7374696e672f696d672d736c696465725f322e6a7067, 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f706f7374696e672f696d672d736c696465725f31302e6a7067, 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f706f7374696e672f696d672d736c696465722d352e6a7067, 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f706f7374696e672f696d672d736c696465725f332e6a7067, 'Available', '2023-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `id` int(11) NOT NULL,
  `revenue` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `revenues`
--

INSERT INTO `revenues` (`id`, `revenue`, `tax`, `added_at`) VALUES
(1, '300', '100', '2023-11-25 14:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `rates` varchar(255) NOT NULL,
  `date_rated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `message`, `rates`, `date_rated`) VALUES
(1, 'Jeanne Ochavo', 'Nice breed and very affordable', '4 Star', '2023-11-25 09:33:17'),
(2, 'Jeanne Ochavo', 'Nice breed very affordable', '5 Star', '2023-11-26 11:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `profile_image` blob NOT NULL,
  `id_image` blob NOT NULL,
  `receipt` blob NOT NULL,
  `date_requested` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `profile_image` blob NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `user_type`, `profile_image`, `updated_at`) VALUES
(2, 'Jeanne', 'Ochavo', 'ochavojeanne@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'User', 0x2e2e2f2e2e2f7075626c69632f7372632f75706c6f6164732f757365722f3339343738383837385f313732323837383032313437313533395f313033303635363731343932393439393133375f6e2e706e67, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breeders`
--
ALTER TABLE `breeders`
  ADD PRIMARY KEY (`breeder_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chat_users`
--
ALTER TABLE `chat_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_approval`
--
ALTER TABLE `pending_approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_purchase`
--
ALTER TABLE `pending_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_feed`
--
ALTER TABLE `post_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `breeders`
--
ALTER TABLE `breeders`
  MODIFY `breeder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_users`
--
ALTER TABLE `chat_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_approval`
--
ALTER TABLE `pending_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pending_purchase`
--
ALTER TABLE `pending_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_feed`
--
ALTER TABLE `post_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
