-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2024 pada 18.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `nama`, `nip`, `alamat`, `email`, `jenis_kelamin`, `password`) VALUES
(1, 'Admin', '1111111', 'Malang', 'admin@gmail.com', 'Laki-laki', '$2y$12$2i9RIWMNKt/b/7YON0XeKevUP9ptU12dzBHTB82C87fxUM6aZgNj2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
--

CREATE TABLE `barangs` (
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `id_kategori` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id_barang`, `kode_barang`, `nama_barang`, `id_kategori`, `satuan`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 'M001', 'Meja', '1', 'Buah', '3', '2024-01-22 08:24:45', '2024-01-25 11:52:55'),
(2, 'K001', 'Kursi', '1', 'Buah', '8', '2024-01-22 08:25:00', '2024-01-25 17:44:43'),
(3, 'PP001', 'Papan Tulis', '2', 'Buah', '5', '2024-01-22 08:25:12', '2024-11-14 17:05:06'),
(4, 'P001', 'Penghapus', '2', 'Buah', '3', '2024-01-22 08:28:16', '2024-11-14 17:37:00'),
(5, 'SL001', 'Speaker Lapangan', '3', 'Buah', '5', '2024-01-22 08:25:26', '2024-11-14 17:09:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluars`
--

CREATE TABLE `barang_keluars` (
  `id_barang_keluar` bigint(20) UNSIGNED NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `jumlah_keluar` varchar(255) NOT NULL,
  `id_ruang` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_keluars`
--

INSERT INTO `barang_keluars` (`id_barang_keluar`, `id_barang`, `jumlah_keluar`, `id_ruang`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '2', '1', 'returned', '2024-01-23 04:00:40', '2024-01-23 15:12:29'),
(2, '2', '4', '1', 'returned', '2024-01-23 04:00:52', '2024-01-25 17:45:17'),
(3, '3', '1', '3', 'validate', '2024-01-23 04:01:06', '2024-01-23 04:02:04'),
(5, '4', '0', '2', 'waiting', '2024-01-23 13:08:22', '2024-01-25 14:38:26'),
(6, '1', '2', '1', 'validate', '2024-01-23 15:12:58', '2024-01-25 11:49:23'),
(7, '3', '1', '1', 'returned', '2024-01-25 17:48:53', '2024-11-14 17:05:06'),
(8, '7', '1', '1', 'validate', '2024-11-14 16:55:23', '2024-11-14 16:55:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuks`
--

CREATE TABLE `barang_masuks` (
  `id_barang_masuk` bigint(20) UNSIGNED NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `jumlah_masuk` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_masuks`
--

INSERT INTO `barang_masuks` (`id_barang_masuk`, `id_barang`, `jumlah_masuk`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '5', 'validate', '2024-01-23 03:57:29', '2024-01-23 03:57:53'),
(2, '2', '10', 'validate', '2024-01-23 03:58:06', '2024-01-23 03:59:48'),
(3, '3', '5', 'validate', '2024-01-23 04:00:08', '2024-01-23 04:01:21'),
(5, '4', '5', 'waiting', '2024-01-23 12:10:20', '2024-01-25 11:56:02'),
(6, '5', '5', 'validate', '2024-01-23 15:36:10', '2024-01-23 15:36:38'),
(7, '7', '2', 'validate', '2024-11-14 16:56:30', '2024-11-14 16:56:34'),
(8, '4', '3', 'validate', '2024-11-14 17:36:54', '2024-11-14 17:37:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id_kategori` bigint(20) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Mebel', '2023-12-27 05:01:16', '2023-12-27 05:01:16'),
(2, 'Alat Tulis', '2024-01-23 03:56:48', '2024-01-23 03:56:48'),
(3, 'Elektronik', '2024-01-23 15:34:48', '2024-01-23 15:34:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_23_031431_create_barangs_table', 1),
(6, '2023_11_23_031440_create_ruangs_table', 1),
(7, '2023_11_23_031453_create_kategoris_table', 1),
(8, '2023_11_23_031510_create_peminjamen_table', 1),
(9, '2023_11_23_031530_create_barang_keluars_table', 1),
(10, '2023_11_23_031537_create_barang_masuks_table', 1),
(11, '2023_11_23_031550_create_rusak_ruangans_table', 1),
(12, '2023_11_23_031556_create_rusak_dalams_table', 1),
(13, '2023_12_01_045137_create_pj_table', 1),
(14, '2023_12_26_102507_admins', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id_peminjaman` bigint(20) UNSIGNED NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `jumlah_pinjam` varchar(255) NOT NULL,
  `id_ruang` varchar(255) NOT NULL,
  `peminjam` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjamans`
--

INSERT INTO `peminjamans` (`id_peminjaman`, `id_barang`, `jumlah_pinjam`, `id_ruang`, `peminjam`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', '1', '1', 'Ahmad Faisol', 'returned', '2024-01-22 04:06:27', '2024-01-23 04:08:02'),
(2, '1', '2', '1', 'Ahmad Faisol', 'returned', '2024-01-23 04:07:17', '2024-01-23 14:01:45'),
(3, '3', '1', '3', 'Suryo Adi W', 'returned', '2024-01-23 14:04:27', '2024-01-25 17:47:42'),
(4, '7', '1', '1', 'Ahmad Faisol', 'returned', '2024-11-14 16:54:15', '2024-11-14 16:54:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pj`
--

CREATE TABLE `pj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pj` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pj`
--

INSERT INTO `pj` (`id`, `nama_pj`, `nip`, `alamat`, `jenis_kelamin`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Davantio', '1031000941', 'Pasuruan', 'Laki-laki', 'davantiodestama07@gmail.com', '$2y$12$ZhkqZPGv0zq5ejFALmuPkei5P9WBZ66IwQ9KZHiPtEVV2RoSPXaJ.', '2023-12-27 05:00:59', '2024-11-14 17:14:22'),
(2, 'Ali Mahmudi', '1031000576', 'UK', 'Laki-laki', 'alimahmud@gmail.com', '$2y$12$4fMA1BguI3W9jpPex4uNQ.e/4XkO4BjjpHTour9Ux1guSxxXVTc/.', '2023-12-30 03:30:55', '2023-12-30 03:30:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangs`
--

CREATE TABLE `ruangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_ruangan` varchar(255) NOT NULL,
  `ruangan` varchar(255) NOT NULL,
  `id_pj` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangs`
--

INSERT INTO `ruangs` (`id`, `kode_ruangan`, `ruangan`, `id_pj`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'III.2.1', 'Amphi 1 Gedung 3', '1', 'YTTA', '2024-01-21 08:37:35', '2024-01-21 17:46:11'),
(2, 'III.3.1', 'Amphi 2 Gedung 3', '2', 'YTTA', '2024-01-22 08:37:16', '2024-01-22 08:37:16'),
(3, 'III.3.4', 'Ruang Kelas 3.4', '1', NULL, '2024-01-22 08:37:55', '2024-01-22 08:37:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rusak_dalams`
--

CREATE TABLE `rusak_dalams` (
  `id_rusak_dalam` bigint(20) UNSIGNED NOT NULL,
  `id_pj` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `jumlah_rusak` int(11) NOT NULL,
  `id_ruangan` varchar(255) NOT NULL,
  `tanggal_rusak` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rusak_dalams`
--

INSERT INTO `rusak_dalams` (`id_rusak_dalam`, `id_pj`, `id_barang`, `jumlah_rusak`, `id_ruangan`, `tanggal_rusak`, `status`, `created_at`, `updated_at`) VALUES
(27, '1', '2', 2, '1', '2024-01-25', 3, '2024-01-25 16:59:34', '2024-01-25 17:02:30'),
(28, '1', '2', 2, '1', '2024-01-26', 3, '2024-01-25 17:02:59', '2024-01-25 17:05:19'),
(29, '1', '2', 2, '1', '2024-01-26', 3, '2024-01-25 17:28:47', '2024-01-25 17:36:17'),
(30, '1', '2', 2, '1', '2024-01-26', 3, '2024-01-25 17:44:10', '2024-01-25 17:45:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rusak_ruangans`
--

CREATE TABLE `rusak_ruangans` (
  `id_rusak_luar` bigint(20) UNSIGNED NOT NULL,
  `id_pj` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `jumlah_rusak` int(11) NOT NULL,
  `tanggal_rusak` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rusak_ruangans`
--

INSERT INTO `rusak_ruangans` (`id_rusak_luar`, `id_pj`, `id_barang`, `jumlah_rusak`, `tanggal_rusak`, `status`, `created_at`, `updated_at`) VALUES
(2, '1', '2', 3, '2023-12-30', 3, '2023-12-30 04:09:31', '2024-01-21 10:58:05'),
(5, '2', '1', 4, '2023-12-28', 3, '2024-01-21 10:56:42', '2024-01-21 10:58:27'),
(7, '2', '5', 2, '2024-01-23', 3, '2024-01-23 16:16:45', '2024-01-25 11:10:28'),
(8, '2', '5', 1, '2024-01-21', 3, '2024-01-23 16:23:09', '2024-11-14 17:09:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `barang_keluars`
--
ALTER TABLE `barang_keluars`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indeks untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pj`
--
ALTER TABLE `pj`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangs`
--
ALTER TABLE `ruangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rusak_dalams`
--
ALTER TABLE `rusak_dalams`
  ADD PRIMARY KEY (`id_rusak_dalam`);

--
-- Indeks untuk tabel `rusak_ruangans`
--
ALTER TABLE `rusak_ruangans`
  ADD PRIMARY KEY (`id_rusak_luar`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `barang_keluars`
--
ALTER TABLE `barang_keluars`
  MODIFY `id_barang_keluar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id_barang_masuk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id_kategori` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id_peminjaman` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pj`
--
ALTER TABLE `pj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `ruangs`
--
ALTER TABLE `ruangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rusak_dalams`
--
ALTER TABLE `rusak_dalams`
  MODIFY `id_rusak_dalam` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `rusak_ruangans`
--
ALTER TABLE `rusak_ruangans`
  MODIFY `id_rusak_luar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
