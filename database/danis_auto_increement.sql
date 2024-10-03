-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 08:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `id_alamat` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `ket_alamat` text DEFAULT NULL,
  `lat_alamat` text DEFAULT NULL,
  `long_alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alamat_pelanggan`
--

INSERT INTO `alamat_pelanggan` (`id_alamat`, `id_pelanggan`, `ket_alamat`, `lat_alamat`, `long_alamat`) VALUES
(2, 2, '--llll-l-lllllllllllll', 'l-', '-ll-lll-l'),
(4, 1, '3', '110.724178', '-6.7088097'),
(5, 1, '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `berkas_pemasangan`
--

CREATE TABLE `berkas_pemasangan` (
  `id_berkas_pemasangan` int(11) NOT NULL,
  `id_pemasangan` int(11) DEFAULT NULL,
  `nm_berkas` varchar(50) DEFAULT NULL,
  `foto_berkas` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berkas_pemasangan`
--

INSERT INTO `berkas_pemasangan` (`id_berkas_pemasangan`, `id_pemasangan`, `nm_berkas`, `foto_berkas`) VALUES
(1, 1, 'PDAM', 0x32303234536570547565303732353336426572696b75742d496e692d436172612d43656b2d4d65746572616e2d5044414d2d59616e672d4261696b2d44616e2d42656e61722d31303234783537362e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nm_layanan` varchar(50) DEFAULT NULL,
  `ket_layanan` varchar(100) DEFAULT NULL,
  `harga_layanan` int(100) DEFAULT NULL,
  `jenis_layanan` enum('Pemasangan Baru','Biaya Pemakaian','Perawatan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nm_layanan`, `ket_layanan`, `harga_layanan`, `jenis_layanan`) VALUES
(1, 'Pemasangan Pipa Baru', 'Pemasangan pipa distribusi air baru untuk pelanggan', 500000, 'Pemasangan Baru'),
(2, 'Pemasangan Meteran', 'Pemasangan meteran air untuk pelanggan baru', 250000, 'Pemasangan Baru'),
(3, 'Biaya Penggunaan Air', 'Biaya bulanan penggunaan air minum', 100000, 'Biaya Pemakaian'),
(4, 'Perawatan Pipa', 'Perawatan pipa distribusi air untuk mencegah kebocoran', 300000, 'Perawatan'),
(5, 'Perbaikan Kebocoran', 'Perbaikan kebocoran pada pipa utama', 450000, 'Perawatan'),
(6, 'Pembersihan Tangki Air', 'Pembersihan dan perawatan tangki penyimpanan air', 150000, 'Perawatan'),
(7, 'Instalasi Ulang Meteran', 'Penggantian meteran yang rusak atau usang', 200000, 'Pemasangan Baru'),
(8, 'Biaya Penggunaan Air Minum', 'Biaya bulanan penggunaan air minum bersih', 120000, 'Biaya Pemakaian'),
(9, 'Pemasangan Filter Air', 'Pemasangan filter air untuk penyaringan tambahan', 350000, 'Pemasangan Baru'),
(10, 'Penggantian Pipa Rusak', 'Penggantian pipa air yang rusak atau bocor', 400000, 'Perawatan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nm_pelanggan` varchar(100) DEFAULT NULL,
  `no_pelanggan` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `nm_pelanggan`, `no_pelanggan`) VALUES
(1, 8, 'John Doe', 1),
(2, 9, 'Mary jane', 2),
(3, 10, 'Fatimah', 3),
(4, 11, 'James', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemasangan`
--

CREATE TABLE `pemasangan` (
  `id_pemasangan` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_permintaan_pemasangan` date DEFAULT NULL,
  `tgl_realisasi_pekerjaan` date DEFAULT NULL,
  `tgl_tagihan` date DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `status_pemasangan` enum('Pengajuan','Proses','Realisasi') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemasangan`
--

INSERT INTO `pemasangan` (`id_pemasangan`, `id_pelanggan`, `id_user`, `tgl_permintaan_pemasangan`, `tgl_realisasi_pekerjaan`, `tgl_tagihan`, `biaya`, `status_pemasangan`) VALUES
(1, 1, 6, '2024-09-24', '2024-09-24', '0000-00-00', 50000, 'Realisasi');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pemasangan` int(11) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `ket_pembayaran` text DEFAULT NULL,
  `status` enum('upload','tervalidasi') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pencatatan_penggunaan`
--

CREATE TABLE `pencatatan_penggunaan` (
  `id_pencatatan` int(11) NOT NULL,
  `id_pemasangan` int(50) DEFAULT NULL,
  `nomor_pasang` varchar(100) DEFAULT NULL,
  `nilai_stand_meter` int(100) DEFAULT NULL,
  `foto_stand_meter` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pencatatan_penggunaan`
--

INSERT INTO `pencatatan_penggunaan` (`id_pencatatan`, `id_pemasangan`, `nomor_pasang`, `nilai_stand_meter`, `foto_stand_meter`) VALUES
(1, 1, 'ABCDEFGH', 5000, 0x323032345365705475653130333733345374616e642d416b6869722d65313639363737363737353733372e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `id_pemasangan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_pengaduan` date DEFAULT NULL,
  `tgl_perbaikan` date DEFAULT NULL,
  `ket_kendala` text DEFAULT NULL,
  `foto_kendala` blob DEFAULT NULL,
  `status_pengaduan` enum('Pengaduan','Proses','Terselesaikan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nm_pengguna` varchar(100) DEFAULT NULL,
  `level` enum('pelanggan','petugas bumdes','petugas lapangan','ketua unit air','ketua bumdes') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nm_pengguna`, `level`) VALUES
(1, 'bumdes1', '1', 'Andi Budi', 'petugas bumdes'),
(2, 'bumdes2', '1', 'Ali Rahman', 'petugas bumdes'),
(3, 'ketuabumdes1', '1', 'Siti Rahma', 'ketua bumdes'),
(4, 'ketuaunit1', '1', 'Bambang Hartono', 'ketua unit air'),
(5, 'ketuaunit2', '1', 'Ridwan Karim', 'ketua unit air'),
(6, 'lapangan1', '1', 'Rino Sori', 'petugas lapangan'),
(7, 'lapangan2', '1', 'Dedi Supriadi', 'petugas lapangan'),
(8, 'pelanggan1', '1', 'John Doe', 'pelanggan'),
(9, 'pelanggan2', '1', 'Mary Jane', 'pelanggan'),
(10, 'pelanggan3', '1', 'Fatimah Syah', 'pelanggan'),
(11, 'pelanggan4', '1', 'James', 'pelanggan');

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

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat_pelanggan`
--
ALTER TABLE `alamat_pelanggan`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `berkas_pemasangan`
--
ALTER TABLE `berkas_pemasangan`
  MODIFY `id_berkas_pemasangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemasangan`
--
ALTER TABLE `pemasangan`
  MODIFY `id_pemasangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pencatatan_penggunaan`
--
ALTER TABLE `pencatatan_penggunaan`
  MODIFY `id_pencatatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
