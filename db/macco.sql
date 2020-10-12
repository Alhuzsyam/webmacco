-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2020 at 03:37 PM
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
  `id_reader` varchar(128) DEFAULT NULL,
  `penaggung_jawab` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `Jenis_instansi` int(11) NOT NULL,
  `negara` varchar(64) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `nama_instansi` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `kota` varchar(64) NOT NULL,
  `longitude` varchar(64) NOT NULL,
  `latitude` varchar(64) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` int(11) NOT NULL,
  `nama_instansi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `nama_instansi`) VALUES
(1, 'instansi swasta '),
(2, 'instansi pemerintah');

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
('masker1', 'tag1', 'user2'),
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
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masker_user`
--

INSERT INTO `masker_user` (`id_user`, `id_masker`, `no_induk`, `nik`, `no_kk`, `nama`, `alamat`, `email`) VALUES
('CNl3RP1u6n', '87235172', '1631130016', '3610240604978888', '892358127', 'fikri', 'bwi', 'fikri@yahoo.com'),
('m7gCJerrnC', '87235172', '1631130016', '361024667060497000', '892358127', 'fikri', 'bwi', 'fikri@yahoo.com'),
('macco098', 'macco000', '1631130016', '3610240604970003', '3610240604970003', 'Alfi', 'Banyuwangi', 'alhuzwirialfi@gmail.com'),
('macco0999', '09999', '1631130016', '10240604970003', '10240604970003', 'Ilfa', 'Banyuwagi', 'alhuzwiriilfa@gmail.com'),
('nPLjmkWnA6', '87235172', '1631130016', '361024060497000', 'alfi', '892358127', 'bwi', 'alhuz@yahoo.com'),
('UEpqAryWBb', '87235172', '1631130016', '361024a060497000', '892358127', 'alfi', 'bwi', 'alhuz@yahoo.com'),
('xlCjFgKm66', '87235172', '1631130016', '7858797970', '892358127', 'fikri', 'bwi', 'fikri@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `reader_user`
--

CREATE TABLE `reader_user` (
  `id_reader_user` varchar(64) NOT NULL,
  `id_reader` varchar(128) NOT NULL,
  `nama_tempat` varchar(64) NOT NULL,
  `alamat_tempat` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(5, 'Alfi Alhuzwiri Syam', 'alhuzwirialfi@gmail.com', 'ABU08225.JPG', '$2y$10$UkDr/QTbZaiD/eZbyJbqaeQ1mpeFHCf6ZWuE1PakMykudj9Y7qqFu', 1, 1, 1599982012),
(6, 'Ilfa alhuzwiri syam', 'alhuzwiriilfa@gmail.com', 'Artboard_1.png', '$2y$10$blHvysEQZAUqM4351OEsfODlbLMqVy3H/tLbpHRSPbAJuUmnN4VCa', 2, 1, 1600006541);

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
(10, 2, 9),
(54, 5, 1),
(55, 1, 2),
(56, 2, 8);

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
(9, 'Scheduler');

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
(16, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_alat`
--
ALTER TABLE `daftar_alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
