-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2021 at 03:08 PM
-- Server version: 10.2.41-MariaDB-log-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merbabu1_CE`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_detail_psn` int(11) NOT NULL,
  `id_pemesanan` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id_detail_psn`, `id_pemesanan`, `id_produk`, `nama_produk`, `deskripsi`, `harga`, `kuantitas`, `total`) VALUES
(102, 'ADA000000001', 21, 'SAMSUNG Kulkas 2 Pintu', 'Kulkas', 2400000, 3, 7200000),
(103, 'ADA000000102', 36, 'Sony Alpha a6400', 'Kamera', 12999000, 0, 0),
(104, 'ADA000000103', 27, 'CHANGHONG CBC50', 'Kulkas', 1098000, 1, 1098000),
(105, 'ADA000000103', 47, 'TV LED LG 32LM550 32 Inch', 'Televisi', 2498000, 2, 4996000),
(106, 'ADA000000105', 40, 'Panasonic Lumix DMC-GX85 12', 'Kamera', 6899000, 1, 6899000),
(107, 'ADA000000105', 33, 'Fujifilm X-A5 KIT 15-45MM', 'Kamera', 4899000, 1, 4899000),
(108, 'ADA000000105', 31, 'CANON PowerShot SX430', 'Kamera', 2890000, 1, 2890000),
(109, 'ADA000000108', 3, 'Lenovo LEGION 5 PRO ', 'Laptop', 20000000, 1, 20000000),
(110, 'ADA000000109', 38, 'SONY CYBERSHOT DSC-W810', 'Kamera', 1549000, 2, 3098000),
(111, 'ADA000000110', 1, 'Lenovo Legion 7 ', 'Laptop', 28000000, 1, 28000000),
(112, 'ADA000000111', 34, 'Canon EOS RP kit 24-105mm', 'Kamera', 18999000, 1, 18999000),
(113, 'ADA000000111', 33, 'Fujifilm X-A5 KIT 15-45MM', 'Kamera', 4899000, 1, 4899000),
(114, 'ADA000000113', 26, 'SAMSUNG RH64A53F1B4', 'Kulkas', 16890000, 1, 16890000),
(115, 'ADA000000114', 39, 'KAMERA SONY ALPHA A7 II', 'Kamera', 18348000, 1, 18348000),
(116, 'RTADA000000103', 27, 'CHANGHONG CBC50', 'Kulkas', 1098000, 1, 1098000),
(117, 'RTADA000000102', 36, 'Sony Alpha a6400', 'Kamera', 12999000, 1, 12999000),
(118, 'ADA000000117', 12, 'Laptop Xiaomi Redmi Book 15', 'Laptop', 6800000, 1, 6800000),
(119, 'RTADA000000117', 12, 'Laptop Xiaomi Redmi Book 15', 'Laptop', 6800000, 1, 6800000),
(120, 'ADA000000119', 1, 'Lenovo Legion 7 ', 'Laptop', 28000000, 1, 28000000);

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id_diskon` int(11) NOT NULL,
  `kode_diskon` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diskon` int(3) DEFAULT NULL,
  `expired` datetime DEFAULT NULL,
  `stok_diskon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id_diskon`, `kode_diskon`, `diskon`, `expired`, `stok_diskon`) VALUES
(7, '10des', 20, '2021-12-15 00:00:00', 43),
(15, 'P007', 0, '0000-00-00 00:00:00', 0),
(17, '3persen', 3, '2021-12-21 00:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `kode_diskon` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_pemesanan` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_pelanggan` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `total_dibayar` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `kasir` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `hp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `diskon` int(11) DEFAULT NULL,
  `kode_diskon` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tgl_pemesanan`, `nama_pelanggan`, `alamat`, `total_harga`, `total_dibayar`, `kembalian`, `kasir`, `hp`, `diskon`, `kode_diskon`) VALUES
('ADA000000001', '2021-12-14 04:52:25', 'M. Iskandar Dinata S.', 'Perum Villa Balaraja blok P3 nomor 99', 7200000, 7200000, 0, 'Administrator', '0812-9087-1204', NULL, NULL),
('ADA000000102', '2021-12-14 04:53:06', 'Surya Wibowo Diningrat', 'Villa balaraja blok A4 nomor 5', 12999000, 13000000, 1000, 'Administrator', '0878-0987-7666', NULL, NULL),
('ADA000000103', '2021-12-14 04:54:24', 'Samsara Bowo', 'Villa balaraja blok T4 nomor 3', 5753600, 5760000, 6400, 'Administrator', '0895-1294-0092', 1438400, '10des'),
('ADA000000105', '2021-12-14 04:55:55', 'Cadis Etama de Raizel', 'Villa balaraja blok B7 nomor 3', 11750400, 12000000, 249600, 'Administrator', '0853-4452-1142', 2937600, '10des'),
('ADA000000108', '2021-12-14 04:56:58', 'Regis la Levada', 'Villa balaraja blok M4 nomor 5', 20000000, 20000000, 0, 'Administrator', '0878-1495-4823', NULL, NULL),
('ADA000000109', '2021-12-14 04:58:43', 'Callity Esperansa', 'Villa balaraja blok E9 nomor 1', 2478400, 2500000, 21600, 'Administrator', '0895-1924-4923', 619600, '10des'),
('ADA000000110', '2021-12-14 05:00:52', 'Grimjoww', 'Villa balaraja blok B3 nomor 14', 28000000, 28000000, 0, 'Administrator', '0895-0999-1542', NULL, NULL),
('ADA000000111', '2021-12-14 05:02:29', 'Ulquiorra Espada', 'Villa balaraja blok N6 nomor 17', 23898000, 24000000, 102000, 'Administrator', '0899-1249-2231', NULL, NULL),
('ADA000000113', '2021-12-14 05:05:41', 'Nia Nirmala', 'Villa balaraja blok T2 nomor 10', 13512000, 13600000, 88000, 'Administrator', '0878-9214-0098', 3378000, '10des'),
('ADA000000114', '2021-12-14 05:06:49', 'Reynhard Sidragon', 'Villa balaraja blok P4 nomor 15', 18348000, 18400000, 52000, 'Administrator', '0893-2194-2239', NULL, NULL),
('ADA000000117', '2021-12-14 06:19:29', 'Den Judy', 'Perum Villa Balaraja blok P3 nomor 98', 10880000, 11000000, 120000, 'Junaidi', '0891-0924-2134', 2720000, '10des'),
('ADA000000119', '2021-12-14 06:31:16', 'Den Judy2', 'Perum Villa Balaraja blok P3 nomor 99', 27160000, 28000000, 840000, 'Administrator', '0812-9087-1204', 840000, '3persen'),
('RTADA000000102', '2021-12-14 05:11:33', 'Surya Wibowo Diningrat', 'Villa balaraja blok A4 nomor 5', 12999000, NULL, NULL, 'Administrator', '0878-0987-7666', NULL, NULL),
('RTADA000000103', '2021-12-14 05:08:01', 'Samsara Bowo', 'Villa balaraja blok T4 nomor 3', 1098000, NULL, NULL, 'Administrator', '0895-1294-0092', NULL, NULL),
('RTADA000000117', '2021-12-14 06:22:32', 'Den Judy', 'Perum Villa Balaraja blok P3 nomor 98', 6800000, NULL, NULL, 'Junaidi', '0891-0924-2134', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `isi` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `isi`) VALUES
(7, 'Dapatkan Diskon 20% sampai 15 Desember 2021'),
(15, 'Kepada kasir diharapkan datang meeting 12.00 WIB'),
(17, 'Dapatkan Diskon 3% sampai 21 Desember 2021');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nama_produk` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(12) NOT NULL,
  `deskripsi` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `stok`, `harga`, `deskripsi`) VALUES
