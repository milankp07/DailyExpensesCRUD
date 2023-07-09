-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2023 at 09:47 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysqldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_expenses`
--

CREATE TABLE `daily_expenses` (
  `Id` int(11) NOT NULL,
  `Product_Name` varchar(100) NOT NULL,
  `Buying_Description` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Purchased_By` varchar(50) NOT NULL,
  `Date_Purchased` date NOT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  `Date_Created` date NOT NULL,
  `Date_Modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_expenses`
--

INSERT INTO `daily_expenses` (`Id`, `Product_Name`, `Buying_Description`, `Price`, `Purchased_By`, `Date_Purchased`, `Remarks`, `Date_Created`, `Date_Modified`) VALUES
(13, 'Groceries', '2 Pack Snacks, 4 Pack Biscuits', 200, 'Hari Chandan Pani', '2023-04-10', 'From JioMart', '2023-07-09', '2023-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `login_users`
--

CREATE TABLE `login_users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Created_At` date NOT NULL,
  `Modified_At` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_users`
--

INSERT INTO `login_users` (`Id`, `Username`, `Password`, `Created_At`, `Modified_At`) VALUES
(1, 'Milan', 'milan@123', '2023-07-08', NULL),
(2, 'Srusti ', 'srusti@123', '2023-07-09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `select_options`
--

CREATE TABLE `select_options` (
  `Id` int(11) NOT NULL,
  `Value` varchar(50) NOT NULL,
  `Display_Name` varchar(100) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Date_Created` date NOT NULL,
  `Date_Modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `select_options`
--

INSERT INTO `select_options` (`Id`, `Value`, `Display_Name`, `Type`, `Date_Created`, `Date_Modified`) VALUES
(1, 'Srustisneha Dash', 'Srustisneha Dash', 'Purchased_By', '2023-07-09', NULL),
(2, 'Milan Kumar Pani', 'Milan Kumar Pani', 'Purchased_By', '2023-07-09', NULL),
(3, 'Hari Chandan Pani', 'Hari Chandan Pani', 'Purchased_By', '2023-07-09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_expenses`
--
ALTER TABLE `daily_expenses`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `login_users`
--
ALTER TABLE `login_users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `select_options`
--
ALTER TABLE `select_options`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_expenses`
--
ALTER TABLE `daily_expenses`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `login_users`
--
ALTER TABLE `login_users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `select_options`
--
ALTER TABLE `select_options`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
