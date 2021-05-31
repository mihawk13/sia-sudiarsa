/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.10-MariaDB-log : Database - sia_sudiarsa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sia_sudiarsa` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sia_sudiarsa`;

/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `akun` */

insert  into `akun`(`id`,`kode`,`nama`) values 
(1,'1-1001','Kas'),
(2,'1-1002','Piutang Usaha'),
(3,'1-1003','Sewa Dibayar Dimuka'),
(4,'1-1004','Asuransi Dibayar Dimuka'),
(5,'1-2001','Bangunan'),
(6,'1-2002','Tanah'),
(7,'1-2003','Perlengkapan Kantor'),
(8,'1-2004','Peralatan Kantor'),
(9,'2-1001','Hutang Gaji'),
(10,'3-1001','Modal Pemilik'),
(11,'3-1002','ATM BCA'),
(12,'4-1001','Pendapatan'),
(13,'5-1001','Pembelian'),
(14,'6-1001','Beban Gaji'),
(15,'6-1002','Beban Listrik'),
(16,'6-1003','Beban Perlengkapan'),
(17,'6-1004','Beban Iklan'),
(18,'6-1005','Beban Telpon dan Internet'),
(19,'6-2001','Beban Sewa Kendaraan'),
(20,'6-2002','Beban Angkut Pembelian');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `barang` */

insert  into `barang`(`id`,`kode`,`nama`,`merk`) values 
(1,'B0001','Inkots','INK'),
(2,'B0002','KYTs','KYT'),
(3,'B0003','NHKs','NHK'),
(4,'B0004','Bogos','Bogo'),
(5,'B0005','GMs','GM');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `kontak` */

DROP TABLE IF EXISTS `kontak`;

CREATE TABLE `kontak` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Customer','Supplier') COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kontak` */

insert  into `kontak`(`id`,`nama`,`status`,`telp`) values 
(1,'Bobbi Cs','Customer','08934324234'),
(2,'Bobbi Sp','Supplier','08934324234');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2021_05_23_173409_create_kontak_table',1),
(5,'2021_05_23_184438_create_akun_table',1),
(6,'2021_05_23_185744_create_barang_table',1),
(7,'2021_05_23_192328_create_transaksi_kas_table',1),
(8,'2021_05_24_030936_create_transaksi_penjualan_table',1),
(9,'2021_05_24_031824_create_transaksi_penjualan_detail_table',1),
(10,'2021_05_24_100942_create_transaksi_pembelian_table',1),
(11,'2021_05_24_101005_create_transaksi_pembelian_detail_table',1),
(12,'2021_05_24_104604_create_transaksi_biaya_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `transaksi_biaya` */

DROP TABLE IF EXISTS `transaksi_biaya`;

CREATE TABLE `transaksi_biaya` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `akun_id` bigint(20) NOT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaksi_biaya` */

insert  into `transaksi_biaya`(`id`,`tanggal`,`akun_id`,`ket`,`jumlah`) values 
(1,'2021-05-31',14,'Gaji Karyawan','15000000'),
(2,'2021-05-31',15,'Biaya Listrik','2000000');

/*Table structure for table `transaksi_kas` */

DROP TABLE IF EXISTS `transaksi_kas`;

CREATE TABLE `transaksi_kas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `akun_id` bigint(20) NOT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaksi_kas` */

insert  into `transaksi_kas`(`id`,`tanggal`,`akun_id`,`ket`,`jumlah`) values 
(1,'2021-05-01',10,'Modal Pak Sudiarsa','50000000');

/*Table structure for table `transaksi_pembelian` */

DROP TABLE IF EXISTS `transaksi_pembelian`;

CREATE TABLE `transaksi_pembelian` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL DEFAULT '2020-02-02',
  `kontak_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `akun_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `grand_total` double NOT NULL DEFAULT 0,
  `status` enum('On','Simpan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'On'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaksi_pembelian` */

insert  into `transaksi_pembelian`(`id`,`tanggal`,`kontak_id`,`akun_id`,`grand_total`,`status`) values 
('PMB0001','2021-05-01',2,1,560000,'Simpan'),
('PMB0002','2021-05-02',2,1,600000,'Simpan'),
('PMB0003','2020-06-01',2,1,1750000,'Simpan');

/*Table structure for table `transaksi_pembelian_detail` */

DROP TABLE IF EXISTS `transaksi_pembelian_detail`;

CREATE TABLE `transaksi_pembelian_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pembelian_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_id` bigint(20) unsigned NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaksi_pembelian_detail` */

insert  into `transaksi_pembelian_detail`(`id`,`pembelian_id`,`barang_id`,`jumlah`,`harga`,`total`) values 
(4,'PMB0001',1,1,'200000','200000'),
(5,'PMB0001',2,3,'120000','360000'),
(6,'PMB0002',2,5,'120000','600000'),
(7,'PMB0003',4,10,'175000','1750000');

/*Table structure for table `transaksi_penjualan` */

DROP TABLE IF EXISTS `transaksi_penjualan`;

CREATE TABLE `transaksi_penjualan` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL DEFAULT '2020-02-02',
  `kontak_id` bigint(20) unsigned NOT NULL DEFAULT 1,
  `akun_id` bigint(20) unsigned NOT NULL DEFAULT 1,
  `grand_total` double NOT NULL DEFAULT 0,
  `status` enum('On','Simpan') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaksi_penjualan` */

insert  into `transaksi_penjualan`(`id`,`tanggal`,`kontak_id`,`akun_id`,`grand_total`,`status`) values 
('PNJ0001','2021-05-02',1,1,250000,'Simpan');

/*Table structure for table `transaksi_penjualan_detail` */

DROP TABLE IF EXISTS `transaksi_penjualan_detail`;

CREATE TABLE `transaksi_penjualan_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_id` bigint(20) unsigned NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaksi_penjualan_detail` */

insert  into `transaksi_penjualan_detail`(`id`,`penjualan_id`,`barang_id`,`jumlah`,`harga`,`total`) values 
(6,'PNJ0001',1,1,'250000','250000');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('Pemilik','Karyawan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`nama`,`username`,`password`,`level`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Pemilik','pemilik','$2y$10$xKGw3jkvVPzDHTSsyTvDzO.pDaZ/7POjAphgTERijf/iQVnAZIADi','Pemilik',NULL,'2021-05-29 11:51:08','2021-05-29 11:51:08'),
(2,'Karyawan','karyawan','$2y$10$QOwNLxZBNFbUBmacCYHTBu3NA6zlrS.rDDt27MQ.i7mZYrOZnIu4C','Karyawan',NULL,'2021-05-29 11:51:08','2021-05-29 11:51:08');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
