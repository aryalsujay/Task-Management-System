-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 07:00 PM
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
  `uid` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `tid`, `stid`, `uid`) VALUES
(178, 0, 0, 4),
(179, 31, 311, 4),
(180, 31, 312, 5),
(181, 31, 313, 4);

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
(33, 'Add user option', 'Option display in the table\r\nAdd assign option alongside\r\nAssigned and Unassigned signal to be displayed'),
(34, 'Create a Admin Panel', 'View All Task for Admin\r\nSeperate Assigned and Unassigned\r\nAssign Unassigned tasks');

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
(27, 34, 4, 1, 'View All Task for Admin\r', 'Seperate Assigned and Unassigned\r', 'Assign Unassigned tasks');

-- --------------------------------------------------------

--
-- Table structure for table `trows`
--

CREATE TABLE `trows` (
  `id` int(12) NOT NULL,
  `tid` decimal(12,0) NOT NULL,
  `stid` double NOT NULL,
  `uid` int(12) NOT NULL,
  `t1` varchar(255) NOT NULL,
  `t2` varchar(255) NOT NULL,
  `t3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trows`
--

INSERT INTO `trows` (`id`, `tid`, `stid`, `uid`, `t1`, `t2`, `t3`) VALUES
(4, '31', 311, 4, 'Rows to Column\r', '', ''),
(5, '31', 312, 5, '', 'Pivot option in mysql to use\r', ''),
(6, '31', 313, 4, '', '', 'assign user'),
(7, '32', 321, 0, 'Create user and admin\r', '', ''),
(8, '32', 322, 1, '', 'Create skeleton structure for tables and view\r', ''),
(9, '32', 323, 0, '', '', 'Insert data in table'),
(10, '33', 331, 0, 'Option display in the table\r', '', ''),
(11, '33', 332, 0, '', 'Add assign option alongside\r', ''),
(12, '33', 333, 0, '', '', 'Assigned and Unassigned signal to be displayed'),
(13, '34', 341, 0, 'View All Task for Admin\r', '', ''),
(14, '34', 342, 4, '', 'Seperate Assigned and Unassigned\r', ''),
(15, '34', 343, 0, '', '', 'Assign Unassigned tasks');

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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tdetail`
--
ALTER TABLE `tdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `trows`
--
ALTER TABLE `trows`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
