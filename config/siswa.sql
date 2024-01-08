-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2024 at 06:00 PM
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
-- Database: `apins10`
--

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `peserta_didik_id` varchar(36) NOT NULL DEFAULT '',
  `nis` varchar(9) NOT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `jk` varchar(1) DEFAULT NULL,
  `tempat` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `agama` int(11) NOT NULL DEFAULT 1,
  `pend_sebelum` varchar(100) NOT NULL,
  `alamat` varchar(350) DEFAULT NULL,
  `nama_ayah` varchar(150) DEFAULT NULL,
  `nama_ibu` varchar(150) DEFAULT NULL,
  `no_wa` varchar(15) NOT NULL DEFAULT '085798869782',
  `pek_ayah` int(11) NOT NULL,
  `pek_ibu` int(11) NOT NULL,
  `jalan` varchar(100) NOT NULL,
  `kelurahan` varchar(20) NOT NULL,
  `kecamatan` varchar(20) NOT NULL,
  `kabupaten` varchar(20) NOT NULL,
  `provinsi` varchar(20) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `nasabah_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peserta_didik_id` (`peserta_didik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
