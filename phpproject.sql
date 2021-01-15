-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: phpproject
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

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
-- Current Database: `phpproject`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `phpproject` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `phpproject`;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,7),(2,10),(5,13),(6,14);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `SubCategory` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `SubCategory` (`SubCategory`),
  CONSTRAINT `category_ibfk_1` FOREIGN KEY (`SubCategory`) REFERENCES `category` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (3,'NASIONA TRAWY',NULL),(4,'DONICZKI',NULL),(5,'NAWOZY',NULL),(6,'ŚRODKI OCHRONY ROŚLIN',NULL),(7,'Trawy Ozdobne',3),(8,'Trawy Sportowe',3),(9,'Doniczki Domowe',4),(10,'Doniczki Wiszące',4),(11,'Nawozy Ogrodnicze',5),(12,'Nawozy Do Trawy',5),(13,'Środki chwastobójcze',6),(14,'Środki Owadobójcze',6);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `education` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `education` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education`
--

LOCK TABLES `education` WRITE;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
INSERT INTO `education` VALUES (8,'podstawowe'),(9,'średnie'),(10,'wyższe'),(11,'rolnicze');
/*!40000 ALTER TABLE `education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interests` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `interest` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interests`
--

LOCK TABLES `interests` WRITE;
/*!40000 ALTER TABLE `interests` DISABLE KEYS */;
INSERT INTO `interests` VALUES (1,'rośliny egzotyczne'),(2,'ogrodnictwo'),(3,'kwiaty polne'),(4,'szklarnia'),(5,'rośliny doniczkowe'),(6,'grillowanie'),(7,'drzewa owocowe');
/*!40000 ALTER TABLE `interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Price` decimal(15,2) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Mark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Weight` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Description` varchar(2048) COLLATE utf8_bin DEFAULT NULL,
  `Discount` double(3,2) DEFAULT NULL,
  `SUBCATEGORYID` int(11) NOT NULL,
  `Picture` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `SUBCATEGORYID` (`SUBCATEGORYID`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`SUBCATEGORYID`) REFERENCES `category` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'Nawóz długodziałający Osmocote do trawnika Substral',25.00,100,'SUBSTRAL','1','Stosować od marca do końca czerwca. Po nawożeniu obficie podlać trawnik, aby nawóz zaczął działać.',0.00,5,'nawoz-dlugodzialajacy-osmocote-do-trawnika-1-5kg-substral_1.jpg'),(2,'Florovit nawóz do roślin kwitnących Inco',5.00,1000,'FLOROVIT','1','Nawóz przeznaczony jest do dokarmiania roślin kwitnących. Systematyczne stosowanie nawozu zapewnia prawidłowy wzrost roślin oraz ich obfite kwitnienie.',0.00,5,'florovit-nawoz-do-roslin-kwitnacych-id0.jpg'),(3,'FLOROVIT NAWÓZ DO RÓŻ I INNYCH ROŚLIN KWITNĄCYCH INCO',8.20,1000,'FLOROVIT','0.5','Nawóz Florovit do róż to produkt w formie granulatu, który zawiera składniki mineralne w formie dostosowanych do wymagań róż ora roślin kwitnących.',0.00,5,'florovit-nawoz-do-roz-i-innych-roslin-kwitnacych-inco-id0.jpg'),(4,'NAWÓZ UNIWERSALNY AZOFOSKA GRANULAT INCO',8.20,1000,'AZOFOSKA','1','Nawóz uniwersalny Azofoska GRANULAT Inco to najwyższej jakości uniwersalny, wieloskładnikowy kompleksowy nawóz ma wszechstronne zastosowanie. Kupowany na trawniki, do upraw polowych, do warzyw uprawianych w ogrodach i szklarniach. To nawóz dla osób szukających skutecznego oraz wygodnego sposobu dokarmiania roślin w ogrodzie.',0.00,5,'nawoz-uniwersalny-azofoska-granulat-inco-id0.jpg'),(5,'NAWÓZ DO IGLAKÓW 100 DNI AGRECOL',25.00,100,'AGRECOL','1.5','Przeznaczony do nawożenia drzew i krzewów iglastych oraz innych roślin zimozielonych. Służy do zasilania roślin już rosnących oraz przygotowania stanowiska pod nowe nasadzenia. Zalecany do zasilania iglaków w kompozycjach z innymi roślinami oraz intensywnie eksploatowanych żywopłotów. Uwalnianie zawartych w granulacie składników odżywczych regulowane jest przez naturalne czynniki środowiska, takie jak wilgotność i temperatura. Działa 100 dni, co pozwala ograniczyć stosowanie do 1-2 zabiegów w ciągu roku.',0.00,5,'f-i.jpg'),(13,'t5',5.00,5,'t5','5','OPIS',0.00,14,NULL),(16,'z1',1.00,1,'z1','1','OPIS',0.00,14,'nawoz-dlugodzialajacy-osmocote-do-trawnika-1-5kg-substral_1.jpg'),(17,'t',2.00,13,'t','2','OPIS',0.00,14,'nawozy.png'),(18,'x2',2.00,2,'x2','2','OPIS',0.00,14,'nawozy.png');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useraddress`
--

DROP TABLE IF EXISTS `useraddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useraddress` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userID` (`userID`),
  CONSTRAINT `useraddress_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useraddress`
--

LOCK TABLES `useraddress` WRITE;
/*!40000 ALTER TABLE `useraddress` DISABLE KEYS */;
INSERT INTO `useraddress` VALUES (1,'Ulica 177777d/2 22-222 Miasto',7);
/*!40000 ALTER TABLE `useraddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usereducation`
--

DROP TABLE IF EXISTS `usereducation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usereducation` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `educationID` smallint(6) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userID` (`userID`),
  KEY `educationID` (`educationID`),
  CONSTRAINT `usereducation_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`),
  CONSTRAINT `usereducation_ibfk_2` FOREIGN KEY (`educationID`) REFERENCES `education` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usereducation`
--

LOCK TABLES `usereducation` WRITE;
/*!40000 ALTER TABLE `usereducation` DISABLE KEYS */;
INSERT INTO `usereducation` VALUES (1,8,7),(2,9,7);
/*!40000 ALTER TABLE `usereducation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinterests`
--

DROP TABLE IF EXISTS `userinterests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinterests` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `interestID` smallint(6) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userID` (`userID`),
  KEY `interestID` (`interestID`),
  CONSTRAINT `userinterests_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`),
  CONSTRAINT `userinterests_ibfk_2` FOREIGN KEY (`interestID`) REFERENCES `interests` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinterests`
--

LOCK TABLES `userinterests` WRITE;
/*!40000 ALTER TABLE `userinterests` DISABLE KEYS */;
INSERT INTO `userinterests` VALUES (1,2,7),(2,3,7),(3,4,7),(4,5,7);
/*!40000 ALTER TABLE `userinterests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRSTNAME` varchar(256) COLLATE utf8_bin NOT NULL,
  `LASTNAME` varchar(256) COLLATE utf8_bin NOT NULL,
  `EMAIL` varchar(256) COLLATE utf8_bin NOT NULL,
  `PHONE` varchar(12) COLLATE utf8_bin NOT NULL,
  `PASSWORD` varchar(512) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'TESTIMIE','TESTNAZWISKO','TESTEMAIL@GMAIL.COM','998998998','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),(3,'TESTIMIE','TESTNAZWISKO','TESTEMAIL@GMAIL.COM','998998998','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),(4,'TESTIMIE','TESTNAZWISKO2','TESTEMAIL@GMAIL.COM','998998998','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),(5,'TESTIMIE','TESTNAZWISKO','TESTEMA2IL@GMAIL.COM','999998998','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),(6,'TESTIMIE','TESTNAZWISKO','TESTEM3AIL@GMAIL.COM','998998999','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),(7,'Dominik','Albiniak','dominik.albiniak1@gmail.com','695147120','3ba2942ed1d05551d4360a2a7bb6298c2359061dc07b368949bd3fb7feca3344221257672d772ce456075b7cfa50fd7ce41eaefe529d056bf23dd665de668b78'),(8,'Admin','Testowy','admin@gmail.com','123123123','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),(9,'admin','admin','adminad@gmail.com','123456789','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),(10,'test','test','test@go.com','789789789','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),(13,'test','test','tttt@gmail.com','466566666','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),(14,'te','tes','tte@g.com','753159456','b7c3bd1e3976deb58236e6fb91da0cd5f4b0c2f6290cdc2b6f17c6da88d000420ec2d5d73b3e1e8ae14cafeabafe117a58060f427a66bdab1b97cf2d52aa0a94');
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

-- Dump completed on 2021-01-15 22:45:54
