/*
SQLyog Ultimate v12.2.6 (64 bit)
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

/*Data for the table `akun` */

insert  into `akun`(`kode`,`nama`) values

('1-1001','Kas'),

('1-1002','Piutang Usaha'),

('1-1003','Sewa Dibayar Dimuka'),

('1-1004','Asuransi Dibayar Dimuka'),

('1-2001','Bangunan'),

('1-2002','Tanah'),

('1-2003','Perlengkapan Kantor'),

('1-2004','Peralatan Kantor'),

('2-1001','Hutang Gaji'),

('3-1001','Modal Pemilik'),

('3-2001','Prive Pemilik'),

('4-1001','Penjualan'),

('5-1001','Pembelian'),

('6-1001','Beban Gaji'),

('6-1002','Beban Listrik'),

('6-1003','Beban Perlengkapan'),

('6-1004','Beban Iklan'),

('6-1005','Beban Telpon dan Internet'),

('6-2001','Beban Sewa Kendaraan'),

('6-2002','Beban Angkut Pembelian');

insert  into `barang`(`id`,`kode`,`nama`,`merk`,`stock`) values
(1,'B0001','Inkots','INK',0),
(2,'B0002','KYTs','KYT',0),
(3,'B0003','NHKs','NHK',0),
(4,'B0004','Bogos','Bogo',0),
(5,'B0005','GMs','GM',0);

insert  into `kontak`(`id`,`nama`,`status`,`telp`) values
(1,'Bobbi','Customer','08934324234'),
(2,'Bobbiiii','Supplier','08934324234');


