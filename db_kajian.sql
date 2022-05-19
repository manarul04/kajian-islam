-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 02:04 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kajian`
--

CREATE TABLE `tb_kajian` (
  `id_kajian` int(11) NOT NULL,
  `judul` text NOT NULL,
  `id_kategori` text NOT NULL,
  `id_ustad` int(11) NOT NULL,
  `id_kontributor` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `deskripsi` text NOT NULL,
  `thumbnail` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `alamat` text NOT NULL,
  `hp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama`, `email`, `alamat`, `hp`) VALUES
(1, 'Krisna', 'krisna@gmail.com', 'gebog', 858743843);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `level`, `id_pengguna`) VALUES
(1, 'admin', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ustad`
--

CREATE TABLE `tb_ustad` (
  `id_ustad` int(11) NOT NULL,
  `nama_ustad` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user`
-- (See below for the actual view)
--
CREATE TABLE `v_user` (
`id` int(11)
,`username` varchar(50)
,`password` varchar(50)
,`level` varchar(50)
,`id_pengguna` int(11)
,`nama` text
,`alamat` text
,`email` text
);

-- --------------------------------------------------------

--
-- Structure for view `v_user`
--
DROP TABLE IF EXISTS `v_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user`  AS SELECT `tb_user`.`id` AS `id`, `tb_user`.`username` AS `username`, `tb_user`.`password` AS `password`, `tb_user`.`level` AS `level`, `tb_user`.`id_pengguna` AS `id_pengguna`, `tb_pengguna`.`nama` AS `nama`, `tb_pengguna`.`alamat` AS `alamat`, `tb_pengguna`.`email` AS `email` FROM (`tb_user` join `tb_pengguna` on(`tb_user`.`id_pengguna` = `tb_pengguna`.`id_pengguna`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kajian`
--
ALTER TABLE `tb_kajian`
  ADD PRIMARY KEY (`id_kajian`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tb_ustad`
--
ALTER TABLE `tb_ustad`
  ADD PRIMARY KEY (`id_ustad`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kajian`
--
ALTER TABLE `tb_kajian`
  MODIFY `id_kajian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_ustad`
--
ALTER TABLE `tb_ustad`
  MODIFY `id_ustad` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
