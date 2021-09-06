-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2021 at 08:20 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen_masuk`
--

CREATE TABLE `absen_masuk` (
  `id_absen` int(11) UNSIGNED NOT NULL COMMENT 'id absensi',
  `userid` int(10) NOT NULL COMMENT 'user id pengguna',
  `tgl_masuk` date DEFAULT NULL COMMENT 'tanggal absen',
  `jam_masuk` time DEFAULT NULL COMMENT 'jam absen masuk',
  `tgl_keluar` date DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL COMMENT 'jam pulang kerja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen_masuk`
--

INSERT INTO `absen_masuk` (`id_absen`, `userid`, `tgl_masuk`, `jam_masuk`, `tgl_keluar`, `jam_keluar`) VALUES
(1, 1, '2021-09-05', '22:12:45', NULL, NULL),
(2, 1, '2021-09-06', '08:15:12', '2021-09-06', '08:15:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen_masuk`
--
ALTER TABLE `absen_masuk`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_absen` (`id_absen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen_masuk`
--
ALTER TABLE `absen_masuk`
  MODIFY `id_absen` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id absensi', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
