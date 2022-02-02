-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 02:01 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `majadomaciphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `arena`
--

CREATE TABLE `arena` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) NOT NULL,
  `adresa` varchar(100) NOT NULL,
  `kapacitet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arena`
--

INSERT INTO `arena` (`id`, `naziv`, `adresa`, `kapacitet`) VALUES
(1, 'Stark Arena', 'Bulevar Arsenija Carnojevica 58', 19394),
(2, 'Kombank dvorana', 'Decanska 14', 2200),
(5, 'Tasmajdan Stadion', 'Ilije Garasanina 24', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `koncerti`
--

CREATE TABLE `koncerti` (
  `id` int(11) NOT NULL,
  `izvodjac` varchar(30) NOT NULL,
  `datum` date NOT NULL,
  `vreme` time NOT NULL,
  `arenaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `koncerti`
--

INSERT INTO `koncerti` (`id`, `izvodjac`, `datum`, `vreme`, `arenaID`) VALUES
(1, 'Iron Maiden', '2022-05-24', '22:00:00', 1),
(5, 'Ed Sheeran', '2022-05-29', '20:55:00', 1),
(6, 'JL', '2022-02-25', '16:55:00', 1),
(16, 'Linkin Park', '2022-03-02', '02:00:00', 2),
(17, 'duiahsidou', '2022-02-23', '02:20:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'maja', '123');

-- --------------------------------------------------------

--
-- Stand-in structure for view `myview`
-- (See below for the actual view)
--
CREATE TABLE `myview` (
`koncertID` int(11)
,`izvodjac` varchar(30)
,`datum` date
,`vreme` time
,`arenaId` int(11)
,`nazivArene` varchar(30)
,`adresaArene` varchar(100)
,`kapacitetArene` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `myview`
--
DROP TABLE IF EXISTS `myview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `myview`  AS SELECT `koncerti`.`id` AS `koncertID`, `koncerti`.`izvodjac` AS `izvodjac`, `koncerti`.`datum` AS `datum`, `koncerti`.`vreme` AS `vreme`, `arena`.`id` AS `arenaId`, `arena`.`naziv` AS `nazivArene`, `arena`.`adresa` AS `adresaArene`, `arena`.`kapacitet` AS `kapacitetArene` FROM (`arena` join `koncerti` on(`koncerti`.`arenaID` = `arena`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arena`
--
ALTER TABLE `arena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koncerti`
--
ALTER TABLE `koncerti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arena`
--
ALTER TABLE `arena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `koncerti`
--
ALTER TABLE `koncerti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
