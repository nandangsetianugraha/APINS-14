-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 07:46 AM
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
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `sekolah_id` varchar(36) DEFAULT NULL,
  `nama` varchar(18) DEFAULT NULL,
  `nss` bigint(12) DEFAULT NULL,
  `npsn` int(8) DEFAULT NULL,
  `bentuk_pendidikan_id` int(1) DEFAULT NULL,
  `alamat_jalan` varchar(25) DEFAULT NULL,
  `rt` int(1) DEFAULT NULL,
  `rw` int(1) DEFAULT NULL,
  `desa` varchar(20) DEFAULT NULL,
  `kecamatan` varchar(10) DEFAULT NULL,
  `kabupaten` varchar(4) DEFAULT NULL,
  `provinsi` varchar(2) NOT NULL,
  `kode_pos` int(5) DEFAULT NULL,
  `lintang` varchar(100) DEFAULT NULL,
  `bujur` varchar(100) DEFAULT NULL,
  `nomor_telepon` varchar(14) DEFAULT NULL,
  `nomor_fax` varchar(10) DEFAULT NULL,
  `email` varchar(22) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `kebutuhan_khusus_id` int(1) DEFAULT NULL,
  `status_sekolah` int(1) DEFAULT NULL,
  `sk_pendirian_sekolah` varchar(17) DEFAULT NULL,
  `tanggal_sk_pendirian` varchar(8) DEFAULT NULL,
  `visimisi` text DEFAULT NULL,
  `kurikulum` text DEFAULT NULL,
  `sk_izin_operasional` varchar(25) DEFAULT NULL,
  `tanggal_sk_izin_operasional` varchar(10) DEFAULT NULL,
  `no_rekening` bigint(13) DEFAULT NULL,
  `nama_bank` varchar(17) DEFAULT NULL,
  `cabang_kcp_unit` varchar(11) DEFAULT NULL,
  `rekening_atas_nama` varchar(18) DEFAULT NULL,
  `mbs` int(1) DEFAULT NULL,
  `luas_tanah_milik` int(4) DEFAULT NULL,
  `luas_tanah_bukan_milik` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`sekolah_id`, `nama`, `nss`, `npsn`, `bentuk_pendidikan_id`, `alamat_jalan`, `rt`, `rw`, `desa`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `lintang`, `bujur`, `nomor_telepon`, `nomor_fax`, `email`, `website`, `kebutuhan_khusus_id`, `status_sekolah`, `sk_pendirian_sekolah`, `tanggal_sk_pendirian`, `visimisi`, `kurikulum`, `sk_izin_operasional`, `tanggal_sk_izin_operasional`, `no_rekening`, `nama_bank`, `cabang_kcp_unit`, `rekening_atas_nama`, `mbs`, `luas_tanah_milik`, `luas_tanah_bukan_milik`) VALUES
('20162e13-2cf5-e011-91d5-a9ab0de328a2', 'SD ISLAM AL-JANNAH', 102021803031, 20258088, 5, 'Jl. Raya Gabuswetan No. 1', 5, 1, '3212030008', '3212030', '3212', '32', 45263, '-6.416400', '108.080500', '(0234) 5508501', '', 'sdi.aljannah@gmail.com', 'https://sdi-aljannah.web.id', 0, 2, '', '', '3', '', '', '', 0, '', '', '', 1, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD UNIQUE KEY `sekolah_id` (`sekolah_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
