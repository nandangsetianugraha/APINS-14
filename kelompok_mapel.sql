-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 07:43 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apins`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_mapel`
--

CREATE TABLE `kelompok_mapel` (
  `id_kelompok` int(11) NOT NULL,
  `kurikulum` varchar(50) DEFAULT NULL,
  `kelompok` varchar(50) NOT NULL,
  `urut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok_mapel`
--

INSERT INTO `kelompok_mapel` (`id_kelompok`, `kurikulum`, `kelompok`, `urut`) VALUES
(1, 'Kurikulum 2013', 'Kelompok A', 1),
(2, 'Kurikulum 2013', 'Kelompok B', 2),
(3, 'Kurikulum Merdeka', 'Wajib', 1),
(4, 'Kurikulum Merdeka', 'Muatan Lokal', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelompok_mapel`
--
ALTER TABLE `kelompok_mapel`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelompok_mapel`
--
ALTER TABLE `kelompok_mapel`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
