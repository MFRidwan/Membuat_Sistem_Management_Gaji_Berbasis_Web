-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 02:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management_gaji`
--

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `bulan` varchar(20) DEFAULT NULL,
  `total_gaji` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `karyawan_id`, `bulan`, `total_gaji`) VALUES
(1, 2, '2025-05', 2147483647),
(2, 2, 'April', 10),
(3, 2, 'April', 1000),
(4, 10, 'April', 11),
(5, 18, 'Mei', 90),
(6, 5, 'Agustus', 33),
(7, 15, 'April', 111),
(8, 3, 'Januari', 10000000),
(9, 2, 'April', 7888),
(10, 10, 'mei', 909090909),
(11, 2, 'April', 900000000),
(12, 14, 'November', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(100) DEFAULT NULL,
  `gaji_pokok` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `gaji_pokok`, `deskripsi`) VALUES
(1, 'Manager', 3, NULL),
(2, 'Supervisor', 7000000, NULL),
(3, 'Staff', 5000000, NULL),
(5, 'Trader', 1000000000, NULL),
(6, 'Petani', 900000, NULL),
(7, 'Trader', 1000000000, NULL),
(8, 'Presiden', 10000, NULL),
(9, 'CEO', 2147483647, NULL),
(12, 'hahaha', 771771, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `tanggal_bergabung` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `jenis_kelamin`, `jabatan`, `alamat`, `no_hp`, `tanggal_bergabung`, `foto`, `jabatan_id`) VALUES
(2, 'M Fauzi Ridwan', 'Laki-laki', NULL, 'kkjkk', '089789878765', '2025-05-20', 'cat-sunglasses-gangster-digital-art-animal-4k-wallpaper-uhdpaper.com-241@0@j.jpg', 1),
(3, 'Dzikra', 'Laki-laki', NULL, 'Sindangkerta', '09878976786', '2025-05-20', 'mountain-clouds-night-lake-digital-art-scenery-4k-wallpaper-uhdpaper.com-650@2@b.jpg', 2),
(5, 'Ridwan', 'Laki-laki', NULL, 'bhjhjhj', '09878976786', '2025-05-21', 'mountain-clouds-night-lake-digital-art-scenery-4k-wallpaper-uhdpaper.com-650@2@b.jpg', 1),
(9, 'Dzikra', 'Laki-laki', NULL, 'jkjkjk', '09878976786', '2025-05-21', 'wallhaven-x6vljz_1366x768.png', 3),
(10, 'Ridwan', 'Perempuan', NULL, 'jajaja', '09878976786', '2025-05-21', 'wallhaven-x6vljz_1366x768.png', 1),
(11, 'Ridwan', 'Perempuan', NULL, 'jjajjaja', '09878976786', '2025-05-21', 'Gambar WhatsApp 2025-03-02 pukul 23.39.15_c36e6767.jpg', 2),
(12, 'Nabil', 'Laki-laki', NULL, 'jkkjkk\r\n', '09878976786', '2025-05-21', 'cat-sunglasses-gangster-digital-art-animal-4k-wallpaper-uhdpaper.com-241@0@j.jpg', 1),
(13, 'Zuki', 'Laki-laki', NULL, 'jkjakka', '09878976786', '2025-05-21', 'wallhaven-x6vljz_1366x768.png', 1),
(14, 'Yuya', 'Laki-laki', NULL, 'jjaja', '09878976786', '2025-05-21', 'wallhaven-x6vljz_1366x768.png', 1),
(15, 'Ridwan', 'Laki-laki', NULL, 'jjjjaj', '09878976786', '2025-05-22', 'anime-girls-angel-wings-4k-wallpaper-uhdpaper.com-187@0@k.jpg', 1),
(18, 'Ridwan', 'Laki-laki', NULL, 'kkkk', '09878976786', '2025-05-22', 'image-fitur2.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lembur`
--

CREATE TABLE `lembur` (
  `id` int(11) NOT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `bulan` varchar(20) DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `tarif_per_jam` int(11) DEFAULT NULL,
  `jumlah_jam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lembur`
--

INSERT INTO `lembur` (`id`, `karyawan_id`, `bulan`, `jabatan_id`, `tarif_per_jam`, `jumlah_jam`) VALUES
(3, NULL, NULL, 1, 150000, 5),
(4, NULL, NULL, 2, 100000, 5),
(5, NULL, NULL, 3, 50000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `bulan` varchar(20) DEFAULT NULL,
  `nilai_rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `karyawan_id`, `bulan`, `nilai_rating`) VALUES
(2, 2, '2025-05', 5),
(3, 3, '2025-05', 5),
(5, 5, '2025-05', 5),
(9, 9, '2025-05', 5),
(10, 10, '2025-05', 5),
(11, 11, '2025-05', 5),
(12, 12, '2025-05', 5),
(13, 13, '2025-05', 5),
(14, 14, '2025-05', 5),
(25, 13, '2025-08', 2),
(26, 13, '2025-01', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatan_id` (`jabatan_id`);

--
-- Indexes for table `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`),
  ADD KEY `jabatan_id` (`jabatan_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lembur`
--
ALTER TABLE `lembur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`);

--
-- Constraints for table `lembur`
--
ALTER TABLE `lembur`
  ADD CONSTRAINT `lembur_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`),
  ADD CONSTRAINT `lembur_ibfk_2` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