(1, 'LP00001', 'Lenovo Legion 7 ', 30, 28000000, 'Laptop'),
(2, 'LP00002', 'Lenovo Legion 5i Pro', 81, 24000000, 'Laptop'),
(3, 'LP00003', 'Lenovo LEGION 5 PRO ', 15, 20000000, 'Laptop'),
(4, 'LP00004', 'Laptop ASUS M513UA ', 86, 10819000, 'Laptop'),
(5, 'LP00005', 'Apple MacBook Pro M1 Pro 2021 ', 46, 33799000, 'Laptop'),
(6, 'LP00006', 'ASUS TUF DASH F15 FX516PM', 25, 17499000, 'Laptop'),
(7, 'LP00007', 'ACER NITRO AN515-57 ', 80, 13499000, 'Laptop'),
(8, 'LP00008', 'Apple Macbook Air 2020', 25, 15149000, 'Laptop'),
(9, 'LP00009', 'Asus Vivobook F415EA K413', 21, 7299000, 'Laptop'),
(10, 'LP00010', 'HUAWEI MateBook 14s', 26, 99999000, 'Laptop'),
(11, 'LP00011', 'ASUS ROG STRIX G15 G513IH', 95, 15399000, 'Laptop'),
(12, 'LP00012', 'Laptop Xiaomi Redmi Book 15', 12, 6800000, 'Laptop'),
(13, 'LP00013', 'HP Pavilion Aero 13-be0000AU', 86, 12499000, 'Laptop'),
(14, 'LP00014', 'ACER ASPIRE 3 A314-35 N5100 ', 105, 5649000, 'Laptop'),
(15, 'LP00015', 'Laptop HP Pavilion 14s ', 85, 7299000, 'Laptop'),
(16, 'LP00016', 'Lenovo IdeaPad 3 14IGL05', 46, 5899000, 'Laptop'),
(17, 'LP00017', 'Apple Macbook Air 2020', 32, 15149000, 'Laptop'),
(18, 'LP00018', 'Axioo MyBook 14f N4020', 24, 4502000, 'Laptop'),
(19, 'LP00019', 'MACBOOK PRO 13\"INC RETINA ', 5, 8650000, 'Laptop'),
(20, 'LP00020', 'ASUS ROG STRIX-G G513QC-R735B6T-O', 94, 18000000, 'Laptop'),
(21, 'KS00001', 'SAMSUNG Kulkas 2 Pintu', 49, 2400000, 'Kulkas'),
(22, 'KS00002', 'SAMSUNG Side By Side Kulkas ', 77, 11800000, 'Kulkas'),
(23, 'KS00003', 'Bosch Kulkas Freezer', 1, 19500000, 'Kulkas'),
(24, 'KS00004', 'LG GC-X247CQAV', 89, 26499000, 'Kulkas'),
(25, 'KS00005', 'Kulkas 1 Pintu Sharp SJ 162 VB VP', 18, 1540000, 'Kulkas'),
(26, 'KS00006', 'SAMSUNG RH64A53F1B4', 52, 16890000, 'Kulkas'),
(27, 'KS00007', 'CHANGHONG CBC50', 46, 1098000, 'Kulkas'),
(28, 'KS00008', 'GEA Mini Bar RS-06DR ', 21, 1124000, 'Kulkas'),
(29, 'KS00009', 'KULKAS AQUA AQRD 181', 14, 1599000, 'Kulkas'),
(30, 'KS00010', 'PANASONIC NR-BB200V-S', 98, 3257000, 'Kulkas'),
(31, 'KA00001', 'CANON PowerShot SX430', 64, 2890000, 'Kamera'),
(32, 'KA00002', 'Canon EOS RP', 9, 18999000, 'Kamera'),
(33, 'KA00003', 'Fujifilm X-A5 KIT 15-45MM', 65, 4899000, 'Kamera'),
(34, 'KA00004', 'Canon EOS RP kit 24-105mm', 16, 18999000, 'Kamera'),
(35, 'KA00005', 'Brica B-Pro 5 Alpha Edition 4K', 27, 1349000, 'Kamera'),
(36, 'KA00006', 'Sony Alpha a6400', 78, 12999000, 'Kamera'),
(37, 'KA00007', 'CANON EOS M100 KIT 15-45MM', 29, 4999000, 'Kamera'),
(38, 'KA00008', 'SONY CYBERSHOT DSC-W810', 50, 1549000, 'Kamera'),
(39, 'KA00009', 'KAMERA SONY ALPHA A7 II', 6, 18348000, 'Kamera'),
(40, 'KA00010', 'Panasonic Lumix DMC-GX85 12', 79, 6899000, 'Kamera'),
(41, 'TV00001', 'TCL 50 inch Android 11 TV', 71, 5799000, 'Televisi'),
(42, 'TV00002', 'TCL 55 inch Ultra HD Android 9.0 Smart TV', 1, 5599000, 'Televisi'),
(43, 'TV00003', 'Xiaomi Mi TV 4 43\"', 92, 3845000, 'Televisi'),
(44, 'TV00004', 'SAMSUNG 43\" Crystal UHD', 40, 5899000, 'Televisi'),
(45, 'TV00005', 'SAMSUNG 50\" Crystal UHD 4K', 38, 8750000, 'Televisi'),
(46, 'TV00006', 'Realme Smart Android TV ', 88, 2681000, 'Televisi'),
(47, 'TV00007', 'TV LED LG 32LM550 32 Inch', 65, 2498000, 'Televisi'),
(48, 'TV00008', 'TV LED Sharp Aquos 24 Inch ', 58, 1749000, 'Televisi'),
(49, 'TV00009', 'SONY Bravia X85J 4K HDR 55 Inch', 70, 13999000, 'Televisi'),
(50, 'TV00010', 'Vortex TV Tabung 14 Inch 14HP15', 87, 399000, 'Televisi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keluar`
--

CREATE TABLE `tbl_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(30) NOT NULL,
  `kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_keluar`
--

INSERT INTO `tbl_keluar` (`id_keluar`, `id_produk`, `tanggal`, `penerima`, `kuantitas`) VALUES
(30, 21, '2021-12-14 04:52:25', 'M. Iskandar Dinata S.', 3),
(31, 36, '2021-12-14 04:53:06', 'Surya Wibowo Diningrat', 1),
(32, 27, '2021-12-14 04:54:24', 'Samsara Bowo', 2),
(33, 47, '2021-12-14 04:54:24', 'Samsara Bowo', 2),
(34, 40, '2021-12-14 04:55:55', 'Cadis Etama de Raizel', 1),
(35, 33, '2021-12-14 04:55:55', 'Cadis Etama de Raizel', 1),
(36, 31, '2021-12-14 04:55:55', 'Cadis Etama de Raizel', 1),
(37, 3, '2021-12-14 04:56:58', 'Regis la Levada', 1),
(38, 38, '2021-12-14 04:58:43', 'Callity Esperansa', 2),
(39, 1, '2021-12-14 05:00:52', 'Grimjoww', 1),
(40, 34, '2021-12-14 05:02:29', 'Ulquiorra Espada', 1),
(41, 33, '2021-12-14 05:02:30', 'Ulquiorra Espada', 1),
(42, 26, '2021-12-14 05:05:41', 'Nia Nirmala', 1),
(43, 39, '2021-12-14 05:06:49', 'Reynhard Sidragon', 1),
(44, 3, '2021-12-14 05:21:11', 'Budi', 10),
(46, 12, '2021-12-14 06:19:29', 'Den Judy', 2),
(47, 1, '2021-12-14 06:31:16', 'Den Judy2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_user`, `email`, `password`) VALUES
(1, 'admingudang@gmail.com', '7f95b733f4210c71482904eb422143f8'),
(2, 'newadmin@yahoo.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_masuk`
--

CREATE TABLE `tbl_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(30) NOT NULL,
  `kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_masuk`
--

INSERT INTO `tbl_masuk` (`id_masuk`, `id_produk`, `tanggal`, `keterangan`, `kuantitas`) VALUES
(12, 27, '2021-12-14 05:08:01', 'Layar mati', 1),
(13, 36, '2021-12-14 05:11:33', 'Shutter Macet', 1),
(16, 12, '2021-12-14 06:22:32', 'Layar mati', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `roll` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `roll`, `email`, `nama`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@gmail.com', 'Administrator'),
(7, '672020001', '202cb962ac59075b964b07152d234b70', 'kasir', 'rahasiakita@yahoo.com', 'Judy'),
(8, '672020002', '202cb962ac59075b964b07152d234b70', 'kasir', 'kasir2@gmail.com', 'judy 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_detail_psn`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_keluar`
--
ALTER TABLE `tbl_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_masuk`
--
ALTER TABLE `tbl_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id_detail_psn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_keluar`
--
ALTER TABLE `tbl_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_masuk`
--
ALTER TABLE `tbl_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
