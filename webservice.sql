-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2021 at 11:27 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `drink`
--

CREATE TABLE `drink` (
  `id_drink` int(2) NOT NULL,
  `nama_drink` varchar(20) NOT NULL,
  `harga_drink` int(5) NOT NULL,
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drink`
--

INSERT INTO `drink` (`id_drink`, `nama_drink`, `harga_drink`, `availability`) VALUES
(0, 'None', 0, 1),
(1, 'Mineral Water', 3000, 1),
(2, 'Fruit Punch', 10000, 1),
(3, 'Tea', 5000, 1),
(4, 'Hot Chocolate', 7000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, '123456', 1, 0, 0, '1', 1),
(2, 2, '78910', 1, 0, 0, '1', 1),
(3, 3, '13579', 1, 0, 0, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE `limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `limits`
--

INSERT INTO `limits` (`id`, `uri`, `count`, `hour_started`, `api_key`) VALUES
(1, 'uri:mahasiswa/index:get', 3, 1640099801, '123456'),
(2, 'method-name:index_get', 2, 1640100388, '123456'),
(3, 'api-key:123456', 2, 1640100803, '123456'),
(4, 'uri:mahasiswa/index:get', 3, 1640101148, '78910'),
(5, 'uri:toko/index:get', 2, 1640166552, '123456'),
(6, 'uri:toko/index:get', 2, 1640166644, '13579'),
(7, 'api-key:13579', 2, 1640166820, '13579'),
(8, 'uri:toko/package:get', 2, 1640168216, '13579'),
(9, 'uri:toko/index:post', 2, 1640168643, '13579'),
(10, 'uri:toko/index:delete', 2, 1640168725, '13579');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id_package` int(2) NOT NULL,
  `nama_package` varchar(20) NOT NULL,
  `harga_package` int(7) NOT NULL,
  `stok_package` int(2) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id_package`, `nama_package`, `harga_package`, `stok_package`, `detail`) VALUES
(1, 'Christmas', 150000, 5, '4 Blueberry Cupcake, 2 Cheesecake'),
(2, 'New Year', 175000, 10, '2 Choco Cupcake, 2 Blueberry Cupcake, 2 Cheesecake, 1 Opera Cake'),
(3, 'Special', 100000, 7, '1 Choco Cupcake, 1 Cheesecake, 3 Croffle, 2 Waffwich'),
(4, 'Valentine', 150000, 10, '2 Choco Cupcake, 2 Brownies, 2 Opera Cake');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(2) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `harga_produk` int(6) NOT NULL,
  `stok_produk` int(2) NOT NULL,
  `id_drink` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori`, `harga_produk`, `stok_produk`, `id_drink`) VALUES
(1, 'Choco Cupcake', 'Cupcake', 20000, 10, 1),
(2, 'Blueberry Cupcake', 'Cupcake', 25000, 5, 2),
(3, 'Cheesecake', 'Cake', 30000, 15, 2),
(4, 'Brownies', 'Cake', 30000, 5, 4),
(5, 'Croffle', 'Waffle', 10000, 20, 0),
(6, 'Waffwich', 'Waffle', 15000, 20, 1),
(7, 'Opera Cake', 'Cake', 35000, 3, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`id_drink`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id_package`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `limits`
--
ALTER TABLE `limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
