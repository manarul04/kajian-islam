-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 04:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `deskripsi` text NOT NULL,
  `thumbnail` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kajian`
--

INSERT INTO `tb_kajian` (`id_kajian`, `judul`, `id_kategori`, `id_ustad`, `id_kontributor`, `tanggal`, `deskripsi`, `thumbnail`, `link`) VALUES
(1, '\r\nPentingnya Menjaga Keutuhan NKRI Untuk Berdakwah\r\n', '1', 1, 2, '2022-05-19', 'erfsdfsfds', 'gus baha.jpg', '6B5gjU5lZII'),
(8, 'Kuncine Urip Tenang', '3', 1, 2, '2022-05-21', 'urip urup', '2022-05-21-Kuncine Urip Tenang.jpg', 'HhFlA0LwF_s');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Kenegaraan'),
(2, 'Fikih'),
(3, 'Hari Akhir');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(16) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama`, `email`, `alamat`, `hp`, `foto`) VALUES
(1, 'Krisna', 'krisna@gmail.com', 'gebog', '858743843', 'USER-Krisna.jpg'),
(2, 'Manarul', 'manarul@gmail.com', 'kudus', '089673478348', 'USER-Manarul.jpg'),
(3, 'laila', 'laila@gmail.com', 'kauman', '', 'USER-laila.jpg'),
(4, 'sofi', 'sofi@gmail.com', 'srabi', '', 'USER-sofi.jpg'),
(5, 'tata', 'tata@gmail.com', 'srabi', '', 'USER-tata.jpg');

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
(1, 'admin', 'admin', 'admin', 1),
(2, 'manarul', 'manarul', 'kontributor', 2),
(13, 'lailaa', 'lailaa', 'pengguna', 3),
(14, 'sofi', 'sofi', 'pengguna', 4),
(15, 'tata', 'tata', 'pengguna', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ustad`
--

CREATE TABLE `tb_ustad` (
  `id_ustad` int(11) NOT NULL,
  `nama_ustad` text NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ustad`
--

INSERT INTO `tb_ustad` (`id_ustad`, `nama_ustad`, `deskripsi`, `foto`) VALUES
(1, 'Gus Baha', 'pengasuh pondok di narukan rembang', '-Gus Baha.jpg'),
(3, 'Ustad Adi Hidayat', 'pendakwah', 'USTAD-Ustad Adi Hidayat.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kajian`
-- (See below for the actual view)
--
CREATE TABLE `v_kajian` (
`id_kajian` int(11)
,`judul` text
,`id_kategori` text
,`kategori` text
,`id_ustad` int(11)
,`nama_ustad` text
,`id_kontributor` int(11)
,`nama` text
,`tanggal` date
,`deskripsi` text
,`thumbnail` text
,`link` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kontributor`
-- (See below for the actual view)
--
CREATE TABLE `v_kontributor` (
`id_kontributor` int(11)
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
,`foto` text
);

-- --------------------------------------------------------

--
-- Structure for view `v_kajian`
--
DROP TABLE IF EXISTS `v_kajian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kajian`  AS SELECT `tb_kajian`.`id_kajian` AS `id_kajian`, `tb_kajian`.`judul` AS `judul`, `tb_kajian`.`id_kategori` AS `id_kategori`, `tb_kategori`.`kategori` AS `kategori`, `tb_kajian`.`id_ustad` AS `id_ustad`, `tb_ustad`.`nama_ustad` AS `nama_ustad`, `tb_kajian`.`id_kontributor` AS `id_kontributor`, `v_kontributor`.`nama` AS `nama`, `tb_kajian`.`tanggal` AS `tanggal`, `tb_kajian`.`deskripsi` AS `deskripsi`, `tb_kajian`.`thumbnail` AS `thumbnail`, `tb_kajian`.`link` AS `link` FROM (((`tb_kajian` join `tb_ustad` on(`tb_kajian`.`id_ustad` = `tb_ustad`.`id_ustad`)) join `tb_kategori` on(`tb_kajian`.`id_kategori` = `tb_kategori`.`id_kategori`)) join `v_kontributor` on(`tb_kajian`.`id_kontributor` = `v_kontributor`.`id_kontributor`))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_kontributor`
--
DROP TABLE IF EXISTS `v_kontributor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kontributor`  AS SELECT `v_user`.`id` AS `id_kontributor`, `v_user`.`username` AS `username`, `v_user`.`password` AS `password`, `v_user`.`level` AS `level`, `v_user`.`id_pengguna` AS `id_pengguna`, `v_user`.`nama` AS `nama`, `v_user`.`alamat` AS `alamat`, `v_user`.`email` AS `email` FROM `v_user` WHERE `v_user`.`level` = 'kontributor''kontributor'  ;

-- --------------------------------------------------------

--
-- Structure for view `v_user`
--
DROP TABLE IF EXISTS `v_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user`  AS SELECT `tb_user`.`id` AS `id`, `tb_user`.`username` AS `username`, `tb_user`.`password` AS `password`, `tb_user`.`level` AS `level`, `tb_user`.`id_pengguna` AS `id_pengguna`, `tb_pengguna`.`nama` AS `nama`, `tb_pengguna`.`alamat` AS `alamat`, `tb_pengguna`.`email` AS `email`, `tb_pengguna`.`foto` AS `foto` FROM (`tb_user` join `tb_pengguna` on(`tb_user`.`id_pengguna` = `tb_pengguna`.`id_pengguna`))  ;

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
  MODIFY `id_kajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_ustad`
--
ALTER TABLE `tb_ustad`
  MODIFY `id_ustad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
