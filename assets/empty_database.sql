-- MySQL dump 10.13  Distrib 5.6.23, for osx10.8 (x86_64)
--
-- Host: localhost    Database: althingi
-- ------------------------------------------------------
-- Server version	5.6.23

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
-- Table structure for table `Assembly`
--

DROP TABLE IF EXISTS `Assembly`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Assembly` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `period` varchar(100) DEFAULT NULL,
  `dirty` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Assembly`
--

LOCK TABLES `Assembly` WRITE;
/*!40000 ALTER TABLE `Assembly` DISABLE KEYS */;
INSERT INTO `Assembly` VALUES (1,'1875-07-01','1875-08-26','1875',0),(2,'1877-07-02','1877-08-30','1877',0),(3,'1879-07-01','1879-08-27','1879',0),(4,'1881-07-01','1881-08-27','1881',0),(5,'1883-07-02','1883-08-27','1883',0),(6,'1885-07-01','1885-08-27','1885',0),(7,'1886-07-28','1886-08-26','1886',0),(8,'1887-07-01','1887-08-26','1887',0),(9,'1889-07-01','1889-08-26','1889',0),(10,'1891-07-01','1891-08-26','1891',0),(11,'1893-07-01','1893-08-26','1893',0),(12,'1894-08-01','1894-08-28','1894',0),(13,'1895-07-01','1895-08-24','1895',0),(14,'1897-07-01','1897-08-26','1897',0),(15,'1899-07-01','1899-08-26','1899',0),(16,'1901-07-01','1901-08-26','1901',0),(17,'1902-07-26','1902-08-25','1902',0),(18,'1903-07-01','1903-08-26','1903',0),(19,'1905-07-01','1905-08-29','1905',0),(20,'1907-07-01','1907-09-14','1907',0),(21,'1909-02-15','1909-05-08','1909',0),(22,'1911-02-15','1911-05-10','1911',0),(23,'1912-07-15','1912-08-26','1912',0),(24,'1913-07-01','1913-09-13','1913',0),(25,'1914-07-01','1914-08-13','1914',0),(26,'1915-07-07','1915-09-15','1915',0),(27,'1916-12-11','1917-01-13','1916-1917',0),(28,'1917-07-02','1917-09-17','1917',0),(29,'1918-02-10','1918-07-18','1918',0),(30,'1918-09-02','1918-09-10','1918',0),(31,'1919-07-01','1919-09-27','1919',0),(32,'1920-02-05','1920-03-01','1920',0),(33,'1921-02-15','1921-05-21','1921',0),(34,'1922-02-15','1922-04-26','1922',0),(35,'1923-02-15','1923-05-14','1923',0),(36,'1924-02-15','1924-05-07','1924',0),(37,'1925-02-07','1925-05-16','1925',0),(38,'1926-02-06','1926-05-15','1926',0),(39,'1927-02-09','1927-05-19','1927',0),(40,'1928-01-19','1928-04-18','1928',0),(41,'1929-02-15','1929-05-18','1929',0),(42,'1930-01-17','1930-06-28','1930',0),(43,'1931-02-14','1931-04-14','1931',0),(44,'1931-07-15','1931-08-24','1931',0),(45,'1932-02-15','1932-06-06','1932',0),(46,'1933-02-15','1933-06-03','1933',0),(47,'1933-11-02','1933-12-09','1933',0),(48,'1934-10-01','1934-12-22','1934',0),(49,'1935-02-15','1935-12-23','1935',0),(50,'1936-02-15','1936-05-09','1936',0),(51,'1937-02-15','1937-04-20','1937',0),(52,'1937-10-09','1937-12-22','1937',0),(53,'1938-02-15','1938-05-12','1938',0),(54,'1939-02-15','1940-01-05','1939-1940',0),(55,'1940-02-15','1940-04-24','1940',0),(56,'1941-02-15','1941-06-17','1941',0),(57,'1941-07-09','1941-07-10','1941',0),(58,'1941-10-13','1941-11-21','1941',0),(59,'1942-02-16','1942-07-05','1942',0),(60,'1942-08-04','1942-09-09','1942',0),(61,'1942-11-14','1943-04-14','1942-1943',0),(62,'1943-04-15','1943-12-17','1943',0),(63,'1944-01-10','1945-03-03','1944-1945',0),(64,'1945-10-01','1946-04-29','1945-1946',0),(65,'1946-07-22','1946-10-09','1946',0),(66,'1946-10-10','1947-05-24','1946-1947',0),(67,'1947-10-01','1948-03-24','1947-1948',0),(68,'1948-10-11','1949-05-18','1948-1949',0),(69,'1949-11-14','1950-05-17','1949-1950',0),(70,'1950-10-10','1951-03-07','1950-1951',0),(71,'1951-10-01','1952-01-24','1951-1952',0),(72,'1952-10-01','1953-02-06','1952-1953',0),(73,'1953-10-01','1954-04-14','1953-1954',0),(74,'1954-10-09','1955-05-11','1954-1955',0),(75,'1955-10-08','1956-03-28','1955-1956',0),(76,'1956-10-10','1957-05-31','1956-1957',0),(77,'1957-10-10','1958-06-04','1957-1958',0),(78,'1958-10-10','1959-05-14','1958-1959',0),(79,'1959-07-21','1959-08-15','1959',0),(80,'1959-11-20','1960-06-03','1959-1960',0),(81,'1960-10-10','1961-03-29','1960-1961',0),(82,'1961-10-10','1962-04-18','1961-1962',0),(83,'1962-10-10','1963-04-20','1962-1963',0),(84,'1963-10-10','1964-05-14','1963-1964',0),(85,'1964-10-10','1965-05-12','1964-1965',0),(86,'1965-10-08','1966-05-05','1965-1966',0),(87,'1966-10-10','1967-04-19','1966-1967',0),(88,'1967-10-10','1968-04-20','1967-1968',0),(89,'1968-10-10','1969-05-17','1968-1969',0),(90,'1969-10-10','1970-05-04','1969-1970',0),(91,'1970-10-10','1971-04-07','1970-1971',0),(92,'1971-10-11','1972-05-20','1971-1972',0),(93,'1972-10-10','1973-04-18','1972-1973',0),(94,'1973-10-10','1974-05-09','1973-1974',0),(95,'1974-07-18','1974-09-05','1974',0),(96,'1974-10-29','1975-05-16','1974-1975',0),(97,'1975-10-10','1976-05-19','1975-1976',0),(98,'1976-10-11','1977-05-04','1976-1977',0),(99,'1977-10-10','1978-05-06','1977-1978',0),(100,'1978-10-10','1979-05-23','1978-1979',0),(101,'1979-10-10','1979-10-16','1979',0),(102,'1979-12-12','1980-05-29','1979-1980',0),(103,'1980-10-10','1981-05-25','1980-1981',0),(104,'1981-10-10','1982-05-07','1981-1982',0),(105,'1982-10-11','1983-03-14','1982-1983',0),(106,'1983-10-10','1984-05-22','1983-1984',0),(107,'1984-10-10','1985-06-21','1984-1985',0),(108,'1985-10-10','1986-04-23','1985-1986',0),(109,'1986-10-10','1987-03-19','1986-1987',0),(110,'1987-10-10','1988-05-11','1987-1988',0),(111,'1988-10-10','1989-05-20','1988-1989',0),(112,'1989-10-10','1990-05-15','1989-1990',0),(113,'1990-10-10','1991-03-20','1990-1991',0),(114,'1991-05-13','1991-10-01','1991',0),(115,'1991-10-01','1992-08-17','1991-1992',0),(116,'1992-08-17','1993-10-01','1992-1993',0),(117,'1993-10-01','1994-10-01','1993-1994',0),(118,'1994-10-01','1995-05-16','1994-1995',0),(119,'1995-05-16','1995-10-02','1995',0),(120,'1995-10-02','1996-10-01','1995-1996',0),(121,'1996-10-01','1997-10-01','1996-1997',0),(122,'1997-10-01','1998-10-01','1997-1998',0),(123,'1998-10-01','1999-06-08','1998-1999',0),(124,'1999-06-08','1999-10-01','1999',0),(125,'1999-10-01','2000-10-02','1999-2000',0),(126,'2000-10-02','2001-10-01','2000-2001',0),(127,'2001-10-01','2002-10-01','2001-2002',0),(128,'2002-10-01','2003-05-26','2002-2003',0),(129,'2003-05-26','2003-10-01','2003',0),(130,'2003-10-01','2004-12-31','2003-2004',0),(131,'2004-10-01','2005-09-30','2004-2005',0),(132,'2005-09-30','2006-09-29','2005-2006',0),(133,'2006-09-29','2007-08-01','2006-2007',0),(134,'2007-05-31','2007-09-28','2007',0),(135,'2007-09-28','2008-09-30','2007-2008',0),(136,'2008-09-30','2009-04-25','2008-2009',0),(137,'2009-04-25','2009-09-30','2009',0),(138,'2009-10-01','2010-09-30','2009-2010',0),(139,'2010-10-01','2011-09-30','2010-2011',0),(140,'2011-10-01','2012-09-10','2011-2012',0),(141,'2012-09-11','2013-04-26','2012-2013',0),(142,'2013-06-06','2013-09-30','2013',0),(143,'2013-09-30','2014-09-08','2013-2014',0),(144,'2014-09-09',NULL,'2014-2015',0);
/*!40000 ALTER TABLE `Assembly` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Assembly_has_Person`
--

DROP TABLE IF EXISTS `Assembly_has_Person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Assembly_has_Person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assembly_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `abbr` varchar(10) NOT NULL,
  `type` varchar(100) NOT NULL,
  `constituency_id` int(11) DEFAULT NULL,
  `constituency` varchar(100) DEFAULT NULL,
  `constituency_number` int(11) DEFAULT NULL,
  `seat` int(11) DEFAULT NULL,
  `department` char(1) DEFAULT NULL,
  `from` datetime NOT NULL,
  `to` datetime DEFAULT NULL,
  `party` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_Assembly_has_Person` (`assembly_id`,`person_id`,`from`,`to`),
  KEY `fk_Assembly_has_Person_Person1_idx` (`person_id`),
  KEY `fk_Assembly_has_Person_Assembly1_idx` (`assembly_id`),
  KEY `fk_Assembly_has_Person_Party1_idx` (`party`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Assembly_has_Person`
--

LOCK TABLES `Assembly_has_Person` WRITE;
/*!40000 ALTER TABLE `Assembly_has_Person` DISABLE KEYS */;
/*!40000 ALTER TABLE `Assembly_has_Person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Avatar`
--

DROP TABLE IF EXISTS `Avatar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Avatar` (
  `person_id` int(10) unsigned NOT NULL,
  `data` text,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Avatar`
--

LOCK TABLES `Avatar` WRITE;
/*!40000 ALTER TABLE `Avatar` DISABLE KEYS */;
/*!40000 ALTER TABLE `Avatar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CV`
--

DROP TABLE IF EXISTS `CV`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CV` (
  `person_id` int(10) unsigned NOT NULL,
  `family` text,
  `education` text,
  `career` text,
  `social` text,
  `parliamentary` text,
  `substitute` text,
  `minister` text,
  `speaker` text,
  `presidency` text,
  `committee` text,
  `international_committee` text,
  `writing` text,
  `editor` text,
  `hash` char(32) DEFAULT NULL,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CV`
--

LOCK TABLES `CV` WRITE;
/*!40000 ALTER TABLE `CV` DISABLE KEYS */;
/*!40000 ALTER TABLE `CV` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cabinet`
--

DROP TABLE IF EXISTS `Cabinet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cabinet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cabinet`
--

LOCK TABLES `Cabinet` WRITE;
/*!40000 ALTER TABLE `Cabinet` DISABLE KEYS */;
INSERT INTO `Cabinet` VALUES (1,'Ráðherrar Íslands',NULL,'1904-02-01 00:00:00','1917-01-04 00:00:00','Ráðherrar Íslands störfuðu frá 1. febrúar 1904 - 4. janúar 1917.'),(2,'Fyrsta ráðuneyti Jóns Magnússonar','Fullveldisstjórnin','1917-01-04 00:00:00','1920-02-25 00:00:00',NULL),(3,'Annað ráðuneyti Jóns Magnússonar','Borgarastjórn I','1920-02-25 00:00:00','1922-03-07 00:00:00',NULL),(4,'Ráðuneyti Sigurðar Eggerz','Borgarastjórn II','1922-03-07 00:00:00','1924-03-22 00:00:00',NULL),(5,'Þriðja ráðuneyti Jóns Magnússonar','Hágengisstjórnin','1924-03-22 00:00:00','1926-07-08 00:00:00',NULL),(6,'Ráðuneyti Jóns Þorlákssonar','Borgarastjórn III','1926-07-08 00:00:00','1927-08-28 00:00:00',NULL),(7,'Ráðuneyti Tryggva Þórhallssonar','Stjórn Jónasar frá Hriflu','1927-08-28 00:00:00','1932-06-03 00:00:00',NULL),(8,'Ráðuneyti Ásgeirs Ásgeirssonar','Samstjórn lýðræðissinna','1932-06-03 00:00:00','1934-07-28 00:00:00',NULL),(9,'Fyrsta ráðuneyti Hermanns Jónassonar','Stjórn hinna vinnandi stétta','1934-07-28 00:00:00','1941-11-18 00:00:00','<p>Fyrsta ráðuneyti Hermanns Jónassonar (stundum kallað Stjórn hinna vinnandi stétta) er heiti á fyrstu ríkisstjórn Hermanns Jónassonar sem var samsteypustjórn Framsóknarflokksins og Alþýðuflokksins mynduð eftir Alþingiskosningar 1934 og tók til starfa 28. júlí. Þetta var í fyrsta skipti sem verkamannaflokkur átti aðild að ríkisstjórn á Íslandi. Meginverkefni stjórnarinnar var að takast á við þau vandamál sem fylgdu kreppunni sem á Íslandi stóð frá 1931 til 1940. Stjórn hinna vinnandi stétta var fyrsta ríkisstjórnin sem gerði með sér opinberan málefnasamning.</p>\r\n\r\n<p>Stjórnin sammæltist um víðtækar efnhags- og félagslegar umbætur. Hún kom í fyrsta sinn á heildstæðri löggjöf um almannatryggingar og bætti fátækralögin, sem voru með helstu baráttumálum Alþýðuflokksins, en flokknum tókst ekki að koma fram löggjöf um atvinnuleysisbætur. Um leið var komið skipulagi á sölu landbúnaðarafurða með afurðasölulögum sem meðal annars leiddi til stofnunar staðbundinna mjólkursamlaga með einkarétt á sölu mjólkur á tilteknu landsvæði, og grænmetisverslunar ríkisins með einkarétt á innflutningi grænmetis til landsins, auk þess sem komið var á einkarétti ríkisins á ýmsum öðrum sviðum bæði inn- og útflutnings og eftirliti með öðrum. Stjórnin kom á fót skipulagsnefnd atvinnumála sem átti m.a. að reyna að útrýma atvinnuleysi. Reistar voru skorður við innflutningi með innflutningshöftum og innflutningstollar lagðir á innfluttan iðnvarning um leið og reynt var að koma á innlendri framleiðslu á sem flestum sviðum.</p>\r\n\r\n<p>Framsóknarflokkurinn var ríkjandi flokkur í samstarfinu og það að atvinnuleysistryggingamálið skyldi ekki nást í gegn varð Alþýðuflokknum áfall. Þegar árið 1934 hafði Kommúnistaflokkur Íslands hafið tilraunir í þá átt að fá Alþýðuflokkinn með sér í breiðfylkingu alþýðu en Alþýðuflokkurinn vildi ekki ljá máls á því. Héðinn Valdimarsson hélt þá afram viðræðum við Kommúnista og 1937 var hann rekinn úr Alþýðuflokknum fyrir að stunda slíkar viðræður gegn ákvörðun flokksins. 1938 stofnaði hann Sameiningarflokk alþýðu - Sósíalistaflokkinn með Kommúnistum.</p>\r\n\r\n<p>Í febrúar 1937 urðu harðvítugar deilur á Alþingi þegar Alþýðuflokkurinn lagði til að stærsta sjávarútvegsfyrirtæki landsins, Kveldúlfur, sem meðal annars var í eigu Ólafs Thors, formanns Sjálfstæðisflokksins, yrði tekið til gjaldþrotaskipta vegna skulda þess við Landsbanka Íslands. Framsóknarflokkurinn hafnaði tillögunni og ekkert varð úr aðgerðum. Kveldúlfur bætti síðan skuldastöðu sína verulega á næstu árum.</p>\r\n\r\n<p>Í kosningum þetta sama ár bætti Framsóknarflokkurinn við sig fjórum þingmönnum en Alþýðuflokkurinn missti tvo þannig að stjórnin bætti við meirihluta sinn. Í apríl 1938 tók Skúli Guðmundsson, Framsóknarflokki, við embætti atvinnumálaráðherra af Haraldi Guðmundssyni.</p>\r\n\r\n<p>17. apríl 1939 var svo mynduð þjóðstjórn á Alþingi með þátttöku Sjálfstæðisflokksins vegna þess að brýnt þótti að fella gengi krónunnar til hagsbóta fyrir sjávarútveginn og vegna þess að mönnum þóttu blikur á lofti í alþjóðamálum.</p>'),(10,'Annað ráðuneyti Hermanns Jónassonar','Þjóðstjórnin','1941-11-18 00:00:00','1942-05-16 00:00:00','<p>Þriðja ráðuneyti Hermanns Jónassonar (stundum kallað Hræðslubandalagið) var kosningabandalag Alþýðuflokks og Framsóknarflokks í Alþingiskosningunum 24. júní 1956. Flokkarnir gerðu með sér samkomulag um að stilla ekki fram frambjóðendum í sömu einmennings og tvímennings kjördæmum. Bandalagið tók nafn sitt af þeirri staðreynd að Sósíalistar höfðu tekið höndum saman með forseta Alþýðusambands Íslands og fyrrum formanni Alþýðuflokksins, Hannibal Valdimarssyni og öðrum í málfundafélagi jafnaðarmanna og myndað Alþýðubandalag. Hræðslubandalagið stefndi að uppsögn varnarsamningsins við Bandaríkin. Bandalagið var stofnað í kjölfar þess að Framsóknarflokkurinn rauf stjórnarsamstarf við Sjálfstæðisflokkinn 27. mars.</p>\r\n\r\n<p>Að loknum Alþingiskosningunum 1956 myndaði Hræðslubandalagið stjórn með Alþýðubandalaginu 24. júlí. Þrátt fyrir að formaður Alþýðuflokksins, Haraldur Guðmundsson, hefði lýst því yfir að stjórnarsamstarf við Alþýðubandalagið kæmi ekki til greina.</p>\r\n\r\n<p>Þann 4. desember 1958 slitnaði upp úr samstarfi flokkanna í bandalaginu, eftir að hafa fært landhelgina út í 12 mílur 1. september 1958, án þess þó að hafa lokið málinu gagnvart Bretum. Alþýðuflokkurinn, undir forystu Emils Jónssonar myndaði stjórn með hlutleysi Sjálfstæðisflokks 23. desember. Ekki var varnarsamningum sagt upp þó að því hefði verið stefnt.</p>'),(11,'Fyrsta ráðuneyti Ólafs Thors','Ólafía I','1942-05-16 00:00:00','1942-12-16 00:00:00',NULL),(12,'Ráðuneyti Björns Þórðarsonar','Coca cola stjórnin','1942-12-16 00:00:00','1944-10-21 00:00:00','<p>Ráðuneyti Björns Þórðarsonar (stundum kallað \"Coca-Cola\"-stjórnin) var íslensk ríkisstjórn sem sat frá 16. desember 1942 til 21. október 1944. Við skipun stjórnarinnar var brotið blað í íslenskri stjórnmálasögu, þar sem enginn ráðherranna sem skipaðir voru átti sæti á Alþingi, stjórnin var eina utanþingsstjórn Íslands. Viðurnefnið fékk stjórnin sökum þess að tveir ráðherrar stjórnarinnar, Björn og Vilhjálmur, voru hlutafar í Vífilfelli, sem fékk einkaleyfi til innflutnings á gosdrykknum Kóka kóla. Þá var Vilhjálmur Þór meðal forsvarsmanna Sambands Íslenskra Samvinnufélaga er fékk umboð til olíusölu sem varð grunnur starfsemi Olíufélagsins hf.</p>'),(13,'Annað ráðuneyti Ólafs Thors','Nýsköpunarstjórnin','1944-10-21 00:00:00','1947-02-04 00:00:00',NULL),(14,'Ráðuneyti Stefáns Jóh. Stefánssonar','Stefanía','1947-02-04 00:00:00','1949-12-06 00:00:00',NULL),(15,'Þriðja ráðuneyti Ólafs Thors','Ólafía II','1949-12-06 00:00:00','1950-03-14 00:00:00',NULL),(16,'Ráðuneyti Steingríms Steinþórssonar',NULL,'1950-03-14 00:00:00','1953-09-11 00:00:00',NULL),(17,'Fjórða ráðuneyti Ólafs Thors',NULL,'1953-09-11 00:00:00','1956-07-24 00:00:00',NULL),(18,'Fimmta ráðuneyti Hermanns Jónassonar','Vinstristjórn I','1956-07-24 00:00:00','1958-12-23 00:00:00',NULL),(19,'Ráðuneyti Emils Jónssonar','Emilía','1958-12-23 00:00:00','1959-11-20 00:00:00',NULL),(20,'Fimmta ráðuneyti Ólafs Thors','Viðreisnarstjórnin','1959-11-20 00:00:00','1963-11-14 00:00:00',NULL),(21,'Ráðuneyti Bjarna Benediktssonar','Viðreisnarstjórnin','1963-11-14 00:00:00','1970-07-10 00:00:00',NULL),(22,'Ráðuneyti Jóhanns Hafstein','Viðreisnarstjórnin','1970-07-10 00:00:00','1971-07-14 00:00:00',NULL),(23,'Fyrsta ráðuneyti Ólafs Jóhannessonar','Vinstristjórn II','1971-07-14 00:00:00','1974-08-28 00:00:00',NULL),(24,'Ráðuneyti Geirs Hallgrímssonar',NULL,'1974-08-28 00:00:00','1978-09-01 00:00:00',NULL),(25,'Annað ráðuneyti Ólafs Jóhannessonar','Vinstristjórn III','1978-09-01 00:00:00','1979-10-15 00:00:00',NULL),(26,'Ráðuneyti Benedikts Gröndals',NULL,'1979-10-15 00:00:00','1980-02-08 00:00:00',NULL),(27,'Ráðuneyti Gunnars Thoroddsens',NULL,'1980-02-08 00:00:00','1983-05-26 00:00:00',NULL),(28,'Fyrsta ráðuneyti Steingríms Hermannssonar',NULL,'1983-05-26 00:00:00','1987-07-08 00:00:00',NULL),(29,'Ráðuneyti Þorsteins Pálssonar','Stjórnin sem sprakk í beinni','1987-07-08 00:00:00','1988-09-28 00:00:00',NULL),(30,'Annað ráðuneyti Steingríms Hermannssonar','Vinstristjórn IV','1988-09-28 00:00:00','1989-09-10 00:00:00',NULL),(31,'Þriðja ráðuneyti Steingríms Hermannssonar','Vinstristjórn V','1989-09-10 00:00:00','1991-04-30 00:00:00',NULL),(32,'Fyrsta ráðuneyti Davíðs Oddssonar','Viðeyjarstjórnin','1991-04-30 00:00:00','1995-04-23 00:00:00',NULL),(33,'Annað ráðuneyti Davíðs Oddssonar','Einkavæðingarstjórnin','1995-04-23 00:00:00','1999-05-28 00:00:00',NULL),(34,'Þriðja ráðuneyti Davíðs Oddssonar','Einkavæðingarstjórnin','1999-05-28 00:00:00','2003-05-23 00:00:00',NULL),(35,'Fjórða ráðuneyti Davíðs Oddssonar','Einkavæðingarstjórnin','2003-05-23 00:00:00','2004-09-15 00:00:00',NULL),(36,'Ráðuneyti Halldórs Ásgrímssonar',NULL,'2004-09-15 00:00:00','2006-06-15 00:00:00',NULL),(37,'Fyrsta ráðuneyti Geirs H. Haarde',NULL,'2006-06-15 00:00:00','2007-05-24 00:00:00',NULL),(38,'Annað ráðuneyti Geirs H. Haarde','Þingvallastjórnin','2007-05-24 00:00:00','2009-02-01 00:00:00',NULL),(39,'Fyrsta ráðuneyti Jóhönnu Sigurðardóttur','Minnihlutastjórnin','2009-02-01 00:00:00','2009-05-10 00:00:00',NULL),(40,'Annað ráðuneyti Jóhönnu Sigurðardóttur','Velferðarstjórnin','2009-05-10 00:00:00','2013-05-30 00:00:00',NULL);
/*!40000 ALTER TABLE `Cabinet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cabinet_has_Person`
--

DROP TABLE IF EXISTS `Cabinet_has_Person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cabinet_has_Person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cabinet_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `ministry` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=354 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cabinet_has_Person`
--

LOCK TABLES `Cabinet_has_Person` WRITE;
/*!40000 ALTER TABLE `Cabinet_has_Person` DISABLE KEYS */;
INSERT INTO `Cabinet_has_Person` VALUES (1,1,119,'1915-05-04 00:00:00','1917-01-04 00:00:00',NULL),(2,1,506,'1914-07-21 00:00:00','1915-05-04 00:00:00',NULL),(3,1,232,'1912-07-25 00:00:00','1914-07-21 00:00:00',NULL),(4,1,393,'1911-03-14 00:00:00','1912-07-25 00:00:00',NULL),(5,1,83,'1909-03-31 00:00:00','1911-03-14 00:00:00',NULL),(6,1,232,'1904-02-01 00:00:00','1909-03-31 00:00:00',NULL),(7,2,326,'1917-01-04 00:00:00','1920-02-25 00:00:00','Forsætisráðherra og dómsmálaráðherra'),(8,2,85,'1917-01-04 00:00:00','1917-08-28 00:00:00','Fjármálaráðherra'),(9,2,506,'1917-08-28 00:00:00','1920-02-25 00:00:00','Fjármálaráðherra'),(10,2,515,'1917-01-04 00:00:00','1920-02-25 00:00:00','Atvinnumálaráðherra'),(11,3,326,'1920-02-25 00:00:00','1922-03-07 00:00:00','Forsætisráðherra og dómsmálaráðherra'),(12,3,415,'1920-02-25 00:00:00','1922-03-07 00:00:00','Fjármálaráðherra'),(13,3,415,'1922-01-20 00:00:00','1922-03-07 00:00:00','Atvinnumálaráðherra'),(14,3,481,'1920-02-25 00:00:00','1922-01-20 00:00:00','Atvinnumálaráðherra'),(15,4,506,'1922-03-07 00:00:00','1924-03-22 00:00:00','Forsætisráðherra og dómsmálaráðherra'),(16,4,380,'1922-03-07 00:00:00','1924-03-22 00:00:00','Atvinnumálaráðherra'),(17,4,380,'1923-04-18 00:00:00','1924-03-22 00:00:00','Fjármálaráðherra'),(18,5,326,'1924-03-22 00:00:00','1926-06-23 00:00:00','Forsætisráðherra og dómsmálaráðherra'),(19,5,343,'1924-03-22 00:00:00','1926-07-08 00:00:00','Fjármálaráðherra'),(20,5,415,'1924-03-22 00:00:00','1926-07-08 00:00:00','Atvinnumálaráðherra'),(21,5,415,'1926-06-23 00:00:00','1926-07-08 00:00:00','Forsætisráðherra'),(22,6,343,'1926-07-08 00:00:00','1927-08-28 00:00:00','Forsætisráðherra og fjármálaráðherra'),(23,6,415,'1926-07-08 00:00:00','1927-08-28 00:00:00','Atvinnumálaráðherra og dómsmálaráðherra'),(24,7,582,'1927-08-28 00:00:00','1932-06-03 00:00:00','Forsætisráðherra'),(25,7,582,'1927-08-28 00:00:00','1931-04-20 00:00:00','Atvinnumálaráðherra'),(26,7,582,'1931-08-20 00:00:00','1932-06-03 00:00:00','Atvinnumálaráðherra'),(27,7,582,'1928-12-08 00:00:00','1929-03-07 00:00:00','Fjármálaráðherra'),(28,7,582,'1931-04-20 00:00:00','1931-08-20 00:00:00','Dómsmálaráðherra'),(29,7,351,'1927-08-28 00:00:00','1931-04-20 00:00:00','Dómsmálaráðherra og menntamálaráðherra'),(30,7,351,'1931-08-20 00:00:00','1932-06-03 00:00:00','Dómsmálaráðherra og menntamálaráðherra'),(31,7,121,'1929-03-07 00:00:00','1931-04-20 00:00:00','Fjármálaráðherra'),(32,7,420,'1927-08-28 00:00:00','1928-12-08 00:00:00','Fjármálaráðherra'),(33,7,43,'1931-08-20 00:00:00','1932-06-03 00:00:00','Fjármálaráðherra'),(34,8,43,'1932-06-03 00:00:00','1934-07-28 00:00:00','Forsætisráðherra og fjármálaráðherra'),(35,8,415,'1932-06-03 00:00:00','1932-11-14 00:00:00','Dómsmálaráðherra'),(36,8,415,'1932-12-23 00:00:00','1934-07-28 00:00:00','Dómsmálaráðherra'),(37,8,600,'1932-06-03 00:00:00','1934-07-28 00:00:00','Atvinnumálaráðherra'),(38,8,452,'1932-11-14 00:00:00','1932-12-23 00:00:00','Dómsmálaráðherra'),(39,9,249,'1934-07-28 00:00:00','1941-11-18 00:00:00','Forsætisráðherra og dómsmálaráðherra'),(40,9,148,'1934-07-28 00:00:00','1939-04-17 00:00:00','Fjármálaráðherra'),(41,9,148,'1939-04-17 00:00:00','1941-11-18 00:00:00','Viðskiptaráðherra'),(42,9,237,'1934-07-28 00:00:00','1938-03-20 00:00:00','Atvinnumála- og samgönguráðherra'),(43,9,532,'1938-03-20 00:00:00','1939-04-17 00:00:00','Atvinnumálaráðherra'),(44,9,276,'1939-04-17 00:00:00','1941-11-18 00:00:00','Fjármálaráðherra'),(45,9,452,'1939-04-17 00:00:00','1941-11-18 00:00:00','Atvinnumálaráðherra'),(46,9,547,'1939-04-17 00:00:00','1941-11-18 00:00:00','Félagsmálaráðherra og utanríkisráðherra'),(47,10,249,'1941-11-18 00:00:00','1942-05-16 00:00:00','Forsætisráðherra, landbúnaðarráðherra og dómsmálaráðherra'),(48,10,547,'1941-11-18 00:00:00','1942-01-17 00:00:00','Utanríkisráðherra og félagsmálaráðherra'),(49,10,148,'1941-11-18 00:00:00','1942-05-16 00:00:00','Viðskiptaráðherra'),(50,10,452,'1941-11-18 00:00:00','1942-05-16 00:00:00','Atvinnumálaráðherra'),(51,10,276,'1941-11-18 00:00:00','1942-05-16 00:00:00','Fjármálaráðherra og iðnaðarráðherra'),(52,11,452,'1942-05-16 00:00:00','1942-12-16 00:00:00','Forsætisráðherra og utanríkisráðherra'),(53,11,276,'1942-05-16 00:00:00','1942-12-16 00:00:00','Fjármálaráðherra og dómsmálaráðherra'),(54,11,417,'1942-05-16 00:00:00','1942-12-16 00:00:00','Atvinnumálaráðherra'),(55,40,287,'2009-05-10 00:00:00','2013-05-30 00:00:00','Forsætisráðherra'),(56,40,557,'2009-05-10 00:00:00','2011-12-31 00:00:00','Fjármálaráðherra'),(57,40,557,'2011-12-31 00:00:00','2012-09-01 00:00:00','Efnahags- og viðskiptaráðherra og sjávarútvegs- og landbúnaðarráðherra'),(58,40,557,'2012-09-01 00:00:00','2013-05-30 00:00:00','Atvinnu- og nýsköpunarráðherra'),(59,40,631,'2009-05-10 00:00:00','2013-05-30 00:00:00','Utanríkisráðherra'),(60,40,396,'2009-05-10 00:00:00','2010-09-02 00:00:00','Samgöngumálaráðherra og samgöngu- og sveitarstjórnarráðherra.'),(61,40,630,'2009-05-10 00:00:00','2009-11-01 00:00:00','Heilbrigðisráðherra'),(62,40,630,'2010-09-02 00:00:00','2013-05-30 00:00:00','Dómsmála- og mannréttindaráðherra og samgöngu- og sveitarstjórnarráðherra.  Sameinuðust 1. jan. 2011 undir innanríkisráðuneyti'),(63,40,690,'2009-05-10 00:00:00','2013-05-30 00:00:00','Menntamálaráðherra og mennta- og menningarmálaráðherra.'),(64,40,371,'2009-05-10 00:00:00','2011-12-31 00:00:00','Sjávarútvegs- og landbúnaðarráðherra'),(65,40,660,'2009-05-10 00:00:00','2012-09-01 00:00:00','Iðnaðarráðherra'),(66,40,660,'2012-10-01 00:00:00','2013-05-30 00:00:00','Efnahags- og viðskiptaráðherra'),(67,40,678,'2009-05-10 00:00:00','2010-09-02 00:00:00','Félags- og tryggingarmálaráðherra'),(68,40,678,'2010-09-02 00:00:00','2011-12-31 00:00:00','Efnahags- og viðskiptaráðherra'),(69,40,730,'2009-05-10 00:00:00','2012-09-01 00:00:00','Umhverfisráðherra'),(70,40,730,'2012-09-01 00:00:00','2013-05-30 00:00:00','Umhverfis- og auðlindaráðherra'),(71,40,676,'2009-10-01 00:00:00','2010-09-02 00:00:00','Heilbrigðisráðherra'),(72,40,683,'2010-09-02 00:00:00','2013-05-30 00:00:00','Félags- og tryinngamálaráðherra og heilbrigðisráðherra.  Ráðuneytin sameinuðust undir velferðarráðuneyti 1. jan. 2011'),(73,40,719,'2011-12-31 00:00:00','2012-09-01 00:00:00','Fjármálaráðherra'),(74,40,719,'2012-09-01 00:00:00','2012-10-01 00:00:00','Fjármála- og efnahagsráðherra'),(75,39,287,'2009-02-01 00:00:00','2009-05-10 00:00:00','Forsætisráðherra'),(76,39,557,'2009-02-01 00:00:00','2009-05-10 00:00:00','Fjármálaráðherra og sjávarútvegs- og landbúnaðarráðherra'),(77,39,631,'2009-02-01 00:00:00','2009-05-10 00:00:00','Utanríkisráðherra og iðnaðarráðherra'),(78,39,396,'2009-02-01 00:00:00','2009-05-10 00:00:00','Samgönguráðherra'),(79,39,48,'2009-02-01 00:00:00','2009-05-10 00:00:00','Félags- og tryggingamálaráðherra'),(80,39,630,'2009-02-01 00:00:00','2009-05-10 00:00:00','Heilbrigðisráðherra'),(81,39,383,'2009-02-01 00:00:00','2009-05-10 00:00:00','Umhverfisráðherra'),(82,39,690,'2009-02-01 00:00:00','2009-05-10 00:00:00','Menntamálaráðherra'),(83,38,162,'2007-05-24 00:00:00','2009-02-01 00:00:00','Forsætisráðherra'),(84,38,264,'2007-05-24 00:00:00','2009-02-01 00:00:00','Utanríkisráðherra'),(85,38,5,'2007-05-24 00:00:00','2009-02-01 00:00:00','Fjármálaráðherra'),(86,38,653,'2007-05-24 00:00:00','2009-02-01 00:00:00','Viðskiptaráðherra'),(87,38,76,'2007-05-24 00:00:00','2009-02-01 00:00:00','Dóms- og kirkjumálaráðherra'),(88,38,124,'2007-05-24 00:00:00','2009-02-01 00:00:00','Sjávarútvegs- og landbúnaðarráðherra'),(89,38,656,'2007-05-24 00:00:00','2009-02-01 00:00:00','Heilbrigðis- og tryggingamálaráðherra'),(90,38,287,'2007-05-24 00:00:00','2009-02-01 00:00:00','Félagsmálaráðherra'),(91,38,396,'2007-05-24 00:00:00','2009-02-01 00:00:00','Samgönguráðherra'),(92,38,632,'2007-05-24 00:00:00','2009-02-01 00:00:00','Menntamálaráðherra'),(93,38,633,'2007-05-24 00:00:00','2009-02-01 00:00:00','Umhverfisráðherra'),(94,38,631,'2007-05-24 00:00:00','2009-02-01 00:00:00','Iðnaðarráðherra'),(95,37,162,'2006-06-15 00:00:00','2007-05-24 00:00:00','Forsætisráðherra'),(96,37,13,'2006-06-15 00:00:00','2007-05-24 00:00:00','Utanríkisráðherra'),(97,37,5,'2006-06-15 00:00:00','2007-05-24 00:00:00','Fjármálaráðherra'),(98,37,76,'2006-06-15 00:00:00','2007-05-24 00:00:00','Dóms- og kirkjumálaráðherra'),(99,37,124,'2006-06-15 00:00:00','2007-05-24 00:00:00','Sjávarútvegsráðherra'),(100,37,198,'2006-06-15 00:00:00','2007-05-24 00:00:00','Landbúnaðarráðherra'),(102,37,372,'2006-06-15 00:00:00','2007-05-24 00:00:00','Umhverfisráðherra og samstarfsráðherra Norðurlanda'),(103,37,425,'2006-06-15 00:00:00','2007-05-24 00:00:00','Félagsmálaráðherra'),(104,37,530,'2006-06-15 00:00:00','2007-05-24 00:00:00','Heilbrigðis- og tryggingamálaráðherra'),(105,37,560,'2006-06-15 00:00:00','2007-05-24 00:00:00','Samgönguráðherra'),(106,37,632,'2006-06-15 00:00:00','2007-05-24 00:00:00','Menntamálaráðherra'),(107,36,8,'2004-09-15 00:00:00','2006-06-15 00:00:00','Forsætisráðherra'),(108,36,8,'2005-09-27 00:00:00','2006-06-15 00:00:00','Ráðherra Hagstofu'),(109,36,106,'2004-09-15 00:00:00','2005-09-27 00:00:00','Utanríkisráðherra og ráðherra Hagstofu'),(110,36,162,'2004-09-15 00:00:00','2005-09-27 00:00:00','Fjármálaráðherra'),(111,36,162,'2005-09-27 00:00:00','2006-06-15 00:00:00','Utanríkisráðherra'),(112,36,5,'2004-09-15 00:00:00','2005-09-27 00:00:00','Sjávarútvegsráðherra'),(113,36,5,'2005-09-27 00:00:00','2006-06-15 00:00:00','Fjármálaráðherra'),(114,36,198,'2004-09-15 00:00:00','2006-06-15 00:00:00','Landbúnaðarráðherra'),(115,36,10,'2004-09-15 00:00:00','2006-03-07 00:00:00','Heilbrigðis- og tryggingamálaráðherra'),(116,36,10,'2006-03-07 00:00:00','2006-06-15 00:00:00','Félagsmálaráðherra'),(117,36,560,'2004-09-15 00:00:00','2006-06-15 00:00:00','Samgöngráðherra'),(118,36,13,'2004-09-15 00:00:00','2005-09-27 00:00:00','Iðnaðar- og viðskiptaráðherra og samstarfsráðherra Norðurlanda'),(119,36,76,'2004-09-15 00:00:00','2006-06-15 00:00:00','Dóms- og kirkjumálaráðherra'),(120,36,649,'2004-09-15 00:00:00','2006-03-07 00:00:00','Félagsmálaráðherra'),(121,36,632,'2004-09-15 00:00:00','2006-06-15 00:00:00','Menntamálaráðherra'),(122,36,501,'2005-09-27 00:00:00','2006-06-15 00:00:00','Umhverfisráðherra og samstarfsráðherra Norðurlanda'),(123,36,124,'2005-09-27 00:00:00','2006-06-15 00:00:00','Sjávarútvegsráðherra'),(124,36,530,'2006-03-07 00:00:00','2006-06-15 00:00:00','Heilbrigðis- og tryggingamálaráðherra'),(125,35,106,'2003-05-23 00:00:00','2004-09-15 00:00:00','Forsætisráðherra og ráðherra Hagstofu Íslands'),(126,35,8,'2003-05-23 00:00:00','2004-09-15 00:00:00','Utanríkisráðherra'),(127,35,162,'2003-05-23 00:00:00','2004-09-15 00:00:00','Fjármálaráðherra'),(128,35,5,'2003-05-23 00:00:00','2004-09-15 00:00:00','Sjávarútvegsráðherra'),(129,35,192,'2003-05-23 00:00:00','2004-09-15 00:00:00','Landbúnaðarráðherra'),(130,35,10,'2003-05-23 00:00:00','2004-09-15 00:00:00','Heilbrigðis- og tryggingamálaráðherra'),(131,35,530,'2003-05-23 00:00:00','2004-09-15 00:00:00','Umhverfisráðherra og samstarfsráðherra Norðurlanda'),(132,35,560,'2003-05-23 00:00:00','2004-09-15 00:00:00','Samgönguráðherra'),(133,35,13,'2003-05-23 00:00:00','2004-09-15 00:00:00','Iðnaðar- og viðskiptaráðherra'),(134,35,579,'2003-05-23 00:00:00','2003-12-31 00:00:00','Menntamálaráðherra'),(135,35,76,'2003-05-23 00:00:00','2004-09-15 00:00:00','Dóms- og kirkjumálaráðherra'),(136,35,649,'2003-05-23 00:00:00','2004-09-15 00:00:00','Félagsmálaráðherra'),(137,34,106,'1999-05-28 00:00:00','2003-05-23 00:00:00','Forsætisráðherra og ráðherra Hagstofu Íslands'),(138,34,8,'1999-05-28 00:00:00','2003-05-23 00:00:00','Utanríkisráðherra'),(139,34,76,'1999-05-28 00:00:00','2002-03-02 00:00:00','Menntamálaráðherra'),(140,34,5,'1999-05-28 00:00:00','2003-05-23 00:00:00','Sjávarútvegsráðherra'),(141,34,150,'1999-05-28 00:00:00','1999-12-31 00:00:00','Iðnaðar- og viðskiptaráðherra'),(142,34,162,'1999-05-28 00:00:00','2003-05-23 00:00:00','Fjármálaráðherra'),(143,34,192,'1999-05-28 00:00:00','2003-05-23 00:00:00','Landbúnaðarráðherra'),(144,34,265,'1999-05-28 00:00:00','2001-05-14 00:00:00','Heilbrigðis- og tryggingamálaráðherra'),(145,34,10,'2001-05-14 00:00:00','2003-05-23 00:00:00','Heilbrigðis- og tryggingamálaráðherra'),(146,34,467,'1999-05-28 00:00:00','2003-05-23 00:00:00','Félagsmálaráðherra'),(147,34,530,'1999-05-28 00:00:00','2003-05-23 00:00:00','Umhverfisráðherra og samstarfsráðherra Norðurlanda'),(148,34,538,'1999-05-28 00:00:00','2003-05-23 00:00:00','Dóms- og kirkjumálaráðherra'),(149,34,560,'1999-05-28 00:00:00','2003-05-23 00:00:00','Samgönguráðherra'),(150,34,13,'1999-12-31 00:00:00','2003-05-23 00:00:00','Iðnaðar- og viðskiptaráðherra'),(151,34,579,'2002-03-02 00:00:00','2003-05-23 00:00:00','Menntamálaráðherra'),(152,33,106,'1995-04-23 00:00:00','1999-05-28 00:00:00','forsætisráðherra og ráðherra Hagstofu Íslands'),(153,33,8,'1995-04-23 00:00:00','1999-05-28 00:00:00','utanríkisráðherra og samstarfsráðherra Norðurlandanna'),(154,33,76,'1995-04-23 00:00:00','1999-05-28 00:00:00','Menntamálaráðherra'),(155,33,150,'1995-04-23 00:00:00','1999-05-28 00:00:00','Iðnaðar- og viðskiptaráðherra'),(156,33,156,'1995-04-23 00:00:00','1998-04-16 00:00:00','Fjármálaráðherra'),(157,33,162,'1998-04-16 00:00:00','1999-05-28 00:00:00','Fjármálaráðherra'),(158,33,181,'1995-04-23 00:00:00','1999-05-11 00:00:00','Umhverfisráðherra og Landbúnaðarráðherra'),(159,33,12,'1995-04-23 00:00:00','1999-05-28 00:00:00','Samgönguráðherra'),(160,33,265,'1995-04-23 00:00:00','1999-05-28 00:00:00','Heilbrigðisráðherra'),(161,33,467,'1995-04-23 00:00:00','1999-05-28 00:00:00','Félagsmálaráðherra'),(162,33,606,'1995-04-23 00:00:00','1999-05-28 00:00:00','Dóms- og kirkjumálaráðherra'),(163,32,106,'1991-04-30 00:00:00','1995-04-23 00:00:00','forsætisráðherra og ráðherra Hagstofu Íslands'),(164,32,300,'1991-04-30 00:00:00','1995-04-23 00:00:00','Utanríkisráðherra'),(165,32,337,'1991-04-30 00:00:00','1993-06-14 00:00:00','Iðnaðarráðherra og viðskiptaráðherra'),(166,32,287,'1991-04-30 00:00:00','1994-06-24 00:00:00','Félagsmálaráðherra'),(167,32,499,'1991-04-30 00:00:00','1993-06-14 00:00:00','Heilbrigðisráðherra'),(168,32,606,'1991-04-30 00:00:00','1995-04-23 00:00:00','Dóms- og kirkjumálaráðherra og sjávarútvegsráðherra'),(169,32,156,'1991-04-30 00:00:00','1995-04-23 00:00:00','Fjármálaráðherra'),(170,32,439,'1991-04-30 00:00:00','1995-04-23 00:00:00','Menntamálaráðherra'),(171,32,12,'1991-04-30 00:00:00','1995-04-23 00:00:00','Samgönguráðhherra og landbúnaðarráðherra'),(172,32,118,'1991-04-30 00:00:00','1993-06-14 00:00:00','Umhverfisráðherra og samstarfsráðherra Norðurlandanna'),(173,32,7,'1993-06-14 00:00:00','1994-06-24 00:00:00','Heilbrigðisráðherra'),(174,32,631,'1993-06-14 00:00:00','1995-04-23 00:00:00','Umhverfisráðherra'),(175,32,491,'1994-11-12 00:00:00','1995-04-23 00:00:00','Félagsmálaráðherra'),(176,33,106,'1999-05-11 00:00:00','1999-05-28 00:00:00',' Dóms- og kirkjumálaráðherra og sjávarútvegsráðherra'),(177,33,8,'1999-05-11 00:00:00','1999-05-28 00:00:00',' Landbúnaðarráðherra og umhverfisráðherra'),(178,32,499,'1993-06-14 00:00:00','1995-04-23 00:00:00','Iðnaðarráðherra, viðskiptaráðherra og samstarfsráðherra Norðurlandanna'),(179,32,499,'1994-11-12 00:00:00','1995-04-23 00:00:00','Heilbrigðisráðherra'),(180,32,7,'1994-06-24 00:00:00','1994-11-12 00:00:00','Félagsmálaráðherra'),(181,31,554,'1989-09-10 00:00:00','1991-04-30 00:00:00','Forsætisráðherra'),(182,31,554,'1990-02-23 00:00:00','1991-04-30 00:00:00','Ráðherra Hagstofu Íslands'),(183,31,300,'1989-09-10 00:00:00','1991-04-30 00:00:00','Utanríkisráðherra'),(184,31,237,'1989-09-10 00:00:00','1991-04-30 00:00:00','Iðnaðarráðherra og viðskiptaráðherra'),(185,31,287,'1989-09-10 00:00:00','1991-04-30 00:00:00','Félagsmálaráðherra'),(186,31,181,'1989-09-10 00:00:00','1991-04-30 00:00:00','Heilbrigðisráðherra'),(187,31,8,'1989-09-10 00:00:00','1991-04-30 00:00:00','Sjávarútvegsráðherra'),(188,31,440,'1989-09-10 00:00:00','1991-04-30 00:00:00','Fjármálaráðherra'),(189,31,563,'1989-09-10 00:00:00','1991-04-30 00:00:00','Menntamálaráðherra'),(190,31,557,'1989-09-10 00:00:00','1991-04-30 00:00:00','Samgöngu og landbúnaðarráðherra'),(191,31,362,'1989-09-10 00:00:00','1991-04-30 00:00:00','Umhverfisráðherra og samstarfsráðherra Norðurlandanna'),(192,31,454,'1989-09-10 00:00:00','1991-04-30 00:00:00','Dóms- og kirkjumálaráðherra'),(193,31,362,'1989-09-10 00:00:00','1990-02-23 00:00:00','Ráðherra Hagstofu Íslands'),(194,30,554,'1988-09-28 00:00:00','1989-09-10 00:00:00','Forsætisráðherra og ráðherra Hagstofu Íslands'),(195,30,300,'1988-09-28 00:00:00','1989-09-10 00:00:00','Utanríkisráðherra'),(196,30,337,'1988-09-28 00:00:00','1989-09-10 00:00:00','Iðnaðarráðherra og viðskiptaráðherra og samstarfsráðherra Norðurlandanna'),(197,30,287,'1988-09-28 00:00:00','1989-09-10 00:00:00','Félagsmálaráðherra'),(198,30,181,'1988-09-28 00:00:00','1989-09-10 00:00:00','Heilbrigðisráðhhera'),(199,30,8,'1988-09-28 00:00:00','1989-09-10 00:00:00','Sjávarútvegsráðherra og dóms- og kirkjumálaráðherra'),(200,30,440,'1988-09-28 00:00:00','1989-09-10 00:00:00','Fjármálaráðherra'),(201,30,563,'1988-09-28 00:00:00','1989-09-10 00:00:00','Menntamálaráðherra'),(202,30,557,'1988-09-28 00:00:00','1989-09-10 00:00:00','Samgönguráðherra og landbúnaðarráðherra'),(203,29,606,'1987-07-08 00:00:00','1988-09-28 00:00:00','Forsætisráðherra'),(204,29,554,'1987-07-08 00:00:00','1988-09-28 00:00:00','Utanríkisráðherra'),(205,29,61,'1987-07-08 00:00:00','1988-09-28 00:00:00','Menntamálaráðherra'),(206,29,156,'1987-07-08 00:00:00','1988-09-28 00:00:00','Iðnaðarráðherra'),(207,29,181,'1987-07-08 00:00:00','1988-09-28 00:00:00','Heilbrigðisráðherra'),(208,29,8,'1987-07-08 00:00:00','1988-09-28 00:00:00','Sjávarútvegsráðherra'),(209,29,287,'1987-07-08 00:00:00','1988-09-28 00:00:00','Félagsmálaráðherra'),(210,29,300,'1987-07-08 00:00:00','1988-09-28 00:00:00','Fjármálaráðherra'),(211,29,302,'1987-07-08 00:00:00','1988-09-28 00:00:00','Landbúnaðarráðherra'),(212,29,337,'1987-07-08 00:00:00','1988-09-28 00:00:00','Dóms- og Kirkjumálaráðherra og viðskiptaráðherra og ráðherra Hagstofu Ísl.'),(213,29,431,'1987-07-08 00:00:00','1988-09-28 00:00:00','Samgönguráðherra og samstarfsráðherra Norðurlandanna'),(214,28,554,'1983-05-26 00:00:00','1987-07-08 00:00:00','Forsætisráðherra'),(215,28,163,'1983-05-26 00:00:00','1986-01-24 00:00:00','Utanríkisráðherra'),(216,28,15,'1983-05-26 00:00:00','1985-10-16 00:00:00','Fjármálaráðherra'),(217,28,16,'1983-05-26 00:00:00','1987-07-08 00:00:00','Félagsmálaráðherra'),(218,28,8,'1983-05-26 00:00:00','1987-07-08 00:00:00','Sjávarútvegsráðherra'),(219,28,302,'1983-05-26 00:00:00','1987-07-08 00:00:00','Landbúnaðarráðherra og dóms- og kirkjumálaráðherra'),(220,28,430,'1983-05-26 00:00:00','1987-07-08 00:00:00','Samgönguráðherra'),(221,28,431,'1983-05-26 00:00:00','1985-10-16 00:00:00','Viðskiptaráðherra , ráðherra hagstofu íslands og samstarfsráðherra Norðurlandanna'),(222,28,490,'1983-05-26 00:00:00','1985-10-16 00:00:00','Menntamálaráðherra'),(223,28,573,'1983-05-26 00:00:00','1985-10-16 00:00:00','Iðnaðarráðherra'),(224,28,15,'1985-10-16 00:00:00','1987-03-24 00:00:00','Iðnaðarráðherra'),(225,28,8,'1985-10-16 00:00:00','1987-07-08 00:00:00','Samstarfsráðherra Norðurlandanna'),(226,28,430,'1983-05-26 00:00:00','1985-10-16 00:00:00','Heilbrigðisráðherra'),(227,28,430,'1985-10-16 00:00:00','1987-07-08 00:00:00','Viðskiptaráðherra'),(228,28,431,'1986-01-24 00:00:00','1987-07-08 00:00:00','Utanríkisráðherra'),(229,28,490,'1985-10-16 00:00:00','1987-07-08 00:00:00','Heilbrigðisráðherra'),(230,28,573,'1985-10-16 00:00:00','1987-07-08 00:00:00','Menntamálaráðherra'),(231,28,606,'1985-10-16 00:00:00','1987-07-08 00:00:00','Fjármálaráðherra og ráðherra hagstofu íslands'),(232,28,606,'1987-03-24 00:00:00','1987-07-08 00:00:00','Iðnaðarráðherra'),(233,33,606,'1995-04-23 00:00:00','1999-05-11 00:00:00','Sjávarútvegsráðherra'),(234,35,632,'2003-12-31 00:00:00','2004-09-15 00:00:00','Menntamálaráðherra'),(235,27,212,'1980-02-08 00:00:00','1983-05-26 00:00:00','Forsætisráðherra og ráðherra Hagstofu Ísl.'),(236,27,443,'1980-02-08 00:00:00','1983-05-26 00:00:00','Utanríkisráðherra'),(237,27,155,'1980-02-08 00:00:00','1983-05-26 00:00:00','Dóms- og kirkjumálaráðherra og samstarfsráðherra Norðurlandanna'),(238,27,254,'1980-02-08 00:00:00','1983-05-26 00:00:00','Iðnaðarráðherra'),(239,27,270,'1980-02-08 00:00:00','1983-05-26 00:00:00','Menntamálaráðherra'),(240,27,474,'1980-02-08 00:00:00','1983-05-26 00:00:00','Landbúnaðarráðherra'),(241,27,488,'1980-02-08 00:00:00','1983-05-26 00:00:00','Fjármálaráðherra'),(242,27,554,'1980-02-08 00:00:00','1983-05-26 00:00:00','Sjávarútvegsráðherra og samgönguráðherra'),(243,27,563,'1980-02-08 00:00:00','1983-05-26 00:00:00','Heilbrigðisráðherra og félagsmálaráðherra'),(244,27,578,'1980-02-08 00:00:00','1983-05-26 00:00:00','Viðskiptaráðherra'),(245,26,51,'1979-10-15 00:00:00','1980-02-08 00:00:00','Forsætisráðherra , utanríkisráðherra og samstarfsráðherra Norðurlandanna'),(246,26,97,'1979-10-15 00:00:00','1980-02-08 00:00:00','Landbúnaðarráðherra og iðnaðarráðherra'),(247,26,377,'1979-10-15 00:00:00','1980-02-08 00:00:00','Sjávarútvegsráðherra og viðskiptaráðherra'),(248,26,421,'1979-10-15 00:00:00','1980-02-08 00:00:00','Félagsmálaráðherra , heilbrigðisraðherra og samgönguráðherra'),(249,26,499,'1979-10-15 00:00:00','1980-02-08 00:00:00','Fjármálaráðherra og ráðherra hagstofu Ísl.'),(250,26,590,'1979-10-15 00:00:00','1980-02-08 00:00:00','Menntamálaráðherra og dóms- og kirkjumálaráðherra'),(251,25,443,'1978-09-01 00:00:00','1979-10-15 00:00:00','Forsætisráðherra , ráðherra hagstofu íslands og samstarfsráðherra Norðurlandanna'),(252,25,51,'1978-09-01 00:00:00','1979-10-15 00:00:00','Utanríkisráðherra'),(253,25,254,'1978-09-01 00:00:00','1979-10-15 00:00:00','Iðnaðarráðherra'),(254,25,377,'1978-09-01 00:00:00','1979-10-15 00:00:00','Sjávarútvegsráðherra'),(255,25,421,'1978-09-01 00:00:00','1979-10-15 00:00:00','Félagsmálaráðherra og heilbrigðisráðherra'),(256,25,488,'1978-09-01 00:00:00','1979-10-15 00:00:00','Menntamálaráðherra og samgönguráðherra'),(257,25,563,'1978-09-01 00:00:00','1979-10-15 00:00:00','Viðskiptaráðherra'),(258,25,554,'1978-09-01 00:00:00','1979-10-15 00:00:00','Landbúnaðarráðherra og dóms- og kirkjumálaráðherra'),(259,25,578,'1978-09-01 00:00:00','1979-10-15 00:00:00','Fjármálaráðherra'),(260,24,163,'1974-08-28 00:00:00','1978-09-01 00:00:00','Forsætisráðherra , ráðherra hagstofu íslands og samstarfsráðherra Norðurlandanna'),(261,24,120,'1974-08-28 00:00:00','1978-09-01 00:00:00','Utanríkisráðherra'),(262,24,443,'1974-08-28 00:00:00','1978-09-01 00:00:00','Dóms- og kirkjumálaráðherra og viðskiptaráðherra'),(263,24,212,'1974-08-28 00:00:00','1978-09-01 00:00:00','Iðnaðarráðherra og félagsmálaráðherra'),(264,24,225,'1974-08-28 00:00:00','1978-09-01 00:00:00','Landbúnaðarráðherra og samgönguráðherra'),(265,24,431,'1974-08-28 00:00:00','1978-09-01 00:00:00','Fjármálaráðherra'),(266,24,588,'1974-08-28 00:00:00','1978-09-01 00:00:00','Menntamálaráðherra'),(267,24,430,'1974-08-28 00:00:00','1978-09-01 00:00:00','Sjávarútvegsráðherra'),(268,23,443,'1971-07-14 00:00:00','1974-08-28 00:00:00','Forsætisráðherra og dóms- og kirkjumálaráðherra'),(269,23,120,'1971-07-14 00:00:00','1974-08-28 00:00:00','Utanríkisráðherra'),(270,23,225,'1971-07-14 00:00:00','1974-08-28 00:00:00','Fjármálaráðherra og landbúnaðarráðherra'),(271,23,236,'1971-07-14 00:00:00','1973-07-16 00:00:00','Félagsmálaráðherra og samgönguráðherra'),(272,23,408,'1971-07-14 00:00:00','1974-08-28 00:00:00','Sjávarútvegsráðherra og viðskiptaráðherra'),(273,23,419,'1971-07-14 00:00:00','1974-08-28 00:00:00','Heilbrigrðisráðherra og iðnaðarráðherra'),(274,23,422,'1971-07-14 00:00:00','1974-08-28 00:00:00','Menntamálaráðherra og ráðherra Hagstofu Íslands'),(275,23,84,'1973-07-16 00:00:00','1974-05-06 00:00:00','Félagsmálaráðherra og samgönguráðherra'),(276,23,422,'1974-05-06 00:00:00','1974-08-28 00:00:00','Félagsmálaráðherra og samgönguráðherra'),(277,22,284,'1970-07-10 00:00:00','1971-07-14 00:00:00','Forsætisráðherra og iðnaðarráðherra'),(278,22,142,'1970-07-10 00:00:00','1971-07-14 00:00:00','Utanríkisráðherra og félagsmálaráðherra'),(279,22,219,'1970-07-10 00:00:00','1971-07-14 00:00:00','Menntamálaráðherra og viðskiptaráðherra'),(280,22,269,'1970-07-10 00:00:00','1971-07-14 00:00:00','Landbúnaðarráðherra og samgönguráðherra'),(281,22,418,'1970-07-10 00:00:00','1971-07-14 00:00:00','Fjármálaráðherra og ráðherra Hagstofu Ísl'),(282,22,115,'1970-07-10 00:00:00','1971-07-14 00:00:00','Sjávarútvegsráðherra og heilbrigðis- og tryggingarráðherra'),(283,22,25,'1970-10-10 00:00:00','1971-07-14 00:00:00','Dóms- og kirkjumálaráðherra'),(284,22,284,'1970-07-10 00:00:00','1970-10-10 00:00:00','Dóms- og kirkjumálaráðherra'),(285,21,64,'1963-11-14 00:00:00','1970-07-10 00:00:00','Forsætisráðherra'),(286,21,189,'1963-11-14 00:00:00','1965-08-31 00:00:00','Utanríkisráðherra'),(287,21,142,'1963-11-14 00:00:00','1965-08-31 00:00:00','Sjávarútvegsráðherra'),(288,21,212,'1963-11-14 00:00:00','1965-05-08 00:00:00','Fjármálaráðherra'),(289,21,219,'1963-11-14 00:00:00','1970-07-10 00:00:00','Menntamálaráðherra og viðskiptaráðherra'),(290,21,269,'1963-11-14 00:00:00','1970-07-10 00:00:00','Samgönguráðherra'),(291,21,284,'1963-11-14 00:00:00','1970-07-10 00:00:00','Dóms- og kirkjumálaráðherra og iðnaðarráðherra'),(292,21,418,'1965-05-08 00:00:00','1970-07-10 00:00:00','Fjármálaráðherra'),(293,21,418,'1970-01-01 00:00:00','1970-07-10 00:00:00','Ráðherra Hagstofu Íslands'),(294,21,142,'1970-01-01 00:00:00','1970-07-10 00:00:00','Félagsmálaráðherra '),(295,21,142,'1965-08-31 00:00:00','1970-07-10 00:00:00','Utanríkisráðherra'),(296,21,115,'1965-08-31 00:00:00','1970-07-10 00:00:00','Sjávarútvegsráðherra'),(297,21,115,'1965-05-08 00:00:00','1969-12-31 00:00:00','Félagsmálaráðherra'),(298,21,284,'1963-11-14 00:00:00','1970-01-01 00:00:00','Heilbrigðisráðherra'),(299,21,115,'1970-01-01 00:00:00','1970-07-10 00:00:00','Heilbrigðis- og tryggingarmálaráðherra'),(300,20,452,'1959-11-20 00:00:00','1962-01-01 00:00:00','Forsætisráðherra'),(301,20,189,'1959-11-20 00:00:00','1963-11-14 00:00:00','Utanríkisráðherra'),(302,20,64,'1959-11-20 00:00:00','1961-09-14 00:00:00','Dóms- og kirkjumálaráðherra ,Heilbrigðis og iðnaðarmálaráðherra'),(303,20,142,'1959-11-20 00:00:00','1963-11-14 00:00:00','Sjávarútvegsráðherra og félagsmálaráðherra'),(304,20,212,'1959-11-20 00:00:00','1963-11-14 00:00:00','Fjármálaráðherra'),(305,20,219,'1959-11-20 00:00:00','1963-11-14 00:00:00','Menntamálaráðherra og viðskiptaráðherra'),(306,20,269,'1959-11-20 00:00:00','1963-11-14 00:00:00','Landbúnaðarráðherra og samgönguráðherra'),(307,20,64,'1961-09-14 00:00:00','1961-12-31 00:00:00','Dóms- og kirkjumálaráðherra ,Heilbrigðis og iðnaðarmálaráðherra'),(308,20,64,'1961-09-14 00:00:00','1961-12-31 00:00:00','Forsætisráðherra'),(309,20,284,'1961-12-31 00:00:00','1963-11-14 00:00:00','Dóms- og kirkjumálaráðherra ,Heilbrigðis og iðnaðarmálaráðherra'),(310,20,452,'1961-12-31 00:00:00','1963-11-14 00:00:00','Forsætisráðherra'),(311,19,142,'1958-12-23 00:00:00','1959-11-20 00:00:00','Forsætisráðherra , samgönguráðherra og sjávarútvegsráðherra'),(312,19,189,'1958-12-23 00:00:00','1959-11-20 00:00:00','Utanríkisráðherra og fjármálaráðherra'),(313,19,154,'1958-12-23 00:00:00','1959-11-20 00:00:00','Dómsmálaráðherra , landbúnaðarráðherra og félagsmálaráðherra'),(314,19,219,'1958-12-23 00:00:00','1959-11-20 00:00:00','Menntamálráðherra , iðnaðarmálaráðherra og viðskiptaráðherra'),(315,18,249,'1956-07-24 00:00:00','1958-12-23 00:00:00','Forsætisráðherra , landbúnaðarráðherra og dómsmálaráðherra'),(316,18,189,'1956-07-24 00:00:00','1956-08-03 00:00:00','Utanríkisráðherra'),(317,18,148,'1956-07-24 00:00:00','1958-12-23 00:00:00','Fjármálaráðherra'),(318,18,219,'1956-07-24 00:00:00','1958-12-23 00:00:00','Menntamálaræapherra og iðnaðarráðherra'),(319,18,236,'1956-07-24 00:00:00','1958-12-23 00:00:00','Félagsmálaráðherra'),(320,18,408,'1956-07-24 00:00:00','1958-12-23 00:00:00','Sjávarútvegsráðherra og viiðskiptaráðherra'),(321,18,142,'1956-08-03 00:00:00','1956-10-17 00:00:00','Utanríkisráðherra'),(322,18,189,'1956-10-17 00:00:00','1958-12-23 00:00:00','Utanríkisráðherra'),(323,17,452,'1953-09-11 00:00:00','0000-00-00 00:00:00','Forsætisráðherra og atvinnumálaráðherra'),(324,17,874,'1953-09-11 00:00:00','0000-00-00 00:00:00','Utanríkisráðherra'),(325,17,64,'1953-09-11 00:00:00','0000-00-00 00:00:00','Dómsmálaráðherra og menntamálaráðherra'),(326,17,148,'1953-09-11 00:00:00','1954-04-14 00:00:00','Fjármálaráðherra'),(327,17,269,'1953-09-11 00:00:00','0000-00-00 00:00:00','Viðskiptaráðherra'),(328,17,558,'1953-09-11 00:00:00','0000-00-00 00:00:00','Landbúnaðarráðherra og félagsmálaráðherra'),(329,17,532,'1954-04-14 00:00:00','1954-09-08 00:00:00','Fjármálaráðherra'),(330,17,148,'1954-09-08 00:00:00','0000-00-00 00:00:00','Fjármálaráðherra'),(331,16,558,'1950-03-14 00:00:00','1953-09-11 00:00:00','Forsætisráðherra og félagsmálaráðherra'),(332,16,64,'1950-03-14 00:00:00','1953-09-11 00:00:00','Utanríkisráðherra og dómsmálaráðherra'),(333,16,88,'1950-03-14 00:00:00','1953-09-11 00:00:00','Menntamálaráðherra og viðskiptaráðherra'),(334,16,148,'1950-03-14 00:00:00','1953-09-11 00:00:00','Fjármálaráðherra'),(335,16,249,'1950-03-14 00:00:00','1953-09-11 00:00:00','Landbúnaðarráðherra'),(336,16,452,'1950-03-14 00:00:00','1953-09-11 00:00:00','Atvinnumálaráðherra'),(337,15,452,'1989-12-06 00:00:00','1950-03-14 00:00:00','Forsætisráðherra og félagsmálaráðherra'),(338,15,64,'1989-12-06 00:00:00','1950-03-14 00:00:00','Utanríkisráðherra , dómsmálaráðherra og menntamálaráðherra'),(339,15,88,'1989-12-06 00:00:00','1950-03-14 00:00:00','Fjármálaráðherra og viðskiptaráðherra'),(340,15,285,'1989-12-06 00:00:00','1950-03-14 00:00:00','Atvinnumálaráðherra'),(341,15,330,'1989-12-06 00:00:00','1950-03-14 00:00:00','Landbúnaðarráðherra'),(342,14,548,'1947-02-04 00:00:00','1949-12-06 00:00:00','Forsætisráðherra og félagsmálaráðherra'),(343,14,64,'1947-02-04 00:00:00','1949-12-06 00:00:00','Utanríkisráðherra og dómsmálaráðherra'),(344,14,63,'1947-02-04 00:00:00','1949-12-06 00:00:00','Landbúnaðarráðherra'),(345,14,142,'1947-02-04 00:00:00','1949-12-06 00:00:00','Viðskiptaráðherra ,Iðnaðarráðherra og samgönguráðherra'),(346,14,148,'1947-02-04 00:00:00','1949-12-06 00:00:00','Menntamálaráðherra , kirkjumálaráðherra og flugmálaráðherra'),(347,14,285,'1947-02-04 00:00:00','1949-12-06 00:00:00','Fjármálaráðherra og sjávarútvegsráðherra'),(348,13,452,'1944-10-21 00:00:00','1947-02-04 00:00:00','Forsætisráðherra og utanríkisráðherra'),(349,13,32,'1944-10-21 00:00:00','1947-02-04 00:00:00','Atvinnumálaráðherra'),(350,13,100,'1944-10-21 00:00:00','1947-02-04 00:00:00','Menntamálaráðherra'),(351,13,142,'1944-10-21 00:00:00','1947-02-04 00:00:00','Samgönguráðherra'),(352,13,151,'1944-10-21 00:00:00','1947-02-04 00:00:00','Félagsmálaráðherra og dómsmálaráðherra'),(353,13,482,'1944-10-21 00:00:00','1947-02-04 00:00:00','Fjármálaráðherra , viðskiptaráðherra og landbúnaðarráðherra');
/*!40000 ALTER TABLE `Cabinet_has_Person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Commitee`
--

DROP TABLE IF EXISTS `Commitee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Commitee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `short_abbr` varchar(45) DEFAULT NULL,
  `long_abbr` varchar(45) DEFAULT NULL,
  `first_assembly` int(11) DEFAULT NULL,
  `last_assembly` int(11) DEFAULT NULL,
  `dirty` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Commitee`
--

LOCK TABLES `Commitee` WRITE;
/*!40000 ALTER TABLE `Commitee` DISABLE KEYS */;
INSERT INTO `Commitee` VALUES (78,'heilbrigðis- og trygginganefnd','ht','heilbr.- og trn.',93,134,NULL),(79,'umhverfisnefnd','um','umhvn.',114,139,NULL),(124,'iðnaðarnefnd','i','iðnn.',46,139,NULL),(125,'landbúnaðarnefnd','l','landbn.',27,134,NULL),(126,'samvinnunefnd samgöngumála','samvsg','samvn. samgm.',27,113,NULL),(128,'þingskapanefnd','þsk','þingskn.',106,107,NULL),(129,'samgöngunefnd','sg','samgn.',20,139,NULL),(130,'sjávarútvegsnefnd','sj','sjútvn.',27,134,NULL),(131,'forsætisnefnd','forsn','forsætisn.',1,NULL,NULL),(132,'Íslandsdeild Alþjóðaþingmannasambandsins','Aþing','ÍAÞ',1,NULL,NULL),(133,'Íslandsdeild þingmannanefndar EFTA','Efta','ÞEFTA',1,139,NULL),(134,'Íslandsdeild Evrópuráðsþingsins','Evr','ÍÞER',1,NULL,NULL),(135,'kosningalaganefnd','kosn','kosningalagan.',107,109,NULL),(136,'Íslandsdeild Norður-Atlantshafsþingsins','NAA','ÍÞNAA',1,123,NULL),(137,'Íslandsdeild Norðurlandaráðs','Norl','ÍNR',1,NULL,NULL),(139,'Íslandsdeild þings Öryggis- og samvinnustofnunar Evrópu','Öse','ÍÖSE',119,NULL,NULL),(140,'Íslandsdeild Vestnorræna ráðsins','Vnorþ','ÍVN',1,NULL,NULL),(141,'Íslandsdeild Vestur-Evrópusambandsins','Ves','VES',1,NULL,NULL),(142,'Íslandsdeild þingmannaráðstefnunnar um norðurskautsmál','Nsm','ÍNSM',1,NULL,NULL),(143,'sérnefnd','sn','sérn.',1,NULL,NULL),(145,'þingfarakaupsnefnd','þfkn.','þingfarakaupsn.',27,103,NULL),(146,'atvinnumálanefnd','atv.','atvmn.',93,113,NULL),(147,'Íslandsdeild NATO-þingsins','NATO','ÍNATO',124,NULL,NULL),(148,'utanríkismálanefnd','ut','utanrmn.',40,NULL,NULL),(149,'kjörbréfanefnd','k','kjörbn.',26,NULL,NULL),(150,'fjárlaganefnd','fl','fjárln.',114,139,NULL),(151,'allsherjarnefnd','a','allshn.',27,139,NULL),(152,'menntamálanefnd','m','menntmn.',27,139,NULL),(153,'efnahags- og viðskiptanefnd','ev','efh.- og viðskn.',114,134,NULL),(154,'félagsmálanefnd','fél','félmn.',93,134,NULL),(155,'heilbrigðis- og félagsmálanefnd','hf','heilbr.- og félmn.',62,92,NULL),(156,'fjárhagsnefnd','fh','fjhn.',27,92,NULL),(157,'fjárveitinganefnd','fv','fjvn.',27,113,NULL),(160,'sérnefnd um stjórnarskrármál','stj','stjórnarskrárn.',1,139,NULL),(161,'kreppunefnd','kr','kreppn.',46,46,NULL),(162,'Ríkisgjaldanefnd','rgjn','rikisgjn.',45,45,NULL),(163,'Bankamálanefnd','bmn','bankamn.',42,42,NULL),(164,'fjárhags- og viðskiptanefnd','fjv','fjh.- og viðskn.',93,113,NULL),(165,'samgöngumálanefnd','sgm','samgmn.',27,92,NULL),(166,'efnahags- og skattanefnd','es','efh.- og skattn.',134,139,NULL),(167,'viðskiptanefnd','v','viðskn.',134,139,NULL),(168,'félags- og tryggingamálanefnd','ft','fél.- og trn.',134,139,NULL),(169,'heilbrigðisnefnd','h','heilbrn.',134,139,NULL),(170,'sjávarútvegs- og landbúnaðarnefnd','sl','sjútv.- og landbn.',134,139,NULL),(176,'sérnefnd um stjórnarskrármál (385. mál á 136. þingi)','stj136','stjórnarskrárn. s.',136,136,NULL),(190,'fjárhagsnefnd','ev','fjhn.',1,113,NULL),(191,'fjárveitinganefnd','fl','fjvn.',1,113,NULL),(192,'starfshópur utanríkismálanefndar um Evrópumál','sthevr','starfshevr.',138,NULL,NULL),(193,'þingmannanefnd til að fjalla um skýrslu rannsóknarnefndar Alþingis','b','þingmn. um skýrslu RNA',138,138,NULL),(194,'saksóknarnefnd','saksn','saksóknarn.',139,140,NULL),(195,'Þingmannanefnd Íslands og Evrópusambandsins af hálfu Alþingis','ie','þingmn. Ísl. og ESB',139,NULL,NULL),(198,'efnahags- og skattanefnd, fjárlaganefnd og viðskiptanefnd','esfv','esfv',139,139,NULL),(199,'þingskapanefnd','þsk','þingskn.',139,142,NULL),(200,'Íslandsdeild þingmannanefnda EFTA og EES','Efta','ÞEFTA',140,NULL,NULL),(201,'allsherjar- og menntamálanefnd','am','allsh.- og menntmn.',140,NULL,NULL),(202,'efnahags- og viðskiptanefnd','ev','efh.- og viðskn.',140,NULL,NULL),(203,'atvinnuveganefnd','av','atvinnuvn.',140,NULL,NULL),(204,'umhverfis- og samgöngunefnd','us','um.- og samgn.',140,NULL,NULL),(205,'velferðarnefnd','vf','velfn.',140,NULL,NULL),(206,'stjórnskipunar- og eftirlitsnefnd','se','stjórnsk.- og eftirln.',140,NULL,NULL),(207,'fjárlaganefnd','fl','fjárln.',140,NULL,NULL),(216,'þingskapanefnd','þsk','þingskn.',143,NULL,NULL),(221,'sérnefnd','24_94','sérn.',24,24,NULL);
/*!40000 ALTER TABLE `Commitee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Commitee_has_Person`
--

DROP TABLE IF EXISTS `Commitee_has_Person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Commitee_has_Person` (
  `commitee_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `row` int(11) DEFAULT NULL,
  `from` datetime NOT NULL,
  `to` datetime DEFAULT NULL,
  `assembly_id` int(10) unsigned NOT NULL,
  `party` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`commitee_id`,`person_id`,`assembly_id`,`title`,`from`),
  KEY `fk_Commitee_has_Person_Person1_idx` (`person_id`),
  KEY `fk_Commitee_has_Person_Commitee1_idx` (`commitee_id`),
  KEY `fk_Commitee_has_Person_Assembly1_idx` (`assembly_id`),
  KEY `uq_Commitee_has_Person_Assembly1_title` (`title`),
  KEY `fk_Commitee_has_Person_Party1_idx` (`party`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Commitee_has_Person`
--

LOCK TABLES `Commitee_has_Person` WRITE;
/*!40000 ALTER TABLE `Commitee_has_Person` DISABLE KEYS */;
/*!40000 ALTER TABLE `Commitee_has_Person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Interests`
--

DROP TABLE IF EXISTS `Interests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Interests` (
  `person_id` int(10) unsigned NOT NULL,
  `salariedBoard` text,
  `paidEmployment` text,
  `incomeGeneratingActivities` text,
  `financialSupport` text,
  `gifts` text,
  `trips` text,
  `debtReduction` text,
  `realEstate` text,
  `assets` text,
  `formerEmployer` text,
  `futureEmployer` text,
  `trust` text,
  `logged` date DEFAULT NULL,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Interests`
--

LOCK TABLES `Interests` WRITE;
/*!40000 ALTER TABLE `Interests` DISABLE KEYS */;
/*!40000 ALTER TABLE `Interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Issue`
--

DROP TABLE IF EXISTS `Issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Issue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `issue_id` int(10) unsigned NOT NULL,
  `assembly_id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `type_name` varchar(45) DEFAULT NULL,
  `tag` varchar(45) DEFAULT NULL,
  `issue_analysis` varchar(1000) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Issue_Assembly1_idx` (`assembly_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Issue`
--

LOCK TABLES `Issue` WRITE;
/*!40000 ALTER TABLE `Issue` DISABLE KEYS */;
/*!40000 ALTER TABLE `Issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IssueDocument`
--

DROP TABLE IF EXISTS `IssueDocument`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IssueDocument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_id` int(10) unsigned NOT NULL,
  `date` datetime DEFAULT NULL,
  `document_number` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `html` varchar(255) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `issue_number` int(11) DEFAULT NULL,
  `assembly_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_IssueDocument_Issue1_idx` (`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IssueDocument`
--

LOCK TABLES `IssueDocument` WRITE;
/*!40000 ALTER TABLE `IssueDocument` DISABLE KEYS */;
/*!40000 ALTER TABLE `IssueDocument` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Meeting`
--

DROP TABLE IF EXISTS `Meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Meeting` (
  `assembly_number` int(11) NOT NULL,
  `meeting_number` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `starts` datetime DEFAULT NULL,
  `starts_epoch` int(11) DEFAULT NULL,
  `ends` datetime DEFAULT NULL,
  `ends_epoch` int(11) DEFAULT NULL,
  `seating` varchar(255) DEFAULT NULL,
  `document_xml` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`assembly_number`,`meeting_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Meeting`
--

LOCK TABLES `Meeting` WRITE;
/*!40000 ALTER TABLE `Meeting` DISABLE KEYS */;
/*!40000 ALTER TABLE `Meeting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Party`
--

DROP TABLE IF EXISTS `Party`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Party` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `logo` text,
  `color` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Party`
--

LOCK TABLES `Party` WRITE;
/*!40000 ALTER TABLE `Party` DISABLE KEYS */;
INSERT INTO `Party` VALUES (1,'Samfylkingin',NULL,NULL,NULL),(2,'Sjálfstæðisflokkur',NULL,NULL,NULL);
/*!40000 ALTER TABLE `Party` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Person`
--

DROP TABLE IF EXISTS `Person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '	',
  `abbr` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `blogg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Person`
--

LOCK TABLES `Person` WRITE;
/*!40000 ALTER TABLE `Person` DISABLE KEYS */;
/*!40000 ALTER TABLE `Person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Person_has_Vote`
--

DROP TABLE IF EXISTS `Person_has_Vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Person_has_Vote` (
  `vote_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `vote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`vote_id`,`person_id`),
  KEY `fk_Vote_has_Person_Person1_idx` (`person_id`),
  KEY `fk_Vote_has_Person_Vote1_idx` (`vote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Person_has_Vote`
--

LOCK TABLES `Person_has_Vote` WRITE;
/*!40000 ALTER TABLE `Person_has_Vote` DISABLE KEYS */;
/*!40000 ALTER TABLE `Person_has_Vote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Review`
--

DROP TABLE IF EXISTS `Review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diary_number` int(11) DEFAULT NULL,
  `sender` varchar(1000) DEFAULT NULL,
  `commitee` varchar(255) DEFAULT NULL,
  `commitee_id` int(11) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `arrival_date_epoch` int(11) DEFAULT NULL,
  `send_date` date DEFAULT NULL,
  `send_date_epoch` int(11) DEFAULT NULL,
  `review_type` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `issue_number` int(11) DEFAULT NULL,
  `assembly_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Review`
--

LOCK TABLES `Review` WRITE;
/*!40000 ALTER TABLE `Review` DISABLE KEYS */;
/*!40000 ALTER TABLE `Review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReviewRequest`
--

DROP TABLE IF EXISTS `ReviewRequest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ReviewRequest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_request_number` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date_epoch` int(11) DEFAULT NULL,
  `reciever` varchar(1000) DEFAULT NULL,
  `commitee` varchar(255) DEFAULT NULL,
  `commitee_id` int(11) DEFAULT NULL,
  `diary_number` int(11) DEFAULT NULL,
  `issue_number` int(11) DEFAULT NULL,
  `assembly_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReviewRequest`
--

LOCK TABLES `ReviewRequest` WRITE;
/*!40000 ALTER TABLE `ReviewRequest` DISABLE KEYS */;
/*!40000 ALTER TABLE `ReviewRequest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Speech`
--

DROP TABLE IF EXISTS `Speech`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Speech` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `person_type` varchar(255) DEFAULT NULL,
  `from` datetime DEFAULT NULL,
  `from_epoch` int(11) DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `to_epoch` int(11) DEFAULT NULL,
  `speech_length` int(11) DEFAULT NULL,
  `speech_type` varchar(255) DEFAULT NULL,
  `iteration` varchar(45) DEFAULT NULL,
  `assembly_number` int(11) DEFAULT NULL,
  `meeting` int(11) DEFAULT NULL,
  `speech_xml` varchar(255) DEFAULT NULL,
  `speech_html` varchar(255) DEFAULT NULL,
  `party_id` int(11) DEFAULT NULL,
  `party` varchar(255) DEFAULT NULL,
  `foreperson` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Speech`
--

LOCK TABLES `Speech` WRITE;
/*!40000 ALTER TABLE `Speech` DISABLE KEYS */;
/*!40000 ALTER TABLE `Speech` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Vote`
--

DROP TABLE IF EXISTS `Vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Issue_id` int(10) unsigned NOT NULL,
  `time` datetime DEFAULT NULL,
  `time_epoch` int(11) DEFAULT NULL,
  `progress_type` varchar(255) DEFAULT NULL,
  `vote_type` varchar(255) DEFAULT NULL,
  `more` varchar(255) DEFAULT NULL,
  `commitee_id` int(10) unsigned DEFAULT NULL,
  `commitee` varchar(100) DEFAULT NULL,
  `yes` int(11) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `abstrained` int(11) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `assembly_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Vote_Issue1_idx` (`Issue_id`),
  KEY `fk_Vote_Commitee1_idx` (`commitee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vote`
--

LOCK TABLES `Vote` WRITE;
/*!40000 ALTER TABLE `Vote` DISABLE KEYS */;
/*!40000 ALTER TABLE `Vote` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-04 17:21:48
