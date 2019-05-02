-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03 Mei 2018 pada 02.46
-- Versi Server: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_barang`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailbarang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detailbarang` (
`kd_barang` varchar(7)
,`nama_barang` varchar(40)
,`kd_merek` varchar(7)
,`kd_distributor` varchar(7)
,`tanggal_masuk` timestamp
,`harga_barang` int(7)
,`stok_barang` int(4)
,`gambar` varchar(100)
,`keterangan` varchar(100)
,`merek` varchar(30)
,`nama_distributor` varchar(40)
,`no_telp` varchar(13)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_barang`
--

CREATE TABLE `table_barang` (
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `kd_merek` varchar(7) NOT NULL,
  `kd_distributor` varchar(7) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `harga_barang` int(7) NOT NULL,
  `stok_barang` int(4) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_barang`
--

INSERT INTO `table_barang` (`kd_barang`, `nama_barang`, `kd_merek`, `kd_distributor`, `tanggal_masuk`, `harga_barang`, `stok_barang`, `gambar`, `keterangan`) VALUES
('B0001', 'Sepatu Futsal', 'M0002', 'D0002', '2018-03-25 06:17:51', 120000, 0, 's4.jpg', 'Barang Baru'),
('B0002', 'Sepatu', 'M0003', 'D0001', '2018-03-25 06:18:52', 70000, 0, 's6.jpg', 'Bagus'),
('B0003', 'SepBal', 'M0002', 'D0001', '2018-03-25 06:26:43', 350000, 0, 's5.jpg', 'Biasa tapi bagus'),
('B0004', 'Adidas F50', 'M0003', 'D0002', '2018-04-26 00:48:41', 100000, 8, 's12.jpg', 'Barang Berharga'),
('B0005', 'Nike S780', 'M0001', 'D0002', '2018-04-26 00:50:12', 120000, 64, 's7.jpg', 'bagus'),
('B0006', 'Futsal S90', 'M0005', 'D0002', '2018-04-26 00:52:37', 90000, 94, 's13.jpg', 'Hebat'),
('B0007', 'SepakBola CR7', 'M0002', 'D0002', '2018-04-26 00:54:10', 110000, 80, 's16.jpg', 'Biasa Aja'),
('B0008', 'Remade S90', 'M0003', 'D0001', '2018-04-26 00:55:48', 90000, 80, 's1.jpg', 'Keren'),
('B0009', 'Rainbow', 'M0001', 'D0001', '2018-04-26 00:57:36', 170000, 80, 's11.jpg', 'BBS'),
('B0010', 'NIke CR7', 'M0001', 'D0002', '2018-04-26 00:58:33', 90000, 80, 's20.jpg', 'Termahal'),
('B0011', 'BoitS Nike', 'M0002', 'D0002', '2018-04-26 00:59:23', 300000, 90, 's9.jpg', 'Hebat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_distributor`
--

CREATE TABLE `table_distributor` (
  `kd_distributor` varchar(7) NOT NULL,
  `nama_distributor` varchar(40) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_distributor`
--

INSERT INTO `table_distributor` (`kd_distributor`, `nama_distributor`, `alamat`, `no_telp`) VALUES
('D0001', 'Burhan', 'Cicurug', '0853633771778'),
('D0002', 'Bubun', 'Ciawi', '0865729283748');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_merek`
--

CREATE TABLE `table_merek` (
  `kd_merek` varchar(7) NOT NULL,
  `merek` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_merek`
--

INSERT INTO `table_merek` (`kd_merek`, `merek`) VALUES
('M0001', 'Adidas'),
('M0002', 'Nike'),
('M0003', 'Diadora'),
('M0005', 'MBB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_pretransaksi`
--

CREATE TABLE `table_pretransaksi` (
  `kd_pretransaksi` varchar(7) NOT NULL,
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_barang` varchar(7) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `sub_total` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_pretransaksi`
--

INSERT INTO `table_pretransaksi` (`kd_pretransaksi`, `kd_transaksi`, `kd_barang`, `jumlah`, `sub_total`) VALUES
('AN001', 'TR001', 'B0001', 26, 360000),
('AN002', 'TR001', 'B0004', 4, 400000),
('AN003', 'TR002', 'B0004', 5, 300000),
('AN004', 'TR002', 'B0007', 7, 770000),
('AN005', 'TR003', 'B0004', 6, 600000),
('AN006', 'TR004', 'B0004', 2, 200000),
('AN007', 'TR005', 'B0005', 1, 120000),
('AN008', 'TR006', 'B0005', 3, 120000),
('AN009', 'TR006', 'B0006', 2, 180000),
('AN010', 'TR007', 'B0005', 2, 240000),
('AN011', 'TR008', 'B0005', 3, 360000),
('AN012', 'TR008', 'B0006', 4, 360000),
('AN013', 'TR009', 'B0005', 7, 480000);

--
-- Trigger `table_pretransaksi`
--
DELIMITER $$
CREATE TRIGGER `batal_beli` AFTER DELETE ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang + OLD.jumlah
WHERE kd_barang = OLD.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaksi` AFTER INSERT ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang - new.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_beli` AFTER UPDATE ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang + OLD.jumlah - NEW.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_user` varchar(7) NOT NULL,
  `jumlah_beli` int(4) NOT NULL,
  `total_harga` int(8) NOT NULL,
  `bayar` int(20) NOT NULL,
  `kembalian` int(20) NOT NULL,
  `tanggal_beli` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_transaksi`
--

INSERT INTO `table_transaksi` (`kd_transaksi`, `kd_user`, `jumlah_beli`, `total_harga`, `bayar`, `kembalian`, `tanggal_beli`) VALUES
('TR001', 'P0002', 30, 760000, 800000, 40000, '2018-04-26 07:13:17'),
('TR002', 'P0002', 12, 1070000, 2000000, 930000, '2018-04-26 07:15:48'),
('TR003', 'P0002', 6, 600000, 700000, 100000, '2018-04-26 07:22:17'),
('TR004', 'P0002', 2, 200000, 200000, 0, '2018-04-26 07:23:19'),
('TR005', 'P0002', 1, 120000, 300000, 180000, '2018-04-26 07:26:51'),
('TR006', 'P0002', 5, 300000, 400000, 100000, '2018-04-26 07:31:26'),
('TR007', 'P0002', 2, 240000, 400000, 160000, '2018-04-26 07:37:40'),
('TR008', 'P0002', 7, 720000, 800000, 80000, '2018-04-26 07:43:19'),
('TR009', 'P0002', 7, 480000, 500000, 20000, '2018-04-27 05:39:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_user`
--

CREATE TABLE `table_user` (
  `kd_user` varchar(7) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` enum('Admin','Kasir','Manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_user`
--

INSERT INTO `table_user` (`kd_user`, `nama_user`, `username`, `password`, `level`) VALUES
('P0002', 'Muhamad Rivaldi', 'sir', 'a2FzaXI=', 'Kasir'),
('P0003', 'Valdos', 'manager', 'bWFuYWdlcnM=', 'Manager'),
('P0004', 'Mahmud', 'admin', 'YWRtaW5z', 'Admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `transaksi` (
`kd_pretransaksi` varchar(7)
,`kd_transaksi` varchar(7)
,`jumlah` int(4)
,`sub_total` int(8)
,`jumlah_beli` int(4)
,`total_harga` int(8)
,`bayar` int(20)
,`kembalian` int(20)
,`tanggal_beli` timestamp
,`nama_barang` varchar(40)
,`merek` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi_terbaru`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `transaksi_terbaru` (
`kd_transaksi` varchar(7)
,`kd_user` varchar(7)
,`jumlah_beli` int(4)
,`total_harga` int(8)
,`tanggal_beli` timestamp
,`nama_user` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_transaksi` (
`kd_pretransaksi` varchar(7)
,`kd_transaksi` varchar(7)
,`kd_barang` varchar(7)
,`jumlah` int(4)
,`sub_total` int(8)
,`nama_barang` varchar(40)
,`harga_barang` int(7)
,`jumlah_beli` int(4)
,`total_harga` int(8)
,`tanggal_beli` timestamp
);

-- --------------------------------------------------------

--
-- Struktur untuk view `detailbarang`
--
DROP TABLE IF EXISTS `detailbarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailbarang`  AS  select `table_barang`.`kd_barang` AS `kd_barang`,`table_barang`.`nama_barang` AS `nama_barang`,`table_barang`.`kd_merek` AS `kd_merek`,`table_barang`.`kd_distributor` AS `kd_distributor`,`table_barang`.`tanggal_masuk` AS `tanggal_masuk`,`table_barang`.`harga_barang` AS `harga_barang`,`table_barang`.`stok_barang` AS `stok_barang`,`table_barang`.`gambar` AS `gambar`,`table_barang`.`keterangan` AS `keterangan`,`table_merek`.`merek` AS `merek`,`table_distributor`.`nama_distributor` AS `nama_distributor`,`table_distributor`.`no_telp` AS `no_telp` from ((`table_barang` join `table_merek` on((`table_barang`.`kd_merek` = `table_merek`.`kd_merek`))) join `table_distributor` on((`table_barang`.`kd_distributor` = `table_distributor`.`kd_distributor`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `transaksi`
--
DROP TABLE IF EXISTS `transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi`  AS  select `table_pretransaksi`.`kd_pretransaksi` AS `kd_pretransaksi`,`table_pretransaksi`.`kd_transaksi` AS `kd_transaksi`,`table_pretransaksi`.`jumlah` AS `jumlah`,`table_pretransaksi`.`sub_total` AS `sub_total`,`table_transaksi`.`jumlah_beli` AS `jumlah_beli`,`table_transaksi`.`total_harga` AS `total_harga`,`table_transaksi`.`bayar` AS `bayar`,`table_transaksi`.`kembalian` AS `kembalian`,`table_transaksi`.`tanggal_beli` AS `tanggal_beli`,`table_barang`.`nama_barang` AS `nama_barang`,`table_merek`.`merek` AS `merek` from (((`table_pretransaksi` join `table_transaksi` on((`table_pretransaksi`.`kd_transaksi` = `table_transaksi`.`kd_transaksi`))) join `table_barang` on((`table_pretransaksi`.`kd_barang` = `table_barang`.`kd_barang`))) join `table_merek` on((`table_barang`.`kd_merek` = `table_merek`.`kd_merek`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `transaksi_terbaru`
--
DROP TABLE IF EXISTS `transaksi_terbaru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_terbaru`  AS  select `table_transaksi`.`kd_transaksi` AS `kd_transaksi`,`table_user`.`kd_user` AS `kd_user`,`table_transaksi`.`jumlah_beli` AS `jumlah_beli`,`table_transaksi`.`total_harga` AS `total_harga`,`table_transaksi`.`tanggal_beli` AS `tanggal_beli`,`table_user`.`nama_user` AS `nama_user` from (`table_transaksi` join `table_user` on((`table_transaksi`.`kd_user` = `table_user`.`kd_user`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_transaksi`
--
DROP TABLE IF EXISTS `view_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi`  AS  select `table_pretransaksi`.`kd_pretransaksi` AS `kd_pretransaksi`,`table_pretransaksi`.`kd_transaksi` AS `kd_transaksi`,`table_pretransaksi`.`kd_barang` AS `kd_barang`,`table_pretransaksi`.`jumlah` AS `jumlah`,`table_pretransaksi`.`sub_total` AS `sub_total`,`table_barang`.`nama_barang` AS `nama_barang`,`table_barang`.`harga_barang` AS `harga_barang`,`table_transaksi`.`jumlah_beli` AS `jumlah_beli`,`table_transaksi`.`total_harga` AS `total_harga`,`table_transaksi`.`tanggal_beli` AS `tanggal_beli` from ((`table_pretransaksi` join `table_barang` on((`table_pretransaksi`.`kd_barang` = `table_barang`.`kd_barang`))) join `table_transaksi` on((`table_pretransaksi`.`kd_transaksi` = `table_transaksi`.`kd_transaksi`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_barang`
--
ALTER TABLE `table_barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `kd_distributor` (`kd_distributor`),
  ADD KEY `kd_merek` (`kd_merek`);

--
-- Indexes for table `table_distributor`
--
ALTER TABLE `table_distributor`
  ADD PRIMARY KEY (`kd_distributor`);

--
-- Indexes for table `table_merek`
--
ALTER TABLE `table_merek`
  ADD PRIMARY KEY (`kd_merek`);

--
-- Indexes for table `table_pretransaksi`
--
ALTER TABLE `table_pretransaksi`
  ADD PRIMARY KEY (`kd_pretransaksi`);

--
-- Indexes for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`),
  ADD KEY `kd_user` (`kd_user`) USING BTREE,
  ADD KEY `kd_user_2` (`kd_user`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`kd_user`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `table_barang`
--
ALTER TABLE `table_barang`
  ADD CONSTRAINT `table_barang_ibfk_2` FOREIGN KEY (`kd_merek`) REFERENCES `table_merek` (`kd_merek`),
  ADD CONSTRAINT `table_barang_ibfk_3` FOREIGN KEY (`kd_distributor`) REFERENCES `table_distributor` (`kd_distributor`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD CONSTRAINT `table_transaksi_ibfk_1` FOREIGN KEY (`kd_user`) REFERENCES `table_user` (`kd_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
