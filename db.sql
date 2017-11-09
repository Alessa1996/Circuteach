-- MySQL dump 10.13  Distrib 5.7.17, for osx10.12 (x86_64)
--
-- Host: localhost    Database: videos
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `ac_asig`
--

DROP TABLE IF EXISTS `ac_asig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_asig` (
  `asi_cont` int(11) NOT NULL AUTO_INCREMENT,
  `asi_code` varchar(100) NOT NULL,
  `asi_desc` varchar(100) NOT NULL,
  `asi_esta` varchar(100) NOT NULL,
  PRIMARY KEY (`asi_cont`),
  UNIQUE KEY `asi_code_UNIQUE` (`asi_code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_asig`
--

LOCK TABLES `ac_asig` WRITE;
/*!40000 ALTER TABLE `ac_asig` DISABLE KEYS */;
INSERT INTO `ac_asig` VALUES (1,'1234mate','matematicas','1'),(2,'esp0675','español','1');
/*!40000 ALTER TABLE `ac_asig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_cate`
--

DROP TABLE IF EXISTS `ac_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_cate` (
  `cat_cont` int(11) NOT NULL AUTO_INCREMENT,
  `asi_cont` int(11) NOT NULL,
  `doc_cont` int(11) NOT NULL,
  `cat_esta` tinyint(1) NOT NULL,
  `nac_cont` int(11) NOT NULL,
  PRIMARY KEY (`cat_cont`),
  KEY `fk_ac_cate_ac_asig1_idx` (`asi_cont`),
  KEY `fk_ac_cate_gn_doce1_idx` (`doc_cont`),
  KEY `nivel academico` (`nac_cont`),
  CONSTRAINT `fk_ac_cate_ac_asig1` FOREIGN KEY (`asi_cont`) REFERENCES `ac_asig` (`asi_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ac_cate_gn_doce1` FOREIGN KEY (`doc_cont`) REFERENCES `gn_doce` (`doc_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nivel_academico` FOREIGN KEY (`nac_cont`) REFERENCES `gn_naca` (`nac_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_cate`
--

LOCK TABLES `ac_cate` WRITE;
/*!40000 ALTER TABLE `ac_cate` DISABLE KEYS */;
INSERT INTO `ac_cate` VALUES (1,1,1,1,10),(2,2,2,1,9),(3,1,2,1,7);
/*!40000 ALTER TABLE `ac_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_curs`
--

DROP TABLE IF EXISTS `ac_curs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_curs` (
  `cur_cont` int(11) NOT NULL AUTO_INCREMENT,
  `cat_cont` int(11) NOT NULL,
  `cur_desc` varchar(45) NOT NULL,
  `cur_fini` date NOT NULL,
  `cur_fina` date NOT NULL,
  `cur_esta` tinyint(1) NOT NULL,
  `cur_obge` varchar(200) DEFAULT NULL,
  `cur_obes` text,
  PRIMARY KEY (`cur_cont`),
  KEY `fk_ac_curs_ac_cate1_idx` (`cat_cont`),
  CONSTRAINT `fk_ac_curs_ac_cate1` FOREIGN KEY (`cat_cont`) REFERENCES `ac_cate` (`cat_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_curs`
--

LOCK TABLES `ac_curs` WRITE;
/*!40000 ALTER TABLE `ac_curs` DISABLE KEYS */;
INSERT INTO `ac_curs` VALUES (1,1,'factorizacion','2017-10-06','2017-10-31',1,'aprender los casos de factorizacion','- primer caso de factorizacion\r\n- segundo caso de factorizacion'),(2,3,'fraccionarios','2017-11-01','2017-11-30',1,NULL,NULL);
/*!40000 ALTER TABLE `ac_curs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_acti`
--

DROP TABLE IF EXISTS `cu_acti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_acti` (
  `act_cont` int(11) NOT NULL AUTO_INCREMENT,
  `act_titu` varchar(45) NOT NULL,
  `act_desc` text,
  `cur_cont` int(11) NOT NULL,
  `act_vid` varchar(200) DEFAULT NULL,
  `act_file` varchar(200) DEFAULT NULL,
  `act_fini` datetime NOT NULL,
  `act_fina` datetime NOT NULL,
  `act_vali` int(11) DEFAULT '0',
  `act_img` varchar(255) DEFAULT NULL,
  `act_fec` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`act_cont`),
  KEY `fk_cu_acti_ac_curs1_idx` (`cur_cont`),
  CONSTRAINT `fk_cu_acti_ac_curs1` FOREIGN KEY (`cur_cont`) REFERENCES `ac_curs` (`cur_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_acti`
--

LOCK TABLES `cu_acti` WRITE;
/*!40000 ALTER TABLE `cu_acti` DISABLE KEYS */;
INSERT INTO `cu_acti` VALUES (1,'prueba','adsad',1,'356a192b7913b04c54574d18c28d46e6395428ab.mp4','356a192b7913b04c54574d18c28d46e6395428ab.docx','2017-10-20 00:01:00','2017-10-20 23:59:00',3,'356a192b7913b04c54574d18c28d46e6395428ab.png','2017-10-20 00:01:00');
/*!40000 ALTER TABLE `cu_acti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_arti`
--

DROP TABLE IF EXISTS `cu_arti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_arti` (
  `art_cont` int(11) NOT NULL AUTO_INCREMENT,
  `art_titu` varchar(100) NOT NULL,
  `art_desc` text NOT NULL,
  `art_fec` datetime DEFAULT CURRENT_TIMESTAMP,
  `art_vid` varchar(200) DEFAULT NULL,
  `art_file` varchar(200) DEFAULT NULL,
  `art_img` varchar(255) DEFAULT NULL,
  `ter_cont` int(11) NOT NULL,
  PRIMARY KEY (`art_cont`),
  KEY `fk_cu_arti_gn_terc1_idx` (`ter_cont`),
  CONSTRAINT `fk_cu_arti_gn_terc1` FOREIGN KEY (`ter_cont`) REFERENCES `gn_terc` (`ter_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_arti`
--

LOCK TABLES `cu_arti` WRITE;
/*!40000 ALTER TABLE `cu_arti` DISABLE KEYS */;
INSERT INTO `cu_arti` VALUES (1,'prueba','descripcion de prueba','2017-10-21 23:38:04','356a192b7913b04c54574d18c28d46e6395428ab.mp4','356a192b7913b04c54574d18c28d46e6395428ab.zip','356a192b7913b04c54574d18c28d46e6395428ab.png',1),(2,'articulo de prueba 2','articulo de prueba 2\r\n\r\narticulo de prueba 2\r\n\r\narticulo de prueba 2','2017-10-31 09:33:42','da4b9237bacccdf19c0760cab7aec4a8359010b0.mp4',NULL,NULL,2),(3,'articulo de prueba 3','articulo de prueba 3\r\n\r\narticulo de prueba 3\r\n\r\narticulo de prueba 3','2017-10-31 09:34:15','77de68daecd823babbb58edb1c8e14d7106e83bb.mp4',NULL,NULL,2),(4,'articulo de prueba 4','articulo de prueba 4articulo de prueba 4\r\n\r\narticulo de prueba 4articulo de prueba 4\r\n\r\narticulo de prueba 4articulo de prueba 4','2017-10-31 09:34:32','1b6453892473a467d07372d45eb05abc2031647a.mp4',NULL,NULL,2);
/*!40000 ALTER TABLE `cu_arti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_asis`
--

DROP TABLE IF EXISTS `cu_asis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_asis` (
  `ast_cont` int(11) NOT NULL AUTO_INCREMENT,
  `ast_fec` datetime NOT NULL,
  `act_cont` int(11) NOT NULL,
  `mat_cont` int(11) NOT NULL,
  PRIMARY KEY (`ast_cont`),
  KEY `fk_cu_asis_cu_acti1_idx` (`act_cont`),
  KEY `fk_cu_asis_cu_matri1_idx` (`mat_cont`),
  CONSTRAINT `fk_cu_asis_cu_acti1` FOREIGN KEY (`act_cont`) REFERENCES `cu_acti` (`act_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cu_asis_cu_matri1` FOREIGN KEY (`mat_cont`) REFERENCES `cu_matri` (`mat_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_asis`
--

LOCK TABLES `cu_asis` WRITE;
/*!40000 ALTER TABLE `cu_asis` DISABLE KEYS */;
/*!40000 ALTER TABLE `cu_asis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_entr`
--

DROP TABLE IF EXISTS `cu_entr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_entr` (
  `ent_cont` int(11) NOT NULL AUTO_INCREMENT,
  `ent_titu` varchar(45) NOT NULL,
  `ent_desc` text,
  `ent_vid` varchar(200) DEFAULT NULL,
  `ent_file` varchar(200) DEFAULT NULL,
  `ent_fec` datetime DEFAULT CURRENT_TIMESTAMP,
  `ent_cali` double DEFAULT NULL,
  `act_cont` int(11) NOT NULL,
  `mat_cont` int(11) NOT NULL,
  `ent_ult` datetime DEFAULT NULL,
  `ent_entr` int(11) DEFAULT '1',
  `ent_obser` text,
  `ent_feca` datetime DEFAULT NULL,
  `ent_img` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ent_cont`),
  KEY `fk_cu_entr_cu_acti1_idx` (`act_cont`),
  KEY `fk_cu_entr_cu_matri1_idx` (`mat_cont`),
  CONSTRAINT `fk_cu_entr_cu_acti1` FOREIGN KEY (`act_cont`) REFERENCES `cu_acti` (`act_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cu_entr_cu_matri1` FOREIGN KEY (`mat_cont`) REFERENCES `cu_matri` (`mat_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_entr`
--

LOCK TABLES `cu_entr` WRITE;
/*!40000 ALTER TABLE `cu_entr` DISABLE KEYS */;
INSERT INTO `cu_entr` VALUES (1,'entrega de prueba para actividad1','entrega de prueba para actividad1entrega de prueba para actividad1\r\n\r\nentrega de prueba para actividad1entrega de prueba para actividad1',NULL,'356a192b7913b04c54574d18c28d46e6395428ab.docx','2017-10-27 17:04:51',3.5,1,1,'2017-10-27 22:58:24',3,NULL,'2017-10-31 22:44:59','356a192b7913b04c54574d18c28d46e6395428ab.png');
/*!40000 ALTER TABLE `cu_entr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_matri`
--

DROP TABLE IF EXISTS `cu_matri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_matri` (
  `mat_cont` int(11) NOT NULL AUTO_INCREMENT,
  `cur_cont` int(11) NOT NULL,
  `est_cont` int(11) NOT NULL,
  `mat_esta` tinyint(1) NOT NULL,
  PRIMARY KEY (`mat_cont`),
  KEY `fk_cu_matri_ac_curs1_idx` (`cur_cont`),
  KEY `fk_cu_matri_gn_estu1_idx` (`est_cont`),
  CONSTRAINT `fk_cu_matri_ac_curs1` FOREIGN KEY (`cur_cont`) REFERENCES `ac_curs` (`cur_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cu_matri_gn_estu1` FOREIGN KEY (`est_cont`) REFERENCES `gn_estu` (`est_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_matri`
--

LOCK TABLES `cu_matri` WRITE;
/*!40000 ALTER TABLE `cu_matri` DISABLE KEYS */;
INSERT INTO `cu_matri` VALUES (1,1,2,1);
/*!40000 ALTER TABLE `cu_matri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gn_admi`
--

DROP TABLE IF EXISTS `gn_admi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gn_admi` (
  `adm_cont` int(11) NOT NULL AUTO_INCREMENT,
  `adm_usu` varchar(45) NOT NULL,
  `adm_pass` varchar(255) NOT NULL,
  `adm_esta` tinyint(1) NOT NULL,
  `ter_cont` int(11) NOT NULL,
  `adm_oln` tinyint(1) NOT NULL,
  PRIMARY KEY (`adm_cont`),
  UNIQUE KEY `ad_usu_UNIQUE` (`adm_usu`),
  KEY `fk_gn_admi_gn_terc1_idx` (`ter_cont`),
  CONSTRAINT `fk_gn_admi_gn_terc1` FOREIGN KEY (`ter_cont`) REFERENCES `gn_terc` (`ter_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gn_admi`
--

LOCK TABLES `gn_admi` WRITE;
/*!40000 ALTER TABLE `gn_admi` DISABLE KEYS */;
INSERT INTO `gn_admi` VALUES (1,'1070615270','8cb2237d0679ca88db6464eac60da96345513964',1,1,0);
/*!40000 ALTER TABLE `gn_admi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gn_doce`
--

DROP TABLE IF EXISTS `gn_doce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gn_doce` (
  `doc_cont` int(11) NOT NULL AUTO_INCREMENT,
  `doc_usu` varchar(50) NOT NULL,
  `doc_pass` varchar(255) NOT NULL,
  `doc_esta` tinyint(1) NOT NULL,
  `ter_cont` int(11) NOT NULL,
  `doc_oln` tinyint(1) NOT NULL,
  PRIMARY KEY (`doc_cont`),
  KEY `fk_gn_doce_gn_terc1_idx` (`ter_cont`),
  CONSTRAINT `fk_gn_doce_gn_terc1` FOREIGN KEY (`ter_cont`) REFERENCES `gn_terc` (`ter_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gn_doce`
--

LOCK TABLES `gn_doce` WRITE;
/*!40000 ALTER TABLE `gn_doce` DISABLE KEYS */;
INSERT INTO `gn_doce` VALUES (1,'12345','8cb2237d0679ca88db6464eac60da96345513964',1,2,0),(2,'89767685668','8cb2237d0679ca88db6464eac60da96345513964',1,4,0);
/*!40000 ALTER TABLE `gn_doce` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gn_estu`
--

DROP TABLE IF EXISTS `gn_estu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gn_estu` (
  `est_cont` int(11) NOT NULL AUTO_INCREMENT,
  `est_usu` varchar(45) NOT NULL,
  `est_pass` varchar(255) NOT NULL,
  `est_esta` tinyint(1) NOT NULL,
  `ter_cont` int(11) NOT NULL,
  `est_oln` tinyint(1) NOT NULL,
  `nac_cont` int(11) NOT NULL,
  PRIMARY KEY (`est_cont`),
  UNIQUE KEY `est_usu_UNIQUE` (`est_usu`),
  KEY `fk_gn_estu_gn_terc1_idx` (`ter_cont`),
  KEY `fk_gn_estu_gn_naca1_idx` (`nac_cont`),
  CONSTRAINT `fk_gn_estu_gn_naca1` FOREIGN KEY (`nac_cont`) REFERENCES `gn_naca` (`nac_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gn_estu_gn_terc1` FOREIGN KEY (`ter_cont`) REFERENCES `gn_terc` (`ter_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gn_estu`
--

LOCK TABLES `gn_estu` WRITE;
/*!40000 ALTER TABLE `gn_estu` DISABLE KEYS */;
INSERT INTO `gn_estu` VALUES (1,'95010807264','8cb2237d0679ca88db6464eac60da96345513964',1,3,0,10),(2,'9876','8cb2237d0679ca88db6464eac60da96345513964',1,5,0,8);
/*!40000 ALTER TABLE `gn_estu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gn_naca`
--

DROP TABLE IF EXISTS `gn_naca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gn_naca` (
  `nac_cont` int(11) NOT NULL AUTO_INCREMENT,
  `nac_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`nac_cont`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gn_naca`
--

LOCK TABLES `gn_naca` WRITE;
/*!40000 ALTER TABLE `gn_naca` DISABLE KEYS */;
INSERT INTO `gn_naca` VALUES (1,'grado 1o'),(2,'grado 2o'),(3,'grado 3o'),(4,'grado 4o'),(5,'grado 5o'),(6,'grado 6o'),(7,'grado 7o'),(8,'grado 8o'),(9,'grado 9o'),(10,'grado 10o'),(11,'grado 11o');
/*!40000 ALTER TABLE `gn_naca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gn_tdoc`
--

DROP TABLE IF EXISTS `gn_tdoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gn_tdoc` (
  `tdo_cont` int(11) NOT NULL AUTO_INCREMENT,
  `tdo_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`tdo_cont`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gn_tdoc`
--

LOCK TABLES `gn_tdoc` WRITE;
/*!40000 ALTER TABLE `gn_tdoc` DISABLE KEYS */;
INSERT INTO `gn_tdoc` VALUES (1,'cedula de ciudadania'),(2,'cedula de extranjeria'),(3,'tarjeta de identidad');
/*!40000 ALTER TABLE `gn_tdoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gn_terc`
--

DROP TABLE IF EXISTS `gn_terc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gn_terc` (
  `ter_cont` int(11) NOT NULL AUTO_INCREMENT,
  `ter_pnom` varchar(50) NOT NULL,
  `ter_snom` varchar(50) DEFAULT NULL,
  `ter_pape` varchar(50) NOT NULL,
  `ter_sape` varchar(50) NOT NULL,
  `ter_corre` varchar(50) NOT NULL,
  `ter_iden` bigint(20) NOT NULL,
  `ter_tel` bigint(20) NOT NULL,
  `tdo_cont` int(11) NOT NULL,
  `tus_cont` int(11) NOT NULL,
  PRIMARY KEY (`ter_cont`),
  KEY `fk_gn_terc_gn_tdoc1_idx` (`tdo_cont`),
  KEY `fk_gn_terc_gn_tusu1_idx` (`tus_cont`),
  CONSTRAINT `fk_gn_terc_gn_tdoc1` FOREIGN KEY (`tdo_cont`) REFERENCES `gn_tdoc` (`tdo_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gn_terc_gn_tusu1` FOREIGN KEY (`tus_cont`) REFERENCES `gn_tusu` (`tus_cont`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gn_terc`
--

LOCK TABLES `gn_terc` WRITE;
/*!40000 ALTER TABLE `gn_terc` DISABLE KEYS */;
INSERT INTO `gn_terc` VALUES (1,'Maria','Alejandra','Romero','Toro','mrflordeloto@gmail.com',1070620508,3197016358,1,1),(2,'alejandra',NULL,'salazar','martinez','alejandra-salazar@upc.edu.co',12345,987654,1,2),(3,'pnom','snom','pape','sape','corre@correo.com',95010807264,123456789,3,3),(4,'nombre2','nombre23','ape2','ape23','correo2@correo.com',89767685668,97987987,1,2),(5,'prueba2','prueba2','prueba2','prueba2','prueba@prueba.com',9876,3009876574,1,3);
/*!40000 ALTER TABLE `gn_terc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gn_tusu`
--

DROP TABLE IF EXISTS `gn_tusu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gn_tusu` (
  `tus_cont` int(11) NOT NULL AUTO_INCREMENT,
  `tus_desc` varchar(50) NOT NULL,
  PRIMARY KEY (`tus_cont`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gn_tusu`
--

LOCK TABLES `gn_tusu` WRITE;
/*!40000 ALTER TABLE `gn_tusu` DISABLE KEYS */;
INSERT INTO `gn_tusu` VALUES (1,'administrador'),(2,'docente'),(3,'estudiante');
/*!40000 ALTER TABLE `gn_tusu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-31 18:37:14
