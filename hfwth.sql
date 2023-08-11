-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 31, 2021 lúc 10:23 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hfwth`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT 'customer',
  `create_at` datetime DEFAULT curdate(),
  `last_login` datetime DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `name`, `email`, `password`, `role`, `create_at`, `last_login`) VALUES
(1, 'Dat', 'vandat97875@gmail.com', 'dat111022', 'customer', '2021-04-14 00:00:00', '2021-04-14 00:00:00'),
(4, 'dat', 'admin@gmail.com', 'adminpassword', 'admin', '2021-04-14 00:00:00', '2021-04-14 00:00:00'),
(6, 'Hoang Tuan', 'hoangtuanvnbn2@gmail.com', '123456', 'customer', '2021-04-14 00:00:00', '2021-04-14 00:00:00'),
(7, 'test', 'test', '$2y$10$kvrq2pm70rFh33ksEJQo6.H6LiP54svf/xo.lc0pyuli2uYC5RSwW', 'admin', '2021-04-15 00:00:00', '2021-04-15 00:00:00'),
(8, 'Ha Dinh Tien', 'tiengay12', '$2y$10$0f8IKQMPyje4z8MZLmQxnue8EOnRrSbrUWdBvZ7trD1./xoDt.pWy', 'customer', '2021-04-19 00:00:00', '2021-04-19 00:00:00'),
(9, 'nguyen dat', 'email@gmail.com', '$2y$10$uX1KNHmfaglS/kotlHCjEec74TUuuPxkl2X5Vcwgp8MWkq23oHzUK', 'customer', '2021-04-29 00:00:00', '2021-04-29 00:00:00'),
(10, 'Dat Nguyen Van Dat', 'nguyenvandat', '$2y$10$xADIwkk80/iKbhE7fP5vyueQy6vXfXqLT/pOeqPed6ApT9UAoFBeq', 'customer', '2021-05-05 00:00:00', '2021-05-05 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `status`) VALUES
(7, 'Jacket', 1),
(8, 'Tee', 1),
(9, 'Backpack', 1),
(11, 'Sneaker', 1),
(12, 'Pants', 1),
(13, 'Bag', 1),
(14, 'Hat', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `total` float NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `account_id`, `status`, `phone`, `address`, `note`, `total`, `created_at`) VALUES
(39, 9, 3, '0865493620', 'a', 'OK', 107, '2021-05-13'),
(40, 9, 0, '0865493620', 'a', 'hi', 32, '2021-05-13'),
(41, 9, 3, '0865493620', 'a', 'Giao hang nhanh', 52, '2021-01-13'),
(42, 9, 2, '0865493620', 'a', 'as', 10, '2021-05-13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `account_id`, `product_id`, `category_id`) VALUES
(59, 39, 9, 11, 9),
(60, 39, 9, 12, 7),
(61, 39, 9, 13, 12),
(62, 39, 9, 13, 12),
(63, 39, 9, 12, 7),
(64, 39, 9, 12, 7),
(65, 40, 9, 11, 9),
(66, 40, 9, 13, 12),
(67, 41, 9, 13, 12),
(68, 41, 9, 18, 14),
(69, 41, 9, 14, 13),
(70, 41, 9, 13, 12),
(71, 42, 9, 19, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `price` float NOT NULL,
  `sale_price` float DEFAULT 0,
  `create_date` date DEFAULT curdate(),
  `description` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `status`, `price`, `sale_price`, `create_date`, `description`, `category_id`) VALUES
(10, 'Jacket 1', 'hfwth.jpg', 1, 25, 0, '2021-04-13', ' Jacket dep', 7),
(11, 'Backpack 1', 'backpack3.jpg', 0, 20, 17, '2021-04-13', ' ', 9),
(12, 'Jacket 2', 'jacket2.jpg', 0, 25, 20, '2021-04-13', ' ', 7),
(13, 'Pants1', 'paints.jpg', 0, 15, 0, '2021-04-13', 'Pants1 Dep', 12),
(14, 'Bag1 ', 'massagebag.jpg', 0, 15, 12, '2021-04-13', ' Bag1 Dep', 13),
(15, 'Pants2', 'pants3.jpg', 1, 20, 18, '2021-04-13', ' Pants 2 Dep', 12),
(17, 'Sneaker2 ', 'sneaker1.jpg', 1, 35, 32, '2021-04-13', ' Sneaker 2 Dep', 11),
(18, 'Hat1', 'mu.jpg', 0, 10, 0, '2021-04-13', 'Hat1 Dep', 14),
(19, 'Tee1', 'tee5.jpg', 0, 10, 0, '2021-04-13', 'Tee1 Dep', 8),
(20, 'Tee2', 'tee3.jpg', 1, 10, 0, '2021-04-13', 'Tee 2 Dep', 8),
(21, 'Tee 3 ', 'tee2.jpg', 1, 10, 0, '2021-04-13', 'Tee 3 Dep', 8);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
