-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jan 2021 pada 03.09
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `kb_input` int(11) NOT NULL,
  `tgl_input` date NOT NULL,
  `h_stokInput` int(11) NOT NULL,
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
  `merk` varchar(50) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `kb` int(11) NOT NULL,
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
  `kb_output` int(11) NOT NULL,
  `tgl_output` date NOT NULL,
  `h_stokOutput` int(11) NOT NULL,
  `id_user` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id_supplier` bigint(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `kontak` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_items`
--

CREATE TABLE `transaksi_items` (
  `id_ti` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `stok_masuk` int(11) DEFAULT NULL,
  `kb_masuk` int(11) DEFAULT NULL,
  `stok_keluar` int(11) DEFAULT NULL,
  `kb_keluar` int(11) DEFAULT NULL,
  `sisa_stok` int(11) DEFAULT NULL,
  `sisa_kb` int(11) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `id_item` int(11) NOT NULL
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
-- Indeks untuk tabel `input_items`
--
ALTER TABLE `input_items`
  ADD PRIMARY KEY (`id_input`),
  ADD KEY `id_items` (`id_item`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indeks untuk tabel `output_items`
--
ALTER TABLE `output_items`
  ADD PRIMARY KEY (`id_output`),
  ADD KEY `id_items` (`id_item`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `transaksi_items`
--
ALTER TABLE `transaksi_items`
  ADD PRIMARY KEY (`id_ti`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `input_items`
--
ALTER TABLE `input_items`
  MODIFY `id_input` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id_item` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `output_items`
--
ALTER TABLE `output_items`
  MODIFY `id_output` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_supplier` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `transaksi_items`
--
ALTER TABLE `transaksi_items`
  MODIFY `id_ti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
