-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2026 pada 17.11
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
-- Database: `es_duren_oya_3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `nama`, `deskripsi`, `harga`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Es Duren Original', 'Es durian klasik dengan daging durian asli pilihan.', 15000, NULL, '2026-10-20 20:44:06', '2026-10-20 20:44:06'),
(2, 'Es Duren Keju', 'Es durian dengan topping keju melimpah.', 20000, NULL, '2026-10-20 20:44:06', '2026-10-20 20:44:06'),
(3, 'Es Duren Coklat', 'Es durian dengan saus coklat premium.', 18000, NULL, '2026-10-20 20:44:06', '2026-10-20 20:44:06'),
(4, 'Es Duren Mix Topping', 'Es durian dengan aneka topping (keju, coklat, kacang).', 25000, NULL, '2026-10-20 20:44:06', '2026-10-20 20:44:06'),
(5, 'Pancake Durian', 'Pancake lembut dengan isian durian asli.', 22000, NULL, '2026-10-20 20:44:06', '2026-10-20 20:44:06'),
(6, 'Durian Segar (per porsi)', 'Daging durian segar tanpa campuran.', 30000, NULL, '2026-10-20 20:44:06', '2026-10-20 20:44:06'),
(7, 'Es Duren Original', 'Es durian klasik dengan daging durian asli pilihan.', 15000, NULL, '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(8, 'Es Duren Keju', 'Es durian dengan topping keju melimpah.', 20000, NULL, '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(9, 'Es Duren Coklat', 'Es durian dengan saus coklat premium.', 18000, NULL, '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(10, 'Es Duren Mix Topping', 'Es durian dengan aneka topping (keju, coklat, kacang).', 25000, NULL, '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(11, 'Pancake Durian', 'Pancake lembut dengan isian durian asli.', 22000, NULL, '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(12, 'Durian Segar (per porsi)', 'Daging durian segar tanpa campuran.', 30000, NULL, '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(13, 'Es Duren Original', 'Es durian klasik dengan daging durian asli pilihan.', 15000, NULL, '2026-10-20 20:48:22', '2026-10-20 20:48:22'),
(14, 'Es Duren Keju', 'Es durian dengan topping keju melimpah.', 20000, NULL, '2026-10-20 20:48:22', '2026-10-20 20:48:22'),
(15, 'Es Duren Coklat', 'Es durian dengan saus coklat premium.', 18000, NULL, '2026-10-20 20:48:22', '2026-10-20 20:48:22'),
(16, 'Es Duren Mix Topping', 'Es durian dengan aneka topping (keju, coklat, kacang).', 25000, NULL, '2026-10-20 20:48:22', '2026-10-20 20:48:22'),
(17, 'Pancake Durian', 'Pancake lembut dengan isian durian asli.', 22000, NULL, '2026-10-20 20:48:22', '2026-10-20 20:48:22'),
(18, 'Durian Segar (per porsi)', 'Daging durian segar tanpa campuran.', 30000, NULL, '2026-10-20 20:48:22', '2026-10-20 20:48:22');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_01_110607_create_menus_table', 1),
(5, '2026_10_21_033933_create_settings_table', 1);

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
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0RifEgGu6yj4FoP33FJFD2UwoRSjZrz9XXA2xAiF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibW1aV1NMckREczJ5d0M0NDI4cTU0dnpmUGZrMlNjTWI2YUFHUkR2ciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1794385147),
('3FZODYpPbOPEiw3dh5jpJb0veTK9d6RtEiOfD5jh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0k5d2dDeG1XRW5TRnQzVXNyZ2ZXUTZuM2lOaWZDNzI0T3hMMFZzUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1794384639),
('8qEkiORigRpNlcymf8BCkAY35pdCOJJbLy9773cM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDFWYks0cDlyUk5UcUZpRTFYNEp5MHFRdmFCRUpWaXJubExic25oRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1793751905),
('drGKxwOB6Z5RGsMMBpiuP2jH2qWgGOsr1ycF8iqO', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic1k5N0hkVTdEUW5ZMXNybmdLa2dyMFI2ZExIV3AzY1NPMFR3UGw2SiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiYzlhNmQ2MGRjMzdjYmYxZDk2Y2E4ZmE2ODdhMzNiNTNhMDYwOWE3OTRmMTk3MzBhOWZmOGY3NjNmYWI3NGZjYyI7fQ==', 1793757259),
('glTmKd5UjsVWtlIBkkz0IRJYdS67hC3VsZW4e3hV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRE43Rk9pSExjakZhUXp4UGU3QURTSlVrUkZMV28zMHhrNlU4TUlzRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1793751904),
('GMqoQ1rBszH5L96ocRoR9TF3rGQoP3aYAK6hnS7Y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmR1V3VlVXF4QnlMV3hQdWxqa3UwWk5laGNKVXNvc1hVdG85VjRDRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1793931831),
('MWOTXECmNIqkY8z9iZYuiU3lJUGqmHdjuqNmNzFI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYWRVVFhQcXBkY09Pa09Pczc1NlJyV1hYUGRwN1NCZzN1OEkwVmZHaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1794363725),
('pYW9Zuk46PwBCX8nWLCMoSNeVU0L2C89PfLnw5hs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHJwTmdVWkFXc0cwUmNmZjZ6UmtWejlzdmFzRW5jUzk1UDQxaTlkNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1793751908),
('WBxj3oGtlnfBDs9oK6vPbXLmnGV0nEG7JiEt3Vhq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidHRnZjlnTnpCaG9UVlJmSER4Z3dRNE9tMUtJUmd4TTZqTUV2MkhGVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiYzlhNmQ2MGRjMzdjYmYxZDk2Y2E4ZmE2ODdhMzNiNTNhMDYwOWE3OTRmMTk3MzBhOWZmOGY3NjNmYWI3NGZjYyI7fQ==', 1794363911),
('WzLTBmnsKyKrXnQSUiMuOfKETe3LLiqhuhqonQZn', NULL, '127.0.0.1', 'WhatsApp/2.2642.101 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiME1iVW1zRHJwU3lIYVhRaloxOUcyWURKcTdKc3g0SHVXa2lNZG4xMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1794358421),
('XqWAVdxywONfTvz1ly4UOwNFTPHFC0KaqKKvQfg4', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUVoVXhjTTI2alB3OEpXVnkyUE90dGJwSThpUDRFUGsyWjBJeHRHWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1794358461),
('ZDZk4SBTY1yyCEieIrPzv7RQc8ya7qvbVHzCHoOs', NULL, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTEFqZ2xneEx2Sno3ano4aE84dGhBWW1HTldYWDc2WEhWckZsbGladiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1794373115),
('ZW86trEEktuQVJLGdT2jnVABDMe9V8ewZnbHPtKL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMXVqN0F3M3g0cDczQlF0WXF0VlFTaUNjZkJuSWo1QkhnTVRJRmIxMSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3NldHRpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1793765942);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'hero_title', 'Es Duren Oya', '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(2, 'hero_desc', 'Nikmati sensasi olahan durian segar dengan cita rasa autentik dan bahan pilihan. Es Duren Oya hadir untuk memanjakan lidah Anda dengan berbagai varian menu durian yang lezat.', '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(3, 'visi', 'Menjadi usaha kuliner olahan durian yang terpercaya dan digemari masyarakat, dengan menyajikan produk berkualitas, higienis, dan bercita rasa khas.', '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(4, 'misi', 'Menyajikan olahan durian dengan bahan segar dan berkualitas.\nMemberikan pelayanan yang ramah dan cepat kepada pelanggan.\nMenjaga kebersihan dan higienitas produk.\nMengembangkan varian menu yang inovatif dan sesuai selera pelanggan.\nMenjalin hubungan baik dengan pelanggan dan masyarakat sekitar.', '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(5, 'tentang', 'Es Duren Oya merupakan usaha yang bergerak di bidang kuliner, khususnya makanan dan minuman berbahan dasar durian. Berlokasi di Jl. Sadarmanah No. 30, Leuwigajah, Kecamatan Cimahi Selatan, Kota Cimahi, Jawa Barat.\n\nUsaha ini hadir dengan tujuan memberikan produk olahan durian yang lezat, segar, dan terjangkau bagi masyarakat. Kami berkomitmen untuk menggunakan bahan-bahan pilihan serta menjaga kualitas rasa di setiap penyajian.', '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(6, 'peran_owner', 'Bertanggung jawab mengelola usaha secara keseluruhan, serta membeli dan menyediakan bahan-bahan yang diperlukan untuk kegiatan produksi.', '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(7, 'peran_server', 'Bertugas melayani pelanggan, menerima pembayaran, dan membuat produk sesuai pesanan pelanggan dengan cepat dan ramah.', '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(8, 'kontak_wa', '6281234567890', '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(9, 'kontak_ig', '@esdurenoya', '2026-10-20 20:47:39', '2026-10-20 20:47:39'),
(10, 'kontak_email', 'info@esdurenoya.com', '2026-10-20 20:47:39', '2026-10-20 20:47:39');

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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Owner Es Duren Oya', 'owner@esdurenoya.com', NULL, '$2y$12$D5woT6Yu8Odm19N2IQvf6.R4LZoBr2KVqKppfBZh8fffgpM98L3GS', NULL, '2026-10-20 20:44:06', '2026-10-20 20:44:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

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
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
