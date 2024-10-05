-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 04:10 AM
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
-- Database: `danis`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat_pelanggan`
--

CREATE TABLE `alamat_pelanggan` (
  `id_alamat` varchar(11) NOT NULL,
  `id_pelanggan` varchar(11) DEFAULT NULL,
  `ket_alamat` text DEFAULT NULL,
  `lat_alamat` text DEFAULT NULL,
  `long_alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alamat_pelanggan`
--

INSERT INTO `alamat_pelanggan` (`id_alamat`, `id_pelanggan`, `ket_alamat`, `lat_alamat`, `long_alamat`) VALUES
('AL001', 'PL001', '1', '-6.743714', '110.839350');

-- --------------------------------------------------------

--
-- Table structure for table `berkas_pemasangan`
--

CREATE TABLE `berkas_pemasangan` (
  `id_berkas_pemasangan` varchar(11) NOT NULL,
  `id_pemasangan` varchar(11) DEFAULT NULL,
  `nm_berkas` varchar(50) DEFAULT NULL,
  `foto_berkas` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berkas_pemasangan`
--

INSERT INTO `berkas_pemasangan` (`id_berkas_pemasangan`, `id_pemasangan`, `nm_berkas`, `foto_berkas`) VALUES
('BP001', 'PS001', 'berkas pemasangan', 0x323032344f63744672693034333934307777772e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` varchar(11) NOT NULL,
  `nm_layanan` varchar(50) DEFAULT NULL,
  `ket_layanan` varchar(100) DEFAULT NULL,
  `harga_layanan` int(100) DEFAULT NULL,
  `jenis_layanan` enum('Pemasangan Baru','Biaya Pemakaian','Perawatan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nm_layanan`, `ket_layanan`, `harga_layanan`, `jenis_layanan`) VALUES
('LY001', 'Pemasangan Baru Alat Stan Meter', 'Pemasangan Baru', 1750000, 'Pemasangan Baru'),
('LY002', 'Pemakaian Air', 'Pemakaian Air', 50000, 'Biaya Pemakaian'),
('LY003', 'Perawatan Bulanan', 'Perawatan Bulanan', 10000, 'Perawatan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(11) NOT NULL,
  `id_user` varchar(11) DEFAULT NULL,
  `nm_pelanggan` varchar(100) DEFAULT NULL,
  `no_pelanggan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `nm_pelanggan`, `no_pelanggan`) VALUES
('PL001', 'U008', 'John Doe', '82327591195'),
('PL002', 'U009', 'Mary jane', '82327591195'),
('PL003', 'U0010', 'Fatimah', '82327591195'),
('PL006', 'U0013', 'Imanuel', '82327591195'),
('PL007', 'U009', 'Mary Jane', '82327591195'),
('PL008', 'U0014', 'ayuk', '89776788789');

-- --------------------------------------------------------

--
-- Table structure for table `pemasangan`
--

CREATE TABLE `pemasangan` (
  `id_pemasangan` varchar(11) NOT NULL,
  `id_pelanggan` varchar(11) DEFAULT NULL,
  `id_user` varchar(11) DEFAULT NULL,
  `tgl_permintaan_pemasangan` date DEFAULT NULL,
  `tgl_realisasi_pekerjaan` date DEFAULT NULL,
  `tgl_tagihan` int(11) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `status_pemasangan` enum('Pengajuan','Proses','Realisasi') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasangan`
--

INSERT INTO `pemasangan` (`id_pemasangan`, `id_pelanggan`, `id_user`, `tgl_permintaan_pemasangan`, `tgl_realisasi_pekerjaan`, `tgl_tagihan`, `biaya`, `status_pemasangan`) VALUES
('PS001', 'PL001', 'U006', '2024-10-03', '0000-00-00', 5, 1750000, 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(11) NOT NULL,
  `id_pemasangan` varchar(11) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `ket_pembayaran` text DEFAULT NULL,
  `status` enum('upload','tervalidasi') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pencatatan_penggunaan`
--

CREATE TABLE `pencatatan_penggunaan` (
  `id_pencatatan` varchar(11) NOT NULL,
  `id_pemasangan` varchar(50) DEFAULT NULL,
  `nomor_pasang` varchar(100) DEFAULT NULL,
  `nilai_stand_meter` int(100) DEFAULT NULL,
  `foto_stand_meter` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` varchar(11) NOT NULL,
  `id_pemasangan` varchar(11) DEFAULT NULL,
  `id_user` varchar(11) DEFAULT NULL,
  `tgl_pengaduan` date DEFAULT NULL,
  `tgl_perbaikan` date DEFAULT NULL,
  `ket_kendala` text DEFAULT NULL,
  `foto_kendala` blob DEFAULT NULL,
  `status_pengaduan` enum('Pengaduan','Proses','Terselesaikan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `id_pemasangan`, `id_user`, `tgl_pengaduan`, `tgl_perbaikan`, `ket_kendala`, `foto_kendala`, `status_pengaduan`) VALUES
('PD001', 'PS001', 'U006', '2024-10-05', '2024-10-05', '1', 0x323032344f6374536174303333373533636f7665722e6a7067, 'Terselesaikan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nm_pengguna` varchar(100) DEFAULT NULL,
  `level` enum('pelanggan','petugas bumdes','petugas lapangan','ketua unit air','ketua bumdes') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nm_pengguna`, `level`) VALUES
('U001', 'bumdes1', '1', 'Andi Budi', 'petugas bumdes'),
('U0010', 'pelanggan3', '1', 'Fatimah Syah', 'pelanggan'),
('U0013', 'pelanggan4', '1', 'Imanuel', 'pelanggan'),
('U0014', 'ayuk', 'ayuk', 'ayuk', 'pelanggan'),
('U002', 'bumdes2', '1', 'Ali Rahman', 'petugas bumdes'),
('U003', 'ketuabumdes1', '1', 'Siti Rahma', 'ketua bumdes'),
('U004', 'ketuaunit1', '1', 'Bambang Hartono', 'ketua unit air'),
('U005', 'ketuaunit2', '1', 'Ridwan Karim', 'ketua unit air'),
('U006', 'lapangan1', '1', 'Rino Sori', 'petugas lapangan'),
('U007', 'lapangan2', '1', 'Dedi Supriadi', 'petugas lapangan'),
('U008', 'pelanggan1', '1', 'John Doe', 'pelanggan'),
('U009', 'pelanggan2', '1', 'Mary Jane', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat_pelanggan`
--
ALTER TABLE `alamat_pelanggan`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indexes for table `berkas_pemasangan`
--
ALTER TABLE `berkas_pemasangan`
  ADD PRIMARY KEY (`id_berkas_pemasangan`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pemasangan`
--
ALTER TABLE `pemasangan`
  ADD PRIMARY KEY (`id_pemasangan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pencatatan_penggunaan`
--
ALTER TABLE `pencatatan_penggunaan`
  ADD PRIMARY KEY (`id_pencatatan`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
