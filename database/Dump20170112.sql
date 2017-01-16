CREATE DATABASE  IF NOT EXISTS `dbcater` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dbcater`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: dbcater
-- ------------------------------------------------------
-- Server version	5.7.13-log

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
-- Table structure for table `tblcustomer`
--

DROP TABLE IF EXISTS `tblcustomer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcustomer` (
  `strCustId` varchar(45) NOT NULL,
  `strCustFirst` varchar(100) NOT NULL,
  `strCustMiddle` varchar(100) DEFAULT NULL,
  `strCustLast` varchar(100) NOT NULL,
  `strCustAddress` text NOT NULL,
  `strCustContact` varchar(30) NOT NULL,
  PRIMARY KEY (`strCustId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomer`
--

LOCK TABLES `tblcustomer` WRITE;
/*!40000 ALTER TABLE `tblcustomer` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldamagefee`
--

DROP TABLE IF EXISTS `tbldamagefee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldamagefee` (
  `strDamaFeeId` varchar(45) NOT NULL,
  `strDamaFeeName` varchar(100) NOT NULL,
  `strDamaFeeEquiId` varchar(45) NOT NULL,
  `txtDamaFeeDesc` text,
  `dblDamaFeeAmount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`strDamaFeeId`),
  KEY `fk_strDamaFeeEquiId_idx` (`strDamaFeeEquiId`),
  CONSTRAINT `fk_strDamaFeeEquiId` FOREIGN KEY (`strDamaFeeEquiId`) REFERENCES `tblequipment` (`strEquiId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldamagefee`
--

LOCK TABLES `tbldamagefee` WRITE;
/*!40000 ALTER TABLE `tbldamagefee` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldamagefee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldeliveryfee`
--

DROP TABLE IF EXISTS `tbldeliveryfee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldeliveryfee` (
  `strDeliFeeId` varchar(45) NOT NULL,
  `strDeliFeeName` varchar(100) NOT NULL,
  `txtDeliFeeDesc` text,
  `dblDeliFeeAmount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`strDeliFeeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldeliveryfee`
--

LOCK TABLES `tbldeliveryfee` WRITE;
/*!40000 ALTER TABLE `tbldeliveryfee` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldeliveryfee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldrink`
--

DROP TABLE IF EXISTS `tbldrink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldrink` (
  `strDrinkId` varchar(45) NOT NULL,
  `strDrinkName` varchar(100) NOT NULL,
  `txtDrinkDesc` text,
  PRIMARY KEY (`strDrinkId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldrink`
--

LOCK TABLES `tbldrink` WRITE;
/*!40000 ALTER TABLE `tbldrink` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldrink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblequipment`
--

DROP TABLE IF EXISTS `tblequipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblequipment` (
  `strEquiId` varchar(45) NOT NULL,
  `strEquiName` varchar(100) NOT NULL,
  `strEquiEquiTypeId` varchar(45) NOT NULL,
  `txtEquiDesc` text,
  PRIMARY KEY (`strEquiId`),
  KEY `fk_strEquiEquiTypeId_idx` (`strEquiEquiTypeId`),
  CONSTRAINT `fk_strEquiEquiTypeId` FOREIGN KEY (`strEquiEquiTypeId`) REFERENCES `tblequipmenttype` (`strEquiTypeId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblequipment`
--

LOCK TABLES `tblequipment` WRITE;
/*!40000 ALTER TABLE `tblequipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblequipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblequipmentrate`
--

DROP TABLE IF EXISTS `tblequipmentrate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblequipmentrate` (
  `strEquiRateEquiId` varchar(45) NOT NULL,
  `dblEquiRateRate` decimal(10,2) NOT NULL,
  `dtmEquiRateAsOf` datetime NOT NULL,
  PRIMARY KEY (`strEquiRateEquiId`),
  KEY `fk_strEquiRateEquiId_idx` (`strEquiRateEquiId`),
  CONSTRAINT `fk_strEquiRateEquiId` FOREIGN KEY (`strEquiRateEquiId`) REFERENCES `tblequipment` (`strEquiId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblequipmentrate`
--

LOCK TABLES `tblequipmentrate` WRITE;
/*!40000 ALTER TABLE `tblequipmentrate` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblequipmentrate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblequipmenttype`
--

DROP TABLE IF EXISTS `tblequipmenttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblequipmenttype` (
  `strEquiTypeId` varchar(45) NOT NULL,
  `strEquiTypeName` varchar(100) NOT NULL,
  `txtEquiTypeDesc` text,
  PRIMARY KEY (`strEquiTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblequipmenttype`
--

LOCK TABLES `tblequipmenttype` WRITE;
/*!40000 ALTER TABLE `tblequipmenttype` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblequipmenttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbleventbooking`
--

DROP TABLE IF EXISTS `tbleventbooking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbleventbooking` (
  `strEvenBookId` varchar(45) NOT NULL,
  `strEvenBookCustId` varchar(45) NOT NULL,
  `strEvenBookTransDate` datetime NOT NULL,
  `dtmEvenBookSchedule` datetime NOT NULL,
  `strEvenBookAddress` text,
  `strEvenBookEvenTypeId` varchar(45) DEFAULT NULL,
  `txtEvenBookDesc` text,
  PRIMARY KEY (`strEvenBookId`),
  KEY `fk_strEvenBookCustId_idx` (`strEvenBookCustId`),
  KEY `fk_strEvenBookEvenTypeId_idx` (`strEvenBookEvenTypeId`),
  CONSTRAINT `fk_strEvenBookCustId` FOREIGN KEY (`strEvenBookCustId`) REFERENCES `tblcustomer` (`strCustId`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenBookEvenTypeId` FOREIGN KEY (`strEvenBookEvenTypeId`) REFERENCES `tbleventtype` (`strEvenTypeId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbleventbooking`
--

LOCK TABLES `tbleventbooking` WRITE;
/*!40000 ALTER TABLE `tbleventbooking` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbleventbooking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbleventdrink`
--

DROP TABLE IF EXISTS `tbleventdrink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbleventdrink` (
  `strEvenDrinEvenBookId` varchar(45) NOT NULL,
  `strEvenDrinDrinId` varchar(45) NOT NULL,
  PRIMARY KEY (`strEvenDrinEvenBookId`,`strEvenDrinDrinId`),
  KEY `fk_strEvenDrinDrinId_idx` (`strEvenDrinDrinId`),
  CONSTRAINT `fk_strEvenDrinDrinId` FOREIGN KEY (`strEvenDrinDrinId`) REFERENCES `tbldrink` (`strDrinkId`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenDrinEvenBookId` FOREIGN KEY (`strEvenDrinEvenBookId`) REFERENCES `tbleventbooking` (`strEvenBookId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbleventdrink`
--

LOCK TABLES `tbleventdrink` WRITE;
/*!40000 ALTER TABLE `tbleventdrink` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbleventdrink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbleventmenu`
--

DROP TABLE IF EXISTS `tbleventmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbleventmenu` (
  `strEvenMenuEvenBookId` varchar(45) NOT NULL,
  `strEvenMenuMenuId` varchar(45) NOT NULL,
  `intEvenMenuPax` int(11) NOT NULL,
  PRIMARY KEY (`strEvenMenuEvenBookId`,`strEvenMenuMenuId`),
  KEY `fk_strEvenMenuMenuId_idx` (`strEvenMenuMenuId`),
  CONSTRAINT `fk_strEvenMenuEvenBookId` FOREIGN KEY (`strEvenMenuEvenBookId`) REFERENCES `tbleventbooking` (`strEvenBookId`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenMenuMenuId` FOREIGN KEY (`strEvenMenuMenuId`) REFERENCES `tblmenu` (`strMenuId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbleventmenu`
--

LOCK TABLES `tbleventmenu` WRITE;
/*!40000 ALTER TABLE `tbleventmenu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbleventmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbleventmotif`
--

DROP TABLE IF EXISTS `tbleventmotif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbleventmotif` (
  `strEvenMotiEvenBookId` varchar(45) NOT NULL,
  `strEvenMotiMotiId` varchar(45) NOT NULL,
  PRIMARY KEY (`strEvenMotiEvenBookId`),
  KEY `fk_strEvenMotiMotiId_idx` (`strEvenMotiMotiId`),
  CONSTRAINT `fk_strEvenMotiEvenBookId` FOREIGN KEY (`strEvenMotiEvenBookId`) REFERENCES `tbleventbooking` (`strEvenBookId`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenMotiMotiId` FOREIGN KEY (`strEvenMotiMotiId`) REFERENCES `tblmotif` (`strMotiId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbleventmotif`
--

LOCK TABLES `tbleventmotif` WRITE;
/*!40000 ALTER TABLE `tbleventmotif` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbleventmotif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbleventtype`
--

DROP TABLE IF EXISTS `tbleventtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbleventtype` (
  `strEvenTypeId` varchar(45) NOT NULL,
  `strEvenTypeName` varchar(100) NOT NULL,
  `strEvenTypeDesc` text,
  PRIMARY KEY (`strEvenTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbleventtype`
--

LOCK TABLES `tbleventtype` WRITE;
/*!40000 ALTER TABLE `tbleventtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbleventtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbleventwaiter`
--

DROP TABLE IF EXISTS `tbleventwaiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbleventwaiter` (
  `strEvenWaitEvenBookId` varchar(45) NOT NULL,
  `strEvenWaitWaitId` varchar(45) NOT NULL,
  PRIMARY KEY (`strEvenWaitEvenBookId`,`strEvenWaitWaitId`),
  KEY `fk_strEvenWaitWaitId_idx` (`strEvenWaitWaitId`),
  CONSTRAINT `fk_strEvenWaitEvenBookId` FOREIGN KEY (`strEvenWaitEvenBookId`) REFERENCES `tbleventbooking` (`strEvenBookId`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenWaitWaitId` FOREIGN KEY (`strEvenWaitWaitId`) REFERENCES `tblwaiter` (`strWaitId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbleventwaiter`
--

LOCK TABLES `tbleventwaiter` WRITE;
/*!40000 ALTER TABLE `tbleventwaiter` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbleventwaiter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfood`
--

DROP TABLE IF EXISTS `tblfood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblfood` (
  `strFoodId` varchar(45) NOT NULL,
  `strFoodName` varchar(100) NOT NULL,
  `strFoodFoodCateId` varchar(45) NOT NULL,
  `txtFoodDesc` text,
  PRIMARY KEY (`strFoodId`),
  KEY `fk_strFoodFoodCateId_idx` (`strFoodFoodCateId`),
  CONSTRAINT `fk_strFoodFoodCateId` FOREIGN KEY (`strFoodFoodCateId`) REFERENCES `tblfoodcategory` (`strFoodCateId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfood`
--

LOCK TABLES `tblfood` WRITE;
/*!40000 ALTER TABLE `tblfood` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfood` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfoodcategory`
--

DROP TABLE IF EXISTS `tblfoodcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblfoodcategory` (
  `strFoodCateId` varchar(45) NOT NULL,
  `strFoodCateName` varchar(100) NOT NULL,
  `txtFoodCateDesc` text,
  PRIMARY KEY (`strFoodCateId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfoodcategory`
--

LOCK TABLES `tblfoodcategory` WRITE;
/*!40000 ALTER TABLE `tblfoodcategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfoodcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfoodmenu`
--

DROP TABLE IF EXISTS `tblfoodmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblfoodmenu` (
  `strFoodMenuMenuId` varchar(45) NOT NULL,
  `strFoodMenuFoodId` varchar(45) NOT NULL,
  PRIMARY KEY (`strFoodMenuMenuId`,`strFoodMenuFoodId`),
  KEY `fk_strFoodMenuFoodId_idx` (`strFoodMenuFoodId`),
  CONSTRAINT `fk_strFoodMenuFoodId` FOREIGN KEY (`strFoodMenuFoodId`) REFERENCES `tblfood` (`strFoodId`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strFoodMenuMenuId` FOREIGN KEY (`strFoodMenuMenuId`) REFERENCES `tblmenu` (`strMenuId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfoodmenu`
--

LOCK TABLES `tblfoodmenu` WRITE;
/*!40000 ALTER TABLE `tblfoodmenu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfoodmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmenu`
--

DROP TABLE IF EXISTS `tblmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblmenu` (
  `strMenuId` varchar(45) NOT NULL,
  `dtmMenuCreatedAt` datetime NOT NULL,
  `dblMenuRate` decimal(10,2) NOT NULL,
  `strMenuMenuType` varchar(45) NOT NULL,
  `txtMenuDesc` text,
  PRIMARY KEY (`strMenuId`),
  KEY `fk_strMenuMenuType_idx` (`strMenuMenuType`),
  CONSTRAINT `fk_strMenuMenuType` FOREIGN KEY (`strMenuMenuType`) REFERENCES `tblmenutype` (`strMenuTypeId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmenu`
--

LOCK TABLES `tblmenu` WRITE;
/*!40000 ALTER TABLE `tblmenu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmenutype`
--

DROP TABLE IF EXISTS `tblmenutype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblmenutype` (
  `strMenuTypeId` varchar(45) NOT NULL,
  `strMenuTypeName` varchar(100) NOT NULL,
  `txtMenuTypeDesc` text,
  PRIMARY KEY (`strMenuTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmenutype`
--

LOCK TABLES `tblmenutype` WRITE;
/*!40000 ALTER TABLE `tblmenutype` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmenutype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmotif`
--

DROP TABLE IF EXISTS `tblmotif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblmotif` (
  `strMotiId` varchar(45) NOT NULL,
  `strMotiName` varchar(100) NOT NULL,
  `txtMotiDesc` text,
  PRIMARY KEY (`strMotiId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmotif`
--

LOCK TABLES `tblmotif` WRITE;
/*!40000 ALTER TABLE `tblmotif` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmotif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpackage`
--

DROP TABLE IF EXISTS `tblpackage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpackage` (
  `strPackId` varchar(45) NOT NULL,
  `strPackName` varchar(100) NOT NULL,
  `txtPackDesc` text,
  `dblPackRate` decimal(10,2) NOT NULL, 
  PRIMARY KEY (`strPackId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpackage`
--

LOCK TABLES `tblpackage` WRITE;
/*!40000 ALTER TABLE `tblpackage` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpackage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpackagemenu`
--

DROP TABLE IF EXISTS `tblpackagemenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpackagemenu` (
  `strPackMenuPackId` varchar(45) NOT NULL,
  `strPackMenuMenuId` varchar(45) NOT NULL,
  PRIMARY KEY (`strPackMenuPackId`,`strPackMenuMenuId`),
  KEY `fk_strPackMenuMenuId_idx` (`strPackMenuMenuId`),
  CONSTRAINT `fk_strPackMenuMenuId` FOREIGN KEY (`strPackMenuMenuId`) REFERENCES `tblmenu` (`strMenuId`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strPackMenuPackId` FOREIGN KEY (`strPackMenuPackId`) REFERENCES `tblpackage` (`strPackId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpackagemenu`
--

LOCK TABLES `tblpackagemenu` WRITE;
/*!40000 ALTER TABLE `tblpackagemenu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpackagemenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblservice`
--

DROP TABLE IF EXISTS `tblservice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblservice` (
  `strServId` varchar(45) NOT NULL,
  `strServName` varchar(100) NOT NULL,
  `strServServType` varchar(45) NOT NULL,
  `txtServDesc` text,
  `dblServRate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`strServId`),
  KEY `fk_strServServType_idx` (`strServServType`),
  CONSTRAINT `fk_strServServType` FOREIGN KEY (`strServServType`) REFERENCES `tblservicetype` (`strServTypeId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblservice`
--

LOCK TABLES `tblservice` WRITE;
/*!40000 ALTER TABLE `tblservice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblservice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblservicetype`
--

DROP TABLE IF EXISTS `tblservicetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblservicetype` (
  `strServTypeId` varchar(45) NOT NULL,
  `strServTypeName` varchar(100) NOT NULL,
  `txtServTypeDesc` text,
  PRIMARY KEY (`strServTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblservicetype`
--

LOCK TABLES `tblservicetype` WRITE;
/*!40000 ALTER TABLE `tblservicetype` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblservicetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblstaff`
--

DROP TABLE IF EXISTS `tblstaff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblstaff` (
  `strStafId` varchar(45) NOT NULL,
  `strStafFirst` varchar(100) NOT NULL,
  `strStafMiddle` varchar(100) DEFAULT NULL,
  `strStafLast` varchar(100) NOT NULL,
  `strStafPassword` varchar(50) NOT NULL,
  `intStafIsAdmin` tinyint(4) NOT NULL,
  PRIMARY KEY (`strStafId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblstaff`
--

LOCK TABLES `tblstaff` WRITE;
/*!40000 ALTER TABLE `tblstaff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstaff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblwaiter`
--

DROP TABLE IF EXISTS `tblwaiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblwaiter` (
  `strWaitId` varchar(45) NOT NULL,
  `strWaitFirst` varchar(100) NOT NULL,
  `strWaitMiddle` varchar(100) DEFAULT NULL,
  `strWaitLast` varchar(100) NOT NULL,
  PRIMARY KEY (`strWaitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblwaiter`
--

LOCK TABLES `tblwaiter` WRITE;
/*!40000 ALTER TABLE `tblwaiter` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblwaiter` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-12 11:46:30
