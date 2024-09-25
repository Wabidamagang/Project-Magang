-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 23 Sep 2024 pada 14.41
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
-- Database: `db_datamahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `kelas_id` int(10) UNSIGNED DEFAULT NULL,
  `kode_dosen` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `jenis_dosen` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `user_id`, `kelas_id`, `kode_dosen`, `nip`, `name`, `jenis_dosen`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'DW001', '45671', 'dosen_wali1', NULL, NULL, NULL),
(2, 3, 2, 'DW002', '45672', 'dosen_wali2', NULL, NULL, NULL),
(3, 4, NULL, 'DB001', '45681', 'dosen_biasa1', NULL, NULL, NULL),
(4, 5, NULL, 'DB002', '45682', 'dosen_biasa2', NULL, NULL, NULL),
(5, 6, NULL, 'DB003', '45683', 'dosen_biasa3', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kaprodi`
--

CREATE TABLE `kaprodi` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `kode_dosen` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kaprodi`
--

INSERT INTO `kaprodi` (`id`, `user_id`, `kode_dosen`, `nip`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'K001', '123456', 'kaprodiuser', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `name`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 'Kelas A', NULL, NULL, NULL),
(2, 'Kelas B', NULL, NULL, NULL),
(4, 'Kelas Bola', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_dosen`
--

CREATE TABLE `kelas_dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas_dosen`
--

