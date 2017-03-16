-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for mini-library
CREATE DATABASE IF NOT EXISTS `mini-library` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mini-library`;


-- Dumping structure for table mini-library.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(50) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '0',
  `genre_id` int(11) NOT NULL DEFAULT '0',
  `author` varchar(100) NOT NULL DEFAULT '0',
  `released_on` datetime DEFAULT NULL,
  `comment` mediumtext,
  `language` varchar(5) NOT NULL DEFAULT '0',
  `image_url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ISBN` (`ISBN`),
  KEY `FK_books_genres` (`genre_id`),
  CONSTRAINT `FK_books_genres` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table mini-library.books: ~5 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `ISBN`, `title`, `genre_id`, `author`, `released_on`, `comment`, `language`, `image_url`) VALUES
	(1, 'sgfdgh', 'fsdfgrg', 4, 'wr42r', '1995-11-12 00:00:00', '', 'fdgfd', '/exam-prep1303\\images\\58c6bae2b6c5d_A03.png'),
	(2, 'sdgdfgffgf', 'dsg', 4, 'dhgfhfghfg', '1111-11-11 00:00:00', 'sdfgdfhgfh', 'qwfsg', NULL),
	(4, '13r2tg31', 'qwfewef', 2, 'qwqfr1wqf', '1234-11-12 00:00:00', 'sfdgh', '2qrf3', '/exam-prep1303\\images\\58c6bd2355e7b_A03.png'),
	(5, '3rqfee3rqf', '324525345346', 2, 'sgrvdf', '2332-03-03 00:00:00', 'qwafsgdfg', '2qrf3', '/exam-prep1303\\images\\58c6bd449bd73_A05.png'),
	(6, 'sfgseae', '1243rw3q', 2, '41432r234qe', '1212-12-12 00:00:00', '', 'rwefr', '/exam-prep1303\\images\\58c6bd5716676_A02.png'),
	(7, 'gdgfdzg', 'dfgdfgd', 5, 'ad', '2213-11-21 00:00:00', 'sfgdfgdh', 'fgdfg', '/exam-prep1303\\images\\58c6bfe93880e_G34.png');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;


-- Dumping structure for table mini-library.genres
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table mini-library.genres: ~5 rows (approximately)
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` (`id`, `name`) VALUES
	(1, 'Horror'),
	(2, 'Porno'),
	(3, 'Erotic'),
	(4, 'Hentai'),
	(5, 'Softcore');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
