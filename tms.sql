-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2022 at 02:42 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STR` (`x` VARCHAR(255), `delim` VARCHAR(12), `pos` INT) RETURNS VARCHAR(255) CHARSET utf8mb4 BEGIN
                  RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
                     LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
                     delim, '
');
              END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(11) NOT NULL,
  `type` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `pass`, `type`) VALUES
(1, 'admin', 'admin@tms.com', '1', 'Admin'),
(2, 'sadmin', 'sadmin@tms.com', '1', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(12) NOT NULL,
  `tid` int(12) NOT NULL,
  `stid` int(12) NOT NULL,
  `uid` int(12) NOT NULL,
  `note` varchar(255) NOT NULL,
  `done` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `tid`, `stid`, `uid`, `note`, `done`) VALUES
(312, 48, 481, 4, 'Assigned to Amar', 0),
(313, 48, 482, 5, 'Assigned to Sujay', 0),
(314, 48, 482, 5, 'Need Clarification', 0),
(315, 47, 471, 5, 'Completed', 0),
(316, 48, 482, 4, 'Reassigned to Amar - Admin', 0),
(317, 47, 471, 4, 'Reassigned to Amar - Manager', 0),
(318, 47, 471, 4, 'Completed!', 1),
(319, 48, 482, 5, 'Completed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `stid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `stid`, `uid`, `note`) VALUES
(1, 471, 4, ' | how | ok |  |  |Manager:  |Manager:  | '),
(2, 472, 0, ''),
(3, 473, 0, ''),
(4, 474, 0, ''),
(5, 481, 0, ''),
(6, 482, 5, ' |  |  |  |  |  |Lead: ok now |Lead:  |Lead:  |Lead:  |Lead:  | '),
(7, 483, 0, ''),
(8, 484, 0, ''),
(9, 485, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `tname` varchar(50) NOT NULL,
  `detail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `tname`, `detail`) VALUES
(47, 'new note', 'add\r\nnew now\r\nhow\r\nwhen'),
(48, 'Create final report', 'Dashboard panel\r\nCount with links\r\nSeperate via hyperlink\r\nCreate skeleton structure for tables and view\r\nInsert data in table');

-- --------------------------------------------------------

--
-- Table structure for table `trows`
--

CREATE TABLE `trows` (
  `id` int(12) NOT NULL,
  `tid` decimal(12,0) NOT NULL,
  `stid` double NOT NULL,
  `uid` int(12) NOT NULL,
  `status` varchar(255) NOT NULL,
  `t1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trows`
--

INSERT INTO `trows` (`id`, `tid`, `stid`, `uid`, `status`, `t1`) VALUES
(52, '47', 471, 4, 'Completed!', 'add\r'),
(53, '47', 472, 0, '', 'new now\r'),
(54, '47', 473, 1, 'Need Clarification', 'how\r'),
(55, '47', 474, 0, '', 'when'),
(56, '48', 481, 4, '', 'Dashboard panel\r'),
(57, '48', 482, 4, 'Completed', 'Count with links\r'),
(58, '48', 483, 0, '', 'Seperate via hyperlink\r'),
(59, '48', 484, 0, '', 'Create skeleton structure for tables and view\r'),
(60, '48', 485, 0, '', 'Insert data in table');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `pass`, `type`) VALUES
(1, 'Pragun', 'pragun@tms.com', '1', 'Member'),
(4, 'Amar', 'amar@tms.com', '1', 'Member'),
(5, 'Sujay', 'aryalsujay@gmail.com', '1', 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trows`
--
ALTER TABLE `trows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `trows`
--
ALTER TABLE `trows`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
