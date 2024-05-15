-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 12:00 AM
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
-- Database: `lfbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `amount` int(255) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_holder` varchar(255) NOT NULL,
  `expiration_month` int(2) NOT NULL,
  `expiration_year` int(4) NOT NULL,
  `cvv` int(4) NOT NULL,
  `payment_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `amount`, `card_number`, `card_holder`, `expiration_month`, `expiration_year`, `cvv`, `payment_time`) VALUES
(3, 5, '4216049846519846', 'afraz mishak', 2, 2026, 451, '2024-05-14 21:44:41'),
(4, 58, '9469416895628415', 'afraz mishak', 11, 2026, 592, '2024-05-14 21:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `foodbankdetails`
--

CREATE TABLE `foodbankdetails` (
  `id` int(11) NOT NULL,
  `volunteer_user_id` int(11) NOT NULL,
  `bankname` varchar(255) NOT NULL,
  `incharger` varchar(255) NOT NULL,
  `contactnumber` varchar(255) NOT NULL,
  `location_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postalcode` varchar(255) NOT NULL,
  `imagelocation` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foodbankdetails`
--

INSERT INTO `foodbankdetails` (`id`, `volunteer_user_id`, `bankname`, `incharger`, `contactnumber`, `location_address`, `city`, `postalcode`, `imagelocation`, `timestamp`) VALUES
(4, 7, 'Test Bank', 'Test Incharger', '0114507507', 'Test Address', 'Test City', '13300', '', '2024-05-13 23:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `general_userdetails`
--

CREATE TABLE `general_userdetails` (
  `id` int(11) NOT NULL,
  `general_user_id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `primaryphone` varchar(255) NOT NULL,
  `secondaryphone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `imagelocation` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_userdetails`
--

INSERT INTO `general_userdetails` (`id`, `general_user_id`, `firstname`, `lastname`, `dateofbirth`, `address`, `city`, `zipcode`, `primaryphone`, `secondaryphone`, `email`, `imagelocation`, `timestamp`) VALUES
(2, 2, 'Afraz', 'Mishak', '2002-06-29', '1246/3, Ananda Mawatha, Hunupitiya', 'Wattala', '11300', '0760732923', '0778559043', 'afrazmishak@gmail.com', '', '2024-05-14 01:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `general_users`
--

CREATE TABLE `general_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_users`
--

INSERT INTO `general_users` (`id`, `email`, `userpassword`, `timestamp`, `last_login_time`) VALUES
(1, 'test@lfbl.com', '$2y$10$8INZlDjSrHhs.0fpFYxAnO7DywD9HpPBObtA2.11bXkce5rirzQ4a', '2024-05-14 19:50:30', '2024-05-14 19:50:30'),
(2, 'afrazmishak@lfbl.com', '$2y$10$OuifKfYt0sTKkj8UA2bE8eaWHFPVnlZ8zucM3DMXYax98odhhuAke', '2024-05-14 02:20:26', '2024-05-07 01:09:43'),
(6, 'xerox.com', '$2y$10$QYHelWCYV9rF7aXXuVAAb.cUbnCCVoZE7lv4WhH.jDHIfRXuZBefO', '2024-05-13 16:41:11', '2024-05-13 20:36:00'),
(7, 'plan.com', '$2y$10$lCWr4h0ujB4vbzJfgQgBn.5Qz79sQb6468jl8KwWHCraatQb0rmai', '2024-05-13 16:41:23', '2024-05-13 20:36:00'),
(8, 'heybest', '$2y$10$4cBs6Rb/PkawObPn2FvZwu2yiAze9ClmMT4jkDgwo336ZG4ni.aEa', '2024-05-14 06:35:56', '2024-05-14 06:35:56'),
(9, 'user0629', '$2y$10$TzAbzw9KuMd.ik.J9UZg1eh.eCXa3E7rHZzD0NPH/c9MBOp2ZDJ3W', '2024-05-14 06:45:15', '2024-05-14 06:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `organization_userdetails`
--

CREATE TABLE `organization_userdetails` (
  `id` int(11) NOT NULL,
  `organization_user_id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL,
  `primaryphone` varchar(255) NOT NULL,
  `secondaryphone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `imagelocation` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization_userdetails`
--

INSERT INTO `organization_userdetails` (`id`, `organization_user_id`, `firstname`, `lastname`, `dateofbirth`, `primaryphone`, `secondaryphone`, `email`, `address`, `zipcode`, `imagelocation`, `timestamp`) VALUES
(1, 1, 'First Admin', 'Last Admin', '2024-05-12', '0777777777', '0777777777', 'admin@gmail.com', 'Admin Address', '10000', './images/uploads/generalusers/grilled_chicken_salad.jpg', '2024-05-12 18:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `organization_users`
--

CREATE TABLE `organization_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization_users`
--

INSERT INTO `organization_users` (`id`, `username`, `userpassword`, `timestamp`, `last_login_time`) VALUES
(1, 'admin', 'admin', '2024-05-14 21:59:11', '2024-05-14 21:59:11'),
(2, 'user0629', '$2y$10$nkitoiM9WdAlwHnxbfjeYufDGm6pjfv6blavKymfCvE0VaXVNjvs2', '2024-05-14 06:46:42', '2024-05-14 06:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_users`
--

CREATE TABLE `volunteer_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer_users`
--

INSERT INTO `volunteer_users` (`id`, `firstname`, `lastname`, `email`, `userpassword`, `timestamp`, `last_login_time`) VALUES
(7, 'Test', 'Test', 'test@lfbl.com', '$2y$10$5IlnRmCNQq.w7NO5brz3vuKVCuFC0/iCOBlOj9/takbXRCdF.4eBy', '2024-05-14 20:53:24', '2024-05-14 20:53:24'),
(8, 'Afraz', 'Mishak', 'afrazmishak@lfbl.com', '$2y$10$VaXrKQt5JCyHowsV.pxwBeCZYaNB9eQNOq21GWTcJ1ljsG8DGg7a2', '2024-05-14 05:44:32', '2024-05-14 05:44:32'),
(10, 'Hello', 'Dear', 'hello.dear', '$2y$10$feZRLUhg9CqjIxw0/vvK/efjQJJ6rnZI6HYtIM6ZqO7xnRxpd.fwW', '2024-05-14 06:10:53', '2024-05-14 06:10:53'),
(11, 'Test', 'Best', 'test.best', '$2y$10$rcVVRWim5rt.GyDArQsZk.vlSbOXa/p/DVKjf6U9oDiM0.MFA4ed2', '2024-05-14 06:21:01', '2024-05-14 06:21:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodbankdetails`
--
ALTER TABLE `foodbankdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_foodbankdetails_volunteer_user_id` (`volunteer_user_id`);

--
-- Indexes for table `general_userdetails`
--
ALTER TABLE `general_userdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_general_userdetails_general_user_id` (`general_user_id`);

--
-- Indexes for table `general_users`
--
ALTER TABLE `general_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_userdetails`
--
ALTER TABLE `organization_userdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_organization_user_id` (`organization_user_id`);

--
-- Indexes for table `organization_users`
--
ALTER TABLE `organization_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteer_users`
--
ALTER TABLE `volunteer_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `foodbankdetails`
--
ALTER TABLE `foodbankdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `general_userdetails`
--
ALTER TABLE `general_userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_users`
--
ALTER TABLE `general_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `organization_userdetails`
--
ALTER TABLE `organization_userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organization_users`
--
ALTER TABLE `organization_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `volunteer_users`
--
ALTER TABLE `volunteer_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foodbankdetails`
--
ALTER TABLE `foodbankdetails`
  ADD CONSTRAINT `FK_foodbankdetails_volunteer_user_id` FOREIGN KEY (`volunteer_user_id`) REFERENCES `volunteer_users` (`id`);

--
-- Constraints for table `general_userdetails`
--
ALTER TABLE `general_userdetails`
  ADD CONSTRAINT `FK_general_userdetails_general_user_id` FOREIGN KEY (`general_user_id`) REFERENCES `general_users` (`id`);

--
-- Constraints for table `organization_userdetails`
--
ALTER TABLE `organization_userdetails`
  ADD CONSTRAINT `fk_organization_user_id` FOREIGN KEY (`organization_user_id`) REFERENCES `organization_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
