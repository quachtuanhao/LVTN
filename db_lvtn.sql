-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2024 at 02:06 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lvtn`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdathang`
--

DROP TABLE IF EXISTS `chitietdathang`;
CREATE TABLE IF NOT EXISTS `chitietdathang` (
  `maChiTiet` int(10) NOT NULL AUTO_INCREMENT,
  `maDDH` int(11) NOT NULL,
  `maSP` varchar(50) NOT NULL,
  `tenSP` varchar(50) NOT NULL,
  `giaSP` double NOT NULL,
  `soLuong` int(11) NOT NULL,
  `tongTien` int(11) NOT NULL,
  PRIMARY KEY (`maChiTiet`),
  KEY `PK_CTDDH_DDH` (`maDDH`),
  KEY `PK_CTDDH_SP` (`maSP`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chitietdathang`
--

INSERT INTO `chitietdathang` (`maChiTiet`, `maDDH`, `maSP`, `tenSP`, `giaSP`, `soLuong`, `tongTien`) VALUES
(73, 62, 'SP06', 'Hp Elitebook 830 G9', 15000000, 1, 15000000),
(74, 63, 'SP06', 'Hp Elitebook 830 G9', 15000000, 1, 15000000),
(76, 65, 'SP08', 'CPU Intel Core i7-12700K', 9850000, 2, 19700000),
(77, 66, 'SP02', 'Mainboard Gigabyte Z790 GAMING X AX DDR5', 7090000, 1, 7090000),
(78, 67, 'SP08', 'CPU Intel Core i7-12700K', 9850000, 1, 9850000),
(79, 68, 'SP16', 'Chuột chơi game Dareu EM908 RGB', 380000, 1, 380000),
(80, 68, 'SP18', 'Miếng lót chuột khổ lớn 80 X 30 CM', 60000, 1, 60000),
(81, 69, 'SP02', 'Mainboard Gigabyte Z790 GAMING X AX DDR5', 7090000, 1, 7090000),
(82, 69, 'SP05', 'RAM Laptop Samsung 16GB DDR4', 850000, 1, 850000),
(83, 69, 'SP10', 'Ổ Cứng SSD Kingston KC600', 1410000, 1, 1410000),
(84, 70, 'SP17', 'Chuột Không Dây DAREU EM901 RGB - BLACK', 550000, 1, 550000),
(85, 70, 'SP19', 'Miếng lót chuột nhỏ kích thước 21x26cm', 30000, 1, 30000),
(86, 70, 'SP11', 'Ổ cứng SSD Kingfast F10', 1500000, 1, 1500000),
(87, 70, 'SP05', 'RAM Laptop Samsung 16GB DDR4', 850000, 1, 850000),
(88, 70, 'SP09', 'CPU Intel Core I9 14900K', 10990000, 1, 10990000),
(89, 71, 'SP13', 'Acer Aspire 7 Gaming A715-76-57CY', 13990000, 1, 13990000),
(90, 72, 'SP10', 'Ổ Cứng SSD Kingston KC600', 1410000, 1, 1410000),
(94, 75, 'SP12', 'CPU Intel Core I5 14600K', 5290000, 1, 5290000),
(95, 76, 'SP06', 'Hp Elitebook 830 G9', 15000000, 1, 15000000),
(96, 76, 'SP07', 'HP 240 G9 6L1X7PA', 9990000, 1, 9990000),
(97, 76, 'SP11', 'Ổ cứng SSD Kingfast F10', 1500000, 1, 1500000),
(98, 77, 'SP05', 'RAM Laptop Samsung 16GB DDR4', 850000, 1, 850000),
(102, 79, 'SP32', 'Ram Desktop Kingston Fury Beast', 1630000, 2, 3260000),
(104, 80, 'SP02', 'Mainboard Gigabyte Z790 GAMING X AX DDR5', 7090000, 2, 14180000),
(105, 81, 'SP38', 'Màn hình Samsung LU28R550UQEXXV', 5700000, 1, 5700000),
(106, 82, 'SP32', 'Ram Desktop Kingston Fury Beast', 1630000, 1, 1630000),
(107, 83, 'SP02', 'Mainboard Gigabyte Z790 GAMING X AX DDR5', 7090000, 1, 7090000),
(109, 85, 'SP41', 'Tai nghe MSI True Gaming Headset H991', 399000, 1, 399000),
(110, 86, 'SP09', 'CPU Intel Core I9 14900K', 10990000, 1, 10990000),
(111, 87, 'SP38', 'Màn hình Samsung LU28R550UQEXXV', 5700000, 1, 5700000),
(112, 88, 'SP19', 'Miếng lót chuột nhỏ kích thước 21x26cm', 30000, 6, 180000),
(113, 89, 'SP06', 'Hp Elitebook 830 G9', 15000000, 100, 1500000000);

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

DROP TABLE IF EXISTS `chucvu`;
CREATE TABLE IF NOT EXISTS `chucvu` (
  `maChucVu` varchar(50) NOT NULL,
  `tenChucVu` varchar(50) NOT NULL,
  PRIMARY KEY (`maChucVu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`maChucVu`, `tenChucVu`) VALUES
('CV01', 'admin'),
('CV02', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `rating`, `comment`, `created_at`, `user_id`, `user_name`) VALUES
(1, 'SP10', 5, 'đã mua dùng rất tốt', '2024-07-30 08:16:34', NULL, 'thanhthanh');

-- --------------------------------------------------------

--
-- Table structure for table `dondathang`
--

DROP TABLE IF EXISTS `dondathang`;
CREATE TABLE IF NOT EXISTS `dondathang` (
  `maDonDatHang` int(10) NOT NULL AUTO_INCREMENT,
  `maKH` varchar(50) NOT NULL,
  `tenKhach` varchar(50) NOT NULL,
  `emailKhach` varchar(50) NOT NULL,
  `sdtKhach` varchar(15) NOT NULL,
  `diaChiKhach` varchar(250) NOT NULL,
  `ngayDat` datetime DEFAULT NULL,
  `maTT` varchar(10) NOT NULL,
  `maKM` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`maDonDatHang`),
  KEY `PK_DDH_TT` (`maTT`),
  KEY `PK_DDH_TK` (`maKH`),
  KEY `PK_DDH_KM` (`maKM`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dondathang`
--

INSERT INTO `dondathang` (`maDonDatHang`, `maKH`, `tenKhach`, `emailKhach`, `sdtKhach`, `diaChiKhach`, `ngayDat`, `maTT`, `maKM`) VALUES
(62, 'hao9898', 'Hào phô mai', 'haophomai@gmail.com', '0909091122', 'Quận 8', '2023-12-24 11:30:00', 'HT', 'KM100K'),
(63, 'hao9898', 'Hào phô mai', 'haophomai@gmail.com', '0909091122', 'Quận 8', '2023-12-24 11:32:05', 'HT', 'KM10'),
(65, 'hao0099', 'Hào sữa', 'hao0099@gmail.com', '2543695421', 'Quận 10', '2023-12-25 03:22:09', 'HT', 'NULL'),
(66, 'hao9898', 'Hào phô mai', 'haophomai@gmail.com', '0909091122', 'Quận 8', '2023-12-26 01:54:03', 'HT', 'KM10'),
(67, 'hao9898', 'Hào phô mai', 'haophomai@gmail.com', '0909091122', 'Quận 8', '2023-12-26 01:55:25', 'HT', 'KM100K'),
(68, 'lam2020', 'Hoàng Lâm ', 'hoanglam@gmail.com', '0965841254', 'Quận 7', '2023-12-26 02:17:59', 'HT', 'NULL'),
(69, 'an1997', 'Huỳnh An', 'an@gmail.com', '0902356848', 'Quận Bình Thạnh', '2023-12-27 08:38:25', 'HT', 'NULL'),
(70, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2023-12-27 08:43:53', 'HT', 'KM12NOEL'),
(71, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2023-12-27 09:10:38', 'HT', 'KM12NOEL'),
(72, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2023-12-27 10:52:33', 'HT', 'KM12NOEL2'),
(75, 'an1997', 'Huỳnh An', 'an@gmail.com', '0902356848', 'Quận Bình Thạnh', '2023-12-28 10:15:02', 'HT', 'KM12NOEL'),
(76, 'hung2021', 'Nhật Hùng', 'hung2021@gmail.com', '0312546761', 'Bình Tân', '2023-12-28 01:23:26', 'HT', 'KM12NOEL2'),
(77, 'hung2021', 'Nhật Hùng', 'hung2021@gmail.com', '0312546761', 'Bình Tân', '2024-01-03 02:51:02', 'HT', 'KM10'),
(79, 'hung2021', 'Nhật Hùng', 'hung2021@gmail.com', '0312546761', 'Bình Tân', '2024-01-17 01:10:05', 'HT', 'KM12NOEL'),
(80, 'sangsang123', 'Sang Huỳnh', 'sanghuynh@gmail.com', '0124589875', 'Quận 11', '2024-07-30 15:57:44', 'DXL', ''),
(81, '0965841251', 'Sang Lâm', 'sanglam11@gmail.com', '0965841251', 'Quận 6', '2024-07-30 04:32:35', 'DXL', 'NULL'),
(82, '0965841251', 'Sang Lâm', 'sanglam11@gmail.com', '0965841251', 'Quận 6', '2024-07-30 04:33:42', 'DXL', 'NULL'),
(83, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2024-07-30 04:35:00', 'DXL', ''),
(85, '0965841245', 'Sang Trịnh', 'trinhlam331@gmail.com', '0965841245', 'Quận 7', '2024-07-30 05:01:48', 'DXL', 'NULL'),
(86, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2024-07-30 08:03:44', 'DXL', 'KM10K'),
(87, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2024-07-30 08:05:51', 'HT', 'KM120K'),
(88, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2024-07-30 08:21:03', 'DXL', 'KM120K'),
(89, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2024-07-30 08:46:41', 'DXL', 'KM10');

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmai`
--

DROP TABLE IF EXISTS `khuyenmai`;
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `maKhuyenMai` varchar(50) NOT NULL,
  `tenKhuyenMai` varchar(50) NOT NULL,
  `ngayBatDau` date DEFAULT NULL,
  `ngayKetThuc` date DEFAULT NULL,
  `maLKM` varchar(50) NOT NULL,
  `giaTriKhuyenMai` double NOT NULL,
  `hienThi` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`maKhuyenMai`),
  KEY `PK_KM_LKM` (`maLKM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khuyenmai`
--

INSERT INTO `khuyenmai` (`maKhuyenMai`, `tenKhuyenMai`, `ngayBatDau`, `ngayKetThuc`, `maLKM`, `giaTriKhuyenMai`, `hienThi`) VALUES
('KM10', 'Khuyến mãi 10%', '2023-12-01', '2024-12-25', 'KM2', 10, 0),
('KM100K', 'Khuyến mãi 100k', '2023-12-15', '2025-01-05', 'KM1', 100000, 0),
('KM120K', 'Khuyến mãi 120k', '2011-01-01', '2022-01-01', 'KM1', 120000, 0),
('KM12NOEL', 'Khuyến mãi tháng 12', '2023-12-30', '2024-01-30', 'KM1', 2000000, 0),
('KM12NOEL2', 'Khuyến mãi tháng 12', '2023-12-21', '2023-12-28', 'KM2', 20, 0),
('KM20', 'Khuyến mãi 20%', '2024-01-16', '2024-01-28', 'KM2', 20, 0),
('KM200k', 'Khuyến mãi 200k ', '2023-12-28', '2023-12-31', 'KM1', 200000, 0),
('null', 'null', NULL, NULL, 'KM1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loaikhuyenmai`
--

DROP TABLE IF EXISTS `loaikhuyenmai`;
CREATE TABLE IF NOT EXISTS `loaikhuyenmai` (
  `maLoai` varchar(50) NOT NULL,
  `tenLoai` varchar(50) NOT NULL,
  PRIMARY KEY (`maLoai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loaikhuyenmai`
--

INSERT INTO `loaikhuyenmai` (`maLoai`, `tenLoai`) VALUES
('KM1', 'Khuyến mãi theo tiền'),
('KM2', 'Khuyến mãi theo %');

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

DROP TABLE IF EXISTS `loaisanpham`;
CREATE TABLE IF NOT EXISTS `loaisanpham` (
  `maLoaiSanPham` varchar(50) NOT NULL,
  `tenLoaiSanPham` varchar(250) NOT NULL,
  PRIMARY KEY (`maLoaiSanPham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`maLoaiSanPham`, `tenLoaiSanPham`) VALUES
('LSP01', 'Laptop'),
('LSP02', 'CPU'),
('LSP03', 'Mainboard'),
('LSP04', 'Ram'),
('LSP05', 'Ổ cứng SSD'),
('LSP06', 'Ổ cứng HDD'),
('LSP07', 'Màn hình'),
('LSP08', 'Chuột + Lót chuột'),
('LSP09', 'Bàn phím'),
('LSP10', 'Tai nghe');

-- --------------------------------------------------------

--
-- Table structure for table `nhasanxuat`
--

DROP TABLE IF EXISTS `nhasanxuat`;
CREATE TABLE IF NOT EXISTS `nhasanxuat` (
  `maNhaSanXuat` varchar(50) NOT NULL,
  `tenNhaSanXuat` varchar(50) NOT NULL,
  `truSoChinh` varchar(250) NOT NULL,
  PRIMARY KEY (`maNhaSanXuat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nhasanxuat`
--

INSERT INTO `nhasanxuat` (`maNhaSanXuat`, `tenNhaSanXuat`, `truSoChinh`) VALUES
('NSX01', 'HP', 'TP.HCM'),
('NSX02', 'ACER', 'TP.HCM'),
('NSX03', 'ASUS', 'TP.HCM'),
('NSX04', 'GIGABYTE', 'TP.HCM'),
('NSX05', 'SAMSUNG', 'TP.HCM'),
('NSX06', 'MSI', 'TP.HCM'),
('NSX07', 'KINGSTON', 'TP.HCM'),
('NSX08', 'RAPOO', 'TP.HCM'),
('NSX09', 'KHÁC', '');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `maSanPham` varchar(50) NOT NULL,
  `tenSanPham` varchar(50) NOT NULL,
  `gia` double NOT NULL,
  `soLuong` int(11) DEFAULT '100',
  `ram` varchar(50) DEFAULT NULL,
  `dungLuong` varchar(50) DEFAULT NULL,
  `pin` varchar(50) DEFAULT NULL,
  `hinhAnh` varchar(250) NOT NULL,
  `moTa` varchar(500) NOT NULL,
  `maNSX` varchar(50) NOT NULL,
  `maLSP` varchar(50) NOT NULL,
  PRIMARY KEY (`maSanPham`),
  KEY `FK_SP_NSX` (`maNSX`),
  KEY `FK_SP_LSP` (`maLSP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`maSanPham`, `tenSanPham`, `gia`, `soLuong`, `ram`, `dungLuong`, `pin`, `hinhAnh`, `moTa`, `maNSX`, `maLSP`) VALUES
('SP02', 'Mainboard Gigabyte Z790 GAMING X AX DDR5', 7090000, 97, '', '', '', 'Mainboard Gigabyte Z790 GAMING X AX DDR5.jpg', 'Socket: LGA1700 hỗ trợ CPU Intel thế hệ 13, Intel thế hệ thứ 12, Pentium® Gold and Celeron® Processors - Khe cắm RAM: 4 khe (Tối đa 192GB) - Khe cắm mở rộng: 1 x PCI Express 5.0 x16 slot, 1 x PCI Express 4.0 x16 slots, 1 x PCI Express 3.0 x16 slots - Khe cắm ổ cứng: 4 x M.2 slots, 6 x SATA 6Gb/s ports', 'NSX04', 'LSP03'),
('SP03', 'Mainboard Asus Prime H610M-K D4', 2190000, 100, '', '', '', 'Mainboard Asus Prime H610M-K D4.jpg', 'Kích thước: Hệ số hình thức mATX 9,2 inch x 8,0 inch (23,4 cm x 20,3 cm) - CPU hỗ trợ: Intel ® Socket LGA1700 cho Bộ xử lý Intel ® Core ™, Pentium ® Gold và Celeron ® thế hệ thứ 12 * – Hỗ trợ Công nghệ Intel ® Turbo Boost 2.0 và Công nghệ Intel ® Turbo Boost Max 3.0 ** - Chipset: Bộ chip Intel ® H610', 'NSX03', 'LSP03'),
('SP04', 'RAM Laptop Kingston 8GB DDR4 bus', 599000, 100, 'DDR4', '8GB', '', 'RAM Laptop Kingston 8GB DDR4 bus.jpg', '8GB - DDR4 - Bus 2666MHz', 'NSX07', 'LSP04'),
('SP05', 'RAM Laptop Samsung 16GB DDR4', 850000, 100, 'DDR4', '16GB', '', 'RAM-Laptop-Samsung-16GB-DDR4-3200.jpg', 'RAM DDR4 - Dung lượng: 16GB - Tốc độ: 3200MHz', 'NSX05', 'LSP04'),
('SP06', 'Hp Elitebook 830 G9', 15000000, 120, '8GB', 'SSD 256GB', '51 Wh', 'Hp Elitebook 830 G9.jpg', 'Màn hình: 14 inch - CPU: intel Core i5-1235U - Tần số xung nhịp CPU: 3.30 GHz đến 4.40 GHz Intel® Integrated Intel® Iris® Xe Graphics  Trọng lượng: 1.2 kg', 'NSX01', 'LSP01'),
('SP07', 'HP 240 G9 6L1X7PA', 9990000, 100, '8GB', 'SSD 256GB', '41 Wh', 'Laptop HP 240 G9 6L1X7PA.jpg', 'CPU: Intel Core i3-1215U (upto 4.40 GHz, 10MB) - VGA: Intel UHD Graphics - Màn hình: 14 inch FullHD - Cân nặng: 1.47 kg', 'NSX01', 'LSP01'),
('SP08', 'CPU Intel Core i7-12700K', 9850000, 100, '', '', '', 'CPU Intel Core i7-12700K.jpg', '3.6GHz up to 5.0GHz, 25MB', 'NSX09', 'LSP02'),
('SP09', 'CPU Intel Core I9 14900K', 10990000, 99, '', '', '', 'CPU Intel Core I9 14900K.png', 'Up 6.0 GHz, 24 Nhân 32 Luồng, 36MB Cache, Raptor Lake Refresh', 'NSX09', 'LSP02'),
('SP10', 'Ổ Cứng SSD Kingston KC600 256GB', 1410000, 100, '', '', '', 'Ổ Cứng SSD Kingston KC600.jpg', 'Dung lượng: 256GB 2.5 Inch SATA3 -  Đọc 500MB/s, Ghi 500MB/s', 'NSX07', 'LSP05'),
('SP11', 'Ổ cứng SSD Kingfast F10 512GB', 1500000, 100, '', '', '', 'Ổ cứng SSD Kingfast F10.jpg', 'Dung lượng: 512GB SATA III 2.5 Inch', 'NSX09', 'LSP05'),
('SP12', 'CPU Intel Core I5 14600K', 5290000, 100, '', '', '', 'CPU Intel Core I5 14600K.png', 'Up 5.30 GHz, 14 Nhân 20 Luồng, 24MB Cache, Raptor Lake Refresh', 'NSX09', 'LSP02'),
('SP13', 'Acer Aspire 7 Gaming A715-76-57CY', 13990000, 100, '8 GB', 'SSD 512GB', '50 Wh', 'Acer Aspire 7 Gaming A715-76-57CY.jpg', 'CPU: Intel Core i5-12450H - VGA: Intel UHD Graphics - Màn hình: 15.6 inch FHD - Cân nặng: 2.1 kg', 'NSX02', 'LSP01'),
('SP14', 'Màn hình MSI PRO MP243X', 2450000, 100, '', '', '', 'Màn hình MSI-PRO MP243X.jpg', 'Kích thước: 23.8 inch - Độ phân giải: FHD 1920 x 1080 - Tấm nền: IPS - Tần số quét: 100Hz - Thời gian phản hồi: 1ms - Tỉ lệ tương phản: 1000:1 - Độ sáng: 300cd/m2 - Tích hợp: 2x 3W - VESA: 75x75mm - Cổng kết nối: 1x HDMI, 1x DisplayPort', 'NSX06', 'LSP07'),
('SP15', 'Màn hình Asus VZ24EHE-R', 2600000, 100, '', '', '', 'Màn hình Asus VZ24EHE R.jpg', 'Kích thước: 23,8″ - Tỷ lệ: 16:9 - Bề mặt hiển thị: Không chói - Tấm nền: IPS - Góc nhìn: (CR≧10, H/V) 178°/ 178° - Độ phân giải: 1920×1080 - Độ sáng: 250cd/㎡', 'NSX03', 'LSP07'),
('SP16', 'Chuột chơi game Dareu EM908 RGB', 380000, 100, '', '', '', 'Chuột chơi game Dareu EM908 RGB.jpg', 'Tình trạng: Mới - Kết nối: có dây, cổng kết nối chuẩn USB - Tương thích: Windows 10, Windows 7, Mac OS và các hệ điều hành cũ.', 'NSX09', 'LSP08'),
('SP17', 'Chuột Không Dây DAREU EM901 RGB - BLACK', 550000, 100, '', '', '', 'Chuột Không Dây DAREU EM901 RGB - BLACK.jpg', 'Kết nối không dây 2,4 GHz - Switch: DareU (10 triệu lần click)', 'NSX09', 'LSP08'),
('SP18', 'Miếng lót chuột khổ lớn 80 X 30 CM', 60000, 100, '', '', '', 'Miếng lót chuột khổ lớn 80 X 30 CM.jpg', 'Kiểu dáng: hình chữ nhật - Lót chuột Kích thước : 80×30 cm - Độ dày : 0.3 cm - Chất liệu : đế cao su | mặt vải - Bề mặt : Trơn, Nhẵn - Chất lượng in: Sắc nét', 'NSX09', 'LSP08'),
('SP19', 'Miếng lót chuột nhỏ kích thước 21x26cm', 30000, 94, '', '', '', 'Miếng lót chuột nhỏ kích thước 21x26cm.jpg', 'Kiểu dáng: hình chữ nhật - Kích thước : 21x26cm - Độ dày : 0.2 cm - Chất liệu : Cao su - Bề mặt : Trơn – Nhẵn', 'NSX09', 'LSP08'),
('SP20', 'Bàn phím có dây RAPOO V500 Pro', 749000, 100, '', '', '', 'Bàn phím có dây RAPOO V500 Pro Cyan Blue Switch 19883.png', 'Cyan Blue Switch 19883', 'NSX08', 'LSP09'),
('SP21', 'Bàn phím có dây RAPOO V500 ALLOY', 429000, 100, '', '', '', 'Bàn phím có dây RAPOO V500 ALLOY Black Brown Switch 12102.png', 'Black Brown Switch 12102', 'NSX08', 'LSP09'),
('SP22', 'Bàn phím có dây RAPOO V500 Pro', 649000, 100, '', '', '', 'Bàn phím có dây RAPOO V500 Pro Black.jpg', 'Black - Brown/Blue/Red/Black Switch', 'NSX08', 'LSP09'),
('SP23', 'Bàn phím không dây RAPOO V500 Pro 87', 649000, 100, '', '', '', 'Bàn phím không dây RAPOO V500 Pro 87 Dual Mode Black.jpg', 'Dual Mode Black - Blue/Red/Brown/Black Switch', 'NSX08', 'LSP09'),
('SP24', 'Asus Vivobook 16X', 13990000, 100, '12GB', 'SSD 512GB', '50 Wh', 'Asus Vivobook 16X.jpg', 'CPU: AMD Ryzen 7-5800HS - Card đồ họa: AMD Radeon Graphics - Màn hình: 16 inch Full HD+ - Kích thước: 35.84 x 24.77 x 1.99 ~ 1.99 cm - Trọng lượng: 1.88 kg', 'NSX03', 'LSP01'),
('SP25', 'Laptop ASUS TUF GAMING FX506HF-HN014W', 15990000, 100, '8GB', 'SSD 512GB', '48 Wh', 'Laptop ASUS TUF GAMING FX506HF-HN014W.jpg', 'CPU: Intel Core i5-11400H - Card đồ họa: Nvidia Geforce RTX 2050 - Màn hình: 15.6 Inch Full HD 144Hz - Cân nặng: 2.30 kg', 'NSX03', 'LSP01'),
('SP26', 'Laptop Gaming GIGABYTE AORUS 15 BMF 52US383SH', 21990000, 100, '8GB', 'SSD 512GB', '90 Wh', 'Laptop Gaming GIGABYTE AORUS 15 BMF 52US383SH.jpg', 'CPU: Intel Core i5-13500H - Card đồ họa: NVIDIA GeForce RTX 4050 Laptop GPU 6GB GDDR6 - Màn hình: 15.6 Inch Full HD 144Hz', 'NSX04', 'LSP01'),
('SP27', 'Laptop Samsung Galaxy Book Pro 15 950XDB-KB2US', 16990000, 100, '8GB', 'SSD 512GB', '75 Wh', 'Laptop Samsung Galaxy Book Pro 15 950XDB-KB2US.jpg', 'CPU: Intel Core i5 - 1135G7 - Card đồ họa: Intel® Iris Xe Graphics - Màn hình: 15.6 Inch Full HD AMOLED', 'NSX05', 'LSP01'),
('SP28', 'CPU Intel Core i9-12900K', 13390000, 100, '', '', '', 'CPU Intel Core i9-12900K.jpg', 'Socket: FCLGA1700 - Số lõi/luồng: 16/24 - Bộ nhớ đệm: 30 MB - Bus ram hỗ trợ: DDR4 3200MHz, DDR5-4800 - Mức tiêu thụ điện: 125W', 'NSX09', 'LSP02'),
('SP29', 'CPU Intel Core i7 14700K', 7650000, 100, '', '', '', 'CPU Intel Core i7 14700K.png', 'Socket: FCLGA1700 - Số lõi/luồng: 20 nhân, 28 luồng - Tốc độ xử lí tối đa: 5.6 GHz - Bộ nhớ đệm: 33 MB - Bus ram hỗ trợ: DDR4 3200 MT/s, DDR5 5600 MT/s - Mức tiêu thụ điện: 125 W', 'NSX09', 'LSP02'),
('SP30', 'Mainboard Asus ROG Strix X299 - E Gaming', 7500000, 100, '', '', '', 'Mainboard Asus ROG Strix X299 - E Gaming.jpg', 'Dòng bộ xử lý: Intel® Core™ X Series - Tản nhiệt M.2 tích hợp - Tối ưu hóa 5 chiều - Khả năng kết nối chơi game: Đầu nối M.2 kép và USB 3.1 Thế hệ 2 Kiểu A và Kiểu C™ - Mạng chơi game: Intel Gigabit Ethernet, LANGuard GameFirst và Wi-Fi 2x2 802.11ac có hỗ trợ MU-MIMO.', 'NSX03', 'LSP03'),
('SP31', 'Mainboard Asus ROG STRIX Z790-H GAMING WIFI', 9990000, 100, '', '', '', 'Mainboard Asus ROG STRIX Z790-H GAMING WIFI.jpg', 'CPU: Intel® Socket LGA1700 for 13th Gen Intel® Core™ & 12th Gen Intel® Core™, Pentium® Gold and Celeron® Processors* - Chipset: Intel® Z790 Chipset - Kích thước: ATX 12 inch x 9,6 inch (30,5 cm x 24,4 cm) - RAM: 4 x DIMM, Tối đa. 128GB, DDR5 - Non-ECC, Un-buffered Memory* - Kiến trúc bộ nhớ kênh đôi - Hỗ trợ Intel ® Extreme Memory Profile (XMP) OptiMem II ', 'NSX03', 'LSP03'),
('SP32', 'Ram Desktop Kingston Fury Beast', 1630000, 100, '', '', '', 'Ram Desktop Kingston Fury Beast.jpg', 'RAM: 16GB - Bộ nhớ: DDR4 - Bus: 3600MHz', 'NSX07', 'LSP04'),
('SP33', 'RAM Laptop DDR5 8GB Samsung bus 5600Mhz', 750000, 100, '', '', '', 'RAM Laptop DDR5 8GB Samsung bus 5600Mhz.jpg', 'Thương hiệu: Samsung - Dung lượng: 8GB - Chuẩn RAM:DDR5 - Bus RAM: 5600Mhz', 'NSX05', 'LSP04'),
('SP34', 'Tai nghe HP H2800', 249000, 100, '', '', '', 'Tai nghe HP H2800.jpg', 'Loại tai nghe: Chụp tai - Loại kết nối: Giắc cắm 3,5mm', 'NSX01', 'LSP10'),
('SP35', 'Ổ Cứng Seagate 1TB SkyHawk', 1150000, 100, '', '', '', 'Ổ Cứng Seagate 1TB SkyHawk', 'Số vòng quay: 5900rpm - Chuẩn: SATA III - Bộ nhớ đệm: 64MB Cache - Dung lượng: 1000GB - Kích thước: 3.5 inch - Tốc độ truyền dữ liệu: 600MB/s.', 'NSX09', 'LSP06'),
('SP36', 'Ổ cứng Western 4TB Purple WD42PURZ', 2400000, 100, '', '', '', 'Ổ cứng Western 4TB Purple WD42PURZ.jpg', 'Được thiết kế để chạy 24/7 - Khả năng chịu tải 180TB/ năm - Hỗ trợ công nghệ phục hồi ổ cứng trong thời gian nhất định (TLER) - Hỗ trợ hệ thông 8 bay ổ đĩa - Tốc độ vòng quay: 5400 RPM', 'NSX09', 'LSP06'),
('SP37', 'Màn Hình Máy Tính Gigabyte G27FC A', 4690000, 100, '', '', '', 'Màn Hình Máy Tính Gigabyte G27FC A.jpg', 'Kích thước 27 inch với độ cong lý tưởng 1500HR - Tấm nền VA độ phân giải 1920 x 1080, tốc độ làm mới 165Hz - Hỗ trỡ FreeSync - Độ phủ màu 90% DCI-P3 (120% sRGB) - Tốc độ phản hồi siêu nhanh 1ms (MPRT) - Cổng kết nối: HDMI, Displayport - Loa: 2 loa x 2w', 'NSX04', 'LSP07'),
('SP38', 'Màn hình Samsung LU28R550UQEXXV', 5700000, 99, '', '', '', 'Màn hình Samsung LU28R550UQEXXV.jpg', 'Loại màn hình: Phẳng - Tỉ lệ: 16:9 - Kích thước: 28 inch - Tấm nền: IPS - Độ phân giải: UHD 4K (3840 x 2160) - Tốc độ làm mới: 60Hz - Thời gian đáp ứng: 4ms - Cổng kết nối: HDMI, Display Port - Phụ kiện: Cáp nguồn, Cáp HDMI', 'NSX05', 'LSP07'),
('SP39', 'Laptop MSI Thin GF63 12UCX-841VN', 15490000, 100, '8GB', 'SSD 512GB', '52.4 Wh', 'Laptop MSI Thin GF63 12UCX-841VN.jpg', 'GA: NVIDIA GeForce RTX 2050 4GB GDDR6 - Màn hình: 15.6 inch FHD (1920 x 1080) IPS 144Hz, Thin Bezel, 45%NTSC - Màu sắc: Đen - Bàn phím: Single LED Red - Cân nặng: 1.86 kg', 'NSX06', 'LSP01'),
('SP40', 'Laptop Acer Nitro 5 AN515-58-525P', 16790000, 100, '8GB', 'SSD 512GB', '58.75 Wh', 'Laptop Acer Nitro 5 AN515-58-525P.jpg', 'CPU: i5-12500H (12 nhân) - Card đồ họa: Nvidia RTX 3050 - Màn hình: 15.6 Inch Full HD 144Hz', 'NSX02', 'LSP01'),
('SP41', 'Tai nghe MSI True Gaming Headset H991', 399000, 100, '', '', '', 'Tai nghe MSI True Gaming Headset H991.jpg', 'Kiểu tai nghe: Chụp đầu - Kêt nối: 3.5mm', 'NSX06', 'LSP10'),
('SP42', 'Tai nghe Gaming RAPOO VH310 Black', 390000, 100, '', '', '', 'Tai nghe Gaming RAPOO VH310 Black.jpg', 'Loại tai nghe: Chụp đầu - Kết nối: USB - Công nghệ: Âm thanh vòm 7.1 - Tiện ích: Đèn RGB, Mic thoại', 'NSX08', 'LSP10');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

DROP TABLE IF EXISTS `taikhoan`;
CREATE TABLE IF NOT EXISTS `taikhoan` (
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hoTen` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sdt` varchar(15) NOT NULL,
  `diachi` varchar(250) NOT NULL,
  `maCV` varchar(50) NOT NULL,
  `maKM` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userName`),
  KEY `PK_TK_CV` (`maCV`),
  KEY `PK_TK_KM` (`maKM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`userName`, `password`, `hoTen`, `email`, `sdt`, `diachi`, `maCV`, `maKM`) VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e', 'Hào ', 'hao09@gmail.com', '0909097290', 'TP.HCM', 'CV01', NULL),
('an1997', '6359a311fc835179c977c726bac79efe', 'Huỳnh An', 'an@gmail.com', '0902356848', 'Quận Bình Thạnh', 'CV02', NULL),
('hao0099', '14e35884f4b16db181a720600648296b', 'Hào sữa', 'hao0099@gmail.com', '2543695421', 'Quận 10', 'CV02', NULL),
('hao9898', 'e313a670f2946a1435d2167a8bf5429a', 'Hào phô mai', 'haophomai@gmail.com', '0909091123', 'Quận 8', 'CV02', NULL),
('hung2021', '620ebb50d1c968895355942decf0e622', 'Nhật Hùng', 'hung2021@gmail.com', '0312546762', 'Bình Tân', 'CV02', NULL),
('lam2020', '693ae5c011f3a8d8994577d4131b0f6c', 'Hoàng Lâm Xu Xu Xu', 'hoanglam@gmail.com', '0965841254', 'Quận 6', 'CV02', NULL),
('sangsang123', 'f9b095ed80b805ffaded484bdece9932', 'Sang Huỳnh', 'sanghuynh@gmail.com', '0124589875', 'Quận 11', 'CV02', NULL),
('thanhthanh', '8287842d10e4f0c07fb17ece386a9191', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', 'CV02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trangthai`
--

DROP TABLE IF EXISTS `trangthai`;
CREATE TABLE IF NOT EXISTS `trangthai` (
  `maTrangThai` varchar(10) NOT NULL,
  `tenTrangThai` varchar(50) NOT NULL,
  PRIMARY KEY (`maTrangThai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trangthai`
--

INSERT INTO `trangthai` (`maTrangThai`, `tenTrangThai`) VALUES
('DGH', 'Đang giao hàng'),
('DH', 'Đã hủy'),
('DXL', 'Đang xử lý'),
('HT', 'Hoàn thành');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `PK_CTDDH_DDH` FOREIGN KEY (`maDDH`) REFERENCES `dondathang` (`maDonDatHang`),
  ADD CONSTRAINT `PK_CTDDH_SP` FOREIGN KEY (`maSP`) REFERENCES `sanpham` (`maSanPham`);

--
-- Constraints for table `dondathang`
--
ALTER TABLE `dondathang`
  ADD CONSTRAINT `PK_DDH_TT` FOREIGN KEY (`maTT`) REFERENCES `trangthai` (`maTrangThai`);

--
-- Constraints for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `PK_KM_LKM` FOREIGN KEY (`maLKM`) REFERENCES `loaikhuyenmai` (`maLoai`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_SP_NSX` FOREIGN KEY (`maNSX`) REFERENCES `nhasanxuat` (`maNhaSanXuat`);

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `PK_TK_CV` FOREIGN KEY (`maCV`) REFERENCES `chucvu` (`maChucVu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
