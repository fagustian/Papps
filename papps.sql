-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 Feb 2018 pada 11.57
-- Versi Server: 5.7.19-log
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `papps`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `follower`
--

CREATE TABLE `follower` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `isfollowing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `follower`
--

INSERT INTO `follower` (`id`, `follower_id`, `isfollowing_id`) VALUES
(19, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id`, `status`, `user_id`, `tanggal`) VALUES
(1, 'Selamat Pagi Cibodas :)', 1, '2018-02-17 09:13:23'),
(2, 'Namaku Muhamad Faisal Akbar', 2, '2018-02-17 09:25:39'),
(3, 'Selamat Malam :)', 1, '2018-02-18 20:11:50'),
(4, 'Selamat sore :) tos tuang teu acan', 4, '2018-02-19 17:54:09'),
(5, 'nulis deui', 4, '2018-02-19 17:56:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Fuji Agustian', 'fuji@gmail.com', '7bfc85c0d74ff05806e0b5a0fa0c1df1'),
(2, 'Muhamad Faisal Akbar', 'faisal@gmail.com', 'e39a411b54c3ce46fd382fef7f632157'),
(3, 'Dion', 'dion@gmail.com', '19b2e8bc116a78f4fdb699953e26ac52'),
(4, 'Ibu Dede', 'ibu@gmail.com', '8a6dbf554746d73e62de6e21509b6ee2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follower`
--
ALTER TABLE `follower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
