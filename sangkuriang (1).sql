-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2023 at 11:28 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sangkuriang`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_harini`
--

CREATE TABLE `r_harini` (
  `tggl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `r_harini`
--

INSERT INTO `r_harini` (`tggl`) VALUES
('2023-06-24 11:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `t_gunor`
--

CREATE TABLE `t_gunor` (
  `idGuru` char(4) NOT NULL,
  `jenis` char(1) NOT NULL,
  `tgMasuk` date NOT NULL,
  `GaPok` int(11) NOT NULL,
  `idxHR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_gunor`
--

INSERT INTO `t_gunor` (`idGuru`, `jenis`, `tgMasuk`, `GaPok`, `idxHR`) VALUES
('AB01', 'D', '2023-04-06', 700000, 500000),
('AN01', 'D', '2023-04-06', 1000000, 1500000),
('BA01', 'D', '2023-04-06', 450000, 600000),
('BU01', 'D', '2023-04-06', 0, 0),
('DI01', 'D', '2023-04-06', 650000, 450000),
('FI01', 'D', '2023-04-06', 550000, 650000),
('HA01', '?', '2023-06-24', 0, 0),
('KE01', '?', '2023-06-24', 0, 0),
('KI01', 'D', '2023-04-06', 750000, 350000),
('SU01', '?', '2023-04-06', 0, 0),
('WA01', '?', '2023-04-06', 0, 0),
('YU01', '?', '2023-04-06', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_guri`
--

CREATE TABLE `t_guri` (
  `idGuru` char(4) NOT NULL,
  `idTari` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_guri`
--

INSERT INTO `t_guri` (`idGuru`, `idTari`) VALUES
('AB01', 'JA01'),
('AN01', 'PE01'),
('DI01', 'SE01');

-- --------------------------------------------------------

--
-- Table structure for table `t_guru`
--

CREATE TABLE `t_guru` (
  `ID` char(4) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `JK` char(1) NOT NULL,
  `tpLahir` varchar(15) NOT NULL,
  `tgLahir` date NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `noHP` varchar(14) NOT NULL,
  `aktif` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_guru`
--

INSERT INTO `t_guru` (`ID`, `nama`, `JK`, `tpLahir`, `tgLahir`, `alamat`, `noHP`, `aktif`) VALUES
('AB01', 'Abimanyu', 'P', 'Malang', '2023-04-06', 'Jl. Wahid Hashyim 27', '085460005542', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_sista`
--

CREATE TABLE `t_sista` (
  `no_regis` char(11) NOT NULL,
  `nama_siswa` varchar(20) NOT NULL,
  `kode_tari` char(4) NOT NULL,
  `metode_latihan` char(1) NOT NULL,
  `periode` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_siswa`
--

CREATE TABLE `t_siswa` (
  `ID` char(6) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `JK` char(1) NOT NULL,
  `tpLahir` varchar(15) NOT NULL,
  `tgLahir` date NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `noHP` varchar(14) NOT NULL,
  `tgMasuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_siswa`
--

INSERT INTO `t_siswa` (`ID`, `nama`, `JK`, `tpLahir`, `tgLahir`, `alamat`, `noHP`, `tgMasuk`) VALUES
('230001', 'arya', 'L', 'Pekalongan', '2000-10-24', 'Pekalongan', '08193278123', '2023-06-01'),
('230002', 'HakimLuqmanul', 'P', 'malang', '2023-06-15', 'merjosari', '08651323123', '2023-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `t_tari`
--

CREATE TABLE `t_tari` (
  `kode` char(4) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jenis` char(1) NOT NULL,
  `lama` tinyint(4) NOT NULL,
  `aktif` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_tari`
--

INSERT INTO `t_tari` (`kode`, `nama`, `jenis`, `lama`, `aktif`) VALUES
('BR01', 'Breakdance', 'M', 5, 'T'),
('JA01', 'Jaipong', 'D', 4, 'Y'),
('PA01', 'Padang', 'D', 5, 'T'),
('PE01', 'Pendet', 'D', 4, 'Y'),
('SE01', 'Serimpi', 'D', 4, 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_gunor`
--
ALTER TABLE `t_gunor`
  ADD PRIMARY KEY (`idGuru`);

--
-- Indexes for table `t_guru`
--
ALTER TABLE `t_guru`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `t_tari`
--
ALTER TABLE `t_tari`
  ADD PRIMARY KEY (`kode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
