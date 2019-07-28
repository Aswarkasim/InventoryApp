-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2019 pada 10.18
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_satuan` int(6) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `id_jenis`, `id_user`, `stok`, `id_satuan`, `date_created`) VALUES
('B2137405698', 'Kecap Sedap', 2, 0, 12, 3, '2019-07-27 06:08:48'),
('B7594380126', 'Bimoli', 4, 0, 104, 4, '2019-07-28 08:16:57'),
('B8632751490', 'Buku', 3, 0, 0, 6, '2019-07-28 08:17:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis`
--

CREATE TABLE `tbl_jenis` (
  `id_jenis` int(6) NOT NULL,
  `nama_jenis` varchar(128) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jenis`
--

INSERT INTO `tbl_jenis` (`id_jenis`, `nama_jenis`, `date_created`) VALUES
(2, 'Cair', '2019-06-24 06:59:02'),
(3, 'Batang', '2019-06-27 14:39:53'),
(4, 'Pecah', '2019-06-27 14:41:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keluar`
--

CREATE TABLE `tbl_keluar` (
  `id_keluar` varchar(15) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `nama_jenis` varchar(128) NOT NULL,
  `nama_satuan` varchar(128) NOT NULL,
  `id_barang` varchar(15) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_keluar`
--

INSERT INTO `tbl_keluar` (`id_keluar`, `nama_barang`, `nama_jenis`, `nama_satuan`, `id_barang`, `id_user`, `jumlah`, `tanggal`) VALUES
('TK2019071445013', 'Kecap Sedap', 'Batang', 'Kilogram', 'B5083216974', '', 123, '2019-07-14 01:12:53'),
('TK2019071474360', 'Kecap Sedap', 'Batang', 'Kilogram', 'B5083216974', '', 45, '2019-07-14 01:12:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_konfigurasi`
--

CREATE TABLE `tbl_konfigurasi` (
  `id_konfigurasi` int(1) NOT NULL,
  `nama_aplikasi` varchar(100) NOT NULL,
  `nama_pimpinan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kontak_person` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_masuk`
--

CREATE TABLE `tbl_masuk` (
  `id_masuk` varchar(15) NOT NULL,
  `id_barang` varchar(12) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `nama_jenis` varchar(128) NOT NULL,
  `nama_satuan` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_masuk`
--

INSERT INTO `tbl_masuk` (`id_masuk`, `id_barang`, `id_user`, `nama_barang`, `nama_jenis`, `nama_satuan`, `jumlah`, `tanggal`) VALUES
('TM2019071440916', 'B5083216974', 0, 'Kecap Sedap', 'Batang', 'Kilogram', 34, '2019-07-14 01:06:50'),
('TM2019071456193', 'B5083216974', 0, 'Kecap Sedap', 'Batang', 'Kilogram', 12, '2019-07-14 01:06:38'),
('TM2019072707325', 'B7594380126', 0, 'Bimoli', 'Pecah', 'Kilogram', 100, '2019-07-26 21:58:22'),
('TM2019072793657', 'B2137405698', 0, 'Kecap Sedap', 'Cair', 'Liter', 12, '2019-07-27 01:08:48'),
('TM2019072882461', 'B7594380126', 0, 'Bimoli', 'Pecah', 'Kilogram', 4, '2019-07-28 03:16:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `id_satuan` int(6) NOT NULL,
  `nama_satuan` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`id_satuan`, `nama_satuan`, `date_created`) VALUES
(3, 'Liter', '2019-06-24 06:53:58'),
(4, 'Kilogram', '2019-06-27 14:40:35'),
(5, 'Karung', '2019-06-27 14:40:43'),
(6, 'Dos', '2019-06-27 14:40:58'),
(7, 'Rak', '2019-06-27 14:41:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('Admin','User') NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email`, `image`, `password`, `role`, `is_active`, `date_created`) VALUES
(1, 'Aswar Kasim', 'aswarkasim@gmail.com', 'default.jpg', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'User', 1, 1560694881),
(9, 'Admin', 'admin@gmail.com', '', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Admin', 0, 0),
(10, 'assa', 'assa@gmail.com', '', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Admin', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tgl_jenis`
--

CREATE TABLE `tgl_jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `tbl_keluar`
--
ALTER TABLE `tbl_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indeks untuk tabel `tbl_konfigurasi`
--
ALTER TABLE `tbl_konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `tbl_masuk`
--
ALTER TABLE `tbl_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tgl_jenis`
--
ALTER TABLE `tgl_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  MODIFY `id_jenis` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_konfigurasi`
--
ALTER TABLE `tbl_konfigurasi`
  MODIFY `id_konfigurasi` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tgl_jenis`
--
ALTER TABLE `tgl_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
