-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 02, 2021 lúc 09:49 AM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopclone5`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_domains`
--

CREATE TABLE `api_domains` (
  `id` int(11) NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `api_domains`
--

INSERT INTO `api_domains` (`id`, `domain`, `username`, `password`, `time`) VALUES
(4, 'http://shopclone5.toithietkeweb.com/', 'admin', 'admin', '2021-08-24 04:01:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `backups`
--

CREATE TABLE `backups` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `backups`
--

INSERT INTO `backups` (`id`, `filename`, `time`, `thoigian`) VALUES
(4, 'test', '1614982097', '2021-03-06 05:08:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `stk` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `bank_name` text DEFAULT NULL,
  `chi_nhanh` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `bank`
--

INSERT INTO `bank` (`id`, `stk`, `name`, `bank_name`, `chi_nhanh`, `logo`, `ghichu`) VALUES
(5, '106868238271', 'Vietinbank Auto', 'NGUYEN TAN THANH', 'Tây Ninh', 'https://i.imgur.com/5lONuYM.png', 'Vui lòng nhập đúng nội dung khi chuyển khoản.\r\n'),
(7, '10002325589898', 'Vietcombank Auto', 'NGUYEN TAN THANH', 'Tay Ninh', 'https://i.imgur.com/9wOUZTv.png', 'Nhập đúng nội dung, cộng tiền ngay');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_auto`
--

CREATE TABLE `bank_auto` (
  `id` int(11) NOT NULL,
  `tid` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `amount` int(11) DEFAULT 0,
  `cusum_balance` int(11) DEFAULT 0,
  `time` datetime DEFAULT NULL,
  `bank_sub_acc_id` varchar(64) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `username` varchar(64) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `username` varchar(32) NOT NULL,
  `loaithe` varchar(32) NOT NULL,
  `menhgia` int(11) NOT NULL,
  `thucnhan` int(11) DEFAULT 0,
  `seri` text NOT NULL,
  `pin` text NOT NULL,
  `createdate` datetime NOT NULL,
  `status` varchar(32) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `stt` int(11) DEFAULT 0,
  `title` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `display` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `stt`, `title`, `display`, `img`) VALUES
(4, 2, 'DANH SÁCH VIA FACEBOOK', 'SHOW', 'assets/storage/images/category_R36HMAODF14C.png'),
(6, 1, 'DANH SÁCH CLONE FACEBOOK', 'SHOW', 'assets/storage/images/category_8GKUR69W7HJS.png'),
(7, 0, 'DANH SÁCH TÀI KHOẢN GMAIL', 'SHOW', 'assets/storage/images/category_1NS5B048Q2FU.png'),
(9, 3, 'TÀI KHOẢN TRAODOISUB.COM', 'SHOW', 'assets/storage/images/category_DXMP3BA8W0RO.png'),
(10, 4, 'TÀI KHOẢN AZURE', 'SHOW', 'assets/storage/images/category_SR4GYUE5WLQJ.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyentien`
--

CREATE TABLE `chuyentien` (
  `id` int(11) NOT NULL,
  `nguoinhan` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `nguoichuyen` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `sotien` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `config_momo`
--

CREATE TABLE `config_momo` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dichvu`
--

CREATE TABLE `dichvu` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `dichvu` blob DEFAULT NULL,
  `gia` int(11) DEFAULT NULL,
  `loai` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `mota` longblob DEFAULT NULL,
  `display` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `capnhat` datetime DEFAULT NULL,
  `mua_toi_da` int(11) DEFAULT NULL,
  `quocgia` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `mua_toi_thieu` int(11) DEFAULT 1,
  `luuy` longblob DEFAULT NULL,
  `stt` int(11) NOT NULL,
  `check_live` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT 'OFF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `dichvu`
--

INSERT INTO `dichvu` (`id`, `username`, `dichvu`, `gia`, `loai`, `thoigian`, `mota`, `display`, `capnhat`, `mua_toi_da`, `quocgia`, `mua_toi_thieu`, `luuy`, `stt`, `check_live`) VALUES
(8, 'admin', 0x474d41494c2052414e444f4d2054c38a4e205449e1babe4e4720414e48202b4156415441522b504f50332b494d41502b4c495645373748, 500, 'DANH SÁCH TÀI KHOẢN GMAIL', '2021-02-18 02:30:08', 0x74657374, 'SHOW', '2021-06-30 23:43:12', 100, 'vn', 1, '', 0, 'GMAIL'),
(11, 'admin', 0x205669612043e1bb95205068696c6970696e204368616e67652046756c6c20584d4454, 80000, 'DANH SÁCH VIA FACEBOOK', '2021-04-06 10:15:36', 0x46756c6c206261636b7570, 'SHOW', '2021-06-30 23:43:04', 100, 'ph', 1, '', 0, 'VIA'),
(15, 'admin', 0x54c3a069206b686fe1baa36e2054445320316d207875, 20000, 'TÀI KHOẢN TRAODOISUB.COM', '2021-04-06 17:07:27', 0x4b68c3b46e672063e1baa5752068c3ac6e68, 'SHOW', '2021-06-30 23:44:38', 1000, 'vn', 1, '', 1, 'OFF'),
(18, 'admin', 0x54c3a069206b686fe1baa36e20417a757265203130303024, 99999, 'TÀI KHOẢN AZURE', '2021-07-01 00:14:15', 0x567569206cc3b26e67206e68e1baad70206ee1bb99692064756e67206dc3b42074e1baa32073e1baa36e207068e1baa96d, 'SHOW', NULL, 1000, '', 1, 0x4e68e1baad70206cc6b07520c3bd20686fe1bab7632068c6b0e1bb9b6e672064e1baab6e2063686f2073e1baa36e207068e1baa96d206ec3a07920287875e1baa574206869e1bb876e206b6869206d756129, 0, 'OFF'),
(19, 'admin', 0x436c6f6e6520766572792070686f6e65, 100, 'DANH SÁCH CLONE FACEBOOK', '2021-07-01 00:15:38', '', 'SHOW', '2021-09-15 21:39:29', 100, 'vn', 1, 0x4e68e1baad70206cc6b07520c3bd20686fe1bab7632068c6b0e1bb9b6e672064e1baab6e2063686f2073e1baa36e207068e1baa96d206ec3a07920287875e1baa574206869e1bb876e206b6869206d756129, 0, 'CLONE'),
(20, 'admin', 0x436c6f6e65206e6f76657279, 100, 'DANH SÁCH CLONE FACEBOOK', '2021-08-19 05:48:35', '', 'SHOW', NULL, 100, 'vn', 1, 0x4e68e1baad70206cc6b07520c3bd20686fe1bab7632068c6b0e1bb9b6e672064e1baab6e2063686f2073e1baa36e207068e1baa96d206ec3a07920287875e1baa574206869e1bb876e206b6869206d756129, 1, 'CLONE'),
(21, 'admin', 0x436c6f6e6520766572692070686f6e65, 200, 'DANH SÁCH CLONE FACEBOOK', '2021-08-26 00:50:35', 0x436c6f6e6520766572692070686f6e652066756c6c20c491e1bb8b6e682064e1baa16e67, 'SHOW', NULL, 100, 'vn', 1, 0x3c703e4e68e1baad70206cc6b07520c3bd20686fe1bab7632068c6b0e1bb9b6e672064e1baab6e2063686f2073e1baa36e207068e1baa96d206ec3a07920287875e1baa574206869e1bb876e206b6869206d7561293c2f703e3c703e762e763c2f703e, 1, 'CLONE');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongtien`
--

CREATE TABLE `dongtien` (
  `id` int(11) NOT NULL,
  `sotientruoc` int(11) DEFAULT NULL,
  `sotienthaydoi` int(11) DEFAULT NULL,
  `sotiensau` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `noidung` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `dongtien`
--

INSERT INTO `dongtien` (`id`, `sotientruoc`, `sotienthaydoi`, `sotiensau`, `thoigian`, `noidung`, `username`) VALUES
(193, 1940000, 10000, 1930000, '2021-05-26 01:58:00', 'Thanh toán đơn hàng (#OIE58SVGNA3M)', 'admin'),
(194, 1930000, 10000, 1920000, '2021-05-26 01:58:28', 'Thanh toán đơn hàng (#645980HRAYTV)', 'admin'),
(195, 1920000, 10000, 1910000, '2021-05-26 02:23:08', 'Thanh toán đơn hàng (#1QE8DX0FHW4R)', 'admin'),
(196, 1910000, 10000, 1900000, '2021-05-26 03:31:43', 'Thanh toán đơn hàng (#ARMJSOVB2IZN)', 'admin'),
(197, 1900000, 10000, 1890000, '2021-05-27 07:15:02', 'Thanh toán đơn hàng (#IVBT1622074502)', 'admin'),
(198, 1890000, 10000, 1880000, '2021-05-27 07:15:15', 'Thanh toán đơn hàng (#WLO31622074515)', 'admin'),
(199, 200000000, 100, 199999900, '2021-08-04 17:20:23', 'Thanh toán đơn hàng (#KML71628072423)', 'admin'),
(200, 199999900, 100, 199999800, '2021-08-04 17:21:41', 'Thanh toán đơn hàng (#AT601628072501)', 'admin'),
(201, 199999800, 100, 199999700, '2021-08-04 17:57:54', 'Thanh toán đơn hàng (#LH1S1628074674)', 'admin'),
(202, 199999700, 100, 199999600, '2021-08-19 20:36:12', 'Thanh toán đơn hàng (#OR1L1629380172)', 'admin'),
(203, 199999600, 100, 199999500, '2021-08-19 20:36:53', 'Thanh toán đơn hàng (#YEVF1629380213)', 'admin'),
(204, 199999500, 100, 199999400, '2021-08-19 20:39:00', 'Thanh toán đơn hàng (#1ORX1629380340)', 'admin'),
(205, 199999400, 100, 199999300, '2021-08-19 20:39:18', 'Thanh toán đơn hàng (#45K11629380358)', 'admin'),
(206, 199999300, 100, 199999200, '2021-08-19 20:43:38', 'Thanh toán đơn hàng (#4Y3E1629380618)', 'admin'),
(207, 199999200, 100, 199999100, '2021-08-19 20:49:36', 'Thanh toán đơn hàng (#R74K1629380976)', 'admin'),
(208, 199999100, 100, 199999000, '2021-08-19 20:49:40', 'Thanh toán đơn hàng (#256S1629380980)', 'admin'),
(209, 199999000, 100, 199998900, '2021-08-19 20:50:01', 'Thanh toán đơn hàng (#MXTJ1629381001)', 'admin'),
(210, 199998900, 100, 199998800, '2021-08-19 20:51:52', 'Thanh toán đơn hàng (#G8901629381112)', 'admin'),
(211, 199998800, 100, 199998700, '2021-08-19 20:52:02', 'Thanh toán đơn hàng (#EQ3Z1629381122)', 'admin'),
(212, 199998700, 100, 199998600, '2021-08-19 20:53:01', 'Thanh toán đơn hàng (#VW4G1629381181)', 'admin'),
(213, 199998600, 100, 199998500, '2021-08-19 20:53:29', 'Thanh toán đơn hàng (#UN3Y1629381209)', 'admin'),
(214, 199998500, 300, 199998200, '2021-08-19 20:54:29', 'Thanh toán đơn hàng (#5RGT1629381269)', 'admin'),
(215, 199998200, 100, 199998100, '2021-08-19 20:56:16', 'Thanh toán đơn hàng (#FKJG1629381376)', 'admin'),
(216, 199998100, 300, 199997800, '2021-08-19 20:57:19', 'Thanh toán đơn hàng (#SLD51629381439)', 'admin'),
(217, 199998100, 400, 199997700, '2021-08-19 20:57:21', 'Thanh toán đơn hàng (#24KZ1629381441)', 'admin'),
(218, 199997400, 400, 199997000, '2021-08-20 06:35:13', 'Thanh toán đơn hàng (#LZHB1629416113)', 'admin'),
(219, 199997000, 100, 199996900, '2021-08-20 06:56:06', 'Thanh toán đơn hàng (#0QOI1629417366)', 'admin'),
(220, 199996900, 100, 199996800, '2021-08-20 06:56:19', 'Thanh toán đơn hàng (#2XLT1629417379)', 'admin'),
(221, 199996800, 100, 199996700, '2021-08-20 06:56:28', 'Thanh toán đơn hàng (#924O1629417388)', 'admin'),
(222, 199996700, 500, 199996200, '2021-08-20 06:57:41', 'Thanh toán đơn hàng (#QCI91629417461)', 'admin'),
(223, 199996200, 100, 199996100, '2021-08-20 06:57:47', 'Thanh toán đơn hàng (#NH1D1629417467)', 'admin'),
(224, 199996100, 100, 199996000, '2021-08-20 06:58:02', 'Thanh toán đơn hàng (#SUE21629417482)', 'admin'),
(225, 199996000, 100, 199995900, '2021-08-20 06:58:44', 'Thanh toán đơn hàng (#4IDS1629417524)', 'admin'),
(226, 199995900, 100, 199995800, '2021-08-20 06:59:27', 'Thanh toán đơn hàng (#BGSZ1629417567)', 'admin'),
(227, 199995800, 300, 199995500, '2021-08-20 07:03:49', 'Thanh toán đơn hàng (#VCTA1629417829)', 'admin'),
(228, 199995500, 100, 199995400, '2021-08-20 07:04:21', 'Thanh toán đơn hàng (#D8TS1629417861)', 'admin'),
(229, 199995070, 110, 199994960, '2021-08-21 20:31:32', 'Thanh toán đơn hàng (#O8MN1629552692)', 'admin'),
(230, 199994960, 100, 199994860, '2021-08-24 04:42:09', 'Thanh toán đơn hàng (#5TN61629754929)', 'admin'),
(231, 199994860, 200, 199994660, '2021-08-26 00:52:11', 'Thanh toán đơn hàng (#RGZA1629913931)', 'admin'),
(232, 199994660, 1000, 199993660, '2021-08-28 06:28:52', 'Thanh toán đơn hàng (#Z2FK1630106932)', 'admin'),
(233, 199993660, 500, 199993160, '2021-08-30 15:05:44', 'Thanh toán đơn hàng (#BMR51630310744)', 'admin'),
(234, 199993160, 500, 199992660, '2021-08-30 15:06:02', 'Thanh toán đơn hàng (#9RE81630310762)', 'admin'),
(235, 199992660, 500, 199992160, '2021-08-30 15:06:17', 'Thanh toán đơn hàng (#7EI91630310777)', 'admin'),
(236, 199992160, 200, 199991960, '2021-09-02 23:37:04', 'Thanh toán đơn hàng (#GMX11630600624)', 'admin'),
(237, 199991960, 100000, 200091960, '2021-09-09 00:36:06', 'Admin cộng tiền vào số dư khả dụng ()', 'admin'),
(238, 200091960, 1000000, 201091960, '2021-09-09 00:39:34', 'Admin cộng tiền vào số dư khả dụng (nap bank)', 'admin'),
(239, 201091960, 1000000, 202091960, '2021-09-09 00:42:28', 'Admin cộng tiền vào số dư khả dụng (aa)', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giftcode`
--

CREATE TABLE `giftcode` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `sotien` int(11) NOT NULL DEFAULT 0,
  `ghichu` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `capnhat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hide_category_api`
--

CREATE TABLE `hide_category_api` (
  `id` int(11) NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hide_product_api`
--

CREATE TABLE `hide_product_api` (
  `id` int(11) NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `vn` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `en` text COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `lang`
--

INSERT INTO `lang` (`id`, `vn`, `en`) VALUES
(1, 'Đăng Nhập', 'Login'),
(2, 'Đăng Ký', 'Register'),
(3, 'Thông Tin', 'Profile'),
(4, 'Đăng Nhập hoặc Đăng Ký', 'Login or Register'),
(5, 'Tên đăng nhập', 'Username'),
(6, 'Mật khẩu', 'Password'),
(7, 'Nhập tên đăng nhập', 'Enter your username'),
(8, 'Nhập mật khẩu', 'Enter password'),
(9, 'Đang xử lý', 'Processing'),
(10, 'Vui lòng nhập tên đăng nhập', 'Please enter your username'),
(11, 'Vui lòng nhập mật khẩu', 'Please enter a password'),
(12, 'Tên đăng nhập không tồn tại', 'Username does not exist'),
(13, 'Mật khẩu đăng nhập không chính xác', 'Login password is incorrect'),
(14, 'Tài khoản đã bị khóa', 'The account is locked'),
(15, 'Vui lòng nhập định dạng tài khoản hợp lệ', 'Please enter a valid account format'),
(16, 'Tài khoản phải từ 5 đến 64 ký tự', 'Account must be between 5 and 64 characters'),
(17, 'Tên đăng nhập đã tồn tại!', 'Username available!'),
(18, 'Vui lòng đặt mật khẩu trên 3 ký tự', 'Please set a password above 3 characters'),
(19, 'Bạn đã đạt giới hạn tạo tài khoản', 'You have reached your account creation limit'),
(20, 'Tạo tài khoản thành công', 'Account successfully created'),
(21, 'Vui lòng kiểm tra cấu hình cơ sở dữ liệu', 'Please check the database configuration'),
(22, 'Vui lòng nhập địa chỉ email', 'Please enter your email address'),
(23, 'Vui lòng nhập địa chỉ email hợp lệ', 'Please enter a valid email address'),
(24, 'Địa chỉ email không tồn tại trong hệ thống', 'Email address does not exist in the system'),
(25, 'XÁC NHẬN KHÔI PHỤC MẬT KHẨU', 'CONFIRMED PASSWORD RECOVERY'),
(26, 'Có ai đó vừa yêu cầu khôi phục lại mật khẩu bằng Email này, nếu là bạn vui lòng nhập mã xác minh phía dưới để xác minh tài khoản', 'Someone has just requested to recover password by this email, if you are, please enter the verification code below to verify the account.'),
(27, 'Chúng tôi đã gửi mã xác minh vào địa chỉ Email của bạn', 'We have sent a verification code to your Email address'),
(28, 'Vui lòng nhập mật khẩu mới', 'Please enter a new password'),
(29, 'Vui lòng xác minh lại mật khẩu', 'Please verify your password'),
(30, 'Tổng nạp', 'Total Balance'),
(31, 'Số dư hiện tại', 'Credit Available'),
(32, 'Số tiền đã sử dụng', 'Amount used'),
(33, 'Nạp tiền ngay', 'Pay Now'),
(34, 'Lịch sử dòng tiền', 'Cash flow history'),
(35, 'THỐNG KÊ CHI TIẾT', 'DETAILED STATISTICS'),
(36, 'Lịch Sử Giao Dịch', 'Transaction history'),
(37, 'Nạp Tiền', 'Recharge'),
(38, 'THÔNG TIN', 'INFORMATION'),
(39, 'Đang hoạt động', 'Online'),
(40, 'Trạng Thái', 'Status'),
(41, 'Giảm', 'Discount'),
(42, 'GIAO DỊCH GẦN ĐÂY', 'RECENT TRANSACTIONS'),
(43, 'Trang Chủ', 'Home'),
(45, 'Số lượng', 'Amount'),
(46, 'Thanh toán', 'Pay'),
(47, 'XEM NGAY', 'VIEW NOW'),
(48, 'TẢI VỀ', 'DOWNLOAD'),
(49, 'CHỌN ĐỊNH DẠNG TẢI VỀ', 'CHOOSE DOWNLOAD FORMAT'),
(50, 'CHI TIẾT ĐƠN HÀNG', 'ORDER DETAILS'),
(51, 'Thời Gian', 'Time'),
(52, 'Loại', 'Type'),
(53, 'Mã Giao Dich', 'Transaction id'),
(54, 'LƯU Ý', 'Note'),
(55, 'Sao chép', 'Copy'),
(56, 'Tải Backup', 'Download Backup'),
(57, 'Dòng tiền', 'Cash flow'),
(58, 'Lịch sử nạp tiền', 'Deposit history'),
(59, 'Chủ tài khoản', 'Recipient\'s name'),
(60, 'Nội dung chuyển tiền', 'Money transfer content'),
(61, 'Số tài khoản', 'Payout account number'),
(62, 'Ngân hàng', 'Bank'),
(63, 'Đăng Xuất', 'Logout'),
(64, 'Thành viên', 'Member'),
(65, 'Đại lý', 'Agency'),
(66, 'Địa chỉ Email', 'Email address'),
(67, 'Số điện thoại', 'Number phone'),
(68, 'Họ và Tên', 'Full name'),
(69, 'Thời gian đăng ký', 'Registration period'),
(70, 'Mật khẩu mới', 'New password'),
(71, 'Nhập lại mật khẩu mới', 'Confirm  new password'),
(72, 'Thông tin được mã hóa khi đưa lên máy chủ của chúng tôi', 'Information is encrypted when posted on our servers'),
(73, 'LƯU THÔNG TIN', 'SAVE INFORMATION'),
(74, 'Đơn giá', 'Unit price'),
(75, 'Số tiền cần thanh toán', 'Amount to be paid'),
(76, 'Đóng', 'Close'),
(77, 'Tên sản phẩm', 'Product\'s name'),
(78, 'Hiện có', 'Available'),
(79, 'Thao tác', 'Control'),
(80, 'Lưu thành công', 'Save successfully'),
(81, 'Đang xử lý giao dịch', 'Processing the transaction'),
(82, 'Loại này đã hết hàng', 'This type is out of stock'),
(83, 'Mua Ngay', 'Buy Now'),
(84, 'Hết hàng', 'Out of stock'),
(85, 'Quốc gia', 'Countries'),
(86, 'Vui lòng đăng nhập để thực hiện giao dịch', 'Please log in to make a transaction'),
(87, 'Dịch vụ không hợp lệ', 'Invalid service'),
(88, 'Dịch vụ này không khả dụng', 'This service is not available'),
(89, 'Số lượng mua không phù hợp', 'Purchase quantity does not match'),
(90, 'Số lượng tối đa 1 lần là', 'The maximum number of times is'),
(91, 'Số lượng trong hệ thống không đủ', 'The quantity in the system is not enough'),
(92, 'Số dư không đủ vui lòng nạp thêm', 'Insufficient balance, please recharge'),
(93, 'Tài khoản của bạn đã bị chấm dứt vì sử dụng BUG', 'Your account has been terminated for using BUG'),
(94, 'Giao dịch thành công!', 'Successful transaction!'),
(95, 'Thất Bại', 'Error'),
(96, 'Thành Công', 'Success'),
(97, 'Cảnh Báo', 'Warning'),
(98, 'DANH SÁCH TÀI KHOẢN', 'LIST OF ACCOUNTS'),
(99, 'Chính sách', 'Policy'),
(100, 'LỊCH SỬ NẠP TIỀN', 'MONEY DEPOSIT HISTORY'),
(101, 'Công Cụ', 'Tool'),
(102, 'NẠP TIỀN', 'RECHARGE'),
(103, 'Số lượng tối thiểu', 'Minimum quantity'),
(104, 'Top Nạp Tiền', 'Deposit Rankings'),
(105, 'BẢNG XẾP HẠNG NẠP TIỀN', 'RANKING OF MONEY'),
(106, 'THÀNH VIÊN', 'MEMBER'),
(107, 'TỔNG TIỀN NẠP', 'TOTAL DEPOSIT'),
(108, 'XẾP HẠNG', 'RANK'),
(109, 'CÔNG CỤ LẤY MÃ 2FA', 'TOOL GET CODE 2FA'),
(110, 'Vui lòng nhập Secret Key', 'Please enter Secret Key'),
(111, 'ĐANG XỬ LÝ', 'PROCESSING'),
(112, 'CHÚNG TÔI CUNG CẤP', 'WE OFFER'),
(113, 'Có những tài khoản Facebook còn khá trẻ nếu bạn cần trong thời gian ngắn, trên trang web của chúng tôi', 'There are Facebook accounts, that are quite young if you need them for a short time, on our website'),
(114, 'TÀI KHOẢN ĐANG BÁN', 'ACCOUNT IS SELLING'),
(115, 'Công ty chúng tôi đã có một thời gian dài trên thị trường tài khoản xã hội số lượng lớn và tài khoản internet công cộng. Chúng tôi đang cung cấp cho khách hàng các tài khoản số lượng lớn an toàn trên tất cả các loại mạng và cổng thông tin công cộng', 'Our company has been for a while on the market of bulk social accounts and public internet recourses. We are offering our customers secure bulk accounts on all kinds of public networks and portals'),
(116, 'Xem thêm', 'Learn more'),
(117, 'Nhà cung cấp tài khoản marketing hàng đầu', 'Top marketing account provider'),
(118, 'Chúng tôi cung cấp những tài khoản mạng xã hội chất lượng nhất', 'We provide top quality social media accounts'),
(119, 'Sản phẩm', 'Product'),
(120, 'Trang chủ', 'Home'),
(121, 'Dịch vụ', 'Services'),
(122, 'Quên mật khẩu', 'Forgot password'),
(123, 'Nhập OTP', 'Enter OTP'),
(124, 'Nhập lại mật khẩu', 'Verify password'),
(125, 'Đổi mật khẩu', 'Change Password'),
(126, 'sản phẩm trong nhóm này', 'products in this group'),
(127, 'Đối tác của chúng tôi', 'Partner'),
(128, 'Điều khoản', 'Rules'),
(129, 'Dịch Vụ', 'Services'),
(130, 'Liên Hệ', 'Contact'),
(131, 'Đăng ký tài khoản', 'Register an account'),
(132, 'Nhập lại mật khẩu', 'Enter the password'),
(133, 'Vui lòng nhập lại mật khẩu', 'Please re-enter your password'),
(134, 'Nhập lại mật khẩu không chính xác', 'Re-enter incorrect password'),
(135, 'Nhập địa chỉ Email', 'Enter your email address'),
(136, 'Vui lòng nhập địa chỉ Email', 'Please enter your email address'),
(137, 'Verify Now', 'Verify Now'),
(138, 'Cập nhật số điện thoại', 'Update phone number'),
(139, 'Nhập số điện thoại liên hệ', 'Enter contact phone number'),
(140, 'ĐÃ BÁN', 'SOLD'),
(141, 'Cộng Tác Viên', 'Referral'),
(142, 'Giới thiệu khách hàng sử dụng dịch vụ của chúng tôi nhận ngay hoa hồng', 'Refer customers to use our services and receive commissions'),
(143, 'Sao chép địa chỉ này và chia sẻ đến bạn bè của bạn.', 'Copy this address and share with your friends.'),
(144, 'ĐIỀU KIỆN', 'CONDITION'),
(145, 'Những tài khoản được hệ thống xác định là tài khoản sao chép của các tài khoản khác sẽ không\r\n    được dùng để tính hoa hồng.', 'Accounts that are identified by the system as duplicate accounts of other accounts will not\r\n    used to calculate the commission.'),
(146, 'Hoa hồng chỉ được tính khi người dùng mua tài nguyên trên web.', 'Commissions are calculated only when the user purchases resources on the web.'),
(147, 'Việc xác định xem ai là người giới thiệu của một người dùng phụ thuộc hoàn toàn vào link giới\r\n    thiệu. Nếu một người dùng nhấp vào nhiều link ref khác nhau thì chỉ có link ref cuối cùng họ\r\n    nhấp vào trước khi tạo tài khoản là có hiệu lực.', 'Determining who a users referrer is depends entirely on the referral link\r\n    introduce. If a user clicks on many different ref links, only the last ref link they have\r\n    click before creating an account to take effect.'),
(148, 'BẠN BÈ ĐƯỢC BẠN GIỚI THIỆU', 'FRIENDS RECOMMENDED BY YOU'),
(149, 'TÊN ĐĂNG NHẬP', 'USERNAME'),
(150, 'THỜI GIAN THAM GIA', 'CREATEDATE'),
(151, 'HOA HỒNG BẠN NHẬN ĐƯỢC', 'PROFITS YOU GET'),
(152, 'Tích Hợp API', 'API Documents'),
(153, 'THAO TÁC', 'ACTION'),
(154, 'SẮP XẾP DẠNG BOX', 'BOX'),
(155, 'SẮP XẾP DẠNG LIST', 'LIST');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `content` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `momo`
--

CREATE TABLE `momo` (
  `id` int(11) NOT NULL,
  `request_id` varchar(64) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `tranId` text CHARACTER SET utf32 COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `partnerId` text CHARACTER SET utf32 COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `partnerName` text CHARACTER SET utf16 COLLATE utf16_vietnamese_ci DEFAULT NULL,
  `amount` text CHARACTER SET utf32 COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `username` varchar(32) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `status` varchar(32) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT 'xuly'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `value` longtext COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `name`, `value`) VALUES
(1, 'tenweb', 'CMSNT.CO'),
(2, 'mota', 'Shop tài khoản tự động chất lượng nhất thị trường'),
(3, 'tukhoa', 'shop clone, clone shop, mua clone, web bán clone giá rẻ, sellclone, clone gia re, clone viet, mua tai khoan, taikhoan fb, shop nick fb, via fb, shop via, via gia re'),
(4, 'logo', 'https://i.imgur.com/ZeJ8zsO.png'),
(5, 'email', ''),
(6, 'pass_email', ''),
(7, 'luuy_naptien', '<ul>\r\n	<li>Hệ thống xử lý 5s 1 thẻ.</li>\r\n	<li>Vui lòng gửi đúng mệnh giá, sai mệnh giá thực nhận mệnh giá bé nhất.</li>\r\n	<li>Ví dụ mệnh giá thực là 100k, quý khách nạp 100k thực nhận 100k.</li>\r\n	<li>Ví dụ mệnh giá thực là 100k quý khách nạp 50k thực nhận 50k.</li>\r\n	<li>Mệnh giá 10k, 20k, 30k tính thêm 3% phí.</li>\r\n</ul>\r\n'),
(10, 'luuy_napbank', 'test'),
(11, 'noidung_naptien', 'CMSNT'),
(12, 'thongbao', '<b> Thông báo cho khách hàng thay đổi trong Admin</b>'),
(13, 'anhbia', 'https://i.imgur.com/EFq5tTX.png'),
(14, 'favicon', 'https://i.imgur.com/61P2d1U.jpg'),
(15, 'ck_daily', '10'),
(16, 'doanhthu_daily', '11'),
(17, 'baotri', 'ON'),
(18, 'chinhsach', '<p><br></p>\r\n'),
(19, 'api_bank', 'nhap token bank'),
(20, 'api_momo', ''),
(21, 'theme', ''),
(22, 'api_card', 'nhap api nap the'),
(23, 'ck_card', '30'),
(24, 'theme_color', '#2b65b1'),
(25, 'theme_home', '0'),
(26, 'stt_giao_dich_gan_day', 'ON'),
(27, 'status_demo', 'OFF'),
(28, 'chinhsach_baohanh', '<h2 class=\"page-title\" style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; font-weight: 700; font-size: 23px; font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">ada</h2>'),
(29, 'sdt_momo', '0947838128'),
(30, 'name_momo', 'NGUYEN TAN THANH'),
(31, 'tk_tsr', ''),
(32, 'mk_tsr', ''),
(33, 'mk2_tsr', ''),
(34, 'luuy_tsr', '<p>Nạp tiền qua thesieure.com cộng tiền ngay.</p><p>Chuyển tiền nhập đúng nội dung chuyển tiền sau đó COPY mã giao dịch tại THESIEURE.COM và nhập vào ô trên.</p>'),
(36, 'fanpage', 'https://www.facebook.com/cmsntthanh/'),
(43, 'stt_giaodichao', 'OFF'),
(44, 'files', ''),
(45, 'btnSaveOption', ''),
(46, 'right_panel', 'ON'),
(47, '', NULL),
(48, 'TypePassword', ''),
(49, 'contact', '<h2 class=\"page-title\" style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; font-weight: 700; font-size: 23px; font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">adada</h2>'),
(51, 'time_delete', '2592000'),
(52, 'script', ''),
(53, 'check_time_cron', ''),
(54, 'mk_bank', ''),
(55, 'stk_bank', ''),
(56, 'type_bank', 'Vietcombank'),
(57, 'check_time_cron_bank', '0'),
(58, 'type_buy', 'LIST'),
(59, 'recharge_min', '1000'),
(60, 'display_list_login', 'ON'),
(61, 'display_sold', 'ON'),
(62, 'status_cron_momo', 'ON'),
(63, 'status_cron_bank', 'ON'),
(64, 'status_ref', 'ON'),
(65, 'ck_ref', '10'),
(66, 'status_top_nap', 'ON'),
(67, 'status_zalopay', 'ON'),
(68, 'token_zalopay', ''),
(69, 'sdt_zalopay', '0947838128'),
(70, 'name_zalopay', 'NGUYEN TAN THANH'),
(71, 'api_domain', 'https://shopclone5.toithietkeweb.com/'),
(72, 'api_username', 'admin'),
(73, 'api_password', 'admin'),
(74, 'api_ck', '20'),
(75, 'api_status', 'ON'),
(76, 'list_domain', ''),
(77, 'momo_note', 'Vui lòng nhập đúng nội dung'),
(78, 'zalopay_note', 'Vui lòng nhập đúng nội dung'),
(79, 'license_key', 'c5e0a710a09f5ab313d74be16b6fa0a8'),
(80, 'license_status', 'Giấy phép hợp lệ'),
(81, 'license_productname', 'SHOPCLONE V5'),
(82, 'license_nextduedate', '2021-09-10'),
(83, 'license_registeredname', 'Nguyễn Tấn Thành'),
(84, 'btnSaveLicense', ''),
(85, 'darkmode', 'light');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `seller` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `dichvu` blob DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `sotien` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `loai` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `id_dichvu` int(11) DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `code`, `username`, `seller`, `dichvu`, `soluong`, `sotien`, `thoigian`, `loai`, `id_dichvu`, `time`, `ip`) VALUES
(271, 'KML71628072423', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-04 17:20:23', 'DANH SÁCH CLONE FACEBOOK', NULL, '1628072423', '::1'),
(272, 'AT601628072501', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-04 17:21:41', 'DANH SÁCH CLONE FACEBOOK', NULL, '1628072501', '::1'),
(273, 'LH1S1628074674', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-04 17:57:54', 'DANH SÁCH CLONE FACEBOOK', NULL, '1628074674', '::1'),
(274, 'OR1L1629380172', '', 'admin', '', 1, 100, '2021-08-19 20:36:12', '', NULL, '1629380172', '::1'),
(275, 'YEVF1629380213', '', 'admin', '', 1, 100, '2021-08-19 20:36:53', '', NULL, '1629380213', '::1'),
(276, '1ORX1629380340', '', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:39:00', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629380340', '::1'),
(277, '45K11629380358', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:39:18', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629380358', '::1'),
(278, '4Y3E1629380618', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:43:38', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629380618', '::1'),
(279, 'R74K1629380976', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:49:36', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629380976', '::1'),
(280, '256S1629380980', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:49:40', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629380980', '::1'),
(281, 'MXTJ1629381001', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:50:01', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629381001', '::1'),
(282, 'G8901629381112', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:51:52', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629381112', '::1'),
(283, 'EQ3Z1629381122', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:52:02', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629381122', '::1'),
(284, 'VW4G1629381181', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:53:01', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629381181', '::1'),
(285, 'UN3Y1629381209', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:53:29', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629381209', '::1'),
(286, '5RGT1629381269', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 3, 300, '2021-08-19 20:54:29', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629381269', '::1'),
(287, 'FKJG1629381376', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-19 20:56:16', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629381376', '::1'),
(288, 'SLD51629381439', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 3, 300, '2021-08-19 20:57:19', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629381439', '::1'),
(289, '24KZ1629381441', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 4, 400, '2021-08-19 20:57:21', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629381441', '::1'),
(290, 'LZHB1629416113', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 4, 400, '2021-08-20 06:35:13', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629416113', '::1'),
(291, '0QOI1629417366', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-20 06:56:06', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417366', '::1'),
(292, '2XLT1629417379', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-20 06:56:19', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417379', '::1'),
(293, '924O1629417388', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-20 06:56:28', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417388', '::1'),
(294, 'QCI91629417461', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 5, 500, '2021-08-20 06:57:41', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417461', '::1'),
(295, 'NH1D1629417467', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-20 06:57:47', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417467', '::1'),
(296, 'SUE21629417482', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-20 06:58:02', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417482', '::1'),
(297, '4IDS1629417524', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-20 06:58:44', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417524', '::1'),
(298, 'BGSZ1629417567', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-20 06:59:27', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417567', '::1'),
(299, 'VCTA1629417829', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 3, 300, '2021-08-20 07:03:49', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417829', '::1'),
(300, 'D8TS1629417861', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-20 07:04:21', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629417861', '::1'),
(301, 'O8MN1629552692', 'admin', 'api_system', 0x436c6f6e6520766572792070686f6e65, 1, 110, '2021-08-21 20:31:32', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629552692', '::1'),
(302, '5TN61629754929', 'admin', 'admin', 0x436c6f6e6520766572792070686f6e65, 1, 100, '2021-08-24 04:42:09', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629754929', '::1'),
(303, 'RGZA1629913931', 'admin', 'admin', 0x436c6f6e6520766572692070686f6e65, 1, 200, '2021-08-26 00:52:11', 'DANH SÁCH CLONE FACEBOOK', NULL, '1629913931', '::1'),
(304, 'Z2FK1630106932', 'admin', 'admin', 0x436c6f6e6520766572692070686f6e65, 5, 1000, '2021-08-28 06:28:52', 'DANH SÁCH CLONE FACEBOOK', NULL, '1630106932', '::1'),
(305, 'BMR51630310744', 'admin', 'admin', 0x474d41494c2052414e444f4d2054c38a4e205449e1babe4e4720414e48202b4156415441522b504f50332b494d41502b4c495645373748, 1, 500, '2021-08-30 15:05:44', 'DANH SÁCH TÀI KHOẢN GMAIL', NULL, '1630310744', '::1'),
(306, '9RE81630310762', 'admin', 'admin', 0x474d41494c2052414e444f4d2054c38a4e205449e1babe4e4720414e48202b4156415441522b504f50332b494d41502b4c495645373748, 1, 500, '2021-08-30 15:06:02', 'DANH SÁCH TÀI KHOẢN GMAIL', NULL, '1630310762', '::1'),
(307, '7EI91630310777', 'admin', 'admin', 0x474d41494c2052414e444f4d2054c38a4e205449e1babe4e4720414e48202b4156415441522b504f50332b494d41502b4c495645373748, 1, 500, '2021-08-30 15:06:17', 'DANH SÁCH TÀI KHOẢN GMAIL', NULL, '1630310777', '::1'),
(308, 'GMX11630600624', 'admin', 'admin', 0x436c6f6e6520766572692070686f6e65, 1, 200, '2021-09-02 23:37:04', 'DANH SÁCH CLONE FACEBOOK', NULL, '1630600624', '::1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `min` int(11) NOT NULL DEFAULT 0,
  `bonus` float NOT NULL DEFAULT 0,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `dichvu` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `taikhoan` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `lydo` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `thoigian` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `trangthai` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ghichu` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `shop` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ruttien`
--

CREATE TABLE `ruttien` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ngan_hang` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `stk` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `chu_tai_khoan` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `sotien` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `trangthai` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ghichu` text COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `ruttien`
--

INSERT INTO `ruttien` (`id`, `username`, `ngan_hang`, `stk`, `chu_tai_khoan`, `sotien`, `thoigian`, `trangthai`, `ghichu`) VALUES
(2, 'admin', 'VIETINBANK', '12124342323', 'sgasdsad', 10000, '2021-01-24 09:21:25', 'thatbai', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `dichvu` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `chitiet` longtext COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `trangthai` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `lydo` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `khieunai` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `thoigianmua` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `dichvu`, `code`, `chitiet`, `trangthai`, `lydo`, `khieunai`, `thoigianmua`) VALUES
(1, '21', 'VCTA1629417829', 'Líst clone test\r', 'LIVE', NULL, NULL, '2021-08-20 07:03:49'),
(2, '21', 'VCTA1629417829', '\r', 'LIVE', NULL, NULL, '2021-08-20 07:03:49'),
(3, '21', NULL, '100057434151752|@Khoi2020|c_user=100057434151752; xs=48:WARoYgC7k2rxew:2:1605534874:-1:-1; fr=1Feh9SYrYxRE2XpdR.AWUWLzhFeW_KdaEFO6i6R4aW8Dg.BfsoSa.0u.AAA.0.0.BfsoSa.AWWsiv_iblk; datr=lISyX2NzXe5q9336s6u7wgAW\r', 'DIE', NULL, NULL, NULL),
(4, '21', 'VCTA1629417829', '100057381564446|@Khoi2020|c_user=100057381564446; xs=34:6he4wVkdysJlKw:2:1605534875:-1:-1; fr=1WlY4NexAcGNrD3oL.AWUnDAZIBR4-_zybedAgxQB231Y.BfsoSb.Sr.AAA.0.0.BfsoSb.AWUp19Oecgc; datr=lISyX01DLbqemZFSOf606oKQ\r', 'LIVE', NULL, NULL, '2021-08-20 07:03:49'),
(5, '21', NULL, '100057879303759|@Khoi2020|c_user=100057879303759; xs=25:Ixg6qyxRjsNGmg:2:1605534903:-1:-1; fr=12uuiKhym25JUKozZ.AWVJExu-YmzpJJPwe0HQf18CZGk.BfsoS2.EU.AAA.0.0.BfsoS2.AWWEtahGUeA; datr=sYSyXwZ-XsgCc0XSfr5aRTbg\r', 'DIE', NULL, NULL, NULL),
(6, '21', NULL, '100057708881136|@Khoi2020|c_user=100057708881136; xs=5:Cz5rakkeKjmcJg:2:1605534885:-1:-1; fr=1nrHzGRuXHT64fXIB.AWUgIlN6VS_kEhjj1QCtMGhUXr4.BfsoSl.d9.AAA.0.0.BfsoSl.AWWLUU3BCyQ; datr=oISyXy2_Nidme_6uWAcLPxVS\r', 'DIE', NULL, NULL, NULL),
(7, '21', NULL, '100057410992806|@Khoi2020|c_user=100057410992806; xs=32:6ZMAr2IPt_hxMQ:2:1605534918:-1:-1; fr=1rManrREbUeFfSnED.AWUP-0dUQH6d_RW7nItVBEEDpUA.BfsoTG.q9.AAA.0.0.BfsoTG.AWX7n_BG2bc; datr=v4SyX9tKns7VwPhk1BHakbLG\r', 'DIE', NULL, NULL, NULL),
(8, '21', NULL, '100057555196825|@Khoi2020|c_user=100057555196825; xs=13:tvopXs_ep4T6Cw:2:1605534921:-1:-1; fr=1wdT3XDzc1JRD2F1t.AWUBBlxRBmRkKIE173YnzVHcXcQ.BfsoTJ.wB.AAA.0.0.BfsoTJ.AWUVeCa7Dpw; datr=woSyX2B7mARzgozM_UKDAbnH\r', 'DIE', NULL, NULL, NULL),
(9, '21', NULL, '100057581385843|@Khoi2020|c_user=100057581385843; xs=26:riIB44ZMqz9nNQ:2:1605534924:-1:-1; fr=1ULvuyOjmiZly9tuw.AWVEN3kYR32rFrA4v1Qf0An2iYs.BfsoTM.EL.AAA.0.0.BfsoTM.AWXs_f3TFQ0; datr=xoSyXyQws-a4Uwv_tt6BQOtb\r', 'DIE', NULL, NULL, NULL),
(10, '21', NULL, '100057712450913|@Khoi2020|c_user=100057712450913; xs=20:OOolkWXT4eZ9qw:2:1605534934:-1:-1; fr=1uyipZLjjBeDpX3tL.AWUsr_9VFs8VjL_kiX3qVr51XI8.BfsoTW.gX.AAA.0.0.BfsoTW.AWVzxiFlRGM; datr=0ISyXwPahR_1HPyQvnf1RC2D\r', 'DIE', NULL, NULL, NULL),
(11, '21', NULL, '100057456140945|@Khoi2020|c_user=100057456140945; xs=48:6jcesktYoHTS9A:2:1605534945:-1:-1; fr=1TaOvsFeghBCVQpMx.AWViYDKqQVccLaL7nxOL0VGU_N8.BfsoTh.oC.AAA.0.0.BfsoTh.AWVh4W8hROc; datr=24SyX8Eg8OFhN61jA4o-uaGK\r', 'DIE', NULL, NULL, NULL),
(12, '21', NULL, '100057843664884|@Khoi2020|c_user=100057843664884; xs=2:QczvsjdPa5NadA:2:1605534950:-1:-1; fr=1X6f1Ca9iSYB9OP4N.AWW2CTE6POUFSj9TNwKa874nkmQ.BfsoTl.y5.AAA.0.0.BfsoTl.AWUxAkeso4g; datr=3oSyXzxJ1SEavHd4yA61g7H1\r', 'DIE', NULL, NULL, NULL),
(13, '21', NULL, '100057608204520|@Khoi2020|c_user=100057608204520; xs=8:4KzxXzWjlUTeMA:2:1605534956:-1:-1; fr=1KIjzFOFN9jlxctjX.AWXy9AYk16Kof3a65cqyDNz1LJ8.BfsoTs.WS.AAA.0.0.BfsoTs.AWVLbOODHw8; datr=5YSyX4hLostYYMcuvNLlaZx7\r', 'DIE', NULL, NULL, NULL),
(14, '21', NULL, '100057913982345|@Khoi2020|c_user=100057913982345; xs=2:lBBNl7Qdog0prw:2:1605534961:-1:-1; fr=1WWKUBMGQfaL0Wl9R.AWWr6zDxCnDi7qADVmMljPlVZh0.BfsoTx.QE.AAA.0.0.BfsoTx.AWUVnIKQ_tM; datr=6oSyXwmKmepTeXzP2I9G_sJS\r', 'DIE', NULL, NULL, NULL),
(15, '21', NULL, '100057931111800|@Khoi2020|c_user=100057931111800; xs=32:yGh7kD_aVGq0dw:2:1605534967:-1:-1; fr=11B31flw2wymNBLpe.AWXjByAV50nUf_UStoZLM9JucIA.BfsoT3.u7.AAA.0.0.BfsoT3.AWUrpm2P8aM; datr=8ISyX3jWTEHWfBSxcxMBsEQB\r', 'DIE', NULL, NULL, NULL),
(16, '21', NULL, '100057813336411|@Khoi2020|c_user=100057813336411; xs=16:Gcz329-zFzFllA:2:1605534972:-1:-1; fr=16kg2u87mqBUlnkUz.AWUzabSiFSwdYKcBbA2xRstIidA.BfsoT7.r0.AAA.0.0.BfsoT7.AWVbal-EbqQ; datr=9ISyX-zBnycX0oas7unAookx\r', 'DIE', NULL, NULL, NULL),
(17, '21', NULL, '100057780608073|@Khoi2020|c_user=100057780608073; xs=19:FLaIheTc2WsT1A:2:1605534987:-1:-1; fr=1vfZC9SBi4QMLL8Ac.AWV9sUqjFNhIWUuv-1liGSJLDmk.BfsoUL.TA.AAA.0.0.BfsoUL.AWVajSRikd8; datr=BYWyXycaf-SOBSSlD1fm3two\r', 'DIE', NULL, NULL, NULL),
(18, '21', NULL, '100057642193507|@Khoi2020|c_user=100057642193507; xs=5:Zxw9QcJDIbYRDA:2:1605534979:-1:-1; fr=12Ds3IQypXthmOfs1.AWUBU7-7FQTUqKfjssFIhqHnQSk.BfsoUC.QM.AAA.0.0.BfsoUC.AWWYfKYEp1A; datr=-4SyX1qCwju3xHYGcCgjYCuB\r', 'DIE', NULL, NULL, NULL),
(19, '21', NULL, '100057763988557|@Khoi2020|c_user=100057763988557; xs=3:5YK-gDpm5NAkiQ:2:1605534993:-1:-1; fr=1VWBN2aKWLPXri1tG.AWXsjF9mkjVQDXDlishc-92iY1I.BfsoUR.Xp.AAA.0.0.BfsoUR.AWULq1fQ-X8; datr=CoWyX9KpDLW03n1oTDSLFVan\r', 'DIE', NULL, NULL, NULL),
(20, '21', NULL, '100057478100287|@Khoi2020|c_user=100057478100287; xs=7:wOaVd70FGaLgIA:2:1605535006:-1:-1; fr=1y6NRKxh6m0YFWjrs.AWWsTNzZJhBCZ1ph4746mniLglA.BfsoUe.qD.AAA.0.0.BfsoUe.AWWD64BnT_Q; datr=F4WyX08pds1Rco5SIX0pPu71\r', 'DIE', NULL, NULL, NULL),
(21, '21', NULL, '100057752049201|@Khoi2020|c_user=100057752049201; xs=12:QPdh0zQ0WCnTVg:2:1605535010:-1:-1; fr=1Z1w4WGbIebWXsDso.AWW4Hwg4Xnakm3YzFxt2167azEY.BfsoUi.iO.AAA.0.0.BfsoUi.AWVIkj4uK3w; datr=G4WyXzheAxCcrZ5rgghCiegS\r', 'DIE', NULL, NULL, NULL),
(22, '21', NULL, '100057679842113|@Khoi2020|c_user=100057679842113; xs=14:HnUmpKj0YQiMLw:2:1605535015:-1:-1; fr=1trm2il0BV8jOzCYf.AWXC37kbBMcfbk5en772aZ29Etw.BfsoUm.Wz.AAA.0.0.BfsoUm.AWXpRehBNBo; datr=H4WyX4GZutyJAn31tL_1OuP6\r', 'DIE', NULL, NULL, NULL),
(23, '21', NULL, '100057501949299|@Khoi2020|c_user=100057501949299; xs=32:8k4ev6Qz0i5cKA:2:1605535017:-1:-1; fr=1J6OoWgZsy3hSV9V4.AWUPX2dPZpyI7Eis3ecrsrEVAuY.BfsoUo.DA.AAA.0.0.BfsoUo.AWVG0ZK1tFs; datr=H4WyX3mMi3Kh_yeJjBkf6F0p\r', 'DIE', NULL, NULL, NULL),
(24, '21', NULL, '100057440151749|@Khoi2020|c_user=100057440151749; xs=3:k1ivswwY140ybQ:2:1605535039:-1:-1; fr=1hKEKJcXi3Xy2DpLd.AWWX6e3S5HknTvKKTnRcz9RhTZE.BfsoU-.-k.AAA.0.0.BfsoU-.AWUJZNkw7hk; datr=N4WyX4t7inTDJ6nLL6TQLx97\r', 'DIE', NULL, NULL, NULL),
(25, '21', NULL, '100057862744446|@Khoi2020|c_user=100057862744446; xs=11:noPIHWdCBGB0Qg:2:1605535051:-1:-1; fr=1Wnhr79N6v42LmVOM.AWUHant0L2NRqdLtOh1kTtrNoYA.BfsoVL.Mh.AAA.0.0.BfsoVL.AWWUMY-ZYxQ; datr=RIWyX-zrI-yw9rCdAnGci1wZ\r', 'DIE', NULL, NULL, NULL),
(26, '21', NULL, '100057843424767|@Khoi2020|c_user=100057843424767; xs=21:vZ6HN_1_LzCzzQ:2:1605535044:-1:-1; fr=1e07d6IZhDTw3pRIW.AWWlWgLgXz0WgfZe6IICf4nMcrY.BfsoVE.nO.AAA.0.0.BfsoVE.AWVKDT3DxOw; datr=PoWyX_0Zvfro6HH9aSapoeVC\r', 'DIE', NULL, NULL, NULL),
(27, '21', NULL, '100057877023922|@Khoi2020|c_user=100057877023922; xs=49:6GtiO_-NjVhEpQ:2:1605535055:-1:-1; fr=1IXIKCc8rnCwyhWtl.AWVbLaKQllteONnHirhX1xcpjm0.BfsoVP.V9.AAA.0.0.BfsoVP.AWWXnZm_KT8; datr=SYWyX1D9Ip8DANvVJhLhIH7F\r', 'DIE', NULL, NULL, NULL),
(28, '21', NULL, '100057512358498|@Khoi2020|c_user=100057512358498; xs=48:UD2N4oxEZARxHg:2:1605535067:-1:-1; fr=1bzlhVjPHFvSqJFEo.AWXa3b4orihAWUCLvgnjg7R-_HQ.BfsoVa.fy.AAA.0.0.BfsoVa.AWUb5h6Mn5k; datr=VYWyXzcvh0tTWl1hNWX_c4fN\r', 'DIE', NULL, NULL, NULL),
(29, '21', NULL, '100057399623439|@Khoi2020|c_user=100057399623439; xs=8:EXUgSsoBBS727w:2:1605535073:-1:-1; fr=1VndMzk8NchiEYg5b.AWVNwvdWrftp1gUI2_rrEJhuEyg.BfsoVh.W4.AAA.0.0.BfsoVh.AWX32trY4Jg; datr=W4WyXw_Lp9b2nOb2Tv0vvEJk\r', 'DIE', NULL, NULL, NULL),
(30, '21', NULL, '100057381864360|@Khoi2020|c_user=100057381864360; xs=32:8PHDagHfHLD4Ag:2:1605535083:-1:-1; fr=1raX4Jok56oiTvJQm.AWUBFeqfw3-Sc4UO5UuMFTCRkU0.BfsoVr.7R.AAA.0.0.BfsoVr.AWVE2hrrenU; datr=Y4WyXyUqSiOSW--R0YFl5iPQ\r', 'DIE', NULL, NULL, NULL),
(31, '21', NULL, '100057683111970|@Khoi2020|c_user=100057683111970; xs=3:it4n4nzRkI4gIw:2:1605535098:-1:-1; fr=18v6AcWOhnMPzkCQx.AWUql_a1IlTk-jRhWgM1hpW6akg.BfsoV6.IN.AAA.0.0.BfsoV6.AWVS9UU70bI; datr=dIWyX7AXZZNzydqtIgRyfdnU\r', 'DIE', NULL, NULL, NULL),
(32, '21', NULL, '100057812376515|@Khoi2020|c_user=100057812376515; xs=35:wDDSB-tKI7fLHw:2:1605535106:-1:-1; fr=1BbML0Y4nVrZkQX5p.AWVM0wn2mqEDx6Dhr4YvUzXygYw.BfsoWC.d2.AAA.0.0.BfsoWC.AWVz-7Y-OPg; datr=e4WyX6-DaUuMFn-dP_VYa1ov\r', 'DIE', NULL, NULL, NULL),
(33, '21', NULL, '100057360984973|@Khoi2020|c_user=100057360984973; xs=36:6uj5oiII-3MRuw:2:1605533688:-1:-1; fr=1sf2APji8Vj0t2CSs.AWUY3jz2iuJy8BILDf9op2SQGgs.Bfsn_4.ff.AAA.0.0.Bfsn_4.AWWD6stf8Ko; datr=8n-yX4v2xphI5vfINj1-nets\r', 'DIE', NULL, NULL, NULL),
(34, '21', NULL, '100057411863129|@Khoi2020|c_user=100057411863129; xs=49:U-vP3y0xu2iEvA:2:1605533699:-1:-1; fr=1FPgQjThEnSjRa7W1.AWXBFcuJ2d-KqKcfY4MF4DZzaFI.BfsoAD.37.AAA.0.0.BfsoAD.AWWvRy8jWFw; datr=_X-yX6jIiR8X6RcC_iEhF0Kv\r', 'DIE', NULL, NULL, NULL),
(35, '21', NULL, '100057684341834|@Khoi2020|c_user=100057684341834; xs=25:ptwjxu-IyVZDjg:2:1605533701:-1:-1; fr=10dLY5l9Z2f4mXsht.AWVIrr2_0vTa4f2Nw-V-mQFXUzU.BfsoAF.HA.AAA.0.0.BfsoAF.AWXlC4u1zoo; datr=_X-yX9uBBD42aeB85Ogm5VTy\r', 'DIE', NULL, NULL, NULL),
(36, '21', NULL, '100057773468423|@Khoi2020|c_user=100057773468423; xs=7:B9mcjS9ODNQY5A:2:1605533707:-1:-1; fr=1Fg6WknYimDVai47v.AWW9pXCpm9OjHfnXcLtvQmPW5nc.BfsoAL.5T.AAA.0.0.BfsoAL.AWUGtcvIJRY; datr=BICyX9YGo_QtilAky-mCHMX1\r', 'DIE', NULL, NULL, NULL),
(37, '21', NULL, '100057469790692|@Khoi2020|c_user=100057469790692; xs=44:GNP6O7_LzOwgSA:2:1605533713:-1:-1; fr=1P3QphOqYBHJvofaC.AWXFoGjPN6aqlfjAbxeTSa-_T8c.BfsoAR.as.AAA.0.0.BfsoAR.AWVhTGKn3Fw; datr=CoCyXwBfvYs87H6B62VPosI1\r', 'DIE', NULL, NULL, NULL),
(38, '21', NULL, '100057871743964|@Khoi2020|c_user=100057871743964; xs=20:rALx0VH2KzdZww:2:1605533759:-1:-1; fr=1Q78i59oXkKziL8uF.AWX3gGd3JmxG3YEVgPUkfSEzQQk.BfsoA_.7x.AAA.0.0.BfsoA_.AWVKa1ea7e8; datr=OYCyXxUyGh6FNIsttj9wAulc\r', 'DIE', NULL, NULL, NULL),
(39, '21', NULL, '100057823415782|@Khoi2020|c_user=100057823415782; xs=2:0eQcDCbCCZutQQ:2:1605533788:-1:-1; fr=1RwlG9yI8sBz6KXQd.AWU3ByV6zcUgnW08DiBYtKNB1yQ.BfsoBc.1k.AAA.0.0.BfsoBc.AWWoulKzKHs; datr=VoCyX9eyTBhBqKIAqxlB10yb\r', 'DIE', NULL, NULL, NULL),
(40, '21', NULL, '100057669432535|@Khoi2020|c_user=100057669432535; xs=32:thOsMAiT6Zd29w:2:1605533733:-1:-1; fr=14fLRjIMKw7xphEp5.AWUc63tr8GEQ7fR7YKEeodUo3Zc.BfsoAl.Ks.AAA.0.0.BfsoAl.AWVjneYmVTI; datr=H4CyX7D4cvcbKlQFi1jqLVLc\r', 'DIE', NULL, NULL, NULL),
(41, '21', NULL, '100057399023634|@Khoi2020|c_user=100057399023634; xs=2:_0o9I5Myzx5gPg:2:1605533769:-1:-1; fr=1boN4AASSp6TBSMsT.AWVCw65t8gw1VKHdEEqos8AO6io.BfsoBJ.2f.AAA.0.0.BfsoBJ.AWXFg8ELG08; datr=QoCyX3DT10G1kb2XxnluhF1H\r', 'DIE', NULL, NULL, NULL),
(42, '21', NULL, '100057820146015|@Khoi2020|c_user=100057820146015; xs=12:eJYAb5Vixcs9-Q:2:1605533810:-1:-1; fr=1W2mmzuIHo9Wdr7gL.AWX9Mn6dppH0fpPhmi1XFHVmhdc.BfsoBx.h9.AAA.0.0.BfsoBx.AWV1zY8DqYY; datr=aoCyXzqTyckqK9ju9j8dLAIQ\r', 'DIE', NULL, NULL, NULL),
(43, '21', NULL, '100057964020315|@Khoi2020|c_user=100057964020315; xs=10:ensIWqHbZIcwAg:2:1605533782:-1:-1; fr=1aAWYR1UuEhxRYx5D.AWUZN2OM29Qrm2T816eMpOs3SAo.BfsoBW.0x.AAA.0.0.BfsoBW.AWWVrFAHgvg; datr=UICyXysctiZMAhUbXsOflTKv\r', 'DIE', NULL, NULL, NULL),
(44, '21', NULL, '100057602174325|@Khoi2020|c_user=100057602174325; xs=7:Ra3Br_GCAq76MQ:2:1605533800:-1:-1; fr=1PrdRB19MbnACGxCx.AWVey3IgHx0iFfZtWzCEicOasWg.BfsoBo.rk.AAA.0.0.BfsoBo.AWWGRSNjGuU; datr=YYCyX9BJN9rB55qxPHw_ML00\r', 'DIE', NULL, NULL, NULL),
(45, '21', NULL, '100057495169238|@Khoi2020|c_user=100057495169238; xs=20:hsd1wzv1CNT4Bg:2:1605533788:-1:-1; fr=15IVCqVRR9enJA1n4.AWWyyIfMbKQmzPQF7Vfp9wbPh0U.BfsoBc.bj.AAA.0.0.BfsoBc.AWX50C_ICGI; datr=VoCyXwW23Cha_WYEwLsU7c4p\r', 'DIE', NULL, NULL, NULL),
(46, '21', NULL, '100057731080258|@Khoi2020|c_user=100057731080258; xs=16:EExMG8c_CjGcGQ:2:1605533793:-1:-1; fr=1xfZheUYIAOyX3FFJ.AWXj1D-4M-EFiKw2GdDJNUhsUHw.BfsoBh.da.AAA.0.0.BfsoBh.AWU4RfhgWB8; datr=WoCyX-GmGZ1xTCQk1NlY4L25\r', 'DIE', NULL, NULL, NULL),
(47, '21', NULL, '100057758558814|@Khoi2020|c_user=100057758558814; xs=46:CrDfSLGIvUYfVQ:2:1605533714:-1:-1; fr=1VoiJNG7DTgubNIO9.AWVnY04U9eyWbdCEF4wyphG22jI.BfsoAR.TK.AAA.0.0.BfsoAR.AWXQm5zkrxc; datr=CoCyX99CYnrJ-taygF1FpIH7\r', 'DIE', NULL, NULL, NULL),
(48, '21', NULL, '100057343045769|@Khoi2020|c_user=100057343045769; xs=20:FUwEdvXNwTDVMg:2:1605533785:-1:-1; fr=1yb7TxZkXYeeE6p4O.AWW45D8i6QpMxpERm7gu1NQtjOM.BfsoBZ.1t.AAA.0.0.BfsoBZ.AWXoJfNlknM; datr=U4CyXwrn5Rbt9uAQIus8siQn\r', 'DIE', NULL, NULL, NULL),
(49, '21', NULL, '100057830645045|@Khoi2020|c_user=100057830645045; xs=38:sz0FH1potSyGUA:2:1605533826:-1:-1; fr=1VYtsltCoAldIfrrL.AWUqqxQVOlGo9QWg3GKGuvhL3fI.BfsoCC.Ef.AAA.0.0.BfsoCC.AWVzqlpCvMo; datr=fYCyX0rH0kzWegVE-2Vi0P6B\r', 'DIE', NULL, NULL, NULL),
(50, '21', NULL, '100057660222676|@Khoi2020|c_user=100057660222676; xs=46:yCukRlWHHrH7gw:2:1605533824:-1:-1; fr=1Y1BgjH8wUTlRoOIW.AWU23ZGVSz9ZjdbtgXCyJrGvlr8.BfsoCA.iI.AAA.0.0.BfsoCA.AWU-9YQBGKk; datr=eoCyX469uS2IDyVv-FQhk09A\r', 'DIE', NULL, NULL, NULL),
(51, '21', NULL, '100057842104890|@Khoi2020|c_user=100057842104890; xs=42:XktMzkACUbxMbg:2:1605533837:-1:-1; fr=1xwJCMjKemgXlMBfA.AWWpAzXYaEA4y8bzbtsz4TMIiqo.BfsoCN.Lj.AAA.0.0.BfsoCN.AWWo9Izox80; datr=h4CyX5W0oHfkIW-sKfZx5_bL\r', 'DIE', NULL, NULL, NULL),
(52, '21', 'D8TS1629417861', '100057821045983|@Khoi2020|c_user=100057821045983; xs=33:lDe8oEsO0mNZdw:2:1605533837:-1:-1; fr=1IEd2imTg4HcSLuHi.AWUnqsmFkVxrq4E2-V5WzMIULSg.BfsoCN.Ml.AAA.0.0.BfsoCN.AWUYILalGXE; datr=hoCyX2pM-zBCa5HT2c9VTCsU\r', 'LIVE', NULL, NULL, '2021-08-20 07:04:21'),
(53, '21', NULL, '100057782437754|@Khoi2020|c_user=100057782437754; xs=49:M4o1168XKp-rOg:2:1605533841:-1:-1; fr=1MWwae6atuwszO3CI.AWUSi8ePtsO71HGtpdwXtEor_2o.BfsoCR.mo.AAA.0.0.BfsoCR.AWXDW3NRjYA; datr=ioCyX8mt015HBVHQtUIrjZ_H\r', 'DIE', NULL, NULL, NULL),
(54, '21', NULL, '100057440181865|@Khoi2020|c_user=100057440181865; xs=33:QdWf4JWTe0we7Q:2:1605533846:-1:-1; fr=1D6zaDVXmy1fgxIFZ.AWWJlPwU8iRazWketwol4XXUxak.BfsoCW.fk.AAA.0.0.BfsoCW.AWUQtzY7ICE; datr=kICyX_9STmwJiNSCZWZzcUhx\r', 'DIE', NULL, NULL, NULL),
(55, '21', NULL, '100057778808273|@Khoi2020|c_user=100057778808273; xs=42:KCm2oNEYM_IW1g:2:1605533850:-1:-1; fr=1deXsLEzLkzAcVV6Q.AWWFc_slebkUGE5gTjCfcj8qiDo.BfsoCZ.28.AAA.0.0.BfsoCZ.AWVJbQTdI_g; datr=k4CyX9QH5aX7fLJKQiUWTW5X\r', 'DIE', NULL, NULL, NULL),
(56, '21', NULL, '100057886173484|@Khoi2020|c_user=100057886173484; xs=14:U-bIrpmkE6GHtA:2:1605533856:-1:-1; fr=1pOccJM8dT8VSgBVk.AWX86ebqeUS4Tm_s9QMPebEgGRU.BfsoCf.tJ.AAA.0.0.BfsoCf.AWUkFL45wEk; datr=mICyX_9YKB4glfNvOfF5AzBL\r', 'DIE', NULL, NULL, NULL),
(57, '21', NULL, '100057892083038|@Khoi2020|c_user=100057892083038; xs=41:sGoJj29STIgGFQ:2:1605533853:-1:-1; fr=10y8AjIuEODAfGimX.AWUGmpB05tI9NJ4WKz3HzqAGrGc.BfsoCd.bF.AAA.0.0.BfsoCd.AWWILblAxmI; datr=l4CyXzglEbtwFw6ePs2DPf1N\r', 'DIE', NULL, NULL, NULL),
(58, '21', NULL, '100057833974905|@Khoi2020|c_user=100057833974905; xs=14:HWfn_AUIeWOqWw:2:1605533865:-1:-1; fr=1tJ9YcffeluwYrdtZ.AWXTjg2RM95IqFlJPKsQdCw1nDY.BfsoCp.GB.AAA.0.0.BfsoCp.AWUmEUa0TCw; datr=pICyX1FMm8obvdgQcfHVcWGj\r', 'DIE', NULL, NULL, NULL),
(59, '21', NULL, '100057361315117|@Khoi2020|c_user=100057361315117; xs=48:qDgVHj3l-MG82w:2:1605533918:-1:-1; fr=1PvMr3qxuPcAGRCXW.AWUsMXHVGn297ErAYEOo7R4GK3o.BfsoDe.B_.AAA.0.0.BfsoDe.AWX5IILV5p0; datr=2ICyX8FU-xhiopgRnRksGmj7\r', 'DIE', NULL, NULL, NULL),
(60, '21', NULL, '100057441801501|@Khoi2020|c_user=100057441801501; xs=11:p5NFKfD6MZxbMA:2:1605533915:-1:-1; fr=1AWvgRj9zxQAtF0EH.AWUV4iw16CSFhlK5aZ4wUUNa-F8.BfsoDb.eL.AAA.0.0.BfsoDb.AWWuiUGHhaI; datr=1YCyXxQPUUK6RmEv9ia-0gvR\r', 'DIE', NULL, NULL, NULL),
(61, '21', NULL, '100057596925135|@Khoi2020|c_user=100057596925135; xs=34:mWknSmjoqzCgbA:2:1605533922:-1:-1; fr=13epzWPKSzDocw88I.AWUlhnBiZP4QU5JpEIHOVchvSyQ.BfsoDi.iE.AAA.0.0.BfsoDi.AWV_f-qt0Lo; datr=2YCyX7IQumHOlQPDkyoW_GJg\r', 'DIE', NULL, NULL, NULL),
(62, '21', NULL, '100057378294505|@Khoi2020|c_user=100057378294505; xs=41:SNHYsgMCu4ncGQ:2:1605533928:-1:-1; fr=1fyTnh9vWPpJ70QgX.AWV3MEJjgYHJaLSUmKVaMUeSitk.BfsoDo.G2.AAA.0.0.BfsoDo.AWXRLJ--bjE; datr=4YCyX_JUxSTWOkQysZ71-g-9\r', 'DIE', NULL, NULL, NULL),
(63, '21', NULL, '100057349375848|@Khoi2020|c_user=100057349375848; xs=5:M-xrJyZkMWPThA:2:1605533937:-1:-1; fr=1kIiltxQ3P8Z4D0Gx.AWWgJm0G2Q8ed74FcfV02C3aZ70.BfsoDw.Qs.AAA.0.0.BfsoDw.AWX6WcXEV3U; datr=6oCyX2wf0TA0hs9eAMVUKxf7\r', 'DIE', NULL, NULL, NULL),
(64, '21', NULL, '100057459950608|@Khoi2020|c_user=100057459950608; xs=25:Hw38kCpn6FGFpQ:2:1605533939:-1:-1; fr=1OlL3epcn0uhsVkDA.AWUMJvrBzBocdz5HtPyKJj_K1OQ.BfsoDz.Zz.AAA.0.0.BfsoDz.AWWnkMfIrN4; datr=7oCyX8_MmhVXDj0KVYn1U4ZP\r', 'DIE', NULL, NULL, NULL),
(65, '21', NULL, '100057653893043|@Khoi2020|c_user=100057653893043; xs=11:yMDEC_021usB2Q:2:1605533933:-1:-1; fr=1LhRIoYLkTkWjQknv.AWW3XlgAcE8eH0WkMwq8tXvAYZU.BfsoDt.DY.AAA.0.0.BfsoDt.AWVaKCKiZps; datr=5oCyXwVIfwslL_ya5F5NDIdR\r', 'DIE', NULL, NULL, NULL),
(66, '21', NULL, '100057535727682|@Khoi2020|c_user=100057535727682; xs=27:9rS7gGhOj2xJkA:2:1605533937:-1:-1; fr=1ypYyw32FhFIYypkZ.AWXydFXqm0zr2UeMrHnPWYDAxlk.BfsoDx.eN.AAA.0.0.BfsoDx.AWWWXv_5ymU; datr=64CyX_6JEhOv1j8LMJP6Gco_\r', 'DIE', NULL, NULL, NULL),
(67, '21', NULL, '100057910622467|@Khoi2020|c_user=100057910622467; xs=2:VRAhfgLv3C_VQQ:2:1605533958:-1:-1; fr=14Gf0DLc0yNpGclKa.AWXA2pL1UZXe7R2K7NGe4GtSTs0.BfsoEG.4U.AAA.0.0.BfsoEG.AWWFgP39Oo8; datr=_oCyX8ehWQup19FF0GkWm4CN\r', 'DIE', NULL, NULL, NULL),
(68, '21', NULL, '100057539747596|@Khoi2020|c_user=100057539747596; xs=45:yJePoq0F_YHKMw:2:1605533956:-1:-1; fr=1NR8M4LcYuuBjFASi.AWX-rHM6Gq4wxD2cq-d-cm4hNKw.BfsoEE.wa.AAA.0.0.BfsoEE.AWUU_8fpSpo; datr=_YCyX5wKMWrXGv2v6DjzbCkp\r', 'DIE', NULL, NULL, NULL),
(69, '21', NULL, '100057524478080|@Khoi2020|c_user=100057524478080; xs=37:M_ZnNkIgToLeZA:2:1605533963:-1:-1; fr=113EN3RS7XfMP6TEP.AWXVoKBjWh8Wp5oGXmXCHweolek.BfsoEL.fv.AAA.0.0.BfsoEL.AWWTRht4DSs; datr=BIGyX9QUquTjIKipi-khjeIX\r', 'DIE', NULL, NULL, NULL),
(70, '21', NULL, '100057621014241|@Khoi2020|c_user=100057621014241; xs=22:MTtexhP7Yad2Dw:2:1605533968:-1:-1; fr=1EgVIHZt39IVBUqGQ.AWWECeC2eeRNiHz4reUZnu8GhYY.BfsoEQ._K.AAA.0.0.BfsoEQ.AWXzkJ0h5_A; datr=CoGyX0LXc77Sn_TFYTkqKTor\r', 'DIE', NULL, NULL, NULL),
(71, '21', NULL, '100057800857009|@Khoi2020|c_user=100057800857009; xs=10:AJ7m6b1ZKlEKOQ:2:1605533976:-1:-1; fr=1mUuK8Vfh4MFg2l66.AWVzwIijH7ndr-qXnEe1OXGdJV0.BfsoEY.zh.AAA.0.0.BfsoEY.AWV6AF1SEgo; datr=EYGyX5hbAk3BDC8B0amgmYKl\r', 'DIE', NULL, NULL, NULL),
(72, '21', NULL, '100057749379002|@Khoi2020|c_user=100057749379002; xs=43:V8X2HApcWwJ_qQ:2:1605533993:-1:-1; fr=1m6ZXjXkec7cl7jC8.AWWTRghrv9Ght2TwFeN-UlRvWOs.BfsoEp.Xb.AAA.0.0.BfsoEp.AWUfNe6K2oY; datr=I4GyX1Odhlyr2xIzGdptxVTV\r', 'DIE', NULL, NULL, NULL),
(73, '21', NULL, '100057817236233|@Khoi2020|c_user=100057817236233; xs=39:l6jAgoa5mDvAFg:2:1605533993:-1:-1; fr=1OjqZLqOI18MY7Itj.AWV-06gkt7i7dk8wOC8wMk3GWmw.BfsoEp.mH.AAA.0.0.BfsoEp.AWUsemgoK0Q; datr=I4GyX1qbQcb5eFz7aiulXHnE\r', 'DIE', NULL, NULL, NULL),
(74, '21', NULL, '100057657522958|@Khoi2020|c_user=100057657522958; xs=6:yGshJ1LKD3k3ag:2:1605533992:-1:-1; fr=1JZ8rVegIv5h8EiMV.AWX7-YmCKamUNE4U7O3HF8DAJvw.BfsoEo.57.AAA.0.0.BfsoEo.AWV1XB5tOR0; datr=IYGyXybgB-bR-aQNDRFeJA18\r', 'DIE', NULL, NULL, NULL),
(75, '21', NULL, '100057364554683|@Khoi2020|c_user=100057364554683; xs=15:A_CpQu0uetDNXQ:2:1605533998:-1:-1; fr=1hCgDwd2oZva2pQxY.AWUUJaSz_GoEWCfefmj8BBDrcwI.BfsoEt.He.AAA.0.0.BfsoEt.AWXPE753UN0; datr=J4GyXy4qy5kze_evxFIrOkdS\r', 'DIE', NULL, NULL, NULL),
(76, '21', NULL, '100057602324613|@Khoi2020|c_user=100057602324613; xs=10:S5qmZnqsHviZ8g:2:1605534056:-1:-1; fr=1oooGXa6bLg699jYV.AWXG4GIOV-MGzMN4Anbcli1oclA.BfsoFo.7i.AAA.0.0.BfsoFo.AWUZr96pY8g; datr=YYGyX-vk3p7zwpZWuuyIn23Q\r', 'DIE', NULL, NULL, NULL),
(77, '21', NULL, '100057689711653|@Khoi2020|c_user=100057689711653; xs=46:4Zhm8jCpKfhHVg:2:1605534061:-1:-1; fr=1pal8TazEAK6FyFmJ.AWWi3q-_9jDXLHyBBRUEH6R7EjM.BfsoFt.qW.AAA.0.0.BfsoFt.AWWSmjRhAUk; datr=Z4GyX6T5oUtoQfqTMfSh01CP\r', 'DIE', NULL, NULL, NULL),
(78, '21', NULL, '100057338516413|@Khoi2020|c_user=100057338516413; xs=27:77cW2EtvlpVxWg:2:1605534065:-1:-1; fr=1OLDV81UxtRM4V3oR.AWVAonjdpzR_HXz3YR26YXoBr18.BfsoFx.ys.AAA.0.0.BfsoFx.AWXpFKQ3C6k; datr=a4GyX_vaeEnH1TSX_0V8K8xK\r', 'DIE', NULL, NULL, NULL),
(79, '21', NULL, '100057957690613|@Khoi2020|c_user=100057957690613; xs=42:u3U1diMd_4E0dA:2:1605534068:-1:-1; fr=1yRh7qljiC7wvOCHy.AWWcpzIjhsbqS0sHgN826zkpNJg.BfsoF0.gS.AAA.0.0.BfsoF0.AWUhCZzPujI; datr=boGyX_XEez_Lr6R9rqJmhNv1\r', 'DIE', NULL, NULL, NULL),
(80, '21', NULL, '100057550007067|@Khoi2020|c_user=100057550007067; xs=23:pysYyq2z-i8_PA:2:1605534069:-1:-1; fr=1janOqawYGtSD0ODE.AWUdVL9QbekTT7iw_TtDxs_SJrc.BfsoF1.Y3.AAA.0.0.BfsoF1.AWUS8XHhf-8; datr=b4GyXzx6Rc0QdKcU7_Rjv-Pg\r', 'DIE', NULL, NULL, NULL),
(81, '21', NULL, '100057497059722|@Khoi2020|c_user=100057497059722; xs=5:AVXHxd-Yy4icEQ:2:1605534076:-1:-1; fr=1gfs1pq2DL6ApEhqx.AWVjFjPS9dU8Nyjd06Yo6Dj28qw.BfsoF8.dn.AAA.0.0.BfsoF8.AWW_ORdQbVc; datr=doGyX-JlJ9O5oiyMEC7I13uv\r', 'DIE', NULL, NULL, NULL),
(82, '21', NULL, '100057837844904|@Khoi2020|c_user=100057837844904; xs=20:EGZ4ctmr9XWYXg:2:1605534084:-1:-1; fr=1jBp9RZNGkrUtGjmp.AWVx_JMKyMjFtoFQWM9YCTmcZyo.BfsoGE.Dn.AAA.0.0.BfsoGE.AWVth1lyEM4; datr=foGyX7EY__464zLHFse8tBmN\r', 'DIE', NULL, NULL, NULL),
(83, '21', NULL, '100057351295615|@Khoi2020|c_user=100057351295615; xs=21:LUBmXRw7GFRGEQ:2:1605534088:-1:-1; fr=1qH3jrCIPJg6PFmb2.AWV3ep3kekRJ1uQA71mVdTrRy8k.BfsoGH.ZX.AAA.0.0.BfsoGH.AWUC-_i0uNo; datr=foGyX3WNMdyigu3xgGixC2eY\r', 'DIE', NULL, NULL, NULL),
(84, '21', NULL, '100057648973197|@Khoi2020|c_user=100057648973197; xs=25:TL6ucmADap6oUw:2:1605534092:-1:-1; fr=1YeFNH19gNeJOBcGG.AWVaFHjLO8vqxR5L_O8pt1Ity6c.BfsoGM._n.AAA.0.0.BfsoGM.AWUP0Lq_XsM; datr=hIGyX2SF17dPMltq6zI8GsNw\r', 'DIE', NULL, NULL, NULL),
(85, '21', NULL, '100057774968351|@Khoi2020|c_user=100057774968351; xs=40:3DYYVVMI-A-tmA:2:1605534093:-1:-1; fr=1mFnHq5AiYHcDNa1Q.AWWtzelI1FXQgGV3GsPJrSEL25M.BfsoGN.Bz.AAA.0.0.BfsoGN.AWWwI8eNf2k; datr=h4GyX7tl9EkZ5d3oomnbqdpr\r', 'DIE', NULL, NULL, NULL),
(86, '21', NULL, '100057569176479|@Khoi2020|c_user=100057569176479; xs=15:M782eI-5DR1lHA:2:1605534101:-1:-1; fr=1OCph7dpg3IF96QCx.AWUuC13_jqkbZKi6X8tlgXR_pic.BfsoGV.6U.AAA.0.0.BfsoGV.AWWLhpYrFnc; datr=j4GyX_MjfajQIUHACmOT_2c7\r', 'DIE', NULL, NULL, NULL),
(87, '21', NULL, '100057943681242|@Khoi2020|c_user=100057943681242; xs=43:FFyE5qJBhFBFTA:2:1605534115:-1:-1; fr=1nmY8jCu2mjPLxsTE.AWWfBvcGrOg6AN69A1aIQmFTGAQ.BfsoGi.zQ.AAA.0.0.BfsoGi.AWW6UnvkFwg; datr=nYGyX86u8b7IlQGbu1E6yUEu\r', 'DIE', NULL, NULL, NULL),
(88, '21', NULL, '100057700001462|@Khoi2020|c_user=100057700001462; xs=42:YgfTKGKGPsMmQA:2:1605534116:-1:-1; fr=1ZVGedhQjFHswB0tQ.AWWS6bz7H22ShdkSYZxHUSZ3nls.BfsoGk.L_.AAA.0.0.BfsoGk.AWUgilIrBgU; datr=nYGyX5CaFuYc83zOwPpJ6BHo\r', 'DIE', NULL, NULL, NULL),
(89, '21', NULL, '100057852454591|@Khoi2020|c_user=100057852454591; xs=31:xup0Y3Y8S2vVlQ:2:1605534138:-1:-1; fr=1gw4iD989Te05XtqZ.AWUqxLnTVvCuY50bRpm96bN5n5w.BfsoG6.wQ.AAA.0.0.BfsoG6.AWVjJe8sKH0; datr=s4GyX6wRSTGPI7Z6yI6x8CNb\r', 'DIE', NULL, NULL, NULL),
(90, '21', NULL, '100057787087656|@Khoi2020|c_user=100057787087656; xs=17:t48urs3gK57PHg:2:1605534139:-1:-1; fr=1enJCZn00fNjhQjlS.AWV4tLWIk9O_FSxTtsATyR15ngM.BfsoG7.go.AAA.0.0.BfsoG7.AWULkJdBWB4; datr=s4GyX3R_fJplkxengfO0M_6i\r', 'DIE', NULL, NULL, NULL),
(91, '21', NULL, '100057451251362|@Khoi2020|c_user=100057451251362; xs=31:9GDLM8982Wu5dg:2:1605535769:-1:-1; fr=1hotXm4RgaK1ukZW6.AWXboyLNMrmT9gTz1ouioNpCbRo.BfsogY.E2.AAA.0.0.BfsogY.AWXMGYU3yZY; datr=EoiyX0lm1-_BmH8VF0RTYbdI\r', 'DIE', NULL, NULL, NULL),
(92, '21', NULL, '100057738969631|@Khoi2020|c_user=100057738969631; xs=19:u7QZV78ZzKAjeA:2:1605535783:-1:-1; fr=1SccwFSFsw1GOkyNm.AWXiY00PNKvatOdiVEaexpTXB40.Bfsogn.Nn.AAA.0.0.Bfsogn.AWW83x7mRyA; datr=IYiyX_FKkNl_BbvFsFnSggc7\r', 'DIE', NULL, NULL, NULL),
(93, '21', NULL, '100057789427582|@Khoi2020|c_user=100057789427582; xs=36:s1jH_7JDJN3EeQ:2:1605535799:-1:-1; fr=18ALXWRzG4KVIRjKm.AWWHQZ3gDAvyjL3IkxcEQ_Vv7oA.Bfsog3.vg.AAA.0.0.Bfsog3.AWUHnyx0Npo; datr=MIiyX_4jIgm1aAK4DxKFEfkP\r', 'DIE', NULL, NULL, NULL),
(94, '21', NULL, '100057683562015|@Khoi2020|c_user=100057683562015; xs=36:LpwVlNXsA8nrPw:2:1605535809:-1:-1; fr=11Yk1tUaaedeveVxV.AWVQ0okY3C6_1uSCr9Ap0asb0D4.BfsohB.qs.AAA.0.0.BfsohB.AWX20Atu7xw; datr=OoiyXz1G2oduvItiGoASJfTl\r', 'DIE', NULL, NULL, NULL),
(95, '21', NULL, '100057729940139|@Khoi2020|c_user=100057729940139; xs=23:Ypfy0SpHiNp2hA:2:1605535822:-1:-1; fr=1RseTKHmPJgETH9Ni.AWXBvlXS3bDhdI_XwNaGwdEJXDc.BfsohO.AB.AAA.0.0.BfsohO.AWVdBVWfqv0; datr=RoiyX1mwZgTfmsGNfRxtpoIw\r', 'DIE', NULL, NULL, NULL),
(96, '21', NULL, '100057518808266|@Khoi2020|c_user=100057518808266; xs=47:KqpQvzBx-G8ByA:2:1605535825:-1:-1; fr=19QSdEnqHP9GwuqnV.AWWbCV8wVUnPkuRsCqoDeEI4-fU.BfsohR.Vm.AAA.0.0.BfsohR.AWVs0Xtr9aI; datr=SYiyX4cXKwECHicqIBBYPl-9\r', 'DIE', NULL, NULL, NULL),
(97, '21', NULL, '100057820596177|@Khoi2020|c_user=100057820596177; xs=46:jmoKwSzaxEuGfg:2:1605535863:-1:-1; fr=1HmYfbrWGoOZY5g1l.AWWmrqfDf7BYyjE7OK8uPy4XWLE.Bfsoh3.I3.AAA.0.0.Bfsoh3.AWXtUKgmK8Y; datr=b4iyXybrY_C6ss3MoCQLSZCi\r', 'DIE', NULL, NULL, NULL),
(98, '21', NULL, '100057649363083|@Khoi2020|c_user=100057649363083; xs=40:tka2SeiDY6tJiA:2:1605535910:-1:-1; fr=1tMavl1Uxq44MLxna.AWWJxxZLZq_ZrWgL4-cMlsXSgQk.Bfsoil.dI.AAA.0.0.Bfsoil.AWX8AOIo_2s; datr=noiyX0LtHPp9caDqQeWgJOvY\r', 'DIE', NULL, NULL, NULL),
(99, '21', NULL, '100057335816424|@Khoi2020|c_user=100057335816424; xs=14:vpevt1jXB8Q14A:2:1605535927:-1:-1; fr=1d9Y8SV8KSJmJ5Kbv.AWUeo7tsgwR6tz3WaplHDdGV_DU.Bfsoi3.6B.AAA.0.0.Bfsoi3.AWU52YtEiJU; datr=sYiyX1Ub0QYb9LRG3lhawyzg\r', 'DIE', NULL, NULL, NULL),
(100, '21', NULL, '100057680292340|@Khoi2020|c_user=100057680292340; xs=6:fwSCY2bqu3ZSig:2:1605535950:-1:-1; fr=1wIKgLzDCLJYqCe5E.AWU1dDV9gXDh3CoxJixGEDEo1f8.BfsojO.aS.AAA.0.0.BfsojO.AWUZZH4P8fw; datr=xoiyX8jhASShk8PhwnnCsyzC\r', 'DIE', NULL, NULL, NULL),
(101, '21', NULL, '100057556006948|@Khoi2020|c_user=100057556006948; xs=9:zoG_CIkIxvPyRQ:2:1605535957:-1:-1; fr=1xB5mR17vbgH9XQMj.AWUaqfoQ7rPWa39TaKxMHo5ziUY.BfsojV.o-.AAA.0.0.BfsojV.AWWUVd084Sc; datr=zIiyX9KT3Ql0760eOHenjvEJ\r', 'DIE', NULL, NULL, NULL),
(102, '21', NULL, '100057624104208|@Khoi2020|c_user=100057624104208; xs=31:_Eu6QJMQyK3Zuw:2:1605535972:-1:-1; fr=1VzHIoOYU5vj49UgK.AWV8vbB130-fcWWUBy30HP5R4lk.Bfsojk.51.AAA.0.0.Bfsojk.AWXi7AKtyCc; datr=3YiyX86ViDiIb9wf1UwyIHRM\r', 'DIE', NULL, NULL, NULL),
(103, '21', NULL, '100057536807699|@Khoi2020|c_user=100057536807699; xs=21:GpL8P36H0_3E-g:2:1605535981:-1:-1; fr=1NArE5e6VoM5NO7h6.AWXm2oCw2O6GNIxzO53woyRQOKk.Bfsojt.bJ.AAA.0.0.Bfsojt.AWUOFXsXvsc; datr=54iyX8IaDCZuuKUMJdpg3CfU\r', 'DIE', NULL, NULL, NULL),
(104, '21', NULL, '100057634303648|@Khoi2020|c_user=100057634303648; xs=9:mIKCPBziZUieQw:2:1605536000:-1:-1; fr=1EhAE1cf0RYHFk5NH.AWWWq2zLa13TvrLl_wgZwGjhXbU.BfsokA.2Q.AAA.0.0.BfsokA.AWXRZiRVpxI; datr=-oiyX1Kouj2AT3Pvgx7hiane\r', 'DIE', NULL, NULL, NULL),
(105, '21', NULL, '100057594945549|@Khoi2020|c_user=100057594945549; xs=40:S-eymgxzqleNEQ:2:1605536016:-1:-1; fr=13bfcKt4yYFw73AXa.AWVMvyZIAHfAPZ0u9BeBh0bJLys.BfsokQ.OY.AAA.0.0.BfsokQ.AWU0SskAZq8; datr=ComyX9Bom4DtRKVJu1w8H6Hg\r', 'DIE', NULL, NULL, NULL),
(106, '21', NULL, '100057643333420|@Khoi2020|c_user=100057643333420; xs=42:1fv3aQsSCTQsng:2:1605536027:-1:-1; fr=1YNoNH4jKaQlrGWwo.AWUDh47khT6ufD6UQA4QFtLArj8.Bfsoka.qM.AAA.0.0.Bfsoka.AWU_go-gFBw; datr=E4myX6TlsMFSJpPAwJUaE3ZQ\r', 'DIE', NULL, NULL, NULL),
(107, '21', NULL, '100057924932069|@Khoi2020|c_user=100057924932069; xs=16:jKhDQwwxfkufwg:2:1605536052:-1:-1; fr=1dqdauABfsKRPpsTk.AWVtC2H7aN5wao9GcNcZioqUyLw.Bfsok0.U7.AAA.0.0.Bfsok0.AWWCR_TcFFo; datr=LomyX8K1aHDfgpNMwEYRxuGf\r', 'DIE', NULL, NULL, NULL),
(108, '21', NULL, '100057634183799|@Khoi2020|c_user=100057634183799; xs=21:q_v_oXVkbzXUug:2:1605536099:-1:-1; fr=1ZBaecdxRAVZA2YzN.AWXc2mFG1igJAwaGMH0JwQIFFtc.Bfsolj.JA.AAA.0.0.Bfsolj.AWW8Y9wjnTI; datr=W4myXzSSg34E3-v9AEejC3gl\r', 'DIE', NULL, NULL, NULL),
(109, '21', NULL, '100057580666018|@Khoi2020|c_user=100057580666018; xs=47:_dZFHlHAkJ11Uw:2:1605536108:-1:-1; fr=1uP7jAWCgYmcH3idr.AWUP6587obB-wWtCeNBL-Dv9hrw.Bfsols.14.AAA.0.0.Bfsols.AWXSDqILkVQ; datr=ZImyX7dTKMt8uTkUW8LQ2taU\r', 'DIE', NULL, NULL, NULL),
(110, '21', NULL, '100057635923556|@Khoi2020|c_user=100057635923556; xs=36:Mk-ruR1UWmHMaw:2:1605536099:-1:-1; fr=1yzuCD5ZtmvizU3nt.AWVe98p89A6TzAoWjO4aUUMlJHg.Bfsolj.i4.AAA.0.0.Bfsolj.AWXSsqr_t1k; datr=XImyX9oiEG3CzWZGclRfUnWr\r', 'DIE', NULL, NULL, NULL),
(111, '21', NULL, '100057634603873|@Khoi2020|c_user=100057634603873; xs=42:wE_RRB9i4DH_tQ:2:1605536119:-1:-1; fr=1CAChmweZIiugm17k.AWWNY8AAeGaIwTzYXYMMXe8ALWo.Bfsol3.ow.AAA.0.0.Bfsol3.AWVBUJrv_2I; datr=cYmyX9z2heiBTdphSXq-J5f_\r', 'DIE', NULL, NULL, NULL),
(112, '21', NULL, '100057521688203|@Khoi2020|c_user=100057521688203; xs=44:QxKHzFSfqBodxQ:2:1605536136:-1:-1; fr=1Jx0VyUzxAAYj6TBq.AWVXLeVV80MeM5gYBEJvx9kTw0Q.BfsomI.I5.AAA.0.0.BfsomI.AWVhfaSi8ks; datr=gYmyX5qifl_NtYuS2ikVfmG1\r', 'DIE', NULL, NULL, NULL),
(113, '21', NULL, '100057876153887|@Khoi2020|c_user=100057876153887; xs=29:Y7HsbER71cagqw:2:1605536192:-1:-1; fr=143GzCuCbv8n6lmX3.AWVv4-17cqI6EmufcCb9F3S6LGA.BfsonA.NJ.AAA.0.0.BfsonA.AWVFyVv8sWw; datr=uYmyXz_SiF3GU_OnLGGIGvK7\r', 'DIE', NULL, NULL, NULL),
(114, '21', NULL, '100057723730561|@Khoi2020|c_user=100057723730561; xs=30:nOxVepccIIrc2Q:2:1605536137:-1:-1; fr=1m6rec1894Bmkkg76.AWW6EQQ5ch1FrRXL873DZDr-hwc.BfsomJ.HB.AAA.0.0.BfsomJ.AWW3tPT3rC8; datr=g4myXxP65QZl9fN8ABukgwU5\r', 'DIE', NULL, NULL, NULL),
(115, '21', NULL, '100057497779291|@Khoi2020|c_user=100057497779291; xs=17:_HvZ5uN_BT5FmQ:2:1605536238:-1:-1; fr=18ZgoABw3I0IrIxHt.AWWQ18Mqi33eheX-jJ8_d8rhuhk.Bfsonu.la.AAA.0.0.Bfsonu.AWVHrl1ZbuM; datr=54myXzGU0DK1Bn6fY94xz7z5\r', 'DIE', NULL, NULL, NULL),
(116, '21', NULL, '100057705791223|@Khoi2020|c_user=100057705791223; xs=29:G-lKhhe71eK4TQ:2:1605536238:-1:-1; fr=1xBrc2T3IwZFqci2E.AWV6WvcPFyu47teq4ywfsuZccAU.Bfsont.Eq.AAA.0.0.Bfsont.AWXONVLmx7o; datr=5omyX31P1IEddU44EelRCAMC\r', 'DIE', NULL, NULL, NULL),
(117, '21', NULL, '100057890793248|@Khoi2020|c_user=100057890793248; xs=23:acVR-eQj-eW08w:2:1605536235:-1:-1; fr=1QWAMME8ZR7KYRWSz.AWXmOKSi9QWOxTgPJf4C2YfjAu0.Bfsonq.vA.AAA.0.0.Bfsonq.AWXXvJcya1I; datr=44myXyBvMN6Wm47xc6f2ZJTu\r', 'DIE', NULL, NULL, NULL),
(118, '21', NULL, '100057747939306|@Khoi2020|c_user=100057747939306; xs=32:_orgieQsqIrmQA:2:1605536258:-1:-1; fr=1r6MGQEBYDSHt4qA8.AWXnZKj9SPKWs1MBg00usdRqhXY.BfsooC.Ft.AAA.0.0.BfsooC.AWW-nvnik4Q; datr=_ImyX3jVbaUQOzajkxAoXNJS\r', 'DIE', NULL, NULL, NULL),
(119, '21', '5TN61629754929', '100057343406159|@Khoi2020|c_user=100057343406159; xs=34:II1yC6q2t4mqgg:2:1605536261:-1:-1; fr=1quZJLMFDJQkBNccV.AWWCo_flbmu5si4N0lq9PiUHCPU.BfsooE.e_.AAA.0.0.BfsooE.AWVWbSEeoWI; datr=_YmyX_5txslxCvvh6vcpLuTp\r', 'LIVE', NULL, NULL, '2021-08-24 04:42:09'),
(120, '21', NULL, '100057685722065|@Khoi2020|c_user=100057685722065; xs=36:mCJHG-Ra7URieQ:2:1605536277:-1:-1; fr=1zUZknPL7W92yYWKp.AWWXhdTSuXpHaoB06uCA5nXxMic.BfsooV.Rs.AAA.0.0.BfsooV.AWVmv-4HhfY; datr=DoqyXyNga-0dYL51V-xMF-0l\r', 'DIE', NULL, NULL, NULL),
(121, '21', NULL, '100057521898454|@Khoi2020|c_user=100057521898454; xs=33:Qe_odwiAecEmWw:2:1605536300:-1:-1; fr=1TaqiOAMM0daFEbSD.AWWyx80ucUQz6Eh2IIcWcauCUf8.Bfsoos.hh.AAA.0.0.Bfsoos.AWUXs8eTlEk; datr=JoqyXxZHSX2Qm8G6HHs9lPJM\r', 'DIE', NULL, NULL, NULL),
(122, '21', 'RGZA1629913931', '100057944881328|@Khoi2020|c_user=100057944881328; xs=42:ASvDXUv-_9swgQ:2:1605536326:-1:-1; fr=1PR5KL5nJ3DvlaSUQ.AWVT3Z1WhrfwzN8evF9I0MkZbKs.BfsopG.5r.AAA.0.0.BfsopG.AWX5p10AVSQ; datr=P4qyX-3pb2hssUH30bpA8cFF\r', 'LIVE', NULL, NULL, '2021-08-26 00:52:11'),
(123, '21', NULL, '100057630463852|@Khoi2020|c_user=100057630463852; xs=17:KmxG9rIEt9WjNQ:2:1605536359:-1:-1; fr=1GbMjcJXPRFsvKjGf.AWVQsHK_EvS18_W6yzB94gPQsV8.Bfsopn.mC.AAA.0.0.Bfsopn.AWVs0JfBTXo; datr=X4qyX6sMrns-DnYM70xJt484\r', 'DIE', NULL, NULL, NULL),
(124, '21', NULL, '100057906152631|@Khoi2020|c_user=100057906152631; xs=15:dLU17GDi45rJiw:2:1605536373:-1:-1; fr=1uxRhxSnzcVN468Tj.AWVDH_PSt-cW7fOHBGCNZULL_hE.Bfsop1.rY.AAA.0.0.Bfsop1.AWXo8tXszbg; datr=b4qyX2-1RwERVB8BrGQF-ytc\r', 'DIE', NULL, NULL, NULL),
(125, '21', NULL, '100057801577078|@Khoi2020|c_user=100057801577078; xs=18:yu284u-Pix9mRg:2:1605536367:-1:-1; fr=1B2Dfc8O9wdbBewP4.AWUQ9VAY3VRYy0RYR4DEE0WBbow.Bfsopv.EJ.AAA.0.0.Bfsopv.AWV9bUDdY34; datr=ZoqyXy5Fnp6Xpnq6DVps6T33\r', 'DIE', NULL, NULL, NULL),
(126, '21', NULL, '100057872044084|@Khoi2020|c_user=100057872044084; xs=33:4BCrGwUVQqexXA:2:1605536391:-1:-1; fr=1ugKiHEqsOWnQd5Qu.AWUw7XJe5Jsg4Avdn3mHgIqxkDU.BfsoqG.Br.AAA.0.0.BfsoqG.AWWfrTvPQds; datr=gIqyX6A7ATkz_l8VaTGXLZoH\r', 'DIE', NULL, NULL, NULL),
(127, '21', NULL, '100057519558562|@Khoi2020|c_user=100057519558562; xs=36:7HDLG_1qyZ3bxg:2:1605536396:-1:-1; fr=1XatkySUQ430ca1nd.AWWIqtn-0Z9U-pP4AEGmAFQea40.BfsoqM.bF.AAA.0.0.BfsoqM.AWVfRUsBshY; datr=h4qyXwMpfxd6fFOOSNasMd1W\r', 'DIE', NULL, NULL, NULL),
(128, '21', NULL, '100057624464143|@Khoi2020|c_user=100057624464143; xs=36:rt202om0pNvd4g:2:1605536403:-1:-1; fr=1j61MNfmN2UlK4bu1.AWXF5k0WyTISPli5RF1bDHMDBuY.BfsoqT.Qy.AAA.0.0.BfsoqT.AWW7RvWEcFM; datr=jYqyX1h5aYg4QPO9qWqQxjBe\r', 'DIE', NULL, NULL, NULL),
(129, '21', NULL, '100057363835186|@Khoi2020|c_user=100057363835186; xs=20:nx5SIiJttPHdMg:2:1605536406:-1:-1; fr=1WwQ6sxpHOhHSPFOv.AWXTC1EoeGw2wS-a63rH41XhnKo.BfsoqW.Ak.AAA.0.0.BfsoqW.AWVoIDR16fI; datr=jYqyXzo-81smrUFdMR03By9W\r', 'DIE', NULL, NULL, NULL),
(130, '21', NULL, '100057337316240|@Khoi2020|c_user=100057337316240; xs=42:_di_cBn60kgfDg:2:1605536440:-1:-1; fr=1uJbvGBEvUytEMePq.AWWVtcAMq-7yN0doocR-CjOxHEM.Bfsoq4.O_.AAA.0.0.Bfsoq4.AWWG2czvBOM; datr=sYqyX06y5qG59-SNvfyC1pRh\r', 'DIE', NULL, NULL, NULL),
(131, '21', NULL, '100057314337105|@Khoi2020|c_user=100057314337105; xs=5:Hmbhf-ZUv8M0dA:2:1605536441:-1:-1; fr=1f4vGHtdwLVZVW3Ve.AWUKdhxOgLxy1tEabROntbWewRo.Bfsoq5.VG.AAA.0.0.Bfsoq5.AWX1o7LCbAc; datr=s4qyXxAYQ4gVPW0lciH8Vkwz\r', 'DIE', NULL, NULL, NULL),
(132, '21', 'Z2FK1630106932', '100057584415813|@Khoi2020|c_user=100057584415813; xs=36:zOv4ISZUPjyiTw:2:1605536454:-1:-1; fr=1AIx2phbUmkfGDyoh.AWXtW9GXvHlDjdkAH41qCKTmGNM.BfsorF.6Y.AAA.0.0.BfsorF.AWX1bqJbP90; datr=v4qyX5PAX1GqiwcCPnNHK1vl\r', 'LIVE', NULL, NULL, '2021-08-28 06:28:52'),
(133, '21', 'Z2FK1630106932', '100057472790165|@Khoi2020|c_user=100057472790165; xs=17:LpMbCOdUPFq6Vg:2:1605536495:-1:-1; fr=1KYei0IZ7U9uHCsyr.AWWhpifRl1DAwtdClDykKvQHzDI.Bfsorv.hu.AAA.0.0.Bfsorv.AWV70ayjJVE; datr=6IqyX3B1Y6EEFQVVO-UsV_fT\r', 'LIVE', NULL, NULL, '2021-08-28 06:28:52'),
(134, '21', 'Z2FK1630106932', '100057589155396|@Khoi2020|c_user=100057589155396; xs=31:Kx6HGlSlTOxIow:2:1605536513:-1:-1; fr=1YlPVltCij0AgUvSA.AWWAhHhhQJ8DNdI8cOH5mFnHAOU.BfsosA._f.AAA.0.0.BfsosA.AWUoAgerAIU; datr=-YqyXwxZY6A3eWsVO3p5gVFP\r', 'LIVE', NULL, NULL, '2021-08-28 06:28:52'),
(135, '21', NULL, '100057936481714|@Khoi2020|c_user=100057936481714; xs=10:VtrvymlpbXC5pw:2:1605536540:-1:-1; fr=10kjsj5zLNTnqwFDL.AWU0xu3xZBSSvhS29sdQDetm4S0.Bfsosb.e0.AAA.0.0.Bfsosb.AWWoSZ-H_uk; datr=FYuyX_lAgPcTRuEOEE3dH2g3\r', 'DIE', NULL, NULL, NULL),
(136, '21', NULL, '100057521688211|@Khoi2020|c_user=100057521688211; xs=43:WnQNjJCkcYDbsA:2:1605536541:-1:-1; fr=1QQgvikSQ6cxdUE1i.AWW-hfDYcM_H2wuzmNcMSkGP2dA.Bfsosc.0E.AAA.0.0.Bfsosc.AWUE8NOLIyg; datr=FYuyX1zCJw7IajpBW2T2xYWh\r', 'DIE', NULL, NULL, NULL),
(137, '21', NULL, '100057813036614|@Khoi2020|c_user=100057813036614; xs=11:4N0H39USOcN27w:2:1605536588:-1:-1; fr=16rbtCNy1YRrADL2S.AWW-SNp5Yqxjm6SFoK5kSsR0i4Y.BfsotL.EG.AAA.0.0.BfsotL.AWVNy_zEKqA; datr=RYuyX23RBQS2s_g7Xdba4mcq\r', 'DIE', NULL, NULL, NULL),
(138, '21', NULL, '100057830135215|@Khoi2020|c_user=100057830135215; xs=50:iT2g2VJ0gDA8cg:2:1605536587:-1:-1; fr=1N6vta4Foo60PNSu0.AWWLpefZs8Rtjd-ak6TkBn10gr0.BfsotK.qG.AAA.0.0.BfsotK.AWXvhw6N6h8; datr=Q4uyX94NdzA1XfgIXZjmUWr0\r', 'DIE', NULL, NULL, NULL),
(139, '21', NULL, '100057515268539|@Khoi2020|c_user=100057515268539; xs=1:WQY2h9KnfN2O8w:2:1605536599:-1:-1; fr=1MjTOmG7COYD8d5Cd.AWWsh9Ur7J2zuoha108gw7jhmZo.BfsotX.DZ.AAA.0.0.BfsotX.AWWKGjTQKkk; datr=UIuyX1bzD6lSqL9YCxpw6Sxb\r', 'DIE', NULL, NULL, NULL),
(140, '21', NULL, '100057525288047|@Khoi2020|c_user=100057525288047; xs=10:ZdR8OedTLE1BNA:2:1605536600:-1:-1; fr=1A1GxDby59ISAnQDm.AWWEst6WXTzzOlVk6u1Fs0jur5c.BfsotX.uD.AAA.0.0.BfsotX.AWUaa1pe2WI; datr=UYuyXyD7-dUI9FGS9DAe3R-f\r', 'DIE', NULL, NULL, NULL),
(141, '21', NULL, '100057663222496|@Khoi2020|c_user=100057663222496; xs=9:OzWenhGaw6QfSQ:2:1605536611:-1:-1; fr=1EfaKQQtsYjxZz7Zx.AWULPY40wpJPjFnADyqYo3jjAa0.Bfsotj.wP.AAA.0.0.Bfsotj.AWXcdLJR8LA; datr=XIuyXwppvI2Y_nuFcojK9hTJ\r', 'DIE', NULL, NULL, NULL),
(142, '21', 'Z2FK1630106932', '100057341095986|@Khoi2020|c_user=100057341095986; xs=44:kSFcOsrkC5GV8w:2:1605536630:-1:-1; fr=1wnuLtzrF0spSjudr.AWUbzHpHAHDWE0W8r6C_Fw7HU3g.Bfsot2.2a.AAA.0.0.Bfsot2.AWXKpkiAiCs; datr=cIuyX59MDRON2xT4udY8UaYh\r', 'LIVE', NULL, NULL, '2021-08-28 06:28:52'),
(143, '21', NULL, '100057699611506|@Khoi2020|c_user=100057699611506; xs=15:pLVZSqcPNdjspg:2:1605536644:-1:-1; fr=1LdvJwLf4fPGyjpyh.AWWAjcRome0VzmEFF7T0X1VZOkU.BfsouE.wW.AAA.0.0.BfsouE.AWUwTDesJYQ; datr=fouyX-oKzNigu1CzMbL_voOp\r', 'DIE', NULL, NULL, NULL),
(144, '21', NULL, '100057966210377|@Khoi2020|c_user=100057966210377; xs=31:4gs6NlKW8mKY3Q:2:1605536675:-1:-1; fr=1O1JL5uPdMbQnyYMK.AWWLegeOOLxJyeq4TF8DUbZdrrQ.Bfsouj.ZE.AAA.0.0.Bfsouj.AWWutlZfbU8; datr=m4uyX61rTZXji6kLEyNyW62s\r', 'DIE', NULL, NULL, NULL),
(145, '21', NULL, '100057453801093|@Khoi2020|c_user=100057453801093; xs=34:TlCHguZMAKXkfw:2:1605536673:-1:-1; fr=1kpzr1Ys88ZuGBiu2.AWXqGZIha729xcTWUqq9fcZwnqI.Bfsouh.WN.AAA.0.0.Bfsouh.AWXUG2Dkpk8; datr=m4uyX8QtwV85JJxPoH4tsqCZ\r', 'DIE', NULL, NULL, NULL),
(146, '21', NULL, '100057859294573|@Khoi2020|c_user=100057859294573; xs=12:yZMSWO2yiOGgIQ:2:1605536681:-1:-1; fr=1NiVwAIX9Zkl8oOKy.AWVhUMZdmg42sgd0Pp3-HMrcY6Q.Bfsoup.nx.AAA.0.0.Bfsoup.AWWWQppdMCM; datr=oouyXxonmzYtz16pMZgOTJzK\r', 'DIE', NULL, NULL, NULL),
(147, '21', 'Z2FK1630106932', '100057324116871|@Khoi2020|c_user=100057324116871; xs=39:TfYgVaj-obBddA:2:1605536681:-1:-1; fr=1KfCo2gQ29RrwUxz4.AWX7X44Qz0IBVPC-9KwIxpYKLtQ.Bfsouo.v7.AAA.0.0.Bfsouo.AWVuEkceNW0; datr=oYuyX_b_uSF1aMT7h9Ed8901\r', 'LIVE', NULL, NULL, '2021-08-28 06:28:52'),
(148, '21', NULL, '100057693491698|@Khoi2020|c_user=100057693491698; xs=49:jWHhSo-6zyTJzA:2:1605536686:-1:-1; fr=1HuzqdjZSIJhf2Z8q.AWXAeHO1rU7Y1dneFjVJIu7b10k.Bfsouu.kp.AAA.0.0.Bfsouu.AWXZkfLQyNg; datr=qIuyX8zPB1E5UbjqOKccon02\r', 'DIE', NULL, NULL, NULL),
(149, '21', NULL, '100057862414551|@Khoi2020|c_user=100057862414551; xs=46:V1mAZF8CwrpAkA:2:1605536686:-1:-1; fr=1XjlI3jtCe1V7yxsM.AWUnjQld8QCW34sNrL0J330aazI.Bfsouu.Lo.AAA.0.0.Bfsouu.AWVqqmZ17Fg; datr=p4uyX_JydTmvKWv-vu5EkgHG\r', 'DIE', NULL, NULL, NULL),
(150, '21', NULL, '100057358345474|@Khoi2020|c_user=100057358345474; xs=45:2bfGshR2VSr78w:2:1605536721:-1:-1; fr=1t8ggIIvBAFAsDAaJ.AWVKucG46kJuCXWM8QTDOIffjNc.BfsovR.7W.AAA.0.0.BfsovR.AWVAQoa81eQ; datr=youyXwiE9hEQ_hVUZWkQcf9N\r', 'DIE', NULL, NULL, NULL),
(151, '21', NULL, '100057568396925|@Khoi2020|c_user=100057568396925; xs=45:MwzR8RSq_ymWXQ:2:1605536746:-1:-1; fr=1EMgPoNOK6V7Qskb4.AWW_gDdi8hfssXjiQ3Ua_kUw470.Bfsovp.V8.AAA.0.0.Bfsovp.AWX8rxz3Ey4; datr=44uyX7tUT_R10eGnp2Wk-e7R\r', 'DIE', NULL, NULL, NULL),
(152, '21', NULL, '100057609644701|@Khoi2020|c_user=100057609644701; xs=35:6EB8f0hF56KmGA:2:1605536750:-1:-1; fr=1bqq7CzyuXDDtkKHC.AWX6eNybuHb1saIJs6TW558NnFE.Bfsovu.w4.AAA.0.0.Bfsovu.AWVgKNTclJw; datr=54uyXxLIZqcRxytGjG13SDUc\r', 'DIE', NULL, NULL, NULL),
(153, '21', NULL, '100057882453647|@Khoi2020|c_user=100057882453647; xs=12:44Q75AMQwS1kOw:2:1605536668:-1:-1; fr=17AyiOCvvJC9pKDm5.AWVhS9xFhPP9lWvJs3v6A7joQWE.Bfsoub.vh.AAA.0.0.Bfsoub.AWVpIUlEjuo; datr=lYuyX3PHLUQ-iebl2lX2rIqy\r', 'DIE', NULL, NULL, NULL),
(154, '21', NULL, '100057394194096|@Khoi2020|c_user=100057394194096; xs=3:uEr4Zv4plrMJNA:2:1605536757:-1:-1; fr=1DmVvf6ozbkmR3vBx.AWUl04A-1RH_ZBSJzT6wgUb--w0.Bfsov1.yo.AAA.0.0.Bfsov1.AWVdLjqUdgw; datr=7YuyX2nxywz6N2FVZhJC4eSH\r', 'DIE', NULL, NULL, NULL),
(155, '21', NULL, '100057939931538|@Khoi2020|c_user=100057939931538; xs=39:gx63zl8QtVqZCw:2:1605536779:-1:-1; fr=1f7cBReyWUM2Y8lLT.AWUbqCSKmwdcBLkpxFs6rKE3D9g.BfsowL.4B.AAA.0.0.BfsowL.AWXEi0jEjJ0; datr=BYyyXyoKgA8LgxrrnEi3g1z5\r', 'DIE', NULL, NULL, NULL),
(156, '21', NULL, '100057842704864|@Khoi2020|c_user=100057842704864; xs=23:cNjT2tU4O7yGlw:2:1605536815:-1:-1; fr=11JIjXrsZFHWb2Iya.AWUDybIgBMEdZhFzdIi2d6FV2Eg.Bfsowv.Mp.AAA.0.0.Bfsowv.AWX6FbDR5Hc; datr=J4yyX2sQzN5P2hgtFqoQO7u1\r', 'DIE', NULL, NULL, NULL),
(157, '21', NULL, '100057350845874|@Khoi2020|c_user=100057350845874; xs=34:7TdCMynBILnQIA:2:1605536832:-1:-1; fr=1PpUIQ1Ija9SuIlSm.AWXlBescSJGBQkfZkIJ0vMlscPk.BfsoxA.fA.AAA.0.0.BfsoxA.AWVgpSkSneQ; datr=OoyyX6Zw3-XWWUNwGRrw9sYx\r', 'DIE', NULL, NULL, NULL),
(158, '21', NULL, '100057879363805|@Khoi2020|c_user=100057879363805; xs=6:wyF7uryvsIVXcA:2:1605536829:-1:-1; fr=1Dz9YmH0W1tl0wy9p.AWUMo87Kr2suf4IFBfOMLzpxz-U.Bfsow9.3I.AAA.0.0.Bfsow9.AWVnl4VU_80; datr=NoyyXz28H6lx9I2No53S9khm\r', 'DIE', NULL, NULL, NULL),
(159, '21', NULL, '100057686681871|@Khoi2020|c_user=100057686681871; xs=41:6UmsHANG9EOBZw:2:1605536843:-1:-1; fr=1jkovUytz5tEhxE5c.AWWP416G-Wfo4_0UXYtxlhKKgoQ.BfsoxL.u4.AAA.0.0.BfsoxL.AWWVBMZAHXk; datr=RYyyX0HcQgTQNw4ysxMSinHI\r', 'DIE', NULL, NULL, NULL),
(160, '21', NULL, '100057464630972|@Khoi2020|c_user=100057464630972; xs=20:yZGZM_mBBM_smA:2:1605536853:-1:-1; fr=1EH4OBThHC4I4XxhY.AWXyk4hgtgn8WK22JFX7xe2Ms8s.BfsoxV.0k.AAA.0.0.BfsoxV.AWV6tU1wRug; datr=ToyyXwn8pUMOFOQde7Jfv5uj\r', 'DIE', NULL, NULL, NULL),
(161, '21', NULL, '100057519468541|@Khoi2020|c_user=100057519468541; xs=8:vdNwbYoeDnRX2A:2:1605536876:-1:-1; fr=1CWNLYR6nGjjNfuka.AWWj-W7HolC1o9cUemO1vl5MNnI.Bfsoxs.PI.AAA.0.0.Bfsoxs.AWWVOyzWObA; datr=ZoyyXyUZTPNkzDkERuCbeudR\r', 'DIE', NULL, NULL, NULL),
(162, '21', NULL, '100057378744481|@Khoi2020|c_user=100057378744481; xs=20:8uVTrbq108eolA:2:1605536875:-1:-1; fr=1bW9rn2ytq9MfOVCv.AWXUu83JSrR0i_rv9kljBruPa74.Bfsoxr.w7.AAA.0.0.Bfsoxr.AWXsUBwKJWY; datr=ZIyyX2jhd1QYYv8Q78Eb0bvl\r', 'DIE', NULL, NULL, NULL),
(163, '21', NULL, '100057941101465|@Khoi2020|c_user=100057941101465; xs=5:_BGDZp0jRew-Zg:2:1605536893:-1:-1; fr=1U1r8A41a8gZqYM07.AWW0M_Lap-d-aNa-5nd88PCWQv0.Bfsox9.AM.AAA.0.0.Bfsox9.AWX9QFCVZm8; datr=doyyX2B8xbmtGBCniPDswwCE\r', 'DIE', NULL, NULL, NULL),
(164, '21', NULL, '100057699191521|@Khoi2020|c_user=100057699191521; xs=42:Uc5L5uG-BgnVgw:2:1605536894:-1:-1; fr=1BoU75C0cWFWtRhwt.AWVOW9MwtPOA5rZd7bt9HeUKeUw.Bfsox-.S4.AAA.0.0.Bfsox-.AWURtXJ1P3Q; datr=eIyyX90Y7UBZPkDbuPunBtpg\r', 'DIE', NULL, NULL, NULL),
(165, '21', NULL, '100057676362178|@Khoi2020|c_user=100057676362178; xs=3:i85AsJelelwUnA:2:1605536890:-1:-1; fr=1rZ6B32LqWwopiPem.AWURnrHyIgUELm7cQvPyUCE5cxs.Bfsox6.Zt.AAA.0.0.Bfsox6.AWXs3RhLTLs; datr=dIyyXz-FKZw7un_dtr5ykSL_\r', 'DIE', NULL, NULL, NULL),
(166, '21', NULL, '100057941491466|@Khoi2020|c_user=100057941491466; xs=50:SHvT7aY-4IQpaQ:2:1605536900:-1:-1; fr=1ScToLnVuBVcbbUDI.AWXXHJdmF3dlj2DWjeWTRnQcE0A.BfsoyE.OL.AAA.0.0.BfsoyE.AWVs-DFAg54; datr=fYyyXzKMVFDMG04KUSB8tCRG\r', 'DIE', NULL, NULL, NULL),
(167, '21', NULL, '100057884073704|@Khoi2020|c_user=100057884073704; xs=6:VE884wndjaDC8w:2:1605536968:-1:-1; fr=1D35g0Kp7NvsLyCIh.AWWdZW3l86NEcwMXhntO-AU6FH0.BfsozH.83.AAA.0.0.BfsozH.AWVGq59EiHs; datr=wYyyX1ZREtKOEj02hVgzXFt0\r', 'DIE', NULL, NULL, NULL),
(168, '21', NULL, '100057736180012|@Khoi2020|c_user=100057736180012; xs=24:ffPZgaavky4I6A:2:1605536976:-1:-1; fr=1OmDhhLogdFm715Hn.AWUgkVk1K1aXiX719VoOMNP6zII.BfsozQ.xK.AAA.0.0.BfsozQ.AWUjLdIJQNc; datr=yYyyX2YN25DLLJ_JaydKwuW5\r', 'DIE', NULL, NULL, NULL),
(169, '21', NULL, '100057525858168|@Khoi2020|c_user=100057525858168; xs=28:z1vu5alzlUl20g:2:1605536925:-1:-1; fr=1qUe6UpksnNfWBquV.AWWCRtJBenLtN2YNPcNRCxmB3B4.Bfsoyd.As.AAA.0.0.Bfsoyd.AWX_jMBPwKg; datr=loyyX-OTZhcDGsxspd_5egLe\r', 'DIE', NULL, NULL, NULL),
(170, '21', NULL, '100057927781962|@Khoi2020|c_user=100057927781962; xs=14:CzgJDeCjeJ10TQ:2:1605536954:-1:-1; fr=1t7Sa2HhQoDhPJ33v.AWVO8W-UnuXTXcU-YCp5bhd4jik.Bfsoy6.K4.AAA.0.0.Bfsoy6.AWW6_YBkzyI; datr=tIyyX1LgK-pXHOQvy7l3ukHm\r', 'DIE', NULL, NULL, NULL),
(171, '21', NULL, '100057433192005|@Khoi2020|c_user=100057433192005; xs=14:WY6fFExsP6gS7w:2:1605536985:-1:-1; fr=1JaIIodUpZXjUw1zr.AWUXv88XZgP-6zuQ7eiXeXQbiN8.BfsozZ.G_.AAA.0.0.BfsozZ.AWXIeyywNJA; datr=0oyyXxN4eZzURGq_2ij73hBD\r', 'DIE', NULL, NULL, NULL),
(172, '21', NULL, '100057697241519|@Khoi2020|c_user=100057697241519; xs=49:8bQymns_oUOQMg:2:1605536997:-1:-1; fr=1r8fxNVqQHtoIoVz6.AWWBXFP4MidyoN0kbBwnt5Q9UyM.Bfsozl.4s.AAA.0.0.Bfsozl.AWV-lfJikdw; datr=34yyX9UfA_xkjUffi-AO-cat\r', 'DIE', NULL, NULL, NULL),
(173, '21', NULL, '100057514458468|@Khoi2020|c_user=100057514458468; xs=1:LY9fQQFRQCOLFg:2:1605537019:-1:-1; fr=12rBMHvOGZwEJwGXC.AWUD_K0veT-VmbWRO4PWyi4wtaQ.Bfsoz7.f1.AAA.0.0.Bfsoz7.AWXAgQIttxk; datr=84yyX5HJihsDgbe1KMZyAHfi\r', 'DIE', NULL, NULL, NULL),
(174, '21', NULL, '100057536327811|@Khoi2020|c_user=100057536327811; xs=5:0_F4CRlkOS1BBA:2:1605537047:-1:-1; fr=1WClCxEDjiFosvJxA.AWWYOuvc6dObnB2TmiYuDDUjxyg.Bfso0X.ft.AAA.0.0.Bfso0X.AWUcXgAEIGU; datr=DY2yXwDIR8Qz0aQkixz0B3xr\r', 'DIE', NULL, NULL, NULL),
(175, '21', NULL, '100057813426458|@Khoi2020|c_user=100057813426458; xs=45:aFmrZS3lY7t31Q:2:1605537060:-1:-1; fr=1tN2BeiWqZiw5gMbd.AWXnQ9j52OzzqyucgaUTtmPHmzg.Bfso0j.89.AAA.0.0.Bfso0j.AWXrqR9gkkc; datr=HY2yX1xcZ5ViD-7fM84pkwIm\r', 'DIE', NULL, NULL, NULL),
(176, '21', 'GMX11630600624', '100057388704488|@Khoi2020|c_user=100057388704488; xs=41:iUWzOBiE4Pj6lw:2:1605537098:-1:-1; fr=1MbVQ312kccjlnIc1.AWV1SX8ugnTGJ5g8gwim-R0Wa5Q.Bfso1K._d.AAA.0.0.Bfso1K.AWVs-MY7A_I; datr=Q42yX31foQk8VLPOV2pXmPT_\r', 'LIVE', NULL, NULL, '2021-09-02 23:37:04'),
(177, '21', NULL, '100057890073317|@Khoi2020|c_user=100057890073317; xs=44:cIGMWA88CGotWA:2:1605537121:-1:-1; fr=1ax9WEjpvLiODDqal.AWUEQuj11YhdtIybMpwAg8DUaIQ.Bfso1h.Fh.AAA.0.0.Bfso1h.AWVJrDF9uJM; datr=W42yX5cycpljStLx8W1Baueb\r', 'LIVE', NULL, NULL, NULL),
(178, '21', NULL, '100057668772467|@Khoi2020|c_user=100057668772467; xs=5:au7gYk9Zu7voOA:2:1605537116:-1:-1; fr=1yRzub0DVjD4eM1Cb.AWX_0xSKkuAk0J9PXfXmT7Nv0rM.Bfso1c.XN.AAA.0.0.Bfso1c.AWUdVeoQDVg; datr=V42yX_Wv7NnNB-OpS94AdoUH\r', 'LIVE', NULL, NULL, NULL),
(179, '21', NULL, '100057849094714|@Khoi2020|c_user=100057849094714; xs=36:kj9upvfXdp5Wcg:2:1605537126:-1:-1; fr=1vMxKbX0LyQcLbGfQ.AWWlxZwt5OxNT1iRDRvMHRWJ94s.Bfso1l.jk.AAA.0.0.Bfso1l.AWWubvyKBBQ; datr=Xo2yX6OmY6HDzQ263JL--AMx\r', 'LIVE', NULL, NULL, NULL),
(180, '21', NULL, '100057439761806|@Khoi2020|c_user=100057439761806; xs=47:YQChodrm1jA6Qg:2:1605537133:-1:-1; fr=1gN3lDZXMw3Xb0dHr.AWUqBMtpN6D0Ga_uMO_YK6dpRAc.Bfso1t.bS.AAA.0.0.Bfso1t.AWWSHT6j134; datr=Z42yX8QRWqKoqIZ4Wcoe_ELN\r', 'LIVE', NULL, NULL, NULL),
(181, '21', NULL, '100057686351597|@Khoi2020|c_user=100057686351597; xs=11:LRj52cWWUIb8BQ:2:1605537128:-1:-1; fr=1rJwXZZjwczcPePoR.AWWsH7arsaLJrkII4Ol7K1cqVR8.Bfso1o.UF.AAA.0.0.Bfso1o.AWUxrTn9li0; datr=YY2yX_DQ9MS3Jl8CjPNDJx18\r', 'LIVE', NULL, NULL, NULL),
(182, '21', NULL, '100057686411879|@Khoi2020|c_user=100057686411879; xs=42:9KTMKn50Ny-M_g:2:1605537156:-1:-1; fr=1ufAwU6SrJcT53CIx.AWW9vqA87G9N4LSGFktLG9FAioQ.Bfso2E.YG.AAA.0.0.Bfso2E.AWU0SaFMpKw; datr=fY2yX51loqOqVuOPLhYi3wsX\r', 'LIVE', NULL, NULL, NULL),
(183, '21', NULL, '100057443511195|@Khoi2020|c_user=100057443511195; xs=12:HlAH2PLxyAuRCg:2:1605537168:-1:-1; fr=1kMxVSWgShskIy0XN.AWVlN5b6KaFVOEgqFN8feS4Y_lQ.Bfso2P.le.AAA.0.0.Bfso2P.AWUeetPN0l8; datr=iY2yX9P__J0MKLP1cqj893pJ\r', 'LIVE', NULL, NULL, NULL),
(184, '21', NULL, '100057607184535|@Khoi2020|c_user=100057607184535; xs=5:LxeBhj0OvOy57Q:2:1605537171:-1:-1; fr=1oZXiM9mjuf83WHQi.AWVgvNXCTs9_GG2rhA5jw2WRaxY.Bfso2T.Q4.AAA.0.0.Bfso2T.AWVGjC3QXFM; datr=jY2yX5x3sBvIcyF6W9XylJJq\r', 'LIVE', NULL, NULL, NULL),
(185, '21', NULL, '100057363625096|@Khoi2020|c_user=100057363625096; xs=23:BUAeg9zJQzsUdg:2:1605537206:-1:-1; fr=1VTH3zQTBaNLZsvBh.AWUgJt2YiCkeJM9iMUjTDzP5jBg.Bfso22.IH.AAA.0.0.Bfso22.AWUR64L0Ovs; datr=r42yXxU9JIiZNjXNGq2B5oph\r', 'LIVE', NULL, NULL, NULL),
(186, '21', NULL, '100057731950158|@Khoi2020|c_user=100057731950158; xs=46:yhY7iio_wSh8qw:2:1605537241:-1:-1; fr=1nZ40z6aUEO8K93eN.AWXNQx6RYz0R3RLNctfNrCRaPRI.Bfso3Z._N.AAA.0.0.Bfso3Z.AWW7vjJllkc; datr=042yX7dz3PSL0UvnFEHqz5Cp\r', 'LIVE', NULL, NULL, NULL),
(187, '21', NULL, '100057967260189|@Khoi2020|c_user=100057967260189; xs=17:swEiqLasvuCLag:2:1605537268:-1:-1; fr=1EBlP6gZARIfbWOWX.AWVw6KVjl_Prthisve0g1G1z324.Bfso3z.M1.AAA.0.0.Bfso3z.AWV2_u8S5Z0; datr=7Y2yX39NO5ldHB3rgPx98Akk\r', 'LIVE', NULL, NULL, NULL),
(188, '21', NULL, '100057604154625|@Khoi2020|c_user=100057604154625; xs=9:n_1XtY79jwSqkQ:2:1605537275:-1:-1; fr=1yOZBaoIlPzgEPXHD.AWXHI8_UfR_KE1AU9YQJaJOTIYk.Bfso37.tU.AAA.0.0.Bfso37.AWXeD6SPm5c; datr=8I2yXwWS2vd6KuQv0UMPbGER\r', 'LIVE', NULL, NULL, NULL),
(189, '21', NULL, '100057830315216|@Khoi2020|c_user=100057830315216; xs=2:SOfU8Nccre4Atw:2:1605537287:-1:-1; fr=1vWZQW4hw7hGhmO2n.AWXvFIKSPj35TIEiHaS7h7P2r8s.Bfso4H.0Z.AAA.0.0.Bfso4H.AWX5eOMBEQ4; datr=AY6yX2YGZP_oQ2KjyWMs1bWU\r', 'LIVE', NULL, NULL, NULL),
(190, '21', NULL, '100057353605546|@Khoi2020|c_user=100057353605546; xs=37:EsNR3ujSyQqT6g:2:1605537311:-1:-1; fr=18IPJvSeQOqi3y1Ef.AWUoeDDCrNmwTDSn_cl9IjQIXyI.Bfso4f.jG.AAA.0.0.Bfso4f.AWWL4kl7EkM; datr=GI6yX7lNXeF79jHa3T32uQXV', 'LIVE', NULL, NULL, NULL),
(191, NULL, 'O8MN1629552692', '12\r', 'LIVE', NULL, NULL, '2021-08-21 20:31:32'),
(192, '8', 'BMR51630310744', 'longnguyenmanhhung21174@gmail.com\r', 'LIVE', NULL, NULL, '2021-08-30 15:05:44'),
(193, '8', '9RE81630310762', 'anhlethihong15123@gmail.com\r', 'LIVE', NULL, NULL, '2021-08-30 15:06:02'),
(194, '8', '7EI91630310777', 'hoanghungabds84932993@gmail.com\r', 'LIVE', NULL, NULL, '2021-08-30 15:06:17'),
(195, '8', NULL, 'huohonghoajfdf9495893@gmai.com\r', 'LIVE', NULL, NULL, NULL),
(196, '8', NULL, 'ductranhuy1293@gmail.com\r', 'LIVE', NULL, NULL, NULL),
(197, '8', NULL, 'anhnguyenthidung19163@gmail.com', 'LIVE', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thesieure`
--

CREATE TABLE `thesieure` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `magiaodich` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `sotien` int(11) DEFAULT NULL,
  `noidung` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` text COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `money` int(11) NOT NULL DEFAULT 0,
  `debit_amount` int(11) DEFAULT 0,
  `level` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `banned` int(11) NOT NULL DEFAULT 0,
  `reason_banned` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ref` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ref_money` int(11) DEFAULT 0,
  `daily` int(11) DEFAULT 0,
  `otp` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `UserAgent` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `chietkhau` float DEFAULT 0,
  `time` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `chitieu` int(11) NOT NULL DEFAULT 0,
  `total_money` int(11) NOT NULL DEFAULT 0,
  `phone` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `used_money` int(11) DEFAULT 0,
  `time_session` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `token`, `money`, `debit_amount`, `level`, `banned`, `reason_banned`, `createdate`, `email`, `ref`, `ref_money`, `daily`, `otp`, `ip`, `UserAgent`, `device`, `chietkhau`, `time`, `chitieu`, `total_money`, `phone`, `fullname`, `used_money`, `time_session`) VALUES
(1, 'admin', 'admin', 'ZEgeLCYXQVyswWDankcJTbihxumRKofdPMABGzOpqUtHajrNvFIlS', 202091960, 1000000, 'admin', 0, NULL, '2021-01-20 08:38:05', '', '', 0, 0, '', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.82 Safari/537.36', NULL, 0, NULL, 0, 202100000, '0947838128', '', NULL, 1633160911),
(7, 'ntthanh', 'aaaaaaaa', 'UygVsbBratcRIPuXkNoHjOJQAWYpZnilfmGTqKLxzhCEvwFSedDM', 0, 0, NULL, 0, NULL, '2021-07-25 09:33:05', NULL, '1', 0, 0, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', NULL, 0, '1627180385', 0, 0, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `zalo_pay`
--

CREATE TABLE `zalo_pay` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `transid` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `api_domains`
--
ALTER TABLE `api_domains`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `bank_auto`
--
ALTER TABLE `bank_auto`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `chuyentien`
--
ALTER TABLE `chuyentien`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `config_momo`
--
ALTER TABLE `config_momo`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `giftcode`
--
ALTER TABLE `giftcode`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `hide_category_api`
--
ALTER TABLE `hide_category_api`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hide_product_api`
--
ALTER TABLE `hide_product_api`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `ruttien`
--
ALTER TABLE `ruttien`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `thesieure`
--
ALTER TABLE `thesieure`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `zalo_pay`
--
ALTER TABLE `zalo_pay`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `api_domains`
--
ALTER TABLE `api_domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `backups`
--
ALTER TABLE `backups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `bank_auto`
--
ALTER TABLE `bank_auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `chuyentien`
--
ALTER TABLE `chuyentien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `config_momo`
--
ALTER TABLE `config_momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT cho bảng `giftcode`
--
ALTER TABLE `giftcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hide_category_api`
--
ALTER TABLE `hide_category_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hide_product_api`
--
ALTER TABLE `hide_product_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `momo`
--
ALTER TABLE `momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT cho bảng `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `ruttien`
--
ALTER TABLE `ruttien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT cho bảng `thesieure`
--
ALTER TABLE `thesieure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `zalo_pay`
--
ALTER TABLE `zalo_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
