-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: esignature
-- ------------------------------------------------------
-- Server version	10.3.31-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract` (
  `contractId` int(11) NOT NULL AUTO_INCREMENT,
  `contractName` varchar(256) DEFAULT NULL,
  `contractContent` longtext DEFAULT NULL,
  PRIMARY KEY (`contractId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
INSERT INTO `contract` VALUES (1,'This is the title of the thing!','<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam cupiditate ducimus porro minus omnis molestias! Quae fugit, officia ab voluptatum reiciendis quis assumenda corrupti dolorum commodi ad, nihil magnam at!</p>\n<p>Quasi possimus vel tempore eum maiores quam? Pariatur inventore deserunt odio laudantium non itaque praesentium iure earum magni! Necessitatibus voluptate corrupti repellat alias facere culpa quaerat vitae excepturi dolores ab.</p>\n<p>Atque eum sunt cumque laborum beatae consectetur iure asperiores officia minus nulla modi ratione, architecto voluptatem inventore hic ut possimus quo facilis neque sequi optio! Aliquam necessitatibus vitae modi atque?</p>\n<p>Ea inventore porro consectetur modi sequi fuga repellat unde ullam, illum numquam quas tenetur corrupti id tempora commodi ipsam rem officiis. Sequi, ad. Deleniti nobis adipisci quas totam harum reiciendis.</p>				<ul>\n				   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>\n				   <li>Aliquam tincidunt mauris eu risus.</li>\n				   <li>Vestibulum auctor dapibus neque.</li>\n				</ul>\n				<h1>h1 text</h1>\n				<h2>h2 text</h2>\n				<h3>h3 text</h3>');
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `template` (
  `templateId` int(11) NOT NULL,
  `templateName` varchar(256) DEFAULT NULL,
  `templateContent` longtext DEFAULT NULL,
  PRIMARY KEY (`templateId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template`
--

LOCK TABLES `template` WRITE;
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
/*!40000 ALTER TABLE `template` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-31 15:52:56
