-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für phpproject
CREATE DATABASE IF NOT EXISTS `phpproject` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_german2_ci */;
USE `phpproject`;

-- Exportiere Struktur von Tabelle phpproject.annonce
CREATE TABLE IF NOT EXISTS `annonce` (
  `aId` bigint(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  `text` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  `fsUser` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`aId`),
  KEY `FK_annonce_user` (`fsUser`),
  CONSTRAINT `FK_annonce_user` FOREIGN KEY (`fsUser`) REFERENCES `user` (`uId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle phpproject.label
CREATE TABLE IF NOT EXISTS `label` (
  `lId` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  `text` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  `language` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`lId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle phpproject.ort
CREATE TABLE IF NOT EXISTS `ort` (
  `oId` bigint(20) NOT NULL AUTO_INCREMENT,
  `plz` bigint(20) DEFAULT NULL,
  `ortName` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`oId`),
  UNIQUE KEY `plz` (`plz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle phpproject.pictures
CREATE TABLE IF NOT EXISTS `pictures` (
  `pictureId` bigint(20) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  `label` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  `fsAnnocne` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`pictureId`),
  KEY `fsAnnonce` (`fsAnnocne`),
  CONSTRAINT `fsAnnonce` FOREIGN KEY (`fsAnnocne`) REFERENCES `annonce` (`aId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle phpproject.user
CREATE TABLE IF NOT EXISTS `user` (
  `uId` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  `lastName` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  `fistName` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  `fsOrt` bigint(20) NOT NULL DEFAULT '0',
  `streetNr` bigint(20) NOT NULL DEFAULT '0',
  `password` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`uId`),
  KEY `fsOrt` (`fsOrt`),
  CONSTRAINT `fsOrt` FOREIGN KEY (`fsOrt`) REFERENCES `ort` (`oId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- Daten Export vom Benutzer nicht ausgewählt
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
