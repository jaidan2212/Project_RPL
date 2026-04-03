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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.produk: 6 rows
INSERT INTO `produk` (`id`, `nama`, `harga`, `gambar`, `stok`) VALUES
	(1, 'Kopi Arabica', 75000, 'arabica.jpg', 50),
	(2, 'Kopi Robusta', 60000, 'robusta.jpg', 50),
	(3, 'Kopi Liberica', 85000, 'liberica.jpg', 50),
	(4, 'Excelsa Wonosalam', 95000, 'excelsa.jpg', 50),
	(5, 'Kopi Luwak Premium', 150000, 'luwak.jpg', 50),
	(6, 'Kopi Decaf', 80000, 'decaf.jpg', 50);

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.pesanan_header: 0 rows (Dibersihkan)

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
  CONSTRAINT `pesanan_detail_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan_header` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pesanan_detail_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kopi_db.pesanan_detail: 0 rows (Dibersihkan)

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

-- Dumping data for table kopi_db.users: 7 rows
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