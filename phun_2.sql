-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2017 at 08:06 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1677722FA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `catalogue`
--

CREATE TABLE `catalogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corpus_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_59A699F52B41ABF4` (`corpus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=408 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  `text` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526CC4663E4` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=134 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sujet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `demande` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `container`
--

CREATE TABLE `container` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `corpus`
--

CREATE TABLE `corpus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `plugin_list` longtext COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `stylesheet_id` int(11) DEFAULT NULL,
  `dtd_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2A4391B93DA5256D` (`image_id`),
  UNIQUE KEY `UNIQ_2A4391B9997679EC` (`stylesheet_id`),
  UNIQUE KEY `UNIQ_2A4391B93B1D696` (`dtd_id`),
  KEY `IDX_2A4391B912469DE2` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `corpus_plugin`
--

CREATE TABLE `corpus_plugin` (
  `corpus_id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL,
  PRIMARY KEY (`corpus_id`,`plugin_id`),
  KEY `IDX_A35662412B41ABF4` (`corpus_id`),
  KEY `IDX_A3566241EC942BCF` (`plugin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corpus_user`
--

CREATE TABLE `corpus_user` (
  `corpus_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`corpus_id`,`user_id`),
  KEY `IDX_D52AB5472B41ABF4` (`corpus_id`),
  KEY `IDX_D52AB547A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dossier`
--

CREATE TABLE `dossier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalogue_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3D48E0374A7843DC` (`catalogue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=557 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtd`
--

CREATE TABLE `dtd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` decimal(10,0) NOT NULL,
  `longitude` decimal(10,0) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=471 ;

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corpus_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E48E9A132B41ABF4` (`corpus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corpus_id` int(11) NOT NULL,
  `sousdossier_id` int(11) NOT NULL,
  `url_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_xml` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `id_published_transcription` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_140AB6202B41ABF4` (`corpus_id`),
  KEY `IDX_140AB62037894604` (`sousdossier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32329 ;

-- --------------------------------------------------------

--
-- Table structure for table `plugin`
--

CREATE TABLE `plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=277 ;

-- --------------------------------------------------------

--
-- Table structure for table `plugin_container`
--

CREATE TABLE `plugin_container` (
  `plugin_id` int(11) NOT NULL,
  `container_id` int(11) NOT NULL,
  PRIMARY KEY (`plugin_id`,`container_id`),
  KEY `IDX_F7B7DBB2EC942BCF` (`plugin_id`),
  KEY `IDX_F7B7DBB2BC21F742` (`container_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sous_dossier`
--

CREATE TABLE `sous_dossier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dossier_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1E41987A611C0C56` (`dossier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=581 ;

-- --------------------------------------------------------

--
-- Table structure for table `stylesheet`
--

CREATE TABLE `stylesheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `transcription`
--

CREATE TABLE `transcription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `url_xml` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `revision` tinyint(1) NOT NULL,
  `nb_revisions` int(11) NOT NULL,
  `user_revision_1_id` int(11) DEFAULT NULL,
  `user_revision_2_id` int(11) DEFAULT NULL,
  `user_revision_3_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_329CE984C4663E4` (`page_id`),
  KEY `IDX_329CE984A76ED395` (`user_id`),
  KEY `IDX_329CE98492984355` (`user_revision_1_id`),
  KEY `IDX_329CE984802DECBB` (`user_revision_2_id`),
  KEY `IDX_329CE98438918BDE` (`user_revision_3_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=148 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_corpus`
--

CREATE TABLE `user_corpus` (
  `user_id` int(11) NOT NULL,
  `corpus_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`corpus_id`),
  KEY `IDX_4F118A84A76ED395` (`user_id`),
  KEY `IDX_4F118A842B41ABF4` (`corpus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avatar`
--
ALTER TABLE `avatar`
  ADD CONSTRAINT `FK_1677722FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `catalogue`
--
ALTER TABLE `catalogue`
  ADD CONSTRAINT `FK_59A699F52B41ABF4` FOREIGN KEY (`corpus_id`) REFERENCES `corpus` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526CC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`);

--
-- Constraints for table `corpus`
--
ALTER TABLE `corpus`
  ADD CONSTRAINT `FK_2A4391B912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_2A4391B93B1D696` FOREIGN KEY (`dtd_id`) REFERENCES `dtd` (`id`),
  ADD CONSTRAINT `FK_2A4391B93DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_2A4391B9997679EC` FOREIGN KEY (`stylesheet_id`) REFERENCES `stylesheet` (`id`);

--
-- Constraints for table `corpus_plugin`
--
ALTER TABLE `corpus_plugin`
  ADD CONSTRAINT `FK_A35662412B41ABF4` FOREIGN KEY (`corpus_id`) REFERENCES `corpus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A3566241EC942BCF` FOREIGN KEY (`plugin_id`) REFERENCES `plugin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `corpus_user`
--
ALTER TABLE `corpus_user`
  ADD CONSTRAINT `FK_D52AB5472B41ABF4` FOREIGN KEY (`corpus_id`) REFERENCES `corpus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D52AB547A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `FK_3D48E0374A7843DC` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogue` (`id`);

--
-- Constraints for table `logo`
--
ALTER TABLE `logo`
  ADD CONSTRAINT `FK_E48E9A132B41ABF4` FOREIGN KEY (`corpus_id`) REFERENCES `corpus` (`id`);

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_140AB6202B41ABF4` FOREIGN KEY (`corpus_id`) REFERENCES `corpus` (`id`),
  ADD CONSTRAINT `FK_140AB62037894604` FOREIGN KEY (`sousdossier_id`) REFERENCES `sous_dossier` (`id`);

--
-- Constraints for table `plugin_container`
--
ALTER TABLE `plugin_container`
  ADD CONSTRAINT `FK_F7B7DBB2BC21F742` FOREIGN KEY (`container_id`) REFERENCES `container` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F7B7DBB2EC942BCF` FOREIGN KEY (`plugin_id`) REFERENCES `plugin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sous_dossier`
--
ALTER TABLE `sous_dossier`
  ADD CONSTRAINT `FK_1E41987A611C0C56` FOREIGN KEY (`dossier_id`) REFERENCES `dossier` (`id`);

--
-- Constraints for table `transcription`
--
ALTER TABLE `transcription`
  ADD CONSTRAINT `FK_329CE98438918BDE` FOREIGN KEY (`user_revision_3_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_329CE984802DECBB` FOREIGN KEY (`user_revision_2_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_329CE98492984355` FOREIGN KEY (`user_revision_1_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_329CE984A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_329CE984C4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`);

--
-- Constraints for table `user_corpus`
--
ALTER TABLE `user_corpus`
  ADD CONSTRAINT `FK_4F118A842B41ABF4` FOREIGN KEY (`corpus_id`) REFERENCES `corpus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4F118A84A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
