-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: hypnos
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

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
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `user_id` int(11) NOT NULL,
  `suite_id` int(11) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `bill` float NOT NULL,
  PRIMARY KEY (`begin`,`user_id`,`suite_id`),
  KEY `user_id` (`user_id`),
  KEY `suite_id` (`suite_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`suite_id`) REFERENCES `suites` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(50) NOT NULL,
  `suite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `suite` (`suite`),
  CONSTRAINT `galleries_ibfk_1` FOREIGN KEY (`suite`) REFERENCES `suites` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (17,'/hypnos/gallery/IMG_1647939975avatar.png',1),(18,'/hypnos/gallery/IMG_1647940120avatar.png',1);
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `street` char(50) NOT NULL,
  `streetnumber` varchar(5) DEFAULT NULL,
  `description` text NOT NULL,
  `manager` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manager` (`manager`),
  CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`manager`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES (3,'PREMIER','REIMS','51100','BOULEVARD POMMERY','147','ANCIEN COUVENT des nones catholiques',50),(4,'DEUXIEME','EPERNAY','51190','AVENUE DE CHAMPAGNE','45','ANCIEN MUSEE DE LA PREHISTOIRE',70);
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suites`
--

DROP TABLE IF EXISTS `suites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `featured` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `linkbooking` varchar(50) NOT NULL,
  `hotel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel` (`hotel`),
  CONSTRAINT `suites_ibfk_1` FOREIGN KEY (`hotel`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suites`
--

LOCK TABLES `suites` WRITE;
/*!40000 ALTER TABLE `suites` DISABLE KEYS */;
INSERT INTO `suites` VALUES (1,'SUITE POMMERY DEMOISELLE','/hypnos/gallery/IMG_1647940120avatar.png','La suite créée par la famille Pommery pour recevoir les têtes couronnées.',500,'sfdsdfsdfsdf',4);
/*!40000 ALTER TABLE `suites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` char(3) DEFAULT NULL,
  `password` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (50,'elle','elle','elle@gmail.com','MNG','$2y$10$WAtUjn2BvAYFLTs7x.1W4eMsMas3NOXW85ji4Tpm4mOfbyIMcpzpq'),(68,'tranchard','michel','thierry@gmail.com','ADM','$2y$10$EUml63olbRYbS3tBuYHm4e51JvD0tlaWgjuGuM1pqxEmE0nKGTISa'),(70,'MERSCH','CHRISTINE','christine@orange.fr','MNG','$2y$10$r.ysrVMHa9EAcqeP1kVYaeVugEhZcy8MUwrpP7OS06GUMEudRInhi'),(71,'BLION','Yolande, Gisèle,martine','yoyo@gmail.com','MNG','$2y$10$QNjuR6TpdlmTe2e5vcoZleZKZj9A/MjptQRB2XAOG3U13TPo3CXLy'),(72,'DUCHATEAU','Ines','ines@gmail.com',NULL,'$2y$10$kF25G5CUUyOvqWW1DLuqHeif.V9TGDJSsU7EvpvkIeoPKBtpjYez.'),(73,'DUJARDIN','JEAN','jean@gmail.com',NULL,'$2y$10$i.3LP48NEZCSEk1k6vMHW.uHcpHEK8xiGCatRORBFAyEeFFESnUL2'),(74,'delaplage','rozene','rozene@gmail.com',NULL,'$2y$10$x.apqOeMEsAsOORvlfGI2eYOY0XudBGhZhXJDO9Yt71bJgtKwTsJ6'),(75,'PREMIER CLIENT','THIERRY','thierry@orange.fr',NULL,'$2y$10$etOsjhNP0Nv/rmdhgWZTFuvpXo3085DAKYrGFQK1CNg8Om19EmfOe'),(76,'deuxieme client','marcel','marcel@orange.fr',NULL,'$2y$10$tUeA/rjminLqfibqwodZFOoKBVmp/Vm9yJ6uXg/Wf9k7.MD4pP1YW');
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

-- Dump completed on 2022-03-23 12:00:12
