-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 27, 2019 at 03:24 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mtg_absent`
--

CREATE TABLE `mtg_absent` (
  `absent_id` bigint(20) NOT NULL,
  `app_id` bigint(20) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `section` tinyint(3) NOT NULL,
  `is_absent` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_admin_role`
--

CREATE TABLE `mtg_admin_role` (
  `role_id` bigint(20) NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_admin_user`
--

CREATE TABLE `mtg_admin_user` (
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `username` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `fullname` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_date` datetime DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_app_user`
--

CREATE TABLE `mtg_app_user` (
  `app_id` bigint(20) NOT NULL,
  `jabatan_id` bigint(20) DEFAULT NULL,
  `unit_kerja_id` bigint(20) DEFAULT NULL,
  `username` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `fullname` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `address` varchar(1000) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `phoneno` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_login` tinyint(1) NOT NULL DEFAULT '0',
  `last_login_date` datetime DEFAULT NULL,
  `ip_address` varchar(59) COLLATE utf8_bin DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_event`
--

CREATE TABLE `mtg_event` (
  `event_id` bigint(20) NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `time` varchar(100) COLLATE utf8_bin NOT NULL,
  `start_date` varchar(100) COLLATE utf8_bin NOT NULL,
  `end_date` varchar(100) COLLATE utf8_bin NOT NULL,
  `place` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `speaker` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `host` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `qrcode_total` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_event_material`
--

CREATE TABLE `mtg_event_material` (
  `material_id` bigint(20) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `speaker` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `file` varchar(3000) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_event_qrcode`
--

CREATE TABLE `mtg_event_qrcode` (
  `qrcode_id` bigint(20) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `file` varchar(3000) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `section` tinyint(3) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_event_rundown`
--

CREATE TABLE `mtg_event_rundown` (
  `rundown_id` bigint(20) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `time` varchar(100) COLLATE utf8_bin NOT NULL,
  `date` varchar(100) COLLATE utf8_bin NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `speaker` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_legislation`
--

CREATE TABLE `mtg_legislation` (
  `legislation_id` bigint(20) NOT NULL,
  `name` varchar(1000) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `about` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `file` varchar(3000) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_mst_jabatan`
--

CREATE TABLE `mtg_mst_jabatan` (
  `jabatan_id` bigint(20) NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mtg_mst_unit_kerja`
--

CREATE TABLE `mtg_mst_unit_kerja` (
  `unit_kerja_id` bigint(20) NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mtg_absent`
--
ALTER TABLE `mtg_absent`
  ADD PRIMARY KEY (`absent_id`),
  ADD KEY `FK_abesnt_app_id` (`app_id`),
  ADD KEY `FK_abesnt_event_id` (`event_id`);

--
-- Indexes for table `mtg_admin_role`
--
ALTER TABLE `mtg_admin_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `mtg_admin_user`
--
ALTER TABLE `mtg_admin_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK_admin_user_role_id` (`role_id`);

--
-- Indexes for table `mtg_app_user`
--
ALTER TABLE `mtg_app_user`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `FK_app_user_jabatan_id` (`jabatan_id`),
  ADD KEY `FK_app_user_unit_kerja_id` (`unit_kerja_id`);

--
-- Indexes for table `mtg_event`
--
ALTER TABLE `mtg_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `mtg_event_material`
--
ALTER TABLE `mtg_event_material`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `FK_event_material_event_id` (`event_id`);

--
-- Indexes for table `mtg_event_qrcode`
--
ALTER TABLE `mtg_event_qrcode`
  ADD PRIMARY KEY (`qrcode_id`),
  ADD KEY `FK_event_qrcode_event_id` (`event_id`);

--
-- Indexes for table `mtg_event_rundown`
--
ALTER TABLE `mtg_event_rundown`
  ADD PRIMARY KEY (`rundown_id`),
  ADD KEY `FK_event_rundown_event_id` (`event_id`);

--
-- Indexes for table `mtg_legislation`
--
ALTER TABLE `mtg_legislation`
  ADD PRIMARY KEY (`legislation_id`);

--
-- Indexes for table `mtg_mst_jabatan`
--
ALTER TABLE `mtg_mst_jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `mtg_mst_unit_kerja`
--
ALTER TABLE `mtg_mst_unit_kerja`
  ADD PRIMARY KEY (`unit_kerja_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mtg_absent`
--
ALTER TABLE `mtg_absent`
  MODIFY `absent_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_admin_role`
--
ALTER TABLE `mtg_admin_role`
  MODIFY `role_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_admin_user`
--
ALTER TABLE `mtg_admin_user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_app_user`
--
ALTER TABLE `mtg_app_user`
  MODIFY `app_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_event`
--
ALTER TABLE `mtg_event`
  MODIFY `event_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_event_material`
--
ALTER TABLE `mtg_event_material`
  MODIFY `material_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_event_qrcode`
--
ALTER TABLE `mtg_event_qrcode`
  MODIFY `qrcode_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_event_rundown`
--
ALTER TABLE `mtg_event_rundown`
  MODIFY `rundown_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_legislation`
--
ALTER TABLE `mtg_legislation`
  MODIFY `legislation_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_mst_jabatan`
--
ALTER TABLE `mtg_mst_jabatan`
  MODIFY `jabatan_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mtg_mst_unit_kerja`
--
ALTER TABLE `mtg_mst_unit_kerja`
  MODIFY `unit_kerja_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mtg_absent`
--
ALTER TABLE `mtg_absent`
  ADD CONSTRAINT `FK_abesnt_app_id` FOREIGN KEY (`app_id`) REFERENCES `mtg_app_user` (`app_id`),
  ADD CONSTRAINT `FK_abesnt_event_id` FOREIGN KEY (`event_id`) REFERENCES `mtg_event` (`event_id`);

--
-- Constraints for table `mtg_admin_user`
--
ALTER TABLE `mtg_admin_user`
  ADD CONSTRAINT `FK_admin_user_role_id` FOREIGN KEY (`role_id`) REFERENCES `mtg_admin_role` (`role_id`);

--
-- Constraints for table `mtg_app_user`
--
ALTER TABLE `mtg_app_user`
  ADD CONSTRAINT `FK_app_user_jabatan_id` FOREIGN KEY (`jabatan_id`) REFERENCES `mtg_mst_jabatan` (`jabatan_id`),
  ADD CONSTRAINT `FK_app_user_unit_kerja_id` FOREIGN KEY (`unit_kerja_id`) REFERENCES `mtg_mst_unit_kerja` (`unit_kerja_id`);

--
-- Constraints for table `mtg_event_material`
--
ALTER TABLE `mtg_event_material`
  ADD CONSTRAINT `FK_event_material_event_id` FOREIGN KEY (`event_id`) REFERENCES `mtg_event` (`event_id`);

--
-- Constraints for table `mtg_event_qrcode`
--
ALTER TABLE `mtg_event_qrcode`
  ADD CONSTRAINT `FK_event_qrcode_event_id` FOREIGN KEY (`event_id`) REFERENCES `mtg_event` (`event_id`);

--
-- Constraints for table `mtg_event_rundown`
--
ALTER TABLE `mtg_event_rundown`
  ADD CONSTRAINT `FK_event_rundown_event_id` FOREIGN KEY (`event_id`) REFERENCES `mtg_event` (`event_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
