-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2020 at 07:57 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schedule_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `info_doctor`
--

CREATE TABLE `info_doctor` (
  `doc_id` int(11) NOT NULL COMMENT 'id doctor',
  `doc_name` varchar(255) NOT NULL COMMENT 'name doctor',
  `doc_fts` varchar(11) NOT NULL COMMENT 'first time start',
  `doc_fte` varchar(11) NOT NULL COMMENT 'first time end',
  `doc_sts` varchar(11) NOT NULL COMMENT 'second time start',
  `doc_ste` varchar(11) NOT NULL COMMENT 'second time end',
  `doc_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `info_doctor`
--

INSERT INTO `info_doctor` (`doc_id`, `doc_name`, `doc_fts`, `doc_fte`, `doc_sts`, `doc_ste`, `doc_timestamp`) VALUES
(6, 'คุณหมอ', '07:00', '11:00', '12:00', '16:00', '2020-02-02 18:00:55'),
(7, 'doctor', '01:00', '05:00', '07:00', '11:00', '2020-02-02 18:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `info_patient`
--

CREATE TABLE `info_patient` (
  `pa_id` int(11) NOT NULL COMMENT 'patient id',
  `pa_name` varchar(255) NOT NULL COMMENT 'patient name',
  `pa_time` varchar(255) NOT NULL COMMENT 'patient time',
  `pa_des` varchar(255) NOT NULL COMMENT 'patient description',
  `pa_active` int(1) NOT NULL COMMENT 'use people',
  `pa_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `info_patient`
--

INSERT INTO `info_patient` (`pa_id`, `pa_name`, `pa_time`, `pa_des`, `pa_active`, `pa_timestamp`) VALUES
(11, 'test01', '02/03/2020 8:30 AM', 'ปวดหัว', 1, '2020-02-02 17:59:33'),
(12, 'ทดสอบบุคคลที่ 2', '02/03/2020 8:00 AM', 'ปวดศรีษะ', 1, '2020-02-02 18:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_plan`
--

CREATE TABLE `schedule_plan` (
  `sc_id` int(11) NOT NULL,
  `sc_pa_id` int(11) NOT NULL COMMENT 'patient id',
  `sc_doc_id` int(11) NOT NULL COMMENT 'doctor id',
  `sc_date` varchar(11) NOT NULL COMMENT 'Appointment date',
  `sc_time` varchar(11) NOT NULL COMMENT 'Appointment time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule_plan`
--

INSERT INTO `schedule_plan` (`sc_id`, `sc_pa_id`, `sc_doc_id`, `sc_date`, `sc_time`) VALUES
(32, 12, 6, '02/03/2020', '08:00'),
(34, 11, 7, '02/03/2020', '08:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info_doctor`
--
ALTER TABLE `info_doctor`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `info_patient`
--
ALTER TABLE `info_patient`
  ADD PRIMARY KEY (`pa_id`);

--
-- Indexes for table `schedule_plan`
--
ALTER TABLE `schedule_plan`
  ADD PRIMARY KEY (`sc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info_doctor`
--
ALTER TABLE `info_doctor`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id doctor', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `info_patient`
--
ALTER TABLE `info_patient`
  MODIFY `pa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'patient id', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedule_plan`
--
ALTER TABLE `schedule_plan`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
