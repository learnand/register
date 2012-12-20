CREATE DATABASE  IF NOT EXISTS `siteinfo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `siteinfo`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: siteinfo
-- ------------------------------------------------------
-- Server version	5.1.53-community-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `siteinfo`
--

DROP TABLE IF EXISTS `siteinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siteinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `URL` tinytext NOT NULL COMMENT 'url of a web site',
  `description` text NOT NULL COMMENT 'description of the web site',
  `lastname` varchar(200) NOT NULL COMMENT 'name of person who owns web site',
  `firstname` varchar(200) NOT NULL COMMENT 'name of person who owns web site',
  `email` tinytext NOT NULL COMMENT 'email for person who owns web site',
  `phone` varchar(45) DEFAULT NULL COMMENT 'phone for person who owns web site',
  `original_launch_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `notes` text COMMENT 'admin information',
  `changes` mediumtext COMMENT 'description of changes if/when site relaunched',
  `last_update_date` datetime NOT NULL,
  `last_updated_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lastname` (`lastname`),
  KEY `firstname` (`firstname`),
  FULLTEXT KEY `url` (`URL`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siteinfo`
--

LOCK TABLES `siteinfo` WRITE;
/*!40000 ALTER TABLE `siteinfo` DISABLE KEYS */;
INSERT INTO `siteinfo` VALUES (4,'http://www.chemistry101stuff.org','This is science lab site		\r\n	','Well','Mark','mw@test.com','','2012-12-18 00:00:44','2013-01-07 00:00:00',NULL,'More data and better usability','2012-12-18 13:37:20',''),(3,'http://www.goodtobu.org','This is the test of a site launch.	\r\n	','Smith','Lola','ls@test.com','(617) 255-1057','2012-12-18 00:00:44',NULL,NULL,NULL,'2012-12-18 12:20:52',''),(5,'http://www.literatureinaction.com','Class web site for literature courses.		\r\n	','Beck','Henry','hb@test.com','','2012-12-28 00:00:00',NULL,NULL,NULL,'2012-12-18 12:54:07',''),(6,'http://www.myfoosite.org','Fun stuff for all.','Fun','Joe','funstuff@test.com','(617) 353-1045','2013-01-26 00:00:00','2012-01-22 13:06:30',NULL,'New appearance and more fun stuff.','2012-12-18 13:27:37',''),(7,'http://www.hockeyplayersclus.org','Club site for the hockey club.		\r\n	','Pucker','Allan','ap@test.com','','2012-11-05 00:00:00',NULL,NULL,NULL,'2012-12-18 13:41:28','');
/*!40000 ALTER TABLE `siteinfo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-18 13:43:16
