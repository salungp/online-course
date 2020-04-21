-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 14 Apr 2020 pada 08.31
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
-- Database: `online-course`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `text` varchar(256) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `course_id`, `text`, `status`, `date`, `created_at`, `updated_at`) VALUES
(2, 4, 6, 'Sebuah kegiatan', 0, '2020-04-11 00:00:00', '2020-04-10 15:32:28', '2020-04-10 15:32:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `text`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 4, 'Test comment', 1, '2020-04-10 04:27:00', '2020-04-10 04:27:00'),
(4, 4, 'Wihhh', 3, '2020-04-10 04:29:11', '2020-04-10 04:29:11'),
(5, 4, 'Komen ahh', 3, '2020-04-10 04:29:26', '2020-04-10 04:29:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `slug` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `media` varchar(256) NOT NULL,
  `author` int(11) NOT NULL,
  `theme` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `description`, `media`, `author`, `theme`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'test', 'Cuma test', './uploads/users/media/test-5e8fddf5a217e.png', 1, 'blue', 'upload', '2020-04-10 02:46:13', '2020-04-10 03:30:22'),
(2, 'Test 2', 'test-2', 'Cuma test 2', './assets/users/media/test-2-5e8fde87646a0.png', 1, 'yellow', 'upload', '2020-04-10 02:48:39', '2020-04-10 03:30:29'),
(4, 'Test 3', 'test-3', 'Test', './assets/users/media/test-3-5e8fe015adc09.png', 1, 'red', 'upload', '2020-04-10 02:55:17', '2020-04-10 04:12:55'),
(5, 'Coba', 'coba', 'Keterangan coba', './assets/users/media/coba-5e9022759915a.png', 1, 'green', 'upload', '2020-04-10 07:38:29', '2020-04-10 07:38:29'),
(6, 'Banner section', 'banner-section', 'Banner section', './assets/users/media/banner-section-5e9034aa33a85.png', 1, 'purple', 'upload', '2020-04-10 08:56:10', '2020-04-10 08:56:10'),
(8, 'Game YouTube', 'game-youtube', 'Berisi video YouTube', 'https://youtu.be/9h6X52V4Qwk', 1, 'yellow', 'link', '2020-04-13 14:19:19', '2020-04-13 14:19:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `total` varchar(256) NOT NULL,
  `date` datetime NOT NULL,
  `author` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id`, `title`, `total`, `date`, `author`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pembayaran bulan april sudah mulai', '300000', '2020-04-13 00:00:00', 1, 0, '2020-04-13 13:28:52', '2020-04-13 13:28:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `text` varchar(256) NOT NULL,
  `author` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `text`, `author`, `created_at`, `updated_at`) VALUES
(1, 'Pembayaran bulan april sudah mulai', 1, '2020-04-13 13:28:52', '2020-04-13 13:28:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `profile_picture` varchar(256) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `email`, `profile_picture`, `status`, `level`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'anonim', 'admin@gmail.com', './assets/users/images/online-course-87488900aee5734f22c292cb463f7c2a.png', 1, 1, '$2y$10$EFfT8Sif0Lc7DMis6QM81Op.zWoZp..dvovSOXKhjZLX7uXpzSxnm', '2020-04-09 14:35:46', '2020-04-10 07:18:00'),
(3, 'Kevin alvaro', 'Mlonggo', 'kevin@gmail.com', './assets/users/images/online-course-1286fc41fc51a41f6c38d167d5743d00.jpg', 0, 3, '$2y$10$fNvH7sqIfgjnhQcBEU9toeQJcKEed4A92OKwV0CaXA.1CvLq0AGoy', '2020-04-09 13:57:49', '2020-04-09 14:15:23'),
(4, 'Salung Prastyo', 'Mlonggo', 'salungprastyo@gmail.com', './assets/dist/img/avatar5.png', 0, 3, '$2y$10$D462uNkuiX0ywlU9xzk8tOWnQ3ArLKMbCeVOFsViY9jS/wwYTA7Ri', '2020-04-10 09:12:54', '2020-04-10 09:12:54'),
(5, 'Fahrul junies', 'Mlonggo', 'fahruljunies@yahoo.com', './assets/users/images/online-course-7554d754bd7842f26592fa6b263ba303.jpg', 0, 3, '$2y$10$E2mSGvbHW3XupcL1F/khveXwil5m192PS0/162ZqKixBsgl4SGid.', '2020-04-13 13:56:17', '2020-04-13 14:07:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_invoices`
--

CREATE TABLE `user_invoices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_invoices`
--

INSERT INTO `user_invoices` (`id`, `user_id`, `invoice_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, '2020-04-13 17:05:50', '2020-04-13 17:35:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_invoices`
--
ALTER TABLE `user_invoices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_invoices`
--
ALTER TABLE `user_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
