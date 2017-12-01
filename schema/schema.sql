-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: EVC
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `questionID` bigint(5) unsigned DEFAULT NULL,
  `content_japanese` tinytext CHARACTER SET latin1,
  `content_english` tinytext CHARACTER SET latin1,
  `content_german` tinytext CHARACTER SET latin1,
  `content_french` tinytext CHARACTER SET latin1,
  `content_spanish` tinytext CHARACTER SET latin1,
  `content_italian` tinytext CHARACTER SET latin1,
  `content_dutch` tinytext CHARACTER SET latin1,
  `content_portuguese` tinytext CHARACTER SET latin1,
  `content_french_canada` tinytext CHARACTER SET latin1,
  `choice1_japanese` tinytext CHARACTER SET latin1,
  `choice1_english` tinytext CHARACTER SET latin1,
  `choice1_german` tinytext CHARACTER SET latin1,
  `choice1_french` tinytext CHARACTER SET latin1,
  `choice1_spanish` tinytext CHARACTER SET latin1,
  `choice1_italian` tinytext CHARACTER SET latin1,
  `choice1_dutch` tinytext CHARACTER SET latin1,
  `choice1_portuguese` tinytext CHARACTER SET latin1,
  `choice1_french_canada` tinytext CHARACTER SET latin1,
  `choice2_japanese` tinytext CHARACTER SET latin1,
  `choice2_english` tinytext CHARACTER SET latin1,
  `choice2_german` tinytext CHARACTER SET latin1,
  `choice2_french` tinytext CHARACTER SET latin1,
  `choice2_spanish` tinytext CHARACTER SET latin1,
  `choice2_italian` tinytext CHARACTER SET latin1,
  `choice2_dutch` tinytext CHARACTER SET latin1,
  `choice2_portuguese` tinytext CHARACTER SET latin1,
  `choice2_french_canada` tinytext CHARACTER SET latin1,
  `type` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `category` tinyint(1) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `suggestions`
--

DROP TABLE IF EXISTS `suggestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suggestions` (
  `uuid` bigint(64) NOT NULL,
  `wiiNo` bigint(16) unsigned zerofill NOT NULL,
  `countryID` tinyint(3) unsigned NOT NULL,
  `regionID` tinyint(2) unsigned NOT NULL,
  `langCD` tinyint(1) unsigned NOT NULL,
  `content` tinytext CHARACTER SET latin1 NOT NULL,
  `choice1` tinytext CHARACTER SET latin1 NOT NULL,
  `choice2` tinytext CHARACTER SET latin1 NOT NULL,
  UNIQUE KEY `suggestions_uuid_uindex` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `uuid` bigint(64) NOT NULL,
  `typeCD` tinyint(1) unsigned NOT NULL,
  `questionID` int(5) unsigned NOT NULL,
  `wiiNo` bigint(16) unsigned zerofill NOT NULL,
  `countryID` tinyint(3) unsigned NOT NULL,
  `regionID` tinyint(2) unsigned NOT NULL,
  `ansCNT` char(4) NOT NULL,
  UNIQUE KEY `votes_uuid_uindex` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-01 14:21:26
