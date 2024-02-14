-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2024 at 03:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ukklaundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '1_2024_01_05_134209_create_outlet_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2_2024_01_05_134238_create_user_table', 1),
(7, '3_2024_01_05_134248_create_member_table', 1),
(8, '4_2024_01_05_134301_create_paket_table', 1),
(9, '5_2024_01_05_134315_create_transaksi_table', 1),
(10, '6_2024_01_05_134323_create_d_transaksi_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id` int NOT NULL,
  `id_transaksi` int DEFAULT NULL,
  `id_paket` int DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id`, `id_transaksi`, `id_paket`, `qty`, `keterangan`) VALUES
(1, 1, 1, 1, 'kiloan'),
(2, 1, 2, 2, 'selimut'),
(3, 1, 3, 3, 'bed cover'),
(4, 2, 4, 4, 'kaos'),
(5, 2, 5, 5, 'lain'),
(7, 4, 4, 1, ''),
(8, 4, 5, 1, ''),
(11, 7, 3, 1, ''),
(12, 7, 1, 1, ''),
(13, 1, 4, 10, ''),
(16, 9, 4, 2, ''),
(17, 9, 5, 1, ''),
(18, 10, 4, 2, ''),
(19, 11, 2, 1, ''),
(20, 11, 4, 1, ''),
(21, 11, 1, 1, ''),
(22, 12, 2, 1, ''),
(23, 12, 1, 1.02, ''),
(24, 13, 1, 1, ''),
(25, 13, 4, 1, ''),
(26, 2, 2, 1, ''),
(27, 14, 3, 1, ''),
(28, 14, 4, 1, ''),
(29, 14, 1, 1, ''),
(30, 15, 2, 1, ''),
(31, 15, 5, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tlp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(1, 'John Doe', 'Jl. Contoh No. 123', 'L', '6281246232621'),
(2, 'Jane Doe', 'Jl. Percobaan No. 456', 'P', '628567890123');

-- --------------------------------------------------------

--
-- Table structure for table `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `tlp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_outlet`
--

INSERT INTO `tb_outlet` (`id`, `nama`, `alamat`, `tlp`) VALUES
(1, 'Outlet 1', 'Jl. Contoh No. 123', '628123456789'),
(2, 'Outlet 2', 'Jl. Percobaan No. 456', '628567890123');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id` int NOT NULL,
  `jenis` enum('kiloan','selimut','bed_cover','kaos','lain') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_paket` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id`, `jenis`, `nama_paket`, `harga`) VALUES
(1, 'kiloan', 'Paket Kiloan', 5000),
(2, 'selimut', 'Paket Selimut', 10000),
(3, 'bed_cover', 'Paket Bed Cover', 15000),
(4, 'kaos', 'Paket Kaos', 7000),
(5, 'lain', 'Paket Lain', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int NOT NULL,
  `id_outlet` int DEFAULT NULL,
  `kode_invoice` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_member` int DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `batas_waktu` datetime DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `biaya_tambahan` int DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `pajak` int DEFAULT NULL,
  `total_bayar` double DEFAULT NULL,
  `status` enum('baru','proses','selesai','diambil') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dibayar` enum('dibayar','belum_dibayar') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `id_outlet`, `kode_invoice`, `id_member`, `tgl`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `total_bayar`, `status`, `dibayar`, `id_user`) VALUES
(1, 1, 'KP-20240212134622', 1, '2024-02-12 13:46:22', '2024-02-14 21:45:39', '2024-02-12 14:25:18', 1000, 10, 10000, 111000, 'baru', 'dibayar', 1),
(2, 2, 'KP-20240212134716', 2, '2024-02-12 13:47:16', '2024-02-14 21:46:51', '2024-02-13 01:48:24', 0, 0, 2500, 27500, 'baru', 'dibayar', 2),
(4, 1, 'KP-20240212142015', 1, '2024-02-12 14:20:15', '2024-02-14 22:20:01', '2024-02-12 14:20:15', 0, 0, 1500, 17900, 'proses', 'dibayar', 1),
(7, 2, 'KP-20240212142159', 2, '2024-02-12 14:21:59', '2024-02-21 22:21:46', '2024-02-12 14:28:24', 0, 0, 2000, 22275, 'proses', 'dibayar', 2),
(9, 1, 'KP-20240212142914', 1, '2024-02-12 14:29:14', '2024-02-24 22:28:49', '2024-02-12 14:29:14', 5800, 0, 2200, 30000, 'baru', 'dibayar', 1),
(10, 1, 'KP-20240212142937', 2, '2024-02-12 14:29:37', '2024-02-17 22:29:23', '2024-02-12 14:59:29', 100, 0, 1400, 16000, 'baru', 'dibayar', 1),
(11, 2, 'KP-20240212150146', 1, '2024-02-12 15:01:46', '2024-03-02 23:01:39', '2024-02-12 15:10:10', 0, 0, 2200, 24200, 'proses', 'dibayar', 1),
(12, 2, 'KP-20240212235302', 1, '2024-02-12 23:53:02', '2024-02-23 07:52:51', NULL, 0, 0, 1510, 0, 'baru', 'belum_dibayar', 1),
(13, 1, 'KP-20240213000830', 1, '2024-02-13 00:08:30', '2024-02-14 08:08:21', '2024-02-13 00:10:41', 0, 0, 1200, 14000, 'proses', 'dibayar', 1),
(14, 1, 'KP-20240213021805', 1, '2024-02-13 02:18:05', '2024-02-28 10:17:45', '2024-02-13 02:18:25', 0, 0, 2700, 200000, 'baru', 'dibayar', 4),
(15, 1, 'KP-20240213021916', 2, '2024-02-13 02:19:16', '2024-03-01 10:19:08', NULL, 0, 0, 1800, 0, 'baru', 'belum_dibayar', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci,
  `id_outlet` int DEFAULT NULL,
  `role` enum('admin','kasir','owner') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `id_outlet`, `role`) VALUES
(1, 'Admin', 'admin', '$2y$12$PD.ya0G2rLTLyJakiFVaKe8YXH3K3GhE2n8GOHTAPivp8jo9Rmn2e', 1, 'admin'),
(2, 'Kasir', 'kasir', '$2y$12$4GSps.1Y1/zYhNnI16Qr3eGPyvgipE1WC.Wk6L/x8lTKrnF2x5/Xm', 1, 'kasir'),
(3, 'Owner', 'owner', '$2y$12$g5BzyOk2v5hs9ukM0tAvUuTU4RLU/D6fddmKxh7zi3SKivOy/f6wC', 1, 'owner'),
(4, 'Admin2', 'admin2', '$2y$12$jPEFvCo5jMjlcM.0AQ/p0.rDzhxTqeuny894Iz2J5tffeYmxFute2', 2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_detail_transaksi_id_transaksi_foreign` (`id_transaksi`),
  ADD KEY `tb_detail_transaksi_id_paket_foreign` (`id_paket`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_transaksi_id_outlet_foreign` (`id_outlet`),
  ADD KEY `tb_transaksi_id_member_foreign` (`id_member`),
  ADD KEY `tb_transaksi_id_user_foreign` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_user_id_outlet_foreign` (`id_outlet`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD CONSTRAINT `tb_detail_transaksi_id_paket_foreign` FOREIGN KEY (`id_paket`) REFERENCES `tb_paket` (`id`),
  ADD CONSTRAINT `tb_detail_transaksi_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_id_member_foreign` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id`),
  ADD CONSTRAINT `tb_transaksi_id_outlet_foreign` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`),
  ADD CONSTRAINT `tb_transaksi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_id_outlet_foreign` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
