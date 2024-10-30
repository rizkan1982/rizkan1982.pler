-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2023 pada 17.51
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(4) NOT NULL,
  `nama_brg` varchar(200) NOT NULL,
  `kode_brg` varchar(200) NOT NULL,
  `stock` varchar(200) NOT NULL,
  `harga` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_brg`, `kode_brg`, `stock`, `harga`, `tanggal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'Paracetamol', '11223344', '250', '25.000', '2023-04-28', '2023-04-28 13:50:11', NULL, NULL),
(10, 'Insu', '223344', '200', '30.000', '2023-04-26', '2023-04-28 13:50:17', '2023-04-28 14:00:03', '2023-04-28 14:00:03'),
(11, 'Konidin Anak', '123', '450', '20.000', '2023-04-30', '2023-04-28 13:50:01', '2023-04-28 13:57:53', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `brg_keluar`
--

CREATE TABLE `brg_keluar` (
  `id_brg_klr` int(4) NOT NULL,
  `jumlah` varchar(200) NOT NULL,
  `tanggall` datetime NOT NULL,
  `id_barang` int(4) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `brg_keluar`
--

INSERT INTO `brg_keluar` (`id_brg_klr`, `jumlah`, `tanggall`, `id_barang`, `created_at`) VALUES
(32, '50', '2023-04-08 15:32:00', 11, '2023-04-28 15:32:27'),
(33, '50', '2023-04-22 15:40:00', 9, '2023-04-28 15:40:19');

--
-- Trigger `brg_keluar`
--
DELIMITER $$
CREATE TRIGGER `hapuss` AFTER DELETE ON `brg_keluar` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock+old.jumlah WHERE id_barang=old.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `keluar` AFTER INSERT ON `brg_keluar` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock-new.jumlah WHERE id_barang=new.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `brg_masuk`
--

CREATE TABLE `brg_masuk` (
  `id_brg_msk` int(4) NOT NULL,
  `jumlah` varchar(200) NOT NULL,
  `tanggall` datetime NOT NULL,
  `id_barang` int(4) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `brg_masuk`
--

INSERT INTO `brg_masuk` (`id_brg_msk`, `jumlah`, `tanggall`, `id_barang`, `created_at`) VALUES
(25, '200', '2023-04-22 15:42:00', 9, '2023-04-28 15:42:41');

--
-- Trigger `brg_masuk`
--
DELIMITER $$
CREATE TRIGGER `hapus` AFTER DELETE ON `brg_masuk` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock-old.jumlah WHERE id_barang=old.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `masuk` AFTER INSERT ON `brg_masuk` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock+new.jumlah WHERE id_barang= new.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `jenis_kelamin` int(2) NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama`, `alamat`, `no_telepon`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7896', 'Steven', 'Perumahan Steven', '4786046', 1, 'Batam', '2023-04-28', 1, '2023-04-26 20:27:24', '2023-04-28 22:20:06', NULL),
(2, 'Asep', 'Asep', 'Asep', '0822334455', 2, 'Asep1', '2023-04-28', 2, '2023-04-26 21:48:15', '2023-04-28 22:21:12', '2023-04-28 22:21:12'),
(3, '123456789', 'Asep', 'Perumahan Asep', '08334455', 1, 'Batam', '2023-04-21', 3, '2023-04-28 22:22:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'Dapat Mengakses Semua Setting', '2023-04-26 20:25:57', NULL, NULL),
(2, 'Karyawan', 'Dapat Mengakses Fungsi Penting Saja', '2023-04-26 21:53:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` varchar(2) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `level`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin@gmail.com', '1', 'default.png', '2023-04-26 20:27:45', '2023-04-28 22:20:06', NULL),
(2, 'Asep', '827ccb0eea8a706c4c34a16891f84e7b', 'Asep', '2', 'tidaktahu.png', '2023-04-26 21:48:15', '2023-04-28 22:20:48', NULL),
(3, 'Karyawan', '827ccb0eea8a706c4c34a16891f84e7b', 'karyawan@gmail.com', '2', 'default.png', '2023-04-28 22:22:07', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_brg` (`kode_brg`);

--
-- Indeks untuk tabel `brg_keluar`
--
ALTER TABLE `brg_keluar`
  ADD PRIMARY KEY (`id_brg_klr`);

--
-- Indeks untuk tabel `brg_masuk`
--
ALTER TABLE `brg_masuk`
  ADD PRIMARY KEY (`id_brg_msk`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `brg_keluar`
--
ALTER TABLE `brg_keluar`
  MODIFY `id_brg_klr` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `brg_masuk`
--
ALTER TABLE `brg_masuk`
  MODIFY `id_brg_msk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
