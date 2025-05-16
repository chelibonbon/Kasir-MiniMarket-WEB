-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 02:41 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasirmm`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `harga_satuan` int(50) NOT NULL,
  `stok` int(50) NOT NULL,
  `status` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `jenis_barang`, `harga_satuan`, `stok`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(3, '001', 'roti', 'makanan', 5000, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '002', 'sabun', 'alat', 8000, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '003', 'botol aqua', 'minuman', 2000, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '004', 'gandum', 'tanaman', 9000, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '007', 'apel', 'buah', 10000, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '005', 'coca cola', 'minuman', 4000, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '009', 'milo', 'minuman', 6000, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '010', 'jamur merah', 'tanaman', 12000, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '013', 'sprite', 'minuman', 3000, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '015', 'oreo', 'snack', 12000, 6, NULL, '2025-03-17 07:28:55', NULL, NULL, 'sim', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(50) NOT NULL,
  `id_user` int(50) NOT NULL,
  `nama_kasir` varchar(255) NOT NULL,
  `nik` int(50) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `id_user`, `nama_kasir`, `nik`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(6, 12, 'sim', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 13, 'derius', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 14, 'chloe', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 15, 'ss', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 16, 'lumi', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 17, 'RPL', 2, 0, NULL, NULL, '2025-04-06 03:38:24', NULL, NULL, 'chichi'),
(17, 26, 'rpl', 2312, NULL, '2025-04-06 03:39:14', NULL, NULL, 'chichi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `activity` text NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id`, `waktu`, `date`, `nama_user`, `username`, `activity`, `ip_address`) VALUES
(99, '2025-03-12 15:26:54', '2025-03-12', 'Guest', 'guest', 'Failed login attempt for ', '180.242.194.10'),
(100, '2025-03-12 15:27:10', '2025-03-12', 'Guest', 'guest', 'Failed login attempt for ', '180.242.194.10'),
(101, '2025-03-13 02:07:06', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica successfully logged in', '36.77.4.52'),
(102, '2025-03-13 02:07:10', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(103, '2025-03-13 02:13:16', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica deleted barang with ID \'9\'', '36.77.4.52'),
(104, '2025-03-13 02:13:40', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica restored barang with ID \'9\'', '36.77.4.52'),
(105, '2025-03-13 02:14:06', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited log activity', '36.77.4.52'),
(106, '2025-03-13 02:15:28', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(107, '2025-03-13 02:15:50', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(108, '2025-03-13 02:18:33', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(109, '2025-03-13 02:18:43', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(110, '2025-03-13 02:18:54', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(111, '2025-03-13 02:19:13', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited laporan transaksi', '36.77.4.52'),
(112, '2025-03-13 02:19:21', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(113, '2025-03-13 02:19:32', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica logged out', '36.77.4.52'),
(114, '2025-03-13 02:21:44', '2025-03-13', 'Guest', 'guest', 'Failed login attempt', '36.77.4.52'),
(115, '2025-03-13 02:23:32', '2025-03-13', 'Guest', 'guest', 'Failed login attempt', '36.77.4.52'),
(116, '2025-03-13 02:23:56', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica successfully logged in', '36.77.4.52'),
(117, '2025-03-13 02:24:07', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(118, '2025-03-13 02:27:04', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(119, '2025-03-13 02:27:23', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited log activity', '36.77.4.52'),
(120, '2025-03-13 02:28:15', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited transaksi', '36.77.4.52'),
(121, '2025-03-13 02:29:05', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica edit \'ss@\' to user', '36.77.4.52'),
(122, '2025-03-13 02:29:07', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica edit \'ss\' to kasir', '36.77.4.52'),
(123, '2025-03-13 02:30:52', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica edit \'ss@\' to user', '36.77.4.52'),
(124, '2025-03-13 02:30:52', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica edit \'ss\' to kasir', '36.77.4.52'),
(125, '2025-03-13 02:31:13', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica edit \'lumi@\' to user', '36.77.4.52'),
(126, '2025-03-13 02:31:18', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica edit \'lumi\' to kasir', '36.77.4.52'),
(127, '2025-03-13 02:31:50', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica logged out', '36.77.4.52'),
(128, '2025-03-13 02:32:20', '2025-03-13', 'Guest', 'guest', 'Failed login attempt', '36.77.4.52'),
(129, '2025-03-13 02:33:00', '2025-03-13', 'Guest', 'guest', 'Failed login attempt', '36.77.4.52'),
(130, '2025-03-13 02:34:28', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica successfully logged in', '36.77.4.52'),
(131, '2025-03-13 02:34:32', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.77.4.52'),
(132, '2025-03-13 02:37:35', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ka@sir\' to user', '36.77.4.52'),
(133, '2025-03-13 02:37:35', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica successfully added \'RPL\' to kasir', '36.77.4.52'),
(134, '2025-03-13 02:37:46', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica Visited log activity', '36.77.4.52'),
(135, '2025-03-13 02:38:01', '2025-03-13', 'chelsica', 's.a@dmin', 'chelsica logged out', '36.77.4.52'),
(136, '2025-03-13 02:38:14', '2025-03-13', 'RPL', 'ka@sir', 'RPL successfully logged in', '36.77.4.52'),
(137, '2025-03-13 02:38:16', '2025-03-13', 'RPL', 'ka@sir', 'RPL Visited dashboard', '36.77.4.52'),
(138, '2025-03-13 02:38:33', '2025-03-13', 'RPL', 'ka@sir', 'RPL Visited transaksi', '36.77.4.52'),
(139, '2025-03-13 02:39:08', '2025-03-13', 'RPL', 'ka@sir', 'RPL successfully added \'sprite\' to barang', '36.77.4.52'),
(140, '2025-03-13 02:39:17', '2025-03-13', 'RPL', 'ka@sir', 'RPL Visited transaksi', '36.77.4.52'),
(141, '2025-03-13 02:39:35', '2025-03-13', 'RPL', 'ka@sir', 'RPL made transaction \'001\' to nota and transaksi', '36.77.4.52'),
(142, '2025-03-13 02:39:39', '2025-03-13', 'RPL', 'ka@sir', 'RPL printed nota \'001\'', '36.77.4.52'),
(143, '2025-03-13 02:40:38', '2025-03-13', 'RPL', 'ka@sir', 'RPL printed back nota \'92\'', '36.77.4.52'),
(144, '2025-03-13 02:41:10', '2025-03-13', 'RPL', 'ka@sir', 'RPL printed back nota \'89\'', '36.77.4.52'),
(145, '2025-03-13 02:41:15', '2025-03-13', 'RPL', 'ka@sir', 'RPL Visited transaksi', '36.77.4.52'),
(146, '2025-03-13 02:41:19', '2025-03-13', 'RPL', 'ka@sir', 'RPL printed back nota \'90\'', '36.77.4.52'),
(147, '2025-03-16 11:14:21', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica successfully logged in', '180.242.192.178'),
(148, '2025-03-16 11:14:25', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '180.242.192.178'),
(149, '2025-03-16 11:14:38', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica Visited transaksi', '180.242.192.178'),
(150, '2025-03-16 11:14:52', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica logged out', '180.242.192.178'),
(151, '2025-03-16 11:15:14', '2025-03-16', 'Guest', 'guest', 'Failed login attempt', '180.242.192.178'),
(152, '2025-03-16 11:15:27', '2025-03-16', 'Guest', 'guest', 'Failed login attempt', '180.242.192.178'),
(153, '2025-03-16 11:16:01', '2025-03-16', 'sim', 's@im', 'sim successfully logged in', '180.242.192.178'),
(154, '2025-03-16 11:16:04', '2025-03-16', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.178'),
(155, '2025-03-16 11:16:13', '2025-03-16', 'sim', 's@im', 'sim Visited transaksi', '180.242.192.178'),
(156, '2025-03-16 11:17:14', '2025-03-16', 'sim', 's@im', 'sim made transaction \'001\' to nota and transaksi', '180.242.192.178'),
(157, '2025-03-16 11:17:41', '2025-03-16', 'sim', 's@im', 'sim printed back nota \'93\'', '180.242.192.178'),
(158, '2025-03-16 12:41:46', '2025-03-16', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.178'),
(159, '2025-03-16 14:09:40', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica successfully logged in', '180.242.192.178'),
(160, '2025-03-16 14:09:44', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '180.242.192.178'),
(161, '2025-03-16 15:46:55', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica successfully logged in', '180.242.192.178'),
(162, '2025-03-16 15:46:57', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '180.242.192.178'),
(163, '2025-03-16 15:47:02', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica visited log activity', '180.242.192.178'),
(164, '2025-03-16 15:47:29', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica visited log activity', '180.242.192.178'),
(165, '2025-03-16 15:47:37', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica logged out', '180.242.192.178'),
(166, '2025-03-16 15:47:55', '2025-03-16', 'sim', 's@im', 'sim successfully logged in', '180.242.192.178'),
(167, '2025-03-16 15:47:57', '2025-03-16', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.178'),
(168, '2025-03-16 15:48:52', '2025-03-16', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.178'),
(169, '2025-03-16 15:49:43', '2025-03-16', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.178'),
(170, '2025-03-16 15:49:48', '2025-03-16', 'sim', 's@im', 'sim visited log activity', '180.242.192.178'),
(171, '2025-03-16 15:50:00', '2025-03-16', 'sim', 's@im', 'sim visited log activity', '180.242.192.178'),
(172, '2025-03-16 15:50:46', '2025-03-16', 'sim', 's@im', 'sim logged out', '180.242.192.178'),
(173, '2025-03-16 15:52:46', '2025-03-16', 'chichi', 'c@hi', 'chichi successfully logged in', '180.242.192.178'),
(174, '2025-03-16 15:52:49', '2025-03-16', 'chichi', 'c@hi', 'chichi Visited dashboard', '180.242.192.178'),
(175, '2025-03-16 15:52:59', '2025-03-16', 'chichi', 'c@hi', 'chichi visited log activity', '180.242.192.178'),
(176, '2025-03-16 15:53:06', '2025-03-16', 'chichi', 'c@hi', 'chichi visited log activity', '180.242.192.178'),
(177, '2025-03-16 15:55:10', '2025-03-16', 'chichi', 'c@hi', 'chichi Visited tabel transaksi', '180.242.192.178'),
(178, '2025-03-16 16:15:44', '2025-03-16', 'chichi', 'c@hi', 'chichi logged out', '180.242.192.178'),
(179, '2025-03-16 16:15:57', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica successfully logged in', '180.242.192.178'),
(180, '2025-03-16 16:15:59', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '180.242.192.178'),
(181, '2025-03-16 16:16:55', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica edit \'der@ius\' to user', '180.242.192.178'),
(182, '2025-03-16 16:17:34', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica deleted user with ID \'13\'', '180.242.192.178'),
(183, '2025-03-16 16:18:31', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica restored user with ID \'13\'', '180.242.192.178'),
(184, '2025-03-16 16:42:59', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica successfully logged in', '180.242.192.178'),
(185, '2025-03-16 16:43:01', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '180.242.192.178'),
(186, '2025-03-16 16:45:39', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ru@\' to user', '180.242.192.178'),
(187, '2025-03-16 16:46:14', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica edit \'ru@\' to user', '180.242.192.178'),
(188, '2025-03-16 16:47:47', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica deleted user with ID \'19\'', '180.242.192.178'),
(189, '2025-03-16 16:48:23', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica restored user with ID \'19\'', '180.242.192.178'),
(190, '2025-03-16 16:49:30', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica deleted user with ID \'19\'', '180.242.192.178'),
(191, '2025-03-16 16:49:38', '2025-03-16', 'chelsica', 's.a@dmin', 'chelsica deleted user with ID \'13\'', '180.242.192.178'),
(192, '2025-03-16 17:03:25', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica permanently delete user with ID \'19\'', '180.242.192.178'),
(193, '2025-03-16 17:03:49', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica restored all user', '180.242.192.178'),
(194, '2025-03-16 17:05:13', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'eee\' to user', '180.242.192.178'),
(195, '2025-03-16 17:05:14', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ee\' to kasir', '180.242.192.178'),
(196, '2025-03-16 17:05:54', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'qwww\' to barang', '180.242.192.178'),
(197, '2025-03-16 17:06:25', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ke\' to barang', '180.242.192.178'),
(198, '2025-03-16 17:09:27', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ffff\' to user', '180.242.192.178'),
(199, '2025-03-16 17:09:27', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ffff\' to kasir', '180.242.192.178'),
(200, '2025-03-16 17:09:30', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ffff\' to user', '180.242.192.178'),
(201, '2025-03-16 17:09:31', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ffff\' to kasir', '180.242.192.178'),
(202, '2025-03-16 17:09:34', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ffff\' to user', '180.242.192.178'),
(203, '2025-03-16 17:09:35', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ffff\' to kasir', '180.242.192.178'),
(204, '2025-03-16 17:09:48', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica deleted kasir with ID \'21\'', '180.242.192.178'),
(205, '2025-03-16 17:09:51', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica deleted kasir with ID \'21\'', '180.242.192.178'),
(206, '2025-03-16 17:09:52', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica deleted kasir with ID \'21\'', '180.242.192.178'),
(207, '2025-03-16 17:10:01', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica permanently deleted kasir with ID \'21\'', '180.242.192.178'),
(208, '2025-03-16 17:10:03', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica permanently deleted kasir with ID \'21\'', '180.242.192.178'),
(209, '2025-03-16 17:10:04', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica permanently deleted kasir with ID \'21\'', '180.242.192.178'),
(210, '2025-03-16 17:10:21', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ee@\' to user', '180.242.192.178'),
(211, '2025-03-16 17:10:22', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'ee\' to kasir', '180.242.192.178'),
(212, '2025-03-16 17:11:37', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica edit \'ee@\' to user', '180.242.192.178'),
(213, '2025-03-16 17:11:38', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica edit \'eee\' to kasir', '180.242.192.178'),
(214, '2025-03-16 17:11:59', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica deleted kasir with ID \'24\'', '180.242.192.178'),
(215, '2025-03-16 17:12:31', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica permanently deleted kasir with ID \'24\'', '180.242.192.178'),
(216, '2025-03-16 17:12:48', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'sss\' to barang', '180.242.192.178'),
(217, '2025-03-16 17:13:09', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica edit \'sss\' to barang', '180.242.192.178'),
(218, '2025-03-16 17:13:26', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica deleted barang with ID \'19\'', '180.242.192.178'),
(219, '2025-03-16 17:13:41', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica restored barang with ID \'19\'', '180.242.192.178'),
(220, '2025-03-16 17:14:30', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'S2@\' to user', '180.242.192.178'),
(221, '2025-03-16 17:14:31', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully added \'s2\' to kasir', '180.242.192.178'),
(222, '2025-03-16 17:14:38', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica deleted kasir with ID \'25\'', '180.242.192.178'),
(223, '2025-03-16 17:14:49', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica restored kasir with ID \'25\'', '180.242.192.178'),
(224, '2025-03-16 17:15:37', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica deleted kasir with ID \'25\'', '180.242.192.178'),
(225, '2025-03-16 17:15:55', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica restored all kasir', '180.242.192.178'),
(226, '2025-03-16 17:18:02', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica deleted kasir with ID \'25\'', '180.242.192.178'),
(227, '2025-03-16 17:18:22', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica restored all kasir', '180.242.192.178'),
(228, '2025-03-16 17:23:01', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica deleted kasir with ID \'25\'', '180.242.192.178'),
(229, '2025-03-16 17:23:20', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica restored all kasir', '180.242.192.178'),
(230, '2025-03-17 02:58:10', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica successfully logged in', '36.68.177.64'),
(231, '2025-03-17 02:58:11', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.68.177.64'),
(232, '2025-03-17 02:58:57', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.68.177.64'),
(233, '2025-03-17 02:59:01', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.68.177.64'),
(234, '2025-03-17 02:59:05', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica Visited transaksi', '36.68.177.64'),
(235, '2025-03-17 02:59:11', '2025-03-17', 'chelsica', 's.a@dmin', 'chelsica Visited dashboard', '36.68.177.64'),
(236, '2025-04-06 08:48:14', '2025-04-06', 'chichi', 'c@hi', 'chichi logged out', '180.242.192.71'),
(237, '2025-04-06 08:48:30', '2025-04-06', 'chichi', 'c@hi', 'chichi successfully logged in', '180.242.192.71'),
(238, '2025-04-06 08:48:34', '2025-04-06', 'chichi', 'c@hi', 'chichi Visited dashboard', '180.242.192.71'),
(239, '2025-04-06 08:48:41', '2025-04-06', 'chichi', 'c@hi', 'chichi Visited dashboard', '180.242.192.71'),
(240, '2025-04-06 08:48:52', '2025-04-06', 'chichi', 'c@hi', 'chichi visited log activity', '180.242.192.71'),
(241, '2025-04-06 08:49:12', '2025-04-06', 'chichi', 'c@hi', 'chichi visited log activity', '180.242.192.71'),
(242, '2025-04-06 08:50:56', '2025-04-06', 'chichi', 'c@hi', 'chichi Visited dashboard', '180.242.192.71'),
(243, '2025-04-06 08:51:08', '2025-04-06', 'chichi', 'c@hi', 'chichi Visited dashboard', '180.242.192.71'),
(244, '2025-04-06 08:51:20', '2025-04-06', 'chichi', 'c@hi', 'chichi logged out', '180.242.192.71'),
(245, '2025-04-06 08:51:42', '2025-04-06', 'sim', 's@im', 'sim successfully logged in', '180.242.192.71'),
(246, '2025-04-06 08:51:46', '2025-04-06', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.71'),
(247, '2025-04-06 08:54:14', '2025-04-06', 'sim', 's@im', 'sim visited log activity', '180.242.192.71'),
(248, '2025-04-06 08:54:23', '2025-04-06', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.71'),
(249, '2025-04-06 08:54:30', '2025-04-06', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.71'),
(250, '2025-04-06 08:55:23', '2025-04-06', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.71'),
(251, '2025-04-06 08:55:30', '2025-04-06', 'sim', 's@im', 'sim logged out', '180.242.192.71'),
(252, '2025-04-06 08:58:23', '2025-04-06', 'sim', 's@im', 'sim successfully logged in', '180.242.192.71'),
(253, '2025-04-06 08:58:27', '2025-04-06', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.71'),
(254, '2025-04-06 08:58:51', '2025-04-06', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.71'),
(255, '2025-04-06 09:00:24', '2025-04-06', 'sim', 's@im', 'sim successfully added \'cokelat\' to barang', '180.242.192.71'),
(256, '2025-04-06 09:00:43', '2025-04-06', 'sim', 's@im', 'sim edit \'cokelato\' to barang', '180.242.192.71'),
(257, '2025-04-06 09:01:15', '2025-04-06', 'sim', 's@im', 'sim Visited transaksi', '180.242.192.71'),
(258, '2025-04-06 09:02:23', '2025-04-06', 'sim', 's@im', 'sim made transaction \'001\' to nota and transaksi', '180.242.192.71'),
(259, '2025-04-06 09:02:33', '2025-04-06', 'sim', 's@im', 'sim printed nota \'001\'', '180.242.192.71'),
(260, '2025-04-06 09:02:54', '2025-04-06', 'sim', 's@im', 'sim Visited transaksi', '180.242.192.71'),
(261, '2025-04-06 09:03:18', '2025-04-06', 'sim', 's@im', 'sim printed back nota \'100\'', '180.242.192.71'),
(262, '2025-04-06 09:03:32', '2025-04-06', 'sim', 's@im', 'sim Visited tabel transaksi', '180.242.192.71'),
(263, '2025-04-06 09:03:43', '2025-04-06', 'sim', 's@im', 'sim Visited transaksi', '180.242.192.71'),
(264, '2025-04-06 09:03:47', '2025-04-06', 'sim', 's@im', 'sim Visited laporan transaksi', '180.242.192.71'),
(265, '2025-04-06 09:04:00', '2025-04-06', 'sim', 's@im', 'sim Visited laporan transaksi', '180.242.192.71'),
(266, '2025-04-06 09:04:16', '2025-04-06', 'sim', 's@im', 'sim made transaction report from  \'2025-01-01\' untill \'2025-04-30\'', '180.242.192.71'),
(267, '2025-04-06 09:04:34', '2025-04-06', 'sim', 's@im', 'sim visited log activity', '180.242.192.71'),
(268, '2025-04-06 09:04:53', '2025-04-06', 'sim', 's@im', 'sim logged out', '180.242.192.71'),
(269, '2025-04-06 09:05:18', '2025-04-06', 'Guest', 'guest', 'Failed login attempt', '180.242.192.71'),
(270, '2025-04-06 09:05:36', '2025-04-06', 'chichi', 'c@hi', 'chichi successfully logged in', '180.242.192.71'),
(271, '2025-04-06 09:05:39', '2025-04-06', 'chichi', 'c@hi', 'chichi Visited dashboard', '180.242.192.71'),
(272, '2025-04-06 09:06:30', '2025-04-06', 'chichi', 'c@hi', 'chichi visited log activity', '180.242.192.71'),
(273, '2025-04-06 09:07:06', '2025-04-06', 'chichi', 'c@hi', 'chichi deleted barang with ID \'21\'', '180.242.192.71'),
(274, '2025-04-06 09:07:16', '2025-04-06', 'chichi', 'c@hi', 'chichi logged out', '180.242.192.71'),
(275, '2025-04-06 09:07:32', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica successfully logged in', '180.242.192.71'),
(276, '2025-04-06 09:07:35', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited dashboard', '180.242.192.71'),
(277, '2025-04-06 09:09:12', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica restored barang with ID \'21\'', '180.242.192.71'),
(278, '2025-04-06 09:09:32', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica deleted barang with ID \'21\'', '180.242.192.71'),
(279, '2025-04-06 09:09:52', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica permanently delete barang with ID \'21\'', '180.242.192.71'),
(280, '2025-04-06 09:11:24', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica visited log activity', '180.242.192.71'),
(281, '2025-04-06 09:11:41', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica logged out', '180.242.192.71'),
(282, '2025-04-06 09:22:28', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica successfully logged in', '180.242.192.71'),
(283, '2025-04-06 09:22:32', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited dashboard', '180.242.192.71'),
(284, '2025-04-06 09:32:28', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica successfully logged in', '180.242.192.71'),
(285, '2025-04-06 09:32:33', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited dashboard', '180.242.192.71'),
(286, '2025-04-06 09:35:14', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica logged out', '180.242.192.71'),
(287, '2025-04-06 09:35:40', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica successfully logged in', '180.242.192.71'),
(288, '2025-04-06 09:35:44', '2025-04-06', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited dashboard', '180.242.192.71'),
(289, '2025-04-06 20:03:33', '2025-04-07', 'chichi', 'c@hi', 'chichi successfully logged in', '180.242.192.71'),
(290, '2025-04-06 20:03:36', '2025-04-07', 'chichi', 'c@hi', 'chichi Visited dashboard', '180.242.192.71'),
(291, '2025-04-06 20:15:15', '2025-04-07', 'chichi', 'c@hi', 'chichi printed back nota \'100\'', '180.242.192.71'),
(292, '2025-04-06 20:16:24', '2025-04-07', 'chichi', 'c@hi', 'chichi Visited tabel transaksi', '180.242.192.71'),
(293, '2025-04-06 20:17:06', '2025-04-07', 'chichi', 'c@hi', 'chichi Visited transaksi', '180.242.192.71'),
(294, '2025-04-06 20:18:21', '2025-04-07', 'chichi', 'c@hi', 'chichi Visited laporan transaksi', '180.242.192.71'),
(295, '2025-04-06 20:19:15', '2025-04-07', 'chichi', 'c@hi', 'chichi visited log activity', '180.242.192.71'),
(296, '2025-04-06 20:25:38', '2025-04-07', 'chichi', 'c@hi', 'chichi logged out', '180.242.192.71'),
(297, '2025-04-06 20:25:51', '2025-04-07', 'sim', 's@im', 'sim successfully logged in', '180.242.192.71'),
(298, '2025-04-06 20:25:55', '2025-04-07', 'sim', 's@im', 'sim Visited dashboard', '180.242.192.71'),
(299, '2025-04-06 20:36:22', '2025-04-07', 'sim', 's@im', 'sim visited log activity', '180.242.192.71'),
(300, '2025-04-06 20:37:17', '2025-04-07', 'sim', 's@im', 'sim Visited tabel transaksi', '180.242.192.71'),
(301, '2025-04-06 20:37:34', '2025-04-07', 'sim', 's@im', 'sim Visited laporan transaksi', '180.242.192.71'),
(302, '2025-04-06 20:37:39', '2025-04-07', 'sim', 's@im', 'sim Visited transaksi', '180.242.192.71'),
(303, '2025-04-06 20:41:54', '2025-04-07', 'sim', 's@im', 'sim logged out', '180.242.192.71'),
(304, '2025-04-06 20:42:09', '2025-04-07', 'Guest', 'guest', 'Failed login attempt', '180.242.192.71'),
(305, '2025-04-06 20:43:34', '2025-04-07', 'Guest', 'guest', 'Failed login attempt', '180.242.192.71'),
(306, '2025-04-06 20:44:10', '2025-04-07', 'Guest', 'guest', 'Failed login attempt', '180.242.192.71'),
(307, '2025-04-06 20:44:56', '2025-04-07', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica successfully logged in', '180.242.192.71'),
(308, '2025-04-06 20:45:00', '2025-04-07', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited dashboard', '180.242.192.71'),
(309, '2025-04-06 21:00:36', '2025-04-07', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited tabel transaksi', '180.242.192.71'),
(310, '2025-04-06 21:01:43', '2025-04-07', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited transaksi', '180.242.192.71'),
(311, '2025-04-06 21:03:15', '2025-04-07', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited laporan transaksi', '180.242.192.71'),
(312, '2025-04-06 21:04:07', '2025-04-07', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica visited log activity', '180.242.192.71'),
(313, '2025-04-06 21:37:02', '2025-04-07', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited dashboard', '180.242.192.71'),
(314, '2025-04-19 13:43:21', '2025-04-19', 'Guest', 'guest', 'Failed login attempt', '180.242.195.130'),
(315, '2025-04-19 13:44:16', '2025-04-19', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica successfully logged in', '180.242.195.130'),
(316, '2025-04-19 13:44:20', '2025-04-19', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited dashboard', '180.242.195.130'),
(317, '2025-04-26 01:29:14', '2025-04-26', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica successfully logged in', '180.242.192.204'),
(318, '2025-04-26 01:29:17', '2025-04-26', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited dashboard', '180.242.192.204'),
(319, '2025-04-26 01:29:50', '2025-04-26', 'chelsica', 'chelsicachelsica@gmail.com', 'chelsica Visited transaksi', '180.242.192.204');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(50) NOT NULL,
  `nomor_nota` varchar(50) NOT NULL,
  `grand_total` int(100) NOT NULL,
  `bayar` int(100) NOT NULL,
  `kembali` int(100) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_kasir` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `nomor_nota`, `grand_total`, `bayar`, `kembali`, `keterangan`, `id_kasir`, `tanggal`) VALUES
(70, '001', 33000, 90000, 57000, 'Transaksi Berhasil', '6', '2025-03-01 17:08:50'),
(71, '002', 10000, 22000, 12000, 'Transaksi Berhasil', '6', '2025-03-01 17:09:43'),
(72, '003', 42000, 55000, 13000, 'Transaksi Berhasil', '9', '2025-03-01 19:36:30'),
(73, '001', 18000, 20000, 2000, 'Transaksi Berhasil', '8', '2025-03-03 13:51:43'),
(74, '001', 10000, 11000, 1000, 'Transaksi Berhasil', '9', '2025-03-11 09:28:26'),
(75, '002', 24000, 33000, 9000, 'Transaksi Berhasil', '7', '2025-03-11 09:29:20'),
(76, '003', 16000, 17000, 1000, 'Transaksi Berhasil', '8', '2025-03-11 10:04:33'),
(77, '004', 24000, 30000, 6000, 'Transaksi Berhasil', 'Pilih Kasir', '2025-03-11 20:20:25'),
(78, '005', 24000, 30000, 6000, 'Transaksi Berhasil', 'Pilih Kasir', '2025-03-11 20:20:32'),
(79, '001', 8000, 9000, 1000, 'Transaksi Berhasil', '8', '2025-03-12 07:24:42'),
(80, '002', 18000, 19000, 1000, 'Transaksi Berhasil', '8', '2025-03-12 07:28:07'),
(81, '003', 16000, 23000, 7000, 'Transaksi Berhasil', '7', '2025-03-12 08:12:49'),
(82, '004', 12000, 14000, 2000, 'Transaksi Berhasil', '9', '2025-03-12 08:24:13'),
(83, '005', 12000, 14000, 2000, 'Transaksi Berhasil', '9', '2025-03-12 08:24:15'),
(84, '006', 4000, 5000, 1000, 'Transaksi Berhasil', '9', '2025-03-12 08:25:23'),
(85, '007', 10000, 13000, 3000, 'Transaksi Berhasil', '9', '2025-03-12 08:57:25'),
(86, '008', 10000, 13000, 3000, 'Transaksi Berhasil', '7', '2025-03-12 08:57:46'),
(87, '009', 12000, 20000, 8000, 'Transaksi Berhasil', '7', '2025-03-12 09:27:31'),
(88, '010', 6000, 7000, 1000, 'Transaksi Berhasil', '8', '2025-03-12 13:05:53'),
(89, '011', 6000, 9000, 3000, 'Transaksi Berhasil', '15', '2025-03-12 17:32:36'),
(90, '012', 4000, 6000, 2000, 'Transaksi Berhasil', '6', '2025-03-12 18:10:19'),
(91, '013', 16000, 17000, 1000, 'Transaksi Berhasil', '9', '2025-03-12 19:26:45'),
(92, '001', 9000, 10000, 1000, 'Transaksi Berhasil', '11', '2025-03-13 09:39:34'),
(93, '001', 19000, 30000, 11000, 'Transaksi Berhasil', '6', '2025-03-16 18:17:13'),
(94, '001', 64000, 77000, 13000, 'Transaksi Berhasil', '6', '2025-03-17 19:15:14'),
(95, '002', 6000, 7000, 1000, 'Transaksi Berhasil', '6', '2025-03-17 19:16:35'),
(96, '003', 12000, 30000, 18000, 'Transaksi Berhasil', '6', '2025-03-17 19:19:03'),
(97, '001', 3000, 9000, 6000, 'Transaksi Berhasil', '6', '2025-03-29 17:38:41'),
(98, '002', 3000, 9000, 6000, 'Transaksi Berhasil', '6', '2025-03-29 17:38:43'),
(99, '003', 32000, 33000, 1000, 'Transaksi Berhasil', '6', '2025-03-29 17:51:48'),
(100, '001', 34000, 35000, 1000, 'Transaksi Berhasil', '6', '2025-04-06 16:02:23');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_app`
--

CREATE TABLE `pengaturan_app` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_app` varchar(100) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `logo` varchar(255) DEFAULT 'assets/img/default-logo.png',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan_app`
--

INSERT INTO `pengaturan_app` (`id_pengaturan`, `nama_app`, `owner`, `judul`, `logo`, `created_at`, `updated_at`) VALUES
(1, NULL, 'chelsica', 'Kasir Minimarket', '1743930671_d3309d5237c368cf4395.png', '2025-03-17 00:47:01', '2025-03-18 02:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `nomor_nota` varchar(50) NOT NULL,
  `id_kasir` int(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `sub_total` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `nomor_nota`, `id_kasir`, `kode_barang`, `jumlah`, `sub_total`) VALUES
(103, '2025-03-01 17:08:50', '001', 6, '001', 3, 15000),
(104, '2025-03-01 17:08:50', '001', 6, '002', 2, 16000),
(105, '2025-03-01 17:08:50', '001', 6, '003', 1, 2000),
(106, '2025-03-01 17:09:43', '002', 6, '003', 5, 10000),
(107, '2025-03-01 19:36:30', '003', 9, '004', 3, 27000),
(108, '2025-03-01 19:36:30', '003', 9, '001', 3, 15000),
(109, '2025-03-03 13:51:43', '001', 8, '001', 2, 10000),
(110, '2025-03-03 13:51:43', '001', 8, '002', 1, 8000),
(111, '2025-03-11 09:28:26', '001', 9, '001', 2, 10000),
(112, '2025-03-11 09:29:20', '002', 7, '002', 3, 24000),
(113, '2025-03-11 10:04:33', '003', 8, '002', 2, 16000),
(114, '2025-03-11 20:20:25', '004', 0, '002', 3, 24000),
(115, '2025-03-11 20:20:32', '005', 0, '002', 3, 24000),
(116, '2025-03-12 07:24:42', '001', 8, '005', 2, 8000),
(117, '2025-03-12 07:28:07', '002', 8, '009', 3, 18000),
(118, '2025-03-12 08:12:49', '003', 7, '003', 8, 16000),
(119, '2025-03-12 08:24:13', '004', 9, '005', 3, 12000),
(120, '2025-03-12 08:24:15', '005', 9, '005', 3, 12000),
(121, '2025-03-12 08:25:23', '006', 9, '003', 2, 4000),
(122, '2025-03-12 08:57:25', '007', 9, '003', 5, 10000),
(123, '2025-03-12 08:57:46', '008', 7, '003', 5, 10000),
(124, '2025-03-12 09:27:31', '009', 7, '005', 3, 12000),
(125, '2025-03-12 13:05:53', '010', 8, '009', 1, 6000),
(126, '2025-03-12 17:32:36', '011', 15, '009', 1, 6000),
(127, '2025-03-12 18:10:19', '012', 6, '005', 1, 4000),
(128, '2025-03-12 19:26:45', '013', 9, '010', 1, 12000),
(129, '2025-03-12 19:26:45', '013', 9, '003', 2, 4000),
(130, '2025-03-13 09:39:34', '001', 11, '013', 3, 9000),
(131, '2025-03-16 18:17:13', '001', 6, '001', 3, 15000),
(132, '2025-03-16 18:17:13', '001', 6, '003', 2, 4000),
(133, '2025-03-17 19:15:14', '001', 6, '002', 8, 64000),
(134, '2025-03-17 19:16:35', '002', 6, '009', 1, 6000),
(135, '2025-03-17 19:19:03', '003', 6, '005', 3, 12000),
(136, '2025-03-29 17:38:41', '001', 6, '013', 1, 3000),
(137, '2025-03-29 17:38:43', '002', 6, '013', 1, 3000),
(138, '2025-03-29 17:51:48', '003', 6, '005', 2, 8000),
(139, '2025-03-29 17:51:48', '003', 6, '015', 2, 24000),
(140, '2025-04-06 16:02:23', '001', 6, '020', 3, 24000),
(141, '2025-04-06 16:02:23', '001', 6, '001', 2, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `level` int(12) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `level`, `token`, `expiry`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'chelsicachelsica@gmail.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'chelsica', 3, NULL, NULL, NULL, NULL, '2025-03-28 23:13:10', NULL, NULL, 'chelsica', NULL),
(2, 'c@hi', 'c4ca4238a0b923820dcc509a6f75849b', 'chichi', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 's@im', 'c81e728d9d4c2f636f067f89cc14862c', 'sim', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'der@ius', '4a9bd19b3b8676199592a346051f950c', 'derius', 2, NULL, NULL, NULL, NULL, '2025-03-16 20:17:16', NULL, NULL, 'chelsica', NULL),
(14, 'chl@e', 'c81e728d9d4c2f636f067f89cc14862c', 'chloe', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'ss@', '38026ed22fc1a91d92b5d2ef93540f20', 'ss', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'lumi@', '4a9bd19b3b8676199592a346051f950c', 'lumi', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'ka@sir', '665f644e43731ff9db3d341da5c827e1', 'RPLL', 2, NULL, NULL, 0, NULL, '2025-04-06 03:37:34', '2025-04-06 03:38:24', NULL, 'chichi', 'chichi'),
(26, 'kasir@', 'c81e728d9d4c2f636f067f89cc14862c', 'rpl', 2, NULL, NULL, NULL, '2025-04-06 03:39:14', NULL, NULL, 'chichi', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
