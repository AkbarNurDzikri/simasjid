-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2022 pada 19.17
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simasjid`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jamaah`
--

CREATE TABLE `jamaah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jamaah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_jamaah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenkel` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_nikah` enum('3','2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` enum('Islam','Katolik','Protestan','Hindu','Buddha','Konghucu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gol_darah` enum('A','B','AB','O') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_ekonomi` enum('2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_jamaah` enum('Anggota DKM','Jamaah','Non Jamaah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_jamaah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jamaah`
--

INSERT INTO `jamaah` (`id`, `nama_jamaah`, `no_ktp`, `no_kk`, `alamat_jamaah`, `no_hp`, `tempat_lahir`, `tgl_lahir`, `jenkel`, `status_nikah`, `agama`, `gol_darah`, `pekerjaan`, `status_ekonomi`, `status_jamaah`, `foto_jamaah`, `created_at`, `updated_at`) VALUES
(1, 'Naruto Uzumaki', '321501234567', '321512345678', 'Konoha Gakure RT 01 RW 02', '085712345678', 'Konoha', '2000-08-17', 'L', '2', 'Islam', 'A', 'Ninja', '2', 'Anggota DKM', 'foto-jamaah/e7QbT2JjiqF66bWvt37Sqet0ZkcjmWh6HuJF0FuC.jpg', NULL, NULL),
(2, 'Sakura', '321546354758', '321503894857', 'Bandung Barat RT 011 RW 034', '089826374635', 'Bandung', '2001-08-17', 'P', '2', 'Katolik', 'AB', 'Junior Ninja', '1', 'Non Jamaah', 'foto-jamaah/yIfaBtWYk5qhenwDkmrwLnHsCGXImIf9U33ybQOZ.png', NULL, NULL),
(3, 'Siti Hinata', '321538479287', '3215093847267', 'Bekasi Timur', '081284794039', 'Bekasi', '1999-08-17', 'P', '2', 'Islam', 'AB', 'Guru Ngaji', '0', 'Anggota DKM', 'foto-jamaah/KyJ2fr1R0cBVUjAjJh1u8UB6Bcnx6gDafY9PGykN.jpg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jamaah`
--
ALTER TABLE `jamaah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jamaah`
--
ALTER TABLE `jamaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
