-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: pos_atomy
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'HemoHIM',NULL,'2025-11-25 00:00:00',1,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_parent_id` smallint DEFAULT NULL,
  `nama_menu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `font_icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_nama_menu_unique` (`nama_menu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,0,'Setting','fas fa-solid fa-wrench','javascript::',99,'2025-11-24 08:02:06','',NULL,'\r'),(2,1,'Users','fas fa-solid fa-users','users',1,'2025-11-24 08:02:06','',NULL,'\r'),(3,0,'Dashboard','fas fa-solid fa-gauge-simple','javascript::',1,'2025-11-24 07:55:13','',NULL,'\r'),(4,3,'Dashboard V1','fas fa-solid fa-gauge-simple','dashboard_v1',1,'2025-11-24 08:02:06',NULL,NULL,NULL),(5,0,'Master','fas fa-solid fa-gauge-simple','javascript::',2,'2025-11-24 08:02:06',NULL,NULL,NULL),(6,5,'Product','fas fa-solid fa-gauge-simple','products',1,'2025-11-26 03:52:32',NULL,NULL,NULL),(7,0,'Transaction','fas fa-solid fa-gauge-simple','javascript::',3,'2025-11-28 09:53:49',NULL,NULL,NULL),(8,7,'Purchase Order','fas fa-solid fa-gauge-simple','purchase_orders',1,'2025-11-29 13:48:00',NULL,NULL,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (13,'2014_10_12_000000_create_users_table',1),(14,'2014_10_12_100000_create_password_resets_table',1),(15,'2019_08_19_000000_create_failed_jobs_table',1),(16,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `point_value` int NOT NULL,
  `price` bigint NOT NULL,
  `description` text,
  `category_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_unique_code` (`product_code`),
  UNIQUE KEY `products_unique_name` (`product_name`),
  KEY `products_category_FK` (`category_id`),
  CONSTRAINT `products_category_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,'43434','32e32e32e',5000,324324,'d32d32d32d',1,'2025-11-25 16:57:45',1,'2025-11-26 17:51:01',1),(3,'3454541a1','31241234231a1',2147483647,9223372036854775807,'343243241asdsadsad1',1,'2025-11-25 17:05:31',1,'2025-11-26 18:15:00',1),(4,'4232434','d32d3d',5000,12312,'d32d32d',1,'2025-11-25 17:14:46',1,NULL,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order_items`
--

DROP TABLE IF EXISTS `purchase_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_order_items` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `product_code` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `point_value_per_unit` int NOT NULL,
  `price` int NOT NULL,
  `description` text,
  `id_header` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_products_FK` (`product_code`),
  KEY `detail_order_purchase_order_FK` (`id_header`),
  CONSTRAINT `detail_order_purchase_order_FK` FOREIGN KEY (`id_header`) REFERENCES `purchase_orders` (`id`),
  CONSTRAINT `detail_transactions_header_transactions_FK` FOREIGN KEY (`id_header`) REFERENCES `purchase_orders` (`id`),
  CONSTRAINT `transactions_products_FK` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order_items`
--

LOCK TABLES `purchase_order_items` WRITE;
/*!40000 ALTER TABLE `purchase_order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_orders` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `order_number` varchar(100) NOT NULL,
  `sales_date` date NOT NULL,
  `shipping_costs` decimal(10,0) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `header_transactions_unique` (`order_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_orders`
--

LOCK TABLES `purchase_orders` WRITE;
/*!40000 ALTER TABLE `purchase_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int DEFAULT NULL,
  `role` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `no_ktp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_handphone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `filename` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `company_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_binary` blob,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'itsupport','itsupport@sos.co.id',NULL,'$2y$10$gH1yVqvcVQd1X.E21nAVq.s0IZWmkq3YlxrGFQvSkBbzWRqdJMqOy','IT Support',1,'1',NULL,NULL,NULL,NULL,0,NULL,'ngqhs9C9uiNN6jsPyS7DNvSnVFOMmUW7rZkkftoRItFNdEjoEMnzYX4cylaY',_binary 'data:image/png;base64,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','2023-03-13 07:50:46',NULL,'2025-04-16 09:23:24',NULL),(41,'vivi_sugianto','vivi@sos.co.id',NULL,'$2y$10$zSUs41dLZ12zDg4iWTv4/e2zOrK6ZzpG4ZxqNmwl2V1ictKNKnpPy','Vivi Sugianto',0,'2',NULL,NULL,NULL,NULL,0,NULL,'1wF9iRcpGxDJJqHV62YhLMXz3upbpBaUV2t0xHRrlezREwb6Zc',NULL,'2024-08-15 06:36:45',NULL,'2025-04-17 14:15:44',NULL),(42,'Phiong Yulia','phiong.yulia@sos.co.id',NULL,'$2y$10$LHAYe0GLeMtsSCXMF6kuauhyuifECirJq5xDHCqt8DHdY1IY/NwZK','Phiong Yulia',NULL,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:40:21',NULL,'2025-05-06 16:05:19',NULL),(43,'Eka Septiana','eka.septiana@sos.co.id',NULL,'$2y$10$1jA.iEHBshOBAEZRi9Qs.eMmj7bGMELbD55MK1cZg5pnQXDZiZ4rS','Eka Septiana',NULL,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:40:58',NULL,'2025-05-06 16:05:40',NULL),(44,'Galuh Octaviani','galuh.octaviani@sos.co.id',NULL,'$2y$10$.uIxip/7yxKXifbBSj1.m.8eZAZZgUE3.I4QhYNHFKo76kGRUT0P.','Galuh Octaviani',NULL,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:43:22',NULL,'2025-05-06 16:08:53',NULL),(45,'Fadil','muhd.fadil@sos.co.id',NULL,'$2y$10$52EojoTZmuRqidzTh46ON.920MSbk8nGxwGhLw3SXyw2HElv.GSgq','Fadil',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:43:43',NULL,NULL,NULL),(46,'Shisca','shisca.deceany@sos.co.id',NULL,'$2y$10$zuXhe1DuoeKp4hJQSXMhu.h6gdpDZ7vExkd6d78MjDA8s6mxN0aLC','Shisca',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:44:27',NULL,NULL,NULL),(47,'Arya Jaya','arya.jaya@sos.co.id',NULL,'$2y$10$z90jDapPlQtzhD7fksErOesIo63j2syQIGebRLC6XdSHtfMpLYbAu','Arya Jaya',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:44:57',NULL,NULL,NULL),(48,'Angela','arpku@sos.co.id',NULL,'$2y$10$bp/av5AswR8jAn6dPDgRE.GUX4XJq0oPrljBSl8HRcEeyKRfQr9.G','Angela',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:46:23',NULL,NULL,NULL),(49,'Donny','donny@sos.co.id',NULL,'$2y$10$ArmLO8TyvKOlD0QmFR.XeuIwMkmzVPxpME3vvEXifSCFZ5x6O2qny','Donny',0,'3',NULL,NULL,NULL,NULL,0,NULL,'yzKGcpLLlMjFpJUMXVpfykgMZmMtEuNqJkkCAMHss1IE5YDpfuKfQL7osubG',NULL,'2024-08-15 06:46:55',NULL,NULL,NULL),(50,'Kharisma Yudi','kharisma.yudhi@sos.co.id',NULL,'$2y$10$8TSbHCgMq7MyDMxYf.UeKehgnsYsimdgOKJ3.brlhMGbg.D/oNT/W','Kharisma Yudi',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:47:22',NULL,NULL,NULL),(51,'yunianti','yunianti@sos.co.id',NULL,'$2y$10$S5nLgeytep4JKlcZ7C5CmukbvPYIU62ikJqoEKFDYdc0wK0tQ3VvG','yunianti',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:47:59',NULL,NULL,NULL),(52,'vivia','vivia.purdasari@sos.co.id',NULL,'$2y$10$3l0.nvPed5FWHlai.Wgltuxni8t8qvxGgcE3WlSH2C3GFls4GFpJO','vivia',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:49:46',NULL,NULL,NULL),(53,'Deti Ariani','deti.ariani@sos.co.id',NULL,'$2y$10$vPB0tOI4eWb5nwBEcDh/Me8lySaiZMFmuuUvEWuh/YH09fc80h4hi','Deti Ariani',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:50:47',NULL,NULL,NULL),(54,'reja1','reja@sos.co.id',NULL,'$2y$10$//8jzDlWXKB9NT98o9/GdOfyruahfV/ZOvZCBZDjyJDhvBN0yVJ2i','reja1',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:51:16',NULL,NULL,NULL),(55,'Herdiah Kusweni','herdiah.kusweni@sos.co.id',NULL,'$2y$10$mkg7jTAbCGTvI65zWnvN1uK5ayjx9xyVWBckryeARtd29h65T.GZ.','Herdiah Kusweni',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:54:31',NULL,NULL,NULL),(56,'venny','venny.fitri@sos.co.id',NULL,'$2y$10$VjyOqtrq3AatIrIoPzCBBucDAtgDdQ8PFYefYgaGgjIg5ZsDKGFZi','Venny Fitri',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:54:58',NULL,NULL,NULL),(57,'aorora','aorora@sos.co.id',NULL,'$2y$10$eBAa/nuWlBf8lhaVGL.WO.WUl/jiiRXXDDSOKy8DwmxPQ4zopY97C','aorora',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:56:00',NULL,NULL,NULL),(58,'hertina','hertina@sos.co.id',NULL,'$2y$10$shjHtLC7rawCXmahUhpZcutDS8ppZbZcsA/gEh3sbUySkjmwgDaR.','hertina',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:56:31',NULL,NULL,NULL),(59,'meta1','meta@sos.co.id',NULL,'$2y$10$I6DHSF7JNaXyw6Bbs/Y25e/Tp2EgQYAHxIN.llpFsCpqadgd608Wu','meta1',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 06:59:45',NULL,NULL,NULL),(60,'dewi1','dewi@sos.co.id',NULL,'$2y$10$L7Tx.0rlscF7f9YTB1yT/OsBBYOD1uOt5cGgyWEuoLvOFy0n1GFPC','dewi1',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 07:00:07',NULL,NULL,NULL),(61,'ertha','ertha.stephany@sos.co.id',NULL,'$2y$10$RRcbGVg5V2xj8jMsKSJ6CuNxULMrEtFK6VAGphMIiw0M35yjn.yS6','Ertha Staphany',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 07:00:46',NULL,NULL,NULL),(62,'dian sultan','dian.sultan@sos.co.id',NULL,'$2y$10$upa2LmZGhbOjHHMLlT/F0uujHfo0IJVgd2tHE/OZp6dkcu8rOjQFy','dian sultan',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 07:01:33',NULL,NULL,NULL),(63,'habianto','habianto.thalib@sos.co.id',NULL,'$2y$10$buUMMNq5ATKejsqkfhlYNO1zM34GNSUCPZRkwwaY0f3xyU30g5RcS','habianto thalib',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 07:02:31',NULL,NULL,NULL),(64,'riska','riska.paturusi@sos.co.id',NULL,'$2y$10$iLLq44krBQg6Yz1YKImPf.UrWSntSpIeEc7kWKUDGlgRKeZIO5Mte','riska paturusi',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 07:03:03',NULL,NULL,NULL),(65,'ketut','ketut.martini@sos.co.id',NULL,'$2y$10$Bth3A3oy4VzPBf5u95zW3eSU8EuupPfzTUu6JwZQT2IkJG9Pp6L8W','ketut martini',0,'3',NULL,NULL,NULL,NULL,0,NULL,'PDLQjPlnJCLZhPeMdi8fjq1hdbF1deBqER5MTy607XxBF8eRhlxihSw4twdk',NULL,'2024-08-15 07:04:49',NULL,NULL,NULL),(66,'Komang Candra','komang.candra@sos.co.id',NULL,'$2y$10$UYrjg1Rj5hlb0Iak5hWx3Oqmx7w5EjyYOSLYA71W.wUBowM2nxgZm','Komang Candra',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 07:06:37',NULL,NULL,NULL),(67,'Nurma','nurmasari@sos.co.id',NULL,'$2y$10$T0NkT55jMl7S6wUHgXnZkOnuqfyKSFWTAYDQGXGV2.W3zb.13P1wG','Nurma',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 07:06:55',NULL,NULL,NULL),(68,'nuzul','nuzul.zulhijjah@sos.co.id',NULL,'$2y$10$TTwhAXYcK.k4uMC2SQnPZucU.peLnBJdiC7dj.TDbpq2YwwfvNb9u','nuzul',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2024-08-15 07:07:24',NULL,NULL,NULL),(69,'isabella','isabella.sitepu@sos.co.id',NULL,'$2y$10$6Mzr.hO3E9yNcjIaK/e5TeEQ2Fjb0.uYpk5EVzWnS/H3hhBkquKe6','Isabella Sitepu',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2025-02-26 04:46:22',NULL,NULL,NULL),(70,'aina.arfianty','aina.arfianty@sos.co.id',NULL,'$2y$10$6C/K9YMQhCJjXcUUTpGeWeM8NMvVsZhIcMZbcX6GQTET8dGHCg6/q','Aina Arfianty',NULL,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2025-02-26 04:50:14',NULL,'2025-05-06 16:13:51',NULL),(71,'Sri Hana','sri.hana@sos.co.id',NULL,'$2y$10$sbyD8QZrJdzT.1NDBvOBXOjK.NBHyR/ob4Fz3/U1w3ulRDTaMSx1a','Sri Hana',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2025-02-26 04:50:38',NULL,NULL,NULL),(72,'helbet','helbet@sos.co.id',NULL,'$2y$10$3SACdnGOC.f/vbCRetn6q.5uHV4TIys01449XdDZUGp21wD1UAmri','Helbet',0,'3',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,'2025-04-17 09:55:53',NULL,NULL,NULL),(73,'prasetyo_wibowo','prasetyo.wibowo@sos.co.id',NULL,'$2y$10$AR5s38hkNZHdr5K/qIeode2bG2GVpSKXHeQaH3T/vZV3geNCmBhfC','PRASETYO WIBOWO',0,'3',NULL,NULL,NULL,NULL,0,NULL,'IZlrqv7PiAAobRJJzig9hEDQEhZLPKyJTHsZF6Nty5tjZM9dSt',NULL,'2025-06-04 04:47:48',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersdataaccess`
--

DROP TABLE IF EXISTS `usersdataaccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usersdataaccess` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `company_id` smallint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=820 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersdataaccess`
--

LOCK TABLES `usersdataaccess` WRITE;
/*!40000 ALTER TABLE `usersdataaccess` DISABLE KEYS */;
INSERT INTO `usersdataaccess` VALUES (1,1,2,4),(2,1,3,4),(3,1,2,5),(4,1,11,5),(5,63,14,4),(6,63,14,5),(7,63,14,6),(11,41,2,4),(12,41,3,4),(13,41,4,4),(14,41,5,4),(15,41,6,4),(16,41,7,4),(17,41,8,4),(18,41,9,4),(19,41,10,4),(20,41,11,4),(21,41,12,4),(22,41,13,4),(23,41,14,4),(24,41,15,4),(25,41,16,4),(26,41,2,5),(27,41,3,5),(28,41,4,5),(29,41,5,5),(30,41,6,5),(31,41,7,5),(32,41,8,5),(33,41,9,5),(34,41,10,5),(35,41,11,5),(36,41,12,5),(37,41,13,5),(38,41,14,5),(39,41,15,5),(40,41,16,5),(41,41,2,6),(42,41,3,6),(43,41,4,6),(44,41,5,6),(45,41,6,6),(46,41,7,6),(47,41,8,6),(48,41,9,6),(49,41,11,6),(50,41,12,6),(51,41,10,6),(52,41,13,6),(53,41,14,6),(54,41,15,6),(55,41,16,6),(56,41,2,7),(57,41,3,7),(58,41,4,7),(59,41,5,7),(60,41,6,7),(61,41,7,7),(62,41,8,7),(63,41,9,7),(64,41,12,7),(65,41,13,7),(66,41,14,7),(67,41,15,7),(68,41,11,7),(69,41,2,8),(70,41,3,8),(71,41,4,8),(72,41,9,8),(73,41,11,8),(74,41,5,8),(75,41,6,8),(76,41,7,8),(77,41,8,8),(78,41,10,8),(79,41,12,8),(80,41,13,8),(81,41,14,8),(82,41,15,8),(83,69,5,4),(84,69,5,5),(85,69,5,6),(86,47,6,4),(87,47,16,4),(88,47,6,5),(89,47,16,5),(90,47,6,6),(91,47,16,6),(92,48,6,4),(93,48,16,4),(94,48,6,5),(95,48,16,5),(96,48,6,6),(97,48,16,6),(98,50,7,4),(99,50,7,5),(100,50,7,6),(104,51,15,4),(105,51,15,5),(106,51,15,6),(107,52,10,4),(108,52,10,5),(109,52,10,6),(110,53,11,4),(111,53,11,5),(112,53,11,6),(113,53,11,8),(114,54,9,4),(115,54,9,5),(116,54,9,6),(117,54,9,8),(118,55,9,4),(119,55,9,5),(120,55,9,6),(121,55,9,8),(122,56,4,4),(123,56,4,5),(124,56,4,6),(125,57,4,4),(126,57,4,5),(127,57,4,6),(128,58,3,4),(129,58,3,5),(130,58,3,6),(131,59,3,4),(132,59,3,5),(133,59,3,6),(134,60,3,4),(135,60,3,5),(136,60,3,6),(137,61,3,4),(138,61,3,5),(139,61,3,6),(140,62,14,4),(141,62,14,5),(142,62,14,6),(143,64,13,4),(144,64,13,5),(145,64,13,6),(146,65,8,4),(147,65,8,5),(148,65,8,6),(149,66,8,4),(150,66,8,5),(151,66,8,6),(152,67,12,4),(153,67,12,5),(154,67,12,6),(155,68,12,4),(156,68,12,5),(157,68,12,6),(158,71,9,4),(159,71,9,5),(160,71,9,6),(161,71,9,8),(307,72,5,6),(308,72,5,4),(309,72,5,5),(310,72,5,7),(311,72,5,8),(398,44,2,3),(399,44,3,3),(400,44,4,3),(401,44,5,3),(402,44,6,3),(403,44,7,3),(404,44,8,3),(405,44,9,3),(406,44,10,3),(407,44,11,3),(408,44,12,3),(409,44,13,3),(410,44,14,3),(411,44,15,3),(412,44,2,4),(413,44,3,4),(414,44,4,4),(415,44,5,4),(416,44,6,4),(417,44,7,4),(418,44,8,4),(419,44,9,4),(420,44,10,4),(421,44,11,4),(422,44,12,4),(423,44,13,4),(424,44,14,4),(425,44,15,4),(426,44,16,4),(427,44,2,5),(428,44,3,5),(429,44,4,5),(430,44,5,5),(431,44,6,5),(432,44,7,5),(433,44,8,5),(434,44,9,5),(435,44,10,5),(436,44,11,5),(437,44,12,5),(438,44,13,5),(439,44,14,5),(440,44,15,5),(441,44,16,5),(442,44,2,6),(443,44,3,6),(444,44,4,6),(445,44,5,6),(446,44,6,6),(447,44,7,6),(448,44,8,6),(449,44,9,6),(450,44,10,6),(451,44,11,6),(452,44,12,6),(453,44,13,6),(454,44,14,6),(455,44,15,6),(456,44,16,6),(457,44,2,7),(458,44,3,7),(459,44,4,7),(460,44,5,7),(461,44,6,7),(462,44,7,7),(463,44,8,7),(464,44,9,7),(465,44,11,7),(466,44,12,7),(467,44,13,7),(468,44,14,7),(469,44,15,7),(470,44,2,8),(471,44,3,8),(472,44,4,8),(473,44,5,8),(474,44,6,8),(475,44,7,8),(476,44,8,8),(477,44,9,8),(478,44,10,8),(479,44,11,8),(480,44,12,8),(481,44,13,8),(482,44,14,8),(483,44,15,8),(484,43,2,4),(485,43,3,4),(486,43,4,4),(487,43,5,4),(488,43,6,4),(489,43,7,4),(490,43,8,4),(491,43,9,4),(492,43,10,4),(493,43,11,4),(494,43,12,4),(495,43,13,4),(496,43,14,4),(497,43,15,4),(498,43,16,4),(499,43,2,5),(500,43,3,5),(501,43,4,5),(502,43,5,5),(503,43,6,5),(504,43,7,5),(505,43,8,5),(506,43,9,5),(507,43,10,5),(508,43,11,5),(509,43,12,5),(510,43,13,5),(511,43,14,5),(512,43,15,5),(513,43,16,5),(514,43,2,6),(515,43,3,6),(516,43,4,6),(517,43,5,6),(518,43,6,6),(519,43,7,6),(520,43,8,6),(521,43,9,6),(522,43,10,6),(523,43,11,6),(524,43,12,6),(525,43,13,6),(526,43,14,6),(527,43,15,6),(528,43,16,6),(529,43,2,7),(530,43,3,7),(531,43,4,7),(532,43,5,7),(533,43,6,7),(534,43,7,7),(535,43,8,7),(536,43,9,7),(537,43,11,7),(538,43,12,7),(539,43,13,7),(540,43,14,7),(541,43,15,7),(542,43,2,8),(543,43,3,8),(544,43,4,8),(545,43,5,8),(546,43,6,8),(547,43,7,8),(548,43,8,8),(549,43,9,8),(550,43,10,8),(551,43,11,8),(552,43,12,8),(553,43,13,8),(554,43,14,8),(555,43,15,8),(556,43,2,3),(557,43,3,3),(558,43,4,3),(559,43,5,3),(560,43,6,3),(561,43,7,3),(562,43,8,3),(563,43,9,3),(564,43,10,3),(565,43,11,3),(566,43,12,3),(567,43,13,3),(568,43,14,3),(569,43,15,3),(570,70,2,3),(571,70,3,3),(572,70,4,3),(573,70,5,3),(574,70,6,3),(575,70,7,3),(576,70,8,3),(577,70,9,3),(578,70,10,3),(579,70,11,3),(580,70,12,3),(581,70,13,3),(582,70,14,3),(583,70,15,3),(584,70,2,4),(585,70,3,4),(586,70,4,4),(587,70,5,4),(588,70,6,4),(589,70,7,4),(590,70,8,4),(591,70,9,4),(592,70,10,4),(593,70,11,4),(594,70,12,4),(595,70,13,4),(596,70,14,4),(597,70,15,4),(598,70,16,4),(599,70,2,5),(600,70,3,5),(601,70,4,5),(602,70,5,5),(603,70,6,5),(604,70,7,5),(605,70,8,5),(606,70,9,5),(607,70,10,5),(608,70,11,5),(609,70,12,5),(610,70,13,5),(611,70,14,5),(612,70,15,5),(613,70,16,5),(614,70,2,6),(615,70,3,6),(616,70,4,6),(617,70,5,6),(618,70,6,6),(619,70,7,6),(620,70,8,6),(621,70,9,6),(622,70,10,6),(623,70,11,6),(624,70,12,6),(625,70,13,6),(626,70,14,6),(627,70,15,6),(628,70,16,6),(629,70,2,7),(630,70,3,7),(631,70,4,7),(632,70,5,7),(633,70,6,7),(634,70,7,7),(635,70,8,7),(636,70,9,7),(637,70,11,7),(638,70,12,7),(639,70,13,7),(640,70,14,7),(641,70,15,7),(642,70,2,8),(643,70,3,8),(644,70,4,8),(645,70,5,8),(646,70,6,8),(647,70,7,8),(648,70,8,8),(649,70,9,8),(650,70,10,8),(651,70,11,8),(652,70,12,8),(653,70,13,8),(654,70,14,8),(655,70,15,8),(656,42,1,3),(657,42,2,3),(658,42,3,3),(659,42,4,3),(660,42,5,3),(661,42,6,3),(662,42,7,3),(663,42,8,3),(664,42,9,3),(665,42,10,3),(666,42,11,3),(667,42,12,3),(668,42,13,3),(669,42,14,3),(670,42,15,3),(671,42,1,4),(672,42,2,4),(673,42,3,4),(674,42,4,4),(675,42,5,4),(676,42,6,4),(677,42,7,4),(678,42,8,4),(679,42,9,4),(680,42,10,4),(681,42,11,4),(682,42,12,4),(683,42,13,4),(684,42,14,4),(685,42,15,4),(686,42,16,4),(687,42,2,5),(688,42,3,5),(689,42,4,5),(690,42,5,5),(691,42,6,5),(692,42,7,5),(693,42,8,5),(694,42,9,5),(695,42,10,5),(696,42,11,5),(697,42,12,5),(698,42,13,5),(699,42,14,5),(700,42,15,5),(701,42,16,5),(702,42,1,6),(703,42,2,6),(704,42,3,6),(705,42,4,6),(706,42,5,6),(707,42,6,6),(708,42,7,6),(709,42,8,6),(710,42,9,6),(711,42,10,6),(712,42,11,6),(713,42,12,6),(714,42,13,6),(715,42,14,6),(716,42,15,6),(717,42,16,6),(718,42,1,7),(719,42,2,7),(720,42,3,7),(721,42,4,7),(722,42,5,7),(723,42,6,7),(724,42,7,7),(725,42,8,7),(726,42,9,7),(727,42,11,7),(728,42,12,7),(729,42,13,7),(730,42,14,7),(731,42,15,7),(732,42,1,8),(733,42,2,8),(734,42,3,8),(735,42,4,8),(736,42,5,8),(737,42,6,8),(738,42,7,8),(739,42,8,8),(740,42,9,8),(741,42,10,8),(742,42,11,8),(743,42,12,8),(744,42,13,8),(745,42,14,8),(746,42,15,8),(747,73,2,3),(748,73,3,3),(749,73,4,3),(750,73,5,3),(751,73,6,3),(752,73,7,3),(753,73,8,3),(754,73,9,3),(755,73,10,3),(756,73,11,3),(757,73,12,3),(758,73,13,3),(759,73,14,3),(760,73,15,3),(761,73,2,4),(762,73,3,4),(763,73,4,4),(764,73,5,4),(765,73,6,4),(766,73,7,4),(767,73,8,4),(768,73,9,4),(769,73,10,4),(770,73,11,4),(771,73,12,4),(772,73,13,4),(773,73,14,4),(774,73,15,4),(775,73,16,4),(776,73,2,5),(777,73,3,5),(778,73,4,5),(779,73,5,5),(780,73,6,5),(781,73,7,5),(782,73,8,5),(783,73,9,5),(784,73,10,5),(785,73,11,5),(786,73,12,5),(787,73,13,5),(788,73,14,5),(789,73,15,5),(790,73,16,5),(791,73,2,6),(792,73,3,6),(793,73,4,6),(794,73,5,6),(795,73,6,6),(796,73,7,6),(797,73,8,6),(798,73,9,6),(799,73,10,6),(800,73,11,6),(801,73,12,6),(802,73,13,6),(803,73,14,6),(804,73,15,6),(805,73,16,6),(806,73,2,8),(807,73,3,8),(808,73,4,8),(809,73,5,8),(810,73,6,8),(811,73,7,8),(812,73,8,8),(813,73,9,8),(814,73,10,8),(815,73,11,8),(816,73,12,8),(817,73,13,8),(818,73,14,8),(819,73,15,8);
/*!40000 ALTER TABLE `usersdataaccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersprivilege`
--

DROP TABLE IF EXISTS `usersprivilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usersprivilege` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `menu_id` int DEFAULT NULL,
  `create` tinyint DEFAULT NULL,
  `update` tinyint DEFAULT NULL,
  `delete` tinyint DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=605 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersprivilege`
--

LOCK TABLES `usersprivilege` WRITE;
/*!40000 ALTER TABLE `usersprivilege` DISABLE KEYS */;
INSERT INTO `usersprivilege` VALUES (421,41,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(422,41,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(423,41,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(428,42,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(429,42,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(430,42,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(437,45,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(438,45,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(439,45,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(443,46,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(444,46,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(445,46,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(446,47,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(447,47,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(448,47,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(458,48,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(459,48,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(460,48,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(461,50,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(462,50,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(463,50,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(485,52,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(486,52,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(487,52,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(488,43,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(489,43,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(490,43,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(491,51,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(492,51,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(493,51,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(494,44,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(495,44,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(496,44,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(497,53,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(498,53,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(499,53,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(500,54,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(501,54,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(502,54,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(503,55,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(504,55,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(505,55,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(506,56,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(507,56,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(508,56,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(509,57,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(510,57,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(511,57,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(512,58,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(513,58,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(514,58,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(515,49,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(516,49,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(517,49,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(521,59,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(522,59,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(523,59,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(524,60,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(525,60,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(526,60,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(527,61,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(528,61,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(529,61,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(533,63,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(534,63,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(535,63,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(536,64,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(537,64,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(538,64,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(539,65,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(540,65,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(541,65,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(542,66,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(543,66,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(544,66,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(545,67,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(546,67,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(547,67,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(548,68,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(549,68,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(550,68,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(551,70,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(552,70,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(553,70,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(554,71,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(555,71,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(556,71,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(557,62,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(558,62,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(559,62,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(560,69,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(561,69,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(562,69,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(563,72,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(564,72,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(565,72,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(578,73,4,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(579,73,24,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(580,73,28,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(601,1,2,1,1,1,NULL,'0000-00-00 00:00:00',NULL,NULL),(602,1,4,1,1,1,NULL,'0000-00-00 00:00:00',NULL,NULL),(603,1,6,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL),(604,1,8,0,0,0,NULL,'0000-00-00 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `usersprivilege` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-04 22:22:13
