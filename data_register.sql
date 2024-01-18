-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 05:30 AM
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
-- Table structure for table `data_register`
--

CREATE TABLE `data_register` (
  `peserta_didik_id` varchar(36) NOT NULL DEFAULT '',
  `jns_daftar` int(11) NOT NULL,
  `tgl_masuk` varchar(10) DEFAULT NULL,
  `jns_mutasi` varchar(1) DEFAULT NULL,
  `tgl_mutasi` varchar(10) DEFAULT NULL,
  `noakta` varchar(100) DEFAULT NULL,
  `nokk` varchar(50) DEFAULT NULL,
  `lintang` varchar(25) DEFAULT NULL,
  `bujur` varchar(25) DEFAULT NULL,
  `alasan` varchar(19) DEFAULT NULL,
  `sekolah_mutasi` varchar(50) DEFAULT NULL,
  `nopes` varchar(100) DEFAULT NULL,
  `ijazah` varchar(100) DEFAULT NULL,
  `skhun` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_register`
--
ALTER TABLE `data_register`
  ADD PRIMARY KEY (`peserta_didik_id`),
  ADD KEY `peserta_didik_id` (`peserta_didik_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
