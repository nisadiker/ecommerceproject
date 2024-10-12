-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 06 Haz 2024, 22:43:12
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `test`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_surname` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_surname`, `admin_username`, `admin_pass`, `admin_status`) VALUES
(21, 'nisa', 'diker', 'dikernisa', '1', 1),
(4, 'nisa', 'diker', 'sadsa', '', 1),
(5, 'nisa', 'diker', 'asasdsd', '12121212', 1),
(6, 'nisa', 'diker', 'dsadasdasd', '213123', 1),
(7, 'nisaaaa', 'dikerrrr', 'ddsaksadkasd', '292149241', 1),
(9, 'saiddoosado', 'sdadaafs', 'dsaöda', '214124', 1),
(23, 'nisaaa', 'dikerrr', 'nissa', '123', 1),
(12, 'aaa', 'aasassa', 'adada', '1233', 1),
(17, 'nisa', 'diker', 'nisadiker', '123123', 1),
(16, 'berk ', 'hoca', 'berkhoca', '121212', 1),
(22, 'Yasin ', 'DİKER', 'angaralı', '1234', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category_table`
--

CREATE TABLE `category_table` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `category_table`
--

INSERT INTO `category_table` (`category_id`, `category_name`, `category_order`) VALUES
(2, 'T-SHIRT', 2),
(3, 'DRESS', 2),
(5, 'JEANS', 4),
(11, 'ELBİSE', 2),
(12, 'BLUZ', 3),
(13, 'GÖMLEK', 4),
(14, 'ETEK', 5),
(15, 'PANTALON', 6),
(16, 'YELEK', 8),
(17, 'HIRKA', 10),
(18, 'MONT', 22);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer_table`
--

CREATE TABLE `customer_table` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_surname` varchar(255) NOT NULL,
  `customer_username` varchar(255) NOT NULL,
  `customer_pass` varchar(255) NOT NULL,
  `customer_status` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `customer_table`
--

INSERT INTO `customer_table` (`customer_id`, `customer_name`, `customer_surname`, `customer_username`, `customer_pass`, `customer_status`) VALUES
(1, 'asd', 'asdf', 'aasdfg', '123', 'Active'),
(2, 'asd', 'asdf', 'asdf', '1234', 'Active'),
(3, 'nisa', 'diker', 'dikernisa', '11', 'Active');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_table`
--

CREATE TABLE `order_table` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_address` varchar(5000) NOT NULL,
  `cargo_no` int(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  `size` varchar(20) NOT NULL,
  `order_status` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `order_table`
--

INSERT INTO `order_table` (`order_id`, `product_id`, `customer_id`, `order_address`, `cargo_no`, `color`, `size`, `order_status`) VALUES
(1, 13, 1, 'asdsada', 1234, 'white', 'M', 'in cargo'),
(2, 13, 1, 'asdsadasdafkgjdsklfdaşdk', 1717617593, 'white', 'S', 'order received'),
(3, 14, 2, 'dsfghjklşlkjghfgdfs', 1717624633, 'white', 'M', 'canceled'),
(4, 15, 1234, 'order_address', 1717705513, 'Red', 'M', 'Order Received'),
(5, 15, 1234, 'order_address', 1717705656, 'Red', 'M', 'Order Received'),
(6, 15, 1234, 'order_address', 1717705656, 'Red', 'M', 'Order Received'),
(7, 15, 1234, 'order_address', 1717705656, 'Red', 'M', 'Order Received'),
(8, 15, 1234, 'order_address', 1717705718, 'Red', 'M', 'order received'),
(9, 15, 1234, 'order_address', 1717705718, 'Red', 'M', 'order received'),
(10, 15, 1234, 'order_address', 1717705718, 'Red', 'M', 'order received'),
(11, 15, 1234, 'ankara ', 1717705853, 'Red', 'M', 'order received'),
(12, 15, 1234, 'ankara majabapa', 1717705882, 'Red', 'M', 'order received');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_table`
--

CREATE TABLE `product_table` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_details` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `product_table`
--

INSERT INTO `product_table` (`product_id`, `category_id`, `product_name`, `product_details`, `product_price`, `product_stock`, `product_image_path`) VALUES
(15, 2, 'deneme', '1', 1, 1, 'uploads/fotofot2.jpeg'),
(16, 14, 'Siyah Pileli Etek', 'Siyah renkte', 140, 12, 'uploads/pileli-mini-holger-etek-17038-etek-mooi-butik-35331-82-B.jpg'),
(17, 2, 'Yeşil T-shirt', 'yeşil', 123, 1234, 'uploads/images-2.jpeg'),
(18, 11, 'Straplez Elbise', 'elbise', 8383, 34134, 'uploads/straplez-kesim-kollari-tul-darell-elbise-5362-elbise-mooi-butik-32846-44-B.jpg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`) USING HASH,
  ADD KEY `admin_status` (`admin_status`);

--
-- Tablo için indeksler `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`category_id`);

--
-- Tablo için indeksler `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`customer_id`);

--
-- Tablo için indeksler `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`order_id`);

--
-- Tablo için indeksler `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`product_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `category_table`
--
ALTER TABLE `category_table`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `order_table`
--
ALTER TABLE `order_table`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `product_table`
--
ALTER TABLE `product_table`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
