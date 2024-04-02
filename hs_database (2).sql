-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: 34.128.118.239
-- Generation Time: 02 Apr 2024 pada 07.44
-- Versi Server: 5.6.51-google-log
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hs_database`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `conversation_db`
--

CREATE TABLE `conversation_db` (
  `id_message` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_bengkel` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  `sender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `conversation_db`
--

INSERT INTO `conversation_db` (`id_message`, `id_user`, `id_bengkel`, `time`, `message`, `sender`) VALUES
(1, 0, 2, '2023-12-19 14:35:39', '4231234', 'user'),
(24, 6, 2, '2023-08-14 13:43:45', 'Halo kak', 'user'),
(25, 6, 2, '2023-08-14 13:44:00', 'Halo kak', 'bengkel'),
(26, 7, 2, '2023-08-15 03:30:03', 'Halo kak ', 'user'),
(27, 7, 2, '2023-08-15 03:30:27', 'Selamat siang kak', 'user'),
(28, 7, 2, '2023-08-15 03:30:39', 'Selamat siang juga kak', 'bengkel'),
(29, 1, 2, '2023-09-15 15:26:53', 'ss', 'user'),
(30, 1, 2, '2023-09-15 15:26:54', '123', 'user'),
(31, 1, 2, '2023-09-15 15:26:55', '321', 'user'),
(32, 1, 2, '2023-09-15 15:26:56', '4', 'user'),
(33, 1, 2, '2023-09-15 15:26:57', '125235', 'user'),
(34, 1, 2, '2023-09-15 15:26:58', '2351235', 'user'),
(35, 1, 2, '2023-09-15 15:34:19', '', 'user'),
(36, 1, 2, '2023-09-15 15:34:20', '', 'user'),
(37, 1, 2, '2023-09-15 15:34:21', '', 'user'),
(38, 1, 1, '2023-11-10 16:49:12', '12312', 'user'),
(39, 1, 1, '2023-11-10 16:49:20', 'zxczxc', 'user'),
(40, 1, 1, '2023-11-10 16:49:24', '444', 'user'),
(41, 1, 1, '2023-11-10 16:52:06', '123', 'bengkel'),
(42, 1, 1, '2023-11-10 16:52:50', '4234', 'bengkel'),
(43, 1, 1, '2023-11-10 16:52:53', 'Ricky', 'bengkel'),
(44, 1, 1, '2023-11-10 16:52:57', '12312341243', 'bengkel'),
(45, 1, 1, '2023-11-10 16:53:02', 'ASdawdasdasdawd', 'bengkel'),
(46, 1, 1, '2023-11-10 16:53:08', 'Rickyeeez', 'bengkel'),
(47, 1, 1, '2023-11-10 16:53:11', '1242', 'bengkel'),
(48, 1, 1, '2023-12-11 16:13:29', '443', 'bengkel'),
(49, 1, 1, '2023-12-11 16:13:32', '556666', 'bengkel'),
(50, 0, 2, '2023-12-19 14:36:20', '1234124', 'user'),
(51, 0, 2, '2023-12-19 14:36:22', '4124124', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nohp` varchar(11) NOT NULL,
  `status_order` varchar(25) NOT NULL DEFAULT 'inactive',
  `last_order_id` int(11) DEFAULT NULL,
  `status_buy_order` varchar(25) NOT NULL DEFAULT 'inactive',
  `buy_last_id` int(11) DEFAULT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `nama`, `username`, `password`, `nohp`, `status_order`, `last_order_id`, `status_buy_order`, `buy_last_id`, `auth_token`, `fcm_token`) VALUES
