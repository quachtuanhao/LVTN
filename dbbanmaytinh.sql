-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2024 at 07:53 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbanmaytinh`
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
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chitietdathang`
--

INSERT INTO `chitietdathang` (`maChiTiet`, `maDDH`, `maSP`, `tenSP`, `giaSP`, `soLuong`, `tongTien`) VALUES
(73, 62, 'SP06', 'Hp Elitebook 830 G9', 15000000, 1, 15000000),
(74, 63, 'SP06', 'Hp Elitebook 830 G9', 15000000, 1, 15000000),
(75, 64, 'SP06', 'Hp Elitebook 830 G9', 15000000, 1, 15000000),
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
(98, 77, 'SP05', 'RAM Laptop Samsung 16GB DDR4', 850000, 1, 850000);

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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dondathang`
--

INSERT INTO `dondathang` (`maDonDatHang`, `maKH`, `tenKhach`, `emailKhach`, `sdtKhach`, `diaChiKhach`, `ngayDat`, `maTT`, `maKM`) VALUES
(62, 'hao9898', 'Hào phô mai', 'haophomai@gmail.com', '0909091122', 'Quận 8', '2023-12-24 11:30:00', 'HT', 'KM100K'),
(63, 'hao9898', 'Hào phô mai', 'haophomai@gmail.com', '0909091122', 'Quận 8', '2023-12-24 11:32:05', 'HT', 'KM10'),
(64, '0235444', 'hung', 'hung@gmial.com', '0235444', '2564 hàm nghi', '2023-12-25 02:50:04', 'HT', NULL),
(65, 'hao0099', 'Hào sữa', 'hao0099@gmail.com', '2543695421', 'Quận 10', '2023-12-25 03:22:09', 'DGH', 'NULL'),
(66, 'hao9898', 'Hào phô mai', 'haophomai@gmail.com', '0909091122', 'Quận 8', '2023-12-26 01:54:03', 'DGH', 'KM10'),
(67, 'hao9898', 'Hào phô mai', 'haophomai@gmail.com', '0909091122', 'Quận 8', '2023-12-26 01:55:25', 'DGH', 'KM100K'),
(68, 'lam2020', 'Hoàng Lâm ', 'hoanglam@gmail.com', '0965841254', 'Quận 7', '2023-12-26 02:17:59', 'DGH', 'NULL'),
(69, 'an1997', 'Huỳnh An', 'an@gmail.com', '0902356848', 'Quận Bình Thạnh', '2023-12-27 08:38:25', 'DGH', 'NULL'),
(70, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2023-12-27 08:43:53', 'DXL', 'KM12NOEL'),
(71, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2023-12-27 09:10:38', 'DXL', 'KM12NOEL'),
(72, 'thanhthanh', 'Thanh Huỳnh', 'thanh@gmail.com', '0122554689', 'Quận 1', '2023-12-27 10:52:33', 'DXL', 'KM12NOEL2'),
(75, 'an1997', 'Huỳnh An', 'an@gmail.com', '0902356848', 'Quận Bình Thạnh', '2023-12-28 10:15:02', 'DXL', 'KM12NOEL'),
(76, 'hung2021', 'Nhật Hùng', 'hung2021@gmail.com', '0312546761', 'Bình Tân', '2023-12-28 01:23:26', 'DXL', 'KM12NOEL2'),
(77, 'hung2021', 'Nhật Hùng', 'hung2021@gmail.com', '0312546761', 'Bình Tân', '2024-01-03 02:51:02', 'DXL', 'KM10');

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
  PRIMARY KEY (`maKhuyenMai`),
  KEY `PK_KM_LKM` (`maLKM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khuyenmai`
--

INSERT INTO `khuyenmai` (`maKhuyenMai`, `tenKhuyenMai`, `ngayBatDau`, `ngayKetThuc`, `maLKM`, `giaTriKhuyenMai`) VALUES
('KM10', 'Khuyến mãi 10%', '2023-11-26', '2023-12-10', 'KM2', 10),
('KM100K', 'Khuyến mãi 100k', '2023-12-15', '2023-12-19', 'KM1', 100000),
('KM12NOEL', 'Khuyến mãi tháng 12', '2023-12-21', '2023-12-28', 'KM1', 2000000),
('KM12NOEL2', 'Khuyến mãi tháng 12', '2023-12-21', '2023-12-28', 'KM2', 20),
('KM200k', 'Khuyến mãi 200k ', '2023-12-28', '2023-12-31', 'KM1', 200000),
('null', 'null', NULL, NULL, 'KM1', 0);

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
('NSX01', 'Laptop', 'TP.HCM'),
('NSX02', 'CPU', 'TP.HCM'),
('NSX03', 'Mainboard', 'TP.HCM'),
('NSX04', 'Ram', 'TP.HCM'),
('NSX05', 'Ổ cứng', 'TP.HCM'),
('NSX06', 'Màn hình', 'TP.HCM'),
('NSX07', 'Chuột + Lót chuột', 'TP.HCM'),
('NSX08', 'Bàn phím', 'TP.HCM');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `maSanPham` varchar(50) NOT NULL,
  `tenSanPham` varchar(50) NOT NULL,
  `gia` double NOT NULL,
  `ram` varchar(50) NOT NULL,
  `dungLuong` varchar(50) NOT NULL,
  `pin` varchar(50) NOT NULL,
  `hinhAnh` varchar(250) NOT NULL,
  `moTa` varchar(500) NOT NULL,
  `maNSX` varchar(50) NOT NULL,
  PRIMARY KEY (`maSanPham`),
  KEY `FK_SP_NSX` (`maNSX`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`maSanPham`, `tenSanPham`, `gia`, `ram`, `dungLuong`, `pin`, `hinhAnh`, `moTa`, `maNSX`) VALUES
('SP02', 'Mainboard Gigabyte Z790 GAMING X AX DDR5', 7090000, '', '', '', 'Mainboard Gigabyte Z790 GAMING X AX DDR5.jpg', 'Socket: LGA1700 hỗ trợ CPU Intel thế hệ 13, Intel thế hệ thứ 12, Pentium® Gold and Celeron® Processors - Khe cắm RAM: 4 khe (Tối đa 192GB) - Khe cắm mở rộng: 1 x PCI Express 5.0 x16 slot, 1 x PCI Express 4.0 x16 slots, 1 x PCI Express 3.0 x16 slots - Khe cắm ổ cứng: 4 x M.2 slots, 6 x SATA 6Gb/s ports', 'NSX03'),
('SP03', 'Mainboard Asus Prime H610M-K D4', 1990000, '', '', '', 'Mainboard Asus Prime H610M-K D4.jpg', 'LGA1700 - ATX motherboard - DDR4', 'NSX03'),
('SP04', 'RAM Laptop Kingston 8GB DDR4 bus', 599000, 'DDR4', '8GB', '', 'RAM Laptop Kingston 8GB DDR4 bus.jpg', '8GB - DDR4 - Bus 2666MHz', 'NSX04'),
('SP05', 'RAM Laptop Samsung 16GB DDR4', 850000, 'DDR4', '16GB', '', 'RAM-Laptop-Samsung-16GB-DDR4-3200.jpg', 'RAM DDR4 - Dung lượng: 16GB - Tốc độ: 3200MHz', 'NSX04'),
('SP06', 'Hp Elitebook 830 G9', 15000000, '8GB', 'SSD 256GB', '51 Wh', 'Hp Elitebook 830 G9.jpg', 'Màn hình: 14 inch - CPU: intel Core i5-1235U - Tần số xung nhịp CPU: 3.30 GHz đến 4.40 GHz Intel® Integrated Intel® Iris® Xe Graphics  Trọng lượng: 1.2 kg', 'NSX01'),
('SP07', 'HP 240 G9 6L1X7PA', 9990000, '8GB', 'SSD 256GB', '41 Wh', 'Laptop HP 240 G9 6L1X7PA.jpg', 'CPU: Intel Core i3-1215U (upto 4.40 GHz, 10MB) - VGA: Intel UHD Graphics - Màn hình: 14 inch FullHD - Cân nặng: 1.47 kg', 'NSX01'),
('SP08', 'CPU Intel Core i7-12700K', 9850000, '', '', '', 'CPU Intel Core i7-12700K.jpg', '3.6GHz up to 5.0GHz, 25MB', 'NSX02'),
('SP09', 'CPU Intel Core I9 14900K', 10990000, '', '', '', 'CPU Intel Core I9 14900K.png', 'Up 6.0 GHz, 24 Nhân 32 Luồng, 36MB Cache, Raptor Lake Refresh', 'NSX02'),
('SP10', 'Ổ Cứng SSD Kingston KC600', 1410000, '', '', '', 'Ổ Cứng SSD Kingston KC600.jpg', '256GB 2.5 Inch SATA3 -  Đọc 500MB/s, Ghi 500MB/s', 'NSX05'),
('SP11', 'Ổ cứng SSD Kingfast F10', 1500000, '', '', '', 'Ổ cứng SSD Kingfast F10.jpg', '512GB SATA III 2.5 Inch', 'NSX05'),
('SP12', 'CPU Intel Core I5 14600K', 5290000, '', '', '', 'CPU Intel Core I5 14600K.png', 'Up 5.30 GHz, 14 Nhân 20 Luồng, 24MB Cache, Raptor Lake Refresh', 'NSX02'),
('SP13', 'Acer Aspire 7 Gaming A715-76-57CY', 13990000, '8 GB', 'SSD 512GB', '50 Wh', 'Acer Aspire 7 Gaming A715-76-57CY.jpg', 'CPU: Intel Core i5-12450H - VGA: Intel UHD Graphics - Màn hình: 15.6 inch FHD - Cân nặng: 2.1 kg', 'NSX01'),
('SP14', 'Màn hình MSI PRO MP243X', 2190000, '', '', '', 'Màn hình MSI PRO MP243X.jpg', '23.8 inch FHD/IPS/100Hz/4ms/HDMI', 'NSX06'),
('SP15', 'Màn hình Asus VZ24EHE-R', 2390000, '', '', '', 'Màn hình Asus VZ24EHE-R.jpg', '23.8 inch FHD/IPS/75Hz/1ms/FreeSync/HDMI', 'NSX06'),
('SP16', 'Chuột chơi game Dareu EM908 RGB', 380000, '', '', '', 'Chuột chơi game Dareu EM908 RGB.jpg', 'Tình trạng: Mới - Kết nối: có dây, cổng kết nối chuẩn USB - Tương thích: Windows 10, Windows 7, Mac OS và các hệ điều hành cũ.', 'NSX07'),
('SP17', 'Chuột Không Dây DAREU EM901 RGB - BLACK', 550000, '', '', '', 'Chuột Không Dây DAREU EM901 RGB - BLACK.jpg', 'Kết nối không dây 2,4 GHz - Switch: DareU (10 triệu lần click)', 'NSX07'),
('SP18', 'Miếng lót chuột khổ lớn 80 X 30 CM', 60000, '', '', '', 'Miếng lót chuột khổ lớn 80 X 30 CM.jpg', 'Kiểu dáng: hình chữ nhật - Lót chuột Kích thước : 80×30 cm - Độ dày : 0.3 cm - Chất liệu : đế cao su | mặt vải - Bề mặt : Trơn, Nhẵn - Chất lượng in: Sắc nét', 'NSX07'),
('SP19', 'Miếng lót chuột nhỏ kích thước 21x26cm', 30000, '', '', '', 'Miếng lót chuột nhỏ kích thước 21x26cm.jpg', 'Kiểu dáng: hình chữ nhật - Kích thước : 21x26cm - Độ dày : 0.2 cm - Chất liệu : Cao su - Bề mặt : Trơn – Nhẵn', 'NSX07');

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
('hao9898', '894e8158030d2cb5f95f458018073169', 'Hào phô mai', 'haophomai@gmail.com', '0909091122', 'Quận 8', 'CV02', NULL),
('hung2021', '620ebb50d1c968895355942decf0e622', 'Nhật Hùng', 'hung2021@gmail.com', '0312546761', 'Bình Tân', 'CV02', NULL),
('lam2020', '693ae5c011f3a8d8994577d4131b0f6c', 'Hoàng Lâm ', 'hoanglam@gmail.com', '0965841254', 'Quận 6', 'CV02', NULL),
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
