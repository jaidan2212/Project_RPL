-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for kopi_db
DROP DATABASE IF EXISTS `kopi_db`;
CREATE DATABASE IF NOT EXISTS `kopi_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kopi_db`;

-- Dumping structure for table kopi_db.produk
DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.produk: ~3 rows (approximately)
INSERT INTO `produk` (`id`, `nama`, `harga`, `gambar`, `stok`) VALUES
	(1, 'Kopi Arabica', 75000, 'arabica.jpg', 49),
	(2, 'Kopi Robusta', 60000, 'robusta.jpg', 50),
	(3, 'Kopi Liberica', 85000, 'liberica.jpg', 50);


-- Dumping structure for table kopi_db.pesanan_header
DROP TABLE IF EXISTS `pesanan_header`;
CREATE TABLE IF NOT EXISTS `pesanan_header` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total` int NOT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Pembayaran',
  `bukti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.pesanan_header: ~25 rows (approximately)
INSERT INTO `pesanan_header` (`id`, `nama`, `email`, `pembayaran`, `tanggal`, `total`, `status`, `bukti`) VALUES
	(1, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-10 04:01:02', 195000, 'Menunggu Pembayaran', NULL),
	(2, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-10 04:02:34', 195000, 'Menunggu Pembayaran', NULL),
	(3, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-10 04:03:05', 135000, 'Menunggu Pembayaran', NULL),
	(4, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-10 04:06:38', 220000, 'Menunggu Pembayaran', NULL),
	(5, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-10 04:07:38', 135000, 'Menunggu Pembayaran', NULL),
	(6, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-10 04:09:18', 135000, 'Menunggu Pembayaran', NULL),
	(7, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-10 04:10:32', 135000, 'Menunggu Pembayaran', NULL),
	(8, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-10 04:16:17', 135000, 'Menunggu Pembayaran', NULL),
	(9, 'zaidan', 'zaidannabil2212@gmail.com', 'COD', '2026-03-10 04:31:44', 355000, 'Menunggu Pembayaran', NULL),
	(10, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 03:02:14', 130500, 'Menunggu Pembayaran', NULL),
	(11, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 03:02:37', 121500, 'Menunggu Pembayaran', NULL),
	(12, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 03:02:49', 135000, 'Menunggu Pembayaran', NULL),
	(13, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 03:03:56', 265500, 'Menunggu Pembayaran', NULL),
	(14, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 03:06:32', 75000, 'Menunggu Pembayaran', NULL),
	(15, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 03:10:45', 130500, 'Menunggu Pembayaran', NULL),
	(16, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 03:13:01', 130500, 'Menunggu Pembayaran', NULL),
	(17, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 07:16:51', 121500, 'Menunggu Pembayaran', NULL),
	(18, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 07:21:29', 75000, 'Menunggu Pembayaran', NULL),
	(19, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-11 07:26:17', 75000, 'Menunggu Pembayaran', NULL),
	(20, 'zaidan', 'zaidannabil2212@gmail.com', 'COD', '2026-03-13 14:59:14', 121500, 'Menunggu Pembayaran', NULL),
	(21, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-13 15:02:09', 121500, 'Menunggu Pembayaran', NULL),
	(22, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-13 15:05:36', 130500, 'Menunggu Pembayaran', NULL),
	(23, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-13 15:18:41', 121500, 'Menunggu Pembayaran', NULL),
	(24, 'zaidan', 'zaidannabil2212@gmail.com', 'Transfer Bank', '2026-03-13 16:31:43', 121500, 'Terverifikasi', NULL),
	(25, 'Dimas', 'fahdimas42@gmail.com', 'Transfer Bank', '2026-03-13 18:20:56', 75000, 'Menunggu Pembayaran', NULL),
	(26, 'Dimas', 'fahdimas42@gmail.com', 'Transfer BCA', '2026-03-13 18:41:27', 75000, 'Terverifikasi', '1773427287_20251010_OHR.MonurikiFiji_EN-US0326449622_UHD_bing.jpg');

-- Dumping structure for table kopi_db.pesanan_detail
DROP TABLE IF EXISTS `pesanan_detail`;
CREATE TABLE IF NOT EXISTS `pesanan_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pesanan` int NOT NULL,
  `produk_id` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL,
  `subtotal` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pesanan` (`id_pesanan`),
  KEY `produk_id` (`produk_id`),
  CONSTRAINT `pesanan_detail_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan_header` (`id`),
  CONSTRAINT `pesanan_detail_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.pesanan_detail: ~47 rows (approximately)
INSERT INTO `pesanan_detail` (`id`, `id_pesanan`, `produk_id`, `jumlah`, `harga`, `subtotal`) VALUES
	(1, 1, 1, 1, 75000, 75000),
	(2, 1, 2, 2, 60000, 120000),
	(3, 2, 1, 1, 75000, 75000),
	(4, 2, 2, 2, 60000, 120000),
	(5, 3, 1, 1, 75000, 75000),
	(6, 3, 2, 1, 60000, 60000),
	(7, 4, 1, 1, 75000, 75000),
	(8, 4, 2, 1, 60000, 60000),
	(9, 4, 3, 1, 85000, 85000),
	(10, 5, 1, 1, 75000, 75000),
	(11, 5, 2, 1, 60000, 60000),
	(12, 6, 1, 1, 75000, 75000),
	(13, 6, 2, 1, 60000, 60000),
	(14, 7, 1, 1, 75000, 75000),
	(15, 7, 2, 1, 60000, 60000),
	(16, 8, 1, 1, 75000, 75000),
	(17, 8, 2, 1, 60000, 60000),
	(18, 9, 1, 2, 75000, 150000),
	(19, 9, 2, 2, 60000, 120000),
	(20, 9, 3, 1, 85000, 85000),
	(21, 10, 2, 1, 60000, 60000),
	(22, 10, 3, 1, 85000, 85000),
	(23, 11, 1, 1, 75000, 75000),
	(24, 11, 2, 1, 60000, 60000),
	(25, 12, 1, 2, 75000, 150000),
	(26, 13, 1, 2, 75000, 150000),
	(27, 13, 2, 1, 60000, 60000),
	(28, 13, 3, 1, 85000, 85000),
	(29, 14, 1, 1, 75000, 75000),
	(30, 15, 2, 1, 60000, 60000),
	(31, 15, 3, 1, 85000, 85000),
	(32, 16, 2, 1, 60000, 60000),
	(33, 16, 3, 1, 85000, 85000),
	(34, 17, 1, 1, 75000, 75000),
	(35, 17, 2, 1, 60000, 60000),
	(36, 18, 1, 1, 75000, 75000),
	(37, 19, 1, 1, 75000, 75000),
	(38, 20, 1, 1, 75000, 75000),
	(39, 20, 2, 1, 60000, 60000),
	(40, 21, 1, 1, 75000, 75000),
	(41, 21, 2, 1, 60000, 60000),
	(42, 22, 2, 1, 60000, 60000),
	(43, 22, 3, 1, 85000, 85000),
	(44, 23, 1, 1, 75000, 75000),
	(45, 23, 2, 1, 60000, 60000),
	(46, 24, 1, 1, 75000, 75000),
	(47, 24, 2, 1, 60000, 60000),
	(48, 25, 1, 1, 75000, 75000),
	(49, 26, 1, 1, 75000, 75000);


-- Dumping structure for table kopi_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.users: ~7 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `role`, `foto`) VALUES
	(1, 'admin', '<?= password_hash("admin123", PASSWORD_DEFAULT) ?>', 'admin', NULL),
	(2, 'idan', '$2y$10$LROU6BAVAX0meRoOBiYRa.yN9qiNFi2F.BHZdRashqWRDumBVgNsu', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(3, 'idan', '$2y$10$jBJBdCnD4buVnkr/T26RkOMa9r.htiZZbsSysbqVsg2uVevXmAdnS', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(4, 'idan', '$2y$10$z6/MclKKgw8eSHPKreT5I.QvhYbSDVXXDI0nYppWkLtEK9JXkZdcC', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(5, 'idan', '$2y$10$WbapgFHdfzU.r9aMbZ07COjNf8TagVOfnSE0P2EAfiIMUmN8eQroG', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(6, 'zaidan', '$2y$10$VhzGJyCeVbH1YvIWQfwuoemkGcZvSQBd0po.ZpP1GHQaB8ONI3PF2', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(7, 'zaidan', '$2y$10$lflfU5PBGv1B5qU6msBTn.MaEViAd002OAIYIAuIfyEHVdxQ9SeT6', 'user', '1773412097_WhatsApp_Image_2025-11-11_at_21.04.08_f8faef42.jpg'),
	(8, 'Dimas', '$2y$10$Lq2hu5EJMsqRcypTjHV61evcXbu3.bPmUyPawwFfcg2AcLo0oS7Ry', 'user', '1773426022_341672.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
