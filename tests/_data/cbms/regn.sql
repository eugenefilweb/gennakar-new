-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2022 at 01:32 AM
-- Server version: 5.5.16-log
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `regn`
--

CREATE TABLE `regn` (
  `country` smallint(3) DEFAULT NULL,
  `regnID` varchar(9) NOT NULL DEFAULT '',
  `Region` varchar(50) DEFAULT NULL,
  `regnPath` varchar(30) DEFAULT NULL,
  `regn` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regn`
--

INSERT INTO `regn` (`country`, `Region`, `regn`) VALUES
(608, 'I - ILOCOS REGION', 1),
(608, 'II - CAGAYAN VALLEY', 2),
(608, 'III - CENTRAL LUZON', 3),
(608, 'IVA - SOUTHERN TAGALOG (CALABARZON)', 4),
(608, 'V - BICOL REGION', 5),
(608, 'VI - WESTERN VISAYAS', 6),
(608, 'VII - CENTRAL VISAYAS', 7),
(608, 'VIII - EASTERN VISAYAS', 8),
(608, 'IX - ZAMBOANGA PENINSULA', 9),
(608, 'X - NORTHERN MINDANAO', 10),
(608, 'XI - DAVAO REGION', 11),
(608, 'XII - SOCCSKSARGEN', 12),
(608, 'NCR - NATIONAL CAPITAL REGION', 13),
(608, 'CAR - CORDILLERA ADMINISTRATIVE REGION', 14),
(608, 'ARMM - AUTONOMUS REGION IN MUSLIM MINDANAO', 15),
(608, 'XIII - CARAGA', 16),
(608, 'IVB - SOUTHERN TAGALOG (MIMAROPA)', 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regn`
--
ALTER TABLE `regn`
  ADD PRIMARY KEY (`regnID`),
  ADD KEY `regnIndex` (`country`,`regn`,`regnID`,`Region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
