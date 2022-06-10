-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb-server
-- Generation Time: May 28, 2022 at 09:17 AM
-- Server version: 10.7.3-MariaDB-1:10.7.3+maria~focal
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_karywan_smart_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_alternatif`
--

CREATE TABLE `data_alternatif` (
  `id` int(11) NOT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_penilaian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_alternatif`
--

INSERT INTO `data_alternatif` (`id`, `id_kurir`, `nilai`, `id_penilaian`) VALUES
(39, 9, 'Memahami OMS Aplikasi Kurir, Kemampuan Mapping Yang Baik, Dan Memahami Wilayah Pengiriman', 3),
(40, 9, '1500 paket', 56),
(41, 9, '0 paket', 57),
(42, 9, '800 paket', 63),
(43, 9, '0 customer', 64),
(44, 9, '10 jam', 69),
(45, 9, 'Paket Telah Di Delivery Dan Membayar Uang COD (cash On Delivery) Tepat Waktu', 52),
(46, 10, 'Kemampuan Mapping Yang Baik Dan Menguasai Wilayah Pengiriman', 2),
(47, 10, '1200 paket', 55),
(48, 10, '25 paket', 58),
(49, 10, '500 paket', 61),
(50, 10, '2 customer', 65),
(51, 10, '8 jam', 68),
(52, 10, 'Melakukan Tindakan Mengurangi Jumlah Uang COD (cash On Delivery) Yang Akan Dibayarkan', 51),
(53, 17, 'Memahami Sistem OMS Pada Software Atau Aplikasi Kurir', 1),
(54, 17, '500 paket', 54),
(55, 17, '50 paket', 59),
(56, 17, '100 paket', 60),
(57, 17, '5 customer', 66),
(58, 17, '5 jam', 67),
(59, 17, 'Membawa Paket Dan Tidak Didelivery Secara Sengaja Lebih Dari 10', 50),
(67, 4, 'Kemampuan Mapping Yang Baik Dan Menguasai Wilayah Pengiriman', 2),
(68, 4, '300 paket', 54),
(69, 4, '60 paket', 59),
(70, 4, '40 paket', 60),
(71, 4, '10 customer', 66),
(72, 4, '4 jam', 67),
(73, 4, 'Membawa Paket Dan Tidak Didelivery Secara Sengaja Lebih Dari 10', 50);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `nama_karyawan`, `tanggal_lahir`, `alamat`) VALUES
(1, NULL, 'Achmad Gilang Romadhon', NULL, NULL),
(2, NULL, 'Abdillah Fachrudin', NULL, NULL),
(3, NULL, 'Arief', NULL, NULL),
(4, NULL, 'Anggi Setya Putra', NULL, NULL),
(5, NULL, 'Dimas Arganatha Dwi Putro', NULL, NULL),
(6, NULL, 'Ezra Putra Perdana', NULL, NULL),
(7, NULL, 'Fajar Shodiq', NULL, NULL),
(8, NULL, 'Facrur Reza', NULL, NULL),
(9, NULL, 'Heri Santoso Ramadani', NULL, NULL),
(10, NULL, 'Hafidz Sofyan Miftah', NULL, NULL),
(11, NULL, 'Iwang Ahmad Nugraha', NULL, NULL),
(12, NULL, 'Moch. Rachman Firmansyah', NULL, NULL),
(13, NULL, 'Mansur', NULL, NULL),
(14, NULL, 'Mujiono', NULL, NULL),
(15, NULL, 'Moch. Jefrey Devito', NULL, NULL),
(16, NULL, 'Moch. Cholik', NULL, NULL),
(17, NULL, 'Mohamad Ubaidullah', NULL, NULL),
(18, NULL, 'Mochamad Musta\'in, SE', NULL, NULL),
(19, NULL, 'Moch Reza', NULL, NULL),
(20, NULL, 'Adri Yudha', NULL, NULL),
(21, NULL, 'Ilham Tri', NULL, NULL),
(22, NULL, 'Ikbar Rastujawi', NULL, NULL),
(23, NULL, 'Eka', NULL, NULL),
(24, NULL, 'Asyrof', NULL, NULL),
(25, NULL, 'Fadhli', NULL, NULL),
(26, NULL, 'Dimas Rendi Adi Susanto', NULL, NULL),
(27, NULL, 'Qodhi Fakhrul Islam', NULL, NULL),
(28, NULL, 'Roy Hartanto Lapian', NULL, NULL),
(29, NULL, 'Rahmad Hendrawan', NULL, NULL),
(30, NULL, 'Rubiantoro', NULL, NULL),
(31, NULL, 'Setiyo Hadi Raharjo', NULL, NULL),
(32, NULL, 'Yogi Prakoso', NULL, NULL),
(33, NULL, 'Mohammad Rizky Aditya ', NULL, NULL),
(34, NULL, 'Angga Aji Prayoga', NULL, NULL),
(35, NULL, 'Alif Surya Perdana', NULL, NULL),
(36, NULL, 'Achmad Dika Satria', NULL, NULL),
(37, NULL, 'Alvin Hafidz', NULL, NULL),
(38, NULL, 'Roni Firmansyah', NULL, NULL),
(39, NULL, 'Heri Supriadi', NULL, NULL),
(40, NULL, 'Wiyatno', NULL, NULL),
(41, NULL, 'Rahmat hidayat', NULL, NULL),
(42, NULL, 'Muhammad Fajar A', NULL, NULL),
(43, NULL, 'Ach Helmi', NULL, NULL),
(44, NULL, 'Achmad Sukiman', NULL, NULL),
(45, NULL, 'Andi Rifai', NULL, NULL),
(46, NULL, 'Andre Maliki', NULL, NULL),
(47, NULL, 'Anugrah Rangga', NULL, NULL),
(48, NULL, 'Billy A A', NULL, NULL),
(49, NULL, 'Ardi Tri Krisdianto', NULL, NULL),
(50, NULL, 'Ardito Sumarta', NULL, NULL),
(51, NULL, 'Aswin', NULL, NULL),
(52, NULL, 'Candra Wahyu Agung', NULL, NULL),
(56, NULL, 'Catur Wibowo', NULL, NULL),
(57, NULL, 'Danang Sawong Sethowono', NULL, NULL),
(58, NULL, 'Deddy Dermawan', NULL, NULL),
(59, NULL, 'Didik Kuswanto', NULL, NULL),
(60, NULL, 'Dimas Bagus Prakoso', NULL, NULL),
(61, NULL, 'Dimas Mahendra', NULL, NULL),
(62, NULL, 'Dwiki Wahyu', NULL, NULL),
(63, NULL, 'Eko Mardianto', NULL, NULL),
(64, NULL, 'Erwin Santoso', NULL, NULL),
(65, NULL, 'Fakhrul Ivan Setiadji', NULL, NULL),
(66, NULL, 'Fatchur Affandi', NULL, NULL),
(67, NULL, 'Febri Yuri Perka', NULL, NULL),
(68, NULL, 'Ferdiansyah Putra Irawan', NULL, NULL),
(69, NULL, 'Gatot Denny Susanto', NULL, NULL),
(70, NULL, 'Ilham Furkoni Said', NULL, NULL),
(71, NULL, 'Ilham Saifur Rohman', NULL, NULL),
(72, NULL, 'Irfan Septirio', NULL, NULL),
(73, NULL, 'Irfan Afandi', NULL, NULL),
(74, NULL, 'Ivan Arfianshar', NULL, NULL),
(75, NULL, 'Kokoh Budi Putranto', NULL, NULL),
(76, NULL, 'Kurniawan CS', NULL, NULL),
(77, NULL, 'Lahuri', NULL, NULL),
(78, NULL, 'Laurensious', NULL, NULL),
(79, NULL, 'Mashuri', NULL, NULL),
(80, NULL, 'Maskur', NULL, NULL),
(81, NULL, 'Mastafa azzzam', NULL, NULL),
(82, NULL, 'Moch Taufik', NULL, NULL),
(83, NULL, 'Moch solikin', NULL, NULL),
(84, NULL, 'Muhadi', NULL, NULL),
(85, NULL, 'Muhammad Wahyudi', NULL, NULL),
(86, NULL, 'Muhammad Al Hidrah', NULL, NULL),
(87, NULL, 'Panji Putra W', NULL, NULL),
(88, NULL, 'Rahmad Setiawan', NULL, NULL),
(89, NULL, 'Redho Charisma', NULL, NULL),
(90, NULL, 'Rio Yuliantinus', NULL, NULL),
(91, NULL, 'Rizky Firman', NULL, NULL),
(92, NULL, 'Hidayat Santoso', NULL, NULL),
(93, NULL, 'Ronai Wiyonarko', NULL, NULL),
(94, NULL, 'Rovaldo Dilonsia Austin', NULL, NULL),
(95, NULL, 'Rudiarto', NULL, NULL),
(96, NULL, 'Rudy Setyawan', NULL, NULL),
(97, NULL, 'Sandi Irawan', NULL, NULL),
(98, NULL, 'Syaiful Anam', NULL, NULL),
(99, NULL, 'Syaiful Anam', NULL, NULL),
(100, NULL, 'Tomas Syahadat', NULL, NULL),
(101, NULL, 'Tony Novidia', NULL, NULL),
(102, NULL, 'Trio Sadewo', NULL, NULL),
(103, NULL, 'Yahya Nur Fazri', NULL, NULL),
(104, NULL, 'Yainudin', NULL, NULL),
(105, NULL, 'Yudha Pratama', NULL, NULL),
(106, NULL, 'Yulian Firman Hidayat', NULL, NULL),
(107, NULL, 'Achmad Syahid\r\n', NULL, NULL),
(108, NULL, 'Abdul Rahman\r\n', NULL, NULL),
(109, NULL, 'Agus Maulana Malik\r\n', NULL, NULL),
(110, NULL, 'Agus Sutikno\r\n', NULL, NULL),
(111, NULL, 'Ahmad Saiful \r\n', NULL, NULL),
(112, NULL, 'Ariyo Permadi\r\n', NULL, NULL),
(113, NULL, 'Arof Muchlis\r\n', NULL, NULL),
(114, NULL, 'Bambang Heru Prasetyo\r\n', NULL, NULL),
(115, NULL, 'Bayu Prasetya\r\n', NULL, NULL),
(116, NULL, 'Dandy Dwi Julianto\r\n', NULL, NULL),
(117, NULL, 'Dedo Novrian Sakti\r\n', NULL, NULL),
(120, NULL, 'Deky Wijaya P\r\n', NULL, NULL),
(121, NULL, 'Dhanis Agustian\r\n', NULL, NULL),
(122, NULL, 'Dimas Rifqi Firdaus F\r\n', NULL, NULL),
(123, NULL, 'Edo Kriswindarto\r\n', NULL, NULL),
(124, NULL, 'Efkelin\r\n', NULL, NULL),
(125, NULL, 'Fachrurozi\r\n', NULL, NULL),
(126, NULL, 'Faisal Qomar\r\n', NULL, NULL),
(127, NULL, 'Iksan Agung Purnomo Atma Yuhan\r\n', NULL, NULL),
(128, NULL, 'Erfan Maulana\r\n', NULL, NULL),
(129, NULL, 'Kari Muji Kuswanto\r\n', NULL, NULL),
(130, NULL, 'M.Ardiansyah\r\n', NULL, NULL),
(131, NULL, 'M.Arifin\r\n', NULL, NULL),
(132, NULL, 'Moch Agus Susanto\r\n', NULL, NULL),
(133, NULL, 'Moh Fajar Ramadhan\r\n', NULL, NULL),
(134, NULL, 'Muhammad Hasan\r\n', NULL, NULL),
(135, NULL, 'Muhammad Inugroho Junaidi\r\n', NULL, NULL),
(136, NULL, 'Rachmad Apriyono\r\n', NULL, NULL),
(137, NULL, 'Rafly Firmansyah\r\n', NULL, NULL),
(138, NULL, 'Rahmat Hadi Ma\'Ruf\r\n', NULL, NULL),
(139, NULL, 'Raza Abdul Aziz\r\n', NULL, NULL),
(140, NULL, 'Riky Saputro\r\n', NULL, NULL),
(141, NULL, 'Solikin\r\n', NULL, NULL),
(142, NULL, 'Suherman\r\n', NULL, NULL),
(143, NULL, 'Surya Iqbal Pradana\r\n', NULL, NULL),
(144, NULL, 'Wenda Erfika Putra\r\n', NULL, NULL),
(145, NULL, 'Teguh kiswantoro\r\n', NULL, NULL),
(146, NULL, 'Mariyanto\r\n', NULL, NULL),
(147, NULL, 'Frisma Andrianto\r\n', NULL, NULL),
(148, NULL, 'Rendy Wasis\r\n', NULL, NULL),
(149, NULL, 'Dimas Arjuna\r\n', NULL, NULL),
(150, NULL, 'Dimas Dwi Aditya\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_angka` int(11) NOT NULL DEFAULT 0,
  `posisi_satuan` int(11) NOT NULL DEFAULT 0,
  `status_kriteria` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama_kriteria`, `satuan`, `is_angka`, `posisi_satuan`, `status_kriteria`) VALUES
(1, 'Tingkat pemahaman terhadap sistem pengiriman', '', 1, 0, 0),
(2, 'Jumlah pengiriman per bulan', 'paket', 0, 1, 0),
(3, 'Jumlah paket pending dalam satu bulan', 'paket', 0, 1, 0),
(4, 'Jumlah paket yang sudah diPOD (Purchase Of Delivery)', 'paket', 0, 1, 0),
(5, 'Komplain paket dalam satu bulan', 'customer', 0, 1, 0),
(6, 'Kedisiplinan dalam satu bulan', 'jam', 0, 1, 0),
(7, 'Kejujuran', '', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_bobot`
--

CREATE TABLE `nilai_bobot` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai_bobot_kriteria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_bobot`
--

INSERT INTO `nilai_bobot` (`id`, `id_kriteria`, `nilai_bobot_kriteria`) VALUES
(4, 1, 10),
(5, 2, 10),
(6, 3, 15),
(7, 4, 20),
(8, 5, 15),
(9, 6, 20),
(10, 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai_parameter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_bobot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id`, `id_kriteria`, `nilai_parameter`, `nilai_bobot`) VALUES
(1, 1, 'Memahami Sistem OMS Pada Software Atau Aplikasi Kurir', 1),
(2, 1, 'Kemampuan Mapping Yang Baik Dan Menguasai Wilayah Pengiriman', 2),
(3, 1, 'Memahami OMS Aplikasi Kurir, Kemampuan Mapping Yang Baik, Dan Memahami Wilayah Pengiriman', 3),
(50, 7, 'Membawa Paket Dan Tidak Didelivery Secara Sengaja Lebih Dari 10', 1),
(51, 7, 'Melakukan Tindakan Mengurangi Jumlah Uang COD (cash On Delivery) Yang Akan Dibayarkan', 2),
(52, 7, 'Paket Telah Di Delivery Dan Membayar Uang COD (cash On Delivery) Tepat Waktu', 3),
(54, 2, '0-500', 1),
(55, 2, '501-1200', 2),
(56, 2, '>1200', 3),
(57, 3, '0-24', 1),
(58, 3, '25-49', 2),
(59, 3, '>49', 3),
(60, 4, '0-100', 1),
(61, 4, '101-500', 2),
(63, 4, '>500', 3),
(64, 5, '0', 3),
(65, 5, '1-4', 2),
(66, 5, '>4', 1),
(67, 6, '0-5', 1),
(68, 6, '6-9', 2),
(69, 6, '>9', 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `temp_list`
--

CREATE TABLE `temp_list` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama_user`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'ee11cbb19052e40b07aac0ca060c23ee', 1),
(2, 'rama', 'rama', 'e04f28cc33cb20274dd3ff44e600a923', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_alternatif`
--
ALTER TABLE `data_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kurir` (`id_kurir`),
  ADD KEY `id_penilaian` (`id_penilaian`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_bobot`
--
ALTER TABLE `nilai_bobot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_list`
--
ALTER TABLE `temp_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_alternatif`
--
ALTER TABLE `data_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_bobot`
--
ALTER TABLE `nilai_bobot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_list`
--
ALTER TABLE `temp_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_alternatif`
--
ALTER TABLE `data_alternatif`
  ADD CONSTRAINT `data_alternatif_ibfk_1` FOREIGN KEY (`id_kurir`) REFERENCES `karyawan` (`id`),
  ADD CONSTRAINT `data_alternatif_ibfk_2` FOREIGN KEY (`id_penilaian`) REFERENCES `nilai_kriteria` (`id`);

--
-- Constraints for table `nilai_bobot`
--
ALTER TABLE `nilai_bobot`
  ADD CONSTRAINT `nilai_bobot_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`);

--
-- Constraints for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD CONSTRAINT `nilai_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`);

--
-- Constraints for table `temp_list`
--
ALTER TABLE `temp_list`
  ADD CONSTRAINT `temp_list_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
