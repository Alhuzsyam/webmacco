-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2020 at 08:12 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `macco`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_alat`
--

CREATE TABLE `daftar_alat` (
  `id` int(11) NOT NULL,
  `penaggung_jawab` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `Jenis_instansi` varchar(128) DEFAULT NULL,
  `negara` varchar(64) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `hp` varchar(15) DEFAULT NULL,
  `nama_instansi` varchar(64) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `kota` varchar(64) DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_alat`
--

INSERT INTO `daftar_alat` (`id`, `penaggung_jawab`, `email`, `Jenis_instansi`, `negara`, `telephone`, `hp`, `nama_instansi`, `username`, `alamat`, `kota`, `longitude`, `latitude`, `foto`) VALUES
(26, 'ilyas', 'ilyasiskandar@gmail.com', 'swsta', 'Indonesia', '0333', '083818161610', 'Alhuz Bio tech', 'Alhuzwiri', 'Banyuwangi, Banyuwangi Regency, East Java, Indonesia', 'Banyuwangi Regency', '114.3692267', '-8.2192335', 'defaultgedung.svg');

-- --------------------------------------------------------

--
-- Table structure for table `masker`
--

CREATE TABLE `masker` (
  `id_masker` varchar(64) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `id_user` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masker`
--

INSERT INTO `masker` (`id_masker`, `tag`, `id_user`) VALUES
('masker1', '0346822', 'CNl3RP1u6n'),
('masker2', 'tag2', 'user2');

-- --------------------------------------------------------

--
-- Table structure for table `masker_raders`
--

CREATE TABLE `masker_raders` (
  `id_reader` varchar(64) NOT NULL,
  `id_reader_user` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `masker_user`
--

CREATE TABLE `masker_user` (
  `id_user` varchar(64) NOT NULL,
  `id_masker` varchar(64) NOT NULL,
  `no_induk` varchar(32) NOT NULL,
  `nik` varchar(32) NOT NULL,
  `no_kk` varchar(32) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `logitude` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masker_user`
--

INSERT INTO `masker_user` (`id_user`, `id_masker`, `no_induk`, `nik`, `no_kk`, `nama`, `alamat`, `email`, `latitude`, `logitude`) VALUES
('CNl3RP1u6n', '87235172', '1631130016', '3610240604978888', '892358127', 'fikri', 'bwi', 'alhuzwirialfi@gmail.com', '-0.47295539', '108.8670062'),
('m7gCJerrnC', '87235172', '1631130016', '361024667060497000', '892358127', 'fikri', 'bwi', 'fikri@yahoo.com', '-7.9568139', '112.6166236'),
('macco098', 'macco000', '1631130016', '3610240604970003', '3610240604970003', 'Alfi', 'Banyuwangi', 'alhuzwirialfi@gmail.com', '-7.2754438', '112.6426433'),
('nPLjmkWnA6', '87235172', '1631130016', '361024060497000', 'alfi', '892358127', 'bwi', 'alhuz@yahoo.com', '-7.5591225,110', '110.7837925'),
('UEpqAryWBb', '87235172', '1631130016', '361024a060497000', '892358127', 'alfi', 'bwi', 'alhuz@yahoo.com', '-7.9784695', '112.5617425'),
('yHKRjGtydo', 'yeur627', '1631130016', '18236147872', '17213725', 'alhuz', 'banyuwangi', 'alhuzwiri@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reader_user`
--

CREATE TABLE `reader_user` (
  `id_reader_user` int(11) NOT NULL,
  `id_reader` varchar(128) NOT NULL,
  `nama_gedung` varchar(64) NOT NULL,
  `ket` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reader_user`
--

INSERT INTO `reader_user` (`id_reader_user`, `id_reader`, `nama_gedung`, `ket`, `foto`) VALUES
(3, '26', 'Gedung AJ', 'Di sebellah gedung AK dipassang diatas rak dekat pintu masuk', 'defaultgedung.svg'),
(4, '26', 'Gedung AA', 'Di sebelah parkiran deket pohon palem besar ada hantunya ih takut', 'person1.png'),
(5, '26', 'Gedung Ai', 'Di sebelah parkiran deket pohon palem besar ada hantunya ih takut hhhh', 'person3.png');

-- --------------------------------------------------------

--
-- Table structure for table `scanner_machine`
--

CREATE TABLE `scanner_machine` (
  `id` int(11) NOT NULL,
  `id_reader` varchar(64) NOT NULL,
  `tag` varchar(280) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scanner_machine`
--

INSERT INTO `scanner_machine` (`id`, `id_reader`, `tag`) VALUES
(1, 'macco001', '0346822');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(218) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(5, 'Alfi Alhuzwiri Syam', 'alhuzwirialfi@gmail.com', '53970488_264385447770432_4358107854399849377_n3.jpg', '$2y$10$UkDr/QTbZaiD/eZbyJbqaeQ1mpeFHCf6ZWuE1PakMykudj9Y7qqFu', 1, 1, 1599982012),
(6, 'Ilfa alhuzwiri syam', 'alhuzwiriilfa@gmail.com', 'Screen_Shot_2020-10-20_at_13_53_21.png', '$2y$10$blHvysEQZAUqM4351OEsfODlbLMqVy3H/tLbpHRSPbAJuUmnN4VCa', 2, 1, 1600006541),
(8, 'egalianovika', 'egalia@gmail.com', '_DSC0126.JPG', '$2y$10$0z1v5onOjTD9Wh.8XeiwxOZtNYCqBwTLAz4EVwQhh4u4GMaJiHaxC', 2, 1, 1602777675),
(11, 'ilyas', 'ilyasiskandar@gmail.com', 'Photo_on_11-07-20_at_12_124.jpg', '$2y$10$HsR0zmxgLh.tdGxNntQBMu8pNW32xwrjJ/4wSyH.d67o9ZINxnETa', 2, 1, 1604149805);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(5, 1, 3),
(54, 5, 1),
(55, 1, 2),
(58, 1, 10),
(60, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(8, 'Control'),
(9, 'Scheduler'),
(10, 'Customer'),
(11, 'Macco Reader');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user-astronaut', 1),
(5, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-cog', 1),
(7, 3, 'Menu Management', 'Menu', 'fas fa-fw fa-folder\r\n', 1),
(9, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(13, 8, 'control & monitoring', 'menu/control', 'fas fa-fw fa-gamepad', 1),
(14, 9, 'schedule', 'menu/schedule', 'fas fa-fw fa-clock', 1),
(15, 9, 'Prediction', 'menu/prediction', 'fas fa-fw fa-cloud-meatball', 1),
(16, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(17, 10, 'Macco Reader User', 'admin/users', 'fas fa-fw fa fa-users', 1),
(18, 11, 'Device', 'User/device', 'fas fa-fw fa-microchip', 1),
(19, 11, 'Device List', 'User/listdevice', 'fas fa-fw fa-list', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_alat`
--
ALTER TABLE `daftar_alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masker`
--
ALTER TABLE `masker`
  ADD PRIMARY KEY (`id_masker`);

--
-- Indexes for table `masker_raders`
--
ALTER TABLE `masker_raders`
  ADD PRIMARY KEY (`id_reader`);

--
-- Indexes for table `masker_user`
--
ALTER TABLE `masker_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `reader_user`
--
ALTER TABLE `reader_user`
  ADD PRIMARY KEY (`id_reader_user`);

--
-- Indexes for table `scanner_machine`
--
ALTER TABLE `scanner_machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_alat`
--
ALTER TABLE `daftar_alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reader_user`
--
ALTER TABLE `reader_user`
  MODIFY `id_reader_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scanner_machine`
--
ALTER TABLE `scanner_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
