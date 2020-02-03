-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2017 at 08:49 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor_office`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_time` varchar(255) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_time`, `appointment_date`, `patient_id`, `doctor_id`) VALUES
('09:00 - 10:00', '2017-07-31', 1, 2),
('14:00 - 15:00', '2017-05-01', 1, 3),
('09:00-10:00', '2017-07-31', 2, 1),
('11:00-12:00', '2017-07-31', 2, 2),
('12:00 - 13:00', '2017-07-14', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialisation` varchar(255) NOT NULL,
  `photograph` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialisation`, `photograph`) VALUES
(1, 'Leo Smith', 'cardiologist', 'doctors/leo.png'),
(2, 'Cindy Craword', 'Dermatologist', 'doctors/cindy.png'),
(3, 'Sandy Rivers', 'Gynecologist', 'doctors/sandy.png'),
(4, 'Gregor Davis', 'Audiologist', 'doctors/gregor.png'),
(5, 'Mike Sundown', 'Obstetrician', 'doctors/mike.png'),
(6, 'Lance Mayworth', 'Psychiatrist', 'doctors/lance.png');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `medical_aid_number` int(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `medical_aid_number`, `phone_number`) VALUES
(1, 'Mike Jones', 98892340, '0824513448'),
(2, 'Andy Anderson', 68892760, '0823019140'),
(3, 'Phil Philly', 55862750, '0823019138');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `number` int(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `floor`, `number`, `name`, `doctor_id`) VALUES
(10, 'First', 101, 'consulting room A', 4),
(11, 'First', 102, 'consulting room B', 2),
(15, 'First', 103, 'consulting room C', 4),
(16, 'First', 104, 'consulting room D', 5),
(17, 'First', 105, 'consulting room E', 3),
(18, 'First', 106, 'consulting room F', 1),
(19, 'Second', 201, 'consulting room A', 4),
(20, 'Second', 202, 'consulting room B', 4),
(21, 'Second', 203, 'consulting room C', 3),
(22, 'Second', 204, 'consulting room D', 5),
(23, 'Second', 205, 'consulting room E', 6),
(24, 'Second', 206, 'consulting room F', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`patient_id`,`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
