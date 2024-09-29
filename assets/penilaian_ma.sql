-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2024 at 02:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian_ma`
--

-- --------------------------------------------------------

--
-- Table structure for table `ekstra`
--

CREATE TABLE `ekstra` (
  `id_ekstra` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nm_ekstra` varchar(30) NOT NULL,
  `penanggung_jawab` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekstra`
--

INSERT INTO `ekstra` (`id_ekstra`, `id_periode`, `nm_ekstra`, `penanggung_jawab`) VALUES
(1, 1, 'Pramuka', 'Fajar'),
(2, 1, 'Basket', 'Andi'),
(3, 1, 'Futsal', 'Budi'),
(4, 1, 'Paduan Suara', 'Citra'),
(5, 1, 'Teater', 'Dewi');

-- --------------------------------------------------------

--
-- Table structure for table `ekstra_siswa`
--

CREATE TABLE `ekstra_siswa` (
  `id_ekstra_siswa` int(11) NOT NULL,
  `id_ekstra` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekstra_siswa`
--

INSERT INTO `ekstra_siswa` (`id_ekstra_siswa`, `id_ekstra`, `id_siswa`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 1, 6),
(7, 2, 7),
(8, 3, 8),
(9, 4, 9),
(10, 5, 10),
(11, 1, 11),
(12, 2, 12),
(13, 1, 13),
(14, 2, 14),
(15, 3, 15),
(16, 4, 16),
(17, 5, 17),
(18, 1, 18),
(19, 2, 19),
(20, 3, 20),
(21, 4, 21),
(22, 5, 22),
(23, 1, 23),
(24, 2, 24),
(25, 1, 25),
(26, 2, 26),
(27, 3, 27),
(28, 1, 28),
(29, 5, 29),
(30, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nm_guru` varchar(30) NOT NULL,
  `alamat_guru` text DEFAULT NULL,
  `jk_guru` enum('L','P') NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_hp_guru` varchar(13) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nm_guru`, `alamat_guru`, `jk_guru`, `tgl_lahir`, `no_hp_guru`, `foto`) VALUES
(1, 1111, 'ulya', 'Jl. Merdeka No. 10', 'L', '1980-05-15', '081234567890', 'ahmad.png'),
(2, 1112, 'guru', 'Jl. Kembang No. 21', 'P', '1982-08-20', '081234567891', 'siti.png'),
(3, 1113, 'bagus', 'Jl. Mawar No. 3', 'L', '1975-03-22', '081234567892', 'budi.png'),
(4, 1114, 'adi', 'Jl. Melati No. 7', 'P', '1978-07-11', '081234567802', 'rina.png'),
(5, 1115, 'budi', 'Jl. Kenanga No. 5', 'P', '1983-02-14', '081234567893', 'dewi.png'),
(6, 1116, 'sita', 'Jl. Cempaka No. 8', 'L', '1984-12-24', '081234567894', 'tono.png'),
(7, 1117, 'dina', 'Jl. Anggrek No. 12', 'L', '1979-06-18', '081234567895', 'rudi.png'),
(8, 1118, 'joni', 'Jl. Flamboyan No. 16', 'P', '1985-04-29', '081234567896', 'maya.png'),
(9, 1119, 'putra', 'Jl. Dahlia No. 19', 'P', '1981-09-05', '081234567897', 'anita.png'),
(10, 1120, 'ana', 'Jl. Teratai No. 14', 'L', '1987-11-30', '081234567898', 'arief.png');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_siswa`
--

CREATE TABLE `jadwal_siswa` (
  `id_jadwal_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `hari` varchar(10) DEFAULT NULL,
  `waktu_awal` time DEFAULT NULL,
  `waktu_akhir` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_siswa`
--

INSERT INTO `jadwal_siswa` (`id_jadwal_siswa`, `id_siswa`, `id_mapel`, `id_guru`, `hari`, `waktu_awal`, `waktu_akhir`) VALUES
(1, 1, 1, 1, 'senin', '07:00:00', '08:00:00'),
(2, 2, 1, 1, 'senin', '07:00:00', '08:00:00'),
(3, 3, 1, 1, 'senin', '07:00:00', '08:00:00'),
(4, 4, 1, 1, 'senin', '07:00:00', '08:00:00'),
(5, 5, 1, 1, 'senin', '07:00:00', '08:00:00'),
(6, 6, 1, 1, 'senin', '07:00:00', '08:00:00'),
(7, 7, 1, 1, 'senin', '07:00:00', '08:00:00'),
(8, 8, 1, 1, 'senin', '07:00:00', '08:00:00'),
(9, 9, 1, 1, 'senin', '07:00:00', '08:00:00'),
(10, 10, 1, 1, 'senin', '07:00:00', '08:00:00'),
(11, 11, 2, 2, 'senin', '07:00:00', '08:00:00'),
(12, 12, 2, 2, 'senin', '07:00:00', '08:00:00'),
(13, 13, 2, 2, 'senin', '07:00:00', '08:00:00'),
(14, 14, 2, 2, 'senin', '07:00:00', '08:00:00'),
(15, 15, 2, 2, 'senin', '07:00:00', '08:00:00'),
(16, 16, 2, 2, 'senin', '07:00:00', '08:00:00'),
(17, 17, 2, 2, 'senin', '07:00:00', '08:00:00'),
(18, 18, 2, 2, 'senin', '07:00:00', '08:00:00'),
(19, 19, 2, 2, 'senin', '07:00:00', '08:00:00'),
(20, 20, 2, 2, 'senin', '07:00:00', '08:00:00'),
(21, 21, 3, 3, 'senin', '07:00:00', '08:00:00'),
(22, 22, 3, 3, 'senin', '07:00:00', '08:00:00'),
(23, 23, 3, 3, 'senin', '07:00:00', '08:00:00'),
(24, 24, 3, 3, 'senin', '07:00:00', '08:00:00'),
(25, 25, 3, 3, 'senin', '07:00:00', '08:00:00'),
(26, 26, 3, 3, 'senin', '07:00:00', '08:00:00'),
(27, 27, 3, 3, 'senin', '07:00:00', '08:00:00'),
(28, 28, 3, 3, 'senin', '07:00:00', '08:00:00'),
(29, 29, 3, 3, 'senin', '07:00:00', '08:00:00'),
(30, 30, 3, 3, 'senin', '07:00:00', '08:00:00'),
(31, 1, 2, 2, 'senin', '08:00:00', '09:00:00'),
(32, 2, 2, 2, 'senin', '08:00:00', '09:00:00'),
(33, 3, 2, 2, 'senin', '08:00:00', '09:00:00'),
(34, 4, 2, 2, 'senin', '08:00:00', '09:00:00'),
(35, 5, 2, 2, 'senin', '08:00:00', '09:00:00'),
(36, 6, 2, 2, 'senin', '08:00:00', '09:00:00'),
(37, 7, 2, 2, 'senin', '08:00:00', '09:00:00'),
(38, 8, 2, 2, 'senin', '08:00:00', '09:00:00'),
(39, 9, 2, 2, 'senin', '08:00:00', '09:00:00'),
(40, 10, 2, 2, 'senin', '08:00:00', '09:00:00'),
(41, 11, 3, 3, 'senin', '08:00:00', '09:00:00'),
(42, 12, 3, 3, 'senin', '08:00:00', '09:00:00'),
(43, 13, 3, 3, 'senin', '08:00:00', '09:00:00'),
(44, 14, 3, 3, 'senin', '08:00:00', '09:00:00'),
(45, 15, 3, 3, 'senin', '08:00:00', '09:00:00'),
(46, 16, 3, 3, 'senin', '08:00:00', '09:00:00'),
(47, 17, 3, 3, 'senin', '08:00:00', '09:00:00'),
(48, 18, 3, 3, 'senin', '08:00:00', '09:00:00'),
(49, 19, 3, 3, 'senin', '08:00:00', '09:00:00'),
(50, 20, 3, 3, 'senin', '08:00:00', '09:00:00'),
(51, 21, 4, 4, 'senin', '08:00:00', '09:00:00'),
(52, 22, 4, 4, 'senin', '08:00:00', '09:00:00'),
(53, 23, 4, 4, 'senin', '08:00:00', '09:00:00'),
(54, 24, 4, 4, 'senin', '08:00:00', '09:00:00'),
(55, 25, 4, 4, 'senin', '08:00:00', '09:00:00'),
(56, 26, 4, 4, 'senin', '08:00:00', '09:00:00'),
(57, 27, 4, 4, 'senin', '08:00:00', '09:00:00'),
(58, 28, 4, 4, 'senin', '08:00:00', '09:00:00'),
(59, 29, 4, 4, 'senin', '08:00:00', '09:00:00'),
(60, 30, 4, 4, 'senin', '08:00:00', '09:00:00'),
(61, 1, 3, 3, 'senin', '09:00:00', '10:00:00'),
(62, 2, 3, 3, 'senin', '09:00:00', '10:00:00'),
(63, 3, 3, 3, 'senin', '09:00:00', '10:00:00'),
(64, 4, 3, 3, 'senin', '09:00:00', '10:00:00'),
(65, 5, 3, 3, 'senin', '09:00:00', '10:00:00'),
(66, 6, 3, 3, 'senin', '09:00:00', '10:00:00'),
(67, 7, 3, 3, 'senin', '09:00:00', '10:00:00'),
(68, 8, 3, 3, 'senin', '09:00:00', '10:00:00'),
(69, 9, 3, 3, 'senin', '09:00:00', '10:00:00'),
(70, 10, 3, 3, 'senin', '09:00:00', '10:00:00'),
(71, 11, 4, 4, 'senin', '09:00:00', '10:00:00'),
(72, 12, 4, 4, 'senin', '09:00:00', '10:00:00'),
(73, 13, 4, 4, 'senin', '09:00:00', '10:00:00'),
(74, 14, 4, 4, 'senin', '09:00:00', '10:00:00'),
(75, 15, 4, 4, 'senin', '09:00:00', '10:00:00'),
(76, 16, 4, 4, 'senin', '09:00:00', '10:00:00'),
(77, 17, 4, 4, 'senin', '09:00:00', '10:00:00'),
(78, 18, 4, 4, 'senin', '09:00:00', '10:00:00'),
(79, 19, 4, 4, 'senin', '09:00:00', '10:00:00'),
(80, 20, 4, 4, 'senin', '09:00:00', '10:00:00'),
(81, 21, 5, 5, 'senin', '09:00:00', '10:00:00'),
(82, 22, 5, 5, 'senin', '09:00:00', '10:00:00'),
(83, 23, 5, 5, 'senin', '09:00:00', '10:00:00'),
(84, 24, 5, 5, 'senin', '09:00:00', '10:00:00'),
(85, 25, 5, 5, 'senin', '09:00:00', '10:00:00'),
(86, 26, 5, 5, 'senin', '09:00:00', '10:00:00'),
(87, 27, 5, 5, 'senin', '09:00:00', '10:00:00'),
(88, 28, 5, 5, 'senin', '09:00:00', '10:00:00'),
(89, 29, 5, 5, 'senin', '09:00:00', '10:00:00'),
(90, 30, 5, 5, 'senin', '09:00:00', '10:00:00'),
(91, 1, 4, 4, 'senin', '11:00:00', '12:00:00'),
(92, 2, 4, 4, 'senin', '11:00:00', '12:00:00'),
(93, 3, 4, 4, 'senin', '11:00:00', '12:00:00'),
(94, 4, 4, 4, 'senin', '11:00:00', '12:00:00'),
(95, 5, 4, 4, 'senin', '11:00:00', '12:00:00'),
(96, 6, 4, 4, 'senin', '11:00:00', '12:00:00'),
(97, 7, 4, 4, 'senin', '11:00:00', '12:00:00'),
(98, 8, 4, 4, 'senin', '11:00:00', '12:00:00'),
(99, 9, 4, 4, 'senin', '11:00:00', '12:00:00'),
(100, 10, 4, 4, 'senin', '11:00:00', '12:00:00'),
(101, 11, 5, 5, 'senin', '11:00:00', '12:00:00'),
(102, 12, 5, 5, 'senin', '11:00:00', '12:00:00'),
(103, 13, 5, 5, 'senin', '11:00:00', '12:00:00'),
(104, 14, 5, 5, 'senin', '11:00:00', '12:00:00'),
(105, 15, 5, 5, 'senin', '11:00:00', '12:00:00'),
(106, 16, 5, 5, 'senin', '11:00:00', '12:00:00'),
(107, 17, 5, 5, 'senin', '11:00:00', '12:00:00'),
(108, 18, 5, 5, 'senin', '11:00:00', '12:00:00'),
(109, 19, 5, 5, 'senin', '11:00:00', '12:00:00'),
(110, 20, 5, 5, 'senin', '11:00:00', '12:00:00'),
(111, 21, 6, 6, 'senin', '11:00:00', '12:00:00'),
(112, 22, 6, 6, 'senin', '11:00:00', '12:00:00'),
(113, 23, 6, 6, 'senin', '11:00:00', '12:00:00'),
(114, 24, 6, 6, 'senin', '11:00:00', '12:00:00'),
(115, 25, 6, 6, 'senin', '11:00:00', '12:00:00'),
(116, 26, 6, 6, 'senin', '11:00:00', '12:00:00'),
(117, 27, 6, 6, 'senin', '11:00:00', '12:00:00'),
(118, 28, 6, 6, 'senin', '11:00:00', '12:00:00'),
(119, 29, 6, 6, 'senin', '11:00:00', '12:00:00'),
(120, 30, 6, 6, 'senin', '11:00:00', '12:00:00'),
(121, 1, 5, 5, 'senin', '12:00:00', '13:00:00'),
(122, 2, 5, 5, 'senin', '12:00:00', '13:00:00'),
(123, 3, 5, 5, 'senin', '12:00:00', '13:00:00'),
(124, 4, 5, 5, 'senin', '12:00:00', '13:00:00'),
(125, 5, 5, 5, 'senin', '12:00:00', '13:00:00'),
(126, 6, 5, 5, 'senin', '12:00:00', '13:00:00'),
(127, 7, 5, 5, 'senin', '12:00:00', '13:00:00'),
(128, 8, 5, 5, 'senin', '12:00:00', '13:00:00'),
(129, 9, 5, 5, 'senin', '12:00:00', '13:00:00'),
(130, 10, 5, 5, 'senin', '12:00:00', '13:00:00'),
(131, 11, 6, 6, 'senin', '12:00:00', '13:00:00'),
(132, 12, 6, 6, 'senin', '12:00:00', '13:00:00'),
(133, 13, 6, 6, 'senin', '12:00:00', '13:00:00'),
(134, 14, 6, 6, 'senin', '12:00:00', '13:00:00'),
(135, 15, 6, 6, 'senin', '12:00:00', '13:00:00'),
(136, 16, 6, 6, 'senin', '12:00:00', '13:00:00'),
(137, 17, 6, 6, 'senin', '12:00:00', '13:00:00'),
(138, 18, 6, 6, 'senin', '12:00:00', '13:00:00'),
(139, 19, 6, 6, 'senin', '12:00:00', '13:00:00'),
(140, 20, 6, 6, 'senin', '12:00:00', '13:00:00'),
(141, 21, 7, 7, 'senin', '12:00:00', '13:00:00'),
(142, 22, 7, 7, 'senin', '12:00:00', '13:00:00'),
(143, 23, 7, 7, 'senin', '12:00:00', '13:00:00'),
(144, 24, 7, 7, 'senin', '12:00:00', '13:00:00'),
(145, 25, 7, 7, 'senin', '12:00:00', '13:00:00'),
(146, 26, 7, 7, 'senin', '12:00:00', '13:00:00'),
(147, 27, 7, 7, 'senin', '12:00:00', '13:00:00'),
(148, 28, 7, 7, 'senin', '12:00:00', '13:00:00'),
(149, 29, 7, 7, 'senin', '12:00:00', '13:00:00'),
(150, 30, 7, 7, 'senin', '12:00:00', '13:00:00'),
(201, 1, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(251, 2, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(252, 3, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(253, 4, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(254, 5, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(255, 6, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(256, 7, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(257, 8, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(258, 9, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(259, 10, 6, 6, 'selasa', '07:00:00', '08:00:00'),
(300, 1, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(301, 2, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(302, 3, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(303, 4, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(304, 5, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(305, 6, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(306, 7, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(307, 8, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(308, 9, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(309, 10, 7, 7, 'selasa', '08:00:00', '09:00:00'),
(350, 1, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(351, 2, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(352, 3, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(353, 4, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(354, 5, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(355, 6, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(356, 7, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(357, 8, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(358, 9, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(359, 10, 8, 8, 'selasa', '09:00:00', '10:00:00'),
(360, 1, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(361, 2, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(362, 3, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(363, 4, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(364, 5, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(365, 6, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(366, 7, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(367, 8, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(368, 9, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(369, 10, 9, 9, 'selasa', '11:00:00', '12:00:00'),
(370, 1, 10, 10, 'selasa', '12:00:00', '13:00:00'),
(371, 2, 10, 10, 'selasa', '12:00:00', '13:00:00'),
(372, 3, 10, 10, 'selasa', '12:00:00', '13:00:00'),
(373, 4, 10, 10, 'selasa', '12:00:00', '13:00:00'),
(374, 5, 10, 10, 'selasa', '12:00:00', '13:00:00'),
(375, 6, 10, 10, 'selasa', '12:00:00', '13:00:00'),
(376, 7, 10, 10, 'selasa', '12:00:00', '13:00:00'),
(377, 8, 10, 10, 'selasa', '12:00:00', '13:00:00'),
(378, 9, 10, 10, 'selasa', '12:00:00', '13:00:00'),
(379, 10, 10, 10, 'selasa', '12:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran_siswa`
--

CREATE TABLE `kehadiran_siswa` (
  `id_kehadiran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `jam_masuk` date DEFAULT NULL,
  `status` enum('Masuk','Tidak Masuk','Izin') NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nm_kelas` varchar(50) DEFAULT NULL,
  `kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nm_kelas`, `kelas`) VALUES
(1, 'IPA 1', 10),
(2, 'IPA 1', 11),
(3, 'IPA 1', 12);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nm_mapel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `id_periode`, `nm_mapel`) VALUES
(1, 1, 'BAHASA INDONESIA'),
(2, 1, 'MATEMATIKA'),
(3, 1, 'FISIKA'),
(4, 1, 'KIMIA'),
(5, 1, 'BIOLOGI'),
(6, 1, 'SEJARAH'),
(7, 1, 'GEOGRAFI'),
(8, 1, 'EKONOMI'),
(9, 1, 'BAHASA INGGRIS'),
(10, 1, 'PENJAS');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_ekstra`
--

CREATE TABLE `nilai_ekstra` (
  `id_nilai_ekstra` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_ekstra_siswa` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `ket_nilai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_mapel`
--

CREATE TABLE `nilai_mapel` (
  `id_nilai_mapel` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `ket_nilai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_mapel`
--

INSERT INTO `nilai_mapel` (`id_nilai_mapel`, `id_siswa`, `id_jadwal`, `nilai`, `ket_nilai`) VALUES
(1, 1, 1, 75, 'UH1'),
(2, 2, 2, 71, 'UH1'),
(3, 3, 3, 87, 'UH1'),
(4, 4, 4, 78, 'UH1'),
(5, 5, 5, 79, 'UH1'),
(6, 6, 6, 92, 'UH1'),
(7, 7, 7, 82, 'UH1'),
(8, 8, 8, 80, 'UH1'),
(9, 9, 9, 85, 'UH1'),
(10, 10, 10, 80, 'UH1'),
(11, 11, 11, 85, 'UH1'),
(12, 12, 12, 92, 'UH1'),
(13, 13, 13, 70, 'UH1'),
(14, 14, 14, 91, 'UH1'),
(15, 15, 15, 87, 'UH1'),
(16, 16, 16, 87, 'UH1'),
(17, 17, 17, 76, 'UH1'),
(18, 18, 18, 73, 'UH1'),
(19, 19, 19, 93, 'UH1'),
(20, 20, 20, 75, 'UH1'),
(21, 21, 21, 90, 'UH1'),
(22, 22, 22, 75, 'UH1'),
(23, 23, 23, 79, 'UH1'),
(24, 24, 24, 94, 'UH1'),
(25, 25, 25, 80, 'UH1'),
(26, 26, 26, 88, 'UH1'),
(27, 27, 27, 87, 'UH1'),
(28, 28, 28, 84, 'UH1'),
(29, 29, 29, 89, 'UH1'),
(30, 30, 30, 78, 'UH1'),
(31, 1, 1, 75, 'UH2'),
(32, 2, 2, 71, 'UH2'),
(33, 3, 3, 87, 'UH2'),
(34, 4, 4, 78, 'UH2'),
(35, 5, 5, 84, 'UH2'),
(36, 6, 6, 76, 'UH2'),
(37, 7, 7, 82, 'UH2'),
(38, 8, 8, 89, 'UH2'),
(39, 9, 9, 85, 'UH2'),
(40, 10, 10, 80, 'UH2'),
(41, 11, 11, 85, 'UH2'),
(42, 12, 12, 92, 'UH2'),
(43, 13, 13, 70, 'UH2'),
(44, 14, 14, 91, 'UH2'),
(45, 15, 15, 87, 'UH2'),
(46, 16, 16, 87, 'UH2'),
(47, 17, 17, 76, 'UH2'),
(48, 18, 18, 73, 'UH2'),
(49, 19, 19, 93, 'UH2'),
(50, 20, 20, 75, 'UH2'),
(51, 21, 21, 90, 'UH2'),
(52, 22, 22, 75, 'UH2'),
(53, 23, 23, 79, 'UH2'),
(54, 24, 24, 94, 'UH2'),
(55, 25, 25, 80, 'UH2'),
(56, 26, 26, 88, 'UH2'),
(57, 27, 27, 87, 'UH2'),
(58, 28, 28, 84, 'UH2'),
(59, 29, 29, 89, 'UH2'),
(60, 30, 30, 90, 'UH2'),
(61, 1, 1, 75, 'UH3'),
(62, 2, 2, 71, 'UH3'),
(63, 3, 3, 87, 'UH3'),
(64, 4, 4, 78, 'UH3'),
(65, 5, 5, 79, 'UH3'),
(66, 6, 6, 76, 'UH3'),
(67, 7, 7, 82, 'UH3'),
(68, 8, 8, 77, 'UH3'),
(69, 9, 9, 85, 'UH3'),
(70, 10, 10, 80, 'UH3'),
(71, 11, 11, 85, 'UH3'),
(72, 12, 12, 92, 'UH3'),
(73, 13, 13, 70, 'UH3'),
(74, 14, 14, 91, 'UH3'),
(75, 15, 15, 87, 'UH3'),
(76, 16, 16, 87, 'UH3'),
(77, 17, 17, 76, 'UH3'),
(78, 18, 18, 73, 'UH3'),
(79, 19, 19, 93, 'UH3'),
(80, 20, 20, 75, 'UH3'),
(81, 21, 21, 90, 'UH3'),
(82, 22, 22, 75, 'UH3'),
(83, 23, 23, 79, 'UH3'),
(84, 24, 24, 94, 'UH3'),
(85, 25, 25, 80, 'UH3'),
(86, 26, 26, 88, 'UH3'),
(87, 27, 27, 87, 'UH3'),
(88, 28, 28, 84, 'UH3'),
(89, 29, 29, 89, 'UH3'),
(90, 30, 30, 78, 'UH3'),
(91, 1, 1, 75, 'UH4'),
(92, 2, 2, 71, 'UH4'),
(93, 3, 3, 87, 'UH4'),
(94, 4, 4, 85, 'UH4'),
(95, 5, 5, 79, 'UH4'),
(96, 6, 6, 76, 'UH4'),
(97, 7, 7, 82, 'UH4'),
(98, 8, 8, 89, 'UH4'),
(99, 9, 9, 85, 'UH4'),
(100, 10, 10, 80, 'UH4'),
(101, 11, 11, 85, 'UH4'),
(102, 12, 12, 92, 'UH4'),
(103, 13, 13, 70, 'UH4'),
(104, 14, 14, 91, 'UH4'),
(105, 15, 15, 87, 'UH4'),
(106, 16, 16, 87, 'UH4'),
(107, 17, 17, 76, 'UH4'),
(108, 18, 18, 73, 'UH4'),
(109, 19, 19, 93, 'UH4'),
(110, 20, 20, 75, 'UH4'),
(111, 21, 21, 77, 'UH4'),
(112, 22, 22, 75, 'UH4'),
(113, 23, 23, 79, 'UH4'),
(114, 24, 24, 94, 'UH4'),
(115, 25, 25, 80, 'UH4'),
(116, 26, 26, 88, 'UH4'),
(117, 27, 27, 87, 'UH4'),
(118, 28, 28, 84, 'UH4'),
(119, 29, 29, 89, 'UH4'),
(120, 30, 30, 78, 'UH4'),
(121, 1, 1, 75, 'UTS'),
(122, 2, 2, 71, 'UTS'),
(123, 3, 3, 87, 'UTS'),
(124, 4, 4, 80, 'UTS'),
(125, 5, 5, 79, 'UTS'),
(126, 6, 6, 76, 'UTS'),
(127, 7, 7, 82, 'UTS'),
(128, 8, 8, 89, 'UTS'),
(129, 9, 9, 85, 'UTS'),
(130, 10, 10, 80, 'UTS'),
(131, 11, 11, 85, 'UTS'),
(132, 12, 12, 92, 'UTS'),
(133, 13, 13, 70, 'UTS'),
(134, 14, 14, 91, 'UTS'),
(135, 15, 15, 87, 'UTS'),
(136, 16, 16, 87, 'UTS'),
(137, 17, 17, 76, 'UTS'),
(138, 18, 18, 73, 'UTS'),
(139, 19, 19, 93, 'UTS'),
(140, 20, 20, 75, 'UTS'),
(141, 21, 21, 90, 'UTS'),
(142, 22, 22, 75, 'UTS'),
(143, 23, 23, 79, 'UTS'),
(144, 24, 24, 94, 'UTS'),
(145, 25, 25, 80, 'UTS'),
(146, 26, 26, 88, 'UTS'),
(147, 27, 27, 87, 'UTS'),
(148, 28, 28, 84, 'UTS'),
(149, 29, 29, 89, 'UTS'),
(150, 30, 30, 78, 'UTS'),
(151, 1, 1, 75, 'UAS'),
(152, 2, 2, 71, 'UAS'),
(153, 3, 3, 87, 'UAS'),
(154, 4, 4, 78, 'UAS'),
(155, 5, 5, 79, 'UAS'),
(156, 6, 6, 76, 'UAS'),
(157, 7, 7, 82, 'UAS'),
(158, 8, 8, 89, 'UAS'),
(159, 9, 9, 85, 'UAS'),
(160, 10, 10, 80, 'UAS'),
(161, 11, 11, 85, 'UAS'),
(162, 12, 12, 92, 'UAS'),
(163, 13, 13, 70, 'UAS'),
(164, 14, 14, 91, 'UAS'),
(165, 15, 15, 87, 'UAS'),
(166, 16, 16, 87, 'UAS'),
(167, 17, 17, 76, 'UAS'),
(168, 18, 18, 73, 'UAS'),
(169, 19, 19, 93, 'UAS'),
(170, 20, 20, 75, 'UAS'),
(171, 21, 21, 90, 'UAS'),
(172, 22, 22, 75, 'UAS'),
(173, 23, 23, 79, 'UAS'),
(174, 24, 24, 94, 'UAS'),
(175, 25, 25, 80, 'UAS'),
(176, 26, 26, 88, 'UAS'),
(177, 27, 27, 87, 'UAS'),
(178, 28, 28, 84, 'UAS'),
(179, 29, 29, 89, 'UAS'),
(180, 30, 30, 78, 'UAS');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `nm_periode` varchar(50) DEFAULT NULL,
  `status_periode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_periode`, `nm_periode`, `status_periode`) VALUES
(1, 'SEMESTER GASAL 2020', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nm_siswa` varchar(20) DEFAULT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat_siswa` text DEFAULT NULL,
  `jk_siswa` enum('L','P') NOT NULL,
  `tgl_lahir_siswa` date DEFAULT NULL,
  `no_hp` varchar(20) NOT NULL,
  `nm_wali` varchar(100) DEFAULT NULL,
  `status_siswa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nm_siswa`, `id_kelas`, `alamat_siswa`, `jk_siswa`, `tgl_lahir_siswa`, `no_hp`, `nm_wali`, `status_siswa`) VALUES
(1, '101', 'Ali', 1, 'Jl. Kebon Jeruk No. 1', 'L', '2010-01-15', '081234567890', 'Bapak Ali', 'Aktif'),
(2, '102', 'Alya', 1, 'Jl. Kebon Jeruk No. 2', 'P', '2010-02-17', '081234567891', 'Bapak Alya', 'Aktif'),
(3, '103', 'Budi', 1, 'Jl. Kebon Jeruk No. 3', 'L', '2010-03-20', '081234567892', 'Bapak Budi', 'Aktif'),
(4, '104', 'Cici', 1, 'Jl. Kebon Jeruk No. 4', 'P', '2010-04-22', '081234567893', 'Bapak Cici', 'Aktif'),
(5, '105', 'Doni', 1, 'Jl. Kebon Jeruk No. 5', 'L', '2010-05-24', '081234567894', 'Bapak Doni', 'Aktif'),
(6, '106', 'Eva', 1, 'Jl. Kebon Jeruk No. 6', 'P', '2010-06-26', '081234567895', 'Bapak Eva', 'Aktif'),
(7, '107', 'Fahri', 1, 'Jl. Kebon Jeruk No. 7', 'L', '2010-07-28', '081234567896', 'Bapak Fahri', 'Aktif'),
(8, '108', 'Gita', 1, 'Jl. Kebon Jeruk No. 8', 'P', '2010-08-30', '081234567897', 'Bapak Gita', 'Aktif'),
(9, '109', 'Hana', 1, 'Jl. Kebon Jeruk No. 9', 'P', '2010-09-02', '081234567898', 'Bapak Hana', 'Aktif'),
(10, '110', 'Irfan', 1, 'Jl. Kebon Jeruk No. 10', 'L', '2010-10-04', '081234567899', 'Bapak Irfan', 'Aktif'),
(11, '201', 'Joko', 2, 'Jl. Melati No. 1', 'L', '2011-01-12', '081234567900', 'Bapak Joko', 'Aktif'),
(12, '202', 'Kiki', 2, 'Jl. Melati No. 2', 'P', '2011-02-14', '081234567901', 'Bapak Kiki', 'Aktif'),
(13, '203', 'Lina', 2, 'Jl. Melati No. 3', 'P', '2011-03-16', '081234567902', 'Bapak Lina', 'Aktif'),
(14, '204', 'Miko', 2, 'Jl. Melati No. 4', 'L', '2011-04-18', '081234567903', 'Bapak Miko', 'Aktif'),
(15, '205', 'Nina', 2, 'Jl. Melati No. 5', 'P', '2011-05-20', '081234567904', 'Bapak Nina', 'Aktif'),
(16, '206', 'Omar', 2, 'Jl. Melati No. 6', 'L', '2011-06-22', '081234567905', 'Bapak Omar', 'Aktif'),
(17, '207', 'Puti', 2, 'Jl. Melati No. 7', 'P', '2011-07-24', '081234567906', 'Bapak Puti', 'Aktif'),
(18, '208', 'Qori', 2, 'Jl. Melati No. 8', 'P', '2011-08-26', '081234567907', 'Bapak Qori', 'Aktif'),
(19, '209', 'Rian', 2, 'Jl. Melati No. 9', 'L', '2011-09-28', '081234567908', 'Bapak Rian', 'Aktif'),
(20, '210', 'Sari', 2, 'Jl. Melati No. 10', 'P', '2011-10-30', '081234567909', 'Bapak Sari', 'Aktif'),
(21, '301', 'Tina', 3, 'Jl. Mawar No. 1', 'P', '2012-01-10', '081234567910', 'Bapak Tina', 'Aktif'),
(22, '302', 'Udin', 3, 'Jl. Mawar No. 2', 'L', '2012-02-13', '081234567911', 'Bapak Udin', 'Aktif'),
(23, '303', 'Vina', 3, 'Jl. Mawar No. 3', 'P', '2012-03-15', '081234567912', 'Bapak Vina', 'Aktif'),
(24, '304', 'Wawan', 3, 'Jl. Mawar No. 4', 'L', '2012-04-17', '081234567913', 'Bapak Wawan', 'Aktif'),
(25, '305', 'Xena', 3, 'Jl. Mawar No. 5', 'P', '2012-05-19', '081234567914', 'Bapak Xena', 'Aktif'),
(26, '306', 'Yoga', 3, 'Jl. Mawar No. 6', 'L', '2012-06-21', '081234567915', 'Bapak Yoga', 'Aktif'),
(27, '307', 'Zara', 3, 'Jl. Mawar No. 7', 'P', '2012-07-23', '081234567916', 'Bapak Zara', 'Aktif'),
(28, '308', 'Agus', 3, 'Jl. Mawar No. 8', 'L', '2012-08-25', '081234567917', 'Bapak Agus', 'Aktif'),
(29, '309', 'Bella', 3, 'Jl. Mawar No. 9', 'P', '2012-09-27', '081234567918', 'Bapak Bella', 'Aktif'),
(30, '310', 'Candra', 3, 'Jl. Mawar No. 10', 'L', '2012-10-29', '081234567919', 'Bapak Candra', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nm_pengguna` varchar(100) DEFAULT NULL,
  `level` varchar(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nm_pengguna`, `level`, `status`) VALUES
(1, 'ulya', 'ulya', 'ulya', 'wakasiswa', 'active'),
(2, 'guru', 'guru', 'guru', 'guru', 'active'),
(3, 'bagus', 'bagus', 'bagus', 'wakasiswa', 'active'),
(4, 'adi', 'adi123', 'adi', 'guru', 'active'),
(5, 'budi', 'budi123', 'budi', 'guru', 'active'),
(6, 'sita', 'sita123', 'sita', 'guru', 'active'),
(7, 'dina', 'dina123', 'dina', 'guru', 'active'),
(8, 'joni', 'joni123', 'joni', 'guru', 'active'),
(9, 'putra', 'putra123', 'putra', 'guru', 'active'),
(10, 'ana', 'ana123', 'ana', 'guru', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ekstra`
--
ALTER TABLE `ekstra`
  ADD PRIMARY KEY (`id_ekstra`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `ekstra_siswa`
--
ALTER TABLE `ekstra_siswa`
  ADD PRIMARY KEY (`id_ekstra_siswa`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_ekstra` (`id_ekstra`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jadwal_siswa`
--
ALTER TABLE `jadwal_siswa`
  ADD PRIMARY KEY (`id_jadwal_siswa`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `kehadiran_siswa`
--
ALTER TABLE `kehadiran_siswa`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `nilai_ekstra`
--
ALTER TABLE `nilai_ekstra`
  ADD PRIMARY KEY (`id_nilai_ekstra`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `nilai_mapel`
--
ALTER TABLE `nilai_mapel`
  ADD PRIMARY KEY (`id_nilai_mapel`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ekstra`
--
ALTER TABLE `ekstra`
  MODIFY `id_ekstra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ekstra_siswa`
--
ALTER TABLE `ekstra_siswa`
  MODIFY `id_ekstra_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jadwal_siswa`
--
ALTER TABLE `jadwal_siswa`
  MODIFY `id_jadwal_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=380;

--
-- AUTO_INCREMENT for table `kehadiran_siswa`
--
ALTER TABLE `kehadiran_siswa`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai_ekstra`
--
ALTER TABLE `nilai_ekstra`
  MODIFY `id_nilai_ekstra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai_mapel`
--
ALTER TABLE `nilai_mapel`
  MODIFY `id_nilai_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ekstra`
--
ALTER TABLE `ekstra`
  ADD CONSTRAINT `ekstra_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`);

--
-- Constraints for table `ekstra_siswa`
--
ALTER TABLE `ekstra_siswa`
  ADD CONSTRAINT `ekstra_siswa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `ekstra_siswa_ibfk_2` FOREIGN KEY (`id_ekstra`) REFERENCES `ekstra` (`id_ekstra`);

--
-- Constraints for table `jadwal_siswa`
--
ALTER TABLE `jadwal_siswa`
  ADD CONSTRAINT `jadwal_siswa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `jadwal_siswa_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  ADD CONSTRAINT `jadwal_siswa_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `kehadiran_siswa`
--
ALTER TABLE `kehadiran_siswa`
  ADD CONSTRAINT `kehadiran_siswa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`);

--
-- Constraints for table `nilai_ekstra`
--
ALTER TABLE `nilai_ekstra`
  ADD CONSTRAINT `nilai_ekstra_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `nilai_mapel`
--
ALTER TABLE `nilai_mapel`
  ADD CONSTRAINT `nilai_mapel_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_siswa` (`id_jadwal_siswa`),
  ADD CONSTRAINT `nilai_mapel_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