('', 'Rizal Fantofani', 'rizalfantofani29@gmail.com', '123', '08553632146', 'inactive', 0, 'inactive', 0, NULL, ''),
('7dJEW3UITHhIwSkSTH5HdegcTc13', 'Nadiyah Jihan Fauziyah', '', '', '', 'inactive', NULL, 'inactive', NULL, NULL, ''),
('7YKxJbGxbST52XYDSVDH1bFzsOe2', 'tes', '', '', '', 'inactive', 0, 'inactive', NULL, '62be5911-868e-48e4-865f-fb49d22c2f2c', 'dlpiN39xSfaeQAsuGyxUBy:APA91bHPGh6HtNSAnxnFJfJXdwEDOKD-5DRGNWGwEHOVH37tGmMKV6ttGRafuG5CuDeQ8tgCtXWPvrhzUmrpgNerYT19SRGCSbyFMRwtJilXlL_iAaFluK9uaHNdma7_xO4Gz5AjolLs'),
('8URszl5781brJ5ITxLCosEHEug63', 'Ricky Triyoga Wardhana', 'ricky', '', '', 'inactive', 0, 'inactive', NULL, '88774a0d-7e16-4ac0-aaa8-a05b48fc42ec', ''),
('bhxzqq0i1gcC0JhvGxoM8Dkbdpv1', 'Test Account', '', '', '', 'inactive', NULL, 'inactive', NULL, '79d581dc-24d7-4e69-a638-ea85147b7de0', 'dX79OIz0QsisCljVi2Mg7r:APA91bFjWlvJvYQgAleJehknN_VD2MIoWablLTGzfoQmxuTwI9AqccvkB-cfxt-Sr82pDwN6bedyi6O84TiroNWJwfn-Og68M8AcOZKTHumfhMefQ-EoMARYoil3TLaM-yxlYEqA7Sw7'),
('BPiJbrNVmQfkMtFwdkuUKlsnC8K2', 'Hahai', '', '', '', 'inactive', 0, 'inactive', NULL, 'bb94711a-cde6-4f00-8b44-1108eb328b4d', 'fAgFdFLeS6i6P1GQRl7Ip3:APA91bEwr3AG3z7EzQwamCFm9TO_V2430chR9A1EhO2ny5B4gGnwfK2N4LpZYxcPfup8M-jriFelA9kdl6B6Eeer8ex4QHmR-0f1DWOBthN9BvEKQtXb-O5djzDa2pBoJkKaVRipxdr8'),
('Nzf8u5stZMU8E8jgqc7v8x2rNl72', 'Rizal Fantofani', '', '', '', 'inactive', NULL, 'inactive', NULL, '9de9e083-62ae-4358-a74f-d94fc459639f', 'f8Xatm7HTYWs86azV6watK:APA91bFhKq9j5XYeEJiY6xGJTk63mn1OJD88JUb7yH1q5IX3MpomyIIxNNGnDtVVPnjzZhTm1qLyrLJBLVklhAkbibBh-h0uk41zb4I98QvrqbrqffUBSIPotpy2Jy2IJUhRgfliTuaS'),
('PMgaOBdKwjbksK9wNzVBYiI4jg82', 'Ahmad Jado', '', '', '', 'inactive', 0, 'inactive', NULL, 'ba891d87-ec11-4e31-b280-3da4eeae13dd', 'fn9Yg--rSRuogEbc0_2ArZ:APA91bH276RZ16Lw24I4BIT4ct12btBRriUUpV175Nq5cona2Gi-D3XbfJGB1WSr6g9lQjJQ97MSRxJ8xQBYQ_s8OImzKHiiCHpwy5_3DnStmnfAW16jH7bqoqyuydq_PjIq3N4OYXVT'),
('Rtl7liUfH1e3eyAN2eb5FuVBAfD3', 'Nadiyah Jihan Fauziyah', '', '', '', 'inactive', 0, 'inactive', NULL, '6babe1f8-bab9-4221-b9f0-79739c00bce3', 'enKrGCQQTmGe5XbYSqa1Vi:APA91bF7E5baA4D4eGXKTXkCP13QDVoHHsTjA6Z1KkS_OeEx61W_s6mK3Ic_Ehmooicw_KHJxEPv_kqgAwS0SYNHS_L5iP0ZGmjcyl2IRJnMYg5BrAWhKt9hpv-O1IulpNHmZDG4lF_4'),
('tAThEMZFHddqKtnfrWWEkT0sxbJ3', 'Ricky Triyoga', 'rickyeeez', 'ricky123', '', 'inactive', 0, '40', NULL, 'e6356431-5f18-4b49-9e2a-90e48976ac16', 'fn9Yg--rSRuogEbc0_2ArZ:APA91bH276RZ16Lw24I4BIT4ct12btBRriUUpV175Nq5cona2Gi-D3XbfJGB1WSr6g9lQjJQ97MSRxJ8xQBYQ_s8OImzKHiiCHpwy5_3DnStmnfAW16jH7bqoqyuydq_PjIq3N4OYXVT'),
('tPfrlo35tFOpbJbPhboXGe7mrR73', 'Ricky', '', '', '', 'inactive', 0, 'inactive', NULL, 'fb7330a6-e4c8-4e7f-99de-90af8e885710', 'dX79OIz0QsisCljVi2Mg7r:APA91bFjWlvJvYQgAleJehknN_VD2MIoWablLTGzfoQmxuTwI9AqccvkB-cfxt-Sr82pDwN6bedyi6O84TiroNWJwfn-Og68M8AcOZKTHumfhMefQ-EoMARYoil3TLaM-yxlYEqA7Sw7'),
('Wg019FTX9DRTZhVSEJFpwCnD2Z32', 'Ricky Triyoga Wardhana', '', '', '', 'inactive', 0, 'inactive', NULL, '25abcca1-aa6a-49b5-aa87-e6d049cf3df9', 'dX79OIz0QsisCljVi2Mg7r:APA91bFjWlvJvYQgAleJehknN_VD2MIoWablLTGzfoQmxuTwI9AqccvkB-cfxt-Sr82pDwN6bedyi6O84TiroNWJwfn-Og68M8AcOZKTHumfhMefQ-EoMARYoil3TLaM-yxlYEqA7Sw7'),
('z7M5RsYQx6Z1afk1zfvqqxr5ELj1', 'Test Account', '', '', '', 'inactive', 0, 'inactive', NULL, '29dd1ae3-7567-4c3d-9c01-9464a3e64123', 'dX79OIz0QsisCljVi2Mg7r:APA91bFjWlvJvYQgAleJehknN_VD2MIoWablLTGzfoQmxuTwI9AqccvkB-cfxt-Sr82pDwN6bedyi6O84TiroNWJwfn-Og68M8AcOZKTHumfhMefQ-EoMARYoil3TLaM-yxlYEqA7Sw7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_keluhan`
--

CREATE TABLE `data_keluhan` (
  `id_keluhan` int(11) NOT NULL,
  `text_keluhan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_keluhan`
--

INSERT INTO `data_keluhan` (`id_keluhan`, `text_keluhan`) VALUES
(72, 'Tidak bisa dinyalakan'),
(73, 'Mesin mengeluarkan bau'),
(74, 'Bunyi mesin aneh'),
(75, 'Bergetar tidak normal'),
(76, 'Motor panas berlebihan'),
(77, 'Mengeluarkan bunyi berdecit'),
(78, 'Rem tidak berfungsi'),
(79, 'Motor tersendat sendat'),
(80, 'Oli mengalami kebocoran'),
(81, 'Overheat pada mesin'),
(82, 'Warna asap putih'),
(83, 'Bunyi mesin aneh'),
(84, 'Motor berbunyi knocking'),
(85, 'Turunnya performa mesin'),
(86, 'Getaran tidak normal'),
(87, 'Keluar bercak oli'),
(88, 'Pengurangan level oli'),
(89, 'Kebocoran blok mesin'),
(90, 'Mesin tidak berfungsi'),
(91, 'Kondisi aki melemah'),
(92, 'Lampu indikator menyala'),
(93, 'Mesin sulit dihidupkan'),
(94, 'Stater berbunyi aneh'),
(95, 'Mesin mati mendadak'),
(96, 'Mesin bergetar kuat'),
(97, 'Getaran pada kemudi'),
(98, 'Berisik saat berkendara'),
(99, 'Warna asap hitam'),
(100, 'Bau asap aneh'),
(101, 'Mesin tidak berdaya'),
(102, 'Berbunyi saat mengerem'),
(103, 'Rem terasa licin'),
(104, 'Kecepatan rem melemah'),
(105, 'Terdapat gesekan gigi'),
(106, 'Sulit memindahkan gigi'),
(107, 'Transmisi berbunyi aneh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `description`
--

CREATE TABLE `description` (
  `id_description` varchar(11) NOT NULL DEFAULT '',
  `nama_bengkel` varchar(255) DEFAULT NULL,
  `alamat_bengkel` text,
  `jam_buka` varchar(50) DEFAULT NULL,
  `jam_tutup` varchar(255) NOT NULL,
  `url_gambar` varchar(255) DEFAULT NULL,
  `deskripsi_bengkel` text,
  `pemilik_bengkel` varchar(50) DEFAULT NULL,
  `jenis_bengkel` varchar(100) DEFAULT NULL,
  `nohp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `description`
--

INSERT INTO `description` (`id_description`, `nama_bengkel`, `alamat_bengkel`, `jam_buka`, `jam_tutup`, `url_gambar`, `deskripsi_bengkel`, `pemilik_bengkel`, `jenis_bengkel`, `nohp`) VALUES
('mitra1', 'Bengkel Aji Jaya', '3HPP+5C Mulyoagung, Malang Regency, East Java, Indonesia', '08:00', '20.00', 'https://imgcdn.solopos.com/@space/2023/05/bengkel-motor-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisi lacus sed viverra tellus in hac. Elementum nibh tellus molestie nunc non. Mattis enim ut tellus elementum sagittis. Viverra aliquet eget sit amet tellus cras adipiscing. Feugiat nisl pretium fusce id velit. Augue mauris augue neque gravida. Velit laoreet id donec ultrices.', 'Hadi', 'Bengkel Serbaguna', '6282131029815'),
('mitra2', 'Bengkel Nur Rohman', 'Jl. Raya Sengkaling No.225, Sengkaling, Mulyoagung, Kec. Dau, Kabupaten Malang, Jawa Timur 65151, Indonesia', '09:00', '21.00', 'https://imgx.gridoto.com/crop/0x0:0x0/700x465/filters:watermark(file/2017/gridoto/img/watermark.png,5,5,60)/photo/gridoto/2017/10/13/2370856391.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisi lacus sed viverra tellus in hac. Elementum nibh tellus molestie nunc non. Mattis enim ut tellus elementum sagittis. Viverra aliquet eget sit amet tellus cras adipiscing. Feugiat nisl pretium fusce id velit. Augue mauris augue neque gravida. Velit laoreet id donec ultrices.', 'Yanto', 'Bengkel Serba Ada', '6282131029815'),
('mitra3', 'Bengkel Nur Cahya', '2JHJ+X3 Samaan, Malang City, East Java, Indonesia', '12:00', '23.00', 'https://www.asuransiastra.com/wp-content/uploads/2022/06/Pilih-Bengkel-Motor-Resmi-atau-Non-Resmi-Ini-Perbedaannya.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisi lacus sed viverra tellus in hac. Elementum nibh tellus molestie nunc non. Mattis enim ut tellus elementum sagittis. Viverra aliquet eget sit amet tellus cras adipiscing. Feugiat nisl pretium fusce id velit. Augue mauris augue neque gravida. Velit laoreet id donec ultrices.', 'Purnomo', 'Bengkel Serba Serbi', '6282131029815');

-- --------------------------------------------------------

--
-- Struktur dari tabel `itemorder_status`
--

CREATE TABLE `itemorder_status` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_bengkel` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `shipping` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `itemorder_status`
--

INSERT INTO `itemorder_status` (`id_order`, `id_user`, `id_bengkel`, `status`, `shipping`, `waktu`, `lat`, `lng`, `address`) VALUES
(16, 6, 2, 'finished', 'delivery', '2023-08-14 13:43:12', -7.9206, 112.596, 'Jalan Tanpa Nama, Tlogomas, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144, Indonesia'),
(17, 7, 2, 'finished', 'delivery', '2023-08-15 03:29:32', -7.9206, 112.596, 'Jalan Tanpa Nama, Tlogomas, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144, Indonesia'),
(18, 1, 2, 'rejected', 'delivery', '2023-10-02 03:34:51', -7.9206, 112.596, 'Jalan Tanpa Nama, Tlogomas, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144, Indonesia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `itemsdb`
--

CREATE TABLE `itemsdb` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_bengkel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `itemsdb`
--

INSERT INTO `itemsdb` (`id_barang`, `nama_barang`, `qty`, `price`, `image`, `id_bengkel`) VALUES
(4, 'Busi Honda', 100, 30000, '1691609594_b0b79525848cc7a7f382.jpg', 2),
(6, 'Kampas Rem Depan', 22, 50000, '1691911308_e047aa701e3b5984f8c1.jpg', 2),
(11, 'Oli MPX', 12, 29000, '1691911829_145143f94ea7eb1527d7.jpg', 2),
(16, 'Kampas Rem', 10, 40000, '1703812512_d7e709f5697aa63a21ef.jpg', 1),
(17, 'Piringan Depan Supra X 125', 100, 40000, '1703812593_6b15870db2794e36aa46.jpg', 1),
(18, 'Komstir Supra', 10, 120000, '1703812678_419b4f256091f1f85afb.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_invoice`
--

CREATE TABLE `item_invoice` (
  `id_invoice` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `item_invoice`
--

INSERT INTO `item_invoice` (`id_invoice`, `id_barang`, `qty`, `id_order`) VALUES
(13, 6, 3, 16),
(14, 4, 1, 16),
(15, 11, 1, 16),
(16, 6, 1, 17),
(17, 4, 2, 17),
(18, 11, 2, 17),
(19, 6, 4, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `text_mark` varchar(255) NOT NULL,
  `lat` float NOT NULL,
  `long` float NOT NULL,
  `description_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `locations`
--

INSERT INTO `locations` (`id`, `text_mark`, `lat`, `long`, `description_id`) VALUES
(1, 'Bengkel Aji Jaya', -7.96781, 112.63, 'mitra1'),
(2, 'Bengkel Nur Rohman', -7.9145, 112.586, 'mitra2'),
(3, 'Bengkel Nur Cahya', -7.91359, 112.585, 'mitra3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderdb`
--

CREATE TABLE `orderdb` (
  `order_id` int(11) NOT NULL,
  `id_customer` varchar(255) NOT NULL,
  `id_location` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nohp` varchar(255) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `km_sebelum` varchar(255) DEFAULT NULL,
  `km_sesudah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orderdb`
--

INSERT INTO `orderdb` (`order_id`, `id_customer`, `id_location`, `deskripsi`, `waktu`, `nohp`, `lat`, `lng`, `address`, `status`, `alasan`, `km_sebelum`, `km_sesudah`) VALUES
(25, '6', 2, 'Motor saya tidak bisa nyala', '2023-08-14 13:41:00', '6282131029815', -7.93235, 112.579, 'Jalan Tanpa Nama, Dusun Klandungan, Landungsari, Kec. Dau, Kabupaten Malang, Jawa Timur 65151, Indonesia', 'finished', NULL, NULL, NULL),
(26, '7', 2, 'Motor saya mogok dan tidak bisa berjalan', '2023-08-15 03:27:34', '6282131029815', -7.9228, 112.579, 'Jl. Gotong Royong III No.9, Jetak Ngasri, Mulyoagung, Kec. Dau, Kabupaten Malang, Jawa Timur 65151, Indonesia', 'finished', NULL, NULL, NULL),
(27, '1', 2, '31233', '2023-10-31 05:38:05', '123123', -7.92038, 112.594, 'Jl. Raya Jetis No.11, Jetis, Mulyoagung, Kec. Dau, Kabupaten Malang, Jawa Timur 65151, Indonesia', 'finished', NULL, NULL, NULL),
(28, '1', 2, '123', '2023-11-10 16:49:00', '123123', -7.9206, 112.596, 'Jalan Tanpa Nama, Tlogomas, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144, Indonesia', 'rejected', NULL, NULL, NULL),
(30, '8URszl5781brJ5ITxLCosEHEug63', 1, 'Ricky Triyoga Wardhana', '2023-12-16 19:40:13', '123', 123, 123, '123', 'finished', NULL, NULL, NULL),
(31, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 2, '123', '2023-12-18 03:24:47', '1234', 37.4227, -122.085, '2020 Amphitheatre Pkwy, Mountain View, CA 94043, USA', 'finished', NULL, NULL, NULL),
(32, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, '12121212121233334431231231212312331233', '2023-12-18 04:22:04', '1233123', 37.4227, -122.085, '2020 Amphitheatre Pkwy, Mountain View, CA 94043, USA', 'canceled', NULL, NULL, NULL),
(33, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, 'Makanlah', '2023-12-18 07:26:16', '0921310298815', -7.98153, 112.581, '2H8J+HHP, Mulyorejo, Kec. Sukun, Kota Malang, Jawa Timur 65147, Indonesia', 'finished', NULL, NULL, NULL),
(34, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, '123,', '2023-12-18 09:45:21', '12', 37.4223, -122.087, 'Google Building 1950, Mountain View, CA 94043, USA', 'canceled', NULL, NULL, NULL),
(35, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, '123', '2023-12-18 10:06:57', '123', 37.4227, -122.085, '2020 Amphitheatre Pkwy, Mountain View, CA 94043, USA', 'canceled', NULL, NULL, NULL),
(36, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, '1111', '2023-12-18 10:09:27', '2222', 37.4227, -122.085, '2020 Amphitheatre Pkwy, Mountain View, CA 94043, USA', 'canceled', NULL, NULL, NULL),
(37, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, '123123', '2023-12-18 10:10:22', '12123', -1.85891, 122.01, 'Indonesia', 'canceled', NULL, NULL, NULL),
(38, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, '123', '2023-12-18 10:21:44', '123', 37.4227, -122.085, '2020 Amphitheatre Pkwy, Mountain View, CA 94043, USA', 'finished', NULL, NULL, NULL),
(39, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, '123', '2023-12-18 10:34:12', '1212', 37.4227, -122.085, '2020 Amphitheatre Pkwy, Mountain View, CA 94043, USA', 'canceled', NULL, NULL, NULL),
(40, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, '12', '2023-12-18 11:23:17', '234', -7.98363, 112.622, 'Tanjungrejo, Kec. Sukun, Kota Malang, Jawa Timur, Indonesia', 'finished', NULL, NULL, NULL),
(41, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 2, 'Malang', '2023-12-18 11:42:19', '0813340900999', -7.98372, 112.551, 'Jl. Wangkal No.39, RW.11, Wangkal, Dalisodo, Kec. Wagir, Kabupaten Malang, Jawa Timur 65158, Indonesia', 'finished', NULL, NULL, NULL),
(42, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 1, 'Motor revo saya tidak dapat berjalan', '2023-12-18 11:51:40', '082131029815', 37.4203, -122.08, '1489 Charleston Rd, Mountain View, CA 94043, USA', 'canceled', NULL, NULL, NULL),
(43, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', 2, '123', '2023-12-18 11:53:39', '123', 37.4227, -122.085, '2020 Amphitheatre Pkwy, Mountain View, CA 94043, USA', 'finished', NULL, NULL, NULL),
(44, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 1, 'Our Apps', '2023-12-18 12:08:37', '082131029815', 37.4267, -122.068, 'NASA Ames Research Center Boundary, Mountain View, CA 94043, USA', 'finished', NULL, NULL, NULL),
(45, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 1, 'Motor saya rusak', '2023-12-18 12:39:22', '082131029815', -8.05308, 112.691, 'WMWR+82V, Sidomakmur, Ngawonggo, Kec. Tajinan, Kabupaten Malang, Jawa Timur 65172, Indonesia', 'finished', NULL, NULL, NULL),
(46, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 1, 'Dash', '2023-12-18 13:12:25', 'TRest', -8.01314, 112.552, 'Jalan Tanpa Nama, Sumberpang Lor, Sumbersuko, Kec. Wagir, Kabupaten Malang, Jawa Timur 65158, Indonesia', 'finished', NULL, NULL, NULL),
(47, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 1, '21341243', '2023-12-18 16:02:24', '1243124', 37.4211, -122.079, '292 N Shoreline Blvd, Mountain View, CA 94043, USA', 'canceled', NULL, NULL, NULL),
(48, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 1, 'Sengkaling', '2023-12-18 16:06:15', '082131029815', -7.93071, 112.578, 'Jalan Pelabuhan Bakahuni No.38, Dusun Klandungan, Bakalankrajan, Kec. Sukun, Kota Malang, Jawa Timur 65148, Indonesia', 'finished', NULL, NULL, NULL),
(49, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 2, '90409841243', '2023-12-18 16:26:06', '082131029815', -7.79651, 112.537, '6G4P+CHM, Tulungrejo, Kec. Bumiaji, Kota Batu, Jawa Timur 65335, Indonesia', 'rejected', NULL, NULL, NULL),
(50, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 1, 'Detail', '2023-12-19 08:09:08', '123', 37.4227, -122.085, '2020 Amphitheatre Pkwy, Mountain View, CA 94043, USA', 'canceled', NULL, NULL, NULL),
(51, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 1, 'Makanan	', '2023-12-19 08:13:32', '12341243', 37.4227, -122.085, '2020 Amphitheatre Pkwy, Mountain View, CA 94043, USA', 'finished', NULL, '24000', '24000'),
(52, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, 'Bangga', '2023-12-19 12:57:01', '124', -7.93696, 112.62, 'Jl. Candi Panggung No.49B, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur 65142, Indonesia', 'canceled', NULL, NULL, NULL),
(53, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, '123', '2023-12-19 12:58:05', '123', -8.00504, 112.606, 'Jl. Perum Grand Samawa No.15, Bakalankrajan, Kec. Sukun, Kota Malang, Jawa Timur 65148, Indonesia', 'finished', NULL, '4000', '4000'),
(54, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, '123', '2023-12-19 13:02:57', '123', -7.95908, 112.595, '2HRV+6VH, Doro, Karangwidoro, Kec. Dau, Kabupaten Malang, Jawa Timur 65151, Indonesia', 'finished', NULL, '5000', '7000'),
(55, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, 'qwe', '2023-12-19 13:30:27', 'qwe', -7.96177, 112.614, 'Gg. VII No.3, Sumbersari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145, Indonesia', 'finished', NULL, '4444', '4444'),
(56, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, 'Helllo', '2023-12-19 14:39:50', '12343', -7.93731, 112.619, '3J79+4PH, Jl. Candi Panggung, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur, Indonesia', 'canceled', NULL, NULL, NULL),
(57, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, '222', '2023-12-20 05:51:27', '3333', -7.96826, 112.652, 'Jl. Negara Barat No.1, Bunulrejo, Kec. Blimbing, Kota Malang, Jawa Timur 65126, Indonesia', 'canceled', NULL, NULL, NULL),
(58, '7YKxJbGxbST52XYDSVDH1bFzsOe2', 1, '', '2023-12-20 08:41:09', '', -7.92106, 112.599, 'Jl. Karyawiguna No.519a, Babatan, Tegalgondo, Kec. Karang Ploso, Kabupaten Malang, Jawa Timur 65152, Indonesia', 'finished', NULL, '4000', '90000'),
(59, '7YKxJbGxbST52XYDSVDH1bFzsOe2', 1, '', '2023-12-28 15:49:15', '', -7.93407, 112.61, 'Jl. Kenanga Indah 1 No.26b, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141, Indonesia', 'canceled', NULL, NULL, NULL),
(60, 'BPiJbrNVmQfkMtFwdkuUKlsnC8K2', 1, 'Mock', '2023-12-20 08:46:11', '08313111', -7.9208, 112.592, '3HHR+MRH, Jetis, Mulyoagung, Kec. Dau, Kabupaten Malang, Jawa Timur 65151, Indonesia', 'rejected', NULL, NULL, NULL),
(61, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, 'Investor', '2023-12-20 15:32:42', '082131029815', -8.05105, 112.567, 'WHX8+465, Jl. Blau Utara, Lowok, Permanu, Kec. Pakisaji, Kabupaten Malang, Jawa Timur 65164, Indonesia', 'finished', NULL, '4000', '6000'),
(62, 'BPiJbrNVmQfkMtFwdkuUKlsnC8K2', 1, 'tgyvh h', '2023-12-21 01:27:15', '038373736', -7.921, 112.599, 'Jl. Karyawiguna No.519a, Babatan, Tegalgondo, Kec. Karang Ploso, Kabupaten Malang, Jawa Timur 65152, Indonesia', 'finished', NULL, '4000', '6000'),
(63, 'z7M5RsYQx6Z1afk1zfvqqxr5ELj1', 1, 'Test Permasalahan', '2023-12-21 15:27:54', '082131029815', -7.94903, 112.582, 'E4 No, Jl. Villa Bukit Tidar No.150, Jenglong, Karangbesuki, Kec. Sukun, Kota Malang, Jawa Timur 65151, Indonesia', 'finished', NULL, '8000', '12000'),
(64, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 1, 'Test ', '2023-12-21 15:34:21', '081335900999', -7.93981, 112.596, 'Jl. Kanjuruhan No.40, Tlogomas, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144, Indonesia', 'finished', NULL, '7000', '10000'),
(65, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, '', '2023-12-21 15:40:58', '', -7.98371, 112.621, 'Gg. Papat, Tanjungrejo, Kec. Sukun, Kota Malang, Jawa Timur 65147, Indonesia', 'finished', NULL, '5000', '7000'),
(66, 'Rtl7liUfH1e3eyAN2eb5FuVBAfD3', 1, 'motor mogok bro', '2023-12-23 07:28:52', '082122978328', -7.95273, 112.6, '2HWX+RQP, Karangbesuki, Kec. Sukun, Kota Malang, Jawa Timur 65149, Indonesia', 'canceled', NULL, NULL, NULL),
(67, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, 'Test', '2023-12-28 11:41:56', 'Test', -7.86976, 112.606, 'Jalan Tanpa Nama, Sawah, Ngenep, Kec. Karang Ploso, Kabupaten Malang, Jawa Timur 65152, Indonesia', 'canceled', NULL, NULL, NULL),
(68, 'tPfrlo35tFOpbJbPhboXGe7mrR73', 1, 'Test', '2023-12-28 11:45:51', '092', -7.96742, 112.63, '2JJJ+X4F, Jl. Brigjend Slamet Riadi, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa Timur 65119, Indonesia', 'canceled', NULL, NULL, NULL),
(69, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 1, '', '2023-12-28 12:08:56', '', -7.92494, 112.61, 'Perumahan Jl. Grand Arumba No.5, Tunggulwulung, Kec. Lowokwaru, Kota Malang, Jawa Timur 65143, Indonesia', 'canceled', NULL, NULL, NULL),
(70, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 1, 'Test', '2023-12-29 01:32:33', '0851103123123', -7.92495, 112.61, 'Blk. F-G No.10, Tunggulwulung, Kec. Lowokwaru, Kota Malang, Jawa Timur 65143, Indonesia', 'finished', NULL, '4000', '7000'),
(71, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 1, '', '2023-12-29 01:35:05', '', -7.92493, 112.61, 'Perumahan Jl. Grand Arumba No.5, Tunggulwulung, Kec. Lowokwaru, Kota Malang, Jawa Timur 65143, Indonesia', 'finished', NULL, '4000', '7000'),
(72, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 1, 'Test', '2023-12-29 01:55:06', '0821310298815', -7.92492, 112.61, 'Blk. F-G No.10, Tunggulwulung, Kec. Lowokwaru, Kota Malang, Jawa Timur 65143, Indonesia', 'finished', NULL, '4000', '7000'),
(73, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 1, 'Test', '2023-12-29 02:19:45', '082131', -7.92501, 112.61, 'Blk. F-G No.f12, Tunggulwulung, Kec. Lowokwaru, Kota Malang, Jawa Timur 65143, Indonesia', 'finished', NULL, '4000', '7000'),
(74, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 1, 'Test', '2023-12-29 03:50:23', '', -7.99719, 112.467, 'Area Hutan, Ampelgading, Kec. Selorejo, Kabupaten Blitar, Jawa Timur, Indonesia', 'finished', NULL, '4000', '5000'),
(75, 'BPiJbrNVmQfkMtFwdkuUKlsnC8K2', 2, 'motor tidak bisa distater', '2024-01-02 08:14:07', '081212309320', -7.92132, 112.599, 'Jl. Karyawiguna No.529, Babatan, Tegalgondo, Kec. Karang Ploso, Kabupaten Malang, Jawa Timur 65152, Indonesia', 'finished', NULL, '4000', '5000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_chat`
--

CREATE TABLE `order_chat` (
  `id_chat` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `sender` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order_chat`
--

INSERT INTO `order_chat` (`id_chat`, `order_id`, `message`, `sender`, `waktu`) VALUES
(1, 31, '1weqwe', 0, '2023-12-18 13:46:44'),
(2, 32, '1244312343', 0, '2023-12-18 13:54:02'),
(3, 33, '1244312343', 0, '2023-12-18 13:54:08'),
(4, 31, '1234234', 0, '2023-12-18 14:01:26'),
(5, 31, '1234234', 0, '2023-12-18 14:03:06'),
(6, 31, 'Halo kak', 0, '2023-12-18 14:03:15'),
(7, 46, '1422341234', 0, '2023-12-18 14:06:53'),
(8, 46, '551235', 0, '2023-12-18 14:06:55'),
(9, 46, 'ghawdasdawd', 1, '2023-12-18 14:19:12'),
(10, 47, 'hello', 0, '2023-12-18 15:37:56'),
(11, 47, 'Hello', 0, '2023-12-18 15:38:08'),
(12, 47, 'Hallo kak', 0, '2023-12-18 15:38:19'),
(13, 47, 'Selamat sore', 0, '2023-12-18 15:38:26'),
(14, 47, 'Ada yang bisa dibantu?', 0, '2023-12-18 15:38:48'),
(15, 47, 'asdfsadfasdfasdfasdfasdfasdfasdf', 1, '2023-12-18 15:39:31'),
(16, 47, '12341241234', 0, '2023-12-18 15:44:11'),
(17, 47, '123512335', 0, '2023-12-18 15:44:21'),
(18, 47, '16614543', 0, '2023-12-18 15:44:25'),
(19, 47, '3461345145', 0, '2023-12-18 15:44:29'),
(20, 47, '3521241243', 0, '2023-12-18 15:44:33'),
(21, 47, 'Malammm', 0, '2023-12-18 15:44:58'),
(22, 47, 'maAMSDMasd', 0, '2023-12-18 15:45:05'),
(23, 47, '213412334', 0, '2023-12-18 15:45:09'),
(24, 47, '1234', 0, '2023-12-18 15:46:31'),
(25, 47, '123412343', 0, '2023-12-18 15:52:29'),
(26, 47, '5135123534', 0, '2023-12-18 15:52:34'),
(27, 47, 'asdfasdfasdfasdf', 0, '2023-12-18 15:52:38'),
(28, 47, '123512345', 0, '2023-12-18 15:58:29'),
(29, 47, '`24`124', 0, '2023-12-18 15:58:33'),
(30, 47, '124512345', 0, '2023-12-18 15:58:35'),
(31, 47, '12341231243', 0, '2023-12-18 15:58:37'),
(32, 47, 'asdfasdfasdf', 0, '2023-12-18 15:58:39'),
(33, 47, '12341234', 0, '2023-12-18 15:58:42'),
(34, 47, 'Iya kak ada yang bisa dibantu?', 0, '2023-12-18 15:59:08'),
(35, 51, 'halo kak', 0, '2023-12-19 08:11:26'),
(36, 52, 'Halo kak', 1, '2023-12-19 12:08:34'),
(37, 52, 'Halo kak', 1, '2023-12-19 12:08:52'),
(38, 52, 'Halo kak', 1, '2023-12-19 12:08:53'),
(39, 52, 'Halo kak', 1, '2023-12-19 12:08:53'),
(40, 52, 'Halo kak', 1, '2023-12-19 12:08:54'),
(41, 52, 'Halo kak', 1, '2023-12-19 12:09:10'),
(42, 52, '1234124', 1, '2023-12-19 12:13:50'),
(43, 52, 'Halo kak mau tanya , ini semisal ada permasalahan saya bagaimana caranya untuk mengatasinya ya?', 1, '2023-12-19 12:14:11'),
(44, 52, '', 1, '2023-12-19 12:14:24'),
(45, 52, 'Susahhh', 1, '2023-12-19 12:15:49'),
(46, 52, 'susah', 1, '2023-12-19 12:15:53'),
(47, 52, 'susah', 1, '2023-12-19 12:15:55'),
(48, 52, 'viewModel.sendDataChat()', 1, '2023-12-19 12:15:57'),
(49, 52, '1212', 1, '2023-12-19 12:15:59'),
(50, 52, '1234123431234', 1, '2023-12-19 12:16:01'),
(51, 52, '1212123', 1, '2023-12-19 12:34:38'),
(52, 56, '121', 1, '2023-12-19 14:28:38'),
(53, 56, '12312', 0, '2023-12-19 14:28:46'),
(54, 56, 'Daryl babik', 1, '2023-12-19 14:28:59'),
(55, 56, '12341234', 1, '2023-12-19 14:29:33'),
(56, 56, 'Daaryl jelek', 0, '2023-12-19 14:29:51'),
(57, 56, '1234', 1, '2023-12-19 14:32:55'),
(58, 56, '123', 0, '2023-12-19 14:33:36'),
(59, 59, 'cuy', 1, '2023-12-20 08:45:47'),
(60, 61, 'Halo kak', 1, '2023-12-20 15:31:22'),
(61, 61, 'Bang cepetan', 1, '2023-12-20 15:32:04'),
(62, 61, 'Y', 0, '2023-12-20 15:32:08'),
(63, 61, 'Apaasih l u bang', 1, '2023-12-20 15:32:17'),
(64, 61, 'Kontol', 0, '2023-12-20 15:32:22'),
(65, 62, 'Dhoni anjg', 0, '2023-12-21 01:26:38'),
(66, 62, 'ghhhhd', 1, '2023-12-21 01:26:58'),
(67, 63, 'hello', 1, '2023-12-21 15:26:53'),
(68, 63, 'halo kak ada yang bisa dibantu?', 0, '2023-12-21 15:27:04'),
(69, 63, 'hello', 0, '2023-12-21 15:27:18'),
(70, 63, 'iiya kak', 1, '2023-12-21 15:27:24'),
(71, 64, 'Halo kakk', 0, '2023-12-21 15:33:39'),
(72, 64, 'halo juga kak', 1, '2023-12-21 15:33:45'),
(73, 64, 'saya butuh bantuan', 1, '2023-12-21 15:33:55'),
(74, 65, '123', 1, '2023-12-21 15:40:34'),
(75, 70, 'Hello', 0, '2023-12-29 01:31:47'),
(76, 70, 'Hello kak', 1, '2023-12-29 01:31:52'),
(77, 72, 'Hello', 0, '2023-12-29 01:54:40'),
(78, 73, 'Test', 1, '2023-12-29 02:19:25'),
(79, 74, 'halo', 0, '2023-12-29 03:50:03'),
(80, 75, 'ada gila gilanya', 1, '2024-01-02 08:11:52'),
(81, 75, 'Hahaha', 0, '2024-01-02 08:11:57'),
(82, 75, 'Haiiii', 0, '2024-01-02 08:12:21'),
(83, 75, '$#$4_##_', 1, '2024-01-02 08:12:31'),
(84, 75, 'Haiiiii', 0, '2024-01-02 08:12:32'),
(85, 75, 't______t', 1, '2024-01-02 08:12:44'),
(86, 75, '????✌????✌✌✌', 1, '2024-01-02 08:12:49'),
(87, 75, 'P Info', 0, '2024-01-02 08:12:55'),
(88, 75, '????????✌????????????????????', 1, '2024-01-02 08:13:01'),
(89, 75, '✌✌✌✌', 1, '2024-01-02 08:13:07'),
(90, 75, '????????????????', 1, '2024-01-02 08:13:11'),
(91, 75, 'gemashh sekali sayangnya akuu', 1, '2024-01-02 08:13:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `partnersdb`
--

CREATE TABLE `partnersdb` (
  `id_partner` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `partnersdb`
--

INSERT INTO `partnersdb` (`id_partner`, `username`, `password`, `location_id`) VALUES
(1, 'bengkel1', 'bengkel1', 1),
(2, 'bengkelpelitaharapan', 'bengkelph', 2),
(3, 'bengkel3', 'bengkel3', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `id_bengkel` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `statement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`id_rating`, `rating`, `id_bengkel`, `user_id`, `statement`) VALUES
(2, 4, 1, '1', 'Halo'),
(3, 3, 1, '1', 'Mantap'),
(4, 5, 1, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', '123123'),
(5, 5, 2, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', ''),
(6, 0, 2, 'tAThEMZFHddqKtnfrWWEkT0sxbJ3', ''),
(7, 5, 1, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 'HyBot'),
(8, 5, 1, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 'Bengkel bagus'),
(9, 5, 1, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', '123'),
(10, 5, 1, 'PMgaOBdKwjbksK9wNzVBYiI4jg82', 'Pelayanan mantap'),
(11, 5, 1, 'tPfrlo35tFOpbJbPhboXGe7mrR73', ''),
(12, 5, 1, 'tPfrlo35tFOpbJbPhboXGe7mrR73', '12343'),
(13, 5, 1, 'tPfrlo35tFOpbJbPhboXGe7mrR73', '123123'),
(14, 5, 1, '7YKxJbGxbST52XYDSVDH1bFzsOe2', 'bagusss'),
(15, 5, 1, 'tPfrlo35tFOpbJbPhboXGe7mrR73', '123123'),
(16, 5, 1, 'tPfrlo35tFOpbJbPhboXGe7mrR73', '123123'),
(17, 5, 1, 'BPiJbrNVmQfkMtFwdkuUKlsnC8K2', 'yhh'),
(18, 5, 1, 'z7M5RsYQx6Z1afk1zfvqqxr5ELj1', 'Rating mantap'),
(19, 5, 1, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 'Mantap'),
(20, 5, 1, 'tPfrlo35tFOpbJbPhboXGe7mrR73', ''),
(21, 5, 1, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', '1233'),
(22, 5, 1, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', ''),
(23, 5, 1, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 'Test'),
(24, 5, 1, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', 'Mantap'),
(25, 5, 1, 'Wg019FTX9DRTZhVSEJFpwCnD2Z32', ''),
(26, 1, 2, 'BPiJbrNVmQfkMtFwdkuUKlsnC8K2', 'ok');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversation_db`
--
ALTER TABLE `conversation_db`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_keluhan`
--
ALTER TABLE `data_keluhan`
  ADD PRIMARY KEY (`id_keluhan`);

--
-- Indexes for table `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`id_description`);

--
-- Indexes for table `itemorder_status`
--
ALTER TABLE `itemorder_status`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `itemsdb`
--
ALTER TABLE `itemsdb`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `item_invoice`
--
ALTER TABLE `item_invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdb`
--
ALTER TABLE `orderdb`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_chat`
--
ALTER TABLE `order_chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `partnersdb`
--
ALTER TABLE `partnersdb`
  ADD PRIMARY KEY (`id_partner`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversation_db`
--
ALTER TABLE `conversation_db`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `data_keluhan`
--
ALTER TABLE `data_keluhan`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `itemsdb`
--
ALTER TABLE `itemsdb`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `orderdb`
--
ALTER TABLE `orderdb`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `order_chat`
--
ALTER TABLE `order_chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
