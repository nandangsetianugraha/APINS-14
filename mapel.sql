-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2024 at 11:02 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_demos`
--

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `kd_kelompok` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `kd_mapel` varchar(4) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `kd_kelompok`, `urutan`, `kd_mapel`, `nama_mapel`) VALUES
(1, 1, 1, 'PAI', 'Pendidikan Agama dan Budi Pekerti'),
(2, 1, 2, 'PKn', 'Pendidikan Pancasila dan Kewarganegaraan'),
(3, 1, 3, 'BIN', 'Bahasa Indonesia'),
(4, 1, 4, 'MTK', 'Matematika'),
(5, 1, 5, 'IPA', 'Ilmu Pengetahuan Alam'),
(6, 1, 6, 'IPS', 'Ilmu Pengetahuan Sosial'),
(7, 2, 2, 'SBK', 'Seni Budaya dan Prakarya'),
(8, 2, 1, 'PJK', 'Pendidikan Jasmani Olahraga dan Kesehatan'),
(9, 2, 4, 'BID', 'Bahasa Indramayu'),
(10, 2, 5, 'BIG', 'Bahasa Inggris'),
(11, 2, 3, 'PBP', 'Pendidikan Budi Pekerti');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
