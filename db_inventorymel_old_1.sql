-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Jan 2021 pada 05.09
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventorymel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `input_items`
--

CREATE TABLE `input_items` (
  `id_input` bigint(11) NOT NULL,
  `id_item` bigint(11) DEFAULT NULL,
  `id_supplier` bigint(11) DEFAULT NULL,
  `qty_input` int(11) NOT NULL,
  `tgl_input` date NOT NULL,
  `id_user` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id_item` bigint(11) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `netto` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `output_items`
--

CREATE TABLE `output_items` (
  `id_output` bigint(11) NOT NULL,
  `id_item` bigint(11) DEFAULT NULL,
  `qty_output` int(11) NOT NULL,
  `tgl_output` date NOT NULL,
  `id_user` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id_supplier` bigint(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `kontak` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` bigint(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `password`, `level`) VALUES
(2, 'superadmin', 'superadmin@superadmin.com', '17c4520f6cfd1ab53d8745e84681eb49', 'superadmin'),
(9, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `input_items`
--
ALTER TABLE `input_items`
  ADD PRIMARY KEY (`id_input`),
  ADD KEY `id_items` (`id_item`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `output_items`
--
ALTER TABLE `output_items`
  ADD PRIMARY KEY (`id_output`),
  ADD KEY `id_items` (`id_item`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `input_items`
--
ALTER TABLE `input_items`
  MODIFY `id_input` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id_item` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `output_items`
--
ALTER TABLE `output_items`
  MODIFY `id_output` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_supplier` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
