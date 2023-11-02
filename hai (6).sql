-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2023 at 03:45 AM
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
-- Database: `hai`
--

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `app_id` int NOT NULL,
  `address` text,
  `telp` varchar(30) NOT NULL,
  `img_banner1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img_banner2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(80) NOT NULL,
  `footer_desc` text NOT NULL,
  `header_desc1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `header_desc2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `about_us` text NOT NULL,
  `main_logo` varchar(255) NOT NULL DEFAULT 'img_login.png',
  `img_about_us1` varchar(255) NOT NULL,
  `img_about_us2` varchar(255) NOT NULL,
  `url_instagram` text NOT NULL,
  `url_facebook` text NOT NULL,
  `url_x` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `header1` varchar(100) NOT NULL,
  `header2` varchar(100) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`app_id`, `address`, `telp`, `img_banner1`, `img_banner2`, `email`, `footer_desc`, `header_desc1`, `header_desc2`, `about_us`, `main_logo`, `img_about_us1`, `img_about_us2`, `url_instagram`, `url_facebook`, `url_x`, `header1`, `header2`, `updated_at`) VALUES
(1, 'No. 14 Jl. Pahlawan 50241 Semarang Selatan Jawa Tengah ', '08232933', 'Banner_1.jpg', 'Banner_2.jpg', 'kejateng@gmail.com', 'Ubah deskripsi footer ini pada halaman pengaturan daskrimti.', 'Ubah tulisan deskripsi ini pada halaman pengaturan daskrimti.', 'Ubah tulisan deskripsi ini pada halaman pengaturan daskrimti.', 'Selamat datang di website resmi Helpdesk Kejaksaan Tinggi Jawa Tengah! Kami hadir sebagai solusi terbaik bagi para staff dan pegawai Kejaksaan Tinggi Jawa Tengah dalam mengajukan permohonan kepada DASKRIMTI (Divisi Administrasi dan Kepegawaian) secara efisien dan transparan. Kami berkomitmen untuk menyediakan layanan terbaik dengan cepat dan mudah, sehingga Anda dapat fokus pada tugas-tugas Anda yang penting. Terima kasih telah mempercayai kami sebagai partner dalam menjalankan tugas-tugas Anda.', 'img_login.png', 'About_us1.jpg', 'About_us2.jpg', 'https://www.instagram.com/kejatijateng/', 'https://www.facebook.com/KejatiJateng/', 'https://twitter.com/Penkum_KTJateng', 'Kejaksaan Tinggi Jawa Tengah', 'Kejaksaan Tinggi Jawa Tengah', '2023-11-01 15:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `balasan_permohonan`
--

CREATE TABLE `balasan_permohonan` (
  `balasan_permohonan_id` bigint NOT NULL,
  `permohonan_id` bigint NOT NULL,
  `daskrimti_id` int NOT NULL,
  `balasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = is active\r\n0 = not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `bidang_id` int NOT NULL,
  `nama_bidang` varchar(80) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = is active\r\n0 = not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`bidang_id`, `nama_bidang`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pembinaan', 1, '2023-10-26 09:19:30', NULL),
