-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 08:02 AM
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
-- Table structure for table `jenis_ptk`
--

CREATE TABLE `jenis_ptk` (
  `jenis_ptk_id` int(11) NOT NULL,
  `jenis_ptk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_ptk`
--

INSERT INTO `jenis_ptk` (`jenis_ptk_id`, `jenis_ptk`) VALUES
(5, 'Tenaga Administrasi'),
(6, 'Guru Inklusi'),
(11, 'Operator Sekolah'),
(13, 'Guru Magang'),
(40, 'Pustakawan'),
(93, 'Guru Mapel'),
(94, 'Guru Bahasa Inggris'),
(95, 'Guru Penjaskes'),
(96, 'Guru Pendidikan Agama'),
(97, 'Guru Pendamping'),
(98, 'Guru Kelas'),
(99, 'Kepala Sekolah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_ptk`
--
ALTER TABLE `jenis_ptk`
  ADD UNIQUE KEY `jenis_ptk_id_2` (`jenis_ptk_id`),
  ADD KEY `jenis_ptk_id` (`jenis_ptk_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
