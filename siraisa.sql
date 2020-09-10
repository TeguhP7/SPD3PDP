-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 04:40 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siraisa`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip_surat_keluar`
--

CREATE TABLE `arsip_surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `no_surat` text NOT NULL,
  `nama_surat` varchar(50) NOT NULL,
  `nama_file` text NOT NULL,
  `ukuran` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsip_surat_keluar`
--

INSERT INTO `arsip_surat_keluar` (`id_surat_keluar`, `no_surat`, `nama_surat`, `nama_file`, `ukuran`) VALUES
(1, 'XXX/2020/Surat Peminjaman/...', 'Surat Peminjaman', 'sepatu.jpg', 79.3);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jenis_barang` varchar(50) NOT NULL,
  `id_penyedia` int(50) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `jenis_barang`, `id_penyedia`, `jumlah`) VALUES
(16, 'ATK Faber Castell', 'Perlengkapan', 11, 36),
(17, 'Cannon Printer', 'Elektronik', 13, 6),
(18, 'Kursi', 'Furniture', 12, 150);

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id` int(50) NOT NULL,
  `nama_aset` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi` enum('Baik','Rusak') NOT NULL,
  `keterangan_lain` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id`, `nama_aset`, `jumlah`, `kondisi`, `keterangan_lain`) VALUES
(1, 'Kursi', 150, 'Baik', 'Ada beberapa yang sudah usang'),
(3, 'Komputer', 15, 'Baik', '-'),
(4, 'Printer', 6, 'Baik', 'Masih bagus'),
(5, 'Panggung', 2, 'Baik', ''),
(6, 'Gelas', 300, 'Baik', ''),
(7, 'Meja', 20, 'Baik', '');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(50) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `password` int(11) NOT NULL,
  `alamat_pegawai` varchar(50) NOT NULL,
  `notelp_pegawai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `password`, `alamat_pegawai`, `notelp_pegawai`) VALUES
(1, 'M. Wawan Radiseksa', 123, 'Jl Singgalang', '082285182758'),
(2, 'Bambang Sudarsono', 1234, 'Jl Batam', '08226754637');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(50) NOT NULL,
  `id_barang` int(50) NOT NULL,
  `tanggal` date NOT NULL,
  `harga_satuan` text NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_belanja` varchar(50) NOT NULL,
  `id_pegawai` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_barang`, `tanggal`, `harga_satuan`, `jumlah_barang`, `total_belanja`, `id_pegawai`) VALUES
(1, 18, '2019-11-07', 'Rp. 100.000 , -', 150, 'Rp 15.000.000,-', 1),
(2, 16, '2019-12-16', 'Rp. 30.000 , -', 20, 'Rp 600.000,-', 2),
(3, 17, '2020-01-17', 'Rp. 1.000.000,-', 3, 'Rp. 3.000.000,-', 2),
(4, 16, '2020-01-14', 'Rp. 30.000,-', 5, 'Rp. 150.000,-', 2);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(50) NOT NULL,
  `nama_peminjam` varchar(50) NOT NULL,
  `id_pinjam_barang` int(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` enum('Belum Dikembalikan','Sudah Dikembalikan','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `nama_peminjam`, `id_pinjam_barang`, `jumlah`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`) VALUES
(1, 'Wadi Suratman', 1, 80, '2020-01-01', '0000-00-00', 'Belum Dikembalikan'),
(3, 'Soni', 2, 1, '2020-01-13', '0000-00-00', 'Belum Dikembalikan'),
(5, 'Sulasthree', 3, 2, '2020-01-13', '0000-00-00', 'Belum Dikembalikan');

-- --------------------------------------------------------

--
-- Table structure for table `penyedia`
--

CREATE TABLE `penyedia` (
  `id_penyedia` int(50) NOT NULL,
  `nama_penyedia` varchar(50) NOT NULL,
  `alamat_penyedia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyedia`
--

INSERT INTO `penyedia` (`id_penyedia`, `nama_penyedia`, `alamat_penyedia`) VALUES
(11, 'Toko Hassan Puta Jaya', 'Jl Dahlia'),
(12, 'PT. Harapan Furniture', 'Jl. Nakula Sadewa'),
(13, 'XOXO Komputer', 'Jl. Mataram');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_barang`
--

CREATE TABLE `pinjam_barang` (
  `id_pinjam_barang` int(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_sewa` text NOT NULL,
  `keterangan_lain` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjam_barang`
--

INSERT INTO `pinjam_barang` (`id_pinjam_barang`, `nama_barang`, `jumlah`, `harga_sewa`, `keterangan_lain`) VALUES
(1, 'Kursi', 150, 'Rp. 2000,-', 'Kursi plastik warna hijau'),
(2, 'Tratak', 2, 'Rp. 100.000,-', '@ 4 x 6 meter '),
(3, 'Gerobak dorong', 3, 'Rp. 5000,-', 'Gerobak bangunan dari kayu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `status`) VALUES
('admin', 'admin', 'admin'),
('riski', 'riski', 'Warga'),
('teguh', 'teguh', 'developer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip_surat_keluar`
--
ALTER TABLE `arsip_surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_penyedia` (`id_penyedia`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_barang_2` (`id_barang`),
  ADD KEY `id_karyawan` (`id_pegawai`),
  ADD KEY `id_karyawan_2` (`id_pegawai`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `penyedia`
--
ALTER TABLE `penyedia`
  ADD PRIMARY KEY (`id_penyedia`);

--
-- Indexes for table `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  ADD PRIMARY KEY (`id_pinjam_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip_surat_keluar`
--
ALTER TABLE `arsip_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penyedia`
--
ALTER TABLE `penyedia`
  MODIFY `id_penyedia` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  MODIFY `id_pinjam_barang` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_penyedia`) REFERENCES `penyedia` (`id_penyedia`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
