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
  `emailSent` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`contractId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
INSERT INTO `contract` VALUES (1,'Contract Title','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna\n    aliqua. Pharetra magna ac placerat vestibulum. Pellentesque adipiscing commodo elit at imperdiet. Sit amet est\n    placerat in egestas erat imperdiet sed euismod. Purus semper eget duis at tellus at urna condimentum. Pellentesque\n    nec nam aliquam sem. Augue neque gravida in fermentum et sollicitudin ac. Tellus integer feugiat scelerisque varius\n    morbi enim nunc. Ultricies mi eget mauris pharetra et ultrices. Quis auctor elit sed vulputate mi sit amet. Eget\n    nulla facilisi etiam dignissim diam quis enim lobortis.</p>\n<p>Integer feugiat scelerisque varius morbi enim nunc faucibus a pellentesque. Ipsum consequat nisl vel pretium lectus\n    quam id leo in. In hac habitasse platea dictumst quisque sagittis purus. Mauris sit amet massa vitae. Fusce ut\n    placerat orci nulla. Felis eget velit aliquet sagittis id. Consequat semper viverra nam libero. Cursus vitae congue\n    mauris rhoncus aenean vel elit scelerisque mauris. Lectus arcu bibendum at varius vel pharetra vel. In eu mi\n    bibendum neque egestas congue quisque egestas diam. Cum sociis natoque penatibus et magnis dis. Neque volutpat ac\n    tincidunt vitae semper quis. Nisl suscipit adipiscing bibendum est ultricies integer quis auctor. Leo integer\n    malesuada nunc vel risus commodo. Consectetur adipiscing elit ut aliquam purus sit amet luctus venenatis. Purus sit\n    amet luctus venenatis lectus. Elit ut aliquam purus sit. Vitae semper quis lectus nulla at volutpat.</p>\n<p>Ut eu sem integer vitae justo. Non nisi est sit amet facilisis magna etiam. Scelerisque viverra mauris in aliquam. Ac\n    auctor augue mauris augue neque gravida in fermentum et. Vivamus arcu felis bibendum ut tristique et. Nunc eget\n    lorem dolor sed viverra ipsum. Ut diam quam nulla porttitor massa id. In ornare quam viverra orci sagittis eu\n    volutpat odio. Ut eu sem integer vitae justo eget magna. Vel turpis nunc eget lorem. Sodales ut eu sem integer. Erat\n    velit scelerisque in dictum non consectetur a erat nam. Felis imperdiet proin fermentum leo vel orci porta non.\n    Congue quisque egestas diam in. In aliquam sem fringilla ut morbi tincidunt augue interdum. Massa enim nec dui nunc\n    mattis enim. Rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Accumsan in nisl\n    nisi scelerisque. Tempus imperdiet nulla malesuada pellentesque elit. Auctor eu augue ut lectus arcu bibendum at\n    varius vel.</p>\n<p>Elit at imperdiet dui accumsan sit amet nulla facilisi. Eu mi bibendum neque egestas congue. Imperdiet nulla\n    malesuada pellentesque elit eget gravida cum sociis. Amet aliquam id diam maecenas ultricies mi eget mauris.\n    Pellentesque sit amet porttitor eget dolor. Sed euismod nisi porta lorem mollis aliquam ut porttitor. Mauris vitae\n    ultricies leo integer malesuada. Tempor nec feugiat nisl pretium fusce id velit ut tortor. Tincidunt vitae semper\n    quis lectus nulla. Potenti nullam ac tortor vitae purus. Donec enim diam vulputate ut pharetra sit amet. Diam in\n    arcu cursus euismod. Commodo sed egestas egestas fringilla.</p>\n<p>Imperdiet sed euismod nisi porta lorem. Ut eu sem integer vitae justo eget magna. Nunc sed augue lacus viverra vitae\n    congue eu. Et sollicitudin ac orci phasellus egestas tellus rutrum tellus. Gravida quis blandit turpis cursus. Nibh\n    sit amet commodo nulla facilisi nullam vehicula. In est ante in nibh mauris. Nunc lobortis mattis aliquam faucibus\n    purus in. Vel fringilla est ullamcorper eget nulla facilisi. Eu volutpat odio facilisis mauris. Ut lectus arcu\n    bibendum at. Proin sagittis nisl rhoncus mattis rhoncus. Et malesuada fames ac turpis egestas. Amet facilisis magna\n    etiam tempor orci eu lobortis elementum. Sed cras ornare arcu dui vivamus arcu felis. Nunc non blandit massa enim\n    nec dui nunc.</p>\n<p>Ut enim blandit volutpat maecenas volutpat blandit aliquam. Lorem ipsum dolor sit amet consectetur adipiscing elit.\n    Integer feugiat scelerisque varius morbi enim nunc. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus.\n    Nulla pharetra diam sit amet. Ullamcorper morbi tincidunt ornare massa. Viverra mauris in aliquam sem fringilla ut\n    morbi tincidunt. Vitae ultricies leo integer malesuada nunc vel risus commodo. Non blandit massa enim nec dui nunc.\n    Ut morbi tincidunt augue interdum velit euismod in. Congue mauris rhoncus aenean vel.</p>\n<p>Facilisis magna etiam tempor orci eu lobortis elementum nibh tellus. At elementum eu facilisis sed odio. Nisi vitae\n    suscipit tellus mauris. Ornare aenean euismod elementum nisi. Volutpat blandit aliquam etiam erat velit scelerisque\n    in dictum. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus. Nunc lobortis mattis aliquam\n    faucibus. Vestibulum lorem sed risus ultricies tristique. Cras semper auctor neque vitae tempus. Eu feugiat pretium\n    nibh ipsum consequat. Pretium nibh ipsum consequat nisl vel pretium. Orci dapibus ultrices in iaculis nunc sed augue\n    lacus. Dictumst vestibulum rhoncus est pellentesque elit. Et egestas quis ipsum suspendisse ultrices gravida dictum.\n    Vestibulum sed arcu non odio euismod lacinia at quis.</p>\n<p>Pharetra massa massa ultricies mi quis hendrerit dolor. Quam vulputate dignissim suspendisse in. Turpis in eu mi\n    bibendum neque egestas congue quisque. Et ligula ullamcorper malesuada proin libero nunc consequat. Augue interdum\n    velit euismod in pellentesque massa placerat duis ultricies. Eget magna fermentum iaculis eu non diam phasellus\n    vestibulum lorem. Nunc sed augue lacus viverra vitae congue. Sit amet venenatis urna cursus eget. Dignissim\n    suspendisse in est ante in. Orci a scelerisque purus semper eget. Aliquam sem et tortor consequat id porta nibh.</p>\n<p>Suscipit adipiscing bibendum est ultricies integer. Ultricies mi eget mauris pharetra et. Natoque penatibus et magnis\n    dis parturient montes nascetur ridiculus. Rhoncus urna neque viverra justo nec ultrices dui sapien eget. Varius duis\n    at consectetur lorem. Fermentum et sollicitudin ac orci phasellus. Rhoncus dolor purus non enim praesent elementum\n    facilisis. Ullamcorper morbi tincidunt ornare massa. Vitae ultricies leo integer malesuada nunc vel risus.\n    Adipiscing diam donec adipiscing tristique risus nec feugiat. Sem fringilla ut morbi tincidunt augue. Nibh venenatis\n    cras sed felis eget. At consectetur lorem donec massa sapien faucibus. Mi proin sed libero enim sed.</p>\n    <p>Suscipit adipiscing bibendum est ultricies integer. Ultricies mi eget mauris pharetra et. Natoque penatibus et magnis\n    dis parturient montes nascetur ridiculus. Rhoncus urna neque viverra justo nec ultrices dui sapien eget. Varius duis\n    at consectetur lorem. Fermentum et sollicitudin ac orci phasellus. Rhoncus dolor purus non enim praesent elementum\n    facilisis. Ullamcorper morbi tincidunt ornare massa. Vitae ultricies leo integer malesuada nunc vel risus.\n    Adipiscing diam donec adipiscing tristique risus nec feugiat. Sem fringilla ut morbi tincidunt augue. Nibh venenatis\n    cras sed felis eget. At consectetur lorem donec massa sapien faucibus. Mi proin sed libero enim sed.</p>',1),(2,'New COntract','<p>The contract Content</p>',0);
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `signers`
--

DROP TABLE IF EXISTS `signers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `signers` (
  `signerId` int(11) NOT NULL AUTO_INCREMENT,
  `signerName` varchar(256) DEFAULT NULL,
  `signerTitle` varchar(256) DEFAULT NULL,
  `signerEmail` varchar(256) DEFAULT NULL,
  `signerImagePath` varchar(45) DEFAULT NULL,
  `signerParentContract` int(11) DEFAULT NULL,
  `signDate` date DEFAULT NULL,
  PRIMARY KEY (`signerId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `signers`
--

LOCK TABLES `signers` WRITE;
/*!40000 ALTER TABLE `signers` DISABLE KEYS */;
INSERT INTO `signers` VALUES (1,'John Christensen','Photagrapher','Johnawesomejr@gmail.com','/signatureUploads/61908abd0d164.svg',1,'2021-11-13'),(2,'Jessica Christensen','Client','paintingpink3@gmail.com','/signatureUploads/61908ad5b0a7a.svg',1,'2021-11-13'),(3,'test frank','skippy',NULL,NULL,3,NULL),(4,'other guy','skippy',NULL,NULL,2,NULL),(5,'Jenny Christensen','Record Keeper','jcx7@juno.com','/signatureUploads/61908aeddd5a8.svg',1,'2021-11-13');
/*!40000 ALTER TABLE `signers` ENABLE KEYS */;
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

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(256) DEFAULT NULL,
  `userPassword` varchar(256) DEFAULT NULL,
  `salt` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'johnawesomejr@gmail.com','4c74e587e5ca0150b240b3a06b5dd9b6aeef2b460939ea1b1450418b7d8f0fe69915bcafd93d829f54b2580312fddd99f6ccd9c83f15abc4d3bbad0b216e6d29','a verry long string');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-14  8:24:48
