-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: campus_app
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,7,'dfhdfhdfhdhdh','2026-01-24 10:45:40'),(2,1,7,'Ky hua','2026-01-24 10:46:09');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `hashtags` text DEFAULT NULL,
  `mentions` text DEFAULT NULL,
  `visibility` enum('public','private') DEFAULT 'public',
  `likes_count` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `reposts_count` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_created` (`created_at`),
  KEY `idx_popularity` (`likes_count`,`reposts_count`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,'Welcome to the new Campus App! 🎓 This is the start of our dynamic timeline. Stay tuned for updates.',NULL,NULL,NULL,NULL,'public',0,'2026-01-23 12:21:35',2),(2,6,'Football match this weekend! Who\'s coming? ⚽️',NULL,NULL,NULL,NULL,'public',19,'2026-01-23 03:21:35',0),(3,2,'Excited for the upcoming cultural fest! 🎉','https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=800&q=80',NULL,NULL,NULL,'public',43,'2026-01-23 02:21:35',0),(4,5,'Excited for the upcoming cultural fest! 🎉','https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?w=800&q=80',NULL,NULL,NULL,'public',3,'2026-01-20 04:21:35',0),(5,2,'Just finished the final project for CS101! 💻 #coding #university',NULL,NULL,NULL,NULL,'public',10,'2026-01-20 11:21:35',0),(6,4,'Does anyone have notes for yesterday\'s Physics lecture?',NULL,NULL,NULL,NULL,'public',15,'2026-01-19 10:21:35',0),(7,1,'Don\'t forget the seminar tomorrow at 2 PM in Hall A.',NULL,NULL,NULL,NULL,'public',35,'2026-01-20 02:21:35',1),(8,5,'Campus looks beautiful today! ☀️','https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?w=800&q=80',NULL,NULL,NULL,'public',50,'2026-01-22 15:21:35',0),(9,5,'Reminder: Assignment due date extended to Friday.','https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?w=800&q=80',NULL,NULL,NULL,'public',12,'2026-01-19 21:21:35',0),(10,4,'Don\'t forget the seminar tomorrow at 2 PM in Hall A.',NULL,NULL,NULL,NULL,'public',40,'2026-01-22 15:21:35',0),(11,6,'Reminder: Assignment due date extended to Friday.',NULL,NULL,NULL,NULL,'public',20,'2026-01-22 09:21:35',0),(12,4,'Excited for the upcoming cultural fest! 🎉',NULL,NULL,NULL,NULL,'public',15,'2026-01-22 04:21:35',0),(13,5,'Just submitted my research paper! Fingers crossed. 🤞',NULL,NULL,NULL,NULL,'public',46,'2026-01-23 09:21:35',1),(14,4,'Don\'t forget the seminar tomorrow at 2 PM in Hall A.',NULL,NULL,NULL,NULL,'public',15,'2026-01-22 10:21:35',0),(15,6,'Coffee break at the cafeteria ☕️','https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=800&q=80',NULL,NULL,NULL,'public',44,'2026-01-23 03:21:35',0),(16,3,'Coffee break at the cafeteria ☕️',NULL,NULL,NULL,NULL,'public',5,'2026-01-21 06:21:35',0),(17,7,'Md kaif','df66f1b885aa395af4c9ffe6c2bfce8b.jpeg',NULL,NULL,NULL,'public',0,'2026-01-24 07:12:59',0),(18,7,'#Mdkaif',NULL,NULL,'Mdkaif',NULL,'public',0,'2026-01-24 07:16:46',0);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reposts`
--

