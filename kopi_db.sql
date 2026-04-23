-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.44 - MySQL Community Server - GPL
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
CREATE DATABASE IF NOT EXISTS `kopi_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kopi_db`;

-- Dumping structure for table kopi_db.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.produk: ~6 rows (approximately)
INSERT INTO `produk` (`id`, `nama`, `harga`, `gambar`, `stok`) VALUES
	(1, 'Kopi Arabica', 75000, 'arabica.jpg', 49),
	(2, 'Kopi Robusta', 60000, 'robusta.jpg', 50),
	(3, 'Kopi Liberica', 85000, 'liberica.jpg', 50),
	(4, 'Excelsa Wonosalam', 95000, 'excelsa.jpg', 50),
	(5, 'Kopi Luwak Premium', 150000, 'luwak.jpg', 50),
	(6, 'Kopi Decaf', 80000, 'decaf.jpg', 50);

-- Dumping structure for table kopi_db.pesanan_header
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.pesanan_header: ~1 rows (approximately)
INSERT INTO `pesanan_header` (`id`, `nama`, `email`, `pembayaran`, `tanggal`, `total`, `status`, `bukti`) VALUES
	(1, 'Dimas', 'fahdimas42@gmail.com', 'QRIS', '2026-04-02 06:26:10', 75000, 'Terverifikasi', 'BUKTI_1775111170_69ce0c02e4bec.png');

-- Dumping structure for table kopi_db.pesanan_detail
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.pesanan_detail: ~1 rows (approximately)
INSERT INTO `pesanan_detail` (`id`, `id_pesanan`, `produk_id`, `jumlah`, `harga`, `subtotal`) VALUES
	(1, 1, 1, 1, 75000, 75000);


-- Dumping structure for table kopi_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.users: ~8 rows (approximately)
INSERT INTO `users` (`id`, `username`, `telp`, `password`, `role`, `foto`) VALUES
	(1, 'admin', NULL, '<?= password_hash("admin123", PASSWORD_DEFAULT) ?>', 'admin', NULL),
	(2, 'idan', NULL, '$2y$10$LROU6BAVAX0meRoOBiYRa.yN9qiNFi2F.BHZdRashqWRDumBVgNsu', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(3, 'idan', NULL, '$2y$10$jBJBdCnD4buVnkr/T26RkOMa9r.htiZZbsSysbqVsg2uVevXmAdnS', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(4, 'idan', NULL, '$2y$10$z6/MclKKgw8eSHPKreT5I.QvhYbSDVXXDI0nYppWkLtEK9JXkZdcC', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(5, 'idan', NULL, '$2y$10$WbapgFHdfzU.r9aMbZ07COjNf8TagVOfnSE0P2EAfiIMUmN8eQroG', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(6, 'zaidan', NULL, '$2y$10$VhzGJyCeVbH1YvIWQfwuoemkGcZvSQBd0po.ZpP1GHQaB8ONI3PF2', 'user', 'WhatsApp Image 2025-11-11 at 21.04.08_f8faef42.jpg'),
	(7, 'zaidan', NULL, '$2y$10$lflfU5PBGv1B5qU6msBTn.MaEViAd002OAIYIAuIfyEHVdxQ9SeT6', 'user', '1773412097_WhatsApp_Image_2025-11-11_at_21.04.08_f8faef42.jpg'),
	(8, 'Dimas', '0812223', '$2y$10$/YvhriTWA7iLDNVyvQsTNuNiACIj6843lAQUvpfPN.gTosHRFWtuS', 'user', '1773426022_341672.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
