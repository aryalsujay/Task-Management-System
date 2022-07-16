-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2022 at 07:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STR` (`x` VARCHAR(255), `delim` VARCHAR(12), `pos` INT) RETURNS VARCHAR(255) CHARSET utf8mb4 DETERMINISTIC BEGIN
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
(258, 43, 431, 4, 'Assigned to Amar', 0),
(259, 43, 432, 5, 'Assigned to Sujay', 0),
(260, 43, 431, 4, 'Need Clarification', 0),
(261, 0, 431, 4, 'Reassigned to ', 0),
(262, 43, 431, 4, 'Completed', 0),
(263, 0, 431, 4, 'Completed!', 1),
(264, 43, 432, 5, 'Completed', 0),
(265, 32, 322, 4, 'Assigned to Amar', 0),
(266, 31, 312, 5, 'Assigned to Sujay', 0),
(267, 31, 312, 5, 'Need Clarification', 0),
(268, 32, 322, 4, 'Completed', 0);

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
(31, 'Column Maintain', 'Rows to Column\r\nPivot option in mysql to use\r\nassign user'),
(32, 'Create a view', 'Create user and admin\r\nCreate skeleton structure for tables and view\r\nInsert data in table'),
(43, 'Create final report', 'Dashboard panel\r\nCount with links\r\nSeperate via hyperlink');

-- --------------------------------------------------------

--
-- Table structure for table `tdetail`
--

CREATE TABLE `tdetail` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `uid` int(12) NOT NULL,
  `assigned` int(12) NOT NULL,
  `t1` varchar(200) NOT NULL,
  `t2` varchar(200) NOT NULL,
  `t3` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tdetail`
--

INSERT INTO `tdetail` (`id`, `tid`, `uid`, `assigned`, `t1`, `t2`, `t3`) VALUES
(24, 31, 1, 1, 'Rows to Column\r', 'Pivot option in mysql to use\r', 'assign user'),
(25, 32, 1, 1, 'Create user and admin\r', 'Create skeleton structure for tables and view\r', 'Insert data in table'),
(26, 33, 1, 1, 'Option display in the table\r', 'Add assign option alongside\r', 'Assigned and Unassigned signal to be displayed'),
(27, 34, 4, 1, 'View All Task for Admin\r', 'Seperate Assigned and Unassigned\r', 'Assign Unassigned tasks'),
(31, 38, 0, 0, '1\r', '2\r', '3'),
(32, 39, 0, 0, '1\r', '2\r', '3'),
(33, 40, 0, 0, '1\r', '2\r', '3'),
(34, 41, 0, 0, '123\r', '2\r', '3'),
(35, 42, 0, 0, 'd\r', 'd\r', 'd'),
(36, 43, 0, 0, 'Dashboard panel\r', 'Count with links\r', 'Seperate via hyperlink');

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
  `t1` varchar(255) NOT NULL,
  `t2` varchar(255) NOT NULL,
  `t3` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trows`
--

INSERT INTO `trows` (`id`, `tid`, `stid`, `uid`, `status`, `t1`, `t2`, `t3`, `note`) VALUES
(4, '31', 311, 0, '', 'Rows to Column\r', '', '', ''),
(5, '31', 312, 5, 'Need Clarification', '', 'Pivot option in mysql to use\r', '', ' | '),
(6, '31', 313, 0, '', '', '', 'assign user', ''),
(7, '32', 321, 0, '', 'Create user and admin\r', '', '', ''),
(8, '32', 322, 4, 'Completed', '', 'Create skeleton structure for tables and view\r', '', ' | '),
(9, '32', 323, 0, '', '', '', 'Insert data in table', ''),
(37, '43', 431, 4, 'Completed!', 'Dashboard panel\r', '', '', ' | style? |Lead: you know u can make | pls check email for sketch | '),
(38, '43', 432, 5, 'Completed', '', 'Count with links\r', '', ' | '),
(39, '43', 433, 0, '', '', '', 'Seperate via hyperlink', '');

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
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tdetail`
--
ALTER TABLE `tdetail`
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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tdetail`
--
ALTER TABLE `tdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `trows`
--
ALTER TABLE `trows`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
