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
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mapel` int(11) NOT NULL,
  `kd_kelompok` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `kd_mapel` varchar(4) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mapel`, `kd_kelompok`, `urutan`, `kd_mapel`, `nama_mapel`) VALUES
(1, 3, 1, 'PAI', 'Pendidikan Agama Islam dan Budi Pekerti'),
(2, 3, 1, 'PP', 'Pendidikan Pancasila'),
(3, 5, 1, 'BIN', 'Bahasa Indonesia'),
(4, 3, 3, 'MTK', 'Matematika'),
(5, 3, 4, 'IPAS', 'Ilmu Pengetahuan Alam dan Sosial'),
(6, 3, 5, 'PJOK', 'Pendidikan Jasmani Olahraga dan Kesehatan'),
(7, 4, 1, 'SR', 'Seni Rupa'),
(8, 5, 2, 'BIG', 'Bahasa Inggris'),
(9, 5, 3, 'BID', 'Bahasa Indramayu'),
(11, 5, 4, 'BJW', 'Bahasa Jawa'),
(13, 3, 3, 'MAT', 'MATEMATIKA TERAPAN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mapel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
