-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 04:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengumpulan_tugas`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailtugas`
--

CREATE TABLE `detailtugas` (
  `idDetailTugas` int(11) NOT NULL,
  `idMk` int(11) DEFAULT NULL,
  `namaTugas` varchar(255) NOT NULL,
  `linkTugas` varchar(255) DEFAULT NULL,
  `tglKumpul` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idMhs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `idMhs` int(11) NOT NULL,
  `namaMhs` varchar(255) NOT NULL,
  `jurusanMhs` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`idMhs`, `namaMhs`, `jurusanMhs`, `username`, `password`, `role`) VALUES
(1, 'Andreas', 'Informatika', 'andreas', 'password', ''),
(2, 'Admin', '-', 'admin', 'admin', 'admin'),
(3, 'Queeny', 'Manajemen', 'queeny', 'password', '');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `idMk` int(11) NOT NULL,
  `namaMk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`idMk`, `namaMk`) VALUES
(1, 'Pemrograman Web'),
(7, 'Pendidikan Agama'),
(8, 'Pendidikan Pancasila');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailtugas`
--
ALTER TABLE `detailtugas`
  ADD PRIMARY KEY (`idDetailTugas`),
  ADD KEY `idMk` (`idMk`),
  ADD KEY `idMhs` (`idMhs`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`idMhs`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`idMk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailtugas`
--
ALTER TABLE `detailtugas`
  MODIFY `idDetailTugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `idMhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `idMk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailtugas`
--
ALTER TABLE `detailtugas`
  ADD CONSTRAINT `detailtugas_ibfk_1` FOREIGN KEY (`idMk`) REFERENCES `matakuliah` (`idMk`),
  ADD CONSTRAINT `detailtugas_ibfk_2` FOREIGN KEY (`idMhs`) REFERENCES `mahasiswa` (`idMhs`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
