-- MySQL dump 10.13  Distrib 5.5.8, for Win32 (x86)
--
-- Host: localhost    Database: wiki
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Table structure for table `wiki_menus`
--

DROP TABLE IF EXISTS `wiki_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiki_menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `link_type` enum('page','internal','external') NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `class` enum('silver','pink','blue','gold','green','red','none') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiki_menus`
--

LOCK TABLES `wiki_menus` WRITE;
/*!40000 ALTER TABLE `wiki_menus` DISABLE KEYS */;
INSERT INTO `wiki_menus` VALUES (5,'Portada','Front','page',0,'blue','2011-08-30 00:28:04','2011-08-31 00:40:35'),(104,'Menu 4','menu_4','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(105,'Menu 5','menu_5','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(106,'Menu 6','menu_6','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(107,'Menu 7','menu_7','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(108,'Menu 8','menu_8','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(109,'Menu 9','menu_9','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(110,'Menu 10','menu_10','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(111,'Menu 11','menu_11','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(112,'Menu 12','menu_12','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(113,'Menu 13','menu_13','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(114,'Menu 14','menu_14','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31'),(115,'Menu 15','menu_15','page',0,'silver','2011-08-30 23:50:31','2011-08-30 23:50:31');
/*!40000 ALTER TABLE `wiki_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_pages`
--

DROP TABLE IF EXISTS `wiki_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiki_pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `content_length` int(11) unsigned NOT NULL,
  `content_keywords` varchar(255) NOT NULL,
  `content_numwords` int(11) NOT NULL,
  `locked` tinyint(1) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `internal` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiki_pages`
--

LOCK TABLES `wiki_pages` WRITE;
/*!40000 ALTER TABLE `wiki_pages` DISABLE KEYS */;
INSERT INTO `wiki_pages` VALUES (1,'Front','Portada','Esto es como la wikipedia\r\n\r\n* [Enlace 1]\r\n* [Enalce 2]\r\n* [Menu_2]\r\n\r\nEsto es otra prueba:\r\n\r\n    <?php\r\n    $a = \"hola\";\r\n    $res = mysql_query(\"SELECT * FROM users\");\r\n    if($a){ print_r($res); }\r\n    ?>\r\n\r\nOtra cosa\r\n\r\n    SELECT * FROM usuario_empresa\r\n    WHERE nombre = \"Jhon\"',285,'',25,0,'2011-08-28 16:00:56','2011-08-28 16:00:56',1),(2,'menu_0','Menu 0','',0,'',0,0,'2011-08-31 00:20:25','2011-08-31 00:20:25',0),(3,'menu_1','Menu 1','',0,'',0,0,'2011-08-31 00:20:28','2011-08-31 00:20:28',0),(4,'Menu_2','Menu 2','qweq weq we',11,'',1,0,'2011-08-31 00:20:31','2011-08-31 00:20:31',0),(5,'menu_3','Menu 3','',0,'',0,0,'2011-08-31 00:20:33','2011-08-31 00:20:33',0);
/*!40000 ALTER TABLE `wiki_pages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-08-31  1:12:22
