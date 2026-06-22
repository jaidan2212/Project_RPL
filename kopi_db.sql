-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2026 at 06:46 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kopi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` int NOT NULL,
  `id_pesanan` int NOT NULL,
  `produk_id` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL,
  `subtotal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id`, `id_pesanan`, `produk_id`, `jumlah`, `harga`, `subtotal`) VALUES
(1, 1, 1, 1, 75000, 75000),
(2, 2, 2, 1, 60000, 60000),
(3, 2, 3, 1, 85000, 85000),
(4, 3, 1, 1, 75000, 75000),
(5, 3, 2, 1, 60000, 60000),
(6, 3, 3, 1, 85000, 85000),
(7, 4, 4, 1, 95000, 95000),
(8, 4, 5, 1, 150000, 150000),
(9, 5, 2, 1, 60000, 60000),
(10, 5, 6, 1, 80000, 80000),
(11, 6, 2, 1, 60000, 60000),
(12, 6, 3, 1, 85000, 85000),
(13, 7, 1, 1, 75000, 75000),
(14, 7, 2, 1, 60000, 60000),
(15, 7, 3, 1, 85000, 85000);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_header`
--

CREATE TABLE `pesanan_header` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total` int NOT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Pembayaran',
  `bukti` varchar(255) DEFAULT NULL,
  `pengambilan` varchar(50) DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan_header`
--

INSERT INTO `pesanan_header` (`id`, `nama`, `email`, `pembayaran`, `tanggal`, `total`, `status`, `bukti`, `pengambilan`) VALUES
(1, 'Dimas', 'fahdimas42@gmail.com', 'QRIS', '2026-04-02 06:26:10', 75000, 'Terverifikasi', 'BUKTI_1775111170_69ce0c02e4bec.png', 'belum'),
(2, 'habiba', 'nurhabibatulumah@gmail.com', 'Transfer Bank', '2026-06-17 01:35:52', 145000, 'lunas', 'BUKTI_1781660152.png', 'diambil'),
(3, 'customer', 'customer@gmail.com', 'Transfer Bank', '2026-06-17 02:34:22', 220000, 'lunas', 'BUKTI_1781663662.png', 'diambil'),
(4, 'customer1', 'cust1@gmail.com', 'Transfer Bank', '2026-06-17 02:40:17', 245000, 'lunas', 'BUKTI_1781664017.png', 'diambil'),
(5, 'salwa', 'salwa@gmail.com', 'Transfer Bank', '2026-06-17 02:48:14', 140000, 'lunas', 'BUKTI_1781664494.png', 'diambil'),
(6, 'cust1', 'cust1@gmail.com', 'Transfer Bank', '2026-06-17 02:54:46', 145000, 'lunas', 'BUKTI_1781664886.png', 'diambil'),
(7, 'Nurhabibatul Umah', 'nurhabibatulumah@gmail.com', 'Transfer Bank', '2026-06-17 03:21:52', 220000, 'lunas', 'BUKTI_1781666512.png', 'diambil');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `gambar`, `stok`) VALUES
(1, 'Kopi Arabica', 75000, 'arabica.jpg', 47),
(2, 'Kopi Robusta', 60000, 'robusta.jpg', 45),
(3, 'Kopi Liberica', 85000, 'liberica.jpg', 46),
(4, 'Excelsa Wonosalam', 95000, 'excelsa.jpg', 49),
(5, 'Kopi Luwak Premium', 150000, 'luwak.jpg', 49),
(6, 'Kopi Decaf', 80000, 'decaf.jpg', 49);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `role` enum('admin','user') NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `telp`, `password`, `otp_code`, `otp_expiry`, `role`, `foto`) VALUES
(1, 'admin', '', NULL, '<?= password_hash(\"admin123\", PASSWORD_DEFAULT) ?>', NULL, NULL, 'admin', NULL),
(2, 'idan', '', NULL, '$2y$10$LROU6BAVAX0meRoOBiYRa.yN9qiNFi2F.BHZdRashqWRDumBVgNsu', NULL, NULL, 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
(3, 'idan', '', NULL, '$2y$10$jBJBdCnD4buVnkr/T26RkOMa9r.htiZZbsSysbqVsg2uVevXmAdnS', NULL, NULL, 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
(4, 'idan', '', NULL, '$2y$10$z6/MclKKgw8eSHPKreT5I.QvhYbSDVXXDI0nYppWkLtEK9JXkZdcC', NULL, NULL, 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
(5, 'idan', '', NULL, '$2y$10$WbapgFHdfzU.r9aMbZ07COjNf8TagVOfnSE0P2EAfiIMUmN8eQroG', NULL, NULL, 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
(6, 'zaidan', '', NULL, '$2y$10$VhzGJyCeVbH1YvIWQfwuoemkGcZvSQBd0po.ZpP1GHQaB8ONI3PF2', NULL, NULL, 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
(7, 'zaidan', '', NULL, '$2y$10$lflfU5PBGv1B5qU6msBTn.MaEViAd002OAIYIAuIfyEHVdxQ9SeT6', NULL, NULL, 'user', '1773412097_WhatsApp_Image_2025-11-11_at_21.04.08_f8faef42.jpg'),
(8, 'Dimas', 'fahdimas42@gmail.com', '0812224', '$2y$10$lZOFnSG5PbXB6Ou902FuBuTEzs77GZuv2abD2Dkb8e0dIY3nTU0DO', NULL, NULL, 'user', '1773426022_341672.jpg'),
(9, 'habiba', 'nurhabibatulumah@gmail.com', '081234567004 ', '$2y$10$m3dlxcuHhK1BDJlLKWqw0OgkkoDocIpmLNUhKlmByHJpPMCzQXrqC', NULL, NULL, 'user', '1781662258_logo_utm_terbaru_banget.jpeg'),
(10, 'customer', 'customer@gmail.com', NULL, '$2y$10$Khe1RO4961vLDw8OYa5xzuZjENBBmlWWiFlPCfU9bWvZkBJZKEfWC', NULL, NULL, 'user', '1781663563_bg.jpeg'),
(11, 'customer1', 'cust1@gmail.com', NULL, '$2y$10$vvphNgFF6NDdxlqIKAtM2uDkCKv7P4HuxdS2BBnuZPu8GpQaoFgKK', NULL, NULL, 'user', '1781663916_bg.jpeg'),
(12, 'salwa', 'salwa@gmail.com', NULL, '$2y$10$VkOc9f7jEcw64yr3mdUNMuWkDgBXfik9mQjv.fplSjtOtdX/WEW1O', NULL, NULL, 'user', '1781664396_bg.jpeg'),
(13, 'cust1', 'cust1@gmail.com', NULL, '$2y$10$psP9tDHKsnUoNP3y1rdVYOcHYtL3GtI9mclBJ3OIxppvjAT60yCbK', NULL, NULL, 'user', '1781664804_bg.jpeg'),
(14, 'Nurhabibatul Umah', 'nurhabibatulumah@gmail.com', '081234567001', '$2y$10$0JoOzbh3GlRzh2hvB2o..evpEmpEJ.wJzipH.MZcsGIlUD9uUapNG', NULL, NULL, 'user', '1781666336_bg.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `pesanan_header`
--
ALTER TABLE `pesanan_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
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
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pesanan_header`
--
ALTER TABLE `pesanan_header`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan_header` (`id`),
  ADD CONSTRAINT `pesanan_detail_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
