-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2024 at 03:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teretana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `created_at`) VALUES
(3, 'ivan', '$2y$10$Aq14RicKZ2w013uuZY6gmOCQja/6BN5jKY77BoZ626z5Y5EvASw0W', '2023-09-28'),
(6, 'admin', '$2y$10$R66Y9Vc1.5sUzvmUUy5ZjuMUNmeezRUs2vr7GeGv5QWDNDIhrID1G', '2023-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `training_plan_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `first_name`, `last_name`, `email`, `phone_number`, `training_plan_id`, `trainer_id`, `created_at`) VALUES
(106, 'Nemanja', 'Jegdic', 'nemanja@gmail.com', '065463355', 2, 38, '2023-08-14'),
(142, 'Marko', 'Ivanovic', 'marko.ivanovic@gmail.com', '065260819', 2, 39, '2023-08-14'),
(143, 'Suzana', 'Ostovic', 'paka.gm@gmail.com', '066345223', 3, 40, '2023-08-14'),
(144, 'Vlado', 'Simic', 'vlados@yahoo.com', '065345918', 2, 41, '2023-08-14'),
(145, 'Dragana', 'Nikolic', 'milijan42@gmail.com', '064123956', 2, 40, '2023-08-14'),
(146, 'Nemanja', 'Simic', 'nemanjas@gmal.com', '065767453', 1, 0, '2023-08-14'),
(147, 'Filip', 'Juric', 'filipj@gmail.com', '065453615', 1, 39, '2023-08-14'),
(148, 'Slavko', 'Vujic', 'slavkov@gmail.com', '065774482', 3, 39, '2023-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `first_name`, `last_name`, `email`, `phone_number`, `created_at`) VALUES
(38, 'Petar', 'Celik', 'petar@gmail.com', '0643469245', '2023-08-14'),
(39, 'Mihajlo', 'Malis', 'mihajlo@gmail.com', '066794333', '2023-08-14'),
(40, 'Marija', 'Drobac', 'marija@gmail.com', '066569352', '2023-08-14'),
(54, 'Denis', 'Pilipovic', 'denisp@gmail.com', '065236356', '2023-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `training_plans`
--

CREATE TABLE `training_plans` (
  `training_plan_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sessions` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_plans`
--

INSERT INTO `training_plans` (`training_plan_id`, `name`, `sessions`, `price`, `created_at`) VALUES
(1, '15 dana', 12, '15', '2023-08-10'),
(2, '30 dana', 30, '25', '2023-08-10'),
(3, '90 dana', 50, '100', '2023-08-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `training_plans`
--
ALTER TABLE `training_plans`
  ADD PRIMARY KEY (`training_plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `training_plans`
--
ALTER TABLE `training_plans`
  MODIFY `training_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
