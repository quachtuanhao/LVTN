-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 16, 2023 lúc 02:08 PM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dbbanmaytinh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`maChiTiet`, `maDDH`, `maSP`, `tenSP`, `giaSP`, `soLuong`, `tongTien`) VALUES
(49, 42, 'SP10', 'Nokia G21', 3900000, 1, 3900000),
(50, 42, 'SP08', 'Samsung Galaxy S22', 16000000, 2, 32000000),
(51, 43, 'SP04', 'Iphone 11', 12000000, 1, 12000000),
(52, 44, 'SP10', 'Nokia G21', 3900000, 1, 3900000),
(53, 45, 'SP03', 'Iphone 12', 17000000, 1, 17000000),
(54, 46, 'SP03', 'Iphone 12', 17000000, 1, 17000000),
(56, 48, 'SP03', 'Iphone 12', 17000000, 1, 17000000),
(57, 49, 'SP04', 'Iphone 11', 12000000, 1, 12000000),
(58, 50, 'SP03', 'Iphone 12', 17000000, 1, 17000000),
(59, 51, 'SP10', 'Nokia G21', 3900000, 1, 3900000),
(60, 52, 'SP03', 'Iphone 12', 17000000, 7, 119000000),
(61, 53, 'SP08', 'Samsung Galaxy S22', 16000000, 3, 48000000),
(62, 54, 'SP10', 'Nokia G21', 3900000, 1, 3900000),
(63, 54, 'SP08', 'Samsung Galaxy S22', 16000000, 1, 16000000),
(65, 56, 'SP03', 'Iphone 12', 17000000, 1, 17000000),
(66, 57, 'SP10', 'Nokia G21', 3900000, 2, 7800000),
(67, 57, 'SP02', 'Oppo A55', 4200000, 1, 4200000),
(68, 58, 'SP06', 'Realme 9', 5700000, 3, 17100000),
(69, 59, 'SP05', 'Xiaomi Redmi 10A', 2500000, 1, 2500000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

DROP TABLE IF EXISTS `chucvu`;
CREATE TABLE IF NOT EXISTS `chucvu` (
  `maChucVu` varchar(50) NOT NULL,
  `tenChucVu` varchar(50) NOT NULL,
  PRIMARY KEY (`maChucVu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`maChucVu`, `tenChucVu`) VALUES
('CV01', 'admin'),
('CV02', 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dondathang`
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dondathang`
--

INSERT INTO `dondathang` (`maDonDatHang`, `maKH`, `tenKhach`, `emailKhach`, `sdtKhach`, `diaChiKhach`, `ngayDat`, `maTT`, `maKM`) VALUES
(42, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '12345612333', 'ddhsad', '2022-11-28 12:26:18', 'HT', 'KM10'),
(43, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '12345612333', 'ddhsad', '2022-11-28 12:29:44', 'DXL', 'NULL'),
(44, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '12345612333', 'ddhsad', '2022-11-28 12:34:14', 'DXL', 'NULL'),
(45, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '12345612333', 'ddhsad', '2022-11-29 11:33:12', 'DXL', 'NULL'),
(46, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '12345612333', 'ddhsad', '2022-11-29 04:09:17', 'DXL', 'NULL'),
(47, 'user123', 'nguyen van abc', 'nguyenvanabc@gmail.com', '123456', 'abcxyz', '2022-11-29 08:24:02', 'DXL', 'NULL'),
(48, '123456', 'nguyen van a', 'abc@gmail.com', '123456', 'abc', '2022-11-29 08:31:08', 'DXL', NULL),
(49, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '12345612333', 'ddhsad', '2022-11-30 10:45:43', 'DXL', 'NULL'),
(50, '123', 'Bui thanh', 'thanhtran@gmail.com', '123', 'abc', '2022-12-07 10:49:42', 'DXL', NULL),
(51, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '12345612333', 'ddhsad', '2022-12-07 10:50:36', 'DXL', 'NULL'),
(52, '123454', 'k', 'kk@gmail.com', '123454', '123313', '2022-12-07 11:06:45', 'DXL', NULL),
(53, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '09090909090', 'ddhsad', '2022-12-07 11:18:05', 'HT', 'NULL'),
(54, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '09090909090', 'ddhsad', '2022-12-07 11:28:22', 'DXL', 'NULL'),
(56, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '09090909090', 'ddhsad', '2022-12-15 11:01:11', 'DXL', 'KM101'),
(57, 'user', 'Tuan Hao', 'tuanhao@gmail.com', '09090909090', 'ddhsad', '2022-12-15 02:22:53', 'DGH', 'NULL'),
(58, '123', 'Phát Ngô', 'ntpbot1@gmail.com', '123', '12331', '2023-09-25 07:23:14', 'DXL', NULL),
(59, 'ntpbot1', 'Phát Ngô', 'ntpbot1@gmail.com', '0396498263', '213', '2023-09-25 07:24:31', 'DGH', 'NULL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
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
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`maKhuyenMai`, `tenKhuyenMai`, `ngayBatDau`, `ngayKetThuc`, `maLKM`, `giaTriKhuyenMai`) VALUES
('2abc', 'ggg', '2022-12-15', '2022-12-24', 'KM1', 123),
('abc', 'acb', '2022-12-15', '2022-12-29', 'KM1', 123),
('KM10', 'Khuyến mãi tháng 11', '2022-11-26', '2022-11-30', 'KM2', 10),
('KM101', 'd', '2022-12-15', '2022-12-30', 'KM2', 10),
('NSX111', 'dad', '2022-11-28', '2022-12-14', 'KM2', 10),
('NULL', 'null', NULL, NULL, 'KM2', 0),
('V01', 'Khách hàng vip 1', '2022-11-25', '2023-11-25', 'KM2', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaikhuyenmai`
--

DROP TABLE IF EXISTS `loaikhuyenmai`;
CREATE TABLE IF NOT EXISTS `loaikhuyenmai` (
  `maLoai` varchar(50) NOT NULL,
  `tenLoai` varchar(50) NOT NULL,
  PRIMARY KEY (`maLoai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loaikhuyenmai`
--

INSERT INTO `loaikhuyenmai` (`maLoai`, `tenLoai`) VALUES
('KM1', 'Khuyến mãi theo tiền'),
('KM2', 'Khuyến mãi theo %');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhasanxuat`
--

DROP TABLE IF EXISTS `nhasanxuat`;
CREATE TABLE IF NOT EXISTS `nhasanxuat` (
  `maNhaSanXuat` varchar(50) NOT NULL,
  `tenNhaSanXuat` varchar(50) NOT NULL,
  `truSoChinh` varchar(250) NOT NULL,
  PRIMARY KEY (`maNhaSanXuat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhasanxuat`
--

INSERT INTO `nhasanxuat` (`maNhaSanXuat`, `tenNhaSanXuat`, `truSoChinh`) VALUES
('NSX01', 'Realme', 'no'),
('NSX02', 'Apple', 'Cupertino, California, Mỹ'),
('NSX03', 'Oppo', 'Đông Hoản, Quảng Đông, Trung Quốc'),
('NSX04', 'Samsung', 'Samsung Town, Seocho, Seoul, Hàn QuốcSan \r\nJose, Silicon Valley, California, Hoa Kỳ'),
('NSX05', 'Nokia', 'Espoo, Phần Lan'),
('NSX06', 'Xiaomi', 'Hải Điến, Bắc Kinh, Trung Quốc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `maSanPham` varchar(50) NOT NULL,
  `tenSanPham` varchar(50) NOT NULL,
  `gia` double NOT NULL,
  `ram` int(10) NOT NULL,
  `dungLuong` int(10) NOT NULL,
  `pin` int(50) NOT NULL,
  `hinhAnh` varchar(250) NOT NULL,
  `moTa` varchar(500) NOT NULL,
  `maNSX` varchar(50) NOT NULL,
  PRIMARY KEY (`maSanPham`),
  KEY `FK_SP_NSX` (`maNSX`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`maSanPham`, `tenSanPham`, `gia`, `ram`, `dungLuong`, `pin`, `hinhAnh`, `moTa`, `maNSX`) VALUES
('SP01', 'Iphone 13 Pro Max', 27000000, 4, 512, 3240, 'iphone-13-pro-max.jpg', '17000000', 'NSX02'),
('SP02', 'Oppo A55', 4200000, 4, 64, 5000, 'oppo-a55-4g.jpg', 'no', 'NSX03'),
('SP03', 'Iphone 12', 17000000, 4, 128, 2815, 'iphone-12.jpg', '', 'NSX02'),
('SP04', 'Iphone 11', 12000000, 4, 64, 3110, 'iphone-11.jpg', '', 'NSX02'),
('SP05', 'Xiaomi Redmi 10A', 2500000, 2, 32, 5000, 'xiaomi-redmi-10a.jpg', 'no', 'NSX06'),
('SP06', 'Realme 9', 5700000, 8, 128, 5000, 'realme-9.jpg', 'no', 'NSX01'),
('SP07', 'Samsung Galaxy A23', 6400000, 4, 128, 5000, 'samsung-galaxy-a23.jpg', '', 'NSX04'),
('SP08', 'Samsung Galaxy S22', 16000000, 8, 128, 3700, 'Galaxy-S22.jpg', '', 'NSX04'),
('SP09', 'Nokia G10', 3200000, 4, 64, 5050, 'Nokia-g10.jpg', '', 'NSX05'),
('SP10', 'Nokia G21', 3900000, 4, 128, 5050, 'nokia-g21.jpg', '', 'NSX05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
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
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`userName`, `password`, `hoTen`, `email`, `sdt`, `diachi`, `maCV`, `maKM`) VALUES
('abcd', 'e10adc3949ba59abbe56e057f20f883e', 'abcdef', 'abc@gmail.com', '1231231231', '1231', 'CV02', NULL),
('admin', 'e10adc3949ba59abbe56e057f20f883e', 'Thanh bui', 'thanhbui@gmail.com', '61375', 'abc', 'CV01', NULL),
('ntpbot1', 'e10adc3949ba59abbe56e057f20f883e', 'Phát Ngô', 'ntpbot1@gmail.com', '0396498263', '213', 'CV02', NULL),
('thanhbui', 'e10adc3949ba59abbe56e057f20f883e', 'tran van thanh 123', 'thanh123@gmail.com', '123456', 'abcxyz', 'CV02', NULL),
('user', '99c5e07b4d5de9d18c350cdf64c5aa3d', 'Tuan Hao', 'tuanhao@gmail.com', '09090909090', 'ddhsad', 'CV02', 'NULL'),
('user1111', 'e10adc3949ba59abbe56e057f20f883e', 'noname', 'ntpbot1@gmail.com', '', '', 'CV02', NULL),
('user123', 'e10adc3949ba59abbe56e057f20f883e', 'nguyen van abc', 'nguyenvanabc@gmail.com', '123456', 'abcxyz', 'CV02', NULL),
('user2', 'e10adc3949ba59abbe56e057f20f883e', 'thanhtranabc', 'thanhtran@gmail.com', '123456', 'abc xyz', 'CV02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trangthai`
--

DROP TABLE IF EXISTS `trangthai`;
CREATE TABLE IF NOT EXISTS `trangthai` (
  `maTrangThai` varchar(10) NOT NULL,
  `tenTrangThai` varchar(50) NOT NULL,
  PRIMARY KEY (`maTrangThai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `trangthai`
--

INSERT INTO `trangthai` (`maTrangThai`, `tenTrangThai`) VALUES
('DGH', 'Đang giao hàng'),
('DH', 'Đã hủy'),
('DXL', 'Đang xử lý'),
('HT', 'Hoàn thành');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `PK_CTDDH_DDH` FOREIGN KEY (`maDDH`) REFERENCES `dondathang` (`maDonDatHang`),
  ADD CONSTRAINT `PK_CTDDH_SP` FOREIGN KEY (`maSP`) REFERENCES `sanpham` (`maSanPham`);

--
-- Các ràng buộc cho bảng `dondathang`
--
ALTER TABLE `dondathang`
  ADD CONSTRAINT `PK_DDH_KM` FOREIGN KEY (`maKM`) REFERENCES `khuyenmai` (`maKhuyenMai`),
  ADD CONSTRAINT `PK_DDH_TT` FOREIGN KEY (`maTT`) REFERENCES `trangthai` (`maTrangThai`);

--
-- Các ràng buộc cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `PK_KM_LKM` FOREIGN KEY (`maLKM`) REFERENCES `loaikhuyenmai` (`maLoai`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_SP_NSX` FOREIGN KEY (`maNSX`) REFERENCES `nhasanxuat` (`maNhaSanXuat`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `PK_TK_CV` FOREIGN KEY (`maCV`) REFERENCES `chucvu` (`maChucVu`),
  ADD CONSTRAINT `PK_TK_KM` FOREIGN KEY (`maKM`) REFERENCES `khuyenmai` (`maKhuyenMai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
