USE `sia_sudiarsa`;

ALTER TABLE `barang` ADD COLUMN `harga_pokok` DOUBLE DEFAULT 0 NOT NULL AFTER `merk`;

/*Data for the table `akun` */
TRUNCATE TABLE `akun`;
TRUNCATE TABLE `biaya`;

insert  into `akun`(`kode`,`nama`) values

('1-1001','Kas'),

('1-1002','ATM BCA'),

('1-1003','ATM Mandiri'),

('1-1004','Sewa Dibayar Dimuka'),

('1-1005','Asuransi Dibayar Dimuka'),

('1-2001','Bangunan'),

('1-2002','Tanah'),

('1-2003','Perlengkapan Kantor'),

('1-2004','Peralatan Kantor'),

('3-1001','Modal Pemilik'),

('4-1001','Penjualan'),

('5-1001','Pembelian'),

('6-1001','Beban Gaji'),

('6-1002','Beban Listrik'),

('6-1003','Beban Perlengkapan'),

('6-1004','Beban Iklan'),

('6-1005','Beban Telpon dan Internet'),

('6-2001','Beban Sewa Kendaraan'),

('6-2002','Beban Angkut Pembelian');


