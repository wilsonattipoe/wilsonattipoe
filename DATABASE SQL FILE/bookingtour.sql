-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 05:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookingtour`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `ActionID` int(11) NOT NULL,
  `ActionName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`ActionID`, `ActionName`) VALUES
(1, 'Pending'),
(2, 'Ongoing'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `activitylogs`
--

CREATE TABLE `activitylogs` (
  `logs_id` int(11) NOT NULL,
  `clientusers` int(11) DEFAULT NULL,
  `adminusers` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activitylogs`
--

INSERT INTO `activitylogs` (`logs_id`, `clientusers`, `adminusers`, `action`, `action_time`, `ip_address`, `details`) VALUES
(1, NULL, 1, 'Updated booking action', '2024-08-31 09:58:42', '::1', 'Booking ID: 6, Action: rejected'),
(2, NULL, 1, 'Updated booking action', '2024-08-31 10:06:34', '::1', 'Booking ID: 14, Action: rejected');

-- --------------------------------------------------------

--
-- Table structure for table `addcart`
--

CREATE TABLE `addcart` (
  `cart_id` int(11) NOT NULL,
  `tourID` int(11) DEFAULT NULL,
  `ClientUserID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addcart`
--

INSERT INTO `addcart` (`cart_id`, `tourID`, `ClientUserID`, `dateCreated`) VALUES
(1, 4, 1, '2024-10-13 12:46:28'),
(2, 6, 1, '2024-10-13 12:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `adminstatus`
--

CREATE TABLE `adminstatus` (
  `statusID` int(11) NOT NULL,
  `statusName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminstatus`
--

INSERT INTO `adminstatus` (`statusID`, `statusName`) VALUES
(1, 'Active'),
(2, 'Terminate'),
(3, 'Non-Active');

-- --------------------------------------------------------

--
-- Table structure for table `adminuserroles`
--

CREATE TABLE `adminuserroles` (
  `AdminUserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `roles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE `adminusers` (
  `AdminUserID` int(11) NOT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `statusID` int(11) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`AdminUserID`, `RoleID`, `statusID`, `Username`, `Password`, `Email`) VALUES
(1, 4, 1, 'Dev', '$2y$10$pwlHBY96C7aEr/HeC3FF7e1c4FaiYEd8hd/blbuG3VX3RCJOnnMvC', 'compssa10@gmail.com'),
(2, 2, 1, 'Junior', '$2y$10$Hi0DJ/Ynl.146MJxpqZEcenC0Q.uX2CL5hS5A2rkCjdLcMuJLggqW', 'enochkwame216@gmail.com'),
(3, 1, 1, 'Admin', '$2y$10$m5kSqqwxGqKVGLvO84QSpunyAl0k6HYvFSlN68Wm/qJSg3vnrjbWS', 'nanatec21@gmail.com'),
(5, 4, 3, 'kwame', '$2y$10$3PwR.06maqUrd0MnEdDm5uJfaC5YQMA0uzqE9VKWf1mYdyWmNw8bO', 'dojo8416@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `booktours`
--

CREATE TABLE `booktours` (
  `bookTour_ID` int(11) NOT NULL,
  `ClientUserID` int(11) DEFAULT NULL,
  `participants` int(11) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `bookPrice` decimal(10,2) DEFAULT NULL,
  `Dated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booktours`
--

INSERT INTO `booktours` (`bookTour_ID`, `ClientUserID`, `participants`, `tour_id`, `action_id`, `bookPrice`, `Dated`) VALUES
(1, 1, 20, 0, 1, 200.00, '2024-10-13 12:46:12'),
(2, 1, 4, 4, 2, 800.00, '2024-10-13 12:46:47'),
(3, 1, 15, 6, 2, 30000.00, '2024-10-13 12:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `clientusers`
--

CREATE TABLE `clientusers` (
  `ClientUserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `contact` int(15) NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientusers`
--

INSERT INTO `clientusers` (`ClientUserID`, `Username`, `Password`, `FullName`, `Email`, `RoleID`, `contact`, `location`) VALUES
(1, 'Jojo', '$2y$10$BBYO5WzrRpWrowiigOR6M.adJUrgx1RuJmvFrCpJgR0VtV0oCINb2', 'Baba', 'destinynana566@gmail.com', 3, 555382169, 'Volt. Region Ho'),
(2, 'Kwisdom', '$2y$10$AXrGcoTb3hg4qJvbhki8m.QzL/p7Wqs7nO1vkZVAsbI4cBz6r0.W.', 'Wisdom', 'Kwisdom116@gmail.com', 3, 555123697, 'Accra Adenta'),
(3, 'Attipoe', '$2y$10$CcuMOFroX1756jYxubtSeOxOfOQFhBUnPu.zQpHOeHU.WkLnHVJ7C', 'John', 'wilsonattipoe7@gmail.com', 3, 555369512, 'Nothern Region, Sakaka'),
(4, 'SpendyLove', '$2y$10$c8CtBcns0vmtX9sbrDzU3uJQR7ey.phszsVni7m1QQ9KgpjPRl.na', 'Addo', 'bksaddo@gmail.com', 3, 552345964, 'Accra Madina'),
(5, 'Maron', '$2y$10$eF1trouKeCgm6ic.EnDQTOIPT.YWKenhwPW2ev/cf9XW4NnWCPzOe', 'Akuffo', 'marongeorge03@gmail.com', 3, 553698541, 'Ashiaman');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `continent` varchar(255) NOT NULL,
  `countryamount_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `continent`, `countryamount_id`) VALUES
(1, 'Ghana', 'Africa', 1),
(2, 'Kenya', 'Africa', 2),
(3, 'South Africa', 'Africa', 3),
(4, 'Brazil', 'South America', 4),
(5, 'Canada', 'North America', 5),
(6, 'Japan', 'Asia', 6),
(7, 'Australia', 'Australia', 7),
(8, 'France', 'Europe', 8),
(9, 'Italy', 'Europe', 9),
(10, 'New Zealand', 'Australia', 10);

-- --------------------------------------------------------

--
-- Table structure for table `countryamount`
--

CREATE TABLE `countryamount` (
  `country_id` int(11) NOT NULL,
  `countryamnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countryamount`
--

INSERT INTO `countryamount` (`country_id`, `countryamnt`) VALUES
(1, 1000),
(2, 1200),
(3, 1500),
(4, 2000),
(5, 2500),
(6, 3000),
(7, 3500),
(8, 4000),
(9, 4500),
(10, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `email_id` int(11) NOT NULL,
  `email_text` text DEFAULT NULL,
  `FullName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`email_id`, `email_text`, `FullName`) VALUES
(1, 'dsfasdgsdgsd', 'bb'),
(2, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'Mr. Walter'),
(3, 'The PHP script receives the form data and saves the message to the database.\nIt then sends an email to the system administrator with the details of the message.\nErrors are handled and reported if any issue occurs during the process.', 'Dev'),
(4, 'To get a verification code, first confirm the phone number you', 'John');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `ClientUserID` int(11) DEFAULT NULL,
  `FeedbackText` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `booking_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `ClientUserID`, `FeedbackText`, `CreatedAt`, `booking_id`) VALUES
(1, 1, 'oin us on this 8 Day Special Tour of Ghana. Highlights include a tour of WEB Dubois Centre, Independence Square, Kwame Nkrumah Memorial', '2024-08-29 15:29:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `PasswordReset_id` int(11) NOT NULL,
  `ClientUserID` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `Request_id` int(11) NOT NULL,
  `ClientUserID` int(11) DEFAULT NULL,
  `ActionID` int(11) DEFAULT NULL,
  `Request_title` varchar(255) DEFAULT NULL,
  `Request_description` text DEFAULT NULL,
  `Request_tourname` varchar(255) DEFAULT NULL,
  `Request_Date` date DEFAULT NULL,
  `verify_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`Request_id`, `ClientUserID`, `ActionID`, `Request_title`, `Request_description`, `Request_tourname`, `Request_Date`, `verify_id`) VALUES
(1, 1, 3, 'I want a reserve place and a room', 'i just want a place of quit serene and a nice environment', 'Travel to HTU campus', '2024-08-09', NULL),
(2, 1, 1, 'Wilson', 'just wanna go home!', 'Accra', '2024-08-06', NULL),
(3, 2, 1, 'Afajato', 'Please, i want to have my vacation holiday at this special place ', 'Holiday', '2024-08-29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(1, 'Admin'),
(4, 'Employee'),
(2, 'supervisor'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_id` int(11) NOT NULL,
  `Rooms_Name` varchar(50) DEFAULT NULL,
  `RoomImage` blob DEFAULT NULL,
  `adminusers` int(11) DEFAULT NULL,
  `roomamount` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bedquantity` int(11) NOT NULL,
  `wifi` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `bathroom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_id`, `Rooms_Name`, `RoomImage`, `adminusers`, `roomamount`, `created_at`, `bedquantity`, `wifi`, `description`, `bathroom`) VALUES
(1, 'Luxury', 0x726f6f6d322e77656270, 3, 1, '2024-08-25 05:50:13', 2, 'Avialable', 'Enjoy a stay in our luxury 5 star rooms or suites at Kempinski Hotel Gold Coast City Accra situated in the heart of Accra. Book direct for the best rates.', 2),
(2, 'First class', 0x726f6f6d312e6a7067, 3, 2, '2024-08-25 05:50:42', 3, 'Avialable', 'Enjoy a stay in our luxury 5 star rooms or suites at Kempinski Hotel Gold Coast City Accra situated in the heart of Accra. Book direct for the best rates.', 3),
(3, 'Deluxy Apartment', 0x726f6f6d2e77656270, 3, 6, '2024-08-26 02:59:04', 3, 'Avialable', 'Deluxe rooms, are modern decorated, can accommodate up to 2 persons, totally soundproofed and equipped with high tech comforts such as high speed internet.', 2),
(4, 'HTU CAMPUS', 0x6576656e742d64617368626f6172642d6865726f2d696d6167652e706e67, 3, 8, '2024-08-29 16:14:58', 1, 'Avialable', 'wahoooooo', 1),
(5, 'HTU CAMPUS', 0x6576656e742d64617368626f6172642d6865726f2d696d6167652e706e67, 3, 8, '2024-08-29 16:19:09', 1, 'Avialable', 'wahoooooo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomamount`
--

CREATE TABLE `roomamount` (
  `Amount_id` int(11) NOT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomamount`
--

INSERT INTO `roomamount` (`Amount_id`, `Amount`, `created_at`) VALUES
(1, 100.00, '2024-08-25 04:25:00'),
(2, 150.00, '2024-08-25 04:25:00'),
(3, 200.00, '2024-08-25 04:25:00'),
(4, 108.00, '2024-08-25 04:25:34'),
(5, 155.00, '2024-08-25 04:25:34'),
(6, 205.00, '2024-08-25 04:25:34'),
(7, 110.00, '2024-08-25 04:26:02'),
(8, 180.00, '2024-08-25 04:26:02'),
(9, 220.00, '2024-08-25 04:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `tourist_sites`
--

CREATE TABLE `tourist_sites` (
  `site_id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourist_sites`
--

INSERT INTO `tourist_sites` (`site_id`, `site_name`, `country_id`) VALUES
(1, 'Mole National Park', 1),
(2, 'Cape Coast Castle', 1),
(3, 'Kakum National Park', 1),
(4, 'Wli Waterfalls', 1),
(5, 'Lake Volta', 1),
(6, 'Maasai Mara National Reserve', 2),
(7, 'Mount Kenya', 2),
(8, 'Lake Nakuru', 2),
(9, 'Amboseli National Park', 2),
(10, 'Diani Beach', 2),
(11, 'Kruger National Park', 3),
(12, 'Table Mountain', 3),
(13, 'Robben Island', 3),
(14, 'Garden Route', 3),
(15, 'Cape Winelands', 3),
(16, 'Christ the Redeemer', 4),
(17, 'Iguazu Falls', 4),
(18, 'Amazon Rainforest', 4),
(19, 'Copacabana Beach', 4),
(20, 'Sugarloaf Mountain', 4),
(21, 'Banff National Park', 5),
(22, 'Niagara Falls', 5),
(23, 'CN Tower', 5),
(24, 'Stanley Park', 5),
(25, 'Old Quebec', 5),
(26, 'Mount Fuji', 6),
(27, 'Tokyo Disneyland', 6),
(28, 'Kyoto Temples', 6),
(29, 'Hiroshima Peace Memorial', 6),
(30, 'Osaka Castle', 6),
(31, 'Great Barrier Reef', 7),
(32, 'Sydney Opera House', 7),
(33, 'Uluru', 7),
(34, 'Blue Mountains', 7),
(35, 'Great Ocean Road', 7),
(36, 'Eiffel Tower', 8),
(37, 'Louvre Museum', 8),
(38, 'Mont Saint-Michel', 8),
(39, 'Palace of Versailles', 8),
(40, 'Côte d\'Azur', 8),
(41, 'Colosseum', 9),
(42, 'Venice Canals', 9),
(43, 'Leaning Tower of Pisa', 9),
(44, 'Amalfi Coast', 9),
(45, 'Vatican City', 9),
(46, 'Milford Sound', 10),
(47, 'Tongariro National Park', 10),
(48, 'Rotorua', 10),
(49, 'Bay of Islands', 10),
(50, 'Queenstown', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `TourID` int(11) NOT NULL,
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
  `end_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`TourID`, `TourName`, `tourdescription`, `Price`, `tourimages`, `numberperson`, `TourDuration`, `date`, `AdminUserID`, `tourStat_id`, `tour_site_id`, `tourtype_id`, `start_date`, `end_date`) VALUES
(4, 'Religious Tour', 'Trafalgar religious tours connect you with spiritual destinations. Experience the holy lands in Jordan and Israel or see the spiritual icons of Europe.', 200.00, 0x72656c692e6a7067, 20, 50, '2024-10-10 13:16:40', 3, 1, 3, 10, '2024-10-15', '2024-10-20'),
(5, 'Educaitonal ', 'An educational tour places the students in different socio-cultural environments where they encounter new people and witness regional practices. ', 1000.00, 0x6564752e77656270, 100, 2, '2024-10-10 13:17:16', 3, 1, 3, 10, '2024-11-01', '	2024-11-07'),
(6, 'Group Tour ', 'Our group tours offer excitement, camaraderie, and unforgettable memories. Join us for a journey like no other and discover the world\'s wonders together.', 2000.00, 0x67726f757020746f75722e6a7067, 20, 2, '2024-10-10 13:18:21', 3, 1, 2, 10, '2024-12-05', '2024-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `tourstatus`
--

CREATE TABLE `tourstatus` (
  `tourstat_id` int(11) NOT NULL,
  `tourStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourstatus`
--

INSERT INTO `tourstatus` (`tourstat_id`, `tourStatus`) VALUES
(1, 'ongoing'),
(2, 'special'),
(3, 'old');

-- --------------------------------------------------------

--
-- Table structure for table `tourtypes`
--

CREATE TABLE `tourtypes` (
  `TourTypeID` int(11) NOT NULL,
  `TourTypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourtypes`
--

INSERT INTO `tourtypes` (`TourTypeID`, `TourTypeName`) VALUES
(10, 'adventure tour'),
(1, 'City Tours'),
(7, 'Culinary Tours'),
(9, 'education tour'),
(5, 'Festivals and Events Tours'),
(2, 'Group Tours'),
(8, 'religious tour'),
(6, 'safari Tours');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `verify_id` int(11) NOT NULL,
  `verify_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`verify_id`, `verify_name`) VALUES
(1, 'verify'),
(2, 'Not_verify');

-- --------------------------------------------------------

--
-- Table structure for table `whitelist`
--

CREATE TABLE `whitelist` (
  `whitelist_id` int(11) NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `roleID` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `removal_reason` text DEFAULT NULL,
  `clientusers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `whitelist`
--

INSERT INTO `whitelist` (`whitelist_id`, `place_name`, `created_at`, `roleID`, `is_active`, `removal_reason`, `clientusers`) VALUES
(1, 'Accra', '2024-08-25 08:22:29', 3, 1, NULL, 1),
(2, 'Ho Volta', '2024-08-25 08:30:25', 3, 1, NULL, 1),
(3, 'kkkk', '2024-08-28 10:51:09', 3, 1, NULL, 2),
(4, 'Accra, Kwame Nkrumah circle ', '2024-08-29 16:48:05', 3, 1, NULL, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`ActionID`);

--
-- Indexes for table `activitylogs`
--
ALTER TABLE `activitylogs`
  ADD PRIMARY KEY (`logs_id`),
  ADD KEY `clientusers` (`clientusers`),
  ADD KEY `adminusers` (`adminusers`);

--
-- Indexes for table `addcart`
--
ALTER TABLE `addcart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `adminstatus`
--
ALTER TABLE `adminstatus`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `adminuserroles`
--
ALTER TABLE `adminuserroles`
  ADD PRIMARY KEY (`AdminUserID`,`RoleID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `adminusers`
--
ALTER TABLE `adminusers`
  ADD PRIMARY KEY (`AdminUserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `RoleID` (`RoleID`),
  ADD KEY `statusID` (`statusID`);

--
-- Indexes for table `booktours`
--
ALTER TABLE `booktours`
  ADD PRIMARY KEY (`bookTour_ID`),
  ADD KEY `ClientUserID` (`ClientUserID`);

--
-- Indexes for table `clientusers`
--
ALTER TABLE `clientusers`
  ADD PRIMARY KEY (`ClientUserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `fk_role` (`RoleID`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`),
  ADD KEY `fk_countryamount_id` (`countryamount_id`);

--
-- Indexes for table `countryamount`
--
ALTER TABLE `countryamount`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `ClientUserID` (`ClientUserID`),
  ADD KEY `fk_booking` (`booking_id`);

--
-- Indexes for table `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD PRIMARY KEY (`PasswordReset_id`),
  ADD KEY `ClientUserID` (`ClientUserID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`Request_id`),
  ADD KEY `fk_ClientUserID` (`ClientUserID`),
  ADD KEY `fk_ActionID` (`ActionID`),
  ADD KEY `fk_verify` (`verify_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`),
  ADD UNIQUE KEY `RoleName` (`RoleName`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_id`),
  ADD KEY `roomamount` (`roomamount`),
  ADD KEY `adminusers` (`adminusers`);

--
-- Indexes for table `roomamount`
--
ALTER TABLE `roomamount`
  ADD PRIMARY KEY (`Amount_id`);

--
-- Indexes for table `tourist_sites`
--
ALTER TABLE `tourist_sites`
  ADD PRIMARY KEY (`site_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`TourID`),
  ADD KEY `fk_adminuser` (`AdminUserID`),
  ADD KEY `fk_tour_site_id` (`tour_site_id`);

--
-- Indexes for table `tourstatus`
--
ALTER TABLE `tourstatus`
  ADD PRIMARY KEY (`tourstat_id`);

--
-- Indexes for table `tourtypes`
--
ALTER TABLE `tourtypes`
  ADD PRIMARY KEY (`TourTypeID`),
  ADD UNIQUE KEY `TourTypeName` (`TourTypeName`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`verify_id`);

--
-- Indexes for table `whitelist`
--
ALTER TABLE `whitelist`
  ADD PRIMARY KEY (`whitelist_id`),
  ADD KEY `fk_roleID` (`roleID`),
  ADD KEY `fk_clientusers` (`clientusers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `ActionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `activitylogs`
--
ALTER TABLE `activitylogs`
  MODIFY `logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `addcart`
--
ALTER TABLE `addcart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `adminstatus`
--
ALTER TABLE `adminstatus`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `adminusers`
--
ALTER TABLE `adminusers`
  MODIFY `AdminUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booktours`
--
ALTER TABLE `booktours`
  MODIFY `bookTour_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clientusers`
--
ALTER TABLE `clientusers`
  MODIFY `ClientUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `countryamount`
--
ALTER TABLE `countryamount`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `PasswordReset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `Request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `Room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roomamount`
--
ALTER TABLE `roomamount`
  MODIFY `Amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tourist_sites`
--
ALTER TABLE `tourist_sites`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `TourID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tourstatus`
--
ALTER TABLE `tourstatus`
  MODIFY `tourstat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tourtypes`
--
ALTER TABLE `tourtypes`
  MODIFY `TourTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `verify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `whitelist`
--
ALTER TABLE `whitelist`
  MODIFY `whitelist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activitylogs`
--
ALTER TABLE `activitylogs`
  ADD CONSTRAINT `activitylogs_ibfk_1` FOREIGN KEY (`clientusers`) REFERENCES `clientusers` (`ClientUserID`),
  ADD CONSTRAINT `activitylogs_ibfk_2` FOREIGN KEY (`adminusers`) REFERENCES `adminusers` (`AdminUserID`);

--
-- Constraints for table `adminuserroles`
--
ALTER TABLE `adminuserroles`
  ADD CONSTRAINT `AdminUserRoles_ibfk_1` FOREIGN KEY (`AdminUserID`) REFERENCES `adminusers` (`AdminUserID`),
  ADD CONSTRAINT `AdminUserRoles_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`);

--
-- Constraints for table `adminusers`
--
ALTER TABLE `adminusers`
  ADD CONSTRAINT `adminusers_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`),
  ADD CONSTRAINT `adminusers_ibfk_2` FOREIGN KEY (`statusID`) REFERENCES `adminstatus` (`statusID`);

--
-- Constraints for table `clientusers`
--
ALTER TABLE `clientusers`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`);

--
-- Constraints for table `countries`
--
ALTER TABLE `countries`
  ADD CONSTRAINT `fk_countryamount_id` FOREIGN KEY (`countryamount_id`) REFERENCES `countryamount` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD CONSTRAINT `passwordreset_ibfk_1` FOREIGN KEY (`ClientUserID`) REFERENCES `clientusers` (`ClientUserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
