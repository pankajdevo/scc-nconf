-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 02:09 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coding_cell_nconf`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(22) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `status`, `created`, `updated`) VALUES
(1, 'Superadmin', 'Superadmin', '1', '2024-08-08 17:57:05', '2024-08-08 17:57:05'),
(2, 'Admin', 'Admin', '1', '2024-08-08 17:57:05', '2024-08-08 17:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `sample_registration`
--

CREATE TABLE `sample_registration` (
  `id` int(11) NOT NULL,
  `sample_category` varchar(255) DEFAULT NULL,
  `subcategory_sample` varchar(255) DEFAULT NULL,
  `physical_condition` varchar(50) DEFAULT NULL,
  `date_of_receipt` date DEFAULT NULL,
  `inspector_sample_code` varchar(50) DEFAULT NULL,
  `sampling_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `ao_code` varchar(50) DEFAULT NULL,
  `inspector_name_address` varchar(255) DEFAULT NULL,
  `analysis_sent_to` varchar(50) DEFAULT NULL,
  `form_pk_pdf` varchar(255) DEFAULT NULL,
  `create_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample_registration`
--

INSERT INTO `sample_registration` (`id`, `sample_category`, `subcategory_sample`, `physical_condition`, `date_of_receipt`, `inspector_sample_code`, `sampling_date`, `expiry_date`, `ao_code`, `inspector_name_address`, `analysis_sent_to`, `form_pk_pdf`, `create_dt`) VALUES
(1, 'Biofertilizer', 'azotobacter', 'Intact', '2024-09-20', 'ROAS-20240920-1', '2024-09-21', '2024-09-22', '', 'adadada', 'RCONF Ghaziabad', 'uploads/NCOF Attendance August.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(22) NOT NULL,
  `role_id` int(22) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 2,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `parent_id`, `username`, `fname`, `office`, `email`, `mobile_no`, `password`, `description`, `status`, `created`, `updated`) VALUES
(1, 1, 0, 'ao_ghaziabad', '', '', 'ao@gmail.com', '938972534', 'test@gmail.com', 'ao ghazibad', '1', '2024-08-08 18:00:52', '2024-08-08 18:00:52'),
(2, 2, 1, 'incharge_gzb', '', '', 'incharge@gmail.com', '938972534', 'incarge@2024', 'incharge ghazibad', '1', '2024-08-08 18:00:52', '2024-08-08 18:00:52'),
(3, 3, 2, 'rd.ghaziabad', '', '', 'rd.ghaziabad@gmail.com', '938972534', 'rd.ghaziabad@2024', 'rd ghaziabad', '1', '2024-08-08 18:00:52', '2024-08-08 18:00:52'),
(4, 3, 2, 'rd.nagpur', '', '', 'rd.nagpur@gmail.com', '938972534', 'rd nagpur', 'rd nagpur', '1', '2024-08-08 18:00:52', '2024-08-08 18:00:52'),
(5, 3, 2, 'rd.bangalore', '', '', 'rd.bangalore@gmail.com', '938972534', 'rd.bangalore@2024', 'rd bangalore', '1', '2024-08-08 18:00:52', '2024-08-08 18:00:52'),
(6, 3, 2, 'rd.bhuneshwar', '', '', 'rd.bhuneshwar@gmail.com', '938972534', 'rd.bhuneshwar@2024', 'rd bhuneshwar', '1', '2024-08-08 18:00:52', '2024-08-08 18:00:52'),
(7, 3, 2, 'rd.imphal', '', '', 'rd.imphal@gmail.com', '938972534', 'rd.imphal@2024', 'rd imphal', '0', '2024-08-08 18:13:55', '2024-08-08 18:13:55'),
(8, 1, 2, 'Web_admin', 'adfsdfs', '1', 'pkcse20101991@gmail.com', '08858487744', ' $2y$10$gSpR1DUQ7fVmfO6Qu/lBY.lZ5t6KFOFNAFTZkqZ9I0wgA2a17zVgq', NULL, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_registration`
--
ALTER TABLE `sample_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sample_registration`
--
ALTER TABLE `sample_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
