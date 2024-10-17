/*

SQLyog Ultimate v8.55 
MySQL - 5.5.5-10.4.24-MariaDB : Database - bookingtour

*********************************************************************

*/



/*!40101 SET NAMES utf8 */;



/*!40101 SET SQL_MODE=''*/;



/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`bookingtour` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;



USE `bookingtour`;



/*Table structure for table `actions` */



DROP TABLE IF EXISTS `actions`;



CREATE TABLE `actions` (
  `ActionID` int(11) NOT NULL AUTO_INCREMENT,
  `ActionName` varchar(50) NOT NULL,
  PRIMARY KEY (`ActionID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;



/*Data for the table `actions` */



insert  into `actions`(`ActionID`,`ActionName`) values (1,'Pending'),(2,'Ongoing'),(3,'Rejected');



/*Table structure for table `activitylogs` */



DROP TABLE IF EXISTS `activitylogs`;



CREATE TABLE `activitylogs` (
  `logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `clientusers` int(11) DEFAULT NULL,
  `adminusers` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `details` text DEFAULT NULL,
  PRIMARY KEY (`logs_id`),
  KEY `clientusers` (`clientusers`),
  KEY `adminusers` (`adminusers`),
  CONSTRAINT `activitylogs_ibfk_1` FOREIGN KEY (`clientusers`) REFERENCES `clientusers` (`ClientUserID`),
  CONSTRAINT `activitylogs_ibfk_2` FOREIGN KEY (`adminusers`) REFERENCES `adminusers` (`AdminUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;



/*Data for the table `activitylogs` */



insert  into `activitylogs`(`logs_id`,`clientusers`,`adminusers`,`action`,`action_time`,`ip_address`,`details`) values (1,NULL,1,'Updated booking action','2024-08-31 09:58:42','::1','Booking ID: 6, Action: rejected'),(2,NULL,1,'Updated booking action','2024-08-31 10:06:34','::1','Booking ID: 14, Action: rejected');



/*Table structure for table `addcart` */



DROP TABLE IF EXISTS `addcart`;



CREATE TABLE `addcart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `tourID` int(11) DEFAULT NULL,
  `ClientUserID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;



/*Data for the table `addcart` */



insert  into `addcart`(`cart_id`,`tourID`,`ClientUserID`,`dateCreated`) values (14,4,3,'2024-10-10 06:05:41');



/*Table structure for table `adminstatus` */



DROP TABLE IF EXISTS `adminstatus`;



CREATE TABLE `adminstatus` (
  `statusID` int(11) NOT NULL AUTO_INCREMENT,
  `statusName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;



/*Data for the table `adminstatus` */



insert  into `adminstatus`(`statusID`,`statusName`) values (1,'Active'),(2,'Terminate'),(3,'Non-Active');



/*Table structure for table `adminuserroles` */



DROP TABLE IF EXISTS `adminuserroles`;



CREATE TABLE `adminuserroles` (
  `AdminUserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `roles` int(11) DEFAULT NULL,
  PRIMARY KEY (`AdminUserID`,`RoleID`),
  KEY `RoleID` (`RoleID`),
  CONSTRAINT `AdminUserRoles_ibfk_1` FOREIGN KEY (`AdminUserID`) REFERENCES `adminusers` (`AdminUserID`),
  CONSTRAINT `AdminUserRoles_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



/*Data for the table `adminuserroles` */



/*Table structure for table `adminusers` */



DROP TABLE IF EXISTS `adminusers`;



CREATE TABLE `adminusers` (
  `AdminUserID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleID` int(11) DEFAULT NULL,
  `statusID` int(11) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  PRIMARY KEY (`AdminUserID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`),
  KEY `RoleID` (`RoleID`),
  KEY `statusID` (`statusID`),
  CONSTRAINT `adminusers_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`),
  CONSTRAINT `adminusers_ibfk_2` FOREIGN KEY (`statusID`) REFERENCES `adminstatus` (`statusID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;



/*Data for the table `adminusers` */



insert  into `adminusers`(`AdminUserID`,`RoleID`,`statusID`,`Username`,`Password`,`Email`) values (1,4,1,'Dev','$2y$10$pwlHBY96C7aEr/HeC3FF7e1c4FaiYEd8hd/blbuG3VX3RCJOnnMvC','compssa10@gmail.com'),(2,2,1,'Junior','$2y$10$Hi0DJ/Ynl.146MJxpqZEcenC0Q.uX2CL5hS5A2rkCjdLcMuJLggqW','enochkwame216@gmail.com'),(3,1,1,'Admin','$2y$10$m5kSqqwxGqKVGLvO84QSpunyAl0k6HYvFSlN68Wm/qJSg3vnrjbWS','nanatec21@gmail.com'),(5,4,3,'kwame','$2y$10$3PwR.06maqUrd0MnEdDm5uJfaC5YQMA0uzqE9VKWf1mYdyWmNw8bO','dojo8416@gmail.com');



/*Table structure for table `booktours` */



DROP TABLE IF EXISTS `booktours`;



CREATE TABLE `booktours` (
  `bookTour_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ClientUserID` int(11) DEFAULT NULL,
  `participants` int(11) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `bookPrice` decimal(10,2) DEFAULT NULL,
  `Dated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`bookTour_ID`),
  KEY `ClientUserID` (`ClientUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;



/*Data for the table `booktours` */

insert  into `booktours`(`bookTour_ID`,`ClientUserID`,`participants`,`tour_id`,`action_id`,`bookPrice`,`Dated`) values (1,2,5,4,2,'300.00','2024-10-03 13:48:32'),(2,3,2,4,1,'400.00','2024-10-10 09:43:12');




/*Table structure for table `clientusers` */
DROP TABLE IF EXISTS `clientusers`;



CREATE TABLE `clientusers` (
  `ClientUserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `contact` int(15) NOT NULL,
  `location` varchar(50) NOT NULL,
  PRIMARY KEY (`ClientUserID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`),
  KEY `fk_role` (`RoleID`),
  CONSTRAINT `fk_role` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;



/*Data for the table `clientusers` */



insert  into `clientusers`(`ClientUserID`,`Username`,`Password`,`FullName`,`Email`,`RoleID`,`contact`,`location`) values (1,'Jojo','$2y$10$BBYO5WzrRpWrowiigOR6M.adJUrgx1RuJmvFrCpJgR0VtV0oCINb2','Baba','destinynana566@gmail.com',3,555382169,'Volt. Region Ho'),(2,'Kwisdom','$2y$10$AXrGcoTb3hg4qJvbhki8m.QzL/p7Wqs7nO1vkZVAsbI4cBz6r0.W.','Wisdom','Kwisdom116@gmail.com',3,555123697,'Accra Adenta'),(3,'Attipoe','$2y$10$CcuMOFroX1756jYxubtSeOxOfOQFhBUnPu.zQpHOeHU.WkLnHVJ7C','John','wilsonattipoe7@gmail.com',3,555369512,'Nothern Region, Sakaka'),(4,'SpendyLove','$2y$10$c8CtBcns0vmtX9sbrDzU3uJQR7ey.phszsVni7m1QQ9KgpjPRl.na','Addo','bksaddo@gmail.com',3,552345964,'Accra Madina'),(5,'Maron','$2y$10$eF1trouKeCgm6ic.EnDQTOIPT.YWKenhwPW2ev/cf9XW4NnWCPzOe','Akuffo','marongeorge03@gmail.com',3,553698541,'Ashiaman');



/*Table structure for table `countries` */



DROP TABLE IF EXISTS `countries`;



CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) NOT NULL,
  `continent` varchar(255) NOT NULL,
  `countryamount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`country_id`),
  KEY `fk_countryamount_id` (`countryamount_id`),
  CONSTRAINT `fk_countryamount_id` FOREIGN KEY (`countryamount_id`) REFERENCES `countryamount` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;



/*Data for the table `countries` */



insert  into `countries`(`country_id`,`country_name`,`continent`,`countryamount_id`) values (1,'Ghana','Africa',1),(2,'Kenya','Africa',2),(3,'South Africa','Africa',3),(4,'Brazil','South America',4),(5,'Canada','North America',5),(6,'Japan','Asia',6),(7,'Australia','Australia',7),(8,'France','Europe',8),(9,'Italy','Europe',9),(10,'New Zealand','Australia',10);



/*Table structure for table `countryamount` */



DROP TABLE IF EXISTS `countryamount`;



CREATE TABLE `countryamount` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `countryamnt` int(11) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;



/*Data for the table `countryamount` */



insert  into `countryamount`(`country_id`,`countryamnt`) values (1,1000),(2,1200),(3,1500),(4,2000),(5,2500),(6,3000),(7,3500),(8,4000),(9,4500),(10,5000);



/*Table structure for table `email` */



DROP TABLE IF EXISTS `email`;



CREATE TABLE `email` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_text` text DEFAULT NULL,
  `FullName` varchar(255) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;



/*Data for the table `email` */



insert  into `email`(`email_id`,`email_text`,`FullName`) values (1,'dsfasdgsdgsd','bb'),(2,'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww','Mr. Walter'),(3,'The PHP script receives the form data and saves the message to the database.\nIt then sends an email to the system administrator with the details of the message.\nErrors are handled and reported if any issue occurs during the process.','Dev');



/*Table structure for table `feedback` */



DROP TABLE IF EXISTS `feedback`;



CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL AUTO_INCREMENT,
  `ClientUserID` int(11) DEFAULT NULL,
  `FeedbackText` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `booking_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`FeedbackID`),
  KEY `ClientUserID` (`ClientUserID`),
  KEY `fk_booking` (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;



/*Data for the table `feedback` */



insert  into `feedback`(`FeedbackID`,`ClientUserID`,`FeedbackText`,`CreatedAt`,`booking_id`) values (1,1,'oin us on this 8 Day Special Tour of Ghana. Highlights include a tour of WEB Dubois Centre, Independence Square, Kwame Nkrumah Memorial','2024-08-29 15:29:14',1);



/*Table structure for table `passwordreset` */



DROP TABLE IF EXISTS `passwordreset`;



CREATE TABLE `passwordreset` (
  `PasswordReset_id` int(11) NOT NULL AUTO_INCREMENT,
  `ClientUserID` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry` datetime NOT NULL,
  PRIMARY KEY (`PasswordReset_id`),
  KEY `ClientUserID` (`ClientUserID`),
  CONSTRAINT `passwordreset_ibfk_1` FOREIGN KEY (`ClientUserID`) REFERENCES `clientusers` (`ClientUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;



/*Data for the table `passwordreset` */



/*Table structure for table `request` */



DROP TABLE IF EXISTS `request`;



CREATE TABLE `request` (
  `Request_id` int(11) NOT NULL AUTO_INCREMENT,
  `ClientUserID` int(11) DEFAULT NULL,
  `ActionID` int(11) DEFAULT NULL,
  `Request_title` varchar(255) DEFAULT NULL,
  `Request_description` text DEFAULT NULL,
  `Request_tourname` varchar(255) DEFAULT NULL,
  `Request_Date` date DEFAULT NULL,
  `verify_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Request_id`),
  KEY `fk_ClientUserID` (`ClientUserID`),
  KEY `fk_ActionID` (`ActionID`),
  KEY `fk_verify` (`verify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;



/*Data for the table `request` */



insert  into `request`(`Request_id`,`ClientUserID`,`ActionID`,`Request_title`,`Request_description`,`Request_tourname`,`Request_Date`,`verify_id`) values (1,1,3,'I want a reserve place and a room','i just want a place of quit serene and a nice environment','Travel to HTU campus','2024-08-09',NULL),(2,1,1,'Wilson','just wanna go home!','Accra','2024-08-06',NULL),(3,2,1,'Afajato','Please, i want to have my vacation holiday at this special place ','Holiday','2024-08-29',NULL);



/*Table structure for table `roles` */



DROP TABLE IF EXISTS `roles`;



CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(50) NOT NULL,
  PRIMARY KEY (`RoleID`),
  UNIQUE KEY `RoleName` (`RoleName`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;



/*Data for the table `roles` */



insert  into `roles`(`RoleID`,`RoleName`) values (1,'Admin'),(4,'Employee'),(2,'supervisor'),(3,'user');



/*Table structure for table `room` */



DROP TABLE IF EXISTS `room`;



CREATE TABLE `room` (
  `Room_id` int(11) NOT NULL AUTO_INCREMENT,
  `Rooms_Name` varchar(50) DEFAULT NULL,
  `RoomImage` blob DEFAULT NULL,
  `adminusers` int(11) DEFAULT NULL,
  `roomamount` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bedquantity` int(11) NOT NULL,
  `wifi` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `bathroom` int(11) NOT NULL,
  PRIMARY KEY (`Room_id`),
  KEY `roomamount` (`roomamount`),
  KEY `adminusers` (`adminusers`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;



/*Data for the table `room` */



insert  into `room`(`Room_id`,`Rooms_Name`,`RoomImage`,`adminusers`,`roomamount`,`created_at`,`bedquantity`,`wifi`,`description`,`bathroom`) values (1,'Luxury','room2.webp',3,1,'2024-08-25 05:50:13',2,'Avialable','Enjoy a stay in our luxury 5 star rooms or suites at Kempinski Hotel Gold Coast City Accra situated in the heart of Accra. Book direct for the best rates.',2),(2,'First class','room1.jpg',3,2,'2024-08-25 05:50:42',3,'Avialable','Enjoy a stay in our luxury 5 star rooms or suites at Kempinski Hotel Gold Coast City Accra situated in the heart of Accra. Book direct for the best rates.',3),(3,'Deluxy Apartment','room.webp',3,6,'2024-08-26 02:59:04',3,'Avialable','Deluxe rooms, are modern decorated, can accommodate up to 2 persons, totally soundproofed and equipped with high tech comforts such as high speed internet.',2),(4,'HTU CAMPUS','event-dashboard-hero-image.png',3,8,'2024-08-29 16:14:58',1,'Avialable','wahoooooo',1),(5,'HTU CAMPUS','event-dashboard-hero-image.png',3,8,'2024-08-29 16:19:09',1,'Avialable','wahoooooo',1);



/*Table structure for table `roomamount` */



DROP TABLE IF EXISTS `roomamount`;



CREATE TABLE `roomamount` (
  `Amount_id` int(11) NOT NULL AUTO_INCREMENT,
  `Amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Amount_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;



/*Data for the table `roomamount` */



insert  into `roomamount`(`Amount_id`,`Amount`,`created_at`) values (1,'100.00','2024-08-25 04:25:00'),(2,'150.00','2024-08-25 04:25:00'),(3,'200.00','2024-08-25 04:25:00'),(4,'108.00','2024-08-25 04:25:34'),(5,'155.00','2024-08-25 04:25:34'),(6,'205.00','2024-08-25 04:25:34'),(7,'110.00','2024-08-25 04:26:02'),(8,'180.00','2024-08-25 04:26:02'),(9,'220.00','2024-08-25 04:26:02');



/*Table structure for table `tourist_sites` */



DROP TABLE IF EXISTS `tourist_sites`;



CREATE TABLE `tourist_sites` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`site_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;



/*Data for the table `tourist_sites` */



insert  into `tourist_sites`(`site_id`,`site_name`,`country_id`) values (1,'Mole National Park',1),(2,'Cape Coast Castle',1),(3,'Kakum National Park',1),(4,'Wli Waterfalls',1),(5,'Lake Volta',1),(6,'Maasai Mara National Reserve',2),(7,'Mount Kenya',2),(8,'Lake Nakuru',2),(9,'Amboseli National Park',2),(10,'Diani Beach',2),(11,'Kruger National Park',3),(12,'Table Mountain',3),(13,'Robben Island',3),(14,'Garden Route',3),(15,'Cape Winelands',3),(16,'Christ the Redeemer',4),(17,'Iguazu Falls',4),(18,'Amazon Rainforest',4),(19,'Copacabana Beach',4),(20,'Sugarloaf Mountain',4),(21,'Banff National Park',5),(22,'Niagara Falls',5),(23,'CN Tower',5),(24,'Stanley Park',5),(25,'Old Quebec',5),(26,'Mount Fuji',6),(27,'Tokyo Disneyland',6),(28,'Kyoto Temples',6),(29,'Hiroshima Peace Memorial',6),(30,'Osaka Castle',6),(31,'Great Barrier Reef',7),(32,'Sydney Opera House',7),(33,'Uluru',7),(34,'Blue Mountains',7),(35,'Great Ocean Road',7),(36,'Eiffel Tower',8),(37,'Louvre Museum',8),(38,'Mont Saint-Michel',8),(39,'Palace of Versailles',8),(40,'Côte d\'Azur',8),(41,'Colosseum',9),(42,'Venice Canals',9),(43,'Leaning Tower of Pisa',9),(44,'Amalfi Coast',9),(45,'Vatican City',9),(46,'Milford Sound',10),(47,'Tongariro National Park',10),(48,'Rotorua',10),(49,'Bay of Islands',10),(50,'Queenstown',10);



/*Table structure for table `tours` */



DROP TABLE IF EXISTS `tours`;



CREATE TABLE `tours` (
  `TourID` int(11) NOT NULL AUTO_INCREMENT,
  `TourName` varchar(100) NOT NULL,
  `tourdescription` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `tourimages` blob DEFAULT NULL,
  `numberperson` int(11) DEFAULT NULL,
  `TourDuration` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AdminUserID` int(11) DEFAULT NULL,
  `tourStat_id` int(11) DEFAULT NULL,
  `tour_site_id` int(11) DEFAULT NULL,
  `tourtype_id` int(11) DEFAULT NULL,
  `start_date` varchar(50) DEFAULT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`TourID`),
  KEY `fk_adminuser` (`AdminUserID`),
  KEY `fk_tour_site_id` (`tour_site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;



/*Data for the table `tours` */



insert  into `tours`(`TourID`,`TourName`,`tourdescription`,`Price`,`tourimages`,`numberperson`,`TourDuration`,`date`,`AdminUserID`,`tourStat_id`,`tour_site_id`,`tourtype_id`,`start_date`,`end_date`) values (4,'Religious Tour','Trafalgar religious tours connect you with spiritual destinations. Experience the holy lands in Jordan and Israel or see the spiritual icons of Europe.','200.00','reli.jpg',20,50,'2024-10-10 13:16:40',3,1,3,10,'2024-10-15','2024-10-20'),(5,'Educaitonal ','An educational tour places the students in different socio-cultural environments where they encounter new people and witness regional practices. ','1000.00','edu.webp',100,2,'2024-10-10 13:17:16',3,1,3,10,'2024-11-01','	2024-11-07'),(6,'Group Tour ','Our group tours offer excitement, camaraderie, and unforgettable memories. Join us for a journey like no other and discover the world\'s wonders together.','2000.00','group tour.jpg',20,2,'2024-10-10 13:18:21',3,1,2,10,'2024-12-05','2024-12-12');



/*Table structure for table `tourstatus` */



DROP TABLE IF EXISTS `tourstatus`;



CREATE TABLE `tourstatus` (
  `tourstat_id` int(11) NOT NULL AUTO_INCREMENT,
  `tourStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tourstat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;



/*Data for the table `tourstatus` */



insert  into `tourstatus`(`tourstat_id`,`tourStatus`) values (1,'ongoing'),(2,'special'),(3,'old');



/*Table structure for table `tourtypes` */



DROP TABLE IF EXISTS `tourtypes`;



CREATE TABLE `tourtypes` (
  `TourTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `TourTypeName` varchar(100) NOT NULL,
  PRIMARY KEY (`TourTypeID`),
  UNIQUE KEY `TourTypeName` (`TourTypeName`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;



/*Data for the table `tourtypes` */



insert  into `tourtypes`(`TourTypeID`,`TourTypeName`) values (10,'adventure tour'),(1,'City Tours'),(7,'Culinary Tours'),(9,'education tour'),(5,'Festivals and Events Tours'),(2,'Group Tours'),(8,'religious tour'),(6,'safari Tours');



/*Table structure for table `verify` */



DROP TABLE IF EXISTS `verify`;



CREATE TABLE `verify` (
  `verify_id` int(11) NOT NULL AUTO_INCREMENT,
  `verify_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`verify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;



/*Data for the table `verify` */



insert  into `verify`(`verify_id`,`verify_name`) values (1,'verify'),(2,'Not_verify');



/*Table structure for table `whitelist` */



DROP TABLE IF EXISTS `whitelist`;



CREATE TABLE `whitelist` (
  `whitelist_id` int(11) NOT NULL AUTO_INCREMENT,
  `place_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `roleID` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `removal_reason` text DEFAULT NULL,
  `clientusers` int(11) DEFAULT NULL,
  PRIMARY KEY (`whitelist_id`),
  KEY `fk_roleID` (`roleID`),
  KEY `fk_clientusers` (`clientusers`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;



/*Data for the table `whitelist` */



insert  into `whitelist`(`whitelist_id`,`place_name`,`created_at`,`roleID`,`is_active`,`removal_reason`,`clientusers`) values (1,'Accra','2024-08-25 08:22:29',3,1,NULL,1),(2,'Ho Volta','2024-08-25 08:30:25',3,1,NULL,1),(3,'kkkk','2024-08-28 10:51:09',3,1,NULL,2),(4,'Accra, Kwame Nkrumah circle ','2024-08-29 16:48:05',3,1,NULL,4);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

