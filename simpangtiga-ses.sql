-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 03:08 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpangtiga-ses`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan`
--

CREATE TABLE `detail_permintaan` (
  `id_detail` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_permintaan`
--

INSERT INTO `detail_permintaan` (`id_detail`, `id_permintaan`, `id_produk`, `qty`) VALUES
(1, 1, 1, 83),
(2, 2, 1, 61),
(3, 3, 1, 78),
(4, 4, 1, 76),
(5, 5, 1, 89),
(6, 6, 1, 80),
(7, 7, 1, 85),
(8, 8, 1, 56),
(9, 9, 1, 70),
(10, 10, 1, 80),
(11, 11, 1, 20),
(12, 11, 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `peramalan`
--

CREATE TABLE `peramalan` (
  `id_peramalan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `dt_permintaan` int(11) NOT NULL,
  `dt_peramalan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peramalan`
--

INSERT INTO `peramalan` (`id_peramalan`, `id_produk`, `bulan`, `tahun`, `dt_permintaan`, `dt_peramalan`) VALUES
(1, 1, 1, 2025, 83, 83),
(2, 1, 2, 2025, 61, 83),
(3, 1, 3, 2025, 78, 79),
(4, 1, 4, 2025, 76, 79),
(5, 1, 5, 2025, 89, 78),
(6, 1, 6, 2025, 80, 80),
(7, 1, 7, 2025, 85, 80),
(8, 1, 8, 2025, 56, 81),
(9, 1, 9, 2025, 70, 76),
(10, 1, 10, 2025, 80, 75),
(11, 1, 12, 2025, 20, 0),
(12, 2, 12, 2025, 30, 30);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id_permintaan` int(11) NOT NULL,
  `tgl_permintaan` varchar(20) NOT NULL,
  `total_bayar` varchar(125) NOT NULL,
  `status` int(11) NOT NULL,
  `payment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id_permintaan`, `tgl_permintaan`, `total_bayar`, `status`, `payment`) VALUES
(1, '2025-01-01', '100000', 2, '1'),
(2, '2025-02-01', '100000', 2, '1'),
(3, '2025-03-01', '100000', 2, '1'),
(4, '2025-04-01', '100000', 2, '1'),
(5, '2025-05-01', '100000', 2, '1'),
(6, '2025-06-01', '100000', 2, '1'),
(7, '2025-07-01', '100000', 2, '1'),
(8, '2025-08-01', '100000', 2, '1'),
(9, '2025-09-01', '100000', 2, '1'),
(10, '2025-10-01', '100000', 2, '1'),
(11, '2025-12-03', '350000', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_produk` varchar(125) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` varchar(15) NOT NULL,
  `gambar` text NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_user`, `nama_produk`, `keterangan`, `harga`, `gambar`, `stok`) VALUES
(1, 4, 'Produk A', 'kg', '10000', 'images.jpeg', 985),
(2, 4, 'Produk B', 'pcs', '5000', 'download_(4).jpeg', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `produk_keluar`
--

CREATE TABLE `produk_keluar` (
  `id_produk_keluar` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tgl_keluar` varchar(15) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_keluar`
--

INSERT INTO `produk_keluar` (`id_produk_keluar`, `id_produk`, `tgl_keluar`, `qty`) VALUES
(1, 2, '2025-12-02', 5),
(2, 1, '2025-12-03', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(125) NOT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL,
  `level_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level_user`) VALUES
(1, 'Admin', 'admin', 'admin12345@', 1),
(2, 'Gudang', 'gudang', 'gudang12345@', 2),
(4, 'Supplier Pertama', 'supplier', 'supplier', 4),
(5, 'Pemilik', 'pemilik', 'pemilik12345@', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `peramalan`
--
ALTER TABLE `peramalan`
  ADD PRIMARY KEY (`id_peramalan`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  ADD PRIMARY KEY (`id_produk_keluar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peramalan`
--
ALTER TABLE `peramalan`
  MODIFY `id_peramalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  MODIFY `id_produk_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
