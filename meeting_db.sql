-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2021 at 10:37 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meeting_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `listtask`
--

CREATE TABLE `listtask` (
  `taskid` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `startTime` date DEFAULT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listtask`
--

INSERT INTO `listtask` (`taskid`, `userId`, `createdBy`, `title`, `details`, `deadline`, `startTime`, `createdOn`, `status`) VALUES
(1, 5, 6, 'Forensic', 'Go to site.\r\nTake some samples', '2021-06-05', '2021-06-01', '2021-05-31 09:29:21', 'completed'),
(2, 0, 6, 'Forensic', 'Go to site.\r\nTake some samples', '2021-06-05', '2021-06-02', '2021-05-31 09:42:01', 'active'),
(3, 5, 0, 'Forensic', 'Go to site.\r\nCollect some samples.', '2021-06-05', '2021-06-03', '2021-05-31 09:45:31', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `meetingabsentee`
--

CREATE TABLE `meetingabsentee` (
  `userId` int(11) NOT NULL,
  `meetingId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meetingattendee`
--

CREATE TABLE `meetingattendee` (
  `userId` int(11) NOT NULL,
  `meetingId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meetingrequest`
--

CREATE TABLE `meetingrequest` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `staffemail` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `meetingDate` date NOT NULL,
  `meetingTime` time NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetingrequest`
--

INSERT INTO `meetingrequest` (`id`, `userId`, `staffemail`, `purpose`, `meetingDate`, `meetingTime`, `status`) VALUES
(1, 5, 'annettedixon367@gmail.com', 'Annual General Meetind', '2021-05-31', '16:31:00', 'pending'),
(2, 5, 'boblewisu@gmail.com', 'Annual General Meetind', '2021-05-31', '16:31:00', 'pending'),
(3, 5, 'boblewisu@gmail.com', 'Annual General Meetind', '2021-05-31', '16:31:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `agenda` text NOT NULL,
  `meetingTypeId` int(11) NOT NULL,
  `attendee` varchar(255) NOT NULL,
  `greetingText` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `meetingDate` date DEFAULT NULL,
  `meetingTime` time DEFAULT NULL,
  `minutesOfMeeting` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  `createdBy` varchar(255) DEFAULT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `subject`, `agenda`, `meetingTypeId`, `attendee`, `greetingText`, `venue`, `meetingDate`, `meetingTime`, `minutesOfMeeting`, `isActive`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`) VALUES
(2, 'Course Allocation', 'i. New course allocation.\r\nii. Course registration', 4, 'students', 'Hello, welcome to another staff, student meeting', 'Hall 1', '2021-05-30', '09:30:00', 'sample.txt', 1, 'Admin', '2021-05-28 07:19:49', NULL, '2021-05-31 11:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `meetingtype`
--

CREATE TABLE `meetingtype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetingtype`
--

INSERT INTO `meetingtype` (`id`, `name`) VALUES
(1, 'faculty meeting'),
(2, 'departmental meeting'),
(3, 'staff meeting'),
(4, 'staff and student meeting');

-- --------------------------------------------------------

--
-- Table structure for table `membertype`
--

CREATE TABLE `membertype` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membertype`
--

INSERT INTO `membertype` (`id`, `type`) VALUES
(1, 'admin'),
(2, 'staff'),
(3, 'secretary'),
(4, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `jobtype` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `registerationId` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `memberType` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `department`, `position`, `jobtype`, `level`, `email`, `gender`, `registerationId`, `password`, `picture`, `memberType`, `isActive`, `createdBy`, `createdOn`, `updatedOn`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL, NULL, 'hassan.abdulrahman3333@gmail.com', '', NULL, '', '1621889053-81081479_1208700802653195_905764961563705344_n.jpg', 'Admin', 1, 'Webmaster', '2021-05-22 16:00:37', '2021-05-28 06:15:18'),
(5, 'Lewis Uzoma', '08148591503', 'Computer Science', NULL, NULL, '400', 'boblewisu@gmail.com', 'male', '3234CM', 'LumoNR0pB&jmm32#HI', NULL, '4', 1, 'Admin', '2021-05-25 20:02:50', '2021-05-25 23:21:02'),
(6, 'John Doe', '2323', 'Computer Science', 'Departmental Lecturer', 'Lecturer', NULL, 'annettedixon367@gmail.com', NULL, NULL, 'LumoNR0pB&jmm32#HI', NULL, '2', 1, 'Admin', '2021-05-28 21:44:38', '2021-05-29 15:20:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `listtask`
--
ALTER TABLE `listtask`
  ADD PRIMARY KEY (`taskid`);

--
-- Indexes for table `meetingrequest`
--
ALTER TABLE `meetingrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetingtype`
--
ALTER TABLE `meetingtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membertype`
--
ALTER TABLE `membertype`
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
-- AUTO_INCREMENT for table `listtask`
--
ALTER TABLE `listtask`
  MODIFY `taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `meetingrequest`
--
ALTER TABLE `meetingrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `meetingtype`
--
ALTER TABLE `meetingtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `membertype`
--
ALTER TABLE `membertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
