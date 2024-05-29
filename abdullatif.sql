-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 11:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abdullatif`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(400) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'admin', '$2y$10$fE3kISWDOVbh1kEhK4VgP.UCkvXp0vPrsWASQ/1Rcz3De8Se/NVWi', 'abdullatif', 'falatah', '', '2024-05-29 20:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `logo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `address`, `phone`, `logo`) VALUES
(1, 'team one', 'الرياض', '05252525255', 'teamone.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `id` int(11) NOT NULL,
  `inspection_date` date NOT NULL,
  `next_inspection_date` date NOT NULL,
  `inspection_type` varchar(200) NOT NULL,
  `machine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `machine_type_id` int(11) NOT NULL,
  `serial_number` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`id`, `hospital_id`, `machine_type_id`, `serial_number`) VALUES
(1, 1, 10, '48682344'),
(2, 1, 10, '48702157'),
(3, 1, 10, '48708671'),
(4, 1, 10, '48682306'),
(5, 1, 10, '48677696'),
(6, 1, 10, '48677706'),
(7, 1, 10, '48682332'),
(8, 1, 10, '48708676'),
(9, 1, 10, '48708885'),
(10, 1, 10, '46638226'),
(11, 1, 10, '48708933'),
(12, 1, 10, '4870803'),
(13, 1, 10, '48708703'),
(14, 1, 10, '48682319'),
(15, 1, 11, 'X20K316642'),
(16, 1, 11, 'X22H500044'),
(17, 1, 11, 'X21408496'),
(18, 1, 11, '19K225291'),
(19, 1, 12, '0101061'),
(20, 1, 12, '0101060'),
(21, 1, 12, '1905930267'),
(22, 1, 12, '1905930139'),
(23, 1, 12, '1804930672'),
(24, 1, 12, '1804931021'),
(25, 1, 12, '1804930618'),
(26, 1, 12, '1901932202'),
(27, 1, 12, '2005931293'),
(28, 1, 12, '1509931455'),
(29, 1, 12, '2005931292'),
(30, 1, 13, '22800049'),
(31, 1, 13, '22800044'),
(32, 1, 13, '23702590'),
(33, 1, 13, '23702593'),
(34, 1, 14, '595920076'),
(35, 1, 14, '595920036'),
(36, 1, 14, '3322908036'),
(37, 1, 14, '78350674631'),
(38, 1, 14, '78350674635'),
(39, 1, 14, '332290836'),
(40, 1, 14, '3349210299'),
(41, 1, 14, '585510216'),
(42, 1, 14, '585510355'),
(43, 1, 14, '595920094'),
(44, 1, 14, '595920089'),
(45, 1, 14, '595920022'),
(46, 1, 14, '595920030'),
(47, 1, 14, '14997'),
(48, 1, 14, '14996'),
(49, 1, 14, '14995');

-- --------------------------------------------------------

--
-- Table structure for table `machine_type`
--

CREATE TABLE `machine_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `manufacturer_name` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machine_type`
--

INSERT INTO `machine_type` (`id`, `name`, `manufacturer_name`, `model`, `hospital_id`) VALUES
(10, 'LIFEPAK Automated External Defibrillator', 'Physio Control', 'AED', 1),
(11, 'Automated External Defibrillator', 'ZOLL', 'AED', 1),
(12, 'Glucometer', 'TERUMO', 'MEDISAFE Fit Smile', 1),
(13, 'Defibrillator', 'Corpuls', ' ', 1),
(14, 'Portable Suction Machine', 'HERSILL', 'V7', 1),
(15, 'Portable Suction Machine', 'WeinMann', 'Accuvac Lite', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `machine_id` (`machine_id`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `machine_type_id` (`machine_type_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `machine_type`
--
ALTER TABLE `machine_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `machine_type_ibfk_1` (`hospital_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inspection`
--
ALTER TABLE `inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `machine_type`
--
ALTER TABLE `machine_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inspection`
--
ALTER TABLE `inspection`
  ADD CONSTRAINT `inspection_ibfk_1` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `machine`
--
ALTER TABLE `machine`
  ADD CONSTRAINT `machine_ibfk_1` FOREIGN KEY (`machine_type_id`) REFERENCES `machine_type` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `machine_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `machine_type`
--
ALTER TABLE `machine_type`
  ADD CONSTRAINT `machine_type_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
