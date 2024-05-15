-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2024 at 08:32 AM
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
-- Database: `admin_nilai`
--

-- --------------------------------------------------------

--
-- Table structure for table `simpulan_proyek`
--

CREATE TABLE `simpulan_proyek` (
  `id_penilaian` int(11) NOT NULL,
  `peserta_didik_id` varchar(36) NOT NULL,
  `kelas` varchar(2) NOT NULL,
  `tapel` varchar(9) NOT NULL,
  `smt` int(11) NOT NULL,
  `proyek` int(11) NOT NULL,
  `simpulan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `simpulan_proyek`
--
ALTER TABLE `simpulan_proyek`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `simpulan_proyek`
--
ALTER TABLE `simpulan_proyek`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
