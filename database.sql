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


-- Exportiere Datenbank Struktur für kleinanzeigen
CREATE DATABASE IF NOT EXISTS `kleinanzeigen` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_german2_ci */;
USE `kleinanzeigen`;

-- Exportiere Struktur von Tabelle kleinanzeigen.anzeigen
CREATE TABLE IF NOT EXISTS `anzeigen` (
  `aid` int(20) NOT NULL AUTO_INCREMENT,
  `uid` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `titel` varchar(100) NOT NULL,
  `beschreibung` varchar(60000) NOT NULL,
  `plz` varchar(10) NOT NULL,
  `kategorie` varchar(20) NOT NULL,
  `beobachter` int(100) NOT NULL DEFAULT '0',
  `preis` varchar(20) NOT NULL,
  `preistyp` varchar(20) NOT NULL,
  `datum` varchar(20) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kleinanzeigen.benutzer
CREATE TABLE IF NOT EXISTS `benutzer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `strundhn` varchar(50) NOT NULL,
  `plz` int(11) NOT NULL,
  `salt` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kleinanzeigen.beobachtungen
CREATE TABLE IF NOT EXISTS `beobachtungen` (
  `bid` int(20) NOT NULL AUTO_INCREMENT,
  `aid` int(20) NOT NULL,
  `uid` int(20) NOT NULL,
  `datum` varchar(20) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kleinanzeigen.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `cid` int(20) NOT NULL AUTO_INCREMENT,
  `vid` int(20) NOT NULL,
  `vname` varchar(50) NOT NULL,
  `kid` int(20) NOT NULL,
  `kname` varchar(50) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kleinanzeigen.fahrzeugtyp
CREATE TABLE IF NOT EXISTS `fahrzeugtyp` (
  `ftid` int(11) NOT NULL AUTO_INCREMENT,
  `typ` varchar(50) NOT NULL,
  PRIMARY KEY (`ftid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kleinanzeigen.kategorien
CREATE TABLE IF NOT EXISTS `kategorien` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `kategorie` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kleinanzeigen.nachrichten
CREATE TABLE IF NOT EXISTS `nachrichten` (
  `nid` int(20) NOT NULL AUTO_INCREMENT,
  `cid` int(20) NOT NULL,
  `vid` int(20) NOT NULL,
  `kid` int(20) NOT NULL,
  `nachricht` varchar(10000) NOT NULL,
  `verfasser` int(20) NOT NULL,
  `datum` varchar(20) NOT NULL,
  `uhrzeit` varchar(20) NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kleinanzeigen.orte
CREATE TABLE IF NOT EXISTS `orte` (
  `ortsid` int(10) NOT NULL AUTO_INCREMENT,
  `plz` varchar(5) NOT NULL,
  `ort` varchar(50) NOT NULL,
  PRIMARY KEY (`ortsid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
