-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2017 at 08:01 
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolahku`
--

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `kode` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` char(2) NOT NULL,
  `semester` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`kode`, `nama`, `kelas`, `semester`) VALUES
('bhs51', 'bahasa indonesia', '5', '1'),
('mtk51', 'Matematika', '5', '1'),
('mtk52', 'Matematika', '5', '2');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `no_induk` varchar(10) NOT NULL,
  `kdmp` varchar(10) NOT NULL,
  `nilai` varchar(3) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `no_induk`, `kdmp`, `nilai`, `created_at`) VALUES
(1, '123', 'mtk52', '100', '2017-06-05 07:20:22'),
(2, '123', 'mtk51', '90', '2017-06-05 07:20:36'),
(3, '123', 'mtk51', '85', '2017-06-05 07:20:46'),
(4, '51413900', 'mtk51', '80', '2017-06-05 09:38:08'),
(5, '51413900', 'mtk52', '90', '2017-06-05 09:38:18'),
(6, '123', 'bhs51', '10', '2017-06-07 09:57:40'),
(7, '123456', 'mtk52', '90', '2017-06-07 10:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `no_induk` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jekel` char(1) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `ttl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`no_induk`, `nama`, `jekel`, `alamat`, `ttl`) VALUES
('123', 'Agus', 'l', 'jalan kapuk gan', '1994-05-11'),
('12345', 'novan', 'L', 'cibubur', '2013-12-30'),
('123456', 'vicky bobo', 'L', 'kapuk', '2000-10-29'),
('51413900', 'Choiriza Anastasia', 'P', 'Pinangranti', '1995-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kdmp` (`kdmp`),
  ADD KEY `no_induk` (`no_induk`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD UNIQUE KEY `no_induk` (`no_induk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`kdmp`) REFERENCES `mata_pelajaran` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`no_induk`) REFERENCES `siswa` (`no_induk`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
