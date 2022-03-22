-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2022 at 07:20 AM
-- Server version: 10.7.3-MariaDB
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_karywan_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_alternatif`
--

CREATE TABLE `data_alternatif` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_alternatif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_alternatif`
--

INSERT INTO `data_alternatif` (`id`, `id_karyawan`, `id_kriteria`, `deskripsi`, `nilai_alternatif`) VALUES
(1, 9, 1, 'Sangat Paham Tentang Sistem (3)', 3),
(2, 9, 2, 'Melakukan Pengiriman 1500 Paket (3)', 3),
(3, 9, 3, 'Tidak Ada Paket Pending (cleansheet) (3)', 3),
(4, 9, 4, 'Jumlah Paket POD 800 Paket (3)', 3),
(5, 9, 5, 'Tidak Menerima Komplain (3)', 3),
(6, 9, 6, 'Jam Kerja Sesuai SOP Perusahaan (2)', 2),
(7, 9, 7, 'Paket Telah Di Deliv Dan Membayar Uang COD (3)', 3),
(8, 10, 1, 'Cukup Paham Tentang Sistem (2)', 2),
(9, 10, 2, 'Melakukan Pengiriman 1200 Paket (1)', 1),
(10, 10, 3, 'Tingkat Paket Pending 25 Paket (2)', 2),
(11, 10, 4, 'Jumlah Paket POD 500 Paket (2)', 2),
(12, 10, 5, 'Menerima Komplain Sebanyak 2 Customer (3)', 3),
(13, 10, 6, 'Jam Kerja Mencapai 8 Jam (2)', 2),
(14, 10, 7, 'Mengurangi Uang COD (2)', 2),
(15, 17, 1, 'Kurang Paham Tentang Sistem (2)', 2),
(16, 17, 2, 'Melakukan Pengiriman Paket 500 Paket (1)', 1),
(17, 17, 3, 'Tingkat Pending Paket 50 Paket (1)', 1),
(18, 17, 4, 'Jumlah Paket POD 100 Paket (1)', 1),
(19, 17, 5, 'Menerima Komplain Sebanyak 5 Customer (2)', 2),
(20, 17, 6, 'Jam Kerja Hanya Mencapai 5 Jam (1)', 1),
(21, 17, 7, 'Paket Yang Dideliv Tidak Tepat Waktu Dan Mengurangi Uang COD (2)', 2);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama_karyawan`) VALUES
(1, 'Achmad Gilang Romadhon'),
(2, 'Abdillah Fachrudin'),
(3, 'Arief'),
(4, 'Anggi Setya Putra'),
(5, 'Dimas Arganatha Dwi Putro'),
(6, 'Ezra Putra Perdana'),
(7, 'Fajar Shodiq'),
(8, 'Facrur Reza'),
(9, 'Heri Santoso Ramadani'),
(10, 'Hafidz Sofyan Miftah'),
(11, 'Iwang Ahmad Nugraha'),
(12, 'Moch. Rachman Firmansyah'),
(13, 'Mansur'),
(14, 'Mujiono'),
(15, 'Moch. Jefrey Devito'),
(16, 'Moch. Cholik'),
(17, 'Mohamad Ubaidullah'),
(18, 'Mochamad Musta\'in, SE'),
(19, 'Moch Reza'),
(20, 'Adri Yudha'),
(21, 'Ilham Tri'),
(22, 'Ikbar Rastujawi'),
(23, 'Eka'),
(24, 'Asyrof'),
(25, 'Fadhli'),
(26, 'Dimas Rendi Adi Susanto'),
(27, 'Qodhi Fakhrul Islam'),
(28, 'Roy Hartanto Lapian'),
(29, 'Rahmad Hendrawan'),
(30, 'Rubiantoro'),
(31, 'Setiyo Hadi Raharjo'),
(32, 'Yogi Prakoso'),
(33, 'Mohammad Rizky Aditya '),
(34, 'Angga Aji Prayoga'),
(35, 'Alif Surya Perdana'),
(36, 'Achmad Dika Satria'),
(37, 'Alvin Hafidz'),
(38, 'Roni Firmansyah'),
(39, 'Heri Supriadi'),
(40, 'Wiyatno'),
(41, 'Rahmat hidayat'),
(42, 'Muhammad Fajar A'),
(43, 'Ach Helmi'),
(44, 'Achmad Sukiman'),
(45, 'Andi Rifai'),
(46, 'Andre Maliki'),
(47, 'Anugrah Rangga'),
(48, 'Billy A A'),
(49, 'Ardi Tri Krisdianto'),
(50, 'Ardito Sumarta'),
(51, 'Aswin'),
(52, 'Candra Wahyu Agung'),
(56, 'Catur Wibowo'),
(57, 'Danang Sawong Sethowono'),
(58, 'Deddy Dermawan'),
(59, 'Didik Kuswanto'),
(60, 'Dimas Bagus Prakoso'),
(61, 'Dimas Mahendra'),
(62, 'Dwiki Wahyu'),
(63, 'Eko Mardianto'),
(64, 'Erwin Santoso'),
(65, 'Fakhrul Ivan Setiadji'),
(66, 'Fatchur Affandi'),
(67, 'Febri Yuri Perka'),
(68, 'Ferdiansyah Putra Irawan'),
(69, 'Gatot Denny Susanto'),
(70, 'Ilham Furkoni Said'),
(71, 'Ilham Saifur Rohman'),
(72, 'Irfan Septirio'),
(73, 'Irfan Afandi'),
(74, 'Ivan Arfianshar'),
(75, 'Kokoh Budi Putranto'),
(76, 'Kurniawan CS'),
(77, 'Lahuri'),
(78, 'Laurensious'),
(79, 'Mashuri'),
(80, 'Maskur'),
(81, 'Mastafa azzzam'),
(82, 'Moch Taufik'),
(83, 'Moch solikin'),
(84, 'Muhadi'),
(85, 'Muhammad Wahyudi'),
(86, 'Muhammad Al Hidrah'),
(87, 'Panji Putra W'),
(88, 'Rahmad Setiawan'),
(89, 'Redho Charisma'),
(90, 'Rio Yuliantinus'),
(91, 'Rizky Firman'),
(92, 'Hidayat Santoso'),
(93, 'Ronai Wiyonarko'),
(94, 'Rovaldo Dilonsia Austin'),
(95, 'Rudiarto'),
(96, 'Rudy Setyawan'),
(97, 'Sandi Irawan'),
(98, 'Syaiful Anam'),
(99, 'Syaiful Anam'),
(100, 'Tomas Syahadat'),
(101, 'Tony Novidia'),
(102, 'Trio Sadewo'),
(103, 'Yahya Nur Fazri'),
(104, 'Yainudin'),
(105, 'Yudha Pratama'),
(106, 'Yulian Firman Hidayat'),
(107, 'Achmad Syahid\r\n'),
(108, 'Abdul Rahman\r\n'),
(109, 'Agus Maulana Malik\r\n'),
(110, 'Agus Sutikno\r\n'),
(111, 'Ahmad Saiful \r\n'),
(112, 'Ariyo Permadi\r\n'),
(113, 'Arof Muchlis\r\n'),
(114, 'Bambang Heru Prasetyo\r\n'),
(115, 'Bayu Prasetya\r\n'),
(116, 'Dandy Dwi Julianto\r\n'),
(117, 'Dedo Novrian Sakti\r\n'),
(120, 'Deky Wijaya P\r\n'),
(121, 'Dhanis Agustian\r\n'),
(122, 'Dimas Rifqi Firdaus F\r\n'),
(123, 'Edo Kriswindarto\r\n'),
(124, 'Efkelin\r\n'),
(125, 'Fachrurozi\r\n'),
(126, 'Faisal Qomar\r\n'),
(127, 'Iksan Agung Purnomo Atma Yuhan\r\n'),
(128, 'Erfan Maulana\r\n'),
(129, 'Kari Muji Kuswanto\r\n'),
(130, 'M.Ardiansyah\r\n'),
(131, 'M.Arifin\r\n'),
(132, 'Moch Agus Susanto\r\n'),
(133, 'Moh Fajar Ramadhan\r\n'),
(134, 'Muhammad Hasan\r\n'),
(135, 'Muhammad Inugroho Junaidi\r\n'),
(136, 'Rachmad Apriyono\r\n'),
(137, 'Rafly Firmansyah\r\n'),
(138, 'Rahmat Hadi Ma\'Ruf\r\n'),
(139, 'Raza Abdul Aziz\r\n'),
(140, 'Riky Saputro\r\n'),
(141, 'Solikin\r\n'),
(142, 'Suherman\r\n'),
(143, 'Surya Iqbal Pradana\r\n'),
(144, 'Wenda Erfika Putra\r\n'),
(145, 'Teguh kiswantoro\r\n'),
(146, 'Mariyanto\r\n'),
(147, 'Frisma Andrianto\r\n'),
(148, 'Rendy Wasis\r\n'),
(149, 'Dimas Arjuna\r\n'),
(150, 'Dimas Dwi Aditya\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kriteria` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama_kriteria`, `status_kriteria`) VALUES
(1, 'Tingkat pemahaman terhadap sistem pengiriman', 0),
(2, 'Jumlah pengiriman per bulan', 0),
(3, 'Jumlah paket pending dalam satu bulan', 0),
(4, 'Jumlah paket yang sudah diPOD (Purchase Of Delivery)', 0),
(5, 'Komplain paket dalam satu bulan', 0),
(6, 'Kedisiplinan dalam satu bulan', 0),
(7, 'Kejujuran', 0);

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
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_kriteria` (`id_kriteria`);

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
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

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
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `data_alternatif_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`),
  ADD CONSTRAINT `data_alternatif_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`);

--
-- Constraints for table `nilai_bobot`
--
ALTER TABLE `nilai_bobot`
  ADD CONSTRAINT `nilai_bobot_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
