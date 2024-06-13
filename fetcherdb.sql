-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 08:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fetcherdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `recid` int(11) NOT NULL,
  `studentCode` varchar(255) NOT NULL,
  `fetcherCode` varchar(255) NOT NULL,
  `relationship` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`recid`, `studentCode`, `fetcherCode`, `relationship`) VALUES
(1, 'S001', 'fetcher1', 'mother'),
(2, 'S003', 'fetcher1', 'mother'),
(3, 'S007', 'fetcher1', 'father'),
(4, 'S004', 'fetcher1', 'mother'),
(5, 'S010', 'fetcher1', 'father'),
(6, 'S002', 'fetcher2', 'father'),
(7, 'S003', 'fetcher2', 'mother'),
(8, 'S006', 'fetcher2', 'father'),
(9, 'S008', 'fetcher2', 'father'),
(10, 'S010', 'fetcher2', 'mother'),
(11, 'S002', 'fetcher3', 'mother'),
(12, 'S003', 'fetcher3', 'mother'),
(13, 'S006', 'fetcher3', 'mother'),
(14, 'S007', 'fetcher3', 'father'),
(15, 'S010', 'fetcher3', 'father'),
(16, 'S001', 'fetcher4', 'father'),
(17, 'S007', 'fetcher4', 'mother'),
(18, 'S005', 'fetcher4', 'mother'),
(19, 'S010', 'fetcher4', 'father'),
(20, 'S009', 'fetcher4', 'father'),
(21, 'S001', 'fetcher5', 'mother'),
(22, 'S002', 'fetcher5', 'father');

-- --------------------------------------------------------

--
-- Table structure for table `fetcherfile`
--

CREATE TABLE `fetcherfile` (
  `recid` int(11) NOT NULL,
  `fetcherCode` varchar(255) NOT NULL,
  `fetcherName` varchar(255) NOT NULL,
  `contactNum` int(20) NOT NULL,
  `regDate` date NOT NULL,
  `isActive` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fetcherfile`
--

INSERT INTO `fetcherfile` (`recid`, `fetcherCode`, `fetcherName`, `contactNum`, `regDate`, `isActive`) VALUES
(1, 'fetcher1', 'asdfasdf', 567567, '2024-06-01', 1),
(2, 'fetcher2', 'sample fetcher 2', 456456, '2024-06-06', 0),
(3, 'fetcher3', 'fetcher3Name', 657567567, '2024-06-05', 1),
(4, 'fetcher4', 'fetcher4Name', 65756756, '2024-06-04', 0),
(6, 'fetcher5', 'fetcher5Name', 4565645, '2024-06-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentfile`
--

CREATE TABLE `studentfile` (
  `recid` int(11) NOT NULL,
  `studentcode` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentfile`
--

INSERT INTO `studentfile` (`recid`, `studentcode`, `fullname`) VALUES
(1, 'S001', 'Alice Johnson'),
(2, 'S002', 'Bob Smith'),
(3, 'S003', 'Charlie Brown'),
(4, 'S004', 'Diana Prince'),
(5, 'S005', 'Edward Norton'),
(6, 'S006', 'Fiona Gallagher'),
(7, 'S007', 'George Harrison'),
(8, 'S008', 'Hannah Montana'),
(9, 'S009', 'Ian Curtis'),
(10, 'S010', 'Jane Austen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`recid`);

--
-- Indexes for table `fetcherfile`
--
ALTER TABLE `fetcherfile`
  ADD PRIMARY KEY (`recid`),
  ADD UNIQUE KEY `fetcherCode` (`fetcherCode`);

--
-- Indexes for table `studentfile`
--
ALTER TABLE `studentfile`
  ADD PRIMARY KEY (`recid`),
  ADD UNIQUE KEY `studentcode` (`studentcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `recid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `fetcherfile`
--
ALTER TABLE `fetcherfile`
  MODIFY `recid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `studentfile`
--
ALTER TABLE `studentfile`
  MODIFY `recid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
