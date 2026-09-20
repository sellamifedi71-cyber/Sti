-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2026 at 10:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bacfedi`
--

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `idDoc` varchar(5) NOT NULL,
  `nomDoc` varchar(50) NOT NULL DEFAULT '',
  `dateCreation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`idDoc`, `nomDoc`, `dateCreation`) VALUES
('D0001', 'Liste employés.pdf', '2025-02-15 09:14:39'),
('D0002', 'Demande de congés.docx', '2021-10-09 08:10:09'),
('D0003', 'Réclamation ouvriers.docx', '2022-02-07 11:00:29'),
('D0004', 'Statistiques2024.xlsx', '2025-01-31 07:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `droit`
--

CREATE TABLE `droit` (
  `iddoc` varchar(5) NOT NULL,
  `idutil` varchar(4) NOT NULL,
  `ecriture` char(1) NOT NULL,
  `lecture` char(1) NOT NULL,
  `impression` char(1) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtil` varchar(4) NOT NULL,
  `nomPrenom` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtil`, `nomPrenom`) VALUES
('U001', 'Ali GAFSI'),
('U002', 'Mohamed SOUSSI'),
('U003', 'Karima TOUNSI'),
('U004', 'Kamel SFAXI'),
('U005', 'Houda JANDOUBI'),
('U006', 'Taoufik BEJI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`idDoc`);

--
-- Indexes for table `droit`
--
ALTER TABLE `droit`
  ADD PRIMARY KEY (`iddoc`,`idutil`),
  ADD KEY `fk2` (`idutil`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtil`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `droit`
--
ALTER TABLE `droit`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`iddoc`) REFERENCES `document` (`idDoc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`idutil`) REFERENCES `utilisateur` (`idUtil`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