(2, 'Pidum (Pidana Umum)', 1, '2023-10-26 09:19:30', NULL),
(3, 'Pidsus (Pidana Khusus)', 1, '2023-10-26 09:20:30', NULL),
(4, 'Intelijen', 1, '2023-10-26 09:20:30', NULL),
(5, 'Datun', 1, '2023-10-26 09:20:30', NULL),
(6, 'Pidmil', 1, '2023-10-26 09:20:30', NULL),
(7, 'Pengawasan', 1, '2023-10-26 09:21:29', NULL),
(8, 'Tata Usahaa', 1, '2023-10-26 09:21:29', '2023-11-01 22:47:56'),
(9, 'Umum', 1, '2023-10-29 10:36:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daskrimti`
--

CREATE TABLE `daskrimti` (
  `daskrimti_id` int NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(80) NOT NULL,
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `daskrimti`
--

INSERT INTO `daskrimti` (`daskrimti_id`, `email`, `password`, `name`, `profile_photo`, `created_at`, `updated_at`) VALUES
(1, 'daskrimti@gmail.com', '$2y$10$nb1Sx4ZhiKt1Hw.WfGN6P.28iR3GCX8bCqC4.mFGgN21RtEJzDR.a', 'Jhon Doee', 'Daskrimti-1.png', '2023-10-28 09:15:49', '2023-10-31 03:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `layanan_id` int NOT NULL,
  `nama_layanan` varchar(50) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = is active\r\n0 = not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`layanan_id`, `nama_layanan`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pertanyaan Umum', 'Pelayanan ini mencakup pertanyaan umum tentang peran \r\ndan fungsi kejaksaan, jadwal operasional, alamat kantor, dan informasi kontak', 1, '2023-10-25 00:55:52', '2023-10-29 09:37:20'),
(2, 'Layanan Hukum', 'Memberikan informasi hukum umum kepada masyarakat, \ntermasuk hak dan kewajiban mereka dalam sistem hukum, proses pengadilan, \nserta panduan tentang bagaimana mengajukan laporan atau pengaduan.', 1, '2023-10-25 00:55:33', NULL),
(3, 'Pelaporan Kejahatan', 'Masyarakat dapat melaporkan kejahatan atau insiden kepada kejaksaan melalui helpdesk. Petugas helpdesk dapat membantu mereka dengan panduan prosedur pelaporan.', 1, '2023-10-25 00:59:19', NULL),
(4, 'Pelayanan Korban', 'Memberikan dukungan dan informasi kepada korban kejahatan, termasuk hak korban, layanan yang tersedia, dan panduan tentang \r\nbagaimana mengakses bantuan.\r\n', 1, '2023-10-25 00:59:19', NULL),
(5, 'Informasi Proses Peradilan', 'Memberikan informasi tentang tahapan proses peradilan, hak tersangka, persiapan untuk pengadilan, dan penjelasan tentang \r\nkeputusan pengadilan.', 1, '2023-10-24 17:00:00', NULL),
(6, 'Perizinan dan Dokumen Hukum', 'Membantu masyarakat dalam memahami \r\npersyaratan perizinan dan dokumen hukum, serta panduan tentang bagaimana \r\nmengajukan permohonan.', 1, '2023-10-25 00:59:19', NULL),
(7, 'Pertanyaan Terkait Denda dan Sanksi', 'Memberikan informasi tentang denda, sanksi, atau tindakan hukum yang dapat dikenakan kepada pelanggar \r\nhukum.', 1, '2023-10-25 00:59:19', NULL),
(8, 'Pertanyaan tentang Kasus Tertentu', 'Masyarakat dapat mengajukan pertanyaan tentang kasus tertentu yang sedang dalam proses peradilan, \r\ntermasuk status kasus dan perkembangannya.', 1, '2023-10-25 01:03:24', NULL),
(9, 'Layanan Pengaduan', 'Menerima pengaduan dari masyarakat terkait dengan kinerja atau perilaku pegawai kejaksaan, jika ada.', 1, '2023-10-25 00:59:19', NULL),
(10, 'Bantuan Teknis', 'Memberikan dukungan teknis terkait dengan layanan online, seperti portal pengadilan elektronik atau pengisian dokumen secara elektronik.', 1, '2023-10-24 17:00:00', NULL),
(11, 'Panduan Pengisian Dokumen', 'Membantu masyarakat dalam pengisian \r\ndokumen hukum yang diperlukan, termasuk formulir permohonan atau \r\npengaduan.', 1, '2023-10-25 00:59:19', NULL),
(12, 'Edukasi Hukum', 'Menyediakan program edukasi dan seminar tentang hukum bagi masyarakat umum.', 1, '2023-10-25 00:59:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `permohonan_id` bigint NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = valid\r\n0 = tidak valid',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = is read\r\n0 = not read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permohonan`
--

CREATE TABLE `permohonan` (
  `permohonan_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `subject` varchar(150) NOT NULL,
  `layanan_id` int NOT NULL,
  `keterangan` text,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 = done\r\n0 = tidak valid\r\n2 = on progress\r\n3 = hold',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int NOT NULL,
  `nama_type` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = is active\r\n0 = not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `nama_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dukungan umum', 1, '2023-10-25 00:39:18', NULL),
(2, 'Informasi umum', 1, '2023-10-25 00:39:18', NULL),
(3, 'Pertanyaan', 1, '2023-10-25 00:41:13', NULL),
(4, 'Keluhan', 1, '2023-10-25 00:41:13', NULL),
(5, 'Pelaporan masalah', 1, '2023-10-25 00:42:40', NULL),
(6, 'Pelayanan', 1, '2023-10-25 00:42:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint NOT NULL,
  `nrp` varchar(30) NOT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(300) NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bidang_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active\r\n0 = not active',
  `profile_photo` varchar(300) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `balasan_permohonan`
--
ALTER TABLE `balasan_permohonan`
  ADD PRIMARY KEY (`balasan_permohonan_id`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`bidang_id`);

--
-- Indexes for table `daskrimti`
--
ALTER TABLE `daskrimti`
  ADD PRIMARY KEY (`daskrimti_id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`layanan_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`permohonan_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `app_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `balasan_permohonan`
--
ALTER TABLE `balasan_permohonan`
  MODIFY `balasan_permohonan_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `bidang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `daskrimti`
--
ALTER TABLE `daskrimti`
  MODIFY `daskrimti_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `layanan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `permohonan_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
