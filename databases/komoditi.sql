/*
SQLyog Enterprise - MySQL GUI v7.15 
MySQL - 5.6.26 : Database - ptsp_sertifikasi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`ptsp_sertifikasi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ptsp_sertifikasi`;

/*Table structure for table `mst_sertifikasi_komoditi` */

DROP TABLE IF EXISTS `mst_sertifikasi_komoditi`;

CREATE TABLE `mst_sertifikasi_komoditi` (
  `kd_sertifikasi_komoditi` varchar(30) NOT NULL,
  `no_sertifikasi_komoditi` varchar(30) NOT NULL,
  `nama_sertifikasi_komoditi` varchar(300) NOT NULL,
  `tipe_sertifikasi_komoditi` varchar(20) NOT NULL,
  `tgl_create` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `kd_satker` varchar(10) NOT NULL,
  PRIMARY KEY (`kd_sertifikasi_komoditi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_sertifikasi_komoditi` */

insert  into `mst_sertifikasi_komoditi`(`kd_sertifikasi_komoditi`,`no_sertifikasi_komoditi`,`nama_sertifikasi_komoditi`,`tipe_sertifikasi_komoditi`,`tgl_create`,`tgl_update`,`kd_satker`) values ('bpkimi14-komoditi-1','SNI 15-0047-2005','Kaca Lembaran','5A','2015-10-01 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-10','SNI 7275 : 2008','Keramik berglasir – Tableware-Alat makan dan minum','5A','2015-10-10 10:40:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-11','SNI 03-2947-1992','Bidet jenis vitreous cina','5A','2015-10-11 10:41:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-12','SNI 03-1148-2005','Peturasan pria jenis vitreous cina','5A','2015-10-12 10:42:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-13','SNI 03-0680-1998','Tandas jongkok jenis vitreous cina','5A','2015-10-13 10:43:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-14','SNI 03-0797-2006','Kloset duuduk','5A','2015-10-14 10:44:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-15','SNI 03-2095-1998','Genteng keramik ','5A','2015-10-15 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-16','SNI 03-2134-1996','Genteng keramik berglasir','5A','2015-10-16 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-17','SNI 03-0096-1999','Genteng beton','5A','2015-10-17 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-18','SNI 15-1571-2004','Bata tahan api isolasi jenis chammotte','5A','2015-10-18 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-19','SNI 15-0809-2001','Bata tahan api castable jenis alumina silika ','5A','2015-10-19 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-2','SNI 15-0048-2005','Kaca Pengaman diperkeras untuk kendaraan bermotor','5A','2015-10-02 10:33:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-20','SNI 15-0718-1989','Bata tahan api kastable jenis alumina dan alumina silica ','5A','2015-10-20 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-21','SNI 15-0600-1989','Ramming mix jenis samot dan jenis kadar alumina tinggi','5A','2015-10-21 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-22','SNI 15-3787-1997','Mortar tahan asam jenis silikat','5A','2015-10-22 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-23','SNI 15-3787-1995','Mortar tahan api jenis alumina tinggi yang mengeras pada suku kamar','5A','2015-10-23 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-24','SNI 15-2094-2004','Semen portland','5A','2015-10-24 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-25','SNI 15-0302-2004','Semen Portland Pozolan','5A','2015-10-25 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-26','SNI 15-2064-2004','Semen Portland Komposit','5C','2015-10-26 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-27','SNI 15-0129-2004','Semen Portland Putih','5A','2015-10-27 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-28','SNI 15-3500-2004','Semen Portland Campur','5A','2015-10-28 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-29','SNI 15-3044-1992','Semen Pemboran','5A','2015-10-29 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-3','SNI 15-1326-2005','Kaca pengaman berlapis untuk kendaraan bermotor','5C','2015-10-03 10:34:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-30','SNI 02-0086-2005','Pupuk Triple Superfosat','5C','2015-10-30 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-31','SNI 2803 : 2010 (2000)','Pupuk NPK Padat','5A','2015-10-31 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-32','SNI 02-2805-2005','Pupuk Kalium Klorida','5C','2015-11-01 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-33','SNI 02-2858-2005','Pupuk Diamonium Fosfat','5C','2015-11-02 10:32:50','2015-12-29 03:25:00','bpkimi14'),('bpkimi14-komoditi-4','SNI 15-4756-1998','Kaca Cermin lembaran untuk penggunaan umum','5A','2015-10-04 10:35:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-5','SNI ISO 25537 : 2011','Kaca untuk bangunan Cermin kaca lembaran belapis perak','5A','2015-10-05 10:32:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-6','SNI 15-0131-2006','Kaca pengaman diperkeras untuk bangunan dan panel','5A','2015-10-06 10:37:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-7','SNI 15-2609-2006','Kaca pengaman berlapis untuk bangunan dan mebelair','5A','2015-10-07 10:38:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-8','SNI ISO 13006 : 2010','Ubin Keramik','5A','2015-10-08 10:39:50','0000-00-00 00:00:00','bpkimi14'),('bpkimi14-komoditi-9','SNI 03-1331-2001','Ubin mozaik keramik','5A','2015-10-09 10:32:50','0000-00-00 00:00:00','bpkimi14');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