DROP TABLE IF EXISTS `reposts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `original_post_id` (`original_post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reposts_ibfk_1` FOREIGN KEY (`original_post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reposts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reposts`
--

LOCK TABLES `reposts` WRITE;
/*!40000 ALTER TABLE `reposts` DISABLE KEYS */;
INSERT INTO `reposts` VALUES (1,1,7,'Like this ','2026-01-24 10:58:14'),(2,13,7,NULL,'2026-01-24 11:01:17'),(3,1,1,NULL,'2026-01-24 11:21:59'),(4,7,1,NULL,'2026-01-24 11:22:01');
/*!40000 ALTER TABLE `reposts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
INSERT INTO `stories` VALUES (1,5,'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=800&q=80','Daily update #1','2026-01-23 12:21:35','2026-01-24 12:21:35'),(2,4,'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=800&q=80','Daily update #2','2026-01-23 12:21:35','2026-01-24 12:21:35'),(3,2,'https://images.unsplash.com/photo-1510915366472-7cb6256f145f?w=800&q=70','Daily update #3','2026-01-23 12:21:35','2026-01-24 12:21:35'),(4,3,'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=800&q=80','Daily update #4','2026-01-23 12:21:35','2026-01-24 12:21:35'),(5,6,'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=800&q=80','Daily update #5','2026-01-23 12:21:35','2026-01-24 12:21:35'),(6,6,'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=800&q=80','Daily update #6','2026-01-23 12:21:35','2026-01-24 12:21:35'),(7,6,'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=800&q=80','Daily update #7','2026-01-23 12:21:35','2026-01-24 12:21:35'),(8,2,'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=800&q=80','Daily update #8','2026-01-23 12:21:35','2026-01-24 12:21:35'),(9,4,'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=800&q=80','Daily update #9','2026-01-23 12:21:35','2026-01-24 12:21:35'),(10,4,'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=800&q=80','Daily update #10','2026-01-23 12:21:35','2026-01-24 12:21:35');
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user',
  `gender` varchar(20) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `faculty_id` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `graduation_year` varchar(4) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` enum('pending','active','suspended') DEFAULT 'pending',
  `is_verified` tinyint(1) DEFAULT 0,
  `id_card` varchar(255) DEFAULT NULL,
  `face_descriptor` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `idx_username` (`username`),
  KEY `idx_first_last` (`first_name`,`last_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@university.edu','admin','$2y$10$LHJNGhZ/rAp6RL..XgsQUe8A2Hf8eWTwTDQ9HQ9uCAyd/zaMq4wb2','0cfd2a5694f05d86672fb029a03658384811efda28599bfe9c93c397390a9e24','2026-01-23 10:56:46','System','Admin',NULL,NULL,'admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-01-23 12:21:35','active',1,NULL,NULL),(2,'john.doe@university.edu','johndoe','$2y$10$.uDiZDR69Ps2gwY2erLvc.wOGWQh8bk0yxKD7PhL/BHaGJsfaZXS.',NULL,NULL,'John','Doe',NULL,NULL,'student','Male','Computer Science','https://randomuser.me/api/portraits/men/10.jpg',NULL,NULL,NULL,NULL,NULL,'2026-01-23 12:21:35','active',1,NULL,NULL),(3,'sarah.smith@university.edu','sarahsmith','$2y$10$.uDiZDR69Ps2gwY2erLvc.wOGWQh8bk0yxKD7PhL/BHaGJsfaZXS.',NULL,NULL,'Sarah','Smith',NULL,NULL,'student','Female','Mathematics','https://randomuser.me/api/portraits/women/11.jpg',NULL,NULL,NULL,NULL,NULL,'2026-01-23 12:21:35','active',1,NULL,NULL),(4,'michael.johnson@university.edu','michaeljohnson','$2y$10$.uDiZDR69Ps2gwY2erLvc.wOGWQh8bk0yxKD7PhL/BHaGJsfaZXS.',NULL,NULL,'Michael','Johnson',NULL,NULL,'faculty','Male','Physics','https://randomuser.me/api/portraits/men/12.jpg','123_old_4',NULL,NULL,NULL,NULL,'2026-01-23 12:21:35','active',1,NULL,NULL),(5,'emily.davis@university.edu','emilydavis','$2y$10$.uDiZDR69Ps2gwY2erLvc.wOGWQh8bk0yxKD7PhL/BHaGJsfaZXS.',NULL,NULL,'Emily','Davis',NULL,NULL,'student','Female','Biology','https://randomuser.me/api/portraits/women/13.jpg',NULL,NULL,NULL,NULL,NULL,'2026-01-23 12:21:35','active',1,NULL,NULL),(6,'david.wilson@university.edu','davidwilson','$2y$10$.uDiZDR69Ps2gwY2erLvc.wOGWQh8bk0yxKD7PhL/BHaGJsfaZXS.',NULL,NULL,'David','Wilson',NULL,NULL,'faculty','Male','Chemistry','https://randomuser.me/api/portraits/men/14.jpg','123_old_6',NULL,NULL,NULL,NULL,'2026-01-23 12:21:35','active',1,NULL,NULL),(7,'mdkaifnasir@gmail.com','mdkaifnasir','$2y$10$lhubZtN2ZrcTTQ.dN7Lsde02jcV5HdIBMR/1O9cC3XkLl7LVhaFyy','442c1ccfd05bc513016af61841a2a5602f485d603bd31946f6f869c22220cbcd','2026-01-23 12:16:23','MD','KAIF NASIR SUNDKE','Live like a king','','student','Male',NULL,'bad15d1d77774e5ff78ccb032ffea76d.jpeg','S231073096',NULL,'2026-01-09','+919860606277','2024','2026-01-23 09:29:44','active',1,'9f29c568669137e05d651b9bf9cbe84d.jpeg','[-0.0638522058725357,0.0436701700091362,0.022159727290272713,-0.07952425628900528,-0.027184266597032547,-0.01639699935913086,0.0391416922211647,-0.1047196164727211,0.1654103696346283,-0.11672892421483994,0.20380015671253204,-0.04270622879266739,-0.2547279894351959,-0.15597908198833466,0.0025139390490949154,0.13265211880207062,-0.08513589203357697,-0.13466264307498932,-0.08765559643507004,-0.041264016181230545,0.09656611829996109,-0.01587214693427086,-0.006691348738968372,0.06586185842752457,-0.10231273621320724,-0.3308548629283905,-0.04766499996185303,-0.08506055176258087,-0.08331533521413803,-0.03909679129719734,-0.05688146501779556,0.03836490586400032,-0.2030876874923706,-0.062468789517879486,-0.02714480087161064,0.07812472432851791,-0.026668015867471695,-0.07432140409946442,0.14022931456565857,0.010257478803396225,-0.12532030045986176,-0.057077474892139435,0.02166280709207058,0.19259700179100037,0.11191834509372711,0.03440626338124275,0.04520829766988754,-0.04372277110815048,0.05637384206056595,-0.23887625336647034,0.00441364198923111,0.09534977376461029,0.1145344004034996,0.051894307136535645,0.07744117081165314,-0.1453854888677597,0.06188315898180008,0.026425037533044815,-0.1750832051038742,0.01504081767052412,0.01029112283140421,-0.04357963055372238,-0.048889048397541046,-0.039483390748500824,0.2855147421360016,0.10487640649080276,-0.11676397919654846,-0.06919603794813156,0.11847937852144241,-0.12268263101577759,-0.06888487190008163,-0.005773874465376139,-0.12053923308849335,-0.1960165947675705,-0.2648100256919861,0.07202638685703278,0.41659167408943176,0.20143912732601166,-0.22504277527332306,0.01094002090394497,-0.1158510223031044,0.023970041424036026,0.1580764353275299,0.02261904813349247,-0.05634298175573349,0.07518196105957031,-0.1202860176563263,0.05521325021982193,0.1717347651720047,-0.020492777228355408,-0.08639902621507645,0.2150048315525055,0.003189594717696309,0.07291014492511749,0.016340559348464012,-0.048253174871206284,-0.020436938852071762,0.07211624085903168,-0.11947822570800781,0.045883987098932266,0.09689304232597351,-0.040238551795482635,0.04060010612010956,0.08692270517349243,-0.1326053887605667,0.06393957883119583,0.0004872431163676083,-0.029120761901140213,-0.01431402750313282,0.03297102823853493,-0.2054542899131775,-0.04521214962005615,0.07028937339782715,-0.2350834608078003,0.1607067883014679,0.15558257699012756,0.038978368043899536,0.13675013184547424,0.09492678195238113,0.049314260482788086,0.03762035816907883,-0.04862182214856148,-0.15535058081150055,-0.053455762565135956,0.13398729264736176,0.02223106101155281,0.1288301795721054,0.024305634200572968]');
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

-- Dump completed on 2026-01-24 12:26:02
