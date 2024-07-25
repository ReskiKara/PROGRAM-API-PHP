-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 02:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jadwal`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwalkereta`
--

CREATE TABLE `jadwalkereta` (
  `id` int(11) NOT NULL,
  `nama_kereta` varchar(100) NOT NULL,
  `stasiun_asal` varchar(100) NOT NULL,
  `stasiun_tujuan` varchar(100) NOT NULL,
  `waktu_berangkat` datetime NOT NULL,
  `waktu_tiba` datetime NOT NULL,
  `harga_tiket` decimal(10,2) NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwalkereta`
--

INSERT INTO `jadwalkereta` (`id`, `nama_kereta`, `stasiun_asal`, `stasiun_tujuan`, `waktu_berangkat`, `waktu_tiba`, `harga_tiket`, `kelas`) VALUES
(1, 'Argo Bromo Anggrek', 'Gambir', 'Surabaya Pasarturi', '2024-06-08 08:00:00', '2024-06-08 16:00:00', 450000.00, 'Eksekutif'),
(2, 'Taksaka', 'Gambir', 'Yogyakarta', '2024-06-08 09:00:00', '2024-06-08 15:00:00', 350000.00, 'Bisnis'),
(3, 'Matarmaja', 'Pasar Senen', 'Malang', '2024-06-08 10:00:00', '2024-06-08 20:00:00', 150000.00, 'Ekonomi'),
(4, 'Turbo', 'makassar', 'pare-pare', '2024-06-08 08:00:00', '2024-06-09 16:00:00', 500000.00, 'Eksekutif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwalkereta`
--
ALTER TABLE `jadwalkereta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwalkereta`
--
ALTER TABLE `jadwalkereta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
