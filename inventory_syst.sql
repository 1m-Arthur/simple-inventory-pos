-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Mar 2020 pada 08.08
-- Versi server: 10.4.12-MariaDB
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
-- Database: `inventorsys`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_tersedia`
--

CREATE TABLE `bahan_tersedia` (
  `tersedia_id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `stock_awal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan_tersedia`
--

INSERT INTO `bahan_tersedia` (`tersedia_id`, `bahan_id`, `stock_awal`) VALUES
(5, 1, 1600);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `pekerjaan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lppm_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bahan_id` int(11) NOT NULL,
  `disposisi_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `tgl_diperlukan` date NOT NULL,
  `tgl_pengajuan` datetime DEFAULT NULL,
  `tgl_reject` datetime DEFAULT NULL,
  `tgl_approve` datetime DEFAULT NULL,
  `tgl_po` datetime DEFAULT NULL,
  `tgl_penerimaan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`pekerjaan_id`, `user_id`, `lppm_no`, `bahan_id`, `disposisi_id`, `qty`, `satuan_id`, `created_date`, `tgl_diperlukan`, `tgl_pengajuan`, `tgl_reject`, `tgl_approve`, `tgl_po`, `tgl_penerimaan`) VALUES
(30, 1, 'LP-1904160001', 1, 6, 5000, 1, '2019-04-16 20:39:00', '2019-04-30', '2019-04-16 20:39:00', NULL, '2019-04-16 20:39:00', '2019-04-16 20:39:00', '2019-04-16 20:39:00'),
(31, 1, 'LP-1904160002', 1, 6, 3000, 1, '2019-04-16 20:40:00', '2019-04-30', '2019-04-16 20:40:00', NULL, '2019-04-16 20:40:00', '2019-04-16 20:40:00', '2019-04-16 20:40:00'),
(32, 1, 'LP-1904170001', 1, 6, 2000, 1, '2019-04-17 22:01:00', '2019-05-01', '2019-04-17 22:02:00', NULL, '2019-04-17 22:02:00', '2019-04-17 22:07:00', '2019-04-18 22:07:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan`
--

CREATE TABLE `penerimaan` (
  `penerimaan_id` int(11) NOT NULL,
  `pekerjaan_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penerimaan`
--

INSERT INTO `penerimaan` (`penerimaan_id`, `pekerjaan_id`, `user_id`) VALUES
(17, 30, 15),
(18, 31, 14),
(19, 32, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `kode_bon_permintaan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approve` tinyint(1) DEFAULT NULL,
  `tgl_pengeluaran` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `kode_bon_permintaan`, `approve`, `tgl_pengeluaran`) VALUES
(12, 'BP-1904171001', 1, '2019-04-16 21:29:00'),
(13, 'BP-1904171002', 1, '2019-04-17 21:36:00'),
(14, 'BP-1904181001', 1, '2019-04-19 22:36:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan`
--

CREATE TABLE `permintaan` (
  `kode_bon_permintaan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerimaan_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `qty_permintaan` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_permintaan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permintaan`
--

INSERT INTO `permintaan` (`kode_bon_permintaan`, `user_id`, `nama_penerima`, `penerimaan_id`, `purchase_id`, `qty_permintaan`, `keterangan`, `tgl_permintaan`) VALUES
('BP-1904171001', 14, 'test penerima', 17, 15, 6000, 'test ahj', '2019-04-17 20:41:00'),
('BP-1904171002', 14, 'test 1233', 18, 16, 1000, 'test', '2019-04-17 21:36:00'),
('BP-1904181001', 13, 'penerimas', 19, 17, 1400, 'asd', '2019-04-18 22:08:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_order`
--

CREATE TABLE `purchase_order` (
  `purchase_id` int(11) NOT NULL,
  `po_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_id` int(11) NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchase_order`
--

INSERT INTO `purchase_order` (`purchase_id`, `po_no`, `pekerjaan_id`, `nama_supplier`, `harga_satuan`, `total_harga`) VALUES
(15, 'PO-1904161001', 30, 'test abc', 5000, 25000000),
(16, 'PO-1904161002', 31, 'tes mhankk', 5000, 15000000),
(17, 'PO-1904171001', 32, 'supply', 5000, 10000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `pekerjaan_id` int(11) NOT NULL,
  `qty_awal` int(11) NOT NULL,
  `qty_terima` int(11) DEFAULT NULL,
  `qty_pengeluaran` int(11) DEFAULT NULL,
  `stock_akhir` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`stock_id`, `bahan_id`, `pekerjaan_id`, `qty_awal`, `qty_terima`, `qty_pengeluaran`, `stock_akhir`, `created_date`) VALUES
(4, 1, 30, 0, 5000, 6000, 2000, '2019-04-16'),
(5, 1, 31, 5000, 3000, NULL, 8000, '2019-04-16'),
(6, 1, 31, 0, NULL, 1000, -1000, '2019-04-17'),
(7, 1, 32, 1000, 2000, NULL, 3000, '2019-04-18'),
(8, 1, 32, 3000, NULL, 1400, 1600, '2019-04-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bahan_baku`
--

CREATE TABLE `tbl_bahan_baku` (
  `bahan_id` int(11) NOT NULL,
  `nama_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_bahan_baku`
--

INSERT INTO `tbl_bahan_baku` (`bahan_id`, `nama_bahan`) VALUES
(1, 'Semen'),
(2, 'Kapur'),
(3, 'Gypsum'),
(4, 'Pasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_departemen`
--

CREATE TABLE `tbl_departemen` (
  `departemen_id` int(11) NOT NULL,
  `nama_departemen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_departemen`
--

INSERT INTO `tbl_departemen` (`departemen_id`, `nama_departemen`) VALUES
(1, 'admin'),
(2, 'Plant Manager Produksi'),
(3, 'Kepala Bagian'),
(4, 'Warehouse'),
(5, 'Produksi'),
(6, 'Purchasing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_disposisi`
--

CREATE TABLE `tbl_disposisi` (
  `disposisi_id` int(11) NOT NULL,
  `nama_disposisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_disposisi`
--

INSERT INTO `tbl_disposisi` (`disposisi_id`, `nama_disposisi`) VALUES
(1, 'Permintaan'),
(2, 'Pengajuan'),
(3, 'Approve'),
(4, 'Purchase Order'),
(5, 'Penerimaan Barang'),
(6, 'Selesai'),
(7, 'Ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `satuan_id` int(11) NOT NULL,
  `nama_satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`satuan_id`, `nama_satuan`) VALUES
(1, 'Kg'),
(2, 'gr'),
(3, 'unit'),
(4, 'pcs'),
(5, 'dus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departemen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `departemen_id`) VALUES
(1, 'admin', '$2y$10$XjYBFa9ZiPEQT9cW1ElWNOPvi.1tI6zl6ffTJOxJcHhi22s9OzO/y', 'administrator', '', 1),
(8, 'Yudharto', '$2y$10$7ovZgzlAb5zEytYKXoxjSuK7BZ3jBCNswi.meHeYMVlZ7ULLnIFOq', 'Yudharto', 'Aribowo, ST', 2),
(9, 'Subanun', '$2y$10$B2kqh6w94CzDNL/gfwxw7eHAW1lev.DCDKhBsjc1aLwvMEJr9YzxC', 'Subanun', '', 3),
(10, 'Susilo', '$2y$10$8aE1eUT8fwW7mmHQtRWWPuDzpV0EOphw/zIhhOpuuJ4QCwplvm3Va', 'Susilo', '', 3),
(11, 'Khairul', '$2y$10$GmSNGdmbbQzZhOJWxKxZIuIjw2tn/vLZP/GDijYklW2V9ycf6iJf.', 'Khairul', 'Waris', 4),
(12, 'Mulyono', '$2y$10$LMHzB8YCZR2c/wJaqQg6/uZR44KAg7Uet5JEgvgm0sTcdcwQ.cMHi', 'Mulyono', '', 4),
(13, 'Jasmantoro', '$2y$10$dAShsl6urtlOMU.PvdVAWuhOI3YfYhp.OcuAC4GD5YPsklBkZTEZ6', 'Jasmantoro', '', 5),
(14, 'Supriadi', '$2y$10$LKcNFxgCfQlWoOlx9BhkKeq2iSLUxM5mYUpnJHT4Iut5rVH0asliC', 'Supriadi', '', 5),
(15, 'Sonang', '$2y$10$3nqgY9aSiozef74K7px1DOHC3fuDeM/0jGCeg.tQ4HbalVt28Vl/S', 'Sonang', '', 6);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan_tersedia`
--
ALTER TABLE `bahan_tersedia`
  ADD PRIMARY KEY (`tersedia_id`);

--
-- Indeks untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`pekerjaan_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bahan_id` (`bahan_id`),
  ADD KEY `disposisi_id` (`disposisi_id`),
  ADD KEY `satuan_id` (`satuan_id`);

--
-- Indeks untuk tabel `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`penerimaan_id`),
  ADD KEY `pekerjaan_id` (`user_id`),
  ADD KEY `pekerjaan_id_2` (`pekerjaan_id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`kode_bon_permintaan`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `penerimaan_id` (`penerimaan_id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indeks untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `pekerjaan_id` (`pekerjaan_id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indeks untuk tabel `tbl_bahan_baku`
--
ALTER TABLE `tbl_bahan_baku`
  ADD PRIMARY KEY (`bahan_id`);

--
-- Indeks untuk tabel `tbl_departemen`
--
ALTER TABLE `tbl_departemen`
  ADD PRIMARY KEY (`departemen_id`);

--
-- Indeks untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD PRIMARY KEY (`disposisi_id`);

--
-- Indeks untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `departemen_id` (`departemen_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan_tersedia`
--
ALTER TABLE `bahan_tersedia`
  MODIFY `tersedia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `pekerjaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `penerimaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_bahan_baku`
--
ALTER TABLE `tbl_bahan_baku`
  MODIFY `bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_departemen`
--
ALTER TABLE `tbl_departemen`
  MODIFY `departemen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  MODIFY `disposisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD CONSTRAINT `pekerjaan_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `tbl_satuan` (`satuan_id`),
  ADD CONSTRAINT `pekerjaan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `pekerjaan_ibfk_3` FOREIGN KEY (`bahan_id`) REFERENCES `tbl_bahan_baku` (`bahan_id`),
  ADD CONSTRAINT `pekerjaan_ibfk_4` FOREIGN KEY (`disposisi_id`) REFERENCES `tbl_disposisi` (`disposisi_id`);

--
-- Ketidakleluasaan untuk tabel `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`pekerjaan_id`) REFERENCES `pekerjaan` (`pekerjaan_id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`departemen_id`) REFERENCES `tbl_departemen` (`departemen_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