INSERT INTO `kelas_dosen` (`id`, `kelas_id`, `dosen_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_mahasiswa`
--

CREATE TABLE `kelas_mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `mahasiswa_id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas_mahasiswa`
--

INSERT INTO `kelas_mahasiswa` (`id`, `kelas_id`, `mahasiswa_id`, `dosen_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, NULL, NULL),
(4, 1, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `kelas_id` int(10) UNSIGNED DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `edit` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `kelas_id`, `nim`, `name`, `tempat_lahir`, `tanggal_lahir`, `edit`, `created_at`, `updated_at`) VALUES
(1, 7, 4, 'M001', 'Justin Hubner', 'Netherlands', '2024-09-21', 2, NULL, '2024-09-21 05:01:19'),
(2, 8, 1, 'M002', 'mahasiswa2', 'Belanda', '2024-09-21', 2, NULL, '2024-09-21 04:44:56'),
(3, 9, 1, 'M003', 'mahasiswa3', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(4, 10, 1, 'M004', 'mahasiswa4', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(5, 11, 1, 'M005', 'mahasiswa5', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(6, 12, 1, 'M006', 'mahasiswa6', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(7, 13, 1, 'M007', 'mahasiswa7', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(8, 14, 1, 'M008', 'mahasiswa8', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(9, 15, 1, 'M009', 'mahasiswa9', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(10, 16, 1, 'M0010', 'mahasiswa10', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(11, 17, 2, 'M0011', 'mahasiswa11', 'Tempat Lahir', '2024-09-21', -1, NULL, '2024-09-21 05:10:12'),
(12, 18, 2, 'M0012', 'mahasiswa12', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(13, 19, 2, 'M0013', 'mahasiswa13', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(14, 20, 2, 'M0014', 'mahasiswa14', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(15, 21, 2, 'M0015', 'mahasiswa15', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(16, 22, 2, 'M0016', 'mahasiswa16', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(17, 23, 2, 'M0017', 'mahasiswa17', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(18, 24, 2, 'M0018', 'mahasiswa18', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(19, 25, 2, 'M0019', 'mahasiswa19', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(20, 26, 2, 'M0020', 'mahasiswa20', 'Tempat Lahir', '2024-09-21', 0, NULL, NULL),
(21, NULL, 4, '101', 'Mees Hilgres', 'Netherlands', '2024-09-10', NULL, NULL, NULL),
(23, NULL, 4, '100001', 'Maarten Paes', 'Netherlands', '2024-09-10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_20_144306_create_kelas_dosen_table', 1),
(6, '2024_09_20_144333_create_kelas_mahasiswa_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `request`
--

CREATE TABLE `request` (
  `id` int(10) UNSIGNED NOT NULL,
  `kelas_id` int(10) UNSIGNED DEFAULT NULL,
  `mahasiswa_id` int(10) UNSIGNED DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request`
--

INSERT INTO `request` (`id`, `kelas_id`, `mahasiswa_id`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, NULL, 7, 'Permintaan akses edit', NULL, NULL),
(4, NULL, 9, 'Permintaan akses edit', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('kaprodi','dosen','mahasiswa') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'kaprodiuser', 'kaprodi@example.com', '$2y$10$2AtGXEzXMqkywkxb9C/o9uT7OM4E.D7iyhUmleOu87U4Y21G8Uuvm', 'kaprodi', '2024-09-20 17:54:14', '2024-09-20 17:54:14'),
(2, 'dosen_wali1', 'dosenwali1@example.com', '$2y$10$D1jIK/qqCw/NGIus5F8XxOqbatOBNP63CflW8n8UY85A7ramBUAPG', 'dosen', '2024-09-20 17:54:14', '2024-09-20 17:54:14'),
(3, 'dosen_wali2', 'dosenwali2@example.com', '$2y$10$vPdKvZFIncbWrzK.2wQxyezfzlclFwMpvlE6T0LemspTDh1wVf2Pa', 'dosen', '2024-09-20 17:54:14', '2024-09-20 17:54:14'),
(4, 'dosen_biasa1', 'dosenbiasa1@example.com', '$2y$10$Sn6PhRwVPzdEO1mdKRm/s.MsHJFaNXdZCBm0nBh89xDhWqbV7e1wq', 'dosen', '2024-09-20 17:54:14', '2024-09-20 17:54:14'),
(5, 'dosen_biasa2', 'dosenbiasa2@example.com', '$2y$10$UF3CqNuxMaqiAyhmwBIu1uaU5V6tMGanmVOSaOA4oXRobJ0Vzz0se', 'dosen', '2024-09-20 17:54:14', '2024-09-20 17:54:14'),
(6, 'dosen_biasa3', 'dosenbiasa3@example.com', '$2y$10$2WUt1fJorR4tG.6UkDklFefFk1DZeTU5rP70BOgxzi34o6hHe.KdS', 'dosen', '2024-09-20 17:54:14', '2024-09-20 17:54:14'),
(7, 'mahasiswa1', 'mahasiswa1@example.com', '$2y$10$U5CiueL0/qOsj6WuBXsntef7PdDnTVegDtVWowGCfDNR2RDx4al9y', 'mahasiswa', '2024-09-20 17:54:14', '2024-09-20 17:54:14'),
(8, 'mahasiswa2', 'mahasiswa2@example.com', '$2y$10$lYC4/zbVRp0u7VHe9pOwNeWTqgKhESSX1IgbiIZiL8qagmci/jVbW', 'mahasiswa', '2024-09-20 17:54:14', '2024-09-20 17:54:14'),
(9, 'mahasiswa3', 'mahasiswa3@example.com', '$2y$10$MNU3I0wWFOZ3OY/jpUh8kuxHqXxA8XWED0C8IRMF4cXVfSu8.A09C', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(10, 'mahasiswa4', 'mahasiswa4@example.com', '$2y$10$FKwMR6.d//IoEsdqrvGlTeMwGz97Q3OMJIPQn5kobUqLMiEHS1tz.', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(11, 'mahasiswa5', 'mahasiswa5@example.com', '$2y$10$m.zmrVHxMGXnuXQg1.7K8efhQ85TqTvoGkPzyACsXqpxNsFWotxm6', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(12, 'mahasiswa6', 'mahasiswa6@example.com', '$2y$10$iXrwmagMu1DTlkhe9jMBO.tEqwcYmRl6z1xNGJ4NER.qAHV.M43Sq', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(13, 'mahasiswa7', 'mahasiswa7@example.com', '$2y$10$t4shvx/CjzJoarayXOqYo.ygins7Ve67m/L/O6Ntt5ctXniVWKGJ6', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(14, 'mahasiswa8', 'mahasiswa8@example.com', '$2y$10$7xPTg3E2H3AexQS04hJZDuMKtqtOTophhGcUlV0g4HAxR9hRt/TDi', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(15, 'mahasiswa9', 'mahasiswa9@example.com', '$2y$10$YwMJfVim2UOWDIeZkhF6YOhtl1rdNb.gPpsCbZ8LJYVI927pZk0FO', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(16, 'mahasiswa10', 'mahasiswa10@example.com', '$2y$10$sfnXLbfYF5qLEuKQ/1oAH.5rIuLYwh7KLzsWoGNdMpvMlEB3ze.iW', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(17, 'mahasiswa11', 'mahasiswa11@example.com', '$2y$10$no.9PxEk1c7ObleoyD2Vx.kpUwQrEL1oHMKcHudcqm0HOoLYXVyqW', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(18, 'mahasiswa12', 'mahasiswa12@example.com', '$2y$10$iZ9C6MVcfLinV0U1oLuug.zIzOTv2dusXD5h9IZTm9.Q6IIRgsSoi', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(19, 'mahasiswa13', 'mahasiswa13@example.com', '$2y$10$ViqeNGMYOemTWDChNhetrOrv4NUmbjQ5IJcm9qc4qBkjZNnV3IAKa', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(20, 'mahasiswa14', 'mahasiswa14@example.com', '$2y$10$piw/wshi6reV1QArf1xS3.5MfKnlkGronGip89u0cMOZXGpCxUSb6', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(21, 'mahasiswa15', 'mahasiswa15@example.com', '$2y$10$cGmoSGRJ.lDPzrZj/wkE9uHn7t0uejUCIDtlSorKzqnEEb6tPC.X6', 'mahasiswa', '2024-09-20 17:54:15', '2024-09-20 17:54:15'),
(22, 'mahasiswa16', 'mahasiswa16@example.com', '$2y$10$8dCz84AkCWQKyZ/ML8ez/ezr0TmzCg/eXMHUTVkvhc3IyiNszb0.G', 'mahasiswa', '2024-09-20 17:54:16', '2024-09-20 17:54:16'),
(23, 'mahasiswa17', 'mahasiswa17@example.com', '$2y$10$U.QToo53hUdHdkHaAzdhVuIq/NJBnvJeElP9HwXd3w7sVVqD5eyUW', 'mahasiswa', '2024-09-20 17:54:16', '2024-09-20 17:54:16'),
(24, 'mahasiswa18', 'mahasiswa18@example.com', '$2y$10$vCcH0PKkoR78VohEj7JUh.DFEN/Rq5IqVTu6ecQXPvzqLThheVP6q', 'mahasiswa', '2024-09-20 17:54:16', '2024-09-20 17:54:16'),
(25, 'mahasiswa19', 'mahasiswa19@example.com', '$2y$10$mAt.fpUO8Onx/TGPdGP71.zuGv4zpX6r.2/IRF09qMsgUH1wl.twK', 'mahasiswa', '2024-09-20 17:54:16', '2024-09-20 17:54:16'),
(26, 'mahasiswa20', 'mahasiswa20@example.com', '$2y$10$bNLBX5oNjeRtrJ5oZp5JDuavmmMUdfhYyo0lUSBZQjUXYsuj04ywW', 'mahasiswa', '2024-09-20 17:54:16', '2024-09-20 17:54:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kaprodi`
--
ALTER TABLE `kaprodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas_dosen`
--
ALTER TABLE `kelas_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_dosen_kelas_id_foreign` (`kelas_id`),
  ADD KEY `kelas_dosen_dosen_id_foreign` (`dosen_id`);

--
-- Indeks untuk tabel `kelas_mahasiswa`
--
ALTER TABLE `kelas_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_mahasiswa_kelas_id_foreign` (`kelas_id`),
  ADD KEY `kelas_mahasiswa_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `kelas_mahasiswa_dosen_id_foreign` (`dosen_id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kaprodi`
--
ALTER TABLE `kaprodi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kelas_dosen`
--
ALTER TABLE `kelas_dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelas_mahasiswa`
--
ALTER TABLE `kelas_mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `request`
--
ALTER TABLE `request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dosen_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Ketidakleluasaan untuk tabel `kaprodi`
--
ALTER TABLE `kaprodi`
  ADD CONSTRAINT `kaprodi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `kelas_dosen`
--
ALTER TABLE `kelas_dosen`
  ADD CONSTRAINT `kelas_dosen_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_dosen_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas_mahasiswa`
--
ALTER TABLE `kelas_mahasiswa`
  ADD CONSTRAINT `kelas_mahasiswa_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_mahasiswa_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_mahasiswa_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Ketidakleluasaan untuk tabel `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
