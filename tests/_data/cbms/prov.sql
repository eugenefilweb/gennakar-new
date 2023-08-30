-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2022 at 01:33 AM
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
-- Table structure for table `prov`
--

CREATE TABLE `prov` (
  `provID` varchar(9) NOT NULL DEFAULT '',
  `Province` varchar(50) DEFAULT NULL,
  `provPath` varchar(33) DEFAULT NULL,
  `regn` tinyint(2) DEFAULT NULL,
  `prov` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prov`
--

INSERT INTO `prov` (`Province`, `regn`, `prov`) VALUES
('ILOCOS NORTE', 1, 28),
('ILOCOS SUR', 1, 29),
('LA UNION', 1, 33),
('PANGASINAN', 1, 55),
('BATANES', 2, 9),
('CAGAYAN', 2, 15),
('ISABELA', 2, 31),
('NUEVA VIZCAYA', 2, 50),
('QUIRINO', 2, 57),
('BATAAN', 3, 8),
('BULACAN', 3, 14),
('NUEVA ECIJA', 3, 49),
('PAMPANGA', 3, 54),
('TARLAC', 3, 69),
('ZAMBALES', 3, 71),
('AURORA', 3, 77),
('BATANGAS', 4, 10),
('CAVITE', 4, 21),
('LAGUNA', 4, 34),
('QUEZON', 4, 56),
('RIZAL', 4, 58),
('ALBAY', 5, 5),
('CAMARINES NORTE', 5, 16),
('CAMARINES SUR', 5, 17),
('CATANDUANES', 5, 20),
('MASBATE', 5, 41),
('SORSOGON', 5, 62),
('AKLAN', 6, 4),
('ANTIQUE', 6, 6),
('CAPIZ', 6, 19),
('ILOILO', 6, 30),
('NEGROS OCCIDENTAL', 6, 45),
('GUIMARAS', 6, 79),
('BOHOL', 7, 12),
('CEBU', 7, 22),
('NEGROS ORIENTAL', 7, 46),
('SIQUIJOR', 7, 61),
('EASTERN SAMAR', 8, 26),
('LEYTE', 8, 37),
('NORTHERN SAMAR', 8, 48),
('SAMAR (WESTERN SAMAR)', 8, 60),
('SOUTHERN LEYTE', 8, 64),
('BILIRAN', 8, 78),
('ZAMBOANGA DEL NORTE', 9, 72),
('ZAMBOANGA DEL SUR', 9, 73),
('ZAMBOANGA SIBUGAY', 9, 83),
('BUKIDNON', 10, 13),
('CAMIGUIN', 10, 18),
('LANAO DEL NORTE', 10, 35),
('MISAMIS OCCIDENTAL', 10, 42),
('MISAMIS ORIENTAL', 10, 43),
('DAVAO (DAVAO DEL NORTE)', 11, 23),
('DAVAO DEL SUR', 11, 24),
('DAVAO ORIENTAL', 11, 25),
('COMPOSTELA VALLEY', 11, 82),
('COTABATO (NORTH COTABATO)', 12, 47),
('SOUTH COTABATO', 12, 63),
('SULTAN KUDARAT', 12, 65),
('SARANGANI', 12, 80),
('COTABATO CITY', 12, 98),
('NCR - Manila', 13, 39),
('NCR 2', 13, 74),
('NCR 3', 13, 75),
('NCR 4', 13, 76),
('ABRA', 14, 1),
('BENGUET', 14, 11),
('IFUGAO', 14, 27),
('KALINGA', 14, 32),
('MOUNTAIN PROVINCE', 14, 44),
('APAYAO', 14, 81),
('BASILAN', 15, 7),
('LANAO DEL SUR', 15, 36),
('MAGUINDANAO', 15, 38),
('SULU', 15, 66),
('TAWI-TAWI', 15, 70),
('AGUSAN DEL NORTE', 16, 2),
('AGUSAN DEL SUR', 16, 3),
('SURIGAO DEL NORTE', 16, 67),
('SURIGAO DEL SUR', 16, 68),
('DINAGAT ISLANDS', 16, 85),
('MARINDUQUE', 17, 40),
('OCCIDENTAL MINDORO', 17, 51),
('ORIENTAL MINDORO', 17, 52),
('PALAWAN', 17, 53),
('ROMBLON', 17, 59);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prov`
--
ALTER TABLE `prov`
  ADD PRIMARY KEY (`provID`),
  ADD KEY `provIndex` (`regn`,`prov`,`provID`,`Province`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
