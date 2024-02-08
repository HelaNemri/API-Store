-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: api_store
-- ------------------------------------------------------
-- Server version	8.0.30
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!50503 SET NAMES utf8mb4 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;
--
-- Current Database: `api_store`
--
CREATE DATABASE
/*!32312 IF NOT EXISTS*/
`api_store`
/*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */
/*!80016 DEFAULT ENCRYPTION='N' */
;
USE `api_store`;
--
-- Table structure for table `magasin`
--
DROP TABLE IF EXISTS `magasin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `magasin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `ville` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `categorie` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adresse` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `code_postal` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `telephone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `site_web` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date_ouverture` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `tr_date_updated` datetime DEFAULT NULL COMMENT 'via trigger ADD/MODIF',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`),
  KEY `tr_date_updated` (`tr_date_updated`)
) ENGINE = InnoDB AUTO_INCREMENT = 16 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `magasin`
--
LOCK TABLES `magasin` WRITE;
/*!40000 ALTER TABLE `magasin` DISABLE KEYS */
;
INSERT INTO `magasin`
VALUES (
    1,
    'ElectroTech',
    'Paris',
    'Électronique',
    '123 Rue de la Technologie',
    '75001',
    '+33123456789',
    'info@electrotech.com',
    'www.electrotech.com',
    '2023-01-15',
    'Spécialisé dans les appareils électroniques de pointe.',
    '2024-02-07 10:46:39'
  ),
  (
    2,
    'FashionStyle',
    'New York',
    'Mode',
    '456 Fashion Avenue',
    '10001',
    '+12123456789',
    'info@fashionstyle.com',
    'www.fashionstyle.com',
    '2023-02-20',
    'Votre destination mode pour les dernières tendances.',
    '2024-02-07 10:46:39'
  ),
  (
    3,
    'CulinaryDelight',
    'Tokyo',
    'Cuisine',
    '789 Culinary Street',
    '100-0001',
    '+81345678901',
    'info@culinarydelight.com',
    'www.culinarydelight.com',
    '2023-03-10',
    'Offrant les meilleurs ustensiles et ingrédients de cuisine.',
    '2024-02-07 10:46:39'
  ),
  (
    4,
    'SportArena',
    'Berlin',
    'Sport',
    '101 Sportsplatz',
    '10178',
    '+49301234567',
    'info@sportarena.com',
    'www.sportarena.com',
    '2023-04-05',
    'Pour les passionnés de sports et de fitness.',
    '2024-02-07 10:46:39'
  ),
  (
    5,
    'BookHaven',
    'London',
    'Librairie',
    '23 Literary Lane',
    'W1A 1AA',
    '+442071234567',
    'info@bookhaven.com',
    'www.bookhaven.com',
    '2023-05-12',
    'Un paradis pour les amateurs de livres.',
    '2024-02-07 10:46:39'
  ),
  (
    6,
    'HomeEssentials',
    'Sydney',
    'Articles de maison',
    '789 Homeware Street',
    '2000',
    '+61234567890',
    'info@homeessentials.com',
    'www.homeessentials.com',
    '2023-06-18',
    'Pour rendre votre maison encore plus accueillante.',
    '2024-02-07 10:46:39'
  ),
  (
    7,
    'ToyLand',
    'Los Angeles',
    'Jouets',
    '456 Toy Street',
    '90001',
    '+13234567890',
    'info@toyland.com',
    'www.toyland.com',
    '2023-07-25',
    'Le paradis des jouets pour les petits et les grands.',
    '2024-02-07 10:46:39'
  ),
  (
    8,
    'MusicWorld',
    'Nashville',
    'Musique',
    '101 Melody Lane',
    '37201',
    '+16153456789',
    'info@musicworld.com',
    'www.musicworld.com',
    '2023-08-30',
    'Découvrez la magie de la musique sous un même toit.',
    '2024-02-07 10:46:39'
  ),
  (
    9,
    'AutoMasters',
    'Rome',
    'Automobile',
    '23 Autostrada Street',
    '00100',
    '+390123456789',
    'info@automasters.com',
    'www.automasters.com',
    '2023-09-15',
    'Experts en réparation et personnalisation automobile.',
    '2024-02-07 10:46:39'
  ),
  (
    10,
    'BeautyEmporium',
    'Paris',
    'Cosmétiques',
    '789 Beauty Boulevard',
    '75002',
    '+33123456789',
    'info@beautyemporium.com',
    'www.beautyemporium.com',
    '2023-10-20',
    'Des produits de beauté pour tous les styles.',
    '2024-02-07 10:46:39'
  ),
  (
    11,
    'GreenThumb',
    'Vancouver',
    'Jardinage',
    '456 Greenery Lane',
    'V6C 1A1',
    '+16041234567',
    'info@greenthumb.com',
    'www.greenthumb.com',
    '2023-11-25',
    'Tout ce dont vous avez besoin pour votre jardin.',
    '2024-02-07 10:46:39'
  ),
  (
    12,
    'TechHub',
    'San Francisco',
    'Technologie',
    '101 Tech Street',
    '94105',
    '+14151234567',
    'info@techhub.com',
    'www.techhub.com',
    '2023-12-30',
    'Innovations technologiques et gadgets dernier cri.',
    '2024-02-07 10:46:39'
  ),
  (
    13,
    'PetParadise',
    'Sydney',
    'Animaux de compagnie',
    '23 Pet Haven',
    '2000',
    '+61234567890',
    'info@petparadise.com',
    'www.petparadise.com',
    '2024-01-05',
    'Tout pour le bonheur de vos animaux de compagnie.',
    '2024-02-07 10:46:39'
  ),
  (
    14,
    'ArtisanCrafts',
    'Barcelona',
    'Artisanat',
    '789 Art Street',
    '08001',
    '+34931234567',
    'info@artisancrafts.com',
    'www.artisancrafts.com',
    '2024-02-10',
    'Artisanat unique et créations faites à la main.',
    '2024-02-07 10:46:39'
  ),
  (
    15,
    'OutdoorAdventures',
    'Denver',
    'Équipement de plein air',
    '456 Outdoor Road',
    '80202',
    '+13034567890',
    'info@outdooradventures.com',
    'www.outdooradventures.com',
    '2024-03-15',
    'Pour les amateurs d\'aventure en plein air.',
    '2024-02-07 10:46:39'
  );
/*!40000 ALTER TABLE `magasin` ENABLE KEYS */
;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;
-- Dump completed on 2024-02-07 10:49:24