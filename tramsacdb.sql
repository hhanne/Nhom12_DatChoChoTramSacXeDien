-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 02:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tramsacdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `congsac`
--

CREATE TABLE `congsac` (
  `congsac_id` int(11) NOT NULL,
  `tramsac_id` int(11) DEFAULT NULL,
  `tencong` varchar(50) DEFAULT NULL,
  `loaicong` varchar(50) DEFAULT NULL,
  `congsuat` float DEFAULT NULL,
  `trangthai` enum('hoatdong','baotri','trong') DEFAULT 'trong'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `congsac`
--

INSERT INTO `congsac` (`congsac_id`, `tramsac_id`, `tencong`, `loaicong`, `congsuat`, `trangthai`) VALUES
(1, 1, 'Cổng 1', 'Type 2', 22.5, 'hoatdong'),
(2, 1, 'Cổng 2', 'CCS2', 50, 'trong'),
(3, 2, 'Cổng 1', 'Type 2', 11, 'baotri'),
(4, 3, 'Cổng 1', 'CHAdeMO', 60, 'hoatdong');

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `danhgia_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tramsac_id` int(11) DEFAULT NULL,
  `sao` int(11) DEFAULT NULL,
  `noidung` varchar(255) DEFAULT NULL,
  `ngaydanhgia` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danhgia`
--

INSERT INTO `danhgia` (`danhgia_id`, `user_id`, `tramsac_id`, `sao`, `noidung`, `ngaydanhgia`) VALUES
(1, 1, 1, 5, 'Trạm sạc nhanh, nhân viên hỗ trợ tốt', '2025-10-25 19:31:12'),
(2, 2, 2, 4, 'Cổng sạc ổn nhưng hơi khó tìm chỗ đậu', '2025-10-25 19:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `datcho`
--

CREATE TABLE `datcho` (
  `datcho_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tramsac_id` int(11) DEFAULT NULL,
  `congsac_id` int(11) DEFAULT NULL,
  `thanhtoan_id` int(11) DEFAULT NULL,
  `ngaydat` date DEFAULT NULL,
  `timebatdau` datetime DEFAULT NULL,
  `timeketthuc` datetime DEFAULT NULL,
  `trangthai` enum('choxacnhan','dadat','dang_sac','hoanthanh','huy') DEFAULT 'choxacnhan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lichsusudung`
--

CREATE TABLE `lichsusudung` (
  `lichsu_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tramsac_id` int(11) DEFAULT NULL,
  `congsac_id` int(11) DEFAULT NULL,
  `timebatdau` datetime DEFAULT NULL,
  `timeketthuc` datetime DEFAULT NULL,
  `luong_dien` float DEFAULT NULL,
  `tongtien` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lichsusudung`
--

INSERT INTO `lichsusudung` (`lichsu_id`, `user_id`, `tramsac_id`, `congsac_id`, `timebatdau`, `timeketthuc`, `luong_dien`, `tongtien`) VALUES
(1, 1, 1, 1, '2025-10-15 08:00:00', '2025-10-15 09:00:00', 12.5, 50000.00),
(2, 2, 2, 2, '2025-10-14 15:30:00', '2025-10-14 16:15:00', 9.8, 40000.00),
(3, 3, 3, 3, '2025-10-15 08:00:00', '2025-10-15 09:00:00', 12.5, 50000.00),
(4, 4, 4, 4, '2025-10-14 15:30:00', '2025-10-14 16:15:00', 9.8, 40000.00);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `thanhtoan_id` int(11) NOT NULL,
  `phuongthuc` enum('tienmat','momo','zalopay','visa','vnpay') DEFAULT NULL,
  `sotien` decimal(10,2) DEFAULT NULL,
  `ngaythanhtoan` datetime DEFAULT current_timestamp(),
  `trangthai` enum('choxuly','thanhcong','thatbai') DEFAULT 'choxuly',
  `magiaodich` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanhtoan`
--

INSERT INTO `thanhtoan` (`thanhtoan_id`, `phuongthuc`, `sotien`, `ngaythanhtoan`, `trangthai`, `magiaodich`) VALUES
(1, 'momo', 50000.00, '2025-10-25 19:31:05', 'thanhcong', 'GD001'),
(2, 'zalopay', 75000.00, '2025-10-25 19:31:05', 'thanhcong', 'GD002'),
(3, 'vnpay', 45000.00, '2025-10-25 19:31:05', 'choxuly', 'GD003');

-- --------------------------------------------------------

--
-- Table structure for table `tramsac`
--

CREATE TABLE `tramsac` (
  `tramsac_id` int(11) NOT NULL,
  `tentram` varchar(100) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `loaitram` varchar(50) DEFAULT NULL,
  `soluong_congsac` int(11) DEFAULT NULL,
  `toado_lat` decimal(10,6) DEFAULT NULL,
  `toado_lng` decimal(10,6) DEFAULT NULL,
  `trangthai` enum('hoatdong','baotri','trong') DEFAULT 'hoatdong',
  `hinhanh_url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tramsac`
--

INSERT INTO `tramsac` (`tramsac_id`, `tentram`, `diachi`, `loaitram`, `soluong_congsac`, `toado_lat`, `toado_lng`, `trangthai`, `hinhanh_url`) VALUES
(1, 'Trạm sạc chung cư Gilden King', 'Tầng hầm B2, 15 Nguyễn Lương Bằng, Phường Tân Phú, TP.HCM', 'Nhanh', 4, 10.776889, 106.700806, 'hoatdong', 'https://bydbariavungtau.com.vn/images/thumbs/2025/06/he-thong-tram-sac-cong-cong-eboost-x-byd-viet-nam-news-87.jpg'),
(2, 'Trạm Sạc CC King Palace', 'Hầm B1-108 Nguyễn Trãi, Thượng Đình, Thanh Xuân, Hà Nội', 'Chậm', 3, 21.003819, 105.814160, 'hoatdong', 'https://mediads.nguoiduatin.vn/thumb_x640x384/media/bien-tap-vien/2024/08/12/bitcar-byd.jpg'),
(3, 'Trạm Sạc Vinhomes Metropolis', 'Tầng hầm B1, 29 đường Liễu Giai, Quận Ba Đình, Hà Nội', 'Nhanh', 5, 21.027763, 105.834160, 'baotri', 'https://photo.znews.vn/w660/Uploaded/wyhktpu/2025_09_11/4_1.jpg'),
(4, 'Trạm Sạc GrabCharge', 'Đường số 1, Khu công nghiệp Tân Bình, Quận Tân Bình, TP.HCM', 'Chậm', 3, 10.802382, 106.635029, 'hoatdong', 'https://cdn.nhandan.vn/images/77bb781b5d2fb388f37161f7c24574136a070a0cc9822a13000df45f39496d515b4c6dfab6af2724d9418bc371433ae8/10-1.jpg'),
(5, 'Trạm Sạc EVN Tower', '11 Cửa Bắc, Quận Ba Đình, Hà Nội', 'Nhanh', 6, 21.043000, 105.836000, 'hoatdong', 'https://cdnmedia.baotintuc.vn/Upload/c2tvplmdloSDblsn03qN2Q/files/2022/02/11/my-phat-trien-xe-dien-1122022.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `hoten` varchar(100) DEFAULT NULL,
  `gioitinh` varchar(10) DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `ngaytaotk` datetime DEFAULT current_timestamp(),
  `phanquyen` enum('user','admin') DEFAULT 'user',
  `trangthai` enum('hoatdong','bikhoa') DEFAULT 'hoatdong'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `hoten`, `gioitinh`, `ngaysinh`, `diachi`, `sdt`, `email`, `password`, `created_at`, `updated_at`, `ngaytaotk`, `phanquyen`, `trangthai`) VALUES
(1, 'Nguyễn Văn Nam', 'Nam', '1995-05-12', 'Lý Thường Kiệt, TP.HCM', '0909123456', 'vannam@gmail.com', 'nam123@', NULL, NULL, '2025-10-25 19:31:00', 'user', 'hoatdong'),
(2, 'Trần Vân Anh', 'Nữ', '1998-08-20', '45 Nguyễn Huệ, Đà Nẵng', '0918123123', 'vananh@gmail.com', 'vananh478@', NULL, NULL, '2025-10-25 19:31:00', 'user', 'hoatdong'),
(3, 'Lê Minh Quân', 'Nam', '1990-02-10', 'Thanh Xuân, Hà Nội', '0909555444', 'quanadmin@gmail.com', 'admin123', NULL, NULL, '2025-10-25 19:31:00', 'admin', 'hoatdong'),
(4, 'Nguyễn Thị Hồng', 'Nữ', '1995-09-09', 'Đường số 1, KCN Tân Bình, Q. Tân Bình, TP.HCM', '0909123456', 'thihong@gmail.com', 'hong123@', NULL, NULL, '2025-10-25 19:31:00', 'user', 'hoatdong');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `congsac`
--
ALTER TABLE `congsac`
  ADD PRIMARY KEY (`congsac_id`),
  ADD KEY `tramsac_id` (`tramsac_id`);

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`danhgia_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tramsac_id` (`tramsac_id`);

--
-- Indexes for table `datcho`
--
ALTER TABLE `datcho`
  ADD PRIMARY KEY (`datcho_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tramsac_id` (`tramsac_id`),
  ADD KEY `congsac_id` (`congsac_id`),
  ADD KEY `thanhtoan_id` (`thanhtoan_id`);

--
-- Indexes for table `lichsusudung`
--
ALTER TABLE `lichsusudung`
  ADD PRIMARY KEY (`lichsu_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tramsac_id` (`tramsac_id`),
  ADD KEY `congsac_id` (`congsac_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`thanhtoan_id`),
  ADD UNIQUE KEY `magiaodich` (`magiaodich`);

--
-- Indexes for table `tramsac`
--
ALTER TABLE `tramsac`
  ADD PRIMARY KEY (`tramsac_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `congsac`
--
ALTER TABLE `congsac`
  MODIFY `congsac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `danhgia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `datcho`
--
ALTER TABLE `datcho`
  MODIFY `datcho_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lichsusudung`
--
ALTER TABLE `lichsusudung`
  MODIFY `lichsu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `thanhtoan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tramsac`
--
ALTER TABLE `tramsac`
  MODIFY `tramsac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `congsac`
--
ALTER TABLE `congsac`
  ADD CONSTRAINT `congsac_ibfk_1` FOREIGN KEY (`tramsac_id`) REFERENCES `tramsac` (`tramsac_id`);

--
-- Constraints for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `danhgia_ibfk_2` FOREIGN KEY (`tramsac_id`) REFERENCES `tramsac` (`tramsac_id`);

--
-- Constraints for table `datcho`
--
ALTER TABLE `datcho`
  ADD CONSTRAINT `datcho_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `datcho_ibfk_2` FOREIGN KEY (`tramsac_id`) REFERENCES `tramsac` (`tramsac_id`),
  ADD CONSTRAINT `datcho_ibfk_3` FOREIGN KEY (`congsac_id`) REFERENCES `congsac` (`congsac_id`),
  ADD CONSTRAINT `datcho_ibfk_4` FOREIGN KEY (`thanhtoan_id`) REFERENCES `thanhtoan` (`thanhtoan_id`);

--
-- Constraints for table `lichsusudung`
--
ALTER TABLE `lichsusudung`
  ADD CONSTRAINT `lichsusudung_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `lichsusudung_ibfk_2` FOREIGN KEY (`tramsac_id`) REFERENCES `tramsac` (`tramsac_id`),
  ADD CONSTRAINT `lichsusudung_ibfk_3` FOREIGN KEY (`congsac_id`) REFERENCES `congsac` (`congsac_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
